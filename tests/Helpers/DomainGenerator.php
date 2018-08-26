<?php
namespace Tests\Helpers;

use siesta\domain\movie\Movie;

/**
 * Class DomainGenerator
 * @package Tests\Helpers
 */
class DomainGenerator
{
    /**
     * @return Movie
     */
    public static function givesMovie()
    {
        $movie = new Movie();
        $movie->setDuration(90);
        $movie->setPoster('poster');
        $movie->setSummary('summary');
        $movie->setTitle('testMovie');
        $movie->setTrailerId('coolTrailer');

        return $movie;
    }

    /**
     * @param array $attributes
     * @return Movie
     */
    public static function getMovieFromDBData(array $attributes)
    {

        $movie = new Movie();
        $movie->setTrailerId($attributes['trailer_id']);
        $movie->setTitle($attributes['title']);
        $movie->setPoster($attributes['poster']);
        $movie->setDuration($attributes['duration']);
        $movie->setSummary($attributes['summary']);

        return $movie;
    }
}