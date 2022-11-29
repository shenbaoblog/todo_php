<?php

class User
{
    static public function getAll($pdo)
    {
        $sql = 'SELECT * FROM users';
        if ($prepare = $pdo->prepare($sql)) {
            $prepare->execute();
            $users = $prepare->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        }
    }
}
