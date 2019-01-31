<?php
class  Room
{
    const TableName = "Room";
    var $Id;
    var $Lang;
    var $OrderNum;
    var $MemberId;
    var $MemberName;
    var $Title;
    var $Category;
    var $RoomNum;
    var $RoomPrice;
    var $LinkName;
    var $Tel;
    var $Address;

    private function Insert()
    {
        global $DB;
        $sql = "insert into ".self::TableName ."(Lang,OrderNum,MemberId,MemberName,Title,Category,RoomNum,";
        $sql = $sql . " RoomPrice,LinkName,Tel,Address)";
        $sql = $sql . " values('$this->Lang','$this->OrderNum','$this->MemberId',";
        $sql = $sql . "'$this->MemberName','$this->Title','$this->Category','$this->RoomNum',";
        $sql = $sql."'$this->RoomPrice','$this->LinkName','$this->Tel','$this->Address')";
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
        $sql = "update ".self::TableName ." set Lang='$this->Lang',OrderNum='$this->OrderNum',MemberId='$this->MemberId',";
        $sql = $sql . "MemberName='$this->MemberName',Title='$this->Title',Category='$this->Category',";
        $sql = $sql . "RoomNum='$this->RoomNum',RoomPrice='$this->RoomPrice',LinkName='$this->LinkName',Tel='$this->Tel',";
        $sql = $sql."Address='$this->Address' ";
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
        $Room = new Room();
        if($id>0) {
            global $DB;
            $sql = "select * from " . self::TableName . " where Id=$id";
            $result = $DB->GetRow($sql);
            if (count($result) > 0) {
                foreach ($result as $key => $value) {
                    $Room->$key = $value;
                }
            }
        }
        return $Room;
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