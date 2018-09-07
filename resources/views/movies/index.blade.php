<?php

/** @var \App\Presentation\MovieDecorator $movie */
/** @var array users */
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
                <img class="border border-primary box-shadow" height={{$movie->getPosterHeight()}}"700px" width={{$movie->getPosterWidth()}}"500px"
                     src={!! html_entity_decode($movie->getPoster()) !!} />
            </div>
            <div class="col-md-6">
                <h2><i class="material-icons">comment</i> Sinopsis</h2>
                {{ $movie->getSummary()}}
                <div>
                    <iframe style="margin-top:10px; border: 10px double #ddd;" width="560" height="315" src="{{$movie->getTrailer()}}" frameborder="0"
                            allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="row margin-top-20">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <h2><i class="material-icons">thumb_up</i> Votaciones</h2>
                <form method="post">
                    {{ csrf_field() }}
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            Falta algo, mozo
                        </div>
                    @endif
                    <?php for($i = 0; $i < count($users); $i++): ?>
                    <span><strong><?php echo $users[$i]?></strong></span>
                    <fieldset class="margin-left-15">
                        <label for="vote_0<?=$i?>">
                            <input type="radio" id="vote0_<?=$i?>" name="user_<?= $i ?>" class="vote btn btn-secondary" value="0" checked>&nbsp;No querer
                        </label>
                        <label for="vote_1<?=$i?>">
                            <input type="radio" id="vote1_<?=$i?>" name="user_<?= $i ?>" class="vote btn btn-secondary" value="1" {{$movie->isWeakScore($i)}}>&nbsp;Podría verla
                        </label>
                        <label for="vote_2<?=$i?>">
                            <input type="radio" id="vote2_<?=$i?>" name="user_<?= $i ?>" class="vote btn btn-secondary" value="2" {{$movie->isStrongScore($i)}}>&nbsp;Quiero verla!!
                        </label>
                    </fieldset>
                    <?php endfor; ?>
                    <button type="submit" class="margin-top-10">Enviar voto!</button>
                </form>
            </div>
        </div>
        <div class="row margin-top-30">
            <div class="col-md-12">

            </div>
        </div>


    </div>
@stop
