<?php

include('/var/www/html/app/controllers/TodoController.php');

$controller = new TodoController();

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

    <!-- エラー表示 -->
    <?php if(!empty($sql['errors'])): ?>
        <ul>
            <?php foreach ($sql['errors'] as $error): ?>
                <li style="color: red;"><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>


    <form method="POST" action="/views/todo/new.php">

        <!-- 非表示でuser_idを送る -->
        <input type="hidden" name="user_id" id="user_id" value="<?php echo $sql['user']['id']; ?>">

        <p>【必須】タイトル：<input type="text" name="title" id="title"><?php echo $sql['old']['title']; ?></p>
        <p>詳細：<textarea name="details" id="details" cols="30" rows="10"><?php echo $sql['old']['details']; ?></textarea></p>
        <p>ステータス：
            <select name="status" id="status">
                <option value="0" <?php echo $sql['old']['status'] == 0 ? 'selected' : ''; ?>>未完了</option>
                <option value="1" <?php echo $sql['old']['status'] == 1 ? 'selected' : ''; ?>>完了</option>
            </select>
        </p>

        <button type="submit">登録</button>

    </form>


</body>

</html>
