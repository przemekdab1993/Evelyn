<?php

namespace App\Controller;

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog')]
    public function index(): Response
    {
        return $this->render('blog/list.html.twig', [
            'controller_name' => 'BlogController'
        ]);
    }

    #[Route('/blog/show/{docId}', name: 'blog_show')]
    public function show($docId = 1, MarkdownParserInterface $markdownParser): Response
    {
        $docContent = [
            'id' => 1,
            'title' => "Czy warto było szaleć tak?",
            'lead' => "Fun fact! Witches & wizards **love** writing markdown. I have no idea why... but darnit! We're going to give the people what they want!",
            'text' => "Many users already have `downloaded` jQuery from Google when visiting another site. As a result, it will be loaded from cache when they visit your site, which leads to faster loading time. Also, most CDN's will make sure that once a user requests a file from it, it will be served from the server closest to them, which also leads to faster loading time."
        ];
        $docContent['lead'] = $markdownParser->transformMarkdown($docContent['lead']);
        $docContent['text'] = $markdownParser->transformMarkdown($docContent['text']);

        return $this->render('blog/show.html.twig', [
            'doc' => $docContent,
        ]);
    }
}
