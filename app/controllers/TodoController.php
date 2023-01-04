<?php

include('/var/www/html/app/models/BaseModel.php');
include('/var/www/html/app/models/Todo.php');
include('/var/www/html/app/models/User.php');

include('/var/www/html/app/services/auth.php');

class TodoController
{

    // private static $current_user;
    private $current_user;
    private $user_id = 1;

    function __construct() {
        // $user_id = 1;
        $user_id = $this->user_id;
        $this->current_user = ServiceAuth::get_current_user();
    }

    public function index()
    {
        // $user_id = 1;
        $user_id = $this->user_id;
        $user = $this->current_user;
        $todos = Todo::getAll($user_id);

        return [
            'user' => $user,
            'todos' => $todos,
        ];
    }

    public function show()
    {
        // $user_id = 1;
        $user_id = $this->user_id;
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
