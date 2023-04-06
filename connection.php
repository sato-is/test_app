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
    $sql = 'SELECT * FROM todos WHERE id = :id AND deleted_at IS NULL';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetch();
    return $data['content'];
}

function createTodoData($todoText)
{
    $dbh = connectPdo();
    $sql = 'INSERT INTO todos (content) VALUES (:todoText)';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':todoText', $todoText, PDO::PARAM_STR);
    $stmt->execute();
}

function updateTodoData($post)
{
    $dbh = connectPdo();
    $sql = 'UPDATE todos SET content = :content WHERE id = :id';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':content', $post['content'], PDO::PARAM_STR);
    $stmt->bindValue(':id', $post['id'], PDO::PARAM_INT);
    $stmt->execute();
}

function deleteTodoData($id)
{
    $dbh = connectPdo();
    $now = date('Y-m-d H:i:s');
    $sql = 'UPDATE todos SET deleted_at = "' . $now . '" WHERE id = :id';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}
