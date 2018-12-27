<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
        echo "$result, yes";
    } else {
        echo "<script>window.alert('Saving failed due to DB error')</script>";
    }
}
?>
<form method="post">
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
                echo "<td>$wordid</td>\n";
                echo "<td>$wordGer</td>\n";
                echo "<td>$wordEng</td>\n";
                echo "<td>$example</td>\n";
                echo "<td>$genus</td>\n";
                echo "<td>$section</td>\n";
                echo "</tr>\n";
            }
        }
        ?>
        <tr>
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
                </select>
            </td>
            <td>
                <select name="newWord[section]">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
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
        </tr>
    </table>
    <button type="submit">submit</button>
</form>
</body>
</html>