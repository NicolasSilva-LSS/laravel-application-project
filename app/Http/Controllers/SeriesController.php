<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Autenticador;
use App\Http\Requests\SeriesFormRequest;
//use App\Models\Episode;
//use App\Models\Season;
use App\Models\Series;
use App\Repositories\EloquentSeriesRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository)
    {
        $this->middleware(Autenticador::class)->except('index');
    }

    public function index(Request $request)
    {
        //Auth::check(); faria a verificação se há user logado retornando um valor bool
        //$series = DB::select('SELECT nome  FROM series;');
        $series = Series::all(); //query()->orderBy('nome')->get() após os :: faz a odernação das séries em ordem alfabética, se não utilizar um scopo na model
        $mensagemSucesso = session('mensagem.sucesso');
        //$mensagemSucesso = $request->session()->get('mensagem.sucesso'); usando apenas o session já da para buscar informações
        //$request->session()->forget('mensagem.sucesso'); não precisa do forget para sessions usando flash

        return view('series.index')->with('series', $series) //return view('series/index', ['series'=>$series]);
            ->with('mensagemSucesso', $mensagemSucesso);

        // dd() é uma boa opção para estudo do código
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        $serie = $this->repository->add($request);

        //session(['mensagem.sucesso' => 'serie adicionada com sucesso']); da certo, mas a mensagem fica lá sem ser apagada
        //$request->session()->flash('mensagem.sucesso', "serie '{$serie->nome}' adicionada com sucesso");

        //DB::insert('INSERT INTO series (nome) VALUES (?)', [$nomeSerie]);
        //return redirect('/series');
        //return redirect()->route('series.index');
        return to_route('series.index')->with('mensagem.sucesso', "serie '{$serie->nome}' adicionada com sucesso");
        
    }

    public function destroy(Series $series, Request $request)
    {
        $series->delete(); //Serie::destroy($series->id);
        //$request->session()->flash('mensagem.sucesso', "serie '{$series->nome}' removida com sucesso");

        return to_route('series.index')->with('mensagem.sucesso', "serie '{$series->nome}' removida com sucesso");
    }

    /*
    public function destroy(Request $request)
    {
        $serie = Serie::find($request->series); //SELECT * FROM series WHERE id = $request->series
        Serie::destroy($request->series); //DELETE FROM serie WHERE id = $request->series
        $request->session()->flash('mensagem.sucesso', "serie '{$serie->nome}' removida com sucesso"); //ao invés de put, use flash para msgs temporarias

        return to_route('series.index');
    }
    */

    public function edit(Series $series)
    {
        //dd($series->temporadas());
        return view('series.edit')->with('serie', $series);
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')->with('mensagem.sucesso', "serie '{$series->nome}' atualizada com sucesso");
    }
}
