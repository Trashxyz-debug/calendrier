<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\{ Event, User };
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    protected $prenom = '';

    public function index(Request $request)
    {

        // Récupère dans la variable $verified si l'utilisateur a validé son email
        if(Auth::check()) {
          $request->user()->hasVerifiedEmail() ? $verified = 1 : $verified = 0;
        } else $verified = null;

        if ($request->ajax()) {
            // Mise à jour des Evenements pré-reservés
            // $books = Event::where('book_until', '<', Carbon::now())
            //     ->get();

            // Pour chaque enregistremet ramené par la requête précédent
            // on remet à NULL les champs BOOK et BOOK_UNTIL
            // foreach($books as $book) {
            //   Event::where('id', $book->id)
            //       ->update([
            //       'book' => null,
            //       'book_until' => null
            //   ]);
            // }


            // Affichage de tous les enregistrements ayant un champ BOOK à NULL
            // $events = Event::whereDate('start', '>=', $request->start)
            //     ->whereDate('end', '<=', $request->end)
            //     ->whereNull('book')
            //     ->get();

            // Affichage de tous les évenements avec une couleur différente suivant si la Réservation
            // - Gris : Déjà réservé par un autre utilisateur
            // - Bleu : Dispo
            // - Vert : réservé par l'utilisateur
            $events = Event::whereDate('start', '>=', $request->start)
                ->whereDate('end', '<=', $request->end)
                ->get();

                // Mise en couleur selon si l'évènement est réservé ou non
                foreach($events as $event) {
                  if(Auth::check()) {
                    if($event->book and $event->user_id == Auth::id()) {
                      $event['color'] = '#2f9d32'; // Vert
                    } elseif($event->book and $event->user_id != Auth::id()) {
                      $event['color'] = '#7a7a7a'; // Gris
                    } else $event['color'] = '#3a87ad'; // Bleu
                  }
                  elseif($event->book) {
                      $event['color'] = '#7a7a7a'; // Gris
                    }
                  else {
                    $event['className'] = 'bg-gradient-warning';
                  }
                }

            return response()->json($events);
        }

        // Si l'utilisateur est connecté, on récupère son prénom et ses initiales
        if(Auth::check()) {
          $prenom = auth()->user()->prenom;
          $initiale = strtoupper(substr(auth()->user()->prenom, 0, 1)).strtoupper(substr(auth()->user()->nom, 0, 1)); }
        else { $prenom = ''; $initiale = '';}

        // Récupération des évenements réservés par l'utilisateur
        if(Auth::check()) {
          $books = Event::select('id', 'title', 'start', 'end')
              ->where('user_id', '=', auth()->user()->id)
              ->get();

              foreach($books as $book) {
                $book['jour'] = Carbon::parse($book->start)->format('d/m/Y');
                $book->start = Carbon::parse($book->start)->format('H:i');
                $book->end = Carbon::parse($book->end)->format('H:i');
              }
        } else {
          $books = '';
        }

        return view('home.calendrier', compact('prenom', 'initiale', 'books', 'verified'));
    }


    public function create(Request $request)
    {

        $input = $request->only(['id']);

        $request_data = [
            'id' => 'required'
        ];

        $validator = Validator::make($input, $request_data);

        // invalid request
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Problème de réservation'
            ]);
        }

        // Mise à jour des champs BOOK et BOOK_UNTIL à H+1
        // $event = Event::where('id', $input['id'])
        //     ->update([
        //     'book' => false,
        //     'book_until' => Carbon::now()->addMinute()
        // ]);


        // Mise à jour de la table EVENT avec l'ID de la personne qui réserve
        $event = Event::where('id', $input['id'])
            ->update([
            'book' => true,
            'user_id' => auth()->user()->id
        ]);

        return response()->json([
            'success' => true,
            'data' => $event
        ]);

    }

}
