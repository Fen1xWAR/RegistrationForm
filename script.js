// function $(stringSelector) {
//     return {
//         mainObject: document.querySelector(stringSelector),
//         html: function (string) {
//             if (string === undefined) {
//                 return this.mainObject.innerHTML;
//             } else {
//                 this.mainObject.innerHTML = string;
//                 return this;
//             }
//         },
//         hide: function (){
//
//                 this.mainObject.style.display = 'none'
//                 return this
//         },
//         show: function (){
//             let style = window.getComputedStyle(this.mainObject)
//             let display = style.getPropertyValue('display')
//             if (display === undefined ) {
//                 this.mainObject.style.display = ''
//             }
//             else{
//                this.mainObject.style.setProperty('display','block')
//
//             }
//             return this
//         },
//         isShown: function (){
//             return (this.mainObject.style.display !=='none') &&
//                 (getComputedStyle(this.mainObject).getPropertyValue('display')!=='none') &&
//                 (this.mainObject.style.visibility !=='hidden') &&
//                 (getComputedStyle(this.mainObject).getPropertyValue('visibility')!=='hidden')
//         },
//         isHidden: function (){
//             return !this.isShown()
//         },
//         click: function click(eventHandler) {
//
//                 if (eventHandler) {
//                     this.mainObject.addEventListener('click', function (event) {
//                         const callBackResult = eventHandler(event);
//                         if (!callBackResult) {
//                             event.preventDefault();
//                             event.stopPropagation()
//                         }
//                     });
//                 }
//
//                 else {
//                     this.mainObject.click()
//
//                 }
//         }
//     }
// }

// $('.MainButtonViolet').hide()

function validateEmail(email) {
    let re = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
    return re.test(String(email).toLowerCase());
}

function togglePass() {
    let typeOfPassword = $("input[name='password']")
    let eyeIco = $('.eye')
    let value = typeOfPassword.attr('type')
    if (value === 'password') {
        typeOfPassword.attr('type', 'text')
        eyeIco.toggleClass('bi-eye-slash bi-eye')
    } else {
        typeOfPassword.attr('type', 'password')
        eyeIco.toggleClass('bi-eye bi-eye-slash')
    }

}

// function JSONRegDataCheckout(login, mail, password) {
//     if (localStorage.getItem('users') === null) {
//         saveJSON(jsonFileContent)
//     }
//     let JsonFile = localStorage.getItem('users')
//     let JsonData = JSON.parse(JsonFile)
//     let key = login
//     if (JsonData.Users[key] === undefined) {
//         AddNotification('Данного пользователя не существует!')
//         return false
//     } else {
//         RemoveNotification()
//         let currentUser = JsonData.Users[key]
//         if (currentUser.login === login && currentUser.password === password && currentUser.mail === mail) {
//             return true
//         } else {
//             AddNotification("Логин или пароль неверны!")
//             return false
//         }
//     }
// }
function CheckUser(key,pass,checkType){
    if (localStorage.getItem('users') === null) {
         saveJSON(jsonFileContent)
    }
    let JsonFile = localStorage.getItem('users')
    let JsonData = JSON.parse(JsonFile)
    let users = JsonData.Users
    if (checkType === 'mail'){
        for (let User in users){
            //console.log(user)

            console.log(users.User[mail])
        }
    }
    else{

    }
}
const jsonFileContent = '{"Users":{}}';

function saveJSON(jsonfile) {
    localStorage.setItem('users', jsonfile);
}

function SaveJSONReg(login, password, mail, sex) {
    if (localStorage.getItem('users') === null) {
        saveJSON(jsonFileContent)
    }
    let JsonFile = localStorage.getItem('users')
    let JsonData = JSON.parse(JsonFile)
    let key = login

    if (JsonData.Users[key] === undefined) {
        JsonData.Users[key] = {'login': login, 'password': password, 'mail': mail, 'male': sex}
        RemoveNotification()
        JsonFile = JSON.stringify(JsonData)
        saveJSON(JsonFile)
        return true
    } else {
        return false

    }

}


// function AddToggleablePass() {
//     let eye = document.createElement(`i`)
//     eye.classList.add('bi')
//     eye.classList.add('bi-eye-slash')
//     eye.classList.add('eye')
//     let pass = document.getElementsByClassName('Toggleable')[0]
//     pass.parentNode.appendChild(eye)
// }

// function ShowModal(ModalID) {
//     let modal = document.getElementById(ModalID);
//     modal.classList.add("modalShown")
//
// }
function ShowModal(ModalID){
    $(ModalID).addClass('modalShown')
}

// function CloseModal(ModalID) {
//     let modal = document.getElementById(ModalID);
//     modal.classList.remove("modalShown");
//     setTimeout(RemoveNotification, 1000)
// }
function CloseModal(ModalID){
    $(ModalID).removeClass('modalShown')
    setTimeout(RemoveNotification,1000)
}
// function RemoveNotification() {
//     if ((document.getElementsByClassName('AlertPosition')[0])) {
//         document.getElementsByClassName('AlertPosition')[0].removeChild(document.getElementsByClassName('AlertBox')[0])
//         document.getElementsByTagName("body")[0].removeChild(document.getElementsByClassName('AlertPosition')[0])
//     }
// }
function RemoveNotification(){
    if ($('.AlertPosition')){
        this.remove()
    }
}

// function AddNotification(NotificationText) {
//     if (!(document.getElementsByClassName("AlertPosition").length === 0)) {
//         RemoveNotification()
//     }
//     let Notification = document.createElement("div");
//     let NotificationContainer = document.createElement("div");
//     NotificationContainer.classList.add("AlertPosition");
//     Notification.classList.add("AlertBox");
//     Notification.textContent = NotificationText;
//     document.getElementsByTagName("body")[0].appendChild(NotificationContainer);
//     document.getElementsByClassName("AlertPosition")[0].appendChild(Notification);
// }
function Notification(Text,Duration=2000,Root ='body'){
    const Toast = {
        obj: $('<div class="AlertPosition"></div>'),
        text : Text,
        duration: Duration,
        root: Root,
        show: function () {
            $(this.root).append(this.obj)
            this.obj.append('<div class="AlertBox"></div>')
            this.obj.children().text(this.text)
            setTimeout((context)=>{context.hide()},this.duration,this)
        },
       hide: function (){
            this.obj.empty()
            this.obj.remove()

        }

    }
    return Toast
}