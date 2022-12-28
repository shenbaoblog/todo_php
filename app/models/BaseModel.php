<?php

$config = require_once('/var/www/html/app/config/config.php');
class BaseModel {
    
    // DBconfigの取得
    // public static function getDBConfig() {
    //     global $config;
    //     return  $config;
    // }

    // pdoインスタンスの生成
    public static function getPDO() {
        global $config;
        return new PDO($config['dsn'], $config['username'], $config['password'], $config['driver_options']);
    }
}
