<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index()
    {
        $series = DB::select('SELECT nome FROM series;');
        /* $series = [
            'Punisher',
            'Lost',
            'Grey\'s Anatomy'
        ]; */

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

    public function store(Request $request)
    {
        $nomeSerie = $request->input('nome');
        
        if (DB::insert('INSERT INTO series (nome) values (?)', [$nomeSerie])) {
            return "OK";
        } else {
            return "Deu erro";
        }

    }
}
