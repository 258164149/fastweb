d<?php
class  AdPos
{
    const TableName = "AdPos";
    var $Id;
    var $Lang = "cn";
    var $Title;
    var $Cname;
    var $State;
    var $ImgWidth;
    var $ImgHeight;

    public static function Exists($lang, $cname, $id)
    {
        global $DB;
        $sql = "select count(1) from ".self::TableName ." where Cname='$cname' and Lang='$lang' and Id<>$id";
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

    public static function GetTitleById($id)
    {
        global $DB;
        $sql = "select Title from " . self::TableName . " where Id=$id";
        $result = $DB->getone($sql);
        return $result;
    }
    public static function GetList($where)
    {
        global $DB;
        $sql = "select * from AdPos where $where  order by State desc,Id asc";
        $result = $DB->getall($sql);
        return $result;
    }

    public static function DeleteByIds($ids)
    {
        if ($ids != null && count($ids) > 0) {
            foreach ($ids as $id) {
                self::DeleteById($id);
            }
        }
    }
    public static function DeleteById($id)
    {
        global $DB;
        $sql = "delete from " . self::TableName . " where Id=$id";
        $DB->Execute($sql);
    }

    public static function UpdateFieldById($condition,$id)
    {
        $sql = "update " . self::TableName . " set $condition where Id=$id";
        global $DB;
        $DB->getall($sql);
    }
    public static function UpdateField($condition,$ids)
    {
        $in = "0";
        if ($ids != null && count($ids) > 0) {
            foreach ($ids as $id) {
                $in = $in . ",$id";
            }
            $sql = "update " . self::TableName . " set $condition where Id in($in)";
            global $DB;
            $DB->getall($sql);
        }
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
        $sql = "insert into ".self::TableName ."(Lang,Title,Cname,State,ImgWidth,ImgHeight)";
        $sql = $sql . " values('$this->Lang','$this->Title','$this->Cname',";
        $sql = $sql . "'$this->State','$this->ImgWidth','$this->ImgHeight')";
        $result = $DB->Execute($sql);
        if ($result > 0) {
            $id = $DB->Insert_ID();
            echo $id;
            return $id;
        } else
            return 0;
    }

    private function Update()
    {
        global $DB;
        $sql = "update ".self::TableName ." set Lang='$this->Lang',Title='$this->Title',Cname='$this->Cname',";
        $sql = $sql . "State='$this->State',ImgWidth='$this->ImgWidth',ImgHeight='$this->ImgHeight' ";
        $sql = $sql . " where Id=$this->Id";
        $result = $DB->Execute($sql);
        return $result;
    }
}