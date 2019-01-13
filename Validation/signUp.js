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
            error += 'user name; ';
        }
        if (!checkUserPassword()) {
            error += 'password; ';
        }
        if (!checkUserPassword_Re()) {
            error += 'repeated password; ';
        }
        error = error.substring(0, error.length - 2);
        window.alert("The following content is not validate: " + error + ".");
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
 * This function is used to check if repeated password is valid.
 * @return {boolean}
 */
function checkUserPassword_Re() {
    var userPW_Re = document.getElementById('input_userPWRE').value;
    if (userPW_Re.length > 0 && userPW_Re.length <= 25) {
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