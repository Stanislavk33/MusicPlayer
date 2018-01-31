<?php
require_once "C:\\xampp\\htdocs\\PhpAudioDb\\MusicPlayer\\Db\\connect.php";

function saveAudio($path){
    
    $tmp= str_replace("uploads/", " ", "$path"); //Taking only the name from the path
    $name=str_replace(".mp3", "", "$tmp");

    
    $databaseConnect=new DatabaseConnect();
    $pdo= $databaseConnect->getPdo();

    $stm = $pdo->prepare("Select * from audios");
    $stm->execute();
    foreach($stm as $row)
        {
            if($name==$row['Name'])
            {
                echo "There is already a song with that name.";
                return; 
            }
        }





    $stmt= $pdo->prepare("insert into audios(Path,Name)values(:path,:name)");
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
        $success=false;
        $id = $Audioid;
        $file= "";
        $databaseConnect=new DatabaseConnect();
        $pdo= $databaseConnect->getPdo();

        $stmt=$pdo->prepare("SELECT Path From audios WHERE id=:id ");
        $stmt->bindParam(':id',$id);
        $stmt->execute();

        $myFilePath = $stmt ->fetchColumn(0);
            if($myFilePath!=null)
            {
                $file="C:/xampp/htdocs/PhpAudioDb/MusicPlayer/public_html/".$myFilePath;
            }else 
            {
                echo "Something went wrong with getting the file path";
            }
        

        //$file= "C:/xampp/htdocs/PhpAudioDb/MusicPlayer/public_html/uploads/electrotest2.mp3";//working

        if (!unlink($file))
            {
	            echo ("Error deleting $file");
            }
        else
            {
	            $success=true;
            }   

        $stmt= $pdo->prepare("DELETE FROM audios WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

            if($stmt->rowCount()>0)
            {
                if($success==true)
                {
                    header( "Location:http://localhost:8080/PhpAudioDb/MusicPlayer/public_html/ManageAudio.php" );
                }
            }else 
            {
                $success=false;
                echo "Something went wrong with deleting the file from the Database";
            }
    }


function viewAudio()
{

}

?>