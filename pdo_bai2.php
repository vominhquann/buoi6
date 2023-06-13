<?php
$servername = "localhost";
$username = "root";
$dbname = "buoi5php";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Kết nối thành công";

// Thêm

$sql = "INSERT INTO lichsugiaodich (ngaygiaodich, loaigiaodich, sotien, mota) VALUES (:ngaygiaodich, :loaigiaodich, :sotien, :mota)";

    $stmt = $conn->prepare($sql);

    $ngaygiaodich = '2023-06-13';
    $loaigiaodich = 'Mua hàng';
    $sotien = 2000;
    $mota = 'Giao dịch mua hàng online';

    $stmt->bindParam(':ngaygiaodich', $ngaygiaodich);
    $stmt->bindParam(':loaigiaodich', $loaigiaodich);
    $stmt->bindParam(':sotien', $sotien);
    $stmt->bindParam(':mota', $mota);

    $stmt->execute();

    echo "<br>Giao dịch mới đã được thêm thành công";


// Sửa

    $sql2 = "SET @id = 10";
    $conn->exec($sql2);

    $sql3 = "UPDATE lichsugiaodich SET id = (@id := @id + 1) ORDER BY ngaygiaodich";
    $conn->exec($sql3);

    echo "<br>cập nhật giá trị thành công.";

// Xóa
    $sql = "DELETE FROM lichsugiaodich WHERE sotien = '200'";
    $affectedRows = $conn->exec($sql);

    if ($affectedRows > 0) {
        echo "<br>Xóa dữ liệu thành công";
    } else {
        echo "<br>Không có bản ghi nào bị xóa";
    }

// Hiển thị

    $sql = "SELECT * FROM lichsugiaodich";
    $stmt = $conn->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        foreach ($result as $row) {
            echo "<br><br>ID: " . $row["id"] . "<br>";
            echo "Ngày giao dịch: " . $row["ngaygiaodich"] . "<br>";
            echo "Loại giao dịch: " . $row["loaigiaodich"] . "<br>";
            echo "Số tiền: " . $row["sotien"] . "<br>";
            echo "Mô tả: " . $row["mota"] . "<br>";
        }
    } else {
        echo "Không có dữ liệu";
    }
} catch (PDOException $e) {
    echo "Lỗi kết nối: " . $e->getMessage();
}

$conn = null;
?>
