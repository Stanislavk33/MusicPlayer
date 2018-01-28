<?php
require_once "C:\\xampp\\htdocs\\PhpAudioDb\\MusicPlayer\\Db\\connect.php";

function saveAudio($path){
    
    $databaseConnect=new DatabaseConnect();
    $pdo= $databaseConnect->getPdo();

    $stmt= $pdo->prepare("insert into audios(Path,Name)values(:path,:name)");
    $tmp= str_replace("uploads/", " ", "$path");
    $name=str_replace(".mp3", "", "$tmp");
    $stmt->bindParam(':path', $path);
    $stmt->bindParam(':name',$name);
    $stmt->execute();
    $user=$stmt->fetch();

  


    if($stmt->rowCount()>0){
        echo "audio file path saved in database";
    }
}



?>