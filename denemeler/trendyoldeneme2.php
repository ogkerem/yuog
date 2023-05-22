<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ID Değerini Kaydet</title>
</head>
<body>
    <h2>ID Değerini Kaydet</h2>
    <form method="post" action="save.php">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id">
        <br><br>
        <button type="submit" name="save">Kaydet</button>
    </form>
</body>
</html>

<?php
// Veritabanı bağlantısı için PDO kullanımı
$host = 'http://188.125.174.145:8880/';
$dbname = 'yuog_db';
$username = 'myusername';
$password = 'mypassword';
$charset = 'utf8mb4';

// PDO nesnesi oluşturma
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Metin kutusundan veri alma ve veritabanına kaydetme
if (isset($_POST['save'])) {
    $idValue = $_POST['id'];
    $stmt = $pdo->prepare("INSERT INTO yusuf_deneme (ID) VALUES (?)");
    $stmt->execute([$idValue]);
    echo "Veri başarıyla kaydedildi.";
}
