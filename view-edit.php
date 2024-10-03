<?php
require_once 'database.php';
require_once 'pelanggan.php';

// Koneksi ke database
$database = new Database();
$db = $database->getConnection();

// Membuat objek pelanggan
$pelanggan = new Pelanggan($db);

// Mendapatkan ID pelanggan dari URL
$pelanggan->id = isset($_GET['id']) ? $_GET['id'] : die('Error: ID tidak ditemukan.');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pelanggan->name = $_POST['name'];
    $pelanggan->email = $_POST['email'];
    $pelanggan->phone = $_POST['phone'];
    
    if ($pelanggan->update()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal mengupdate pelanggan.";
    }
} else {
    // Mendapatkan data pelanggan berdasarkan ID
    $stmt = $pelanggan->show($pelanggan->id);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    /* var_dump($data);
    exit; */

    $pelanggan->name = $data['name'];
    $pelanggan->email = $data['email'];
    $pelanggan->phone = $data['phone'];
}

ob_start();
?>

<h1>Edit Pelanggan</h1>

<form action="view-edit.php?id=<?php echo $pelanggan->id; ?>" method="POST">
    <div class="mb-2">
        <label for="name">Nama:</label>
        <input type="text" class="form-control" name="name" id="name" value="<?php echo $pelanggan->name; ?>" required><br>

    </div>

    <div class="mb-2">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" id="email" value="<?php echo $pelanggan->email; ?>" required><br>

    </div>
    
    <div class="mb-2">
        <label for="phone">Telepon:</label>
        <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $pelanggan->phone; ?>" required><br><br>

    </div>

    <input type="submit" class="btn btn-warning w-100" value="Update Pelanggan">
</form>

<br>
<a href="index.php">Kembali ke Daftar Pelanggan</a>

<?php
    $content = ob_get_clean();

    // Include the layout template and pass the content
    include 'layout.php';
?>