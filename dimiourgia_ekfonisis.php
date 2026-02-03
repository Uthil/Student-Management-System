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
  // Εύρεση των μαθημάτων
  $sql1 = "SELECT * FROM courses";
  $result = $con->query($sql1);
  $n = $result->num_rows;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $ekfonisi = $_POST['ekfonisi'];
    $file = $_POST['file'];
    $mathima = $_POST['mathima'];
    // Δημηιουργεία νέας εργασίας
    $$stmt = $con->prepare("INSERT INTO ekfonisiergasias(Title, Ekfonisi, file, Course_id, Userid) VALUES (?, ?, ?, ?, ?)");
	  $stmt->bind_param("ssssi", $title, $ekfonisi, $file, $mathima, $userid);
    $result = $stmt->execute();
    if ($result == FALSE) {
      $stmt->close();
      $con->close();
      echo '<script>alert("Error: Δεν ήταν δυνατή η αποθήκευση..."); window.location="dimiourgia_ekfonisis.php";</script>';
    } else {
      $stmt->close();
      $con->close();
      echo '<script>alert("Επιτυχής αποθήκευση!"); window.location="home.php";</script>';
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
                <a class="nav-link" href="home.php"> Αρχική
                </a>
              </li>
              <?php
              if ($role === 'Φοιτητής') {
                echo "<li><a href='portfolio.php' class='nav-link'>Portfolio Εργασιών</a></li>";
                echo "<li><a href='profile.php' class='nav-link' >Προφίλ</a></li>";
              } else {
                echo "<li><a href='dimiourgia_ekfonisis.php' style='background-color:rgb(129, 139, 139);' class='nav-link'>Δημιουργία Εκφώνησης Εργασίας</a></li>";
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
        <h4>Δημιουργία Εκφώνησης Εργασίας</h4>

      </div>
      <div class="row" style="border:1px solid;width:30%;margin:auto;padding-left: 10px;padding-top: 10px;">
        <form method="POST" action="dimiourgia_ekfonisis.php">
          <p><b>Τίτλος εργασίας:</b><br>
            <input type="text" name="title" style="width:95%" placeholder="Πληκτρολογήστε τον τίτλο">
          </p>
          <p><b>Εκφώνηση:</b><br>
            <textarea name="ekfonisi" rows="7" style="width: 95%" placeholder="Πληκτρολογήστε την εκφώνηση"></textarea>
          </p>
          <p><b>Μάθημα:</b><br>
            <select name="mathima" style="width: 95%">
              <?php
              if ($n > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<option>" . $row['Course_id'] .  "</option>";
                }
              }
              ?>
            </select>
          </p>
          <p><b>Αρχείο εργασίας:</b><br>
            <input type="file" name="file" style="width:95%">
          </p>
          <?php
          if ($n == 0) echo "Θα πρέπει να εισάγετε μαθήματα στη ΒΔ";
          ?>
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