<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JoinMatchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
        // $clientID = Auth::user()->id;
        // $matches = DB::table('matches')->get();
 
        // foreach ($matches as $match) {
        //     if ($match->player2_id == null) {
        //         $match->player2_id = $clientID;
        //         $clientID = null;
        //         return view('dashboard');
        //     }
        // }

        // if ($clientID != null) {
        //     $match = new Matches;
        //     $match->id =
        //     $match->player1_id = Auth::user()->id;
        // }

        return view('dashboard');
    }
}
