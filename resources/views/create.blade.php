@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registrar estudiante</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('afiliados.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="tabla" class="col-md-4 col-form-label text-md-right">{{ __('Tabla') }}</label>
                            <div class="col-md-6">
                                <input id="tabla" type="text" class="form-control" name="tabla" value="5" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nss" class="col-md-4 col-form-label text-md-right">{{ __('Número de Seguro Social*') }}</label>
                            <div class="col-md-6">
                                <input id="nss" type="text" class="form-control" name="afiliacion" value="0" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre*') }}</label>
                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="NULL" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mvto" class="col-md-4 col-form-label text-md-right">{{ __('Mvto*') }}</label>
                            <div class="col-md-6">
                                <input id="mvto" type="number" class="form-control" name="mvto" value="0" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fec-mvto" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de mvto*') }}</label>
                            <div class="col-md-6">
                                <input id="fec-mvto" type="date" class="form-control" name="fec_mvto" value="NULL" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="curp" class="col-md-4 col-form-label text-md-right">{{ __('CURP*') }}</label>
                            <div class="col-md-6">
                                <input id="curp" type="text" class="form-control" name="curp" value="NULL" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="matricula" class="col-md-4 col-form-label text-md-right">{{ __('Matrícula*') }}</label>
                            <div class="col-md-6">
                                <input id="matricula" type="text" class="form-control" name="matricula" value="0" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sem" class="col-md-4 col-form-label text-md-right">{{ __('Semestre*') }}</label>
                            <div class="col-md-6">
                                <input id="sem" type="number" class="form-control" name="semestre" value="0" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nump" class="col-md-4 col-form-label text-md-right">{{ __('Número del plantel*') }}</label>
                            <div class="col-md-6">
                                <input id="nump" type="number" class="form-control" name="num_p" value="0" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nomp" class="col-md-4 col-form-label text-md-right">{{ __('Nombre del plantel*') }}</label>
                            <div class="col-md-6">
                                <input id="nomp" type="text" class="form-control" name="nom_p" value="NULL" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="umf" class="col-md-4 col-form-label text-md-right">{{ __('UMF*') }}</label>
                            <div class="col-md-6">
                                <input id="umf" type="number" class="form-control" name="umf" value="0" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <label class="float-right" >
                                        <i>{{ __('* Campos obligatorios') }}</i>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
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