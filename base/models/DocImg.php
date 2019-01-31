<?php
class  DocImg
{
    const TableName = "DocImg";
    var $Id;
    var $DocId;
    var $SmallUrl;
    var $BigUrl;
    var $Title;
    var $SortId;

    public static function GetList($where="1=1")
    {
        global $DB;
        $sql = "select * from " . self::TableName . " where $where ";
        $result = $DB->getall($sql);
        return $result;
    }

    public static function SaveAll($docId,$imgArray)
    {
        if ($imgArray != null && count($imgArray) > 0) {
            for ($i = 0; $i < count($imgArray); $i++) {
                $imgArr = explode('|',$imgArray[$i]);
                if (count($imgArr) == 3) {
                    $imgId = $imgArr[0];
                    $img = new DocImg();
                    $img->Id = $imgId;
                    $img->DocId = $docId;
                    $img->BigUrl = $imgArr[1];
                    $img->SmallUrl = $imgArr[2];
                    $img->SortId = $i;
                    $img->Save();
                }
            }
        }
    }
    public static function SaveSingle($docId,$imgUrl)
    {

        $img = new DocImg();
        $img->Id =0;
        $img->DocId = $docId;
        $img->BigUrl = $imgUrl;
        $img->SmallUrl = $imgUrl;
        $img->SortId = 100;
        $img->Save();
    }
    public function Save()
    {
        if ($this->Id == 0){
            return $this->Insert();
        }
        else
            return $this->Update();
    }

    private function Insert()
    {
        global $DB;
        $sql = "insert into " . self::TableName . "(DocId,SmallUrl,BigUrl,Title,SortId)";
        $sql = $sql . " values('$this->DocId','$this->SmallUrl','$this->BigUrl',";
        $sql = $sql . "'$this->Title','$this->SortId')";
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
        $sql = "update ".self::TableName ." set DocId='$this->DocId',SmallUrl='$this->SmallUrl',BigUrl='$this->BigUrl',";
        $sql = $sql . "Title='$this->Title',SortId='$this->SortId' ";
        $sql = $sql . "where Id=$this->Id";
        $result = $DB->Execute($sql);
        return $result;
    }
}