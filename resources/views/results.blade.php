@extends('layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/crud_ajax.js') }}"></script>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span>Estudiantes</span>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="alert alert-success alert-dismissible collapse" role="alert" id="alerta-exito">
                        <h4 class="alert-heading">Éxito</h4>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-primary" role="alert">
                        <h4 class="alert-heading">Resultados de la búsqueda</h4>
                        <p>
                            Se encontraron <strong>{{ $afiliados->total() }}</strong> resultados para la búsqueda de tipo 
                            <strong>{{$campo}}</strong> y valor <strong>{{$valor}}</strong>.  
                        </p>
                    </div>
                    <p>
                        <button type="button" class="btn btn-outline-secondary" title="Seleccionar todos" id="btn-checkAll">
                                <i class="fas fa-user-check"></i>
                        </button>

                        <button class="btn btn-outline-secondary" type="button" id="descargar">
                                Descargar seleccionados
                        </button>
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#regModal" title="Registrar">
                                <i class="fas fa-user-plus"></i>
                                Registrar
                        </button>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">
                                        ID
                                    </th>
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
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="estudiante-{{$afiliado->id}}" value="{{$afiliado->id}}" name="afiliadosId[]">
                                            <label class="custom-control-label" for="estudiante-{{$afiliado->id}}">{{$afiliado->id}}</label>
                                        </div>
                                    </td>
                                    <td> {{$afiliado->tabla}} </td>
                                    <td> {{$afiliado->afiliacion}} </td>
                                    <td> {{$afiliado->nombre}} </td>
                                    <td> {{$afiliado->mvto}} </td>
                                    @php   
                                        $date = $afiliado->fec_mvto;
                                        if (!strpos($date, "-")) {
                                            // Genera el formato de fecha 'yyyy-mm-dd'
                                            $dateParts = array_pad(explode('/', $date), 3, null);
                                            $date = $dateParts[2]."-".$dateParts[0]."-".$dateParts[1];
                                        }
                                    @endphp 
                                    <td> {{$date}} </td>
                                    <td> {{$afiliado->curp}} </td>
                                    <td> {{$afiliado->matricula}} </td>
                                    <td> {{$afiliado->semestre}} </td>
                                    <td> {{$afiliado->num_p}} </td>
                                    <td> {{$afiliado->nom_p}} </td>
                                    <td> {{$afiliado->umf}} </td>
                                    <td> 
                                        <!-- Button trigger modal -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal-{{$afiliado->id}}" title="Editar">
                                                <i class="fas fa-user-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#destroyModal-{{$afiliado->id}}" title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                        <!-- Modal Editar -->
                                        <div class="modal fade" id="editModal-{{$afiliado->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog mw-100 w-50" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('afiliados.update', $afiliado->id) }}" id="form-{{$afiliado->id}}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group row">
                                                                <label for="tabla" class="col-md-4 col-form-label text-md-right">{{ __('Tabla') }}</label>
                                                                <div class="col-md-6">
                                                                    <input id="tabla" type="text" class="form-control" name="tabla" value="{{$afiliado->tabla}}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="nss" class="col-md-4 col-form-label text-md-right">{{ __('Número de Seguro Social*') }}</label>
                                                                <div class="col-md-6">
                                                                    <input id="nss" type="text" class="form-control" name="afiliacion" value="{{$afiliado->afiliacion}}" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre*') }}</label>
                                                                <div class="col-md-6">
                                                                    <input id="nombre" type="text" class="form-control" name="nombre" value="{{$afiliado->nombre}}" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="mvto" class="col-md-4 col-form-label text-md-right">{{ __('Mvto*') }}</label>
                                                                <div class="col-md-6">
                                                                    <input id="mvto" type="number" class="form-control" name="mvto" value="{{$afiliado->mvto}}" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="fec-mvto" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de mvto*') }}</label>
                                                                <div class="col-md-6">
                                                                    <input id="fec-mvto" type="date" class="form-control" name="fec_mvto" value="{{$date}}" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="curp" class="col-md-4 col-form-label text-md-right">{{ __('CURP*') }}</label>
                                                                <div class="col-md-6">
                                                                    <input id="curp" type="text" class="form-control" name="curp" value="{{$afiliado->curp}}" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="matricula" class="col-md-4 col-form-label text-md-right">{{ __('Matrícula*') }}</label>
                                                                <div class="col-md-6">
                                                                    <input id="matricula" type="text" class="form-control" name="matricula" value="{{$afiliado->matricula}}" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="sem" class="col-md-4 col-form-label text-md-right">{{ __('Semestre*') }}</label>
                                                                <div class="col-md-6">
                                                                    <input id="sem" type="number" class="form-control" name="semestre" value="{{$afiliado->semestre}}" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="nump" class="col-md-4 col-form-label text-md-right">{{ __('Número del plantel*') }}</label>
                                                                <div class="col-md-6">
                                                                    <input id="nump" type="number" class="form-control" name="num_p" value="{{$afiliado->num_p}}" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="nomp" class="col-md-4 col-form-label text-md-right">{{ __('Nombre del plantel*') }}</label>
                                                                <div class="col-md-6">
                                                                    <input id="nomp" type="text" class="form-control" name="nom_p" value="{{$afiliado->nom_p}}" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="umf" class="col-md-4 col-form-label text-md-right">{{ __('UMF*') }}</label>
                                                                <div class="col-md-6">
                                                                    <input id="umf" type="number" class="form-control" name="umf" value="{{$afiliado->umf}}" required>
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
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <button type="submit" class="btn btn-primary btn-editar" value="{{$afiliado->id}}">Editar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Eliminar -->
                                        <div class="modal fade" id="destroyModal-{{$afiliado->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Está seguro de eliminar el registro {{$afiliado->id}}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <button type="button" class="btn btn-primary btn-eliminar" value="{{$afiliado->id}}">Eliminar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $afiliados->appends(request()->except('page'))->links() }}
                    </div>
                    <br>
                    <div class="alert alert-warning" role="alert">
                        <h4 class="alert-heading">Nota</h4>
                        <p>
                            El número de tabla identifica la base de datos de la cual fueron obtenidos los registros.
                            Dichos identificadores se asignaron de la siguiente manera:
                            <ul>
                                <li>1 - Coincidencias CURP.</li>
                                <li>2 - Coincidencias Nombre y Fecha.</li>
                                <li>3 - Coincidencias CURP, Nombre y Fecha.</li>
                                <li>4 - Remanentes CURP, Nombre y Fecha.</li>
                                <li>5 - Registros nuevos.</li>
                            </ul>
                        </p>
                    </div>
                </div>
                <!-- Modal Registrar -->
                <div class="modal fade" id="regModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog mw-100 w-50" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Registrar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('afiliados.store') }}" id="form-reg">
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
                                            <input id="fec-mvto" type="date" class="form-control" name="fec_mvto" value="2019-01-01" required>
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
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary btn-registrar">Registrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
