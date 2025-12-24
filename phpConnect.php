<?php
// =======================
// KONEKSI DATABASE
// =======================
$koneksi = new mysqli("localhost", "root", "", "commission_request");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// =======================
// AMBIL DATA ARTWORK
// =======================
$data = $koneksi->query("SELECT * FROM artworks");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NepY.Gallery.me</title>

    <link rel="stylesheet" href="stylewebb.css">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
</head>

<body>

<nav>
    <p id="Alias">NepY</p>
    <div>
        <div class="divbutton">
            <div class="butten">
                <button class="ThemeButton" id="themebutton">
                    <div class="ButtonBall" id="ButtonBall"></div>
                </button>
            </div>

            <div class="Menu">
                <a href="Index.php" class="active">Gallery</a>
                <a href="Aboutv2.php">About</a>
                <a href="Contactv2.php">Contact</a>
            </div>
        </div>
    </div>
</nav>

<div class="container">

    <!-- LEFT BOX -->
    <div class="Leftbox_G">
        <p class="AsStrong">WORKS</p>
        <p class="AsStrong">ART / ILLUSTRATION</p>
        <br>

        <?php while ($row = $data->fetch_assoc()) { ?>
            <p class="AsStrong"><?= htmlspecialchars($row['kategori']) ?></p>
            <img 
                src="IMG/<?= htmlspecialchars($row['gambar']) ?>" 
                class="Sample"
                oncontextmenu="return false;"
            >
        <?php } ?>
    </div>

    <!-- CENTER BOX -->
    <div class="Centerbox_G">
        <p class="AsSize">DESCRIPTION</p>
        <br><br><br><br>

        <?php
        $data->data_seek(0); // reset pointer
        while ($row = $data->fetch_assoc()) {
        ?>
            <p class="ContentSize" style="margin-bottom: 200px;">
                <?= htmlspecialchars($row['deskripsi']) ?>
            </p>
        <?php } ?>
    </div>

    <!-- RIGHT BOX -->
    <div class="Rightbox_G">
        <p class="ContentList">Illust</p>
        <br>
        <p class="ContentList">Char Design</p>
    </div>

</div>

<script src="InteractionJS.js"></script>

</body>
</html>
