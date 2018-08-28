<?php
namespace siesta\infrastructure\vote\persistence;

use siesta\domain\exception\vote\VoteInvalidTypeException;
use siesta\domain\vote\IndividualVote;

class EloquentVoteRecorderTransformer
{
    /** @var ScoreTransformer */
    private $_scoreTransformer;

    /**
     * EloquentVoteRecorderTransformer constructor.
     * @param ScoreTransformer $scoreTransformer
     */
    public function __construct(ScoreTransformer $scoreTransformer)
    {
        $this->_scoreTransformer = $scoreTransformer;
    }

    /**
     * @param IndividualVote[] $getIndividualVoteList
     * @return string
     * @throws VoteInvalidTypeException
     */
    public function getSerializedVotes(array $getIndividualVoteList)
    {
        $serialized = [];
        foreach ($getIndividualVoteList as $individualVote) {
            $score = $this->_scoreTransformer->fromDomainToPersistence($individualVote->getScore());
            $serialized[] = ['userId' => $individualVote->getUserId(), 'score' => $score];
        }

        return json_encode($serialized);
    }
}