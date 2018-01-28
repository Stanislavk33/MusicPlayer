<?php require_once "C:\\xampp\\htdocs\\PhpAudioDb\\Db\\connect.php";
include "C:\\xampp\\htdocs\\PhpAudioDb\\public_html\\uploadFile.php";
include "C:\\xampp\htdocs\\PhpAudioDb\\public_html\\main.php";
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

?>
<script></script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Audio DataBase</title>

    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet"  href="css/main.css">
    <script src="js/bootstrap.min.js"></script>
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
        $stmt = $pdo->query('SELECT name FROM audios');

   echo "<table class='table'>";
  echo "<tr>";
  echo    "<td>Name</td>";
   echo   "<td>Delete </td>";
  echo  "</tr>";
        foreach ($stmt as $row)
{
    echo   " <tr>";
   echo  "<td >". $row['name']."</td>";
   echo "<td>" ;
    echo "<button id='1'type='button' class='btn btn-danger'>Delete</button>";
}
    ?>
    </div>
    
</div>
</body>
</html>