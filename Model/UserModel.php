<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
 
class UserModel extends Database
{
    public function getMutants()
    {
        return $this->select("SELECT * FROM analize WHERE status=1");
    }

    public function getHumans()
    {
        return $this->select("SELECT * FROM analize WHERE status=0");
    }

    public function saveDNA($dna,$status)
    {
        return $this->insert("INSERT INTO `analize`(`status`, `dna`) VALUES ('$status','$dna')");
    }
}