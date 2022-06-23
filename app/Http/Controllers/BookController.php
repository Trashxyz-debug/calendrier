<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\{ Event, Book};
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookController extends Controller
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

            return response()->json($events);
        }

        return view('book');
    }


    public function create(Request $request)
    {

        $input = $request->only(['event_id']);
        $currentDateTime = Carbon::now();

        $request_data = [
            'event_id' => 'required'
        ];

        $validator = Validator::make($input, $request_data);

        // invalid request
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Problème de réservation'
            ]);
        }

        $event_id = $input['event_id'];


        $event = Book::create([
            'event_id' => (int)$event_id,
            'title' => 'rerazer',
            'start' => '2022-06-01',
            'end' => '2022-06-02',
            'book' => false,
            'book_until' => Carbon::now()->addHour()
        ]);

        return response()->json([
            'success' => true,
            'data' => $event
        ]);

    }

}
