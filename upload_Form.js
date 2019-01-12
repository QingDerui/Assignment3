/**
 *Author:Pan Xinyi
 * Date:2019-1-12
 */

/**
 * add the word to table within add button.
 */
function addWord() {
    var parentTable = document.getElementById("wordTable");
    var tr = document.createElement("tr");
    var rows = parentTable.rows.length;
    var tdNo = document.createElement("td");
    var pNo = document.createElement("p");
    pNo.setAttribute("name", "number");
    pNo.innerHTML = rows + 1;
    tdNo.appendChild(pNo);

    var tdCheckbox = document.createElement("td");
    tdCheckbox.setAttribute("style", "display:none");
    var inputCheckbox = document.createElement("input");
    inputCheckbox.setAttribute("type", "checkbox");
    inputCheckbox.setAttribute("name", "selected");
    tdCheckbox.style.height = "36.33px";
    tdCheckbox.appendChild(inputCheckbox);

    var tdGerman = document.createElement("td");
    var germanInput = document.createElement("input");
    germanInput.setAttribute("class", "input_ger");
    germanInput.setAttribute("type", "text");
    germanInput.setAttribute("name", "wordGer");
    tdGerman.appendChild(germanInput);

    var tdEnglish = document.createElement("td");
    var englishInput = document.createElement("input");
    englishInput.setAttribute("class", "input_eng");
    englishInput.setAttribute("type", "text");
    englishInput.setAttribute("name", "wordEng");
    tdEnglish.appendChild(englishInput);

    var tdGenus = document.createElement("td");
    var genusSelect = document.createElement("select");
    genusSelect.setAttribute("class", "select_genus");
    genusSelect.setAttribute("name", "genus");
    var mOption = document.createElement("option");
    var fOption = document.createElement("option");
    var nOption = document.createElement("option");
    var plOption = document.createElement("option");
    mOption.innerHTML = "m.";
    fOption.innerHTML = "f.";
    nOption.innerHTML = "n.";
    plOption.innerHTML = "pl.";
    genusSelect.appendChild(mOption);
    genusSelect.appendChild(fOption);
    genusSelect.appendChild(nOption);
    genusSelect.appendChild(plOption);
    tdGenus.appendChild(genusSelect);

    var tdExample = document.createElement("td");
    var example = document.createElement("textarea");
    example.setAttribute("class", "textarea_example");
    example.setAttribute("name", "example");
    tdExample.appendChild(example);

    tr.appendChild(tdCheckbox);
    tr.appendChild(tdNo);
    tr.appendChild(tdGerman);
    tr.appendChild(tdEnglish);
    tr.appendChild(tdGenus);
    tr.appendChild(tdExample);

    parentTable.appendChild(tr);
}

/**
 * delete the word from the table within the delete button.
 */
function deleteWord() {
    var table = document.getElementById("wordTable");
    var checkbox = document.getElementsByName("selected");
    var selected = false;

    for (var a = 0; a < checkbox.length; a++) {
        if (checkbox[a].checked) {
            selected = true;
            break;
        }
    }

    if (selected) {
        confirm("Do you really want to delete these words?");

        for (var i = checkbox.length - 1; i >= 0; i--) {
            if (checkbox[i].checked) {
                console.log(checkbox);
                table.deleteRow(i);
            }
        }

        var newTable = document.getElementById("wordTable");
        var numberList = document.getElementsByName("number");
        console.log(newTable.rows.length);

        for (var i = 1; i <= newTable.rows.length; i++) {
            console.log(i);
            numberList[i - 1].innerHTML = i;
        }

        var trNew = newTable.rows;
        for (var a = 0; a < trNew.length; a++) {
            var cellNew = trNew[a].cells[0];
            if (cellNew.style.display == "block") {
                cellNew.style.display = "none";
            }
        }

        var addButton = document.getElementById("add");
        var deleteButton = document.getElementById("delete");
        var okButton = document.getElementById("confirmDel");
        var cancelButton = document.getElementById("cancelDel");
        var title = document.getElementById("titleHidden");

        addButton.removeAttribute("hidden");
        deleteButton.removeAttribute("hidden");
        okButton.setAttribute("hidden", "hidden");
        cancelButton.setAttribute("hidden", "hidden");
        title.style.display = "none";

    } else {
        alert("Please choose at least one word!");
    }
}

/**
 * show the check boxes which are hidden before the delete button is activated.
 */
function showCheckBox() {
    var title = document.getElementById("titleHidden");
    title.style.display = "block";
    var table = document.getElementById("wordTable");
    var tr = table.rows;
    for (var a = 0; a < tr.length; a++) {
        var cell = tr[a].cells[0];
        if (cell.style.display == "none") {
            cell.style.display = "block";
        }
    }

    var addButton = document.getElementById("add");
    addButton.setAttribute("hidden", "hidden");
    var deleteButton = document.getElementById("delete");
    deleteButton.setAttribute("hidden", "hidden");

    var okButton = document.getElementById("confirmDel");
    okButton.removeAttribute("hidden");

    var cancelButton = document.getElementById("cancelDel");
    console.log(cancelButton);
    console.log("hidd");
    cancelButton.removeAttribute("hidden");
}

/**
 * cancel the operation of delete.
 */
function cancelDelete() {

    var newTable = document.getElementById("wordTable");
    var trNew = newTable.rows;
    for (var a = 0; a < trNew.length; a++) {
        var cellNew = trNew[a].cells[0];
        if (cellNew.style.display == "block") {
            cellNew.style.display = "none";
        }
    }

    var addButton = document.getElementById("add");
    var deleteButton = document.getElementById("delete");
    var okButton = document.getElementById("confirmDel");
    var cancelButton = document.getElementById("cancelDel");
    var title = document.getElementById("titleHidden");

    addButton.removeAttribute("hidden");
    deleteButton.removeAttribute("hidden");
    okButton.setAttribute("hidden", "hidden");
    cancelButton.setAttribute("hidden", "hidden");
    title.style.display = "none";
}

/**
 * confirm the operation of delete within the confirm button.
 * using ajax and json encapsulation of data and interact with back-end.
 */
function jsonSubmit() {
    var WordJS = {
        wordGer: "",
        wordEng: "",
        wordGenus: "",
        wordExample: "",
    }

    var jsObj = JSON.parse("{\"name\":\"\",\"dataWord\":[]}");
    var rows = document.getElementById("wordTable").rows.length;
    var listNamepb = document.getElementById("listName").value;

    var table = document.getElementById("wordTable");

    if (rows >= 1) {
        for (var i = 0; i < rows; i++) {
            var wordJS = new Object();

            wordJS.wordGer = table.rows[i].cells[2].getElementsByTagName("input")[0].value;
            wordJS.wordEng = table.rows[i].cells[3].getElementsByTagName("input")[0].value;

            var select = table.rows[i].cells[4].getElementsByTagName("select")[0];
            var index = select.selectedIndex;
            wordJS.wordGenus = select.options[index].text;

            wordJS.wordExample = table.rows[i].cells[5].getElementsByTagName("textarea")[0].value;

            if (!((wordJS.wordGer == "") || (wordJS.wordEng == ""))) {
                jsObj.dataWord.push(wordJS);
            }
        }

        jsObj.name = listNamepb;

        if (!(jsObj.dataWord.length == 0)) {

            var word = JSON.stringify(jsObj);

            $.ajax({
                type: "post",
                url: "upload_Submit.php",
                data: {'wordList': word},
                datatype: "json",
                success: function (data) {
                    var obj = eval("(" + data + ")");

                    if (obj.type == 1) {
                        alert(obj.message + " has been added successfully!");
                        window.location.href = "checkUserList.php?listName=" + obj.message;
                    }

                    if (obj.type == 0) {
                        alert("The list name has already existed!");
                    }
                },
                error: function () {
                    alert("Unexpected error")
                }
            });

        } else {
            alert("Please add at least one word!!!")
        }
    }
}