<?php

namespace models;

use vendor\myframe\connection;
use vendor\myframe\Model;

class Product extends Model
{
//    public $db;
//    public function __construct(){
//        $conn = new Connection();
//        $this->db = $conn->getConnection();
//    }

    public function getList()
    {
        $sql = "SELECT * FROM product";
        $state = $this->db->prepare($sql);
        $state->execute();
        return $state->fetchAll();

    }

    public function insertProduct()
    {
        return "Bu kategoriya add";
    }
}