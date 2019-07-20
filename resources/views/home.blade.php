@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Buscar estudiantes</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="GET" action="{{ route('afiliados.search') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="busqueda" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de búsqueda') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" id="busqueda" name="campo">
                                        <option value="afiliacion">Número de Seguro Social</option>
                                        <option value="nombre">Nombre</option>
                                        <option value="mvto">Mvto</option>
                                        <option value="fec_mvto">Fecha de mvto</option>
                                        <option value="curp">CURP</option>
                                        <option value="matricula">Matrícula</option>
                                        <option value="semestre">Semestre</option>
                                        <option value="num_p">Número de plantel</option>
                                        <option value="nom_p">Nombre del plantel</option>
                                        <option value="umf">UMF</option>
                                    </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="val" class="col-md-4 col-form-label text-md-right">{{ __('Valor') }}</label>
                            <div class="col-md-6">
                                <input id="val" type="text" class="form-control" name="valor" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Buscar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
