<?php
namespace App\Helpers;

use Google_Service_YouTube;
use Google_Service_YouTube_SearchResult;

class YoutubeFinderVideoService implements FinderVideoService
{

    private const PART_TO_FIND = 'snippet';
    private const QUERY_PARAM = 'q';

    /** @var Google_Service_YouTube */
    private $_service;

    /**
     * YoutubeFinderVideoService constructor.
     * @param Google_Service_YouTube $service
     */
    public function __construct(Google_Service_YouTube $service)
    {
        $this->_service = $service;
    }

    /**
     * @param string $text
     * @return string
     */
    public function findVideoByText(string $text): string
    {
        $firstVideo = $this->_getFirstVideoByText($text);

        return $firstVideo->getId()->getVideoId();
    }

    /**
     * @param string $text
     * @return Google_Service_YouTube_SearchResult
     */
    private function _getFirstVideoByText(string $text): Google_Service_YouTube_SearchResult
    {
        $videos = $this->_service->search->listSearch(self::PART_TO_FIND, [self::QUERY_PARAM => $text]);

        return current($videos->getItems());
    }
}