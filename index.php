<!DOCTYPE HTML>
<?php session_start();

// This part is to release the information in the session
unset($_SESSION['userExisted']);  //Release the flag which name whether the user is existed when users sign in
unset($_SESSION['userPass']);  //Release the flag which name whether the username is correct when signing in.
unset($_SESSION['signed']);  //Release the flag which name whether the username has been registered.
unset($_SESSION['pwPass']);  //Release the flag which name whether two passwords are the same when registering.
unset($_SESSION['nameNull']); //Release the flag which name whether the registering name is null
require_once('Word.php');
require_once('DB.php');
require_once('User.php');
DB_Controller::createConnection();  // start DB connection
?>
<html lang="en">
<head>
    <meta charset="UTF-8"><title>Title</title>
    <link rel="stylesheet" type="text/css" href="css/uikit.css" />
    <link rel="stylesheet" type="text/css" href="css/components/sticky.css" />
    <script src="jquery-3.3.1.js"></script>
    <script src="js/uikit.js"></script>
    <script src="js/components/sticky.js"></script>
    <script src="supportFunctions.js"></script>
</head>
<body>
<!--Navigation bar-->
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

                    // If the user has logged in then there is no need to show login or sign in button, replace them by sign out button
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
<!--End of navigation bar-->
<!--Body part-->
<div class="" style="margin-top: 50px;">
    <div class="uk-container uk-container-center">
        <div class="uk-grid uk-grid-divider">
<!--            Side navigation of body part-->
            <aside class="uk-width-medium-1-4 uk-width-large-1-5 uk-hidden-small uk-margin-large-top">
                <div>
                    <div id='aside' class='uk-panel' style='margin-top: 50px;max-height: 500px;overflow-y:hidden;' onmouseover="showScrollBar()" onmouseleave="hideScrollBar()">
                        <h3>Study progress:</h3>
                        <hr class='uk-grid-divider'>
                <?php
                // This part is to show the learning progress of each section
                if(isset($_SESSION['username']) && !is_null($_SESSION['username'])){
                    for($i = 1;$i<=6;$i++) {
                        $sectionWords = DB_Controller::getSectionWordNumber(strval($i)); // Get the number of words of a certain section
                        $knownWords = DB_Controller::getRecognizedWordNumber($_SESSION['username'],strval($i));
                        $progress = round($knownWords/$sectionWords * 100);
                        echo "<div>";
                        echo "<p>Section ".$i.":</p>";
                        echo "<div class='uk-progress uk-progress-striped' style='width: 120px'>";
                        echo "<div class='uk-progress-bar' style='width: ".$progress."%;'>".$progress."%</div>";
                        echo "</div></div>";
                    }


                }else{
                    echo"
                    <p>Please <a href='login.php'>login</a> to get your progress</p>
                    ";
                }
                ?>
                    </div>
                </div>
            </aside>
<!--            End of the side navigation-->
<!--            Main part-->
            <main role="main" class="uk-width-medium-3-4 uk-width-large-4-5 uk-width-small-1-1 ">
                <div class="uk-grid">
                    <div class="uk-container-center uk-width-large-2-3">
                    <h1>Welcome to xxx!</h1>
                    </div>

                </div>
                <ul class="uk-grid uk-grid-width-small-1-2 uk-grid-width-medium-1-2 uk-grid-width-large-1-3" data-uk-grid-margin="">
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="gutenTag.jpg" alt="Guten Tag!">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <form action="memoryWords.php" method="get">
                                    <input type="hidden" name="section" value="1">
                                    <button type="submit" class="uk-button uk-button-primary" style="margin-top: 30%;margin-left:26%">Learn it now!</button>
                                </form>
                            </div>
                        </figure>
                        <p class="uk-text-center">Section 1:Guten Tag!</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="gutenTag.jpg" alt="Guten Tag!" width="300" height="250">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <form action="memoryWords.php" method="get">
                                    <input type="hidden" name="section" value="2">
                                    <button type="submit" class="uk-button uk-button-primary" style="margin-top: 30%;margin-left:26%">Learn it now!</button>
                                </form>
                            </div>
                        </figure>
                        <p class="uk-text-center">Section 2:Freunde, Kollegen und ich</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="gutenTag.jpg" alt="Guten Tag!" width="300" height="250">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <form action="memoryWords.php" method="get">
                                    <input type="hidden" name="section" value="3">
                                    <button type="submit" class="uk-button uk-button-primary" style="margin-top: 30%;margin-left:26%">Learn it now!</button>
                                </form>
                            </div>
                        </figure>
                        <p class="uk-text-center">Section 3:In der Stadt</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="gutenTag.jpg" alt="Guten Tag!" width="300" height="250">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <form action="memoryWords.php" method="get">
                                    <input type="hidden" name="section" value="4">
                                    <button type="submit" class="uk-button uk-button-primary" style="margin-top: 30%;margin-left:26%">Learn it now!</button>
                                </form>
                            </div>
                        </figure>
                        <p class="uk-text-center">Section 4:Guten Appetit!</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="gutenTag.jpg" alt="Guten Tag!" width="300" height="250">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <form action="memoryWords.php" method="get">
                                    <input type="hidden" name="section" value="5">
                                    <button type="submit" class="uk-button uk-button-primary" style="margin-top: 30%;margin-left:26%">Learn it now!</button>
                                </form>
                            </div>
                        </figure>
                        <p class="uk-text-center">Section 5:Tag für Tag</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="gutenTag.jpg" alt="Guten Tag!" width="300" height="250">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <form action="memoryWords.php" method="get">
                                    <input type="hidden" name="section" value="6">
                                    <button type="submit" class="uk-button uk-button-primary" style="margin-top: 30%;margin-left:26%">Learn it now!</button>
                                </form>
                            </div>
                        </figure>
                        <p class="uk-text-center">Section 6:Zeit mit Freunden</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="gutenTag.jpg" alt="Guten Tag!" width="300" height="250">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <form action="memoryWords.php" method="get">
                                    <input type="hidden" name="section" value="7">
                                    <button type="submit" class="uk-button uk-button-primary" style="margin-top: 30%;margin-left:26%">Learn it now!</button>
                                </form>
                            </div>
                        </figure>
                        <p class="uk-text-center">Section 7:Kontakte</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="gutenTag.jpg" alt="Guten Tag!" width="300" height="250">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <form action="memoryWords.php" method="get">
                                    <input type="hidden" name="section" value="8">
                                    <button type="submit" class="uk-button uk-button-primary" style="margin-top: 30%;margin-left:26%">Learn it now!</button>
                                </form>
                            </div>
                        </figure>
                        <p class="uk-text-center">Section 8:Meine Wohnung</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="gutenTag.jpg" alt="Guten Tag!" width="300" height="250">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <form action="memoryWords.php" method="get">
                                    <input type="hidden" name="section" value="9">
                                    <button type="submit" class="uk-button uk-button-primary" style="margin-top: 30%;margin-left:26%">Learn it now!</button>
                                </form>
                            </div>
                        </figure>
                        <p class="uk-text-center">Section 9:Alles Arbeit?</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="gutenTag.jpg" alt="Guten Tag!" width="300" height="250">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <form action="memoryWords.php" method="get">
                                    <input type="hidden" name="section" value="10">
                                    <button type="submit" class="uk-button uk-button-primary" style="margin-top: 30%;margin-left:26%">Learn it now!</button>
                                </form>
                            </div>
                        </figure>
                        <p class="uk-text-center">Section 10:Kleidung und Mode</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="gutenTag.jpg" alt="Guten Tag!" width="300" height="250">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <form action="memoryWords.php" method="get">
                                    <input type="hidden" name="section" value="11">
                                    <button type="submit" class="uk-button uk-button-primary" style="margin-top: 30%;margin-left:26%">Learn it now!</button>
                                </form>
                            </div>
                        </figure>
                        <p class="uk-text-center">Section 11:Gesund und munter</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="gutenTag.jpg" alt="Guten Tag!" width="300" height="250">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <form action="memoryWords.php" method="get">
                                    <input type="hidden" name="section" value="12">
                                    <button type="submit" class="uk-button uk-button-primary" style="margin-top: 30%;margin-left:26%">Learn it now!</button>
                                </form>
                            </div>
                        </figure>
                        <p class="uk-text-center">Section 12:Ab in den Urlaub!</p>
                    </li>
                </ul>

            </main>
<!--            End of main part-->

        </div>
    </div>
</div>
<!--End of body part-->
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
DB_Controller::closeConnection(); // Close DB connection

?>
</body>
</html>