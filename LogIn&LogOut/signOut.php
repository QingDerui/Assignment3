<?php
/**
 * Created by PhpStorm.
 * User: rose
 * Date: 12/28/2018
 * Time: 4:00 AM
 */

session_start();
unset($_SESSION['username']);

echo "<script>location.href='../Index/index.php'</script>";