<?php

namespace models;

use vendor\myframe\connection;
use vendor\myframe\Model;

class Category extends Model
{

    public function getList()
    {
        $sql = "SELECT * FROM category";
        $state = $this->db->prepare($sql);
        $state->execute();
        return $state->fetchAll();

    }

    public function insertCategory()
    {
        return "Bu kategoriya add";
    }
}