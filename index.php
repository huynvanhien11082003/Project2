<?php 
require 'db.php';

// PHẦN BACKEND: Xử lý thêm dữ liệu
// Code này phải đặt trên cùng, trước khi có bất kỳ HTML nào
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['username'])) {
    $name = $_POST['username'];
    $stmt = $conn->prepare("INSERT INTO users (name) VALUES (:name)");
    $stmt->bindParam(':name', $name);
    $stmt->execute();
    
    // Chuyển trang để tránh gửi lặp form
    header("Location: index.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Project 2 - Render PostgreSQL</title>
    <style>
        body { font-family: sans-serif; max-width: 600px; margin: 2rem auto; padding: 1rem; }
        input, button { padding: 10px; margin-top: 10px; }
        li { margin: 5px 0; border-bottom: 1px solid #ccc; padding: 5px; }
    </style>
</head>
<body>
    <h1>Demo Project 2 (PHP + PostgreSQL)</h1>
    
    <form method="POST">
        <label>Nhập tên sinh viên:</label><br>
        <input type="text" name="username" required placeholder="Ví dụ: Nguyễn Văn A">
        <button type="submit">Lưu vào Database</button>
    </form>

    <hr>
    <h3>Danh sách đã lưu:</h3>
    <ul>
        <?php
        // Lấy dữ liệu từ Database hiển thị ra
        // Kiểm tra xem biến $conn có tồn tại không trước khi query
        if (isset($conn)) {
            $stmt = $conn->query("SELECT * FROM users ORDER BY id DESC");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<li>" . htmlspecialchars($row['name']) . "</li>";
            }
        }
        ?>
    </ul>
</body>
</html>