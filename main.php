<?php
if (!isset($_SESSION['user'])) {
    //แสดงเมื่อไม่ได้ login
    include("welcome.php");
} else {
    // login แล้วให้แสดง feed
    include("feed.php");
}
?>