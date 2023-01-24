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

    public function new()
    {
        return [
            'user' => $this->current_user,
        ];
    }

    public function store()
    {
        Todo::registration();
        return [
            'user' => $this->current_user,
        ];
    }

}
