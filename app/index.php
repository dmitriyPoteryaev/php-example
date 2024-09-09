<?php
include "./utils/class.php";


$state = new State;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_POST['button1'])) {

        $host = 'php-example_mysql_1';
$db = 'my_database'; // Замените на имя вашей базы данных
$user = 'user'; // Замените на ваше имя пользователя
$pass = 'user_password'; // Замените на ваш пароль
$charset = 'utf8mb4';

// Создание DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Опции для PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Создание PDO объекта
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    // SQL запрос на вставку данных
    $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";

    // Подготовка запроса
    $stmt = $pdo->prepare($sql);

    // Присвоение значений
    $username = 'new_user';
    $email = 'user@example.com';
    $password = password_hash('user_password', PASSWORD_DEFAULT); // Хеширование пароля

    // Выполнение запроса с передачей параметров
    $stmt->execute(['username' => $username, 'email' => $email, 'password' => $password]);

     // После успешной вставки делаем редирект, чтобы избежать повторной отправки данных при перезагрузке

    echo "Новый пользователь успешно добавлен!";
} catch (PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
}

            $tmp_name = $_FILES["filename"]["tmp_name"];

            //  save xml file

             $state->createCSV($tmp_name);



} if($_SERVER['REQUEST_METHOD'] === 'GET' || $state->error) {

?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>AKYTEC</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <main class="main">
            <div class="wrapper_form">
                <h2> Save xml-file on server and convert to csv-file</h2>
                <form class="form" method="post" enctype="multipart/form-data">
                    <label class="save">
                        <input type="file" name="filename" />
                        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                        <input type="submit" name="button1" value="Кнопка 1">
                        <button id="save_btn" name="save">Save on server</button>
                    </label>
                    <span class="error">
                        <?php
                        echo $state->error;
                        ?>
                    </span>
                </form>
            </div>
        </main> 

    </body>
    </html>

    <?php
};
