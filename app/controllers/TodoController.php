<?php

class TodoController
{

    public function index($dsn, $username, $password, $driver_options)
    {
        try {
            $pdo = new PDO($dsn, $username, $password, $driver_options);

            $sql = 'SELECT * FROM users';
            if ($prepare = $pdo->prepare($sql)) {
                $prepare->execute();
                $users = $prepare->fetchAll(PDO::FETCH_ASSOC);
            }

            $sql = 'SELECT * FROM todos';
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
