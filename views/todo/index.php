<?php
  $dsn = 'mysql:dbname=db_todo;host=mysql;port=3306;charset=utf8';
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
  }
  
  $sql = 'SELECT * FROM todos';
  if($prepare = $pdo->prepare($sql)) {
    $prepare->execute();
    $todos = $prepare->fetchAll(PDO::FETCH_ASSOC);
  }
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP</title>
</head>
<body>

  <!-- ユーザーリスト -->
  <h2>ユーザーリスト</h2>
  <?php
    echo "id,name,password,created_at,updated_at,deleted_at<br />";
    foreach ($users as $user) {
      echo "<li>{$user['id']},{$user['name']},{$user['password']},{$user['created_at']},{$user['updated_at']},{$user['updated_at']},{$user['deleted_at']}</li>";
    }
  ?>

  <br />

  <!-- TODOのタイトル -->
  <h2>TODOリスト</h2>
  <ul>
    <?php foreach ($todos as $todo): ?>
      <li><?php echo $todo['title']; ?></li>
    <?php endforeach; ?>
  </ul>

</body>
</html>
