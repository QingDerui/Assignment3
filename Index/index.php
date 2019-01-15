<!DOCTYPE HTML>
<?php session_start();
unset($_SESSION['userExisted']);
unset($_SESSION['userPass']);
unset($_SESSION['signed']);
unset($_SESSION['pwPass']);
unset($_SESSION['nameNull']);
require_once('../Models/Word.php');
require_once('../DB/DB.php');
require_once('../Models/User.php');
DB_Controller::createConnection();  // start DB connection
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <link rel="stylesheet" type="text/css" href="../css/uikit.css"/>
    <link rel="stylesheet" type="text/css" href="../css/components/sticky.css"/>
    <link rel="stylesheet" type="text/css" href="../css/uploadimage.css"/>
    <link rel="stylesheet" type="text/css" href="../css/selfdefined.css"/>
    <script src="../js/jquery-3.3.1.js"></script>
    <script src="../js/uikit.js"></script>
    <script src="../js/components/sticky.js"></script>
    <script src="../js/supportFunctions.js"></script>
</head>
<body>

<!--Drawer bar-->
<div class="uk-offcanvas" id="drawer">
    <div class="uk-offcanvas-bar uk-offcanvas-bar-show">
        <ul class="uk-nav uk-nav-offcanvas" data-uk-nav>
            <li style="text-align: center">
                <?php
                if(!(isset($_SESSION['username'])&&!is_null($_SESSION['username']))){
                    echo "<div class='contentDiv'>
                <img title='dAKirby309, http://www.iconarchive.com/show/windows-8-metro-icons-by-dakirby309/Folders-OS-User-No-Frame-Metro-icon.html, last access data 14.01.2019 ' src='../icons/userImageDef.jpg'/>
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
            </div>";}else{
                    echo"<div class='contentDiv'>
                <img title='dAKirby309, http://www.iconarchive.com/show/windows-8-metro-icons-by-dakirby309/Folders-OS-User-No-Frame-Metro-icon.html, last access data 14.01.2019 ' src='../icons/userImageDef.jpg'/>
            </div>
            <br><br>
            </li>
            
            <li class='uk-active' style='text-align: center;font-size:22px;font-family: \"Curlz MT\"'>
                <a>Guten Tag! Dear  ".$_SESSION['username']."</a>";
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

<!--Navigation bar-->
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
            <li><a href="../Upload/upload.php">Upload your own list</a></li>
        </ul>
        <div class="uk-navbar-flip uk-hidden-small">
            <ul class="uk-navbar-nav">

                <?php

                // If the user has logged in then there is no need to show login or sign in button, replace them by sign out button
                if (isset($_SESSION['username']) && !is_null($_SESSION['username'])) {
                    echo "<li><a href='#drawer'data-uk-offcanvas >Hi! ".$_SESSION['username']."</li>";
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
<!--End of navigation bar-->
<!--Body part-->
<div class="" style="margin-top: 50px;">
    <div class="uk-container uk-container-center">
        <div class="uk-grid uk-grid-divider">
            <!--            Side navigation of body part-->
            <aside class="uk-width-medium-1-4 uk-width-large-1-5 uk-hidden-small uk-margin-large-top">
                <div>
                    <div id='aside' class='uk-panel' style='margin-top: 50px;max-height: 500px;overflow-y:hidden;'
                         onmouseover="showScrollBar()" onmouseleave="hideScrollBar()">
                        <h3>Study progress:</h3>
                        <hr class='uk-grid-divider'>
                        <?php
                        // This part is to show the learning progress of each section
                        if (isset($_SESSION['username']) && !is_null($_SESSION['username'])) {
                            for ($i = 1; $i <= 12; $i++) {
                                $sectionWords = DB_Controller::getSectionWordNumber(strval($i)); // Get the number of words of a certain section
                                $knownWords = DB_Controller::getRecognizedWordNumber($_SESSION['username'], strval($i));
                                $progress = round($knownWords / $sectionWords * 100);
                                echo "<div>";
                                echo "<p>Section " . $i . ":</p>";
                                echo "<div class='uk-progress uk-progress-striped' style='width: 120px'>";
                                echo "<div class='uk-progress-bar' style='width: " . $progress . "%;'>" . $progress . "%</div>";
                                echo "</div></div>";
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
            <!--            End of the side navigation-->
            <!--            Main part-->
            <main role="main" class="uk-width-medium-3-4 uk-width-large-4-5 uk-width-small-1-1 ">
                <div class="uk-grid">
                    <div class="uk-container-center uk-width-large-2-3">
                        <h1>Welcome to Char Ideas!</h1>
                    </div>

                </div>
                <ul class="uk-grid uk-grid-width-small-1-2 uk-grid-width-medium-1-2 uk-grid-width-large-1-3"
                    data-uk-grid-margin="">
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="../PIC/gutenTag.jpg" alt="Guten Tag!">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <form action="../MemorizeWord/memorizeWords.php" method="get">
                                    <input type="hidden" name="section" value="1">
                                    <button id="button_section1" type="submit" class="uk-button uk-button-primary"
                                            style="margin-top: 30%;margin-left:26%">Learn it now!
                                    </button>
                                </form>
                            </div>
                        </figure>
                        <p class="uk-text-center" title="picture reference: https://cn.dreamstime.com/%E4%BD%A0%E5%A5%BD%E8%AF%8D%E4%BA%91%E5%BD%A9%E6%8B%BC%E8%B4%B4%E7%94%BB%E7%94%A8%E4%B8%8D%E5%90%8C%E7%9A%84%E8%AF%AD%E8%A8%80-image100776481, last access 12.1.2019">Section 1: Guten Tag!</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="../PIC/friend&ich.jpg" alt="Freunde, Kollegen und ich!" style="width:273px;height: 204.74px;">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <form action="../MemorizeWord/memorizeWords.php" method="get">
                                    <input type="hidden" name="section" value="2">
                                    <button id="button_section2" type="submit" class="uk-button uk-button-primary"
                                            style="margin-top: 30%;margin-left:26%">Learn it now!
                                    </button>
                                </form>
                            </div>
                        </figure>
                        <p class="uk-text-center" title="picture reference: https://stock.tuchong.com/image/creative?imageId=57401542134863252&source=baiduimage, last access 12.1.2019">Section 2: Freunde, Kollegen und ich</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="../PIC/city.jpg" alt="In der Stadt" style="width:273px;height: 204.74px;">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <form action="../MemorizeWord/memorizeWords.php" method="get">
                                    <input type="hidden" name="section" value="3">
                                    <button id="button_section3" type="submit" class="uk-button uk-button-primary"
                                            style="margin-top: 30%;margin-left:26%">Learn it now!
                                    </button>
                                </form>
                            </div>
                        </figure>
                        <p class="uk-text-center" title="picture reference: https://dp.pconline.com.cn/dphoto/list_3410659.html, last access on 12.1.2019">Section 3: In der Stadt</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="../PIC/food.jpg" alt="Guten Appetit!" style="width:273px;height: 204.74px;">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <form action="../MemorizeWord/memorizeWords.php" method="get">
                                    <input type="hidden" name="section" value="4">
                                    <button id="button_section4" type="submit" class="uk-button uk-button-primary"
                                            style="margin-top: 30%;margin-left:26%">Learn it now!
                                    </button>
                                </form>
                            </div>
                        </figure>
                        <p class="uk-text-center" title="picture reference: http://www.sohu.com/a/203374173_99908299, last access on 12.1.2019">Section 4: Guten Appetit!</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="../PIC/tag%20for%20tag.jpg" alt="Tag für Tag" style="width:273px;height: 204.74px;">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <form action="../MemorizeWord/memorizeWords.php" method="get">
                                    <input type="hidden" name="section" value="5">
                                    <button id="button_section5" type="submit" class="uk-button uk-button-primary"
                                            style="margin-top: 30%;margin-left:26%">Learn it now!
                                    </button>
                                </form>
                            </div>
                        </figure>
                        <p class="uk-text-center" title="picture reference: http://www.3lian.com/gif/2015/05-14/82102.html, last access on 12.1.2019">Section 5: Tag für Tag</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="../PIC/withFriends.jpg" alt="Zeit mit Freunden" style="width:273px;height: 204.74px;">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <form action="../MemorizeWord/memorizeWords.php" method="get">
                                    <input type="hidden" name="section" value="6">
                                    <button id="button_section6" type="submit" class="uk-button uk-button-primary"
                                            style="margin-top: 30%;margin-left:26%">Learn it now!
                                    </button>
                                </form>
                            </div>
                        </figure>
                        <p class="uk-text-center" title="picture reference: https://news.qq.com/a/20140724/022822.htm#p=25, last access on 12.1.2019">Section 6: Zeit mit Freunden</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="../PIC/contact.jpg" alt="Kontakte" style="width:273px;height: 204.74px;">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <form action="../MemorizeWord/memorizeWords.php" method="get">
                                    <input type="hidden" name="section" value="7">
                                    <button id="button_section7" type="submit" class="uk-button uk-button-primary"
                                            style="margin-top: 30%;margin-left:26%">Learn it now!
                                    </button>
                                </form>
                            </div>
                        </figure>
                        <p class="uk-text-center" title="picture reference: http://aso.aizhan.com/all/1899268.html, last access on 12.1.2019">Section 7: Kontakte</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="../PIC/livingroom.jpg" alt="Meine Wohnung" style="width:273px;height: 204.74px;">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <form action="../MemorizeWord/memorizeWords.php" method="get">
                                    <input type="hidden" name="section" value="8">
                                    <button id="button_section8" type="submit" class="uk-button uk-button-primary"
                                            style="margin-top: 30%;margin-left:26%">Learn it now!
                                    </button>
                                </form>
                            </div>
                        </figure>
                        <p class="uk-text-center" title="picture reference: https://image.baidu.com/search/detail?ct=503316480&z=0&ipn=d&word=%E5%AE%A4%E5%86%85&step_word=&hs=2&pn=69&spn=0&di=81319131520&pi=0&rn=1&tn=baiduimagedetail&is=0%2C0&istype=2&ie=utf-8&oe=utf-8&in=&cl=2&lm=-1&st=-1&cs=1012886403%2C1639147329&os=1139614575%2C3313093080&simid=3389750440%2C59006398&adpicid=0&lpn=0&ln=1911&fr=&fmq=1547334096593_R&fm=result&ic=undefined&s=undefined&hd=undefined&latest=undefined&copyright=undefined&se=&sme=&tab=0&width=undefined&height=undefined&face=undefined&ist=&jit=&cg=&bdtype=0&oriquery=&objurl=http%3A%2F%2Fimg.zx123.cn%2FResources%2Fzx123cn%2Fuploadfile%2F2017%2F0720%2Fe7e2109b6104dd810a16317be37ec15a.jpg&fromurl=ippr_z2C%24qAzdH3FAzdH3Fooo_z%26e3Bzx8dn_z%26e3BvgAzdH3Fxtw5275p7AzdH3Fda80a0da8nmlblm_z%26e3Bip4s&gsm=1e&rpstart=0&rpnum=0&islist=&querylist=&force=undefined, last access on 12.1.2019">Section 8: Meine Wohnung</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="../PIC/job.jpg" alt="Alles Arbeit?" style="width:273px;height: 204.74px;">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <form action="../MemorizeWord/memorizeWords.php" method="get">
                                    <input type="hidden" name="section" value="9">
                                    <button id="button_section9" type="submit" class="uk-button uk-button-primary"
                                            style="margin-top: 30%;margin-left:26%">Learn it now!
                                    </button>
                                </form>
                            </div>
                        </figure>
                        <p class="uk-text-center" title="picture reference: https://www.tooopen.com/view/1543045.html, last access on 12.1.2019">Section 9: Alles Arbeit?</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="../PIC/buyClothes.jpg" alt="Kleidung und Mode" style="width:273px;height: 204.74px;">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <form action="../MemorizeWord/memorizeWords.php" method="get">
                                    <input type="hidden" name="section" value="10">
                                    <button id="button_section10" type="submit" class="uk-button uk-button-primary"
                                            style="margin-top: 30%;margin-left:26%">Learn it now!
                                    </button>
                                </form>
                            </div>
                        </figure>
                        <p class="uk-text-center" title="picture reference: http://www.efnanjing.com/news.php?cid=1190, last access on 12.1.2019">Section 10: Kleidung und Mode</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="../PIC/health.jpg" alt="Gesund und munter" style="width:273px;height: 204.74px;">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <form action="../MemorizeWord/memorizeWords.php" method="get">
                                    <input type="hidden" name="section" value="11">
                                    <button id="button_section11" type="submit" class="uk-button uk-button-primary"
                                            style="margin-top: 30%;margin-left:26%">Learn it now!
                                    </button>
                                </form>
                            </div>
                        </figure>
                        <p class="uk-text-center" title="picture reference: https://news.91160.com/xinwen/yiliao/10728.html, last access on 12.1.2019">Section 11: Gesund und munter</p>
                    </li>
                    <li>
                        <figure class="uk-overlay uk-overlay-hover">
                            <img src="../PIC/holiday.jpg" alt="Ab in den Urlaub!" style="width:273px;height: 204.74px;">
                            <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background">
                                <form action="../MemorizeWord/memorizeWords.php" method="get">
                                    <input type="hidden" name="section" value="12">
                                    <button id="button_section12" type="submit" class="uk-button uk-button-primary"
                                            style="margin-top: 30%;margin-left:26%">Learn it now!
                                    </button>
                                </form>
                            </div>
                        </figure>
                        <p class="uk-text-center" title="picture reference: https://www.16pic.com/psd/pic_494513.html, last access on 12.1.2019">Section 12: Ab in den Urlaub!</p>
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
                <span><h2 style="color:#748487">About</h2></span>
                <p style="color:#748487">Authors: Qing Derui, Pan Xinyi, Wang Yuxuan</p>
                <p style="color:#748487">The content of our websites is mainly referring this book: Dengler, S., Rusch, P., Schmitz, H. and Sieber, T. (2012). Netzwerk. München: Langenscheidt.</p>
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
DB_Controller::closeConnection(); // Close DB connection

?>
</body>
</html>