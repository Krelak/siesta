<?php
namespace siesta\domain\movie;


/**
 * Interface MovieRecorder
 * @package siesta\domain\model\movie
 */
interface MovieRecorder
{
    /**
     * @param Movie $movie
     * @return bool
     */
    public function save(Movie $movie);
}