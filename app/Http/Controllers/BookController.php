<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\{ Event };
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Mise à jour des Evenements pré-reservés
            $books = Event::where('book_until', '<', Carbon::now())
                ->get();

            // Pour chaque enregistremet ramené par la requête précédent
            // on remet à NULL les champs BOOK et BOOK_UNTIL
            foreach($books as $book) {
              Event::where('id', $book->id)
                  ->update([
                  'book' => null,
                  'book_until' => null
              ]);
            }

            // Affichage de tous les enregistrements ayant un champ BOOK à NULL
            $events = Event::whereDate('start', '>=', $request->start)
                ->whereDate('end', '<=', $request->end)
                ->whereNull('book')
                ->get();

            return response()->json($events);
        }

        return view('book');

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
        $event = Event::where('id', $input['id'])
            ->update([
            'book' => false,
            'book_until' => Carbon::now()->addMinute()
        ]);

        return response()->json([
            'success' => true,
            'data' => $event
        ]);

    }

}
