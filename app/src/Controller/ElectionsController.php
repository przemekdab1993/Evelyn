<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElectionsController extends AbstractController
{
    public $_votes= [
        ['id'=>1, 'name'=>'Jacek', 'vote'=>1,],
        ['id'=>2, 'name'=>'Evelina', 'vote'=>2,],
        ['id'=>3, 'name'=>'Przemek', 'vote'=>5,],
        ['id'=>4, 'name'=>'Monika', 'vote'=>0,]
    ];

    #[Route('/elections', name: 'elections')]
    public function index(): Response
    {
        $votes = $this->_votes;

        return $this->render('elections/index.html.twig', [
            'votes' => $votes,
        ]);
    }

    #[Route('/elections/{userId}/vote/{direction<up|down>}', name: 'vote', methods: 'POST')]
    public function vote($userId, $direction = 'up'): Response
    {
        if ($direction == 'up') {
            $newCount = rand(7, 100);
        } else {
            $newCount = rand(0, 6);
        }

        return $this->json(['newCount'=>$newCount, 'userId'=>$userId]);
    }
}
