<?php
require_once('functions.php');
// $_GETのkeyがどこで決定されるか（クエリパラメータの理解）
$todo = getSelectedTodo($_GET['id']);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>編集</title>
</head>

<body>
    <!-- 理解度高ければ新規作成とほぼ一緒なのでスキップ -->
    <form action="store.php" method="post">
        <input type="hidden" name="id" value="<?= $_GET['id']; ?>">
        <input type="text" name="content" value="<?= $todo; ?>">
        <input type="submit" value="更新">
    </form>
    <div>
        <a href="index.php">一覧へ戻る</a>
    </div>
</body>

</html>