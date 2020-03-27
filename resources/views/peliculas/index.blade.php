@extends('layouts.app')

@section('content')
    <script>
            function confirmarRegistro(id){
            if (window.confirm("Desea eliminar el registro?") == true){
                    window.location=`peliculas/${id}/destroy`;
                    
            }
            else{
                    window.location ="/peliculas";
            }
        }
    </script> 
    <div class="col">
        <h1>Peliculas</h1>
    </div>
    <div class="row">
        <div class="col">
            <a class="btn btn-primary" href="/peliculas/create">Crear una Pelicula</a>
        </div>
    </div>
        <div class="row">
            <div class="col">
                <table class="table">
                    @foreach ($peliculas as $pelicula)
                        <tr>
                            <td>{{$pelicula->id}}</td>
                            <td>{{$pelicula->nombre}}</td>
                            <td>{{$pelicula->fechadelanzamiento}}</td>
                            <td>{{$pelicula->duracion}}</td>
                            <td>{{$pelicula->clasificacion}}</td>
                            <td>{{$pelicula->sinopsis}}</td>
                            <td>{{$pelicula->trailer}}</td>
                            <td>{{$pelicula->paisdeorigen}}</td>
                            <td><a href="/peliculas/{{$pelicula->id}}/edit" class="btn btn-secondary">Editar</a></td>
                            <td><a type="button" class="btn btn-secondary" onclick="confirmarRegistro({{$pelicula->id}})">Eliminar</a></td>
                           
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        
    
@endsection