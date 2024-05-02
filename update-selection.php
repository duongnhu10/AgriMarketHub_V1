<?php
include('config/constants.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["itemId"]) && isset($_POST["isSelected"])) {

    // Nhận dữ liệu từ yêu cầu AJAX
    $itemId = $_POST["itemId"];
    $isSelected = $_POST["isSelected"];

    // Cập nhật cơ sở dữ liệu dựa trên dữ liệu nhận được
    $sql = "UPDATE gio_hang SET chon = $isSelected WHERE id = $itemId";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Trả về phản hồi thành công nếu cập nhật thành công
        echo "Cập nhật thành công.";
    } else {
        // Trả về phản hồi lỗi nếu cập nhật thất bại
        echo "Có lỗi xảy ra khi cập nhật.";
    }
} else {
    // Trả về phản hồi lỗi nếu dữ liệu không hợp lệ
    echo "Dữ liệu không hợp lệ.";
}
