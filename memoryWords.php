<!DOCTYPE HTML>
<?php session_start();
unset($_SESSION['userExisted']);
unset($_SESSION['userPass']);
unset($_SESSION['signed']);
unset($_SESSION['pwPass']);
unset($_SESSION['nameNull']);
require_once ('Word.php');
require_once ('DB.php');
require_once ('User.php');
?>
<html lang="en">
<head>
    <meta charset="UTF-8"><title>Title</title>

    <link rel="stylesheet" type="text/css" href="css/uikit.css" />
    <link rel="stylesheet" type="text/css" href="css/components/sticky.css" />
    <link rel="stylesheet" type="text/css" href="css/components/accordion.css" />
    <script src="jquery-3.3.1.js"></script>
    <script src="js/uikit.js"></script>
    <script src="js/components/sticky.js"></script>
    <script src="js/components/accordion.js"></script>
</head>
<body>
<nav class="uk-navbar">
    <div class="uk-container uk-container-center">
        <ul class="uk-navbar-nav">
            <li class="uk-parent" data-uk-dropdown aria-haspopup="true" aria-expanded="false" >
                <a href="index.php"><i class="uk-icon-bars"></i>  Words</a>
                <div class="uk-dropdown uk-dropdown-navbar" >
                    <ul class="uk-nav uk-nav-navbar" >
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
                if(isset($_SESSION['username']) && !is_null($_SESSION['username'])){
                    echo "<li><a href='signOut.php'>Sign out</a></li>";
                }else{
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
            <aside class="sidebar uk-width-medium-1-4 uk-width-large-1-6 uk-hidden-small uk-margin-large-top">
                <div class='uk-sticky-placeholder'>
                    <div class='uk-panel' data-uk-sticky='{top:50}' style='margin-top: 50px'>
                        <h3>Study progress:</h3>
                        <hr class='uk-grid-divider'>
                        <?php
                        if(isset($_SESSION['username']) && !is_null($_SESSION['username'])){
                            echo "
                    <div>
                    <p>Section 1:</p>
                    <div class='uk-progress uk-progress-striped'>
                    <div class='uk-progress-bar' style='width: 40%;'>40%</div>
                    </div>
                    </div>";


                        }else{
                            echo"
                    <p>Please <a href='login.php'>login</a> to get your progress</p>
                    ";
                        }
                        ?>
                    </div>
                </div>
            </aside>
            <main role="main" class="uk-width-medium-3-4 uk-width-large-5-6 uk-width-small-1-1" style="min-height: 800px">
                <div class="uk-grid">
                    <div class="uk-container-center uk-width-large-1-1">
                        <h1>Section 1: List1</h1>
                    </div>
                </div>
                <div class="uk-margin-large-top">
                    <div class="uk-accordion" data-uk-accordion>
                        <?php
                        DB_Controller::createConnection();
                        $words = DB_Controller::getRandomList_XSigned('1');
                        foreach ($words as $word){
                            echo "<h3 class=\"uk-accordion-title uk-active\">".$word->getWordGer()."</h3>";
                            echo "<div class=\"uk-accordion-content uk-text-large\">";
                            echo "<div class='uk-grid'><div  class='uk-grid-width-1-3' style='width:20%'>";
                            echo $word->getGenus();
                            echo "</div>";
                            echo "<div  class='uk-grid-width-1-3' style='width:33%'>";
                            echo $word->getWordEng();
                            echo "</div>";
                            echo "<div  class='uk-grid-width-1-3' style='width:30%'>";
                            echo "<button class='uk-button-primary' type='button'>Know</button>";
                            echo "<button class='uk-button-primary uk-margin-small-left' type='button'>Unknown</button>";
                            echo "</div></div>";
                            echo "<div class='uk-margin-top'><h3>Example:</h3>";
                            echo "<p>".$word->getExample()."</p></div>";
                            echo "</div>";
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