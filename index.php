<!DOCTYPE HTML>
<?php session_start();
 $_SESSION['username']='1';
?>
<html lang="en">
<head>
    <meta charset="UTF-8"><title>Title</title>

    <link rel="stylesheet" type="text/css" href="css/uikit.css" />
    <link rel="stylesheet" type="text/css" href="css/components/sticky.css" />
    <link rel="stylesheet" type="text/css" href="css/mdui.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/uploadimage.css"/>
    <link rel="stylesheet" type="text/css" href="css/selfdefined.css"/>
    <script src="jquery-3.3.1.js"></script>
    <script src="js/uikit.js"></script>
    <script src="js/components/sticky.js"></script>
    <script src="js/mdui.min.js"></script>
</head>

<body class="mdui-drawer-body-left">

<div class="mdui-drawer" id="drawer">
    <ul class="mdui-list">
        <li style="text-align: center">
            <div class="contentDiv">
                <img src="icons/userImageDef.jpg" />
            </div>
            <br><br>

            <div style="position: relative;left:-45px;">
                <a class="login" href="login.php">Login</a>
            </div>

            <div style="position: relative;left: 145px;top:-23px;width:40px;">
                <a class="login" href="signUp.php">Sign up</a>
            </div>

            <div style="position: relative;top:-46px;left:116px;width:5px;height:2px">
                <p style="font-size: 20px;color:gainsboro">|</p>
            </div>
        </li>
        <li class="mdui-subheader">Lists</li>
        <li class="mdui-list-item mdui-ripple">
            <div class="mdui-list-item-content"><a class="list-family">Account</a></div>
        </li>
        <li class="mdui-list-item mdui-ripple">
            <div class="mdui-list-item-content"><a class="list-family">LearningXXX</a></div>
        </li>
        <li class="mdui-list-item mdui-ripple">
            <div class="mdui-list-item-content"><a class="list-family">My Word List</a></div>
        </li>
        <li class="mdui-list-item mdui-ripple">
            <div class="mdui-list-item-content"><a class="list-family">Contact</a></div>
        </li>
    </ul>
</div>

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
                <li>
                    <div class="mdui-container" style="position: absolute;top:10px;right:120px;">
                        <button id="toggle" class="mdui-btn mdui-color-pink-accent mdui-m-a-1">Your Account</button>
                    </div>
                </li>
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
                if(isset($_SESSION['username'])){
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
            <main role="main" class="uk-width-medium-3-4 uk-width-large-5-6 uk-width-small-1-1 ">
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
                                <button class="uk-button uk-button-primary" style="margin-top: 30%;margin-left:26%">Learn it now!</button>
                            </div>
                        </figure>
                        <p class="uk-text-center">Section 1:Guten Tag!</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="gutenTag.jpg" alt="Guten Tag!" width="300" height="250">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <button class="uk-button uk-button-primary" style="margin-top: 30%;margin-left:26%">Learn it now!</button>
                            </div>
                        </figure>
                        <p class="uk-text-center">Section 2:Freunde, Kollegen und ich</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="gutenTag.jpg" alt="Guten Tag!" width="300" height="250">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <button  class="uk-button uk-button-primary" style="margin-top: 30%;margin-left:26%">Learn it now!</button>
                            </div>
                        </figure>
                        <p class="uk-text-center">Section 3:In der Stadt</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="gutenTag.jpg" alt="Guten Tag!" width="300" height="250">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <button class="uk-button uk-button-primary" style="margin-top: 30%;margin-left:26%">Learn it now!</button>
                            </div>
                        </figure>
                        <p class="uk-text-center">Section 4:Guten Appetit!</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="gutenTag.jpg" alt="Guten Tag!" width="300" height="250">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <button class="uk-button uk-button-primary" style="margin-top: 30%;margin-left:26%">Learn it now!</button>
                            </div>
                        </figure>
                        <p class="uk-text-center">Section 5:Tag für Tag</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="gutenTag.jpg" alt="Guten Tag!" width="300" height="250">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <button class="uk-button uk-button-primary" style="margin-top: 30%;margin-left:26%">Learn it now!</button>
                            </div>
                        </figure>
                        <p class="uk-text-center">Section 6:Zeit mit Freunden</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="gutenTag.jpg" alt="Guten Tag!" width="300" height="250">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <button class="uk-button uk-button-primary" style="margin-top: 30%;margin-left:26%">Learn it now!</button>
                            </div>
                        </figure>
                        <p class="uk-text-center">Section 7:Kontakte</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="gutenTag.jpg" alt="Guten Tag!" width="300" height="250">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <button class="uk-button uk-button-primary" style="margin-top: 30%;margin-left:26%">Learn it now!</button>
                            </div>
                        </figure>
                        <p class="uk-text-center">Section 8:Meine Wohnung</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="gutenTag.jpg" alt="Guten Tag!" width="300" height="250">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <button class="uk-button uk-button-primary" style="margin-top: 30%;margin-left:26%">Learn it now!</button>
                            </div>
                        </figure>
                        <p class="uk-text-center">Section 9:Alles Arbeit?</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="gutenTag.jpg" alt="Guten Tag!" width="300" height="250">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <button class="uk-button uk-button-primary" style="margin-top: 30%;margin-left:26%">Learn it now!</button>
                            </div>
                        </figure>
                        <p class="uk-text-center">Section 10:Kleidung und Mode</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="gutenTag.jpg" alt="Guten Tag!" width="300" height="250">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <button class="uk-button uk-button-primary" style="margin-top: 30%;margin-left:26%">Learn it now!</button>
                            </div>
                        </figure>
                        <p class="uk-text-center">Section 11:Gesund und munter</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="gutenTag.jpg" alt="Guten Tag!" width="300" height="250">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <button class="uk-button uk-button-primary" style="margin-top: 30%;margin-left:26%">Learn it now!</button>
                            </div>
                        </figure>
                        <p class="uk-text-center">Section 12:Ab in den Urlaub!</p>
                    </li>
                </ul>

            </main>

        </div>
    </div>
</div>
<footer>
    <div style="background-color: #003038;height:25px;margin-top: 100px;">
            <div class="uk-margin-top" style="position: relative;top:4px;text-align: center"><p style="color:#748487">©2018 German Words. All rights reserved. </p></div>
    </div>
</footer>
<script src="js/drawer.js"></script>
</body>
</html>