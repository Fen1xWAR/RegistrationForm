<?php
include("connect.php");
//if (isset($_POST['register'])) {
//
//    $data = ($_POST['register']);
//
//
//    if ($data) {
//        $login = $data['login'];
//        $mail = $data['mail'];
//        $pass = password_hash($data['pass'],PASSWORD_DEFAULT);
//        $sex = boolval($data['sex']);
//        if ($db){
//            $smtm  = $db->prepare("SELECT id from users WHERE mail = :mail LIMIT 1");
//            $smtm-> bindValue(':mail', $mail, PDO::PARAM_STR);
//            $smtm->execute();
//           echo  $smtm->fetch(PDO::FETCH_ASSOC);
//
//
//        }
//
////        if ($db->connect_errno) {
////
////            echo "Failed to connect";
////        }
////        $sql = "SELECT id from users WHERE mail = '$mail' LIMIT 1";
////        $res = mysqli_query($db, $sql);
////        $row = mysqli_num_rows($res);
////        if ($row){
////            echo "Пользователь с данным email уже существует!";
////        }
////        else{
////            $sql = "SELECT id from users WHERE login = '$login' LIMIT 1";
////            $res = mysqli_query($db, $sql);
////            $row = mysqli_num_rows($res);
////            if (!$row) {
////
////                $sql = "INSERT INTO users (login, mail, password ,sex) VALUES ('$login', '$mail', '$pass', '$sex')";
////                $db->query($sql);
////
////                $db->close();
////
////                echo "Успешная регистрация";
////            }
////            else{
////                $db->close();
////                echo "Пользователь с данным ником уже существует!";
////            }
////        }
////
////    } else {
////        echo "Error!";
//    }
//    return;
//
//} else if(isset($_POST['login'])) {
//    $data = ($_POST['login']);
//    if ($data) {
//        $login = $data['login'];
//        $pass = $data['pass'];
//
//
//
//        $db = new mysqli($host, $user, $password, $db, $port);
////        if ($db->connect_errno) {
////
////            echo "Failed to connect";
////        }
//
//        $sql =  "SELECT COUNT(*) as count FROM users WHERE login = '$login'";
//        $res = mysqli_query($db, $sql);
//        $row = $res->fetch_assoc();
//        $count = $row['count'];
//        if ($count> 0) {
//
//            $sql = "SELECT password FROM users WHERE login = '$login'";
//            $result = $db->query($sql);
//            $row = $result->fetch_assoc();
//            $passFromDb = $row['password'];
//
//            if (password_verify($pass, $passFromDb)){
//                echo "Успешный вход";
//                $db->close();
//            }
//            else{
//                $db->close();
//                echo "Пароли неверны";
//            }
//        }
//        else{
//            $db->close();
//            echo "Пользователя не существует";
//        }
//    } else {
//        echo "Error!";
//    }
//}
//
if (isset($_POST['register'])) {
    $data = $_POST['register'];
    if ($data) {
        $login = $data['login'];
        $mail = $data['mail'];
        $pass = password_hash($data['pass'], PASSWORD_DEFAULT);
        $sex = $data['sex']=='1'? 1:0;

        $sql = "SELECT ID from users WHERE Mail = :mail LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['mail' => $mail]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            echo "Пользователь с данным email уже существует!";
        } else {
            $sql = "SELECT id from users WHERE Login = :login LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['login' => $login]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$row) {
                $sql = "INSERT INTO users (Login, Mail, Password, Sex) VALUES (:login, :mail, :password, :sex)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['login' => $login, 'mail' => $mail, 'password' => $pass, 'sex' => $sex]);
                echo "Успешная регистрация";
            } else {
                echo "Пользователь с данным ником уже существует!";
            }
        }
    } else {
        echo "Error!";
    }
    return;
} else if (isset($_POST['login'])) {
    $data = $_POST['login'];
    if ($data) {
        $login = $data['login'];
        $pass = $data['pass'];

        $sql = "SELECT COUNT(*) as count FROM users WHERE Login = :login";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['login' => $login]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $row['count'];
        if ($count > 0) {
            $sql = "SELECT Password FROM users WHERE Login = :login";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['login' => $login]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $passFromDb = $row['Password'];
            if (password_verify($pass, $passFromDb)) {
                echo "Вход выполнен успешно!";
            } else {
                echo "Неверный пароль!";
            }
        } else {
            echo "Пользователь не найден!";
        }
    } else {
        echo "Error!";
    }
    return;
}
else if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    $pdo->prepare('DELETE FROM users WHERE ID = :id')->execute(['id'=>$id]);
}
