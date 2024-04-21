<?php include('partials-font/menu.php');

// Kiểm tra xem biến $_GET['donhang_id'] đã được gửi từ URL hay chưa
if (isset($_GET['donhang_id'])) {
    // Nếu tồn tại, gán giá trị của nó vào biến $donhang_id
    $donhang_id = $_GET['donhang_id'];

    // Truy vấn SQL để lấy thông tin phản hồi dựa trên donhang_id
    $sql = "SELECT * FROM lien_he WHERE donhang_id = $donhang_id";

    // Thực hiện truy vấn
    $res = mysqli_query($conn, $sql);

    // Kiểm tra xem có bất kỳ dữ liệu nào được trả về không
    if ($res) {
        // Nếu có, hiển thị dữ liệu trong bảng
?>
        <section class="food-menu">
            <div class="container">
                <h2 class="text-center">THÔNG TIN PHẢN HỒI</h2>
                <table>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>SDT</th>
                            <th>Địa chỉ</th>
                            <th>Ngày phản hồi</th>
                            <th>Nội dung</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sn = 1;
                        while ($row = mysqli_fetch_assoc($res)) {
                            echo "<tr>";
                            echo "<td>" . $sn++ . "</td>";
                            echo "<td>" . $row['khach_ten'] . "</td>";
                            echo "<td>" . $row['khach_email'] . "</td>";
                            echo "<td>" . $row['khach_sdt'] . "</td>";
                            echo "<td>" . $row['khach_diachi'] . "</td>";
                            echo "<td>" . $row['ngay'] . "</td>";
                            echo "<td>" . $row['noi_dung'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
<?php
    } else {
        // Nếu không có dữ liệu nào được trả về, bạn có thể hiển thị thông báo cho người dùng
        echo "Không có dữ liệu phản hồi cho đơn hàng này.";
    }
} else {
    // Nếu không có donhang_id được gửi từ URL, bạn có thể hiển thị thông báo hoặc thực hiện hành động phù hợp
    echo "Không tìm thấy đơn hàng.";
}
?>

<?php include('partials-font/footer.php');
