<?php

include('/var/www/html/app/models/BaseModel.php');
include('/var/www/html/app/models/Todo.php');
include('/var/www/html/app/models/User.php');
include('/var/www/html/app/validations/TodoValidation.php');

include('/var/www/html/app/services/auth.php');
include('/var/www/html/app/services/session.php');

class TodoController
{

    // private static $current_user;
    private $current_user;

    function __construct() {
        $this->current_user = ServiceAuth::get_current_user();
    }

    public function index()
    {

        $todos = Todo::getAll($this->current_user['id']);

        return [
            'user' => $this->current_user,
            'todos' => $todos,
        ];
    }

    public function show()
    {

        // クエリパラメータから$todo_idを取得
        if(isset($_GET['todo_id'])) {
            $todo_id = $_GET['todo_id'];
        }
        if(!$todo_id) {
            header('Location: /error/400.php');
            exit;
        }

        $todo = Todo::findOr404($todo_id);


        return [
            'user' => $this->current_user,
            'todo' => $todo,
        ];
    }


    // タスク新規登録（バリデーション付き）
    public function new () {
        session_start();

        var_dump($_SERVER['REQUEST_METHOD']);

        if (is_array($_SESSION["flash_messages"]) && !empty($_SESSION["flash_messages"])) {
            $_SERVER['REQUEST_METHOD'] == 'GET';
            header('Location: http://localhost:8000/views/todo/new.php');
        }
        var_dump($_SERVER['REQUEST_METHOD']);

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            // セッションからエラーメッセージを取得

            // セッション削除
            unset($_SESSION["flash_messages"]);

            // GET送信されたリクエストパラメータです
            return [
                'user' => $this->current_user,
            ];
        } elseif($_SERVER['REQUEST_METHOD'] == 'POST') {

            // POST送信されたリクエストパラメータです
            $user_id = $_POST['user_id'];
            $title = $_POST['title'];
            $details = $_POST['details'];
            $status = $_POST['status'];

            $todo_data =[
                'user_id' => $user_id,
                'title' => $title,
                'details' => $details,
                'status' => $status,
            ];

            $validation = new TodoValidation($todo_data);
            //もしバリデーションがNGなら
            if(!$validation->validation()) {
                //新規作成ページに遷移　エラーメッセージを表示させたい
                $_SESSION["flash_messages"] = $validation->getErrorMsg();

                return [
                    'user' => $this->current_user,
                ];
            }

            $valide_data = $validation->getValidData();
            Todo::registration($valide_data);

            return [
                'user' => $this->current_user,
            ];
        }

    }
}
