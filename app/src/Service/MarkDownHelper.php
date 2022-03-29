<?php


namespace App\Service;


use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Contracts\Cache\CacheInterface;

class MarkDownHelper
{
    private $markdownParser;
    private $cache;
    private $debug;
    private $logger;
    private $security;

    /**
     * MarkDownHelper constructor.
     * @param MarkdownParserInterface $markdownParser
     * @param CacheInterface $cache
     * @param $debug
     * @param LoggerInterface $logger
     * @param Security $security
     */
    public function __construct(MarkdownParserInterface $markdownParser, CacheInterface $cache, $debug, LoggerInterface $logger, Security $security)
    {
        $this->markdownParser = $markdownParser;
        $this->cache = $cache;
        $this->debug = $debug;
        $this->logger = $logger;
        $this->security = $security;
    }

    public function parser(string $source):string
    {
        $this->logger->info('Duda');

        if ($this->security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $this->logger->info('Rendering markdown for {user}',[
                'user' => $this->security->getUser()->getUserIdentifier()
            ]);
        }


        $parserContent = $this->cache->get('markdown_'.md5($source), function() use ( $source ) {
            return $this->markdownParser->transformMarkdown($source);
        });
        return $parserContent;
    }
}