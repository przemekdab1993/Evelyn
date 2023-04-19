<?php


namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends BaseController
{

    /**
     * @Route("/api/me", name="api_my")
     * @IsGranted("IS_AUTHENTICATED_REMEMBERED")
     */
    public function apiMe(): Response
    {
        // json_encode($user)
        return $this->json($this->getUser(), 200, [], [
            'groups' => ['user:read']
        ]);
    }
}