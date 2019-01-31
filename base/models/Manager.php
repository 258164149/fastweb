<?php
class  Manager
{
    const TableName = "Manager";
    var $Id;
    var $UserName;
    var $UserPwd;
    var $RoleProperty;
    var $State;

    public static function Exists($userName)
    {
        global $DB;
        $sql = "select count(1) from " . self::TableName . " where UserName='$userName'";
        $result = $DB->getall($sql);
        if ($result[0][0] > 0)
            return true;
        else
            return false;
    }
    public static function GetById($id)
    {
        global $DB;
        $sql = "select * from " . self::TableName . " where Id=$id";
        $result = $DB->getall($sql);
        if ($result > 0)
            return $result[0];
        else
            return null;
    }
    public static function DeleteById($id)
    {
        global $DB;
        $sql = "delete from " . self::TableName . " where Id=$id";
        $result = $DB->Execute($sql);
        if ($result > 0)
            return true;
        else
            return false;
    }
    public function Save()
    {
        if ($this->Id == 0)
            return $this->Insert();
        else
            return $this->Update();
    }

    private function Insert()
    {
        global $DB;
        $sql = "insert into " . self::TableName . "(UserName,UserPwd,RoleProperty,State)";
        $sql = $sql . " values('$this->UserName','$this->UserPwd','$this->RoleProperty','$this->State')";
        $result = $DB->Execute($sql);
        if ($result > 0) {
            $id = $DB->Insert_ID();
            return $id;
        } else
            return 0;
    }

    private function Update()
    {
        global $DB;
        $sql = "update " . self::TableName . " set UserName='$this->UserName',UserPwd='$this->UserPwd',State='$this->State' ";
        $sql = $sql . " where Id=$this->Id";
        $result = $DB->Execute($sql);
        return $result;
    }
}