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

  $sql = 'SELECT * FROM users';
  if($prepare = $pdo->prepare($sql)) {
    $prepare->execute();
    $users = $prepare->fetchAll(PDO::FETCH_ASSOC);
    echo "id,name,password,created_at,updated_at,deleted_at<br />";
    foreach ($users as $user) {
      echo "{$user['id']},{$user['name']},{$user['password']},{$user['created_at']},{$user['updated_at']},{$user['updated_at']},{$user['deleted_at']}<br />";
    }
  }
  
  echo '<br />';
  
  $sql = 'SELECT * FROM todos';
  if($prepare = $pdo->prepare($sql)) {
    $prepare->execute();
    $todos = $prepare->fetchAll(PDO::FETCH_ASSOC);
    echo "id,user_id,title,details,status,created_at,updated_at,deleted_at<br />";
    foreach ($todos as $todo) {
      echo "{$todo['id']},{$todo['user_id']},{$todo['title']},{$todo['details']},{$todo['status']},{$todo['created_at']},{$todo['updated_at']},{$todo['updated_at']},{$todo['deleted_at']}<br />";
    }
  }

  ?>
</body>
</html>
