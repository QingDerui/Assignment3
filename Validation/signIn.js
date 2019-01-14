/**
 * This function is used to see if all the input are valid.
 * if returns false, there will be a window.alert.
 * @return {boolean}
 */
function validate() {
    if (checkUserID() && checkUserPassword()) {
        return true;
    } else {
        var error = '';
        if (!checkUserID()) {
            error += 'user name too short or too long; ';
        }
        if (!checkUserPassword()) {
            error += 'password too short or too long; ';
        }
        error = error.substring(0, error.length - 2);
        window.alert("The following content is not valid: " + error + ".");
        return false;
    }
}

/**
 * This function is used to check if user name is valid.
 * @return {boolean}
 */
function checkUserID() {
    var userID = document.getElementById('input_userID').value;
    if (userID.length > 0 && userID.length <= 20) {
        return true;
    } else {
        return false;
    }
}

/**
 * This function is used to check if password is valid.
 * @return {boolean}
 */
function checkUserPassword() {
    var userPW = document.getElementById('input_userPW').value;
    if (userPW.length > 0 && userPW.length <= 25) {
        return true;
    } else {
        return false;
    }
}

/**
 * This function is used to trigger submit of the form.
 * if everything is valid, submit; if not, then do nothing.
 */
function submitForm() {
    if (validate()) {
        var form = document.getElementById('form_user');
        form.submit();
    }
}