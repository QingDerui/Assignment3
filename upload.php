<?php
session_start();
require_once('DB.php');
require_once('Word.php');//why cannot use require;fatal error
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <link rel="stylesheet" type="text/css" href="css/uikit.css"/>
    <link rel="stylesheet" type="text/css" href="css/components/sticky.css"/>
    <link rel="stylesheet" type="text/css" href="css/upload.css"/>
    <script src="jquery-3.3.1.js"></script>
    <script src="js/uikit.js"></script>
    <script src="js/components/sticky.js"></script>
    <script src="supportFunctions.js"></script>
    <script src="upload_Form.js"></script>

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
            <li><a href="upload.php">Upload your own list</a></li>
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

        <main role="main" class="uk-width-medium-3-4 uk-width-large-5-6 uk-width-small-1-1 uk-container-center"
              style="min-height: 800px">
            <div class="uk-grid">
                <div class="uk-container-center uk-width-large-1-1">
                    <?php
                    if (isset($_SESSION['username']) && !is_null($_SESSION['username']) === true) {
                        echo "<h1>Upload your own word list</h1>";
                    } else {
                        echo "<h1>Please login first.</h1>";
                        header("Refresh:1;url=login.php");
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
                            <th style="width:208px;">German</th>
                            <th>English</th>
                            <th style="width: 20px;">Genus</th>
                            <th style="width: 230px;">Example</th>
                        </tr>
                    </table>
                </div>

                <form width="100%" method="post" action="">
                    <div style="height:700px;overflow: auto">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="uploadcss"
                               style="text-align: center;" id="wordTable">
                            <?php
                            for ($i = 1; $i <= 19; $i++) {
                                echo "<tr>";
                                echo "<td style='display: none;height:36.33px;''>";
                                echo "<input type='checkbox'name='selected'/>";
                                echo "</td>";
                                echo "<td>";
                                echo "<p name='number'>" . $i . "</p>";
                                echo "</td>";
                                echo "<td width:50px>";
                                echo "<input type='text' name='wordGer'id='ger'></td>";
                                echo "<td>";
                                echo "<input type='text' name='wordEng' id='eng'/></td>";
                                echo "<td>
                                            <select name='genus'>
                                                <option>m.</option>
                                                <option>f.</option>
                                                <option>n.</option>
                                                <option>pl.</option> 
                                                <option>-</option>
                                            </select>
                                        </td>";
                                echo "<td>";
                                echo "<textarea name='example'></textarea>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>

                    <div style="text-align: center;margin-top:10px;"
                    ">
                    <Button type="submit" id="submitWord" onclick="jsonSubmit()">Submit your wordlist</Button>
            </div>
            </form>
        </main>
        <div class="uk-width" style="position: absolute;right:7px; width:100px; top:590px">
            <button id="add" onclick="addWord()" style="width: 100%" class="uk-button-success">Add Word</button>
        </div>
        <div class="uk-width" style="position: absolute;right:0px; top:630px;width:100px;">
            <button id="delete" onclick="showCheckBox()" class="uk-button-danger">Delete Word</button>
        </div>
        <div class="uk-width" style="position: absolute;right:-7px; width:100px; top:590px">
            <button id="confirmDel" hidden onclick="deleteWord()" class="uk-button-success">Confirm</button>
        </div>
        <div class="uk-width" style="position: absolute;right:12px; top:630px;width:80px;">
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
