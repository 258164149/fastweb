<?php
/**
 * Created by PhpStorm.
 * User: waypdc
 * Date: 2018/5/10
 * Time: 14:40
 */
class arcticle{
    //删除咨询
    public function del($id){
        $mysqli = new mysqli("localhost","root","root","test");
        $result = $mysqli->query("delete from article where id=$id");
        return $result;
    }
    //批量删除咨询
    public function datadel($ids)
    {
        $mysqli = new mysqli("localhost", "root", "root", "test");
        $result = $mysqli->query("delete from article where id in ($ids)");
        return $result;
    }

//    下架资讯
    public function down($id){
        $mysqli = new mysqli("localhost","root","root","test");
        $result = $mysqli->query("update article set active='0' where id=$id");
        return $result;
    }
//    发布资讯
    public function up($id){
        $mysqli = new mysqli("localhost","root","root","test");
        $result = $mysqli->query("update article set active='1' where id=$id");
        return $result;
    }
    //    添加资讯
    public function insert($in){
        $mysqli = new mysqli("localhost","root","root","test");
        $result = $mysqli->query("insert into article (type,time,articlename,article_contant) values ('{$in['type']}','{$in['time']}','{$in['articlename']}','{$in['article_contant']}')");
        return $result;
    }
    //    修改资讯
    public function update($in, $id){
        $mysqli = new mysqli("localhost","root","root","test");
        $result = $mysqli->query("update article set articlename='{$in['articlename']}',article_contant='{$in['article_contant']}' where id=$id");
        return $result;
    }
}