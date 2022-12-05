<?php

class BaseModel
{
    public function getDBConfig()
    {
        return require('/var/www/html/app/config/db_connect.php');;
    }
}
