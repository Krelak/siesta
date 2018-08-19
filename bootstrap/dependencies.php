<?php
//TODO: mover esto al appServiceProvider

$app = app();
/***************************************
 * USECASES
 **************************************/
$app->bind(\siesta\application\movie\usecases\StoreMovieHandler::class, \siesta\application\movie\usecases\StoreMovieHandler::class);
$app->bind(\siesta\domain\extraction\MovieExtractor::class, \App\UseCases\ExtractMovieList\SitgesWeb2018MovieExtractor::class);

/***************************************
 * HELPERS
 **************************************/
$app->bind(\App\UseCases\ExtractMovieList\HtmlParser::class, \App\UseCases\ExtractMovieList\SimpleDomHtmlParser::class);
$app->bind(\App\Helpers\FinderVideoService::class, function ($app) {
    $googleClient = new Google_Client();
    $googleClient->setApplicationName(env('GOOGLE_APP_NAME'));
    $googleClient->setDeveloperKey(env("GOOGLE_APP_KEY"));
    $videoService = new Google_Service_YouTube($googleClient);

    return new \App\Helpers\YoutubeFinderVideoService($videoService);
});

/***************************************
 * INFRASTRUCTURE
 **************************************/
$app->bind(\siesta\domain\movie\MovieRecorder::class, \siesta\infrastructure\movie\EloquentMovieRecorder::class);