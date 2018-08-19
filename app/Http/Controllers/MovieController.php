<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use siesta\application\movie\usecases\StoreMovieCommand;
use siesta\application\movie\usecases\StoreMovieHandler;

class MovieController extends SiestaController
{
    /**
     * @param Request $request
     * @throws \siesta\application\exception\WrongInputException
     */
    public function create(Request $request): void
    {
        $command = StoreMovieCommand::buildFromJsonData(json_encode($request->input('data')));

        /** @var StoreMovieHandler $handler */
        $handler = app()->make(StoreMovieHandler::class);

        echo $handler->execute($command);
    }
}
