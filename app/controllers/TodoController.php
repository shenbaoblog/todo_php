<?php

include('/var/www/html/app/models/BaseModel.php');
include('/var/www/html/app/models/Todo.php');
include('/var/www/html/app/models/User.php');

class TodoController
{

    public function index()
    {
        $user_id = 1;
        $users = User::findById($user_id);
        $todos = Todo::getAll($user_id);

        return [
            'users' => $users,
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

        $users = User::findById($user_id);
        $todo = Todo::getByID($todo_id);

        return [
            'users' => $users,
            'todo' => $todo,
        ];
    }

}
