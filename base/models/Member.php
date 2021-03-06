<?php
class  Member
{
    const TableName = "Member";
    var $Id;
    var $Lang;
    var $UserName;
    var $UserEmail;
    var $UserPwd;
    var $UserTel;
    var $UserPhone;
    var $UserQQ;
    var $CardNo;
    var $IdCardNo;
    var $Address;
    var $NickName;
    var $RegTime;

    private function Insert()
    {
        global $DB;
        $sql = "insert into ".self::TableName ."(Lang,UserName,UserEmail,UserPwd,UserTel,UserPhone,UserQQ,";
        $sql = $sql . " CardNo,IdCardNo,Address,NickName,RegTime)";
        $sql = $sql . " values('$this->Lang','$this->UserName','$this->UserEmail',";
        $sql = $sql . "'$this->UserPwd','$this->UserTel','$this->UserPhone','$this->UserQQ',";
        $sql = $sql."'$this->CardNo','$this->IdCardNo','$this->Address','$this->NickName','$this->RegTime')";
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
        $sql = "update ".self::TableName ." set Lang='$this->Lang',UserName='$this->UserName',UserEmail='$this->UserEmail',";
        $sql = $sql . "UserPwd='$this->UserPwd',UserTel='$this->UserTel',UserPhone='$this->UserPhone',";
        $sql = $sql . "UserQQ='$this->UserQQ',CardNo='$this->CardNo',IdCardNo='$this->IdCardNo',Address='$this->Address',";
        $sql = $sql."NickName='$this->NickName',RegTime='$this->RegTime' ";
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
        $Member = new Member();
        if($id>0) {
            global $DB;
            $sql = "select * from " . self::TableName . " where Id=$id";
            $result = $DB->GetRow($sql);
            if (count($result) > 0) {
                foreach ($result as $key => $value) {
                    $Member->$key = $value;
                }
            }
        }
        return $Member;
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