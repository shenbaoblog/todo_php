<?php

include('/var/www/html/app/controllers/TodoController.php');
$sql = TodoController::show();

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
    <p><?php echo $sql['users'][0]['name'] . "a"; ?></p>

    <br />

    <!-- TODOのタイトル -->
    <h2>TODO</h2>

    <?php foreach ($sql['todo'] as $todo) : ?>

        <p>作成日：<?php echo $todo['created_at']; ?></p>
        <p>更新日：<?php echo $todo['updated_at']; ?></p>
        <p>タイトル：<?php echo $todo['title']; ?></p>
        <p>詳細：<?php echo $todo['details']; ?></p>

    <?php endforeach; ?>


</body>

</html>
