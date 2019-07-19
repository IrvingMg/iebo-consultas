@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span>Estudiantes</span>
                    <a class="btn btn-primary float-right" href="{{ route('afiliados.create') }}" role="button">
                        Registrar estudiante
                    </a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="alert alert-primary" role="alert">
                        <strong>{{$total}}</strong> resultados para la búsqueda de <strong>{{$valor}}</strong> por
                        <strong>{{$campo}}</strong>.  
                    </div>
                    <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">Tabla</th>
                                <th scope="col">Número de Seguro Social</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Mvto</th>
                                <th scope="col">Fecha de mvto</th>
                                <th scope="col">CURP</th>
                                <th scope="col">Matrícula</th>
                                <th scope="col">Semestre</th>
                                <th scope="col">Número del plantel</th>
                                <th scope="col">Nombre del plantel</th>
                                <th scope="col">UMF</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($afiliados as $afiliado)
                            <tr>
                                <td> {{$afiliado->tabla}} </td>
                                <td> {{$afiliado->afiliacion}} </td>
                                <td> {{$afiliado->nombre}} </td>
                                <td> {{$afiliado->mvto}} </td>
                                <td> {{$afiliado->fec_mvto}} </td>
                                <td> {{$afiliado->curp}} </td>
                                <td> {{$afiliado->matricula}} </td>
                                <td> {{$afiliado->semestre}} </td>
                                <td> {{$afiliado->num_p}} </td>
                                <td> {{$afiliado->nom_p}} </td>
                                <td> {{$afiliado->umf}} </td>
                                <td> 
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-warning">Editar</a>
                                        <a href="#" class="btn btn-danger">Eliminar</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
