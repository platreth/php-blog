<?php

namespace Controllers;

class AdminController extends Controller
{
    public function index()
    {
        echo $this->twig->render('admin/dashboard.html');
    }
}