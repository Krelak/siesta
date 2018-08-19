<?php
namespace siesta\domain\movie;


use siesta\domain\exception\RecordException;

/**
 * Interface MovieRecorder
 * @package siesta\domain\model\movie
 */
interface MovieRecorder
{
    /**
     * @param Movie $movie
     * @throws RecordException
     */
    public function store(Movie $movie);
}