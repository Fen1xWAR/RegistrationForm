
document.getElementById('formreg').onsubmit = function (e) {
    e.preventDefault();
    e.stopPropagation();

    let login = document.getElementById("loginReg").value
    let mail = document.getElementById("mailReg").value
    let pass = document.getElementById("passReg").value
    let sex = document.getElementById("Sex0").checked
    if (validateEmail(mail)){
        if ( SaveJSONReg(login,pass,mail,sex)) {
            AddNotification("Успешная регистрация!");
            setTimeout(CloseModal,1000,'formreg')
        }
        else{
            AddNotification('Такой пользователь уже существует!')
        }
    }
    else{
        AddNotification('Неверный формат почты!')
    }

}
document.getElementById('formsing').onsubmit = function (e) {
    e.preventDefault();
    e.stopPropagation();
    let login = document.getElementById("loginSing").value
    let mail = document.getElementById("mailSing").value
    let pass = document.getElementById("passSing").value
    JSONRegDataCheackout(login,mail,pass) ? (AddNotification("Успешный вход!"), setInterval(location.href = 'http://www.yandex.ru/', 1000)) : AddNotification("Логин или пароль неверны!")
}
function validateEmail(email) {
    const mailSample = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
    return mailSample.test(String(email).toLowerCase());
}
function TooglePassword() {
    let typeOfPassword = $("input[name='password']")
    let eyeIco = $('.eye')
    let value = typeOfPassword.attr('type')
    if (value == 'password'){
        typeOfPassword.attr('type','text')
        eyeIco.toggleClass('bi-eye-slash bi-eye')
    }
    else{
        typeOfPassword.attr('type','password')
        eyeIco.toggleClass  ('bi-eye bi-eye-slash')
    }
}
function  JSONRegDataCheackout(login,mail,password){
    let JsonFile = localStorage.getItem('users')
    let JsonData = JSON.parse(JsonFile)
    let key = login
    if (JsonData.Users[key] == undefined){
        AddNotification('Данного пользователя не существует!')
        return false
    }
    else{
        RemoveNotification()
        let currentUser   =  JsonData.Users[key]
        if(currentUser.login == login && currentUser.password == password && currentUser.mail == mail){
            return true
        }
        else{
            return false
        }
    }
}

var jsonFileContent = '{"Users":{}}';
function saveJSON(jsonfile){
    localStorage.setItem('users',jsonfile);
}
function SaveJSONReg(login,password,mail,sex){
    if (localStorage.getItem('users') == undefined){
        saveJSON(jsonFileContent)
    }
    let JsonFile = localStorage.getItem('users')
    let JsonData = JSON.parse(JsonFile)
    let key = login

    if (JsonData.Users[key] == undefined){
        JsonData.Users[key] = {'login':login,'password':password,'mail':mail,'male':sex}
        RemoveNotification()
        JsonFile = JSON.stringify(JsonData)
        saveJSON(JsonFile)
        return true
    }
    else{
        return false

    }

}

function AddToggleablePass() {
    let eye = document.createElement(`i`)
    eye.classList.add('bi')
    eye.classList.add('bi-eye-slash')
    eye.classList.add('eye')
    let pass = document.getElementsByClassName('Toggleable')[0]
    pass.parentNode.appendChild(eye)
}


function ShowModal(ModalID) {
    let modal = document.getElementById(ModalID);
    modal.classList.add("modalShown")

}

function CloseModal(ModalID) {
    let modal = document.getElementById(ModalID);
    modal.classList.remove("modalShown");
    setTimeout(RemoveNotification(),1000)
}

function RemoveNotification() {
    if ((document.getElementsByClassName('AlertPosition')[0])) {
        document.getElementsByClassName('AlertPosition')[0].removeChild(document.getElementsByClassName('AlertBox')[0])
        document.getElementsByTagName("body")[0].removeChild(document.getElementsByClassName('AlertPosition')[0])
    }
}

function AddNotification(NotificationText) {
    if (document.getElementsByClassName("AlertPosition").length == 0) {
        let Notification = document.createElement("div");
        let NotificationContainer = document.createElement("div");
        NotificationContainer.classList.add("AlertPosition");
        Notification.classList.add("AlertBox");
        Notification.textContent = NotificationText;
        document.getElementsByTagName("body")[0].appendChild(NotificationContainer);
        document.getElementsByClassName("AlertPosition")[0].appendChild(Notification);
    }
    else{
        RemoveNotification()
    }
}