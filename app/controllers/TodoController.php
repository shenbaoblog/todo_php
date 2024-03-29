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
        $this->current_user = ServiceAuth::getCurrentUser();
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

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            // セッションからエラーメッセージを取得
            $errors = Session::getErrors();

            $old = [];
            foreach ($_SESSION['input'] as $key => $value) {
                $old[$key] = $value;
                echo $key;
                echo '<br />';
                echo $old[$key];
                echo '<br />';
                echo '<br />';
            }

            // GET送信されたリクエストパラメータです
            return [
                'user' => $this->current_user,
                'errors' => $errors,
                'old' => $old,
            ];
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

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
                $_SESSION['errors'] = $validation->getErrorMsg();
                $_SESSION['input']['title'] = $_POST['title'];
                $_SESSION['input']['details'] = $_POST['details'];
                $_SESSION['input']['status'] = $_POST['status'];
                header('Location: http://localhost:8000/views/todo/new.php');
                exit();
            }

            $valide_data = $validation->getValidData();
            Todo::registration($valide_data);

            return [
                'user' => $this->current_user,
            ];
        }
    }
}
