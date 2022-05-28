<?php
session_start();
session_destroy();
header('Location: http://localhost/neotica-V1.0/index.php');
exit();
