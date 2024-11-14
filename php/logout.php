<?php
include('./database.php');
session_start();

$_SESSION['user_id'] = null;
$_SESSION['user_name'] = null;
$_SESSION['user_email'] = null;

echo "<script>
window.location.href = '../login.php'; 
</script>";
exit;

$conn->close();
