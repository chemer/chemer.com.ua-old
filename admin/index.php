<?php
include("../scripts/php/Locker.php");
include("../scripts/php/DataBase.php");

$theDataBase = new DataBase();
$theDataBase->select();
$theLocker = new Locker();
$theLocker->lock($theDataBase);

?>

You are logged successfull <a href="../index2.php">Go home page</a><br/>
<a href="index.php?action=logout" class="logout">logout</a>