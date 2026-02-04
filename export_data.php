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
  include("config.php");

  $studentId = $_POST['id'];

  $create_xml = "
			<!DOCTYPE student [     
			<!ELEMENT student (email, name?, epaggelma?, LinkedIn?, Facebook?, YouTube?, Instagram?, Twitter?, ergasia*)>
			<!ATTLIST student studentID CDATA #REQUIRED>
      <!ELEMENT name (#PCDATA)>
			<!ELEMENT email (#PCDATA)>
  		<!ELEMENT epaggelma (#PCDATA)>
			<!ELEMENT LinkedIn (#PCDATA)>
      <!ELEMENT Facebook (#PCDATA)>
      <!ELEMENT YouTube (#PCDATA)>
      <!ELEMENT Instagram (#PCDATA)>
      <!ELEMENT Twitter (#PCDATA)>
      <!ELEMENT ergasia (titlos, perigrafi, link)>
      <!ELEMENT titlos (#PCDATA)>
      <!ELEMENT perigrafi (#PCDATA)>
      <!ELEMENT link (#PCDATA)>
			]>";

  $stmt = $con->prepare("SELECT * FROM users WHERE Userid= ?");
  $stmt->bind_param("i", $studentId);
  $stmt->execute();
  $result = $stmt->get_result();
  $student = $result->fetch_assoc();
  $stmt->close();

  $stmt2 = $con->prepare("SELECT * FROM userprofile WHERE Userid=?");
  $stmt2->bind_param("i", $studentId);
  $stmt2->execute();
  $result2 = $stmt2->get_result();
  $n = $result2->num_rows;
  if ($n > 0) {
    $profile = mysqli_fetch_array($result2);
  } else {
    $profile = '';
  }
  $stmt2->close();

  $create_xml .= "<student studentID='$studentId'>";

  $create_xml .= "<email>" . $student['Email'] . "</email>";
  if ($profile != '') {
    $create_xml .= "<name>" . $profile['Name'] . "</name>";
    $create_xml .= "<epaggelma>" . $profile['Profession'] . "</epaggelma>";
    $create_xml .= "<LinkedIn>" . $profile['Linkedin'] . "</LinkedIn>";
    $create_xml .= "<Facebook>" . $profile['Facebook'] . "</Facebook>";
    $create_xml .= "<YouTube>" . $profile['YouTube'] . "</YouTube>";
    $create_xml .= "<Instagram>" . $profile['Instagram'] . "</Instagram>";
    $create_xml .= "<Twitter>" . $profile['Twitter'] . "</Twitter>";
  }

  $stmt3 = $con->prepare("SELECT * FROM ypovlithisaergasia WHERE Userid=?");
  $stmt3->bind_param("i", $studentId);
  $stmt3->execute();
  $result3 = $stmt3->get_result();
  $n = $result3->num_rows;
  if ($n > 0) {

    while ($ergasia = $result3->fetch_assoc()) {
      $create_xml .= "<ergasia>";
      $create_xml .= "<titlos>" . $ergasia['Title'] . "</titlos>";
      $create_xml .= "<perigrafi>" . $ergasia['Description'] . "</perigrafi>";
      $create_xml .= "<link>" . $ergasia['file'] . "</link>";
      $create_xml .= "</ergasia>";
    }
  }
  $stmt3->close();

  $create_xml .= "</student>";

  // Εγγραφή σε αρχείο
  $filename = "student" . $studentId . ".xml";
  $file = fopen($filename, "w");

  fwrite($file, $create_xml);
  fclose($file);

  $xsl_filename = "export_data.xsl";
  $doc = new DOMDocument();
  $xsl = new XSLTProcessor();
  $doc->load($xsl_filename);
  $xsl->importStyleSheet($doc);
  $doc->loadXML($create_xml);
  if (!$doc->validate()) {
    echo "<p>Not valid XML<p>";
  } else {
    echo $xsl->transformToXML($doc);
  }
  $con->close();
  ?>
  </div>


  <div id="footer">
    <a href="oroi.pdf" target="_blank">Όροι Χρήσης</a> |
    <a href="politiki.pdf" target="_blank">Πολιτική απορρήτου</a>
  </div>
  </div>
</body>

</html>