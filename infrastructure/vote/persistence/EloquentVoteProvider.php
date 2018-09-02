<?php
namespace siesta\infrastructure\vote\persistence;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use siesta\domain\exception\vote\VoteNotFoundException;
use siesta\domain\movie\Movie;
use siesta\domain\vote\infrastructure\VoteProvider;
use siesta\domain\vote\Vote;

/**
 * Class EloquentVoteProvider
 * @package siesta\infrastructure\vote\persistence
 */
class EloquentVoteProvider extends Model implements VoteProvider
{
    private const FILLABLE_FIELDS = ['votes', 'historic_votes', self::MOVIE_ID];
    private const TABLE_NAME = 'vote';
    private const MOVIE_ID = 'movie_id';
    private const ID = 'id';
    /** @var EloquentVoteSerializedTransformer */
    private $_transformer;

    /**
     * EloquentVoteProvider constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->table = self::TABLE_NAME;
        parent::__construct($attributes);
        $scoreTransformer = app()->make(ScoreTransformer::class);
        $this->_transformer = new EloquentVoteSerializedTransformer($scoreTransformer);
    }

    /**
     * @param int $id
     * @return Vote
     * @throws VoteNotFoundException
     */
    public function getVotesByMovieId(int $id): Vote
    {
        try {
            /** @noinspection PhpUndefinedMethodInspection */
            /** @var EloquentVoteProvider $mapping */
            $mapping = self::where(self::ID, '=', $id)->firstOrFail();

            return $this->_getVoteFromMapping($mapping->getAttributes());
        } catch (ModelNotFoundException $e) {
            throw new VoteNotFoundException($e);
        }
    }

    /**
     * @param array $mapping
     * @return Vote
     */
    private function _getVoteFromMapping(array $mapping): Vote
    {
        $fields = self::FILLABLE_FIELDS;
        $fields[] = self::ID;
        $vote = new Vote();
        $vote->setMovie(Movie::buildFromId($mapping[self::MOVIE_ID]));
        $vote->setIndividualVoteList($this->_transformer->getDeserializedVotes($mapping['votes']));

        return $vote;
    }
}