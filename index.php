<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Akytec</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<form action="index.php" method="post">
    Имя:  <input type="text" name="personal[name]" /><br />
    Email: <input type="text" name="personal[email]" /><br />
    Пиво: <br />
    <select multiple name="beer[]">
        <option value="warthog">Warthog</option>
        <option value="guinness">Guinness</option>
        <option value="stuttgarter">Stuttgarter Schwabenbräu</option>
    </select><br />
    <input type="submit" value="Отправь меня!" />
</form>

</html>

<?php

// echo count($_POST);

// echo var_dump($_POST);

 $isEmpty_name = (bool) $_POST["personal"]["name"];

 $isEmpty_email = (bool) $_POST["personal"]["email"];

if ($isEmpty_name && $isEmpty_email) {

    echo  htmlspecialchars("{$_POST["personal"]["name"]}");

 
} else {

    echo  "Вы ничего не ввели";

}


// This is comment
?>