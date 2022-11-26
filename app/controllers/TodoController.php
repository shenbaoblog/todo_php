<?php

// $config = require_once('/var/www/html/app/config/db_connect.php');


class TodoController
{
    // private $dsn;
    // private $username;
    // private $password;
    // private $driver_options;
    public $config = [];

	function __construct()	{
		// $this->$dsn = $config['dsn'];
        // $this->username = $config['username'];
        // $this->password = $config['password'];
        // $this->driver_options = $config['driver_options'];
        $this->config = require_once('/var/www/html/app/config/db_connect.php');
	}

    public function index()
    {
        try {
            $pdo = new PDO($this->config['dsn'], $this->config['username'], $this->config['password'], $this->config['driver_options']);

            $sql = 'SELECT * FROM users';
            if ($prepare = $pdo->prepare($sql)) {
                $prepare->execute();
                $users = $prepare->fetchAll(PDO::FETCH_ASSOC);
            }

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
