<?php
class  Doc
{
    const TableName = "Doc";
    var $Id;
    var $CategoryId;
    var $Title;
    var $SubTitle;
    var $Author;
    var $Src;
    var $LinkUrl;
    var $ThumbUrl;
    var $ImgUrl;
    var $ImgUrls;
    var $VideoUrl;
    var $FileUrl;
    var $DownNum;
    var $SeoTitle;
    var $SeoKeywords;
    var $SeoDesc;
    var $Content;
    var $DiggGood;
    var $DiggBad;
    var $Click=0;
    var $IsMsg;
    var $IsTop;
    var $IsRed=0;
    var $IsHot=0;
    var $IsSlide;
    var $State=1;
    var $AddTime;
    var $SortId;
    var $Price;
    var $PriceMarket;
    var $GuiGe;
    var $Attr;
    var $ExtInt1;
    var $ExtInt2;
    var $ExtInt3;
    var $ExtStr1;
    var $ExtStr2;
    var $ExtStr3;
    var $ExtText1;
    var $ExtText2;
    var $ExtText3;

    private function Insert()
    {
        global $DB;
        $sql = "insert into " . self::TableName . "(CategoryId,Title,SubTitle,Author,Src,LinkUrl,ThumbUrl,ImgUrl,ImgUrls,";
        $sql = $sql . "VideoUrl,FileUrl,DownNum,SeoTitle,SeoKeywords,SeoDesc,";
        $sql = $sql . "Content,DiggGood,DiggBad,Click,IsMsg,IsTop,IsRed,IsHot,";
        $sql = $sql . "IsSlide,State,AddTime,SortId,Price,PriceMarket,GuiGe,Attr,";
        $sql = $sql . "ExtInt1,ExtInt2,ExtInt3,ExtStr1,ExtStr2,ExtStr3,ExtText1,ExtText2,ExtText3)";
        $sql = $sql . " values('$this->CategoryId','$this->Title','$this->SubTitle',";
        $sql = $sql . "'$this->Author','$this->Src','$this->LinkUrl','$this->ThumbUrl','$this->ImgUrl','$this->ImgUrls',";
        $sql = $sql . "'$this->VideoUrl','$this->FileUrl','$this->DownNum','$this->SeoTitle',";
        $sql = $sql . "'$this->SeoKeywords','$this->SeoDesc','$this->Content','$this->DiggGood','$this->DiggBad',";
        $sql = $sql . "'$this->Click','$this->IsMsg','$this->IsTop','$this->IsRed','$this->IsHot',";
        $sql = $sql . "'$this->IsSlide','$this->State','$this->AddTime','$this->SortId','$this->Price',";
        $sql = $sql . "'$this->PriceMarket','$this->GuiGe','$this->Attr','$this->ExtInt1','$this->ExtInt2',";
        $sql = $sql . "'$this->ExtInt3','$this->ExtStr1','$this->ExtStr2','$this->ExtStr3','$this->ExtText1','$this->ExtText2','$this->ExtText3')";
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
        $sql = "update " . self::TableName . " set CategoryId='$this->CategoryId',Title='$this->Title',SubTitle='$this->SubTitle',";
        $sql = $sql . "Author='$this->Author',Src='$this->Src',LinkUrl='$this->LinkUrl',";
        $sql = $sql . "ThumbUrl='$this->ThumbUrl',ImgUrl='$this->ImgUrl',ImgUrls='$this->ImgUrls',";
        $sql = $sql . "VideoUrl='$this->VideoUrl',FileUrl='$this->FileUrl',DownNum='$this->DownNum',";
        $sql = $sql . "SeoTitle='$this->SeoTitle',SeoKeywords='$this->SeoKeywords',";
        $sql = $sql . "SeoDesc='$this->SeoDesc',Content='$this->Content',DiggGood='$this->DiggGood',";
        $sql = $sql . "DiggBad='$this->DiggBad',Click='$this->Click',IsMsg='$this->IsMsg',";
        $sql = $sql . "IsTop='$this->IsTop',IsRed='$this->IsRed',IsHot='$this->IsHot',";
        $sql = $sql . "IsSlide='$this->IsSlide',State='$this->State',AddTime='$this->AddTime',";
        $sql = $sql . "SortId='$this->SortId',Price='$this->Price',PriceMarket='$this->PriceMarket',";
        $sql = $sql . "GuiGe='$this->GuiGe',Attr='$this->Attr',ExtInt1='$this->ExtInt1',";
        $sql = $sql . "ExtInt2='$this->ExtInt2',ExtInt3='$this->ExtInt3',ExtStr1='$this->ExtStr1',";
        $sql = $sql . "ExtStr2='$this->ExtStr2',ExtStr3='$this->ExtStr3',ExtText1='$this->ExtText1',";
        $sql = $sql . "ExtText2='$this->ExtText2',ExtText3='$this->ExtText3' ";
        $sql = $sql . "where Id=$this->Id";
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

    public static function GetIdList($cateId,$orderMode)
    {
        global $DB;
        $sql = "select Id from " . self::TableName . " where CategoryId=$cateId and State=1 order by $orderMode";
        $result = $DB->getall($sql);
        return $result;
    }
    public static function GetCount($whereStr)
    {
        global $DB;
        $sql = "select count(1) from " . self::TableName . " where " . $whereStr;
        $result = $DB->GetOne($sql);
        return $result;
    }

    public static function GetTitleById($id){
        global $DB;
        $sql = "select Title from " . self::TableName . " where Id=" . $id;
        $result = $DB->getone($sql);
        return $result;
    }
    public static function GetModelById($id)
    {
        $Doc = new Doc();
        if ($id > 0) {
            global $DB;
            $sql = "select * from " . self::TableName . " where Id=$id";
            $result = $DB->GetRow($sql);
            if (count($result) > 0) {
                foreach ($result as $key => $value) {
                    $Doc->$key = $value;
                }
            }
        }
        return $Doc;
    }
    public static function DeleteById($id)
    {
        global $DB;
        $sql = "delete from " . self::TableName . " where Id=$id";
        $result = $DB->Execute($sql);
        if ($result > 0) {
            $sql = "delete from DocImg where DocId=$id";
            $DB->Execute($sql);
            $sql = "delete from DocFieldval where DocId=$id";
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
    public function Save()
    {
        if ($this->Id == 0)
            return $this->Insert();
        else
            return $this->Update();
    }
}