<?php
session_start();
?>
<?php
// KONEKSI DATABASE
$koneksi = new mysqli("localhost", "root", "", "commission_request");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
$koneksi->set_charset("utf8mb4");


// CREATE & UPDATE
if (isset($_POST['submit'])) {

    $id          = $_POST['id'];
    $name        = $_POST['name'];
    $email       = $_POST['email'];
    $description = $_POST['description'];

    $_SESSION['user_email'] = $email;

    if ($id == "") {
        $koneksi->query(
            "INSERT INTO pending_request (name, email, description)
             VALUES ('$name', '$email', '$description')"
        );
    } else {
        $koneksi->query(
            "UPDATE pending_request SET
             name='$name',
             email='$email',
             description='$description'
             WHERE id=$id AND email='$email'"
        );
    }

    header("Location: Contact.php");
}

// DELETE
if (isset($_GET['hapus']) && isset($_SESSION['user_email'])) {
    $id    = $_GET['hapus'];
    $email = $_SESSION['user_email'];

    $koneksi->query(
        "DELETE FROM pending_request
         WHERE id=$id AND email='$email'"
    );

    header("Location: Contact.php");
}


// EDIT (LOAD DATA)
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $koneksi->query("SELECT * FROM pending_request WHERE id=$id");
    $editData = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<!-- DESIGN HALAMAN -->
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NepY.Contact.me</title>
    <link rel="stylesheet" href="stylewebb.css">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
</head>

<body>
<nav>
    <p id="Alias">NepY</p>
    <button class="ThemeButton" id="themebutton">
        <div class="ButtonBall" id="ButtonBall"></div>
    </button>
    <div class="Menu">
        <a href="Index.php">Gallery</a>
        <a href="About.php">About</a>
        <a href="Contact.php" class="active">Contact</a>
    </div>
</nav>

<h1>Contact Me</h1>

<!-- FORM -->
<div class="formContainer">
<form method="POST">
    <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

    <div class="formGroup">
        <label>Your Name</label>
        <input type="text" name="name" required
               value="<?= $editData['name'] ?? '' ?>">
    </div>

    <div class="formGroup">
        <label>Email</label>
        <input type="email" name="email" required
               value="<?= $editData['email'] ?? '' ?>">
    </div>

    <div class="formGroup">
        <label>Description (tuliskan prom illustrasi yang ingin di-request)</label>
        <textarea name="description" required><?= $editData['description'] ?? '' ?></textarea>
    </div>

    <button class="SubmitButton" type="submit" name="submit">
        <?= $editData ? "Update" : "Submit" ?>
    </button>
</form>
</div>

<br><br>

<!-- READ DATA -->
<?php
$email = $_SESSION['user_email'] ?? null;

if ($email) {
    $data = $koneksi->query(
        "SELECT * FROM pending_request
         WHERE email='$email'
         ORDER BY id DESC"
    );
} else {
    $data = false;
}
?>

<h2 style="text-align:center">Pending Commission Requests</h2>

<table border="1" cellpadding="10" align="center" width="90%" height="100">
    <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    <tbody>
    <?php if ($data && $data->num_rows > 0): ?>
        <?php while ($row = $data->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= nl2br(htmlspecialchars($row['description'])) ?></td>
            <td>
                <a href="?edit=<?= $row['id'] ?>">Edit</a> |
                <a href="?hapus=<?= $row['id'] ?>"
                   onclick="return confirm('Yakin hapus request ini?')">
                   Delete
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="4" style="text-align:center">
                No commission request found.
            </td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>


<script src="InteractionJS.js"></script>
</body>
</html>
