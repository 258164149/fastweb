<?php
class  DocFieldval
{
    const TableName = "docfieldval";
    var $Id;
    var $DocId;
    var $FieldId;
    var $Contact;

    public static function GetList($where="1=1")
    {
        global $DB;
        $sql = "select * from " . self::TableName . " where $where ";
        $result = $DB->getall($sql);
        return $result;
    }
    public static function del_file($id)
    {
        global $DB;
        $sql = "delete from " . self::TableName . " where Id=$id";
        $result = $DB->Execute($sql);
        if ($result) {
            return true;
        }
        else
            return false;
    }

    public static function SaveAll($docId,$fileArray)
    {
        if ($fileArray != null && count($fileArray) > 0) {
            for ($i = 0; $i < count($fileArray); $i++) {
                $fileArr = explode('|',$fileArray[$i]);
                if (count($fileArr) == 3) {
                    $imgId = $fileArr[0];
                    $img = new DocImg();
                    $img->Id = $imgId;
                    $img->DocId = $docId;
                    $img->FieldId = $fileArr['url'];
                    $img->Content = $fileArr['title'];
                }
            }
        }
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
        $sql = "insert into " . self::TableName . "(DocId,FieldId,Content)";
        $sql = $sql . " values('$this->DocId','$this->FieldId','$this->Content')";
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
        $sql = "update ".self::TableName ." set DocId='$this->DocId',FieldId='$this->FieldId',Contact='$this->Contact'";
        $sql = $sql . "where Id=$this->Id";
        $result = $DB->Execute($sql);
        return $result;
    }
}