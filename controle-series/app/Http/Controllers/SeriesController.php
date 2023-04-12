<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = [
            'Punisher',
            'Lost',
            'Grey\'s Anatomy'
        ];

        return view('series.index')->with('series', $series);

        //return view('listar-series', compact('series'));

        /* return view('listar-series', [
            'series' => $series
        ]); */
    }

    public function create()
    {
        return view('series.create');
    }
}
