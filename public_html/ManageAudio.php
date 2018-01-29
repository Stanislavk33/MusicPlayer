<?php require_once "C:\\xampp\\htdocs\\PhpAudioDb\\MusicPlayer\\Db\\connect.php";
include "C:\\xampp\htdocs\\PhpAudioDb\\MusicPlayer\\public_html\\main.php";
include "C:\\xampp\\htdocs\\PhpAudioDb\\MusicPlayer\\public_html\\Controllers\\AudioController.php";

  $databaseConnect = new DatabaseConnect();
  if(isset($_POST['saveAudio'])) 
  {
      $dir='uploads/';
      $audio_path=$dir.basename($_FILES['audioFile']['name']);
  
      if(move_uploaded_file($_FILES['audioFile']['tmp_name'],$audio_path))
        {
           saveAudio($audio_path);
        }
  }

  if(isset($_GET['deleteSong'] ))
    {
      deleteAudio( $_GET['deleteSong']);

      unset($_GET['deleteSong']);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Audio DataBase</title>

    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet"  href="css/main.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>

<div id=main>
    <div>
        <form action="" method="post" enctype="multipart/form-data">
             Put music here:
            <input type="file" name="audioFile" id="audioFileToUpload">
            <button type="submit" name="saveAudio" value="Upload Audio" >Upload </>
        </form>
    </div>

    <div>

   <?php
        $databaseConnect = new DatabaseConnect();
        $pdo= $databaseConnect->getPdo();
        $stmt = $pdo->query('SELECT * FROM audios');

        echo "<thead>";
        echo "<table class=table>";
        echo "<tr>";
        echo "<th>Name</td>";
        echo   "<th>Delete </td>";
        echo  "</tr>";
        echo "</thead>";

        foreach ($stmt as $row)
        {
            echo "<tr>";
            echo "<td >". $row['Name']."</td>";
            echo "<td>" ;
            echo "<form action='' method='get' enctype='multipart/form-data'>";
            echo "<button type='submit' class='btn btn-danger' name='deleteSong' value=".$row['id']." >Delete </>";
            echo "</form></td>";
            echo "</tr>";
        }
    ?>
    </div>
    
</div>
</body>
</html>