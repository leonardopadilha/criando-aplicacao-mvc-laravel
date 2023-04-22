<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Serie;

class SeriesController extends Controller
{
    public function index()
    {
        //$series = Serie::all();
        $series = Serie::query()->orderBy('nome')->get();

        //$series = DB::select('SELECT nome FROM series;');
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
      /*   $nomeSerie = $request->input('nome');
        
        $serie = new Serie();
        $serie->nome = $nomeSerie;
        $serie->save(); */

        Serie::create($request->all());
        
        //DB::insert('INSERT INTO series (nome) values (?)', [$nomeSerie]);
        //return redirect('/series');
        return redirect()->route('series.index');
        //return to_route('series.index');
    }

    public function destroy(Request $request)
    {
        Serie::destroy($request->series);
        return redirect()->route('series.index');
    }
}
