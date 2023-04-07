<?php

require_once('config.php');

// PDOクラスのインスタンス化
function connectPdo()
{
    // 例外とエラーの違い（エラーは処理止まるよね）
    // 例外を発生させてみる
    // DBの接続情報の変更はできるがthrow new Exception()をかけない場合多い
    try {
        return new PDO(DSN, DB_USER, DB_PASSWORD);
    } catch (\PDOException $e) {
        echo $e->getMessage();
        exit();
        // ここvar_dump()させてみる
    }
}

function getAllRecords()
{
    $dbh = connectPdo();
    $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL';
    // query()の中身var_dumpできるよ（メソッドチェーンを区切ることができるよ）
    // 変数以外もvar_dump()できる認識が甘いß
    return $dbh->query($sql)->fetchAll();
}

function getTotoTextById($id)
{
    $dbh = connectPdo();
    $sql = 'SELECT * FROM todos WHERE id = ' . $id . ' AND deleted_at IS NULL';
    $todo = $dbh->query($sql)->fetch();
    return $todo['content'];
}

// 新規作成処理
function createTodoData($todoText)
{
    $dbh = connectPdo();
    // 完成系のSQLを書いてもらい変数にクォーテーションが含まれていないことを再認識してもらう
    // 型は？
    $sql = 'INSERT INTO todos (content) VALUES ("' . $todoText . '")';
    // メソッド呼び出しで何らかのインスタンスであることが推察できる
    // SQL実行しているのはどこ？
    $dbh->query($sql);
    // ここで処理が終わり勝手にindex.phpに戻ると思っている
    // 処理が呼び出し元に返っていくイメージがない
}

// 更新処理
function updateTodoData($post)
{
    $dbh = connectPdo();
    $sql = 'UPDATE todos SET content = "' . $post['content'] . '" WHERE id = ' . $post['id'];
    $dbh->query($sql);
}

function deleteTodoData($id)
{
    $dbh = connectPdo();
    $now = date('Y-m-d H:i:s');
    $sql = 'UPDATE todos SET deleted_at = "' . $now . '" WHERE id = ' . $id;
    $dbh->query($sql);
}
