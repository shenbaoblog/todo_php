<?php

class User
{
    static public function findById($user_id)
    {
        $config = require_once('/var/www/html/app/config/db_connect.php');

        try {
            $pdo = new PDO($config['dsn'], $config['username'], $config['password'], $config['driver_options']);

            $sql = "SELECT * FROM users WHERE id = {$user_id}";
            if ($prepare = $pdo->prepare($sql)) {
                $prepare->execute();
                $users = $prepare->fetchAll(PDO::FETCH_ASSOC);
            }

            $prepare = null;
            $pdo = null;

        } catch (PDOException $e) {
            print('Connection failed:' . $e->getMessage());
            die();
        }

        return $users;
    }
}
