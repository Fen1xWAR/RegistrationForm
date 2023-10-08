<?php
if (isset($_POST['register'])) {

    $data = ($_POST['register']);


    if ($data) {
        $login = $data['login'];
        $mail = $data['mail'];
        $pass = password_hash($data['pass'],PASSWORD_DEFAULT);
        $sex = boolval($data['sex']);

        $host = 'localhost';
        $db = 'users';
        $user = 'root';
        $password = 'Aa220377!';
        $port = 3306;

        $db = new mysqli($host, $user, $password, $db, $port);
        if ($db->connect_errno) {

            echo "Failed to connect";
        }
        $sql = "SELECT id from users WHERE mail = '$mail' LIMIT 1";
        $res = mysqli_query($db, $sql);
        $row = mysqli_num_rows($res);
        if ($row){
            echo "Пользователь с данным email уже существует!";
        }
        else{
            $sql = "SELECT id from users WHERE login = '$login' LIMIT 1";
            $res = mysqli_query($db, $sql);
            $row = mysqli_num_rows($res);
            if (!$row) {

                $sql = "INSERT INTO users (login, mail, password ,sex) VALUES ('$login', '$mail', '$pass', '$sex')";
                $db->query($sql);

                $db->close();

                echo "Успешная регистрация";
            }
            else{
                $db->close();
                echo "Пользователь с данным ником уже существует!";
            }
        }

    } else {
        echo "Error!";
    }
    return;

} else if(isset($_POST['login'])) {
    $data = ($_POST['login']);
    if ($data) {
        $login = $data['login'];
        $pass = $data['pass'];

        $host = 'localhost';
        $db = 'users';
        $user = 'root';
        $password = 'Aa220377!';
        $port = 3306;

        $db = new mysqli($host, $user, $password, $db, $port);
        if ($db->connect_errno) {

            echo "Failed to connect";
        }

        $sql =  "SELECT COUNT(*) as count FROM users WHERE login = '$login'";
        $res = mysqli_query($db, $sql);
        $row = $res->fetch_assoc();
        $count = $row['count'];
        if ($count> 0) {

            $sql = "SELECT password FROM users WHERE login = '$login'";
            $result = $db->query($sql);
            $row = $result->fetch_assoc();
            $passFromDb = $row['password'];

            if (password_verify($pass, $passFromDb)){
                echo "Успешный вход";
                $db->close();
            }
            else{
                $db->close();
                echo "Пароли неверны";
            }
        }
        else{
            $db->close();
            echo "Пользователя не существует";
        }
    } else {
        echo "Error!";
    }
}

