<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <title>Form</title>

    <script src="jquery-3.6.4.js"></script>
    <script src="script.js"></script>

</head>
<body>
<button class="MainButtonViolet" onclick="ShowModal('#formreg')">Жмав для регистрации</button>
<button class="MainButtonViolet" onclick="ShowModal('#formsing')">Жмав для входа</button>
<div class="ModalContainer" id="formreg">
    <form action="" class="form" id="form1">

        <div class="FormElement">
            <div class="CloseIcon" onclick="CloseModal('#formreg')">❌</div>
            <div class="header">Регистрация</div>
            <br>
            <label for="loginReg">Введите логин: </label>
            <input type="text" class="textField" name="login" id="loginReg" placeholder="Логин" value="" required><br>
            <label for="MailReg">Введите ваш Email: </label>
            <input type="text" class="textField" name="Mail" id="mailReg" placeholder="Email" value="" required><br>
            <label for="PassReg">Укажите пароль: </label>
            <div class="PasswordInput">
                <input type="password" id="passReg" name="password" class="textField Toggleable" placeholder="Пароль"
                       value="" required>
                <i onclick="togglePass()" id="eye-slash" class="bi bi-eye-slash eye"></i>
            </div>
            <br>
            <label for="passRegConfirm">Повторите пароль: </label>
            <input type="text" class="textField" name="Pass" id="passRegConfirm" placeholder="Пароль" value="" required><br>
            <label for="SexSign">Ваш пол: </label>
            <input type="radio" class="radio" id="Sex0" name="Sex" required>М
            <input type="radio" class="radio" id="Sex1" name="Sex" required>Ж
            <br>
            <div id="form-button">
                <input type="submit" class="MainButtonViolet f-button" value="Зарегистрироваться" id="cbutton">
            </div>
        </div>
    </form>
</div>
<div class="ModalContainer" id="formsing">
    <form action="" class="form" id="form2">
        <div class="FormElement">
            <div class="CloseIcon" onclick="CloseModal('#formsing')">❌</div>
            <div class="header">Вход</div>
            <br>
            <label for="login">Логин или email: </label>
            <input type="text" class="textField" name="loginSing" placeholder="" value="" id="loginKey"
                   required><br>
<!--            <label for="Mail">Ваш Email: </label>-->
<!--            <input type="email" class="textField" name="MailSing" placeholder="Email" value="" id="mailSing"-->
<!--                   required><br>-->
            <div class="InputContainer" id="Password">
                <label for="Pass">Ваш пароль: </label>
                <div class="PasswordInput">
                    <input type="password" id="passSing" name="password" class="textField Toggleable"
                           placeholder="Пароль"
                           value="" required>
                    <i onclick="togglePass()" id="eye-slash" class="bi bi-eye-slash eye"></i>
                </div>
            </div>
            <br>
            <div id="form-button">
                <input type="submit" class="MainButtonViolet f-button" value="Войти" id="cbutton1">
            </div>
        </div>
    </form>
</div>
</body>
<script>
    $('#form1').submit(function (E) {
        E.preventDefault()
        let login = $('#loginReg').val()
        let mail = $('#mailReg').val()
        let pass = $('#passReg').val()
        let passToConfirm = $('#passRegConfirm').val()
        let sex =   $('#Sex0').get(0).checked ? true: false
        if (pass == passToConfirm) {
            if (validateEmail(mail)) {
                if (SaveJSONReg(login, pass, mail, sex)) {
                    Notification("Успешная регистрация!");
                    setTimeout(CloseModal, 1000, '#formreg')
                } else {
                    Notification('Такой пользователь уже существует!')
                }
            } else {
                Notification('Неверный формат почты!').show()
            }

        } else {

            Notification('Пароли не совпадают!').show()
        }
        return false
    })
    $('#form2').submit(function (E) {

        E.preventDefault()
        // let login = $('#loginSing').val()
        // let mail = $('#mailSing').val()
        let pass = $('#passSing').val()
        let loginKey = $('#loginKey').val()
        if (validateEmail(loginKey)){
            CheckUser(loginKey,pass,'mail')
        }
        else(
            CheckUser(loginKey,pass,'login')
        )
        // if (validateEmail(mail)) {
        //
        //
        //     if (JSONRegDataCheckout(login, mail, pass)) {
        //         (AddNotification("Успешный вход!"), setInterval(location.href = 'http://www.yandex.ru/', 1000))
        //     } else {
        //
        //     }
        // } else {
        //     AddNotification('Неверный формат почты')
        // }
        return false
    })
</script>
</html>