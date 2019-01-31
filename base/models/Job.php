<?php
class  Job
{
    const TableName = "Job";
    var $Id=0;
    var $Lang='cn';
    var $CategoryId;
    var $Category;
    var $Title;
    var $PersonNum;
    var $Location;
    var $Salary='面议';
    var $AddTime;
    var $EndTime;
    var $JobDesc;
    var $JobRequire;
    var $State=1;
    var $SortId=100;
    var $Sex='不限';
    var $Age='不限';
    var $Exp='不限';
    var $Wenhua='不限';
    var $Xingzhi='全职';

    private function Insert()
    {
        global $DB;
        $sql = "insert into ".self::TableName ."(Lang,CategoryId,Category,Title,PersonNum,Location,Salary,";
        $sql = $sql . " AddTime,EndTime,JobDesc,JobRequire,State,SortId,Sex,Age,Exp,Wenhua,Xingzhi)";
        $sql = $sql . " values('$this->Lang','$this->CategoryId','$this->Category',";
        $sql = $sql . "'$this->Title','$this->PersonNum','$this->Location','$this->Salary',";
        $sql = $sql."'$this->AddTime','$this->EndTime','$this->JobDesc','$this->JobRequire','$this->State',";
        $sql = $sql."'$this->SortId','$this->Sex','$this->Age','$this->Exp','$this->Wenhua','$this->Xingzhi')";
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
        $sql = "update ".self::TableName ." set Lang='$this->Lang',CategoryId='$this->CategoryId',Category='$this->Category',";
        $sql = $sql . "Title='$this->Title',PersonNum='$this->PersonNum',Location='$this->Location',";
        $sql = $sql . "Salary='$this->Salary',AddTime='$this->AddTime',EndTime='$this->EndTime',JobDesc='$this->JobDesc',JobRequire='$this->JobRequire',";
        $sql = $sql."State='$this->State',SortId='$this->SortId',Sex='$this->Sex',Age='$this->Age',";
        $sql = $sql."Exp='$this->Exp',Wenhua='$this->Wenhua',Xingzhi='$this->Xingzhi' ";
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
        $Job = new Job();
        if($id>0) {
            global $DB;
            $sql = "select * from " . self::TableName . " where Id=$id";
            $result = $DB->GetRow($sql);
            if (count($result) > 0) {
                foreach ($result as $key => $value) {
                    $Job->$key = $value;
                }
            }
        }
        return $Job;
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