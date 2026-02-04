<!DOCTYPE html>
<html>

<head>
  <title> Εξειδίκευση στα Πληροφοριακά Συστήματα </title>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
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

    // Εισαγωγή νέας εργασίας
    $stmt2 = $con->prepare("INSERT INTO ekfonisiergasias(Title, Ekfonisi, file, Course_id, Userid) VALUES (?, ?, ?, ?, ?)");
	  $stmt2->bind_param("ssssi", $title, $ekfonisi, $file, $mathima, $userid);
    $result2 = $stmt2->execute();
    if ($result2 == FALSE) {
      $stmt2->close();
      $con->close();
      echo '<script>alert("Error: Δεν ήταν δυνατή η αποθήκευση..."); window.location="dimiourgia_ekfonisis.php";</script>';
    } else {
      $stmt2->close();
      $con->close();
      echo '<script>alert("Επιτυχής αποθήκευση!"); window.location="home.php";</script>';
    }
  } else {

  ?>
    <div class="container-fluid">
      <div id="menu">
        <div id="header">
          <nav class="navbar navbar-inverse navbar-expand-lg justify-content-center">
            <a class="navbar-brand" href="index.php">
              <img src="images/logo.png" alt="Logo" style="width:15%"></a>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="home.php"> Αρχική </a>
              </li>
              <?php
              if ($role === 'Φοιτητής') {
                echo "<li><a href='portfolio.php' class='nav-link'>Portfolio Εργασιών</a></li>";
                echo "<li><a href='profile.php' class='nav-link' >Προφίλ</a></li>";
              } else {
                echo "<li><a href='dimiourgia_ekfonisis.php'  class='nav-link'>Δημιουργία Εκφώνησης Εργασίας</a></li>";
                echo "<li><a href='provoli_ergasion.php' class='nav-link'>Προβολή Εργασιών</a></li>";
                echo "<li><a href='eikona_foititi.php' class='nav-link'>Εικόνα Φοιτητή</a></li>";
              }
              ?>
              </li>
              <li><a href="logout.php" class="btn btn-primary btn-sm" style="margin-top:10%">Έξοδος</a></li>
            </ul>
          </nav>
        </div>
      </div>

      <div>
        <div class="row" style="text-align:center;margin-top:2%;margin-bottom:2%">
          <h1>Υποβολή εργασίας</h1>
          <p>Υποβάλετε μια νέα εργασία, αφού πρώτα επιλέξετε το σωστό μάθημα</p>
        </div>
        <div style="border:1px solid grey;width: 30%;margin:auto">
          <div class="row" style="width:50%;padding-left: 10px;padding-top: 10px;">
            <form method="POST" action="submit.php">
              <p><b>Μάθημα:</b><br>
                <select name="mathima" id="mathimaSelect" style="width: 220%">
                  <?php
                  if ($n > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo "<option value='" . $row['Course_id'] . "'>" . $row['Course_id'] . "</option>";
                    }
                  }
                  ?>
                </select>
              </p>
              <p><b>Εργασία:</b><br>
                <select name="ergasia" id="ergasiaSelect" style="width: 220%">
                  <?php
                  $sql3 = "SELECT * from ekfonisiergasias";
                  $result3 = $con->query($sql3);
                  while ($row = $result3->fetch_assoc()) {
                    echo "<option value='" . $row['Course_id'] . "' data-mathima='" . $row['Course_id'] . $row['Course_title'] . "'>" . $row['Title'] . "</option>";
                  }
                  ?>
                </select>
              </p>
              <p><b>Τίτλος εργασίας:</b><br>
                <input type="text" name="title" style="width:220%" placeholder="Πληκτρολογήστε τον τίτλο">
              </p>
              <p><b>Περιγραφή:</b><br>
                <textarea name="perigrafi" rows="7" style="width: 220%" placeholder="Πληκτρολογήστε περιγραφή για την εργασία"></textarea>
              </p>
              <p><b>Αρχείο Εργασίας</b></p>
              <input type="file" name="file" style="width:220%">
              </p>
              <?php
              if ($n == 0) echo "Θα πρέπει να εισάγετε μαθήματα στη Βάση Δεδομένων!";
              ?>
              <p>
                <input type="submit" value="Υποβολή" class="btn btn-primary">
              </p>
            </form>
          </div>
        </div>
      </div>
      <div id="footer" style="text-align:center;text-decoration: none; margin-top:2%">
        <a href="oroi.pdf" target="_blank">Όροι Χρήσης</a> |
        <a href="politiki.pdf" target="_blank">Πολιτική απορρήτου</a>
      </div>
    </div>
  <?php
  }
  ?>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const mathimaSelect = document.getElementById("mathimaSelect");
      const ergasiaSelect = document.getElementById("ergasiaSelect");
      const ergasiaOptions = Array.from(ergasiaSelect.options); // Αποθήκευση όλων των επιλεγμένων εργασιών

      mathimaSelect.addEventListener("change", function() {
        const selectedMathima = this.value;

        // Καθαρισμός της λίστας εργασιών
        ergasiaSelect.innerHTML = "";

        // Φιλτράρισμα και εμφάνιση των σχετικών εργασιών
        ergasiaOptions.forEach(option => {
          if (option.getAttribute("data-mathima") === selectedMathima) {
            ergasiaSelect.appendChild(option);
          }
        });

        // Αν δεν υπάρχουν διαθέσιμες εργασίες?
        if (ergasiaSelect.options.length === 0) {
          let noOption = document.createElement("option");
          noOption.text = "Δεν υπάρχουν διαθέσιμες εργασίες";
          ergasiaSelect.appendChild(noOption);
        }
      });
    });
  </script>

</body>

</html>