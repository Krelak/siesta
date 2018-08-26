<?php

namespace Tests\Unit\infrastructure\movie;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use siesta\domain\exception\MovieRecordException;
use siesta\infrastructure\movie\persistence\EloquentMovieRecorder;
use Tests\Helpers\DomainGenerator;

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
            $movie = DomainGenerator::givesMovie();
            $this->_recorder->store($movie);
        } catch (MovieRecordException $e) {
            $this->fail('Shouldn\'t throw exception');
        }


        try {
            $movie = DomainGenerator::givesMovie();
            $this->_recorder->store($movie);
            $this->fail('Should throw MovieRecordException');
        } catch (MovieRecordException $e) {
            $this->assertTrue(true);
        }
    }


    protected function setUp()
    {
        parent::setUp();
        $this->_recorder = new EloquentMovieRecorder();
    }
}
