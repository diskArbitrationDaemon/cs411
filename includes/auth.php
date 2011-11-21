<?php
$redirect_pauseTime = 0;
if(empty($_SESSION['username'])) 
        print("<meta http-equiv=\"REFRESH\" content=\"". $redirect_pauseTime . ";url=login.html?notLoggedIn=1\">");

?>
