<?php

class Database extends PDO{
    public function __construct($dsh,$user,$password) {
        parent::__construct($dsh,$user,$password);
    }
    public function select($sql,$array=array()){
        $sth = $this->prepare($sql);
	foreach ($array as $key => $value) {
	$sth->bindValue("$key",$value);
	}
	$sth->execute();
	return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insert($tableName,$data)
    {   
        $fieldKeys = implode(",", array_keys($data));
        $fieldValues = ":".implode(", :", array_keys($data));
        $sql = "insert into $tableName ($fieldKeys) values ($fieldValues)";
        $sth = $this->prepare($sql);
        foreach($data as $key=>$value)
        {
            $sth->bindValue(":$key", $value);
        }
        return $sth->execute();
    }
	public function delete($tableName,$where)
	{
		$sql = "delete from $tableName where $where";
		$sth = $this->prepare($sql);
		return $sth->execute();
	}
    public function update($tableName,$data,$where)
    {
		$updateKeys=null;
		foreach ($data as $key => $value) {
			$updateKeys = $updateKeys."$key=:$key,";
		}
		$updateKeys = rtrim($updateKeys,",");
		$sql = "update $tableName set $updateKeys where $where";
		$sth = $this->prepare($sql);
		foreach ($data as $key => $value) {
			$sth->bindValue(":$key",$value);
		}
		return $sth->execute();
    }
}