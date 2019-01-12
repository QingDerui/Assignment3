function showStatus_Know(a) {
    var statusEleId = "status" + a;
    var titleEleId = "title" + a
    console.log(statusEleId);
    var statusEle = document.getElementById(statusEleId);
    statusEle.value = '1';
    var titleEle = document.getElementById(titleEleId);
    titleEle.setAttribute("class", "uk-badge uk-badge-success uk-margin-large-left");
    titleEle.innerText = "know";
}

/**
 * This function is to change an element in the website while clicking a certain button
 * @param a The flag naming which element to change
 */
function showStatus_Unknown(a) {
    var statusEleId = "status" + a;
    var titleEleId = "title" + a
    console.log(statusEleId);
    var statusEle = document.getElementById(statusEleId);
    statusEle.value = '0';
    var titleEle = document.getElementById(titleEleId);
    titleEle.setAttribute("class", "uk-badge uk-badge-danger uk-margin-large-left");
    titleEle.innerText = "unknown";
}

/**
 * To submit a form by <a> element
 * @param a
 */
function submitForm(a) {
    var formName = 'form' + a;
    var form = document.getElementById(formName);
    form.submit();
}

/**
 * To show the scroll bar of the aside element when mouse moves on to it
 */
function showScrollBar() {
    var side = document.getElementById('aside');
    side.setAttribute('style', 'margin-top: 50px;max-height: 500px;overflow-y:scroll;')
}

/**
 * To hide the scroll bar of the aside element when mouse leaves it
 */
function hideScrollBar() {
    var side = document.getElementById('aside');
    side.setAttribute('style', 'margin-top: 50px;max-height: 500px;overflow-y:hidden;')
}

function onClick_section(section) {
    var button = document.getElementById('button_section'.concat(section));
    var event = document.createEvent('MouseEvents');
    event.initMouseEvent('click');
    button.dispatchEvent(event);
}

function checkLogin(login){
    var aref = document.getElementById("upload");
    if(login){
        aref.setAttribute("href","upload.php");
    }else{
        aref.setAttribute("href","login.php");
    }
}