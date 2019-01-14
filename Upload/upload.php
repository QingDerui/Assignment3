<?php
session_start();
require_once('../DB/DB.php');
require_once('../Models/Word.php');//why cannot use require;fatal error
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <link rel="stylesheet" type="text/css" href="../css/uikit.css"/>
    <link rel="stylesheet" type="text/css" href="../css/components/sticky.css"/>
    <link rel="stylesheet" type="text/css" href="../css/upload.css"/>
    <link rel="stylesheet" type="text/css" href="../css/uploadimage.css"/>
    <link rel="stylesheet" type="text/css" href="../css/selfdefined.css"/>
    <script src="../js/jquery-3.3.1.js"></script>
    <script src="../js/uikit.js"></script>
    <script src="../js/components/sticky.js"></script>
    <script src="../js/supportFunctions.js"></script>
    <script src="../js/upload_Form.js"></script>
    <script src="../Validation/upload.js"></script>

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
                <img alt='userIcon' title='dAKirby309, http://www.iconarchive.com/show/windows-8-metro-icons-by-dakirby309/Folders-OS-User-No-Frame-Metro-icon.html, last access data 14.01.2019 ' src='../icons/userImageDef.jpg'/>
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
                <img alt='userIcon' title='dAKirby309, http://www.iconarchive.com/show/windows-8-metro-icons-by-dakirby309/Folders-OS-User-No-Frame-Metro-icon.html, last access data 14.01.2019 ' src='../icons/userImageDef.jpg'/>
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
                if (isset($_SESSION['username']) && !is_null($_SESSION['username'])) {
                    echo "<li><a href='#drawer'data-uk-offcanvas >Hi! " . $_SESSION['username'] . "</li>";
                    echo "<li><a href='../LogIn&LogOut/signOut.php'>Sign out</a></li>";
                } else {
                    echo "<li><a href='../LogIn&LogOut/login.php'>Login</a></li>";
                    echo "<li><a href='../LogIn&LogOut/signUp.php'>Sign Up</a></li>";
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

<div  style="margin-top: 50px;">
    <div class="uk-container uk-container-center">

        <main role="main" class="uk-width-medium-3-4 uk-width-large-5-6 uk-width-small-1-1 uk-container-center"
              style="min-height: 800px">
            <div class="uk-grid">
                <div class="uk-container-center uk-width-large-1-1">

                    <?php
                    if (isset($_SESSION['username']) && !is_null($_SESSION['username']) === true) {
                        echo "<h1>Upload your own word list</h1>";
                    } else {
                        echo "<h1>Please login first.</h1>";
                        header("Refresh:1;url=../LogIn&LogOut/login.php");
                        die();
                    }
                    ?>
                </div>
            </div>
            <div class="uk-margin-large-top">


                <div class="uk-width-large-1-1">
                    <h2><b>List name</b></h2>
                </div>

                <div class="uk-width-large-1-1">
                    <input type="text" name="listName" id="listName"
                           style="position: relative;top:-20px; height:30px;"/>
                </div>

                <div>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="uploadcss"
                           style="text-align: center;" id="titleTable">
                        <tr>
                            <th id="titleHidden" style='display: none;width:8px;'></th>
                            <th style="width:20px;">No.</th>
                            <th style="width:230px;">German</th>
                            <th>English</th>
                            <th style="width: 20px;">Genus</th>
                            <th style="width: 435px;">Example</th>
                        </tr>
                    </table>
                </div>

                <div style="height:700px;overflow: auto">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="uploadcss"
                           style="text-align: center;" id="wordTable">
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            echo "<tr>";
                            echo "<td style='display: none; height: 36.33px;'>";
                            echo "<input type='checkbox' name='selected'/>";
                            echo "</td>";
                            echo "<td>";
                            echo "<p name='number'>" . $i . "</p>";
                            echo "</td>";
                            echo "<td style='width:200px'>";
                            echo "<input class='input_ger' style='height:100%;width:100%' type='text' name='wordGer'id='ger'></td>";
                            echo "<td style='width:200px'>";
                            echo "<input class='input_eng' style='height:100%; width:100%' type='text' name='wordEng' id='eng'/></td>";
                            echo "<td style='width:50px;'>
                                            <select class='select_genus' style='height:100%;width:100%;' name='genus'>
                                                <option>m.</option>
                                                <option>f.</option>
                                                <option>n.</option>
                                                <option>pl.</option> 
                                                <option>-</option>
                                            </select>
                                        </td>";
                            echo "<td style='width:430px;'>";
                            echo "<textarea style='height:100%;width:100%;resize:none;' class='textarea_example' name='example'></textarea>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
            <div style="text-align: center;margin-top:10px;">
                <Button type="submit" id="submitWord" onclick="submit()">Submit your wordlist</Button>
            </div>
        </main>
        <div class="uk-width" style="position: absolute;right:30px; width:100px; top:590px">
            <button id="add" onclick="addWord()" style="width: 100%" class="uk-button-success">Add Word</button>
        </div>
        <div class="uk-width" style="position: absolute;right:25px; top:630px;width:100px;">
            <button id="delete" onclick="showCheckBox()" class="uk-button-danger">Delete Word</button>
        </div>
        <div class="uk-width" style="position: absolute;right:30px; width:100px; top:590px">
            <button id="confirmDel" hidden onclick="deleteWord()" class="uk-button-success">Confirm</button>
        </div>
        <div class="uk-width" style="position: absolute;right:50px; top:630px;width:80px;">
            <button id="cancelDel" onclick="cancelDelete()" hidden class="uk-button-danger" style="width:62px;">Cancel
            </button>
        </div>
    </div>
</div>
</div>
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
</body>
</html>
