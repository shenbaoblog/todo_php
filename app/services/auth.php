<?php

class ServiceAuth {
    function get_current_user() {
        $user_id = 1;
        return User::findById($user_id);
    }
}
