<?php
namespace siesta\domain\movie;


use siesta\domain\exception\MovieNotFoundException;

/**
 * Interface MovieProvider
 * @package siesta\domain\model\movie
 */
interface MovieProvider
{
    /**
     * @param int $id
     * @return Movie
     * @throws MovieNotFoundException
     */
    public function getMovieById($id): Movie;
}