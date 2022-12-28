<?php

include('/var/www/html/app/models/BaseModel.php');
include('/var/www/html/app/models/Todo.php');
include('/var/www/html/app/models/User.php');

class TodoController
{

    // private static $current_user;
    private $current_user;

    function __construct() {
        $user_id = 1;
        $this->current_user = User::findById($user_id);
        // self::$current_user = User::findById($user_id);
    }

    public function index()
    {
        $user_id = 1;
        // $user = self::$current_user;
        // $user = $this->current_user;
        $user = User::findById($user_id);
        $todos = Todo::getAll($user_id);

        return [
            'user' => $user,
            'todos' => $todos,
        ];
    }

    public function show()
    {
        $user_id = 1;
        if(isset($_GET['todo_id'])) { $todo_id = $_GET['todo_id']; }

        if(!$todo_id) {
            header('Location: /error/404.php');
            exit;
        }

        $user = User::findById($user_id);
        $todo = Todo::getByID($todo_id);

        return [
            'users' => $user,
            'todo' => $todo,
        ];
    }

}
