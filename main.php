<?php
if (!isset($_SESSION['user'])) {
    include("welcome.php");
} else {
    include("feed.php");
}
?>