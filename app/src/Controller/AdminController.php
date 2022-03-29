<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/admin/login', name: 'adminLogin')]
    public function login(): Response
    {
        return new Response('Page admin login should be public');
    }

    #[Route('/admin/comments', name: 'adminComments')]
    public function adminComments(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_COMMENT_ADMIN');

        return new Response('Pretend comment admin page');
    }
}
