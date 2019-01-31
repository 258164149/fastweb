<?php
class  Links
{
    const TableName = "Links";
    var $Id;
    var $Lang="cn";
    var $Title;
    var $WebUrl;
    var $ImgUrl;
    var $SortId=100;
    var $State=1;


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
    public static function GetModelById($id)
    {
        $Links = new Links();
        if($id>0) {
            global $DB;
            $sql = "select * from " . self::TableName . " where Id=$id";
            $result = $DB->GetRow($sql);
            if (count($result) > 0) {
                foreach ($result as $key => $value) {
                    $Links->$key = $value;
                }
            }
        }
        return $Links;
    }
    public static function GetList()
    {
        global $DB;
        $sql = "select * from ". self::TableName ." where Lang='cn'  order by SortId asc, id asc";
        $result = $DB->getall($sql);
        return $result;
    }
    public static function GetListByLang($lang)
    {
        global $DB;
        $sql = "select * from ". self::TableName ." where State=1 and Lang='$lang'  order by SortId asc, id asc";
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
        $result = $DB->Execute($sql);
    }
    public static function UpdateFieldById($condition,$id)
    {
        $sql = "update " . self::TableName . " set $condition where Id=$id";
        global $DB;
        $result = $DB->getall($sql);
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
            $result = $DB->getall($sql);
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
        $sql = "insert into ".self::TableName ."(Lang,Title,WebUrl,ImgUrl,SortId,State)";
        $sql = $sql . " values('$this->Lang','$this->Title','$this->WebUrl',";
        $sql = $sql . "'$this->ImgUrl','$this->SortId','$this->State')";
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
        $sql = "update ".self::TableName ." set Lang='$this->Lang',Title='$this->Title',WebUrl='$this->WebUrl',";
        $sql = $sql . "ImgUrl='$this->ImgUrl',SortId='$this->SortId',State='$this->State' ";
        $sql = $sql . " where Id=$this->Id";
        $result = $DB->Execute($sql);
        return $result;
    }
}