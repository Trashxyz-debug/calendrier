@extends('layouts.admin')

@section('calendrier')

  <div class="right_col" role="main">
    <div class="">

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12">
          <div class="x_panel">
            <div class="x_content">

              <div id='calendar'></div>

            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div>
          @foreach ($datas as $data)
              <p>{{ $data->id }} - Réservation le  {{ $data->jour }} de  {{ $data->start }} à  {{ $data->end }} par {{ $data->prenom }} {{ $data->nom }}</p>
          @endforeach
        </div>
      </div>
    </div>
  </div>

@stop
