<?php
class  Advert
{
    const TableName = "Ad";
    var $Id;
    var $PosId;
    var $Title;
    var $SubTitle;
    var $ImgUrl;
    var $WebUrl;
    var $Target;
    var $State=1;
    var $SortId;
    var $ExtStr1="cn";
    var $ExtStr2;


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
        $Advert = new Advert();
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
        return $Advert;
    }

    public static function GetList($lang)
    {
        global $DB;
        $sql = "select * from " . self::TableName . " where ExtStr1='$lang'  order by ExtStr2 asc, SortId asc, id asc";
        $result = $DB->getall($sql);
        echo $DB->ErrorMsg();
        return $result;
    }
    public  static function GetTopList($where,$topNum=0)
    {
        global $DB;
        if ($topNum == 0)
            $topNum = 100;
        $sql = "select * from " . self::TableName . " where $where order by SortId,Id limit 0,$topNum";
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
        $sql = "insert into ".self::TableName ."(PosId,Title,SubTitle,ImgUrl,WebUrl,Target,State,SortId,ExtStr1,ExtStr2)";
        $sql = $sql . " values('$this->PosId','$this->Title','$this->SubTitle',";
        $sql = $sql . "'$this->ImgUrl','$this->WebUrl','$this->Target','$this->State','$this->SortId','$this->ExtStr1','$this->ExtStr2')";
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
        $sql = "update " . self::TableName . " set PosId='$this->PosId',Title='$this->Title',SubTitle='$this->SubTitle',";
        $sql = $sql . "ImgUrl='$this->ImgUrl',WebUrl='$this->WebUrl',Target='$this->Target',State='$this->State',SortId='$this->SortId',ExtStr1='$this->ExtStr1',ExtStr2='$this->ExtStr2'  ";
        $sql = $sql . " where Id=$this->Id";
        $result = $DB->Execute($sql);
        return $result;
    }
}