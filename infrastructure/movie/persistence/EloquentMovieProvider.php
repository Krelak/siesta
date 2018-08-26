<?php
namespace siesta\infrastructure\movie\persistence;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use siesta\domain\exception\MovieNotFoundException;
use siesta\domain\movie\Movie;
use siesta\domain\movie\MovieProvider;

class EloquentMovieProvider extends Model implements MovieProvider
{

    private const TABLE_NAME = 'movie';
    private const FILLABLE_FIELDS = ['title', 'poster', 'trailer_id', 'duration', 'summary'];

    /** @var EloquentMovieTransformer */
    private $_transformer;


    /**
     * EloquentMovieRecorder constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->fillable = self::FILLABLE_FIELDS;
        $this->table = self::TABLE_NAME;
        parent::__construct($attributes);
        $this->_transformer = new EloquentMovieTransformer();
    }


    /**
     * @param int $id
     * @return Movie
     * @throws MovieNotFoundException
     */
    public function getMovieById($id): Movie
    {
        try {
            /** @noinspection PhpUndefinedMethodInspection */
            /** @var EloquentMovieProvider $mapping */
            $mapping = self::where('id', '=', $id)->firstOrFail();

            return $this->_getMovieFromMapping($mapping->getAttributes());
        } catch (ModelNotFoundException $e) {
            throw  new MovieNotFoundException($e);
        }
    }

    /**
     * @param array $mapping
     * @return Movie
     */
    private function _getMovieFromMapping(array $mapping): Movie
    {
        return $this->_transformer->fromArrayToMovie($mapping, self::FILLABLE_FIELDS);
    }
}