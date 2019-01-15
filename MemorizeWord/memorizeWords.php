<!DOCTYPE HTML>
<?php session_start();

// Release the flags
unset($_SESSION['userExisted']);
unset($_SESSION['userPass']);
unset($_SESSION['signed']);
unset($_SESSION['pwPass']);
unset($_SESSION['nameNull']);

require_once('../Models/Word.php');
require_once('../DB/DB.php');
require_once('../Models/User.php');

$_SESSION['noMoreStatus'] = true;
// Get the current section or give section a certain content.
if (isset($_GET['section'])) {
    $section = $_GET['section'];
    $_SESSION['section'] = $section;
} else {
    if (isset($_SESSION['section'])) {

    } else {
        $_SESSION['section'] = '1';
    }
}

DB_Controller::createConnection(); // DB connection


// This part of coding decides which words to take out from the DB
if (isset($_SESSION['username'])) { // Test whether a user has logged in.

    if (isset($_GET['list']) && !is_null($_GET['list'])) { // Test if there is something posted

        //If the list has been posted, get the list number and show the list

        $trueList = strval(DB_Controller::getListNumber($_SESSION['username'], $_SESSION['section']));// Get the total list number

        //If this is the newest list, show the "nextList" button
        if ($trueList == $_GET['list']) {
            $_SESSION['newList'] = true;
            $_SESSION['noMoreStatus'] = false;
        } else {
            $_SESSION['newList'] = false;
        }

        $_SESSION['list'] = $_GET['list']; //Store the list number flag

        // Get the certain list from the DB
        $results_Link = DB_Controller::getListWords($_SESSION['username'], $_SESSION['section'], $_SESSION['list']);
        foreach ($results_Link as $result) {
            $words[] = $result[0];
            $statuses[] = $result[1];
        }

    } else {


        // If the user enter this page from the main page, the displayed list will be the newest list of that section. If there is no list, a new list will be created and shown.
        $_SESSION['newList'] = true;
        $listNumber = strval(DB_Controller::getListNumber($_SESSION['username'], $_SESSION['section']));

        if ($listNumber == '0') {
            // If it is the newest list, than get a random list from the unfamiliar word library
            $_SESSION['list'] = DB_Controller::getListNumber($_SESSION['username'], $_SESSION['section']) + 1;
            $words = DB_Controller::getRandomList_signed($_SESSION['section'], $_SESSION['username'], $_SESSION['list']);
        } else {


            if (isset($_SESSION['goToNextList']) && $_SESSION['goToNextList']) {
                $_SESSION['list'] = DB_Controller::getListNumber($_SESSION['username'], $_SESSION['section']) + 1;
                $words = DB_Controller::getRandomList_signed($_SESSION['section'], $_SESSION['username'], $_SESSION['list']);
            } else {
                $_SESSION['list'] = $listNumber;
                $_SESSION['noMoreStatus'] = false;
                $results_Initial = DB_Controller::getListWords($_SESSION['username'], $_SESSION['section'], $_SESSION['list']);

                foreach ($results_Initial as $result) {
                    $words[] = $result[0];
                    $statuses[] = $result[1];
                }
            }

        }
    }

} else {
    //If no user has logged in, show a random list
    $words = DB_Controller::getRandomList_XSigned($_SESSION['section']);
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <link rel="stylesheet" type="text/css" href="../css/uikit.css"/>
    <link rel="stylesheet" type="text/css" href="../css/components/sticky.css"/>
    <link rel="stylesheet" type="text/css" href="../css/components/accordion.css"/>
    <link rel="stylesheet" type="text/css" href="../css/uploadimage.css"/>
    <link rel="stylesheet" type="text/css" href="../css/selfdefined.css"/>
    <script src="../js/jquery-3.3.1.js"></script>
    <script src="../js/uikit.js"></script>
    <script src="../js/components/sticky.js"></script>
    <script src="../js/components/accordion.js"></script>
    <script src="../js/supportFunctions.js"></script>
</head>
<body>
<!--Drawer bar-->
<div class="uk-offcanvas" id="drawer">
    <div class="uk-offcanvas-bar uk-offcanvas-bar-show">
        <ul class="uk-nav uk-nav-offcanvas" data-uk-nav>
            <li style="text-align: center">
                <?php
                if (!(isset($_SESSION['username']) && !is_null($_SESSION['username']))) {
                    echo "<div class='contentDiv'>
                <img title='dAKirby309, http://www.iconarchive.com/show/windows-8-metro-icons-by-dakirby309/Folders-OS-User-No-Frame-Metro-icon.html, last access data 14.01.2019 ' src='../icons/userImageDef.jpg'/>
            </div>
            <br><br>

            <div style='position: relative;left:-45px;'>
                <a class='login' href='../LogIn&LogOut/login.php'>Login</a>
            </div>

            <div style='position: relative;left: 145px;top:-23px;width:40px;'>
                <a class='login' href='../LogIn&LogOut/signUp.php'>Sign up</a>
            </div>

            <div style='position: relative;top:-46px;left:116px;width:5px;height:2px'>
                <p style='font-size: 20px;color:gainsboro'>|</p>
            </div>";
                } else {
                    echo "<div class='contentDiv'>
                <img title='dAKirby309, http://www.iconarchive.com/show/windows-8-metro-icons-by-dakirby309/Folders-OS-User-No-Frame-Metro-icon.html, last access data 14.01.2019 ' src='../icons/userImageDef.jpg'/>
            </div>
            <br><br>
            </li>
            
            <li class='uk-active' style='text-align: center;font-size:22px;font-family: \"Curlz MT\"'>
                <a>Guten Tag! Dear  " . $_SESSION['username'] . "</a>";
                }
                ?>
            </li>

            <li>
                <a href="../Review/review.php">Review A1 words</a>
            </li>

            <li>
                <a href="../Upload/upload.php">Upload Word List</a>
            </li>

            <li>
                <a href="../MyList/myWordList.php">My Word List</a>
            </li>

            <li>
                <a href="../Index/index.php">Homepage</a>
            </li>

        </ul>
    </div>
</div>
<!--End of drawer bar-->
<!--The navigation bar-->
<nav class="uk-navbar">
    <div class="uk-container uk-container-center">
        <ul class="uk-navbar-nav">
            <li class="uk-parent" data-uk-dropdown aria-haspopup="true" aria-expanded="false">
                <a href="../Index/index.php"><i class="uk-icon-bars"></i> Words</a>
                <div class="uk-dropdown uk-dropdown-navbar">
                    <ul class="uk-nav uk-nav-navbar">
                        <li><a href="../MemorizeWord/memorizeWords.php?section=1">Section 1</a></li>
                        <li><a href="../MemorizeWord/memorizeWords.php?section=2">Section 2</a></li>
                        <li><a href="../MemorizeWord/memorizeWords.php?section=3">Section 3</a></li>
                        <li><a href="../MemorizeWord/memorizeWords.php?section=4">Section 4</a></li>
                        <li><a href="../MemorizeWord/memorizeWords.php?section=5">Section 5</a></li>
                        <li><a href="../MemorizeWord/memorizeWords.php?section=6">Section 6</a></li>
                        <li><a href="../MemorizeWord/memorizeWords.php?section=7">Section 7</a></li>
                        <li><a href="../MemorizeWord/memorizeWords.php?section=8">Section 8</a></li>
                        <li><a href="../MemorizeWord/memorizeWords.php?section=9">Section 9</a></li>
                        <li><a href="../MemorizeWord/memorizeWords.php?section=10">Section 10</a></li>
                        <li><a href="../MemorizeWord/memorizeWords.php?section=11">Section 11</a></li>
                        <li><a href="../MemorizeWord/memorizeWords.php?section=12">Section 12</a></li>
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
                // Show the interface depending on user
                if (isset($_SESSION['username']) && !is_null($_SESSION['username'])) {
                    echo "<li><a href='#drawer'data-uk-offcanvas >Hi! " . $_SESSION['username'] . "</li>";
                    echo "<li><a href='../LogIn&LogOut/signOut.php'>Sign out</a></li>";
                } else {
                    echo "<li><a href='../LogIn&LogOut/login.php'>Login</a></li>";
                    echo "<li><a href='../LogIn&LogOut/signUp.php'>Sign up</a></li>";
                }

                ?>

            </ul>
        </div>
    </div>
</nav>
<!--End of navigation part-->
<!--Body Part-->
<div class="" style="margin-top: 50px;">
    <div class="uk-container uk-container-center">
        <div class="uk-grid uk-grid-divider">
            <!--            Side navigation part-->
            <aside class="uk-width-medium-1-4 uk-width-large-1-5 uk-hidden-small uk-margin-large-top">
                <div>
                    <div id="aside" style='margin-top: 50px;max-height: 500px;overflow-y:hidden;'
                         onmouseover="showScrollBar()" onmouseleave="hideScrollBar()">
                        <h3>Study progress:</h3>
                        <hr class='uk-grid-divider'>
                        <?php
                        //Show the progress of the current section
                        if (isset($_SESSION['username']) && !is_null($_SESSION['username'])) {
                            // Show the progress bar when user has logged in
                            $knowPer = round(DB_Controller::getRecognizedWordNumber($_SESSION['username'], $_SESSION['section']) / DB_Controller::getSectionWordNumber($_SESSION['section']) * 100);
                            echo "
                                <div>
                                <p>Section " . $_SESSION['section'] . ":</p>
                                <div class='uk-progress uk-progress-striped' style='width: 120px'>
                                <div class='uk-progress-bar' style='width: " . $knowPer . "%;'>" . $knowPer . "%</div>
                                </div>
                                </div>";

                            echo "<h3>Your word lists:</h3>";
                            echo "<hr class='uk-grid-divider'>";
                            // Show all links of the existed list
                            for ($i = 1; $i <= DB_Controller::getListNumber($_SESSION['username'], $_SESSION['section']); $i++) {
                                echo "<form id='form" . $i . "' action='memorizeWords.php' method='get'>";
                                echo "<input type='hidden' name='list' value='" . $i . "'>";
                                echo "<a onclick='submitForm(" . $i . ")' >List " . $i . "</a><br>";
                                echo "</form>";
                            }

                        } else {
                            echo "
                            <p>Please <a href='../LogIn&LogOut/login.php'>login</a> to get your progress</p>
                               ";
                        }
                        ?>
                    </div>
                </div>
            </aside>
            <!--            End of side navigation-->
            <!--            Main part-->
            <main role="main" class="uk-width-medium-3-4 uk-width-large-4-5 uk-width-small-1-1"
                  style="min-height: 800px">
                <div class="uk-grid">
                    <div class="uk-container-center uk-width-large-1-1">
                        <?php
                        // Display the title depend on logging status
                        echo "<h1>Section " . $_SESSION['section'];
                        if (isset($_SESSION['username']) && !is_null($_SESSION['username'])) {
                            echo ": List " . $_SESSION['list'] . "<h1>";
                        } else {
                            echo ": Random List<h1>";
                        }
                        ?>
                    </div>
                </div>
                <div class="uk-margin-large-top">
                    <div class="uk-accordion" data-uk-accordion>
                        <form action="nextList.php" method="get">
                            <?php

                            $a = 1;

                            // Show the words of the list
                            if (isset($words) && !is_null($words)) {
                                foreach ($words as $word) {
                                    echo "<h3 class=\"uk-accordion-title uk-active\">" . $word->getWordGer();
                                    if (isset($_SESSION['username'])) {
                                        if ($_SESSION['newList']) {
                                            if ($_SESSION['noMoreStatus']) {
                                                echo "<div id='title" . $a . "' class=\"uk-badge uk-badge-danger uk-margin-large-left\">unknown</div>";
                                            }else{

                                                if ($statuses[$a - 1]) {
                                                    echo "<div id='title" . $a . "' class=\"uk-badge uk-badge-success uk-margin-large-left\">know</div>";
                                                } else {
                                                    echo "<div id='title" . $a . "' class=\"uk-badge uk-badge-danger uk-margin-large-left\">unknown</div>";

                                                }

                                            }
                                        }
                                        else {
                                        if ($statuses[$a - 1]) {
                                            echo "<div id='title" . $a . "' class=\"uk-badge uk-badge-success uk-margin-large-left\">know</div>";
                                        } else {
                                            echo "<div id='title" . $a . "' class=\"uk-badge uk-badge-danger uk-margin-large-left\">unknown</div>";

                                        }

                                        }

                                    }
                                    echo "</h3>";
                                    echo "<div class=\"uk-accordion-content uk-text-large\">";
                                    echo "<div class='uk-grid'><div  class='uk-grid-width-1-3' style='width:20%'>";
                                    echo $word->getGenus();
                                    echo "</div>";
                                    echo "<div  class='uk-grid-width-1-3' style='width:33%'>";
                                    echo $word->getWordEng();
                                    echo "</div>";
                                    if (isset($_SESSION['username'])) {

                                            echo "<div  class='uk-grid-width-1-3' style='width:30%'>";
                                            echo "<input name='" . $a . "' type='hidden' value='" . $word->getWordID() . "'>";
                                        if($_SESSION['noMoreStatus']) {
                                            echo "<input name='status" . $a . "' type='hidden' id='status" . $a . "' value='0'>";
                                        }else{
                                            echo "<input name='status" . $a . "' type='hidden' id='status" . $a . "' value='".$statuses[$a - 1]."'>";
                                        }
                                        if ($_SESSION['newList']) {
                                            echo "<button id='know" . $a . "' class='uk-button-success' type='button' onclick='showStatus_Know(" . $a . ")'>Know</input>";
                                            echo "<button id='unknow" . $a . "' class='uk-button-danger uk-margin-small-left' type='button' onclick='showStatus_Unknown(" . $a . ")' >Unknown</input>";
                                        }
                                        echo "</div>";
                                    }
                                    echo "</div>";
                                    echo "<div class='uk-margin-top'><h3>Example:</h3>";
                                    echo "<p>" . $word->getExample() . "</p></div>";
                                    echo "</div>";
                                    $a++;
                                }


                                if (isset($_SESSION['username'])) {
                                    if ($_SESSION['newList']) {
                                        echo "<button type=\"submit\" value=\"\">New List</button>";
                                    }
                                } else {
                                    echo "<a class='uk-button' href='memorizeWords.php'>Next List</a>";
                                }

                            } else {

                                echo "> Congratulations
! You have finish this section. Please return to the <a href='../Index/index.php'>main page</a> and start a new section!</div>";

                            }
                            ?>


                        </form>
                    </div>
                </div>


            </main>
            <!--            End of the main part-->
        </div>
    </div>
</div>
<!--End of the body part-->
<footer>
    <div style="background-color: #002833;height:200px;margin-top: 80px">
        <div class="uk-container uk-container-center uk-grid">
            <div class="uk-width-large-2-3 uk-margin-top">
                <span><h2 style="color:#748487">About</h2></span>
                <p style="color:#748487">Authors: Qing Derui, Pan Xinyi, Wang Yuxuan</p>
                <p style="color:#748487">The content of our websites is mainly referring this book: Dengler, S., Rusch,
                    P., Schmitz, H. and Sieber, T. (2012). Netzwerk. München: Langenscheidt.</p>
            </div>
            <div class="uk-width-large-1-3 uk-margin-top">
                <span><h2 style="color:#748487">Contact us</h2></span>
                <p style="color:#748487">E-mail: derui.qing@th-luebeck.de</p>
            </div>
        </div>
    </div>
    <div style="background-color: #003038">
        <div class="uk-container uk-container-center">
            <div class="uk-margin-top"><p style="color:#748487">©2018 German Words. All rights reserved. </p></div>
        </div>
    </div>
</footer>
<?php
unset($_SESSION['goToNextList']); // Release the flag
DB_Controller::closeConnection();  // Close the connection

?>

</body>

</html>