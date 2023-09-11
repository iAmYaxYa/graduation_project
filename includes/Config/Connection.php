<?php
define('SERVER', 'localhost');
define('USER_NAME', 'root');
define('PASSWORD', '');
define('DB_NAME', 'al_furaat');
define('DNS', 'mysql:host=' . SERVER . ';dbname=' . DB_NAME);


try {
    $conn = new PDO(DNS, USER_NAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Fadlan Cilad ayaa kaa heysato' . $e->getMessage();
}
