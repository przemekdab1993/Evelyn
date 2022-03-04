<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Doc;
use App\Entity\DocRating;
use App\Repository\CommentRepository;
use App\Repository\DocRepository;
use Doctrine\ORM\EntityManagerInterface;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocController extends AbstractController
{
    #[Route('/doc/list/{page<\d+>}', name: 'docList')]
    public function index(DocRepository $docRepository, int $page = 1): Response
    {

        $queryBuilder = $docRepository->createListDocQueryBuilder();

        $pagerfantaListDoc = new Pagerfanta(
            new QueryAdapter($queryBuilder)
        );
        $pagerfantaListDoc->setMaxPerPage(10);
        $pagerfantaListDoc->setCurrentPage($page);

        return $this->render('doc/index.html.twig', [
            'pagerDocList' => $pagerfantaListDoc,
        ]);
    }

    #[Route('/doc/new', name: 'docNew')]
    public function new(EntityManagerInterface $entityManager): Response
    {
//        $newDoc = new Doc();
//        $newDocRating = new DocRating();
//
//        $newDoc->setTitle('Nowy dokument')
//            ->setLead('lead')
//            ->setContent('Napis ćwiczebny')
//            ->setCreatedDate(new \DateTime())
//            ->setActive(true)
//            ->setDocRating($newDocRating);
//
//        $entityManager->persist($newDoc);
//
//        $entityManager->flush();


        return $this->render('doc/newDoc.html.twig', [
            'controller_name' => 'DocController',
        ]);
    }

    #[Route('/doc/show/{docId}', name: 'docShow')]
    public function show($docId, EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Doc::class);

        $docOne = $repository->findOneBy(['id'=>$docId, 'active'=>true]);

        if (!$docOne) {
            throw $this->createNotFoundException('Wybrana strona nie została odnaleziona');
        }

        return $this->render('doc/show.html.twig', [
            'doc' => $docOne,
        ]);
    }


    #[Route('/doc/{docId}/vote', name: 'docVote', methods: 'POST')]
    public function voteDoc(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ratingType = $request->request->get('ratingType');
        $docId = $request->get('docId');

        if (!empty($docId) && !empty($ratingType)) {

            $repository = $entityManager->getRepository(DocRating::class);

            $docRating = $repository->findByDocId($docId);

            if ($ratingType === 'good') {
                $docRating->upVoteGood();
            } elseif ($ratingType === 'bad') {
                $docRating->upVoteBad();
            }

            $entityManager->flush();

            return $this->json(['good'=> $docRating->getGoodString('good'), 'bad'=>$docRating->getGoodString('bad')]);

        }
    }

    #[Route('doc/{commentId}/voteComment', name: 'commentVote', methods: 'POST')]
    public function voteComment(Request $request, EntityManagerInterface $entityManager): Response
    {
        $voteType = $request->request->get('voteType');
        $commentId = $request->get('commentId');

        if (!empty($voteType) && !empty($commentId)) {
            $repository = $entityManager->getRepository(Comment::class);

            $comment = $repository->find(['id'=>$commentId]);

            if ($voteType == 'up') {
                $comment->upVote();
            }
            $entityManager->flush();

            return $this->json(['countVote' => $comment->getVote()]);
        }
    }

    #[Route('/doc/popularCommentList', name: 'popularCommentList')]
    public function popularCommentList(Request $request, CommentRepository $commentRepository): Response
    {
        $docList = $commentRepository->findMostPopularListComment($request->query->get('q'));

        return $this->render('doc/popularCommentList.html.twig', [
            'commentList' => $docList,
            'countComment' => '10'
        ]);
    }
}
