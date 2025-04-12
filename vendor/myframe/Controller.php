<?php

namespace vendor\myframe;

class Controller
{
    public Views $view;
    public function __construct(){
       $this->view = new Views();
    }
}