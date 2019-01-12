var error = '';

/**
 * This function is used to check if the content in the table is valid.
 * @return {boolean}
 */
function checkTable() {
    var inputs_word_ger = document.getElementsByClassName('input_ger');
    var inputs_word_eng = document.getElementsByClassName('input_eng');
    var selects_word_genus = document.getElementsByClassName('select_genus');
    var textareas_word_example = document.getElementsByClassName('textarea_example');
    var result = true;

    for (var i = 0; i < inputs_word_ger.length; i++) {
        // word_ger and word_eng are both null
        if (inputs_word_ger[i].value.length == 0 && inputs_word_eng[i].value.length == 0) {
            // word_ger and word_eng are both null and example is not null.
            if (textareas_word_example[i].value.length != 0) {
                error += "Line " + (i + 1).toString() + ": Can't write example for null word.\n";
                result = false;
            }// everything in this line is null
            else {
                continue;
            }
            // one of ger and eng is null
        } else if ((inputs_word_ger[i].value.length == 0 && inputs_word_eng[i].value.length != 0) || (inputs_word_ger[i].value.length != 0 && inputs_word_eng[i].value.length == 0)) {
            error += 'Line ' + (i + 1).toString() + ': Word or word translation is null.\n';
            result = false;
            // ger and eng are not null
        } else {
            // check German word
            if (inputs_word_ger[i].value.length < 90) {
                //
            } else {
                error += 'Line ' + (i + 1).toString() + ': German word too long.\n';
                result = false;
            }
            // check English word
            if (inputs_word_eng[i].value.length < 200) {
                //
            } else {
                error += 'Line ' + (i + 1).toString() + ': English word too long.\n';
                result = false;
            }
            // check genus
            if (selects_word_genus[i].value == "m." || selects_word_genus[i].value == "f." || selects_word_genus[i].value == "n." || selects_word_genus[i].value == "pl." || selects_word_genus[i].value == "-") {
                //
            } else {
                error += 'Line ' + (i + 1).toString() + ': Genus is not in correct form.\n';
                result = false;
            }
            // check example
            if (textareas_word_example[i].value.length < 255) {
                //
            } else {
                error += 'Line ' + (i + 1).toString() + ': Example too long.\n';
                result = false;
            }
        }
    }
    return result;
}

/**
 * This function is used to check if list name is valid.
 * @return {boolean}
 */
function checkListName() {
    var listName = document.getElementById('listName').value;
    var result = true;
    if (listName.length > 0 && listName.length < 90) {
        //
    } else {
        error += "List name null or too long.\n";
        result = false;
    }
    return result;
}

/**
 * check if the whole content is valid.
 * @return {boolean}
 */
function validate() {
    if (checkListName() && checkTable()) {
        return true;
    } else {
        return false;
    }
}

/**
 * This function is used to submit the form.
 * If the content is valid, submit; if not, generates an alert.
 */
function submit() {
    if (validate()) {
        jsonSubmit();
    } else {
        window.alert("Your input has the following error:\n" + error);
        error = '';
    }
}