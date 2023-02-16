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
    public static function getByID($todo_id)
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

    //  todoのidからからタスクを取得して、エラー判定
    public function findOr404($todo_id)
    {
        $todo = self::getByID($todo_id);
        if(!$todo) {
            header('Location: /error/404.php');
            exit;
        }
        return $todo;
    }

    // タスクの新規登録
    public function registration($valid_data) {
        $user_id = $valid_data['user_id'];
        $title = $valid_data['title'];
        $details = $valid_data['details'];
        $status = $valid_data['status'];

        try {
            $pdo = self::getPDO();

            // $sql = "SELECT * FROM todos WHERE id = $todo_id";

            $sql = "INSERT INTO todos(user_id, title, details, status) VALUES(:user_id, :title, :details, :status)";
            if ($prepare = $pdo->prepare($sql)) {
                var_dump($prepare);
                echo "<br>";
                $params = array(
                    ':user_id' => $user_id,
                    ':title' => $title,
                    ':details' => $details,
                    ':status' => $status
                );

                var_dump($params);
                $result = $prepare->execute($params);
                echo "<br>";
                echo "<br>";
                var_dump($result);
                echo "<br>";
                echo "<br>";
                var_dump($prepare->debugDumpParams());
            }
        } catch (PDOException $e) {
            print('Connection failed' . $e->getMessage());
            die();
        }
    }
}
