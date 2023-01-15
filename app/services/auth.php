<?php

class ServiceAuth {
    function get_current_user() {
        $user_id = 1;
        if(!$user_id) {
            header('Location: /auth/login.php');
            exit;
        }
        return User::findById($user_id);
    }
}
