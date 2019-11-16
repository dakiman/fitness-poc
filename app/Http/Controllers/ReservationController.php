<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return view('reserve');
    }

    public function save(Request $request)
    {
        $validatedParameters = $request->validate([
           'name' => 'string|min:2|max:50',
           'email' => 'email',
           'phoneNumber' => 'numeric|min:2'
        ]);

        $reservation = Reservation::create($validatedParameters);

        return response()->json($reservation,200);
    }
}
