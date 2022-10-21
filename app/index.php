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
  $dsn = 'mysql:dbname=todo;host=mysql;port=3306;charset=utf8mb4';
  $username = 'yohei';
  $password = 'yj558055';
  $driver_options = [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ];

  try {
    $pdo = new PDO($dsn, $username, $password, $driver_options);
  } catch (PDOException $e){
    print('Connection failed:'.$e->getMessage());
    die();
  }

  ?>
</body>
</html>
