<?php
session_start();
echo "Logging you out please wait...."; 
session_destroy();
 header("location: /proj3_forum");
?>