<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My word list</title>

    <link rel="stylesheet" type="text/css" href="../css/uikit.css"/>
    <link rel="stylesheet" type="text/css" href="../css/components/sticky.css"/>
    <link rel="stylesheet" type="text/css" href="../css/uploadimage.css"/>
    <link rel="stylesheet" type="text/css" href="../css/selfdefined.css"/>
    <script src="../js/jquery-3.3.1.js"></script>
    <script src="../js/uikit.js"></script>
    <script src="../js/components/sticky.js"></script>
    <script src="../js/supportFunctions.js"></script>
    <script src="../js/mdui.min.js"></script>

    <?php

    session_start();

    unset($_SESSION['userExisted']);
    unset($_SESSION['userPass']);
    unset($_SESSION['signed']);
    unset($_SESSION['pwPass']);
    unset($_SESSION['nameNull']);

    require_once('../Models/Word.php');
    require_once('../DB/DB.php');
    require_once('../Models/User.php');

    DB_Controller::createConnection();

    if (isset($_SESSION['username'])) {
        $listArr = DB_Controller::getListNames_userList($_SESSION['username']);
    }
    DB_Controller::closeConnection();

    ?>

    <script>
        $(document).ready(function () {
            $("p.myGet").click(function () {
                $(this).parent().submit();
            });
        });
    </script>
</head>

<body>
<div class="uk-offcanvas" id="drawer">
    <div class="uk-offcanvas-bar uk-offcanvas-bar-show">
        <ul class="uk-nav uk-nav-offcanvas" data-uk-nav>
            <li style="text-align: center">
                <?php
                if (!(isset($_SESSION['username']) && !is_null($_SESSION['username']))) {
                    echo "<div class='contentDiv'>
                <img src='icons/userImageDef.jpg'/>
            </div>
            <br><br>

            <div style='position: relative;left:-45px;'>
                <a class='login' href='../LogIn&LogOut/login.php'>LogIn&LogOut</a>
            </div>

            <div style='position: relative;left: 145px;top:-23px;width:40px;'>
                <a class='login' href='../LogIn&LogOut/signUp.php'>Sign up</a>
            </div>

            <div style='position: relative;top:-46px;left:116px;width:5px;height:2px'>
                <p style='font-size: 20px;color:gainsboro'>|</p>
            </div>";
                } else {
                    echo "<div class='contentDiv'>
                <img src='icons/userImageDef.jpg'/>
            </div>
            <br><br>
            </li>
            
            <li class='uk-active' style='text-align: center;font-size:22px;font-family: \"Curlz MT\"'>
                <a>Guten Tag! Dear  " . $_SESSION['username'] . "</a>";
                }
                ?>
            </li>

            <li>
                <a href="../Review/review.php" class="">Review A1 words</a>
            </li>

            <li>
                <a href="../Upload/upload.php" class="">Upload Word List</a>
            </li>

            <li>
                <a href="../MyList/myWordList.php" class="">My Word List</a>
            </li>

            <li>
                <a href="../Index/index.php" class="">Homepage</a>
            </li>

        </ul>
    </div>
</div>
<nav class="uk-navbar">
    <div class="uk-container uk-container-center">
        <ul class="uk-navbar-nav">
            <li class="uk-parent" data-uk-dropdown aria-haspopup="true" aria-expanded="false">
                <a href="../Index/index.php"><i class="uk-icon-bars"></i> Words</a>
                <div class="uk-dropdown uk-dropdown-navbar">
                    <ul class="uk-nav uk-nav-navbar">
                        <li><a>Section 1</a></li>
                        <li><a>Section 2</a></li>
                        <li><a>Section 3</a></li>
                        <li><a>Section 4</a></li>
                        <li><a>Section 5</a></li>
                        <li><a>Section 6</a></li>
                        <li><a>Section 7</a></li>
                        <li><a>Section 8</a></li>
                        <li><a>Section 9</a></li>
                        <li><a>Section 10</a></li>
                        <li><a>Section 11</a></li>
                        <li><a>Section 12</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="../Review/review.php">Review</a></li>
            <li><a id="upload" <?php $login = isset($_SESSION["username"]) && !is_null($_SESSION["username"]);
            echo "onclick='checkLogin($login)'>Upload your own list</a></li>"; ?>
        </ul>
        <div class="uk-navbar-flip uk-hidden-small">
            <ul class="uk-navbar-nav">
                <?php
                if (isset($_SESSION['username']) && !is_null($_SESSION['username'])) {
                    echo "<li><a href='#drawer'data-uk-offcanvas >Hi! ".$_SESSION['username']."</li>";
                    echo "<li><a href='../LogIn&LogOut/signOut.php'>Sign out</a></li>";
                } else {
                    echo "<li><a href='../LogIn&LogOut/login.php'>LogIn&LogOut</a></li>";
                    echo "<li><a href='../LogIn&LogOut/signUp.php'>Sign up</a></li>";
                }

                ?>

            </ul>
        </div>
    </div>
</nav>

<div class="" style="margin-top: 50px;">
    <div class="uk-container uk-container-center">
        <div class="uk-grid uk-grid-divider">
            <aside class="uk-width-medium-1-4 uk-width-large-1-5 uk-hidden-small uk-margin-large-top">
                <div>
                    <div id="aside"
                         style='margin-top: 50px;max-height: 500px;overflow-y:hidden;' onmouseover="showScrollBar()"
                         onmouseleave="hideScrollBar()">

                        <?php
                        if (isset($_SESSION['username']) && !is_null($_SESSION['username']) === true) {
                            echo "<h5>Welcome! " . $_SESSION["username"] . "</h5>";
                        } else {
                            echo "
                            <p>Please <a href='../LogIn&LogOut/login.php'>login</a> to get your progress</p>
                               ";
                        }
                        ?>

                        <hr class='uk-grid-divider'>

                    </div>
                </div>
            </aside>
            <main role="main" class="uk-width-medium-3-4 uk-width-large-4-5 uk-width-small-1-1"
                  style="min-height: 800px">
                <div class="uk-grid">
                    <div class="uk-container-center uk-width-large-1-1">
                        <?php
                        echo "<h1>My Word List</h1>";
                        ?>
                    </div>
                </div>
                <div class="uk-margin-large-top">
                    <div class="uk-accordion" data-uk-accordion style="text-align: center" id="div_change">
                        <?php
                        if (!empty($listArr)) {
                            $a = 1;
                            foreach ($listArr as $name) {
                                echo "<a href=\"../MyWordList/checkUserList.php?listName=$name\"><h3 class=\"uk-accordion-title uk-active listNames\" id='" . $name . "'>" . $name . "</h3></a>";
                            }
                        } else {
                            echo "<h3 class=\"uk-accordion-title uk-active listNames\">No word list!";
                        }
                        ?>
                    </div>
                </div>


            </main>

        </div>
    </div>
</div>


<footer>
    <div style="background-color: #002833;height:200px;margin-top: 80px">
        <div class="uk-container uk-container-center uk-grid">
            <div class="uk-width-large-2-3 uk-margin-top">
                <span><h2 style="color:#748487">About</h2></span>
                <p style="color:#748487">The content of our websites are mainly referring the book "Netzwerk A1"</p>
                <p style="color:#748487">Authors: Qing Derui, Pan Xinyi, Wang Yuxuan</p>
            </div>
            <div class="uk-width-large-1-3 uk-margin-top">
                <span><h2 style="color:#748487">Contact us</h2></span>
                <p style="color:#748487">E-mail:574696335@qq.com</p>
            </div>
        </div>
    </div>
    <div style="background-color: #003038">
        <div class="uk-container uk-container-center">
            <div class="uk-margin-top"><p style="color:#748487">©2018 German Words. All rights reserved. </p></div>
        </div>
    </div>
</footer>


</body>

<script type="text/javascript">
    function showWordList(listname) {

        window.location.href("myWordList.php?listName=" + listname + "?");

    }
</script>
</html>