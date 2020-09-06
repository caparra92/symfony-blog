<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Entity\Category;
use Symfony\Component\Security\Core\User\UserInterface;

class CategoriesController extends AbstractController

{
    public function create() {
        return $this->render('blog/categories/create.html.twig');
    }

    public function store(Request $request, UserInterface $user) {
        $entityManager = $this->getDoctrine()->getManager();

        $category = new Category();

        $category->setName($request->request->get('name'));
        $category->setDescription($request->request->get('description'));
        $category->setUser($user);
        

        $entityManager->persist($category);
        $entityManager->flush();

        $response = new RedirectResponse('/posts/create');

        return $response;
    }

    public function edit() {
        
    }

    public function update() {
        
    }

    public function destroy() {
        
    }
}