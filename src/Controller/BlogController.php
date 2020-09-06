<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    public function index() {
        return $this->render('index.html.twig');
    }

    public function register() {
        return $this->render('blog/register.html.twig');
    }

    public function home() {
        return $this->render('blog/home.html.twig');
    }

    public function  contact() {
        return $this->render('blog/contact.html.twig');
    }

    public function store() {
        
    }

    public function update() {
        
    }

    public function destroy() {
        
    }
}