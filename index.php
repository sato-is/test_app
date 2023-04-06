<?php
require_once('functions.php');
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>

<body>
    welcome hello world
    <div>
        <!-- httpメソッドを認識していない（POSTのみフォームレッスンで理解している） -->
        <a href="new.php">
            <p>新規作成</p>
        </a>
    </div>
    <div>
        <table>
            <tr>
                <th>ID</th>
                <th>内容</th>
                <th>更新</th>
                <th>削除</th>
            </tr>
            <!-- getTodoListの詳細な要素の型・内容 理解度に応じて仲間で追わせる-->
            <?php foreach (getTodoList() as $todo) : ?>
                <tr>
                    <!-- カラム名に対応 -->
                    <td><?= $todo['id']; ?></td>
                    <td><?= $todo['content']; ?></td>
                    <td>
                        <a href="edit.php?id=<?= $todo['id']; ?>">更新</a>
                    </td>
                    <td>
                        <form action="store.php" method="post">
                            <input type="hidden" name="id" value="<?= $todo['id']; ?>">
                            <button type="submit">削除</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>