<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP</title>
</head>
<body>
  <?php
  $dsn = 'mysql:dbname=todo;host=127.0.0.1;port=3306;charset=utf8mb4;';
  $username = 'root';
  $password = 'root';
  $driver_options = [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ];
  
  $pdo = new PDO($dsn, $username, $password, $driver_options);
  ?>
</body>
</html>
