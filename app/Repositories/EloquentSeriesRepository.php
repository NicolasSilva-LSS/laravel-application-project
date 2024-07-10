<?php 

namespace App\Repositories;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Support\Facades\DB;

class EloquentSeriesRepository implements SeriesRepository
{
    public function add(SeriesFormRequest $request): Series
    {
        return DB::transaction(function() use ($request){
            ///$nomeSerie = $request->input('nome');
            //$nomeSerie = $request->input()->nome;
            //$serie = new Serie();
            //$serie->nome = $nomeSerie;
            //$serie->save();
    
            /*ao invés de utilizar if ($request->nome === null) para validar o nome da série como válida, utilize:
            $request->validate([
                'nome' => ['required', 'min:5']
            ]);*/
    
            $serie = Series::create($request->all());
            $seasons = [];
            for($i = 1; $i <= $request->seasonsQty; $i++)
            {
                $seasons [] = [
                    'series_id' => $serie->id,
                    'number' => $i,
                ];
            }
    
            Season::insert($seasons);
    
            $episodes = [];
            foreach ($serie->seasons as $season)
            {
                for($j = 1; $j <= $request->episodesPerSeason; $j++)
                {
                    $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $j,
                    ];
                };
            }
    
            Episode::insert($episodes);
    
            return $serie;
            }, 5);
    }
}