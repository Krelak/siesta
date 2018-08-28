<?php
namespace siesta\infrastructure\vote\persistence;

use Illuminate\Database\Eloquent\Model;
use siesta\domain\exception\vote\VoteInvalidTypeException;
use siesta\domain\exception\vote\VoteRecordException;
use siesta\domain\vote\infrastructure\VoteRecorder;
use siesta\domain\vote\Vote;

/**
 * Class EloquentVoteRecorder
 * @package siesta\infrastructure\vote\persistence
 */
class EloquentVoteRecorder extends Model implements VoteRecorder
{
    private const TABLE_NAME = 'vote';
    private const FILLABLE_FIELDS = ['votes', 'historic_votes', 'movie_id'];
    /** @var EloquentScoreTransformer */
    private $_transformer;

    /**
     * EloquentVoteRecorder constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->fillable = self::FILLABLE_FIELDS;
        $this->table = self::TABLE_NAME;
        $scoreTransformer = app()->make(ScoreTransformer::class);
        $this->_transformer = new EloquentVoteRecorderTransformer($scoreTransformer);
        parent::__construct($attributes);
    }

    /**
     * @param Vote $vote
     * @throws VoteRecordException
     */
    public function store(Vote $vote): void
    {
        try {
            $fillableFields = $this->_getFillableFields($vote);
            /** @noinspection PhpUndefinedMethodInspection */
            self::create($fillableFields);
        } catch (\Exception $e) {
            throw new VoteRecordException($e);
        }
    }

    /**
     * @param Vote $vote
     * @return array
     * @throws VoteInvalidTypeException
     */
    private function _getFillableFields(Vote $vote): array
    {
        return array_combine($this->fillable, [
            $this->_transformer->getSerializedVotes($vote->getIndividualVoteList()),
            '',
            $vote->getMovieId(),
        ]);
    }
}