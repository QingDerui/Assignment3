/**
 * This function is used to see if all the input are valid.
 * if returns false, there will be a window.alert.
 * @return {boolean}
 */
function validate() {
    if (checkUserID() && checkUserPassword() && checkUserPassword_Re()) {
        return true;
    } else {
        var error = '';
        if (!checkUserID()) {
            error += 'user name should contain at least 8 and at most 20 characters; ';
        }
        if (!checkUserPassword()) {
            error += 'password should contain at least 8 and at most 20 characters; ';
        }
        if (!checkUserPassword_Re()) {
            error += 'repeated password should contain at least 8 and at most 20 characters; ';
        }
        error = error.substring(0, error.length - 2);
        window.alert("Your input is not valid: " + error + ".");
        return false;
    }
}

/**
 * This function is used to check if user name is valid.
 * @return {boolean}
 */
function checkUserID() {
    var userID = document.getElementById('input_userID').value;
    if (userID.length >= 8 && userID.length <= 20) {
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
    if (userPW.length >= 8 && userPW.length <= 25) {
        return true;
    } else {
        return false;
    }
}

/**
 * This function is used to check if repeated password is valid.
 * @return {boolean}
 */
function checkUserPassword_Re() {
    var userPW_Re = document.getElementById('input_userPWRE').value;
    if (userPW_Re.length >= 8 && userPW_Re.length <= 25) {
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