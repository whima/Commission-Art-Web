<?php
session_start();

// ADMIN KEY 
$ADMIN_KEY = "N3PG34R";

if (!isset($_GET['key']) || $_GET['key'] !== $ADMIN_KEY) {
    die("Access forbidden!!");
}

// KONEKSI DB 
$koneksi = new mysqli("localhost", "root", "", "commission_request");
$koneksi->set_charset("utf8mb4");
?>

<!DOCTYPE html>
<!-- DESIGN HALAMAN -->
<html>
<head>
    <title>Admin Panel - Commission</title>
    <style>
        body { font-family: Arial; background:#f4f4f4; }
        table { border-collapse: collapse; width:90%; margin:40px auto; background:#fff; }
        th, td { border:1px solid #333; padding:10px; }
        th { background:#ddd; }
        select { padding:5px; }
    </style>
</head>
<body>

<h2 style="text-align:center">ADMIN PANEL – COMMISSION REQUEST</h2>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Description</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php
$data = $koneksi->query("SELECT * FROM pending_request ORDER BY id DESC");
while ($row = $data->fetch_assoc()):
?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= htmlspecialchars($row['name']) ?></td>
    <td><?= htmlspecialchars($row['email']) ?></td>
    <td><?= nl2br(htmlspecialchars($row['description'])) ?></td>
    <td>
        <form method="POST" style="margin:0">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <select name="status" onchange="this.form.submit()">
                <option <?= $row['status']=='Pending'?'selected':'' ?>>Pending</option>
                <option <?= $row['status']=='Accepted'?'selected':'' ?>>Accepted</option>
                <option <?= $row['status']=='Done'?'selected':'' ?>>Done</option>
            </select>
        </form>
    </td>
    <td>
        <a href="?delete=<?= $row['id'] ?>&key=<?= $ADMIN_KEY ?>"
           onclick="return confirm('Delete request?')">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

</body>
</html>

<?php
// UPDATE STATUS 
if (isset($_POST['id'], $_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $koneksi->query(
        "UPDATE pending_request SET status='$status' WHERE id=$id"
    );
    header("Location: admin.php?key=$ADMIN_KEY");
}

// DELETE 
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $koneksi->query("DELETE FROM pending_request WHERE id=$id");
    header("Location: AtMiN PaGe.php?key=$ADMIN_KEY");
}
?>
