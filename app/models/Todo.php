<?php

class Todo
{
    public function getAll($user_id)
    {

        $config = require_once('/var/www/html/app/config/db_connect.php');

        try {
            $pdo = new PDO($config['dsn'], $config['username'], $config['password'], $config['driver_options']);


            $sql = "SELECT * FROM todos WHERE user_id = $user_id";
            if ($prepare = $pdo->prepare($sql)) {
                $prepare->execute();
                $todos = $prepare->fetchAll(PDO::FETCH_ASSOC);
            }

            $pdo = null;

        } catch (PDOException $e) {
            print('Connection failed:' . $e->getMessage());
            die();
        }

        return $todos;
    }
}
