<?php

namespace controllers;


use models\Category;
use vendor\myframe\Controller;
use vendor\myframe\Views;
use vendor\myframe\Connection;

class CategoryController extends Controller
{

    public function list()
    {
        $page = 1;
        $category = new Category();
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $result = $category->getCategoryList($page);
        $pageCount = $category->getPageCount();
        $this->view->render("category/list" ,
            ['list'=>$result,
                'pageCount'=>$pageCount]);
    }

    public function add()
    {
        if (isset($_POST['category_name_input'])) {
            print_r($_POST);
        }
        $this->view->render("category/add");
    }
    public function update($id){
    if(isset($_POST['category_name_input'])){
        $category = new Category();
    }

        echo "bu sayt ichidagi category update: ".$id;

    }
    public function delete(){
        echo "bu sayt ichidagi category delete";
    }
    public function save(){
        echo "bu sayt ichidagi category save";
    }
}