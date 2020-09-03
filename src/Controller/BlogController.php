<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    public function index() {
        return $this->render('index.html.twig');
    }

    public function login() {
        return $this->render('blog/login.html.twig');
    }

    public function register() {
        return $this->render('blog/register.html.twig');
    }

    public function home() {
        return $this->render('blog/home.html.twig');
    }
}