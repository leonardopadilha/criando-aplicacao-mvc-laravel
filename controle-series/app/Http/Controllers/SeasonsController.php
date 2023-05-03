<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;
use App\Models\Season;

class SeasonsController extends Controller
{
    public function index(Serie $series) 
    {
        $seasons = Season::query()
                    ->with('episodes')
                    ->where('series_id', $series)
                    ->get();

        return view('seasons.index')->with('seasons', $seasons);
    }
}
