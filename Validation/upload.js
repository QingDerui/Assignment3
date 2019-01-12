var error_word_ger = '';
var error_word_eng = '';
var error_word_genus = '';
var error_word_example = '';
var error_listName = '';

/**
 * This function is used to check if German words are valid.
 * @return {boolean}
 */
function checkWordGer() {
    var inputs_word_ger = document.getElementsByClassName('input_ger');
    var result = true;
    for (var i = 0; i < inputs_word_ger.length; i++) {
        if (inputs_word_ger[i].value.length > 0 && inputs_word_ger[i].value.length < 90) {
            //
        } else {
            error_word_ger += (i.toString() + "; ");
            result = false;
        }
    }
    return result;
}

/**
 * This function is used to check if English words are valid.
 * @return {boolean}
 */
function checkWordEng() {
    var inputs_word_eng = document.getElementsByClassName('input_eng');
    var result = true;
    for (var i = 0; i < inputs_word_eng.length; i++) {
        if (inputs_word_eng[i].value.length > 0 && inputs_word_eng[i].value.length < 200) {
            //
        } else {
            error_word_eng += (i.toString() + "; ");
            result = false;
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
        error_listName += "list name";
        result = false;
    }
    return result;
}

/**
 * This function is used to check if word genuses are valid.
 * @return {boolean}
 */
function checkWordGenus() {
    var inputs_word_genus = document.getElementsByClassName('select_genus');
    var result = true;
    for (var i = 0; i < inputs_word_genus.length; i++) {
        if (inputs_word_genus[i].value == "m." || inputs_word_genus[i].value == "f." || inputs_word_genus[i].value == "n." || inputs_word_genus[i].value == "pl." || inputs_word_genus[i].value == "-") {
            //
        } else {
            error_word_genus += (i.toString() + "; ");
            result = false;
        }
    }
    return result;
}

/**
 * This function is used to check if examples are valid.
 * @return {boolean}
 */
function checkWordExample() {
    var textareas_word_example = document.getElementsByClassName('textarea_example');
    var result = true;
    for (var i = 0; i < textareas_word_example.length; i++) {
        if (textareas_word_example[i].value.length > 0 && textareas_word_example[i].value.length < 255) {
            //
        } else {
            error_word_example += (i.toString() + "; ");
            result = false;
        }
    }
    return result;
}
