<?php

namespace controllers;

use vendor\myframe\Controller;
use vendor\myframe\Views;
use vendor\myframe\Connection;
class CategoryController extends Controller
{

    public function list()
    {
        $category = new Category();
        $result = $category->getList();
        $this->view->render("category/list" ,  ['list'=>$result]);
    }

    public function add()
    {
        $this->view->render("category/add");

    }
    public function update($id){
        echo "bu sayt ichidagi category update: ".$id;

    }
    public function delete(){
        echo "bu sayt ichidagi category delete";
    }
}