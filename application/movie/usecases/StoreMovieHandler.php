<?php
namespace siesta\application\movie\usecases;

use siesta\application\exception\WrongInputException;
use siesta\domain\movie\Movie;
use siesta\domain\movie\MovieRecorder;

/**
 * Class StoreMovieUseCase
 * @package App\movie\usecases
 */
class StoreMovieHandler
{
    /** @var MovieRecorder */
    private $_recorder;

    /**
     * StoreMovieUseCase constructor.
     * @param MovieRecorder $recorder
     */
    public function __construct(
        MovieRecorder $recorder
    ) {
        $this->_recorder = $recorder;
    }

    /**
     * @param StoreMovieCommand $command
     * @throws WrongInputException
     */
    public function execute(StoreMovieCommand $command): void
    {

        $this->_checkCommand($command);

        $movie = $this->_getMovieFromInput($command);

        $this->_recorder->store($movie);
    }

    /**
     * @param StoreMovieCommand $command
     * @return Movie
     */
    private function _getMovieFromInput(StoreMovieCommand $command): Movie
    {
        $movie = new Movie();
        $movie->setTitle($command->getTitle());
        $movie->setSummary($command->getSummary());
        $movie->setPoster($command->getPoster());
        $movie->setDuration($command->getDuration());
        $movie->setTrailer($command->getTrailer());

        return $movie;
    }

    /**
     * @param StoreMovieCommand $command
     * @throws WrongInputException
     */
    private function _checkCommand(StoreMovieCommand $command): void
    {
        $errors = [];
        if(!\is_int($command->getDuration())){
            $errors[] = "Incorrect duration:{$command->getDuration()}";
        }
        if(empty($command->getSummary())){
            $errors[] = "Empty summary:{$command->getSummary()}";
        }
        if(empty($command->getPoster())) {
            $errors[] = "Empty poster:{$command->getPoster()}";
        }
        if(empty($command->getTitle())) {
            $errors[] = "Empty title:{$command->getTitle()}";
        }

        if(!empty($errors)){
            throw new WrongInputException(json_encode($errors));
        }

    }

}