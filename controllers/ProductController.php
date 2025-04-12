<?php

namespace controllers;
use vendor\myframe\connection;
use vendor\myframe\Controller;
use vendor\myframe\Views;
class ProductController extends Controller
{
    public function list()
    {
        $sql = "SELECT * FROM product";
        $conn = new Connection();
        $db = $conn->getConnection();
        $state = $db->prepare($sql);
        $state->execute();
        $result = $state->fetchAll();
        $this->view->render("product/list" ,
            ['productList'=>$result]);
    }

    public function add()
    {
      $this->view->render("product/add");
    }
}