<?php
namespace siesta\application\movie\usecases;

use siesta\domain\exception\MovieNotFoundException;
use siesta\domain\movie\infrastructure\MovieProvider;
use siesta\domain\movie\Movie;

class ObtainMovieHandler
{
    /** @var MovieProvider */
    private $_movieProvider;

    /**
     * ObtainMovieHandler constructor.
     * @param MovieProvider $movieProvider
     */
    public function __construct(MovieProvider $movieProvider)
    {
        $this->_movieProvider = $movieProvider;
    }

    /**
     * @param ObtainMovieCommand $command
     * @return Movie
     * @throws MovieNotFoundException
     */
    public function execute(ObtainMovieCommand $command): Movie
    {
        return $this->_movieProvider->getMovieById($command->getId());
    }
}