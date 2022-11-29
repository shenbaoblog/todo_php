<?php

include('/var/www/html/app/models/Todo.php');
include('/var/www/html/app/models/User.php');

class TodoController
{

    public function index()
    {
        $config = require_once('/var/www/html/app/config/db_connect.php');

        try {
            $pdo = new PDO($config['dsn'], $config['username'], $config['password'], $config['driver_options']);

            $users = User::getAll($pdo);

            $sql = 'SELECT * FROM todos WHERE user_id = 1';
            if ($prepare = $pdo->prepare($sql)) {
                $prepare->execute();
                $todos = $prepare->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            print('Connection failed:' . $e->getMessage());
            die();
        }



        return [
            'users' => $users,
            'todos' => $todos,
        ];
    }
}
