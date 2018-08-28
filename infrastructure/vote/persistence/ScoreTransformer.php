<?php
namespace siesta\infrastructure\vote\persistence;

use siesta\domain\exception\vote\VoteInvalidTypeException;
use siesta\domain\vote\Score;

interface ScoreTransformer
{
    /**
     * @param Score $score
     * @return int
     * @throws VoteInvalidTypeException
     */
    public function fromDomainToPersistence(Score $score): int;
}