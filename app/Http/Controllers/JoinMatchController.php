<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matches;
use Illuminate\Support\Facades\Auth;


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
        $clientID = Auth::user()->id;
        $match = Matches::where('player2_id', null)->take(1)->first();

        if ($match) {
            $match->player2_id = $clientID;
            $match->save();
            return view('join_match.ongoing_match');
        } else {
            $match = new Matches;
            $match->player1_id = $clientID;
            $match->save();
            return view('join_match.waiting');
        }

    }
}
