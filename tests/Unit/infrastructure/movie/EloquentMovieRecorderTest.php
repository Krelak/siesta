<?php

namespace Tests\Unit\infrastructure\movie;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use siesta\domain\exception\RecordException;
use siesta\domain\movie\Movie;
use siesta\infrastructure\movie\EloquentMovieRecorder;

/**
 * Class EloquentMovieRecorderTest
 * @package Tests\Unit\infrastructure\movie
 */
class EloquentMovieRecorderTest extends \Tests\TestCase
{

    use DatabaseMigrations;

    /** @var EloquentMovieRecorder */
    private $_recorder;
    /** @var  Model|\PHPUnit\Framework\MockObject\MockObject */
    private $_eloquentModel;

    public function testWhenSomethingIsInsertedGivesOkOrThrowsException()
    {
        try {
            $movie = $this->_getValidMovie();
            $this->_recorder->store($movie);
        } catch (RecordException $e) {
            $this->fail('Shouldn\'t throw exception');
        }


        try {
            $movie = $this->_getValidMovie();
            $this->_recorder->store($movie);
            $this->fail('Should throw RecordException');
        } catch (RecordException $e) {
            $this->assertTrue(true);
        }
    }

    /**
     * @return Movie
     */
    private function _getValidMovie(): Movie
    {
        $movie = new Movie();
        $movie->setDuration(90);
        $movie->setPoster('poster');
        $movie->setSummary('summary');
        $movie->setTitle('testMovie');
        $movie->setTrailer('coolTrailer');

        return $movie;
    }

    protected function setUp()
    {
        parent::setUp();
        $this->_recorder = new EloquentMovieRecorder();
    }
}
