<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomRequests extends Controller
{
    public function getEstrenos()
    {
        $count = DB::table('peliculas')->select('*')->orderBy('fechadelanzamiento', 'desc')->paginate(3);
        $info = ["count" => $count->total(), "pages" => $count->lastPage(), "next" => $count->nextPageUrl(), "prev" => $count->previousPageUrl()];
        $results = $count->items();
        $paginador = ["info" => $info, "results" => $results];
        return json_encode($paginador);
    }
    public function getPromedioCriticas()
    {
        $count = DB::table('peliculas')
            ->join('criticas', 'peliculas.peliculasid', '=', 'criticas.peliculasid')
            ->join('clasificacion', 'peliculas.claid', '=', 'clasificacion.claid')
            ->selectRaw('avg(crivalor) as promedio,peliculas.peliculasid ,peliculas.nombre,peliculas.sinopsis,peliculas.fechadelanzamiento
,peliculas.duracion, peliculas.portada, clasificacion.clanombre')
            //->whereRaw('criticas.peliculasid = peliculas.peliculasid')
            ->groupByRaw('peliculas.peliculasid, clasificacion.clanombre ')
            ->orderByRaw('promedio desc')
            ->paginate(3);

        $info = ["count" => $count->total(), "pages" => $count->lastPage(), "next" => $count->nextPageUrl(), "prev" => $count->previousPageUrl()];
        $results = $count->items();
        $paginador = ["info" => $info, "results" => $results];
        return json_encode($paginador);
    }
    public function getAnimesporEstreno()
    {
        $count = DB::table('peliculas')
            ->join('tiene', 'peliculas.peliculasid', '=', 'tiene.peliculasid')
            ->selectRaw('peliculas.nombre, peliculas.fechadelanzamiento,peliculas.duracion,peliculas.sinopsis,peliculas.portada')
            ->whereRaw('tiene.genid = 2')
            ->orderByRaw('fechadelanzamiento desc')
            ->paginate(3);
        $info = ["count" => $count->total(), "pages" => $count->lastPage(), "next" => $count->nextPageUrl(), "prev" => $count->previousPageUrl()];
        $results = $count->items();
        $paginador = ["info" => $info, "results" => $results];
        return json_encode($paginador);
    }
    public function getCriticasPelicula($id)
    {
        $count = DB::table('criticas')
            ->join('users', 'criticas.id', '=', 'users.id')
            ->select('criticas.crifecha', 'users.email', 'criticas.critexto', 'criticas.crivalor', 'criticas.criid')
            ->where('criticas.peliculasid', '=', $id)
            ->orderByRaw('criticas.crifecha desc')
            ->paginate(3);

        $info = ["count" => $count->total(), "pages" => $count->lastPage(), "next" => $count->nextPageUrl(), "prev" => $count->previousPageUrl()];
        $results = $count->items();
        $paginador = ["info" => $info, "results" => $results];

        return json_encode($paginador);
    }
    public function getNoticiasFecha()
    {
        $count = DB::table('noticias')->select('*')->orderBy('notfecha', 'desc')->paginate(3);
        $info = ["count" => $count->total(), "pages" => $count->lastPage(), "next" => $count->nextPageUrl(), "prev" => $count->previousPageUrl()];
        $results = $count->items();
        $paginador = ["info" => $info, "results" => $results];
        return json_encode($paginador);
    }
}
