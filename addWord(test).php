<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script type="text/javascript" src="jquery-3.3.1.js"></script>
    <title>Adding Words (for developers)</title>
</head>
<body>
<?php
require('Word.php');
require('DB.php');
if (!empty($_POST['newWord'])) {
    DB_Controller::createConnection();
    DB_Controller::setWordCount();
    DB_Controller::closeConnection();
    $word = new Word($_POST['newWord']['wordGer'], $_POST['newWord']['wordEng'], $_POST['newWord']['example'], $_POST['newWord']['genus'], $_POST['newWord']['section']);
    DB_Controller::createConnection();
    $result = DB_Controller::addWord($word);
    DB_Controller::closeConnection();
    if ($result == true) {
        echo "new word: $result";
    } else {
        echo "<script>window.alert('Inserting failed due to DB error')</script>";
    }
}

if (!empty($_POST['updateWord'])) {
    DB_Controller::createConnection();
    $result = DB_Controller::updateWord($_POST['updateWord']['wordID'], $_POST['updateWord']['wordGer'], $_POST['updateWord']['wordEng'], $_POST['updateWord']['example'], $_POST['updateWord']['genus'], $_POST['updateWord']['section']);
    DB_Controller::closeConnection();
    if ($result == true) {
        echo "update word: $result";
    } else {
        echo "<script>window.alert('Updating failed due to DB error')</script>";
    }
} else {
    echo 'post[updateWord] is empty';
}
?>

<table>
    <tr>
        <th>
            wordID
        </th>
        <th>
            wordGer
        </th>
        <th>
            wordEng
        </th>
        <th width="700">
            example
        </th>
        <th>
            genus
        </th>
        <th>
            section
        </th>
    </tr>
    <tr>
        <form method="post" id="newWordFrom">
            <td>
                <input name="newWord[wordID]">
            </td>
            <td>
                <input name="newWord[wordGer]">
            </td>
            <td>
                <input name="newWord[wordEng]">
            </td>
            <td>
                <input name="newWord[example]" style="width: 650px;">
            </td>
            <td>
                <select name="newWord[genus]">
                    <option>
                        m.
                    </option>
                    <option>
                        f.
                    </option>
                    <option>
                        n.
                    </option>
                    <option>
                        pl.
                    </option>
                    <option>
                        -
                    </option>
                </select>
            </td>
            <td>
                <select name="newWord[section]">
                    <option>1</option>
                    <option>2</option>
                    <option selected>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option>
                </select>
            </td>
            <td>
                <button type="submit" onclick="submitNewWordForm()">submit</button>
            </td>
        </form>
    </tr>
    <?php
    DB_Controller::createConnection();
    $words = DB_Controller::getAllWords();
    DB_Controller::closeConnection();
    if (is_null($words)) {
        echo "<tr><td>no word</td></tr><";
    } else {
        foreach ($words as $word) {
            $wordid = $word->getWordID();
            $wordGer = $word->getWordGer();
            $wordEng = $word->getWordEng();
            $example = $word->getExample();
            $genus = $word->getGenus();
            $section = $word->getSection();
            echo "<tr>\n";
            echo "<form method='post' action='addWord(test).php'>\n";
            echo "<td><input name='updateWord[wordID]' value='$wordid'></td>\n";
            echo "<td><input name='updateWord[wordGer]' value='$wordGer'></td>\n";
            echo "<td><input name='updateWord[wordEng]' value='$wordEng'></td>\n";
            echo "<td ><input name='updateWord[example]' style='width: 650px;' value='$example'></td>\n";
            echo "<td><input name='updateWord[genus]' style='width: 60px;' value='$genus'></td>\n";
            echo "<td><input name='updateWord[section]' style='width: 60px;' value='$section'></td>\n";
            echo "<td><button class='modify' href='javascript:;' type='button'>Modify</button></td>\n";
            echo "<td><input type='submit' value='Update'></td>\n";
            echo "</form>\n";
            echo "</tr>\n";
        }
    }
    ?>
</table>



<script>
    function submitNewWordForm() {
        document.getElementById('newWordForm').submit();
    }
</script>

<script type="text/javascript">
    $(function () {
        $(".modify").click(function () {
            str = $(this).text() == "Modify" ? "Confirm" : "Modify";
            $(this).text(str);   // 按钮被点击后，在“编辑”和“确定”之间切换
            $(this).parent().siblings("td:eq(0)").each(function () {  // 获取当前行的第1列单元格
                obj_text = $(this).find("input:text");    // 判断单元格下是否有文本框
                if (!obj_text.length)   // 如果没有文本框，则添加文本框使之可以编辑
                    $(this).html("<input name='updateWord[wordID]' type='text' value='" + $(this).text() + "'>");
                else   // 如果已经存在文本框，则将其显示为文本框修改的值
                    $(this).html(obj_text.val());
            });
            $(this).parent().siblings("td:eq(1)").each(function () {  // 获取当前行的第二列单元格
                obj_text = $(this).find("input:text");    // 判断单元格下是否有文本框
                if (!obj_text.length)   // 如果没有文本框，则添加文本框使之可以编辑
                    $(this).html("<input name='updateWord[wordGer]' type='text' value='" + $(this).text() + "'>");
                else   // 如果已经存在文本框，则将其显示为文本框修改的值
                    $(this).html(obj_text.val());
            });
            $(this).parent().siblings("td:eq(2)").each(function () {  // 获取当前行的第3列单元格
                obj_text = $(this).find("input:text");    // 判断单元格下是否有文本框
                if (!obj_text.length)   // 如果没有文本框，则添加文本框使之可以编辑
                    $(this).html("<input name='updateWord[wordEng]' type='text' value='" + $(this).text() + "'>");
                else   // 如果已经存在文本框，则将其显示为文本框修改的值
                    $(this).html(obj_text.val());
            });
            $(this).parent().siblings("td:eq(3)").each(function () {  // 获取当前行的第4列单元格
                obj_text = $(this).find("input:text");    // 判断单元格下是否有文本框
                if (!obj_text.length)   // 如果没有文本框，则添加文本框使之可以编辑
                    $(this).html("<input name='updateWord[example]' style='width: 650px;' type='text' value='" + $(this).text() + "'>");
                else   // 如果已经存在文本框，则将其显示为文本框修改的值
                    $(this).html(obj_text.val());
            });
            $(this).parent().siblings("td:eq(4)").each(function () {  // 获取当前行的第5列单元格
                obj_text = $(this).find("input:text");    // 判断单元格下是否有文本框
                if (!obj_text.length)   // 如果没有文本框，则添加文本框使之可以编辑
                    $(this).html("<input name='updateWord[genus]' style='width: 50px;' type='text' value='" + $(this).text() + "'>");
                else   // 如果已经存在文本框，则将其显示为文本框修改的值
                    $(this).html(obj_text.val());
            });
            $(this).parent().siblings("td:eq(5)").each(function () {  // 获取当前行的第6列单元格
                obj_text = $(this).find("input:text");    // 判断单元格下是否有文本框
                if (!obj_text.length)   // 如果没有文本框，则添加文本框使之可以编辑
                    $(this).html("<input name='updateWord[section]' style='width: 50px;' type='text' value='" + $(this).text() + "'>");
                else   // 如果已经存在文本框，则将其显示为文本框修改的值
                    $(this).html(obj_text.val());
            });
        });
    });
</script>

</body>
</html>