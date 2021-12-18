<?php


namespace App\Service;


use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\Cache\CacheInterface;

class MarkDownHelper
{
    private $markdownParser;
    private $cache;
    private $debug;
    private $logger;

    public function __construct(MarkdownParserInterface $markdownParser, CacheInterface $cache, $debug, LoggerInterface $logger)
    {
        $this->markdownParser = $markdownParser;
        $this->cache = $cache;
        $this->debug = $debug;
        $this->logger = $logger;
    }

    public function parser(string $source) {

        $this->logger->info('Duda');

        $parserContent = $this->cache->get('markdown_'.md5($source), function() use ( $source ) {
            return $this->markdownParser->transformMarkdown($source);
        });
        return $parserContent;
    }
}