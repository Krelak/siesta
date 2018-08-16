<?php
namespace siesta\application\movie\usecases;

class StoreMovieCommand
{
    /** @var string */
    private $_title;
    /** @var string */
    private $_summary;
    /** @var string */
    private $_poster;
    /** @var int */
    private $_duration;

    /**
     * StoreMovieCommand constructor.
     * @param string $title
     * @param string $summary
     * @param string $poster
     * @param int $duration
     */
    private function __construct($title, $summary, $poster, $duration)
    {
        $this->_title = $title;
        $this->_summary = $summary;
        $this->_poster = $poster;
        $this->_duration = $duration;
    }

    /**
     * @param string $rawData
     * @return StoreMovieCommand
     */
    public static function buildFromJsonData(string $rawData): StoreMovieCommand
    {
        $data = json_decode($rawData);
        return new self($data->title, $data->summary, $data->poster, $data->duration);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->_title;
    }

    /**
     * @return string
     */
    public function getSummary(): string
    {
        return $this->_summary;
    }

    /**
     * @return string
     */
    public function getPoster(): string
    {
        return $this->_poster;
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->_duration;
    }



}