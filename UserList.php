<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="table.css">

</head>
<body>
<?php
include("connect.php");
$query = "SELECT * FROM `users`";
$result = $pdo->query($query);;
if ($result->rowCount() > 0) {
    echo "<div style='display: flex; flex-direction: column'>";
    echo "<h1>Пользователи:</h1>";
    echo "<table class='table table-hover'>";
    echo "<tr>
        <th>ID</th>
        <th>Логин</th>
        <th>Email</th>
        <th>Sex</th>
        </tr>";


    foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $row) {

        echo "<tr class='user' onclick='deleteRow(event)' data-id='".$row['ID']."' >";
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['Login'] . "</td>";
        echo "<td>" . $row['Mail'] . "</td>";

        echo "<td>" .(boolval($row['Sex']) ? 'Male':'Female'). "</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</div>";
} else {
    echo "<h1>Записи не найдены!</h1>";
}
?>


</body>
</html>
<script src="jquery-3.6.4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="script.js"></script>
<script !src="">
    function deleteRow(event) {
        let row = event.target.parentNode;
        if (row.tagName.toLowerCase() === 'tr') {
            row.parentNode.removeChild(row)
            let id = row.dataset.id;
            console.log(id)
            $.ajax({
                type: 'POST',
                cache: false,
                dataType: 'text',
                url: '/loginSystem.php',
                data: {"delete": id},
                success: function() {

                    Notification('Удалил)').show();
                    // location.href = '';


                }

            });
        }
    }
</script>

