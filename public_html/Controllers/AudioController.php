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

function deleteAudio($Audioid)
    {
   
$id = $Audioid;
$databaseConnect=new DatabaseConnect();
$pdo= $databaseConnect->getPdo();

$stmt=$pdo->prepare("SELECT Path From audios WHERE id=:id ");
$stmt->bindParam(':id',$id);
$stmt->execute();
foreach($stmt as $rows)
{
    $pathDb= $rows['Path'];
}


//$path='C:/xampp/htdocs/PhpAudioDb/MusicPlayer/public_html/'.$pathDb;
//C:\xampp\htdocs\PhpAudioDb\MusicPlayer\public_html\uploads\test.mp3

// $r=realpath ($pathDb );
//unlink('C:\xampp\htdocs\PhpAudioDb\MusicPlayer\public_html\uploads\electrotest2.mp3');


$stmt= $pdo->prepare("DELETE FROM audios WHERE id=:id");
$stmt->bindParam(':id', $id);
$stmt->execute();
    }






function viewAudio()
{
    $databaseConnect = new DatabaseConnect();
       $pdo= $databaseConnect->getPdo();
        $stmt = $pdo->query('SELECT name FROM audios');
        foreach ($stmt as $row)
        {
            echo $row['name'];
        }

}





?>