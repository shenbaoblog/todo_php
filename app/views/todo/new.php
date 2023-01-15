<?php

include('/var/www/html/app/controllers/TodoController.php');

$controller = new TodoController();
// $sql = $controller->show();
$sql = $controller->new();
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

    <h1>新規作成</h1>
    <p>ログインユーザー名</p>
    <p><?php echo $sql['user']['name']; ?></p>

    <br />

    <!-- TODOのタイトル -->
    <h2>TODO</h2>
    <form method="POST" action="/config/controllers/TodoController.php">

        <p>タイトル：<input type="text" name="title" id="title"></p>
        <p>詳細：<textarea name="details" id="details" cols="30" rows="10"></textarea></p>

        <button type="submit">登録</button>

    </form>


</body>

</html>
