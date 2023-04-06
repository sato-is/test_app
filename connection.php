<?php

require_once('config.php');

// PDOクラスのインスタンス化
function connectPdo()
{
    try {
        return new PDO(DSN, DB_USER, DB_PASSWORD);
    } catch (\PDOException $e) {
        echo $e->getMessage();
        exit();
    }
}

function getAllRecords()
{
    $dbh = connectPdo();
    $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL';
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
    $sql = 'INSERT INTO todos (content) VALUES ("' . $todoText . '")';
    $dbh->query($sql);
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
