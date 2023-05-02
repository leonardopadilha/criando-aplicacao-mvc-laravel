<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
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

    public function store(SeriesFormRequest $request)
    {
        /* $request->validate([
            'nome' => ['required', 'min:3']
        ]); */
      /*   $nomeSerie = $request->input('nome');
        
        $serie = new Serie();
        $serie->nome = $nomeSerie;
        $serie->save(); */

        //$serie = Serie::create($request->all());
        //session(['mensagem.sucesso' => 'Série adicionada com sucesso']);
        //$request->session()->flash('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso");
        
        //DB::insert('INSERT INTO series (nome) values (?)', [$nomeSerie]);
        //return redirect('/series');

        $serie = Serie::create($request->all());
        for ($i = 1; $i <= $request->seasonsQty; $i++) {
            $season = $serie->season()->create([
                'number' => $i,
            ]);

            for ($j = 1; $j <= $request->episodesPerSeason; $j++) {
                $season->episodes()->create([
                    'number' => $j
                ]);
            }
        }

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

    public function edit(Serie $series)
    {
        return view('series.edit')->with('serie', $series);
    }

    public function update(Serie $series, SeriesFormRequest $request)
    {
        //$series->nome = $request->nome;
        $series->fill($request->all());
        $series->save();

        return redirect()->route('series.index')
                ->with('mensagem.sucesso', "Série '{$series->nome}' atualizada com sucesso");
    }
}
