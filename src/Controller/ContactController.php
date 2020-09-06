<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contact;

class ContactController extends AbstractController
{
    public function index() {
        
    }

    public function store(Request $request) {

        $entityManager = $this->getDoctrine()->getManager();

        $contact = new Contact();
        $contact->setName($request->request->get('name'));
        $contact->setEmail($request->request->get('email'));
        $contact->setMessage($request->request->get('message'));

        $entityManager->persist($contact);
        $entityManager->flush();

        return $this->redirectToRoute('post-index');

    }

    public function update() {
        
    }

    public function destroy() {
        
    }
}