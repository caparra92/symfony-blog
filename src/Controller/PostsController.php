<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Entity\Category;
use App\Entity\Post;
use DateTime;

class PostsController extends AbstractController
{
    
    public function index() {
        $repository = $this->getDoctrine()->getRepository(Post::class);
        $posts = $repository->findAll();
        return $this->render('blog/posts/index.html.twig',['posts'=>$posts]);
    }

    public function create() {
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository->findAll();
        return $this->render('blog/posts/create.html.twig',['categories'=>$categories]);
    }

    public function store(Request $request, UserInterface $user, SluggerInterface $slugger) {

        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Category::class);
        //Implements the Datetime Class
        $date = new DateTime("now");
        $category = $repository->find($request->request->get('category_id'));
        $post = new Post();
        $post->setTitle($request->request->get('title'));
        $post->setDescription($request->request->get('description'));
        $post->setDate($date);
        $post->setCategory($category);
        $post->setUser($user);
        $file = $request->files->get('image');

        if ($file) {
            $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

            try {
                $file->move(
                    $this->getParameter('files_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            $post->setImage($newFilename);
        }

        $entityManager->persist($post);
        $entityManager->flush();

        $this->addFlash('Success', 'Post created successfully!!');

        return $this->redirectToRoute('post-index');
    }

    public function edit($id) {
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository->findAll();
        $repository = $this->getDoctrine()->getRepository(Post::class);
        $post = $repository->find($id);
        return $this->render('blog/posts/edit.html.twig',['post'=>$post,'categories'=>$categories]);
    }

    public function update(Request $request, $id, UserInterface $user, SluggerInterface $slugger) {

        $entityManager = $this->getDoctrine()->getManager();
        //Implements the Datetime Class
        $date = new DateTime("now");
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $category = $repository->find($request->request->get('category_id'));

        $repository = $this->getDoctrine()->getRepository(Post::class);
        $post = $repository->find($id);

        $post->setTitle($request->request->get('title'));
        $post->setDescription($request->request->get('description'));
        $post->setDate($date);
        $post->setCategory($category);
        $post->setUser($user);
        $file = $request->files->get('image');

        if ($file) {
            $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

            try {
                $file->move(
                    $this->getParameter('files_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            $post->setImage($newFilename);
        }

        $entityManager->persist($post);
        $entityManager->flush();

        return $this->redirectToRoute('post-index');
    }

    public function destroy($id) {
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Post::class);
        $post = $repository->find($id);

        $entityManager->remove($post);
        $entityManager->flush();

        return $this->redirectToRoute('post-index');
    }
}