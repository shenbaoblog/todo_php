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
    public function registration() {
        $title   = $_POST['title'];
        $details = $_POST['details'];

        try {
            $pdo = self::getPDO();

            $sql = "INSERT INTO todos(title, details) VALUES(:title, :details)";
            if ($prepare = $pdo->prepare($sql)) {
                $params = array(':title' => $title, ':details' => $details);
                $prepare->execute($params);
            }
        } catch (PDOException $e) {
            print('Connection failed' . $e->getMessage());
            die();
        }
    }
}
