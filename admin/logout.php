<?php
require_once '../includes/config.php';

// Destroy session and redirect
session_destroy();
header('Location: login.php');
exit;
?>
