<?php

include('/var/www/html/app/controllers/TodoController.php');
$sql = TodoController::index();

$controller = new TodoController();
$sql2 = $controller->index();

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

    <p>ログインユーザー名</p>
    <p><?php echo $sql['user']['name']; ?></p>
    <?php var_dump($sql['user']); ?>

    <!-- ユーザーリスト -->
    <!-- <h2>ユーザーリスト</h2>
    <?php
    echo "id,name,password,created_at,updated_at,deleted_at<br />";
    foreach ($sql['users'] as $user) {
        echo "<li>{$user['id']},{$user['name']},{$user['password']},{$user['created_at']},{$user['updated_at']},{$user['updated_at']},{$user['deleted_at']}</li>";
    }
    ?> -->

    <br />

    <!-- TODOのタイトル -->
    <h2>TODOリスト</h2>
    <ul>
        <?php foreach ($sql['todos'] as $todo) : ?>
            <li><?php echo $todo['title']; ?></li>
        <?php endforeach; ?>
    </ul>

</body>

</html>
