<?php
require_once 'database.php';
require_once 'pelanggan.php';

// Koneksi ke database
$database = new Database();
$db = $database->getConnection();

// Membuat objek pelanggan
$pelanggan = new Pelanggan($db);

// Membaca data pelanggan
$stmt = $pelanggan->read();
$num = $stmt->rowCount();
// var_dump($num);

// Example dynamic data
$title = "Daftar Pelanggan";

// Start output buffering to capture the content
ob_start();
?>

<h1>List Pelanggan</h1>

<a href="view-create.php" class="btn btn-primary mb-3">Tambah Pelanggan</a>

<?php
// Assuming you already have $stmt from your query
if ($num > 0) {
    echo "<table class='table table-bordered'>";
    echo "<thead class='table-dark'><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Aksi</th></tr></thead>";
    echo "<tbody>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        echo "<tr>";
        echo "<td>{$id}</td>";
        echo "<td>{$name}</td>";
        echo "<td>{$email}</td>";
        echo "<td>{$phone}</td>";
        echo "<td>";
        echo "<a href='view-edit.php?id={$id}' class='btn btn-sm btn-warning'>Edit</a> ";
        echo "<a href='delete.php?id={$id}' class='btn btn-sm btn-danger' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p class='alert alert-info'>Tidak ada data pelanggan.</p>";
}

// Capture the content for the layout
$content = ob_get_clean();

// Include the layout template and pass the content
include 'layout.php';
?>