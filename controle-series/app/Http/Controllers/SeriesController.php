<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Serie;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        //$series = Serie::all();
        $series = Serie::query()->orderBy('nome')->get();
        //$mensagemSucesso = $request->session()->get('mensagem.sucesso');
        $mensagemSucesso = session('mensagem.sucesso');

        //$series = DB::select('SELECT nome FROM series;');
        /* $series = [
            'Punisher',
            'Lost',
            'Grey\'s Anatomy'
        ]; */

        return view('series.index')->with('series', $series)->with('mensagemSucesso', $mensagemSucesso);

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

        $serie = Serie::create($request->all());
        //session(['mensagem.sucesso' => 'Série adicionada com sucesso']);
        //$request->session()->flash('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso");
        
        //DB::insert('INSERT INTO series (nome) values (?)', [$nomeSerie]);
        //return redirect('/series');
        return redirect()->route('series.index')
                ->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso");
        //return to_route('series.index');
    }

    public function destroy(Serie $series)
    {
        $series->delete();
        //$series = Serie::find($request->series);
        //Serie::destroy($request->series);

        //$request->session()->flash();
        return redirect()->route('series.index')
                ->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso");
    }
}
