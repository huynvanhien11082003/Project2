<?php
// Lấy thông tin từ cấu hình trên Render (sẽ setup ở bước sau)
$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');

try {
    // Kết nối PostgreSQL bằng PDO
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    // Thiết lập chế độ báo lỗi
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Tạo bảng dữ liệu nếu chưa có (Tự động tạo bảng khi chạy lần đầu)
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id SERIAL PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->exec($sql);

} catch(PDOException $e) {
    echo "Lỗi kết nối: " . $e->getMessage();
    die();
}
?>