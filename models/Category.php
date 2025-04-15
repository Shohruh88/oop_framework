<?php

namespace models;

use components\Constants;
use vendor\myframe\connection;
use vendor\myframe\Model;
use PDO;
class Category extends Model
{

    public function getList()
    {
//        $sql = "SELECT * FROM category";
//        $state = $this->db->prepare($sql);
//        $state->execute();
//        return $state->fetchAll();
    }
    public function getCategoryList($page, $withoutLimit=false)
    {
        $offset =  ($page-1) * Constants::LIMIT;

        if($withoutLimit){
            $sql = "select * from category";
            $state = $this->db->prepare($sql);
        }else {
            $sql = "select *from category limit :offset, :limit";
            $state = $this->db->prepare($sql);
            $state->bindValue(":limit", Constants::LIMIT, PDO::PARAM_INT);
            $state->bindValue(":offset", $offset, PDO::PARAM_INT);
        }
        $state->execute();
        $result = $state->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getPageCount()
    {
        $sql = "select *from category";
        $state = $this->db->prepare($sql);
        $state->execute();
        $total_rows = $state->rowCount();
        return ceil($total_rows / Constants::LIMIT);
    }



}
