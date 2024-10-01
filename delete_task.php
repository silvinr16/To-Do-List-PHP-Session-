<?php
session_start();
require 'functions.php';

$id = $_GET['id'];
deleteTask($id);

header('Location: index.php');
exit;
?>
