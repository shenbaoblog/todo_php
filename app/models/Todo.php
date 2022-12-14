<?php

class Todo extends BaseModel
{
    // ユーザー毎の全タスク
    public function getAll($user_id)
    {
        // $config = self::getDBConfig();
        try {
            $pdo = self::getPDO();

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

    // todoのidからからタスクを取得
    public function getByID($todo_id)
    {
        // $config = self::getDBConfig();
        try {
            $pdo = self::getPDO();

            $sql = "SELECT * FROM todos WHERE id = $todo_id";
            if ($prepare = $pdo->prepare($sql)) {
                $prepare->execute();
                $todos = $prepare->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            print('Connection failed' . $e->getMessage());
            die();
        }
        return $todos;
    }
}
