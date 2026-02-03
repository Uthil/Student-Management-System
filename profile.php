<!DOCTYPE html>
<html>

<head>
  <title> Εξειδίκευση στα Πληροφοριακά Συστήματα </title>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="styles.css">

</head>

<body>
  <?php
  session_start();
  $role = $_SESSION['role'];
  include("config.php");
  $userid = $_SESSION['Userid'];
  // Έλεγχος αν ο φοιτητής έχει ήδη profile
  $stmt = $con->prepare("SELECT * FROM userprofile WHERE Userid=?");
	$stmt->bind_param("i", $userid);
	$stmt->execute();
	$result = $stmt->get_result();
	$n = $result->num_rows;
  if ($n > 0) {
    $row = $result->fetch_assoc();
    $onomateponymo = $row['Name'];
    $epaggelma = $row['Profession'];
    $linkedin = $row['Linkedin'];
    $facebook = $row['Facebook'];
    $youtube = $row['YouTube'];
    $instagram = $row['Instagram'];
    $twitter = $row['Twitter'];
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $onomateponymo = $_POST['onomateponymo'];
    $epaggelma = $_POST['epaggelma'];
    $linkedin = $_POST['linkedin'];
    $facebook = $_POST['facebook'];
    $youtube = $_POST['youtube'];
    $instagram = $_POST['instagram'];
    $twitter = $_POST['twitter'];
    $stmt->close();
    if ($n == 0) {
      // Δημιουργία νέου προφίλ
      $stmt2 = $con->prepare("INSERT INTO userprofile(Userid, Name, Profession, Linkedin, Facebook, YouTube, Instagram, Twitter) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
	    $stmt2->bind_param("isssssss", $userid, $onomateponymo, $epaggelma, $linkedin, $facebook, $youtube, $instagram, $twitter);
      $result2 = $stmt2->execute();
      if ($result2 == FALSE) {
        $stmt2->close();
        $con->close();
        echo '<script>alert("Error: Δεν ήταν δυνατή η αποθήκευση..."); window.location="profile.php";</script>';
      } else {
        $stmt2->close();
        $con->close();
        echo '<script>alert("Επιτυχής αποθήκευση προφίλ."); window.location="home.php";</script>';
      }
    } else {
      // Ενημέρωση του προφίλ
      $stmt3 = $con->prepare("UPDATE userprofile SET Name = ?, Profession = ?, Linkedin = ?, Facebook = ?, YouTube = ?, Instagram = ?, Twitter = ? WHERE Userid = ?");
      $stmt3->bind_param("sssssssi", $onomateponymo, $epaggelma, $linkedin, $facebook, $youtube, $instagram, $twitter, $userid);
      $result3 = $stmt3->execute();
      if ($result3 == FALSE) {
        $stmt3->close();
        $con->close();
        echo '<script>alert("Error: Δεν ήταν δυνατή η ενημέρωση..."); window.location="profile.php";</script>';
      } else {
        $stmt3->close();
        $con->close();
        echo '<script>alert("Επιτυχής ενημέρωση προφίλ."); window.location="home.php";</script>';
      }
    }
  } else {
  ?>
    <div class="container-fluid">
      <div id="menu">
        <div id="header">
          <nav class="navbar navbar-inverse navbar-expand-lg justify-content-center">
            <a class="navbar-brand" href="home.php">
              <img src="images/logo.png" alt="Logo" style="width:15%"></a>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="home.php"> Αρχική </a>
              </li>
              <?php
              if ($role === 'Φοιτητής') {
                echo "<li><a href='portfolio.php' class='nav-link'>Portfolio Εργασιών</a></li>";
                echo "<li><a href='profile.php' class='nav-link' style='background-color:rgb(129, 139, 139);'>Προφίλ</a></li>";
              } else {
                echo "<li><a href='dimiourgia_ekfonisis.php' class='nav-link'>Δημιουργία Εκφώνησης Εργασίας</a></li>";
                echo "<li><a href='provoli_ergasion.php' class='nav-link'>Προβολή Εργασιών</a></li>";
                echo "<li><a href='eikona_foititi.php' class='nav-link'>Εικόνα Φοιτητή</a></li>";
              }
              ?>
              <li><a href="logout.php" class="btn btn-primary btn-sm" style="margin-top:10%">Έξοδος</a></li>
            </ul>
          </nav>
        </div>
      </div>

      <!--<div id="content">-->
      <div class="row" style="text-align: center;">
        <h4>Προφίλ Χρήστη</h4>
        <p>Για να κρατήσεις επαφή με το ίδρυμα μετά την αποφοίτηση σου, συμπλήρωσε όσο περισσότερα μπορείς!</p>
      </div>
      <div class="row" style="border:1px solid;width:30%;margin:auto;padding-left: 10px;padding-top: 10px;">
        <form method="POST" action="profile.php">
          <p><b>Όνομα και επώνυμο:</b><br>
            <input type="text" <?php if ($n > 0) echo "value='$onomateponymo'"; ?> name="onomateponymo" style="width:95%" placeholder="Πληκτρολογήστε το όνομα και το επώνυμό σας">
          </p>
          <p><b>Επαγγελματική απασχόληση:</b><br>
            <input type="text" <?php if ($n > 0) echo "value='$epaggelma'"; ?> name="epaggelma" style="width: 95%" placeholder="Πληκτρολογήστε την επαγγελματική σας απασχόληση">
          </p>
          <p><b>LinkedIn:</b><br>
            <input type="text" <?php if ($n > 0) echo "value='$linkedin'"; ?> name="linkedin" style="width:95%" placeholder="URL για το λογαριασμό σας στο LinkedIn">
          </p>
          <p><b>Facebook:</b><br>
            <input type="text" <?php if ($n > 0) echo "value='$facebook'"; ?> name="facebook" style="width:95%" placeholder="URL για το λογαριασμό σας στο Facebook">
          </p>
          <p><b>YouTube:</b><br>
            <input type="text" <?php if ($n > 0) echo "value='$youtube'"; ?> name="youtube" style="width:95%" placeholder="URL για το λογαριασμό σας στο YouTube">
          </p>
          <p><b>Instagram</b><br>
            <input type="text" <?php if ($n > 0) echo "value='$instagram'"; ?> name="instagram" style="width:95%" placeholder="URL για το λογαριασμό σας στο Instagram">
          </p>
          <p><b>Twitter/X:</b><br>
            <input type="text" <?php if ($n > 0) echo "value='$twitter'"; ?> name="twitter" style="width:95%" placeholder="URL για το λογαριασμό σας στο Twitter/X">
          </p>
          <p>
            <input type="submit" value="Αποθήκευση" class="btn btn-primary">
          </p>
        </form>
      </div>
      <!--</div>-->
      <div id="footer" style="text-align:center;text-decoration: none; margin-top:2%">
        <a href="oroi.pdf" target="_blank">Όροι Χρήσης</a> |
        <a href="politiki.pdf" target="_blank">Πολιτική απορρήτου</a>
      </div>
    </div>
  <?php
  }
  ?>
</body>

</html>