<?php 

class Audio
{
    private $id;
    private $name;
    private $path;

    public function __construct($id,$name,$path)
    {
        $this->id=$id;
        $this->name=$name;
        $this->path=$path;
    }


    public function getid()
    {
        return $this->id;
    }

    public function setid($id)
    {
        $this->id=$id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name=$name;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path=$path;
    }

}



?>