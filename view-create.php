<?php
require_once 'database.php';
require_once 'pelanggan.php';

// Koneksi ke database
$database = new Database();
$db = $database->getConnection();

// Membuat objek pelanggan
$pelanggan = new Pelanggan($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pelanggan->name = $_POST['name'];
    $pelanggan->email = $_POST['email'];
    $pelanggan->phone = $_POST['phone'];
    
    if ($pelanggan->create()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal menambah pelanggan.";
    }
}
ob_start();
?>

    <h1>Add New Pelanggan</h1>

    <form action="view-create.php" method="POST">
        <div class="mb-2">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" id="name" required><br>
        </div>

        <div class="mb-2">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" id="email" required><br>

        </div>

        <div class="mb-2">
            <label for="phone">Phone number:</label>
            <input type="text" class="form-control" name="phone" id="phone" required><br><br>

        </div>

        <input type="submit" class="btn btn-primary w-100" value="Tambah Pelanggan">
    </form>

    <br>
    <a href="index.php">Kembali ke Daftar Pelanggan</a>

<?php
    $content = ob_get_clean();

    // Include the layout template and pass the content
    include 'layout.php';
?>


