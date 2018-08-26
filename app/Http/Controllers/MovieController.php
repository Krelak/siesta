<?php

namespace App\Http\Controllers;

use App\Presentation\MovieDecorator;
use Illuminate\Http\Request;
use siesta\application\exception\WrongInputException;
use siesta\application\movie\usecases\ObtainMovieCommand;
use siesta\application\movie\usecases\ObtainMovieHandler;
use siesta\application\movie\usecases\StoreMovieCommand;
use siesta\application\movie\usecases\StoreMovieHandler;
use siesta\domain\exception\MovieNotFoundException;
use siesta\domain\exception\MovieRecordException;

class MovieController extends SiestaController
{
    /**
     * @param Request $request
     * @throws WrongInputException
     * @throws MovieRecordException
     */
    public function create(Request $request): void
    {
        $command = StoreMovieCommand::buildFromJsonData(json_encode($request->input('data')));

        /** @var StoreMovieHandler $handler */
        $handler = app()->make(StoreMovieHandler::class);
        $handler->execute($command);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        try {

            $command = new ObtainMovieCommand();
            $command->setId($id);

            /** @var ObtainMovieHandler $handler */
            $handler = app()->make(ObtainMovieHandler::class);
            $movie = $handler->execute($command);
        } catch (MovieNotFoundException $e) {
            // TODO 404
            return view('404');
        }

        return view('movies.index', ['movie' => new MovieDecorator($movie)]);
    }
}
