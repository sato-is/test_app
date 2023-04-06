<?php
require_once('connection.php');

function getTodoList()
{
    return getAllRecords();
}

function getSelectedTodo($id)
{
    return getTotoTextById($id);
}

function createData($post)
{
    createTodoData($post['content']);
}

// $post = $_POSTとイコールと理解していない場合関数の引数が理解できていない
function savePostedData($post)
{
    $path = getRefererPath();
    switch ($path) {
        case '/new.php':
            createTodoData($post['content']);
            break;
        case '/edit.php':
            updateTodoData($post);
            break;
        case '/index.php';
            deleteTodoData($post['id']);
            break;
        default:
            break;
    }
}

// 遷移元のパスを文字列として返すと簡潔に説明できるか→営業研修につながる部分
function getRefererPath()
{
    // $_SERVER['HTTP_REFERER']の型が答えられない
    // parse_urlのドキュメントを見て型の必要性
    // 返り値をvar_dump()させ調べ方を教える
    $urlArray = parse_url($_SERVER['HTTP_REFERER']);
    // 推測力を高めたいので$urlArrayの型を聞く
    // 調べずとも['key']で連想配列であることがわかる
    return $urlArray['path'];
}
