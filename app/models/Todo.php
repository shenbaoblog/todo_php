<?php

class Todo extends BaseModel
{
    public function getAll($user_id)
    {
        $config = BaseModel::getDBConfig();

        try {
            $pdo = new PDO($config['dsn'], $config['username'], $config['password'], $config['driver_options']);

            $sql = "SELECT * FROM todos WHERE user_id = $user_id";
            if ($prepare = $pdo->prepare($sql)) {
                $prepare->execute();
                $todos = $prepare->fetchAll(PDO::FETCH_ASSOC);
            }

        } catch (PDOException $e) {
            print('Connection failed:' . $e->getMessage());
            die();
        }

        return $todos;
    }
}
