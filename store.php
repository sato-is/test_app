<?php
require_once('functions.php');

// POSTの中身が答えられない
// var_dump()で中身を確認してもらう
savePostedData($_POST);
header('location: ./index.php');
