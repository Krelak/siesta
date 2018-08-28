<?php
namespace siesta\domain\vote;

use siesta\domain\movie\Movie;

class Vote
{
    /** @var IndividualVote[] */
    private $_individualVoteList;
    /** @var Movie */
    private $_movie;

    /**
     * @return Score[]
     */
    public function getIndividualVoteList(): array
    {
        return $this->_individualVoteList;
    }

    /**
     * @return int
     */
    public function getMovieId(): int
    {
        return $this->_movie->getId();
    }


    /**
     * @param Movie $movie
     */
    public function setMovie(Movie $movie): void
    {
        $this->_movie = $movie;
    }

    /**
     * @param IndividualVote[] $scoreList
     */
    public function setIndividualVoteList(array $scoreList): void
    {
        $this->_individualVoteList = $scoreList;
    }
}