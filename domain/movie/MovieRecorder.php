<?php
namespace siesta\domain\movie;


use siesta\domain\exception\MovieRecordException;

/**
 * Interface MovieRecorder
 * @package siesta\domain\model\movie
 */
interface MovieRecorder
{
    /**
     * @param Movie $movie
     * @throws MovieRecordException
     */
    public function store(Movie $movie);
}