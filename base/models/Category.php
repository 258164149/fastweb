<?php
class  Category
{
    const TableName = "Category";
    var $Id;
    var $ChannelId;
    var $Pid;
    var $Path;
    var $Depth;
    var $RootId;
    var $Title;
    var $SubTitle;
    var $Cname;
    var $SortId;
    var $ImgUrl;
    var $ImgUrl1;
    var $ImgUrl2;
    var $ImgUrl3;
    var $ImgUrl4;
    var $LinkUrl;
    var $SeoTitle;
    var $SeoKeywords;
    var $Zhaiyao;
    var $Content;
    var $AccessLevel;
    var $IsBasic;
    var $ExtInt1;
    var $ExtInt2;
    var $ExtInt3;
    var $ExtStr1;
    var $ExtStr2;
    var $ExtStr3;


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
        $Category = new Category();
        if($id>0) {
            global $DB;
            $sql = "select * from " . self::TableName . " where Id=$id";
            $result = $DB->GetRow($sql);
            if (count($result) > 0) {
                foreach ($result as $key => $value) {
                    $Category->$key = $value;
                }
            }
        }
        return $Category;
    }
    public static function GetTitleById($id)
    {
        global $DB;
        $sql = "select Title from " . self::TableName . " where Id=$id";
        $result = $DB->getone($sql);
        return $result;
    }
    public static function GetPageList($pagesize, $currentPage, $condition, $orderMode)
    {
        global $DB;
        $skip = $pagesize * ($currentPage - 1);
        $strSql = "select * from " . self::TableName;
        $strSql = $strSql." where $condition order by $orderMode";
        $strSql = $strSql . " limit $skip,$pagesize order by $orderMode";
        $resault = $DB->GetAll($strSql);
        echo $strSql;
        return $resault;
    }
    public static function GetPagecatList($pagesize, $currentPage, $condition, $orderMode)
    {
        global $DB;
        $skip = $pagesize * ($currentPage - 1);
        $strSql = "select * from " . self::TableName . "  where id in(";
        $strSql = $strSql . "select id FROM " . self::TableName . " where $condition order by $orderMode";
        $strSql = $strSql . " limit $skip,$pagesize) order by $orderMode";
        $resault = $DB->GetAll($strSql);
        return $resault;
    }
    public static function GetCount($whereStr)
    {
        global $DB;
        $sql = "select count(1) from " . self::TableName . " where " . $whereStr;
        $result = $DB->GetOne($sql);
        return $result;
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
        $path = ",$id,";
        global $DB;
        $sql = "delete from " . self::TableName . " where Path like '%$path%'";
        $result = $DB->Execute($sql);
        if ($result > 0)
            return true;
        else
            return false;
    }

    public static function GetList($where="1=1",$orderBy="id")
    {
        global $DB;
        $sql = "select * from " . self::TableName . " where $where order by $orderBy";
        $result = $DB->getall($sql);
        return $result;
    }
    public static function GetTopList($where,$orderBy,$topNum=0)
    {
        global $DB;
        if ($topNum == 0)
            $topNum = 100;
        $sql = "select * from " . self::TableName . " where $where order by $orderBy limit 0,$topNum";
        $result = $DB->getall($sql);
        return $result;
    }

    public static function GetTreeList($ChannelId,$PId=0)
    {
        global $DB;
        $sql = "select * from " . self::TableName . " where Pid=$PId and ChannelId=$ChannelId order by SortId";
        $result = $DB->getall($sql);
        $return = array();
        if ($result > 0) {
            foreach ($result as $row) {
                array_push($return, $row);
                $return = self::PushFirtChildNode($return, $ChannelId, $row['Id']);
            }
        }
        return $return;
    }
    public static function PushFirtChildNode($return,$ChannelId,$PId)
    {
        global $DB;
        $sql = "select * from " . self::TableName . " where Pid=$PId and ChannelId=$ChannelId order by SortId";
        $result = $DB->getall($sql);
        if ($result > 0) {
            foreach ($result as $row) {
                array_push($return, $row);
                $return = self::PushFirtChildNode($return, $ChannelId, $row['Id']);
            }
        }
        return $return;
    }
    public static function GetFirtChildList($ChannelId,$PId)
    {
        global $DB;
        $sql = "select * from " . self::TableName . " where Pid=$PId and ChannelId=$ChannelId order by SortId";
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
        $sql = "insert into " . self::TableName . "(ChannelId,Pid,Path,Depth,RootId,Title,SubTitle,Cname,SortId,";
        $sql = $sql . "ImgUrl,ImgUrl1,ImgUrl2,ImgUrl3,ImgUrl4,LinkUrl,SeoTitle,SeoKeywords,Zhaiyao,Content,";
        $sql = $sql . "AccessLevel,IsBasic,ExtInt1,ExtInt2,ExtInt3,ExtStr1,ExtStr2,ExtStr3)";
        $sql = $sql . " values('$this->ChannelId','$this->Pid','$this->Path',";
        $sql = $sql . "'$this->Depth','$this->RootId','$this->Title','$this->SubTitle','$this->Cname','$this->SortId',";
        $sql = $sql . "'$this->ImgUrl','$this->ImgUrl1','$this->ImgUrl2','$this->ImgUrl3','$this->ImgUrl4','$this->LinkUrl','$this->SeoTitle','$this->SeoKeywords',";
        $sql = $sql . "'$this->Zhaiyao','$this->Content','$this->AccessLevel','$this->IsBasic','$this->ExtInt1',";
        $sql = $sql . "'$this->ExtInt2','$this->ExtInt3','$this->ExtStr1','$this->ExtStr2','$this->ExtStr3')";
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
        $sql = "update ".self::TableName ." set ChannelId='$this->ChannelId',Pid='$this->Pid',Path='$this->Path',";
        $sql = $sql . "Depth='$this->Depth',RootId='$this->RootId',Title='$this->Title',";
        $sql = $sql . "SubTitle='$this->SubTitle',Cname='$this->Cname',SortId='$this->SortId',";
        $sql = $sql . "ImgUrl='$this->ImgUrl',ImgUrl1='$this->ImgUrl1',ImgUrl2='$this->ImgUrl2',ImgUrl3='$this->ImgUrl3',ImgUrl4='$this->ImgUrl4',LinkUrl='$this->LinkUrl',SeoTitle='$this->SeoTitle',";
        $sql = $sql . "SeoKeywords='$this->SeoKeywords',Zhaiyao='$this->Zhaiyao',";
        $sql = $sql . "Content='$this->Content',AccessLevel='$this->AccessLevel',IsBasic='$this->IsBasic',";
        $sql = $sql . "ExtInt1='$this->ExtInt1',ExtInt2='$this->ExtInt2',ExtInt3='$this->ExtInt3',";
        $sql = $sql . "ExtStr1='$this->ExtStr1',ExtStr1='$this->ExtStr2',ExtStr1='$this->ExtStr3' ";
        $sql = $sql . "where Id=$this->Id";
        $result = $DB->Execute($sql);
        return $result;
    }
}