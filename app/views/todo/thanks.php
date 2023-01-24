<?php

include('/var/www/html/app/controllers/TodoController.php');

$controller = new TodoController();
// $sql = $controller->show();
$sql = $controller->store();
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

    <h1>新規作成完了</h1>
    <p>ログインユーザー名</p>
    <p><?php echo $sql['user']['name']; ?></p>




</body>

</html>
