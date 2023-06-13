<?php
$servername = "localhost";
$username = "root";
$dbname = "buoi5php";

// Tạo kết nối
$conn = new mysqli($servername, $username, '' ,$dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

echo "Kết nối thành công";

// Thực hiện các truy vấn và thao tác với cơ sở dữ liệu

// Thêm, cập nhật

$sql1 = "ALTER TABLE lichsugiaodich ADD COLUMN id INT PRIMARY KEY AUTO_INCREMENT FIRST";
$conn->query($sql1);

// Cập nhật giá trị "id" cho từng giao dịch
$sql2 = "SET @id = 0";
$conn->query($sql2);

$sql3 = "UPDATE lichsugiaodich SET id = (@id := @id + 1) ORDER BY ngaygiaodich";
$conn->query($sql3);

echo "<br>Thêm cột và cập nhật giá trị thành công.";

// Xóa

$sql = "DELETE FROM lichsugiaodich WHERE sotien = '150'";

if ($conn->query($sql) === TRUE) {
    echo "<br>Xóa dữ liệu thành công";
} else {
    echo "<br>Lỗi: " . $sql . "<br>" . $conn->error;
}

// Hiển thị

$sql = "SELECT * FROM lichsugiaodich";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        echo "<br><br>ID: " . $row["id"] . "<br>";
        echo "Ngày giao dịch: " . $row["ngaygiaodich"] . "<br>";
        echo "Loại giao dịch: " . $row["loaigiaodich"] . "<br>";
        echo "Số tiền: " . $row["sotien"] . "<br>";
        echo "Mô tả: " . $row["mota"] . "<br>";
    }
} else {
    echo "Không có dữ liệu";
}

// Đóng kết nối
$conn->close();
?>