<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

</body>
</html>
<?php
$host = 'localhost';
$db = 'users';
$user = 'root';
$password = 'Aa220377!';
$port = 3306;

$db = new mysqli($host, $user, $password, $db, $port);


if ($db->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
    exit;
}


$query = "SELECT * FROM users";
$result = $db->query($query);

if ($result->num_rows > 0) {
    echo "<div style='display: flex; flex-direction: column'>";
    echo "<h1>Пользователи:</h1>";
    echo "<table>";
    echo "<tr>
        <th>ID</th>
        <th>Логин</th>
        <th>Email</th>
        <th>Sex</th>
        </tr>";


    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['Login'] . "</td>";
        echo "<td>" . $row['Mail'] . "</td>";

        echo "<td>" . $row['Sex'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</div>";
} else {
    echo "<h1>Записи не найдены!</h1>";
}

$db->close();