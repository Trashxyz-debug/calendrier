@extends('layouts.user5')

@section('calendrier5')

  <div class="right_col" role="main">
    <div class="">

      <div class="clearfix"></div>
      <div class="row">
        <div>
          @if($books <> '')
            @foreach ($books as $book)
              <p>Réservation pour {{ $book->title }} le {{ $book->jour }} de  {{ $book->start }} à  {{ $book->end }}</p>
            @endforeach
          @endif
        </div>
      </div>
      <div class="row">
        <div>
          <p>
              <span class="fc-event-dot" style="background-color: #3a87ad;"></span>&nbsp;Libre&nbsp;
              <span class="fc-event-dot" style="background-color: #7a7a7a;"></span>&nbsp;Occupé&nbsp;
              @auth
                <span class="fc-event-dot" style="background-color: #2f9d32;"></span>&nbsp;Vos réservations
              @endauth
          </p>
        </div>
      </div>
      <div class="row">
          <div class="col-xl-9">
              <div class="card card-calendar">
                  <div class="card-body p-3">
                      <div class="calendar" data-bs-toggle="calendar" id="calendar"></div>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>

@stop
