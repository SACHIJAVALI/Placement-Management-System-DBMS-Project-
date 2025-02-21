<?php 
session_start();
session_destroy();
header("Location: /placement-portal/index.php");
