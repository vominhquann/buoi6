<?php
$servername = "localhost";
$username = "root";
$dbname = "buoi5php";

// Tạo kết nối
$conn = new mysqli($servername, $username, '' ,$dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("kết nối thất bại: " . $conn->connect_error);
}

echo "kết nối thành công";

// Thực hiện các truy vấn và thao tác với cơ sở dữ liệu

// Thêm dữ liệu
$masv = '10';
$ten = 'quandeptrai';
$ngaysinh = '2002-08-08';
$lop = '2';
$diemtb = '9';

$sql = "INSERT INTO sinhvien (masv, ten, ngaysinh, lop, diemtb) VALUES ('$masv', '$ten', '$ngaysinh', '$lop', '$diemtb')";

if ($conn->query($sql) === TRUE) {
    echo "<br>Thêm dữ liệu thành công";
} else {
    echo "<br>Lỗi: " . $sql . "<br>" . $conn->error;
}
// Cập nhật

$newDiemtb = '9';

$sql = "UPDATE sinhvien SET diemtb='$newDiemtb' WHERE ten LIKE '%quan%'";

if ($conn->query($sql) === TRUE) {
    echo "<br>Cập nhật dữ liệu thành công";
} else {
    echo "<br>Lỗi: " . $sql . "<br>" . $conn->error;
}

// Xóa
$masv = '5';

$sql = "DELETE FROM sinhvien WHERE masv = '$masv'";

if ($conn->query($sql) === TRUE) {
    echo "<br>Xóa dữ liệu thành công";
} else {
    echo "<br>Lỗi: " . $sql . "<br>" . $conn->error;
}

// Hiển thị
$sql = "SELECT * FROM sinhvien";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        echo "<br><br>Mã SV: " . $row["masv"] . "<br>";
        echo "Tên: " . $row["ten"] . "<br>";
        echo "Ngày sinh: " . $row["ngaysinh"] . "<br>";
        echo "Lớp: " . $row["lop"] . "<br>";
        echo "Điểm TB: " . $row["diemtb"] . "<br>";
    }
} else {
    echo "Không có dữ liệu";
}
//đóng kết nối
$conn->close();

?>

