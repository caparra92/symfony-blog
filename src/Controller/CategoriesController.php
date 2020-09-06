<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Category;
use Symfony\Component\Security\Core\User\UserInterface;

class CategoriesController extends AbstractController

{
    public function index() {
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository->findAll();
        return $this->render('blog/categories/index.html.twig',['categories'=>$categories]);
    }
    
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


        return $this->redirectToRoute('category-index');
    }

    public function edit($id) {
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $category = $repository->find($id);
        return $this->render('blog/categories/edit.html.twig',['category'=>$category]);
    }

    public function update(Request $request, $id, UserInterface $user) {

        $entityManager = $this->getDoctrine()->getManager();

        $repository = $this->getDoctrine()->getRepository(Category::class);
        $category = $repository->find($id);
        $category->setName($request->request->get('name'));
        $category->setDescription($request->request->get('description'));
        $category->setUser($user);

        $entityManager->persist($category);
        $entityManager->flush();

        return $this->redirectToRoute('category-index');
    }

    public function destroy($id) {
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $category = $repository->find($id);

        $entityManager->remove($category);
        $entityManager->flush();

        return $this->redirectToRoute('category-index');
    }
}