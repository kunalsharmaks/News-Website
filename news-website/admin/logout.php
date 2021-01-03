<?php
include "config.php";
session_start();
session_unset();
session_destroy();
header("Location: http://localhost/news-website/admin/");
?>