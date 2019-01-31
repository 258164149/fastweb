<?php
class  Feedback
{
    const TableName = "Feedback";
    var $Id;
    var $Lang;
    var $UserName;
    var $UserTel;
    var $UserQQ;
    var $UserEmail;
    var $UserAddress;
    var $Title;
    var $Content;
    var $State;
    var $AddTime;
    var $ReContent;
    var $ReTime;
    var $ExtText1;
    var $ExtText2;

    private function Insert()
    {
        global $DB;
        $sql = "insert into ".self::TableName ."(Lang,UserName,UserTel,UserQQ,UserEmail,UserAddress,Title,";
        $sql = $sql . " Content,State,AddTime,ReContent,ReTime,ExtText1,ExtText2)";
        $sql = $sql . " values('$this->Lang','$this->UserName','$this->UserTel',";
        $sql = $sql . "'$this->UserQQ','$this->UserEmail','$this->UserAddress','$this->Title',";
        $sql = $sql."'$this->Content','$this->State','$this->AddTime','$this->ReContent','$this->ReTime','$this->ExtText1','$this->ExtText2')";
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
        $sql = "update ".self::TableName ." set Lang='$this->Lang',UserName='$this->UserName',UserTel='$this->UserTel',";
        $sql = $sql . "UserQQ='$this->UserQQ',UserEmail='$this->UserEmail',UserAddress='$this->UserAddress',";
        $sql = $sql . "Title='$this->Title',Content='$this->Content',State='$this->State',AddTime='$this->AddTime',";
        $sql = $sql."ReContent='$this->ReContent',ReTime='$this->ReTime',ExtText1='$this->ExtText1',ExtText2='$this->ExtText2' ";
        $sql = $sql . " where Id=$this->Id";
        $result = $DB->Execute($sql);
        return $result;
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
    public static function GetModelById($id)
    {
        $Feedback = new Feedback();
        if($id>0) {
            global $DB;
            $sql = "select * from " . self::TableName . " where Id=$id";
            $result = $DB->GetRow($sql);
            if (count($result) > 0) {
                foreach ($result as $key => $value) {
                    $Advert->$key = $value;
                }
            }
        }
        return $Feedback;
    }
    public static function GetCount($whereStr)
    {
        global $DB;
        $sql = "select count(1) from " . self::TableName . " where " . $whereStr;
        $result = $DB->GetOne($sql);
        return $result;
    }
    public static function GetList()
    {
        global $DB;
        $sql = "select * from " . self::TableName . " where Lang='cn'  order by id asc";
        $result = $DB->getall($sql);
        return $result;
    }
    public static function GetPageList($pagesize, $currentPage, $condition, $orderMode)
    {
        global $DB;
        $skip = $pagesize * ($currentPage - 1);
        $strSql = "select * from " . self::TableName . "  where id in(";
        $strSql = $strSql . "select id FROM " . self::TableName . " where $condition order by $orderMode";
        $strSql = $strSql . " limit $skip,$pagesize) order by $orderMode";
        $resault = $DB->GetAll($strSql);
        return $resault;
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
}