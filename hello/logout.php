<?php
session_start();
session_destroy();
header("Location: loginweb.php");
exit();
?>
