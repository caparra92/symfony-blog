<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersController extends AbstractController
{
    public function index() {
        
    }

    public function store(Request $request, UserPasswordEncoderInterface $encoder):Response{

        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();

        $user->setName($request->request->get('name'));
        $user->setLastName($request->request->get('lastname'));
        $user->setAddress($request->request->get('address'));
        $user->setPhone($request->request->get('phone'));
        $user->setEmail($request->request->get('email'));
        $encoded = $encoder->encodePassword($user, $request->request->get('password'));
        $user->setPassword($encoded);

        $entityManager->persist($user);
        $entityManager->flush();

        $response = new RedirectResponse('/login');

        return $response;
    }

    public function edit() {
        
    }

    public function update() {
        
    }

    public function destroy() {
        
    }
}