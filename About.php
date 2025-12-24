<?php
// KONEKSI DATABASE
$koneksi = new mysqli("localhost", "root", "", "commission_request");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$data = $koneksi->query("SELECT * FROM artworks");
?>

<!DOCTYPE html>
<!-- DESIGN HALAMAN -->
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NepY.About.me</title>
    <Link rel="stylesheet" href="stylewebb.css">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
</head>

<body>

    <nav>
        <p id="Alias">NepY</p>
        <button class="ThemeButton" id="themebutton">
            <div class="ButtonBall" id="ButtonBall"></div>
        </button>
        <div class="Menu">
            <a href="index.php">Gallery</a>
            <a href="About.php" class="active">About</a>
            <a href="Contact.php">Contact</a>
        </div>
    </nav>

    <h1>About</h1>
    <button class="arrow" id="arrow"></button>
    <br><br>
    <div class="containerAbout">
        <div class="Leftbox_A" id="Leftbox_A">

            <?php $data = $koneksi->query("SELECT * FROM artworks WHERE id = 5");
            $row = $data->fetch_assoc();
            ?>
            <img 
            src="IMG/<?= htmlspecialchars($row['gambar']) ?>" 
            class="pfpAbout" id="pfpAbout"
            oncontextmenu="return false;">

        </div>
                
        <div class="Rightbox_A" id="Rightbox_A">
            <div class="row"><div class="label">Name</div><div class="separator">:</div><div>Nep</div></div>
                <div class="row"><div class="label">Role</div><div class="separator">:</div><div>Illustrator, Character Design</div></div>
                <div class="row"><div class="label">Style</div><div class="separator">:</div><div>Anime</div></div>
                <div class="row"><div class="label">Tools</div><div class="separator">:</div><div>Ibis Paint X, Clip Studio Paint</div></div>
                <div class="row"><div class="label">Notable Works</div><div class="separator">:</div><div>: Original Illustration, FanArt</div></div>

            <p class="CAbout">Just call Nep, this name is actually inspired by <br> 
            a character from games and the initial "Y" is <br>
            refer to My Favorite girl(IYKYK). Doing some <br>
            favorite things like Art Illustration or Design, <br>
            Programming, sometomes rarely try to compose a music, <br>
            and also like to doing editing or animation.</p>

            <p class="CAbout">Me also like gaming, lately mostly play Rhythm games, <br>
            for games recently play is Genshin Impact, Arcaea, Apex Legend</p>
    
        </div>
    </div>

    <p style="font-size: 20px;">Can see more about me through my Social Media</p>
    <div style="background-color: rgb(255, 0, 0); padding: 2.5px;">
        <p style="font-size: 20px; color: white">Twitter/X : 
            <a href="https://x.com/vctrvictorTI" target="_blank">Xwitter_N3pgear~Yurisaki</a> <img src="IMG/1707226109new-twitter-logo-png.png" style="width:25px; vertical-align:middle; margin-right:8px;">
        </p>
    </div>
</body>

<script src="InteractionJS.js"></script>


</html>
