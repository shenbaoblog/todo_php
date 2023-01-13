<?php

include('/var/www/html/app/models/BaseModel.php');
include('/var/www/html/app/models/Todo.php');
include('/var/www/html/app/models/User.php');

include('/var/www/html/app/services/auth.php');

class TodoController
{

    // private static $current_user;
    private $current_user;

    function __construct() {
        $this->current_user = ServiceAuth::get_current_user();
    }

    public function index()
    {
        $user = $this->current_user;
        $todos = Todo::getAll($this->current_user['id']);
        var_dump($this->current_user);

        return [
            'user' => $user,
            'todos' => $todos,
        ];
    }

    public function show()
    {
        $user_id = 1;
        // var_dump($this->current_user['id']);
        // $user_id = $this->current_user['id'];

        // クエリパラメータから$todo_idを取得
        if(isset($_GET['todo_id'])) {
            $todo_id = $_GET['todo_id'];
        }
        if(!$todo_id) {
            header('Location: /error/400.php');
            exit;
        }

        $user = User::findById($user_id);
        $todo = Todo::findOr404($todo_id);


        var_dump($user);
        var_dump($todo);

        return [
            'user' => $user,
            'todo' => $todo,
        ];
    }

}
