<?php
class  Channel
{
    const TableName = "Channel";
    var $Id;
    var $Lang = "cn";
    var $Title;
    var $SubTitle;
    var $MenuTitle;
    var $Cname;
    var $MaxLevel;
    var $ModelId;
    var $GroupId;
    var $GroupSort;
    var $State;
    var $OpenCate;
    var $OpenCatePic;
    var $OpenPrice;
    var $OpenFileUpload;
    var $OpenVideoUpload;
    var $ImgUpMode;
    var $SortId;
    var $ImgWidthHeight;
    var $ShowMode;
    var $ListMode;
    var $ListImgWidth;
    var $ListImgHeight;
    var $ListThumbMode;
    var $PageSize;
    var $OrderMode;
    var $Url;
    var $BackUrl;
    var $Remark;
    var $PrevText;
    var $NextText;

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

    public  static function GetChannelId($lang,$cname)
    {
        global $DB;
        $sql = "select Id from " . self::TableName . " where Lang='$lang' and Cname='$cname'";
        $result = $DB->getone($sql);
        return $result;
    }

    public static function GetModelIdByCname($lang,$cname){
        global $DB;
        $sql = "select ModelId from " . self::TableName . " where Lang='$lang' and Cname='$cname'";
        $result = $DB->getone($sql);
        return $result;
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
    public static function UpdateFieldById($condition,$id)
    {
        $sql = "update " . self::TableName . " set $condition where Id=$id";
        global $DB;
        $result = $DB->getall($sql);
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
        if ($result > 0) {
            $sqlcate= "select *from Category where ChannelId=$id";
           for( $i=0;$i<count($sqlcate);$i++){
               $sql = "delete from Doc where CategoryId=$sqlcate[$i]['Id']";
               $DB->Execute($sql);
           }
            $sql = "delete from Category where ChannelId=$id";
            $DB->Execute($sql);

            return true;
        }
        else
            return false;
    }
    public static function DeleteByIds($ids)
    {
        if ($ids != null && count($ids) > 0) {
            foreach ($ids as $id) {
                self::DeleteById($id);
            }
        }
    }
    public static function GetByCname($lang,$cname)
    {
        global $DB;
        $sql = "select * from " . self::TableName . " where Lang='$lang' and Cname='$cname'";
        $result = $DB->getall($sql);
        if ($result > 0)
            return $result[0];
        else
            return null;
    }

    public static function GetMaxLevel($id)
    {
        global $DB;
        $sql = "select MaxLevel from " . self::TableName . " where Id=$id";
        $result = $DB->getone($sql);
        return $result;
    }

    public static function GetList($where="1=1",$orderBy="id")
    {
        global $DB;
        $sql = "select * from " . self::TableName . " where $where order by $orderBy";
        $result = $DB->getall($sql);
        return $result;
    }

    public static function GetListByGroupId($groupId)
    {
        global $DB;
        $sql = "select * from " . self::TableName . " where GroupId=$groupId and State=1 order by GroupSort asc";
        $result = $DB->getall($sql);
        return $result;
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
        $sql = "insert into ".self::TableName ."(Lang,Title,SubTitle,MenuTitle,Cname,MaxLevel,ModelId,State,OpenCate,";
        $sql = $sql . "OpenCatePic,OpenPrice,OpenFileUpload,OpenVideoUpload,ImgUpMode,SortId,ImgWidthHeight,";
        $sql = $sql . "ShowMode,ListMode,ListImgWidth,ListImgHeight,ListThumbMode,PageSize,OrderMode,";
        $sql = $sql . "Url,BackUrl,Remark,PrevText,NextText) values('$this->Lang','$this->Title','$this->SubTitle',";
        $sql = $sql . "'$this->MenuTitle','$this->Cname','$this->MaxLevel','$this->ModelId','$this->State','$this->OpenCate',";
        $sql = $sql . "'$this->OpenCatePic','$this->OpenPrice','$this->OpenFileUpload','$this->OpenVideoUpload','$this->ImgUpMode',";
        $sql = $sql . "'$this->SortId','$this->ImgWidthHeight','$this->ShowMode','$this->ListMode','$this->ListImgWidth',";
        $sql = $sql . "'$this->ListImgHeight','$this->ListThumbMode','$this->PageSize','$this->OrderMode','$this->Url',";
        $sql = $sql . "'$this->BackUrl','$this->Remark','$this->PrevText','$this->NextText')";
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
        $sql = "update ".self::TableName ." set Lang='$this->Lang',Title='$this->Title',SubTitle='$this->SubTitle',";
        $sql = $sql . "MenuTitle='$this->MenuTitle',Cname='$this->Cname',MaxLevel='$this->MaxLevel',";
        $sql = $sql . "ModelId='$this->ModelId',State='$this->State',OpenCate='$this->OpenCate',";
        $sql = $sql . "OpenCatePic='$this->OpenCatePic',OpenPrice='$this->OpenPrice',OpenFileUpload='$this->OpenFileUpload',";
        $sql = $sql . "OpenVideoUpload='$this->OpenVideoUpload',ImgUpMode='$this->ImgUpMode',SortId='$this->SortId',";
        $sql = $sql . "ImgWidthHeight='$this->ImgWidthHeight',ShowMode='$this->ShowMode',ListMode='$this->ListMode',";
        $sql = $sql . "ListImgWidth='$this->ListImgWidth',ListImgHeight='$this->ListImgHeight',ListThumbMode='$this->ListThumbMode',";
        $sql = $sql . "PageSize='$this->PageSize',OrderMode='$this->OrderMode',Url='$this->Url',BackUrl='$this->BackUrl',";
        $sql = $sql . "Remark='$this->Remark',PrevText='$this->PrevText',NextText='$this->NextText' ";
        $sql = $sql . "where Id=$this->Id";
        $result = $DB->Execute($sql);
        return $result;
    }
}