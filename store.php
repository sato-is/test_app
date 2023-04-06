<?php
require_once('functions.php');

savePostedData($_POST);
header('location: ./index.php');
