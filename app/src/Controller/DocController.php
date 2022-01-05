<?php

namespace App\Controller;

use App\Entity\Doc;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocController extends AbstractController
{
    #[Route('/doc', name: 'doc')]
    public function index(): Response
    {
        return $this->render('doc/index.html.twig', [
            'controller_name' => 'DocController',
        ]);
    }

    #[Route('/doc/new', name: 'docNew')]
    public function new(EntityManagerInterface $entityManager): Response
    {
        $newDoc = new Doc();

        $newDoc->setTitle('Nowy dokument')
            ->setLead('lead')
            ->setContent('Napis ćwiczebny')
            ->setCreatedDate(new \DateTime())
            ->setActive(true);

        $entityManager->persist($newDoc);
        $entityManager->flush();

        dd($newDoc);

        return $this->render('doc/newDoc.html.twig', [
            'controller_name' => 'DocController',
        ]);
    }
}
