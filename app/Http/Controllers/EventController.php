<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $events = Event::whereDate('start', '>=', $request->start)
                ->whereDate('end', '<=', $request->end)
                ->get();

                // Mise en couleur selon si l'évènement est réservé ou non
                foreach($events as $event) {
                  if($event->book) {
                    $event['color'] = '#760f6f';
                  } 
                }

            return response()->json($events);
        }

        // Si l'utilisateur est connecté, on récupère son prénom et ses initiales
        if(auth()->id() != null ) {
          $prenom = auth()->user()->prenom;
          $initiale = strtoupper(substr(auth()->user()->prenom, 0, 1)).strtoupper(substr(auth()->user()->nom, 0, 1)); }
        else { $prenom = ''; $initiale = '';}

        // Récupération des évènements réservés
        $datas = Event::join('users', 'events.user_id', '=', 'users.id')
                  ->select('events.id', 'events.start', 'events.end', 'users.nom', 'users.prenom')
                  ->where('book', '=', 1)
                  ->orderBy('events.start', 'asc')
                  ->get();

        // foreach($datas as $data) {
        //    $day = Carbon::parse($data->start)->format('d/m/Y');
        //    array_push($data, day->$day);
        //    dd($data);
        // }
        foreach($datas as $data) {
          $data['jour'] = Carbon::parse($data->start)->format('d/m/Y');
          $data->start = Carbon::parse($data->start)->format('H:i');
          $data->end = Carbon::parse($data->end)->format('H:i');
        }

        return view('home.admin', compact('prenom', 'initiale', 'datas'));

    }

    /**
     * Create new event.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $input = $request->only(['title', 'start', 'end']);

        $request_data = [
            'title' => 'required',
            'start' => 'required',
            'end' => 'required'
        ];

        $validator = Validator::make($input, $request_data);

        // invalid request
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation des dates'
            ]);
        }

        $event = Event::create([
            'title' => $input['title'],
            'start' => $input['start'],
            'end' => $input['end']
        ]);

        return response()->json([
            'success' => true,
            'data' => $event
        ]);
    }

    /**
     * update current event.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $input = $request->only(['id', 'title', 'start', 'end']);
        // $input = $request->only(['id']);
        $request_data = [
            'id' => 'required',
            'title' => 'required',
            'start' => 'required',
            'end' => 'required'
        ];

        $validator = Validator::make($input, $request_data);

        // invalid request
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Erreur'
            ]);
            return false;
        }

        $event = Event::where('id', $input['id'])
            ->update([
                'title' => $request['title'],
                'start' => $request['start'],
                'end' => $request['end']
            ]);

        return response()->json([
            'success' => true,
            'data' => $event
        ]);
    }

    /**
     * Destroy the event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Event::where('id', $request->id)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Event removed successfully.'
        ]);
    }
}
