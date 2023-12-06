<?php
include_once 'repository.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    deleteWarrior($id);
}

header("Location: /list.php");
?>
