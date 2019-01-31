<?php
class  JobResume
{
    const TableName = "JobResume";
    var  $Id;
    var  $Lang;
    var  $AddTime;
    var  $Title;
    var  $EmployeeName ;
    var  $Birthday;
    var  $Sex ;
    var  $BodyCar;
    var  $HuKou;
    var  $Marry ;
    var  $Experience ;
    var  $Eyesight ;
    var  $Height ;
    var  $Nowsalary ;
    var  $Professionaltitle ;
    var  $PoliticalStatus ;
    var  $HomeAdd ;
    var  $GraduationDate ;
    var  $ContactAdd ;
    var  $Phone ;
    var  $HomePage ;
    var  $WeiXin ;
    var  $Email;
    var  $Level ;
    var  $Language ;
    var  $Oracy ;
    var  $MasteryDegree ;
    var  $LanguageLevel ;
    var  $ArrivalTime;
    var  $JobCategory;
    var  $Hopeindustries;
    var  $Targetlocation ;
    var  $ExpectedSalary ;
    var  $Other ;
    var  $EducationExp ;
    var  $WorkExp;
    var  $TrainExp ;
    var  $Selfassess ;
    var  $ExtText1;
    var  $ExtText2;
    var  $ExtText3;
    var  $ExtText4;

    private function Insert()
    {
        global $DB;
        $sql = "insert into ".self::TableName ."(Lang,Title,EmployeeName,Sex,Marry,Birthday,Height,";
        $sql = $sql . " BodyCar,HuKou,Experience,Eyesight,Nowsalary,Professionaltitle,PoliticalStatus,";
        $sql = $sql . " HomeAdd,GraduationDate,ContactAdd,Phone,AddTime,HomePage,WeiXin,Email,Level,";
        $sql = $sql . " Language,Oracy,MasteryDegree,LanguageLevel,ArrivalTime,JobCategory,Hopeindustries,Targetlocation,ExpectedSalary,";
        $sql = $sql . " Other ,EducationExp,WorkExp,TrainExp,Selfassess,ExtText1,ExtText2,ExtText3,ExtText4)";
        $sql = $sql . " values('$this->Lang','$this->Title','$this->EmployeeName',";
        $sql = $sql . "'$this->Sex','$this->Marry','$this->Birthday','$this->Height',";
        $sql = $sql."'$this->BodyCar','$this->HuKou','$this->Experience','$this->Eyesight',";
        $sql = $sql."'$this->Nowsalary','$this->Professionaltitle','$this->PoliticalStatus','$this->HomeAdd',";
        $sql = $sql."'$this->GraduationDate','$this->ContactAdd','$this->Phone','$this->AddTime',";
        $sql = $sql."'$this->HomePage','$this->WeiXin','$this->Email','$this->Level',";
        $sql = $sql."'$this->Language','$this->Oracy','$this->MasteryDegree','$this->LanguageLevel',";
        $sql = $sql."'$this->ArrivalTime','$this->JobCategory','$this->Hopeindustries','$this->Targetlocation',";
        $sql = $sql."'$this->ExpectedSalary','$this->Other','$this->EducationExp','$this->WorkExp',";
        $sql = $sql."'$this->TrainExp','$this->Selfassess','$this->ExtText1','$this->ExtText2',";
        $sql = $sql."'$this->ExtText3','$this->ExtText4')";
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
        $sql = "update ".self::TableName ." set Lang='$this->Lang',Title='$this->Title',EmployeeName='$this->EmployeeName',";
        $sql = $sql . "Sex='$this->Sex',Marry='$this->Marry',Birthday='$this->Birthday',";
        $sql = $sql . "Height='$this->Height',BodyCar='$this->BodyCar',HuKou='$this->HuKou',Experience='$this->Experience',";
        $sql = $sql."Eyesight='$this->Eyesight',Nowsalary='$this->Nowsalary',Professionaltitle='$this->Professionaltitle',";
        $sql = $sql."PoliticalStatus='$this->PoliticalStatus',HomeAdd='$this->HomeAdd',GraduationDate='$this->GraduationDate',";
        $sql = $sql."ContactAdd='$this->ContactAdd',Phone='$this->Phone',AddTime='$this->AddTime',";
        $sql = $sql."HomePage='$this->HomePage',WeiXin='$this->WeiXin',Email='$this->Email',";
        $sql = $sql."Level='$this->Level',Language='$this->Language',Oracy='$this->Oracy',";
        $sql = $sql."MasteryDegree='$this->MasteryDegree',LanguageLevel='$this->LanguageLevel',ArrivalTime='$this->ArrivalTime',";
        $sql = $sql."JobCategory='$this->JobCategory',Hopeindustries='$this->Hopeindustries',Targetlocation='$this->Targetlocation',";
        $sql = $sql."ExpectedSalary='$this->ExpectedSalary',Other='$this->Other',EducationExp='$this->EducationExp',";
        $sql = $sql."WorkExp='$this->WorkExp',TrainExp='$this->TrainExp',Selfassess='$this->Selfassess',";
        $sql = $sql."ExtText1='$this->ExtText1',ExtText2='$this->ExtText2',TExtText3='$this->ExtText3',TExtText4='$this->ExtText4'";
        $sql = $sql . " where Id=$this->Id";
        $result = $DB->Execute($sql);
        echo "asdas";
        exit;
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
        $JobResume = new JobResume();
        if($id>0) {
            global $DB;
            $sql = "select * from " . self::TableName . " where Id=$id";
            $result = $DB->GetRow($sql);
            if (count($result) > 0) {
                foreach ($result as $key => $value) {

//                    var  $key = $value;
                }
            }
        }
        return $JobResume;
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
//    public static function GetPageList($pagesize, $currentPage, $condition, $orderMode)
//    {
//        global $DB;
//        $skip = $pagesize * ($currentPage - 1);
//        $strSql = "select * from " . self::TableName . "  where id in(";
//        $strSql = $strSql . "select id FROM " . self::TableName . " where $condition order by $orderMode";
//        $strSql = $strSql . " limit $skip,$pagesize) order by $orderMode";
//        $resault = $DB->GetAll($strSql);
//        return $resault;
//    }
    public static function GetPageList($pagesize, $currentPage, $condition, $orderMode)
    {
        global $DB;
        $skip = $pagesize * ($currentPage - 1);
        $strSql = "select * from " . self::TableName . "  where id in(select t.Id FROM (";
        $strSql = $strSql . "select id FROM " . self::TableName . " where $condition order by $orderMode";
        $strSql = $strSql . " limit $skip,$pagesize) as t) order by $orderMode";
        $resault = $DB->GetAll($strSql);
//        echo $strSql;
//        exit();
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