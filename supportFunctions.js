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

function submitForm(a){
    var formName = 'form'+a;
    var form = document.getElementById(formName);
    form.submit();
}

function showScrollBar(){
    var side = document.getElementById('aside');
    side.setAttribute('style','margin-top: 50px;max-height: 500px;overflow-y:scroll;')
}

function hideScrollBar(){
    var side = document.getElementById('aside');
    side.setAttribute('style','margin-top: 50px;max-height: 500px;overflow-y:hidden;')
}