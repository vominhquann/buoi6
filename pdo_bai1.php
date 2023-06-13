<?php
$servername = "localhost";
$username = "root";
$dbname = "buoi5php";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Kết nối thành công";
   // Thêm dữ liệu
    $masv = '100';
    $ten = 'quandeptrai';
    $ngaysinh = '2002-08-08';
    $lop = '2';
    $diemtb = '9';

    $sql = "INSERT INTO sinhvien (masv, ten, ngaysinh, lop, diemtb) VALUES (:masv, :ten, :ngaysinh, :lop, :diemtb)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':masv', $masv);
    $stmt->bindParam(':ten', $ten);
    $stmt->bindParam(':ngaysinh', $ngaysinh);
    $stmt->bindParam(':lop', $lop);
    $stmt->bindParam(':diemtb', $diemtb);
    $stmt->execute();
    echo "<br>Thêm dữ liệu thành công";

// Cập nhật dữ liệu

    $newDiemtb = '9';
    $sql = "UPDATE sinhvien SET diemtb = :newDiemtb WHERE ten LIKE '%quan%'";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':newDiemtb', $newDiemtb);
    $stmt->execute();
    echo "<br>Cập nhật dữ liệu thành công";

// Xóa dữ liệu

    $masv = '5';
    $sql = "DELETE FROM sinhvien WHERE masv = :masv";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':masv', $masv);
    $stmt->execute();
    echo "<br>Xóa dữ liệu thành công";

// Hiển thị dữ liệu

    $sql = "SELECT * FROM sinhvien";
    $stmt = $conn->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        foreach ($result as $row) {
            echo "<br><br>Mã SV: " . $row["masv"] . "<br>";
            echo "Tên: " . $row["ten"] . "<br>";
            echo "Ngày sinh: " . $row["ngaysinh"] . "<br>";
            echo "Lớp: " . $row["lop"] . "<br>";
            echo "Điểm TB: " . $row["diemtb"] . "<br>";
        }
    } else {
        echo "Không có dữ liệu";
    }
} catch (PDOException $e) {
    echo "Lỗi kết nối: " . $e->getMessage();
}

$conn = null;
?>
