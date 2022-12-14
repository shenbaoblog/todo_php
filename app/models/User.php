<?php

class User extends BaseModel
{
    static public function findById($user_id)
    {
        // $config = self::getDBConfig();

        try {
            $pdo = self::getPDO();

            $sql = "SELECT * FROM users WHERE id = {$user_id}";
            if ($prepare = $pdo->prepare($sql)) {
                $prepare->execute();
                $users = $prepare->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            print('Connection failed:' . $e->getMessage());
            die();
        }

        return $users;
    }
}
