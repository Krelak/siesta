<?php
namespace siesta\domain\movie;

class Movie
{

    /** @var string */
    private $_title;
    /** @var string */
    private $_summary;
    /** @var string */
    private $_poster;
    /** @var int */
    private $_duration;
    /** @var string */
    private $_trailerId;
    /** @var int */
    private $_id;

    /**
     * @param string $title
     */
    public function setTitle($title): void
    {
        $this->_title = $title;
    }

    /**
     * @param string $summary
     */
    public function setSummary($summary): void
    {
        $this->_summary = $summary;
    }

    /**
     * @param string $poster
     */
    public function setPoster($poster): void
    {
        $this->_poster = $poster;
    }

    /**
     * @param int $duration
     */
    public function setDuration($duration): void
    {
        $this->_duration = $duration;
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->_duration;
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
    public function getPoster(): string
    {
        return $this->_poster;
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
    public function getTrailerId(): string
    {
        return $this->_trailerId;
    }

    /**
     * @param string $trailer
     */
    public function setTrailerId($trailer): void
    {
        $this->_trailerId = $trailer;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'title' => $this->_title,
            'poster' => $this->_poster,
            'trailer' => $this->_trailerId,
            'duration' => $this->_duration,
            'summary' => $this->_summary,
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->_id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->_id = $id;
    }
}