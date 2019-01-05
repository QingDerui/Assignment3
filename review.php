<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Review</title>

    <link rel="stylesheet" type="text/css" href="css/uikit.css"/>
    <link rel="stylesheet" type="text/css" href="css/components/sticky.css"/>
    <script src="jquery-3.3.1.js"></script>
    <script src="js/uikit.js"></script>
    <script src="js/components/sticky.js"></script>
    <script src="supportFunctions.js"></script>

    <?php

    session_start();

    unset($_SESSION['userExisted']);
    unset($_SESSION['userPass']);
    unset($_SESSION['signed']);
    unset($_SESSION['pwPass']);
    unset($_SESSION['nameNull']);

    require_once('Word.php');
    require_once('DB.php');
    require_once('User.php');

    if (!empty($_GET['section'])) {
        $section = $_GET['section'];
        $_SESSION['section'] = $section;
    } else {
        $section = '1';
        $_SESSION['section'] = $section;
    }

    DB_Controller::createConnection();
    if (isset($_SESSION['username'])) {
        $results = DB_Controller::getLearnedWords($_SESSION['username'], $_SESSION['section']);
        if (!empty($results)) {
            foreach ($results as $result) {
                $words[] = $result[0];
                $statuses[] = $result[1];
            }
        } else {
        }
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
            <li><a href="review.php">Review</a></li>
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
                <div class='uk-sticky-placeholder'>
                    <div id="aside" class='uk-panel' data-uk-sticky='{top:50}'
                         style='margin-top: 50px;max-height: 500px;overflow-y:hidden;' onmouseover="showScrollBar()"
                         onmouseleave="hideScrollBar()">
                        <h3>Study progress:</h3>
                        <hr class='uk-grid-divider'>
                        <?php
                        // logged in user
                        if (isset($_SESSION['username']) && !is_null($_SESSION['username'])) {
                            // section 8-12 are still not ready
                            for ($i = 1; $i <= 7; $i++) {
                                DB_Controller::createConnection();
                                $sectionWords = DB_Controller::getSectionWordNumber(strval($i));
                                $knownWords = DB_Controller::getRecognizedWordNumber($_SESSION['username'], strval($i));
                                $progress = round($knownWords / $sectionWords * 100);
                                echo "<div>";
                                echo "<form method='get' action='review.php'>";
                                echo "<input name='section' hidden value='$i'>";
                                echo "<p class='myGet' style='cursor: pointer;'>Section " . $i . ":</p>";
                                echo "</form>";
                                echo "<div class='uk-progress uk-progress-striped' style='width: 120px'>";
                                echo "<div class='uk-progress-bar' style='width: " . $progress . "%;'>" . $progress . "%</div>";
                                echo "</div></div>\n";
                            }
                            // not logged in
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
                        echo "<h1>Reviewing</h1>";
                        ?>
                    </div>
                </div>
                <div class="uk-margin-large-top">
                    <div class="uk-accordion" data-uk-accordion>
                        <form action="nextList.php" method="post">
                            <?php
                            if (!empty($words)) {
                                $a = 1;
                                foreach ($words as $word) {
                                    echo "<h3 class=\"uk-accordion-title uk-active\">" . $word->getWordGer();
                                    if (isset($_SESSION['username'])) {
                                        if ($statuses[$a - 1]) {
                                            echo "<div id='title" . $a . "' class=\"uk-badge uk-badge-success uk-margin-large-left\">know</div>";
                                        } else {
                                            echo "<div id='title" . $a . "' class=\"uk-badge uk-badge-danger uk-margin-large-left\">unknown</div>";
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
                                        echo "</div>";
                                    }
                                    echo "</div>";
                                    echo "<div class='uk-margin-top'><h3>Example:</h3>";
                                    echo "<p>" . $word->getExample() . "</p></div>";
                                    echo "</div>";
                                    $a++;
                                }
                            } else {
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


</body>
</html>