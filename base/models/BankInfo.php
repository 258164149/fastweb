<?php
class  BankInfo
{
    const TableName = "BankInfo";
    var $Id=0;
    var $Name;
    var $IdType;
    var $IdNum;
    var $Phone;
    var $Email;
    var $Bank;
    var $SubBank;
    var $BankNum;
    var $IdCard;
    var $IdCardImg;
    var $IdCardImgBack;

    private function Insert()
    {
        global $DB;
        $sql = "insert into ".self::TableName ."(Name,IdType,IdNum,Phone,Email,Bank,SubBank,";
        $sql = $sql . " BankNum,IdCard,IdCardImg,IdCardImgBack)";
        $sql = $sql . " values('$this->Name','$this->IdType','$this->IdNum',";
        $sql = $sql . "'$this->Phone','$this->Email','$this->Bank','$this->SubBank',";
        $sql = $sql."'$this->BankNum','$this->IdCard','$this->IdCardImg','$this->IdCardImgBack')";
        $DB->Execute($sql);
    }
    private function Update()
    {
        global $DB;
        $sql = "update ".self::TableName ." set Name='$this->Name',IdType='$this->IdType',IdNum='$this->IdNum',";
        $sql = $sql . "Phone='$this->Phone',Email='$this->Email',Bank='$this->Bank',";
        $sql = $sql . "SubBank='$this->SubBank',BankNum='$this->BankNum',IdCard='$this->IdCard',IdCardImg='$this->IdCardImg',";
        $sql = $sql."IdCardImgBack='$this->IdCardImgBack' ";
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

    public static function GetFirstModel($where)
    {
        $BankInfo = new BankInfo();
        global $DB;
        $sql = "select  * from " . self::TableName . " where $where";
        $result = $DB->GetRow($sql);
        if (count($result) > 0) {
            foreach ($result as $key => $value) {
                $BankInfo->$key = $value;
            }
        }
        return $BankInfo;
    }
    public static function GetModelById($id)
    {
        $BankInfo = new BankInfo();
        if($id>0) {
            global $DB;
            $sql = "select * from " . self::TableName . " where Id=$id";
            $result = $DB->GetRow($sql);
            if (count($result) > 0) {
                foreach ($result as $key => $value) {
                    $BankInfo->$key = $value;
                }
            }
        }
        return $BankInfo;
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