<?php
class  Kefu
{
    const TableName = "Kefu";
    var $Id;
    var $Lang='cn';
    var $Title;
    var $UserName;
    var $TypeId;
    var $AccountType;
    var $IsRed;
    var $SortId;
    var $Content;
    var $ExtNum;
    var $ExtTxt;

    private function Insert()
    {
        global $DB;
        $sql = "insert into ".self::TableName ."(Lang,Title,UserName,TypeId,AccountType,IsRed,SortId,";
        $sql = $sql . " Content,ExtNum,ExtTxt)";
        $sql = $sql . " values('$this->Lang','$this->Title','$this->UserName',";
        $sql = $sql . "'$this->TypeId','$this->AccountType','$this->IsRed','$this->SortId',";
        $sql = $sql."'$this->Content','$this->ExtNum','$this->ExtTxt')";
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
        $sql = "update ".self::TableName ." set Lang='$this->Lang',Title='$this->Title',UserName='$this->UserName',";
        $sql = $sql . "TypeId='$this->TypeId',AccountType='$this->AccountType',IsRed='$this->IsRed',";
        $sql = $sql . "SortId='$this->SortId',Content='$this->Content',ExtNum='$this->ExtNum',ExtTxt='$this->ExtTxt' ";
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
        $Kefu = new Kefu();
        if($id>0) {
            global $DB;
            $sql = "select * from " . self::TableName . " where Id=$id";
            $result = $DB->GetRow($sql);
            if (count($result) > 0) {
                foreach ($result as $key => $value) {
                    $Kefu->$key = $value;
                }
            }
        }
        return $Kefu;
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

    public static function GetListByLang($lang)
    {
        global $DB;
        $sql = "select * from ". self::TableName ." where  Lang='$lang' and State=1  order by SortId asc, id desc";
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