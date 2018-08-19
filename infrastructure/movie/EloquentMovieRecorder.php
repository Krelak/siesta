<?php
namespace siesta\infrastructure\movie;

use Illuminate\Database\Eloquent\Model;
use siesta\domain\exception\RecordException;
use siesta\domain\movie\Movie;
use siesta\domain\movie\MovieRecorder;

/**
 * Class EloquentMovieRecorder
 * @package siesta\infrastructure\movie
 */
class EloquentMovieRecorder extends Model implements MovieRecorder
{
    private const TABLE_NAME = 'movie';
    private const FILLABLE_FIELDS = ['title', 'poster', 'trailer', 'duration', 'summary'];

    /**
     * EloquentMovieRecorder constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->fillable = self::FILLABLE_FIELDS;
        $this->table = self::TABLE_NAME;
        parent::__construct($attributes);
    }

    /**
     * @param Movie $movie
     * @throws RecordException
     */
    public function store(Movie $movie)
    {
        try {
            $fillableFields = $this->_getFillableFields($movie);

            /** @noinspection PhpUndefinedMethodInspection */
            self::create($fillableFields);
        } catch (\Exception $e) {
            throw new RecordException($e->getMessage(), 0, $e);
        }
    }

    /**
     * @param Movie $movie
     * @return array
     */
    private function _getFillableFields(Movie $movie): array
    {
        return array_combine($this->fillable, [
            $movie->getTitle(),
            $movie->getPoster(),
            $movie->getTrailer(),
            $movie->getDuration(),
            $movie->getSummary()

        ]);
    }
}