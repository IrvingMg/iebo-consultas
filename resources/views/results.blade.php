@extends('layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    function download(filename, text) {
        var element = document.createElement('a');
        element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
        element.setAttribute('download', filename);

        element.style.display = 'none';
        document.body.appendChild(element);

        element.click();

        document.body.removeChild(element);
    }

    $(document).ready(function(){
            $("#descargar").click(function(){
            var boxes = document.getElementsByName("afiliadosId[]");
            let afiliadosId = [];
            for (var i=0; i < boxes.length; i++) {
                if (boxes[i].checked) 
                {
                    afiliadosId.push(boxes[i].value);
                }
            }
            
            $.ajax({
                url: "{{ route('afiliados.download') }}",
                type: 'post',
                data: {
                    ids: afiliadosId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function (result) {
                    download(new Date(), result);
                }
            });
        });
    });
    
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span>Estudiantes</span>
                    <button class="btn btn-success float-right" type="button" id="descargar">
                            Descargar seleccionados
                    </button>
                    

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
                        <strong>{{ $afiliados->total() }}</strong> resultados para la búsqueda de <strong>{{$valor}}</strong> por
                        <strong>{{$campo}}</strong>.  
                    </div>
                    <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">ID</th>
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
                                    <!-- Default unchecked -->
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="estudiante-{{$afiliado->id}}" value="{{$afiliado->id}}" name="afiliadosId[]">
                                        <label class="custom-control-label" for="estudiante-{{$afiliado->id}}">{{$afiliado->id}}</label>
                                    </div>
                                </td>
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
                                    <form action="{{ route('afiliados.destroy',$afiliado->id) }}" method="POST">
                                        <div class="btn-group">
                                            <a href="{{ route('afiliados.edit',$afiliado->id) }}" class="btn btn-warning">Editar</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $afiliados->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
