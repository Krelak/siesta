<?php

/** @var \App\Presentation\MovieDecorator $movie */
?>

@extends('base')
@section('content')
    <div class="container">
        <div class="row margin-top-30">
            <div class="col-md-12">
                <h2><i class="material-icons">movie</i> {{ $movie->getTitle()}}
                    <small>({{ $movie->getDuration() }})</small>
                </h2>
            </div>
        </div>
        <div class="row margin-top-30">
            <div class="col-md-6">
                <img height="333px" width="500px" src={!! html_entity_decode($movie->getPoster()) !!} />
            </div>
            <div class="col-md-6">
                {{ $movie->getSummary()}}
            </div>
        </div>
        <div class="row margin-top-20">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <iframe width="560" height="315" src="{{$movie->getTrailer()}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
            <div class="col-md-3"></div>
        </div>

        <input id="ex13" type="text" data-slider-ticks="[0, 100, 200, 300, 400]" data-slider-ticks-snap-bounds="30"
               data-slider-ticks-labels='["$0", "$100", "$200", "$300", "$400"]'/>
    </div>
@stop
