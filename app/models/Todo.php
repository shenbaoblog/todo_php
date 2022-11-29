<?php

class Todo
{
    public function getAll($pdo)
    {
        $sql = 'SELECT * FROM todos';
        if ($prepare = $pdo->prepare($sql)) {
            $prepare->execute();
            $todos = $prepare->fetchAll(PDO::FETCH_ASSOC);
            return $todos;
        }
    }
}
