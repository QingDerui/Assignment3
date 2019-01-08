<!DOCTYPE HTML>
<?php session_start();
unset($_SESSION['userExisted']);
unset($_SESSION['userPass']);
unset($_SESSION['signed']);
unset($_SESSION['pwPass']);
unset($_SESSION['nameNull']);
require_once('Word.php');
require_once('DB.php');
require_once('User.php');

if (isset($_POST['section'])) {
    $section = $_POST['section'];
    $_SESSION['section'] = $section;
} else {
    if(isset($_SESSION['section'])) {

    }else{
        $_SESSION['section'] = '1';
    }
}

DB_Controller::createConnection();
if (isset($_SESSION['username'])) {

    if (isset($_POST['list']) && !is_null($_POST['list'])) {
        $trueList = strval(DB_Controller::getListNumber($_SESSION['username'], $_SESSION['section']));
        if($trueList == $_POST['list']){
            $_SESSION['newList'] = true;
        }else{
            $_SESSION['newList'] = false;
        }
        $_SESSION['list'] = $_POST['list'];
        $results = DB_Controller::getListWords($_SESSION['username'], $_SESSION['section'], $_SESSION['list']);
        foreach ($results as $result) {
            $words[] = $result[0];
            $statuses[] = $result[1];
        }

    } else {
        $_SESSION['newList'] = true;
        $_SESSION['list'] = DB_Controller::getListNumber($_SESSION['username'], $_SESSION['section']) + 1;
        $words = DB_Controller::getRandomList_signed($_SESSION['section'], $_SESSION['username'], $_SESSION['list']);
    }

} else {
    $words = DB_Controller::getRandomList_XSigned($_SESSION['section']);
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <link rel="stylesheet" type="text/css" href="css/uikit.css"/>
    <link rel="stylesheet" type="text/css" href="css/components/sticky.css"/>
    <link rel="stylesheet" type="text/css" href="css/components/accordion.css"/>
    <script src="jquery-3.3.1.js"></script>
    <script src="js/uikit.js"></script>
    <script src="js/components/sticky.js"></script>
    <script src="js/components/accordion.js"></script>
    <script src="supportFunctions.js"></script>
</head>
<body>
<nav class="uk-navbar">
    <div class="uk-container uk-container-center">
        <ul class="uk-navbar-nav">
            <li class="uk-parent" data-uk-dropdown aria-haspopup="true" aria-expanded="false">
                <a href="index.php"><i class="uk-icon-bars"></i> Words</a>
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
            <li><a href="">Review</a></li>
            <li><a href="">Upload your own list</a></li>
        </ul>
        <div class="uk-navbar-flip uk-hidden-small">
            <ul class="uk-navbar-nav">
                <?php
                if (isset($_SESSION['username']) && !is_null($_SESSION['username'])) {
                    echo "<li><a href='signOut.php'>Sign out</a></li>";
                } else {
                    echo "<li><a href='login.php'>Login</a></li>";
                    echo "<li><a href=\"signUp.php\">Sign up</a></li>";
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
                    <div id="aside" style='margin-top: 50px;max-height: 500px;overflow-y:hidden;' onmouseover="showScrollBar()" onmouseleave="hideScrollBar()">
                        <h3>Study progress:</h3>
                        <hr class='uk-grid-divider'>
                        <?php
                        if (isset($_SESSION['username']) && !is_null($_SESSION['username'])) {
                            $knowPer = round(DB_Controller::getRecognizedWordNumber($_SESSION['username'], $_SESSION['section']) / DB_Controller::getSectionWordNumber($_SESSION['section'] ) *100);
                            echo "
                                <div>
                                <p>Section " . $_SESSION['section'] . ":</p>
                                <div class='uk-progress uk-progress-striped' style='width: 120px'>
                                <div class='uk-progress-bar' style='width: " . $knowPer . "%;'>" . $knowPer . "%</div>
                                </div>
                                </div>";

                            echo "<h3>Your word lists:</h3>";
                            echo "<hr class='uk-grid-divider'>";
                            for ($i = 1; $i <= DB_Controller::getListNumber($_SESSION['username'], $_SESSION['section']); $i++) {
                                echo "<form id='form".$i."' action='memoryWords.php' method='post'>";
                                echo "<input type='hidden' name='list' value='".$i."'>";
                                echo "<a onclick='submitForm(".$i.")' >List " . $i . "</a><br>";
                                echo "</form>";
                            }

                        } else {
                            echo "
                            <p>Please <a href='login.php'>login</a> to get your progress</p>
                               ";
                        }
                        ?>
                    </div>
                </div>
            </aside>
            <main role="main" class="uk-width-medium-3-4 uk-width-large-4-5 uk-width-small-1-1"
                  style="min-height: 800px">
                <div class="uk-grid">
                    <div class="uk-container-center uk-width-large-1-1">
                        <?php
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
                        <form action="nextList.php" method="post">
                            <?php

                            $a = 1;

                            if(isset($words) && !is_null($words)) {
                                foreach ($words as $word) {
                                    echo "<h3 class=\"uk-accordion-title uk-active\">" . $word->getWordGer();
                                    if (isset($_SESSION['username'])) {
                                        if ($_SESSION['newList']) {
                                            echo "<div id='title" . $a . "' class=\"uk-badge uk-badge-danger uk-margin-large-left\">unknown</div>";
                                        } else {
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
                                        echo "<input name='status" . $a . "' type='hidden' id='status" . $a . "' value='0'>";
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
                                if($_SESSION['newList']){
                                    echo "<button type=\"submit\" value=\"\">New List</button>";
                                }
                            } else {
                                echo "<a class='uk-button' href='memoryWords.php'>Next List</a>";
                            }

                            }else{

                                echo "<div class=\" uk-text-large uk-text-success uk-margin-large-left\">Congratulations
! You have finish this section. Please return to the <a href='index.php'>main page</a> and start a new section!</div>";

                            }
                            ?>


                        </form>
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
                <span><h2 style="color:#748487">Ahout</h2></span>
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
<?php

DB_Controller::closeConnection();  // Close the connection

?>

</body>

</html>