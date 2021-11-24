<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('demo/index.html.twig', [
            'controller_name' => 'DemoController',
        ]);
    }

    #[Route('/about', name: 'about')]
    public function about():Response
    {
        return $this->render('demo/about.html.twig', []);
    }

    #[Route('/info/{name}', name: 'info')]
    public function info($name= 'Jacek')
    {
        return $this->render('demo/info.html.twig', [
            'name'=>$name,
        ]);
    }
    #[Route('/new', name: 'new')]
    public function new()
    {
        $textArray = [
           'name'=>'tekst',
            'surname'=>'ćwiczebny'
        ];

        $text = 'Ewelina ma kota';

        return $this->render('demo/new.html.twig', [
            'text'=>$text,
            'textArray'=>$textArray,
        ]);
    }
}
