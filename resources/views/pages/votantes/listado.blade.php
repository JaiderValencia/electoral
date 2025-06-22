@extends('layouts.bootstrap')

@section('titulo', 'votantes')

@section('contenido')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Votantes</strong>

                <!-- Modal para registrar -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCrear">
                    Agregar votante
                    <i class="bi bi-person-add"></i>
                </button>

                <div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="modalCrearLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCrearLabel">Agregar votante</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('votantes.agregar') }}" method="post" class="form-horizontal"
                                    id="formulario-agregar">
                                    @csrf
                                    <div class="row form-group">
                                        <div class="col col-md-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                <input type="text" id="input1-group1" name="cedula" placeholder="Cédula"
                                                    class="@error('cedula') is-invalid @enderror form-control">
                                            </div>
                                            @if ($errors->any('cedula'))
                                                <span class="text-danger mt-2">{{$errors->first('cedula')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                <input type="text" id="input1-group1" name="nombre"
                                                    placeholder="Nombre completo" class="@error('nombre') is-invalid @enderror form-control">
                                            </div>
                                            @if ($errors->any('nombre'))
                                                <span class="text-danger mt-2">{{$errors->first('nombre')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                <input type="number" id="input1-group1" name="telefono"
                                                    placeholder="Telefono" class="@error('telefono') is-invalid @enderror form-control">
                                            </div>
                                            @if ($errors->any('telefono'))
                                                <span class="text-danger mt-2">{{$errors->first('telefono')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                <select name="municipio" id="municipio" class="@error('municipio') is-invalid @enderror form-control">
                                                    <option selected disabled>Municipio</option>
                                                    @foreach ($municipios as $municipio)
                                                        <option value="{{ $municipio->id }}">{{ $municipio->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if ($errors->any('municipio'))
                                                <span class="text-danger mt-2">{{$errors->first('municipio')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                <select name="corregimiento" id="corregimiento" class="@error('corregimiento') is-invalid @enderror form-control">
                                                    <option selected disabled>Corregimiento</option>
                                                </select>
                                            </div>
                                            @if ($errors->any('corregimiento'))
                                                <span class="text-danger mt-2">{{$errors->first('corregimiento')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                <select name="barrio" id="barrio" class="@error('barrio') is-invalid @enderror form-control">
                                                    <option selected disabled>Barrio</option>
                                                </select>
                                            </div>
                                            @if ($errors->any('barrio'))
                                                <span class="text-danger mt-2">{{$errors->first('barrio')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                <select name="puesto" id="puesto" class="@error('puesto') is-invalid @enderror form-control">
                                                    <option selected disabled>Puesto de votación</option>
                                                </select>
                                            </div>
                                            @if ($errors->any('puesto'))
                                                <span class="text-danger mt-2">{{$errors->first('puesto')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                <select name="mesa" id="mesa" class="@error('mesa') is-invalid @enderror form-control">
                                                    <option selected disabled>Mesa de votación</option>
                                                </select>
                                            </div>
                                            @if ($errors->any('mesa'))
                                                <span class="text-danger mt-2">{{$errors->first('mesa')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                <select name="compromiso" id="select" class="@error('compromiso') is-invalid @enderror form-control">
                                                    <option selected disabled>Compromiso</option>
                                                    @foreach ($compromisos as $compromiso)
                                                        <option value="{{ $compromiso->id }}">{{ $compromiso->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if ($errors->any('compromiso'))
                                                <span class="text-danger mt-2">{{$errors->first('compromiso')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-12">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                <input type="text" id="input1-group1" name="recomendacion"
                                                    placeholder="A quién recomienda" class="@error('recomendacion') is-invalid @enderror form-control">
                                            </div>
                                            @if ($errors->any('recomendacion'))
                                                <span class="text-danger mt-2">{{$errors->first('recomendacion')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary" form="formulario-agregar">Agregar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fin modal para registrar -->
            </div>
            <div class="card-body">
                <div class="overflow-x-scroll">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Cedula</th>
                                <th>Nombre</th>
                                <th>Telefono</th>
                                <th class="text-center">Municipio</th>
                                <th class="text-center">Corregimiento</th>
                                <th class="text-center">Barrio</th>
                                <th class="text-center">Puesto</th>
                                <th class="text-center">Mesa</th>
                                <th class="text-center">Compromiso</th>
                                <th class="text-center">Recomendacion</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($votantes as $votante)
                                <tr>
                                    <td class="text-nowrap text-center">{{ $votante->cedula }}</td>
                                    <td class="text-nowrap text-center">{{ $votante->nombre }}</td>
                                    <td class="text-nowrap text-center">{{ $votante->telefono }}</td>
                                    <td class="text-nowrap text-center">
                                        {{ $votante->barrio->corregimiento->municipio->nombre }}
                                    </td>
                                    <td class="text-nowrap text-center">{{ $votante->barrio->corregimiento->nombre }}
                                    </td>
                                    <td class="text-nowrap text-center">{{ $votante->barrio->nombre }}</td>
                                    <td class="text-nowrap text-center">{{ $votante->mesa->puesto->nombre }}</td>
                                    <td class="text-nowrap text-center">{{ $votante->mesa->descripcion }}</td>
                                    <td class="text-nowrap text-center">{{ $votante->compromiso->nombre}}</td>
                                    <td class="text-nowrap text-center">{{ $votante->recomendacion}}</td>
                                    <td class="d-flex flex-row acciones-container">
                                        <button type="button" class="btn btn-warning text-white" data-toggle="modal"
                                            data-target="#modalEditar-{{$votante->id}}">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>

                                        <div class="modal fade" id="modalEditar-{{$votante->id}}" tabindex="-1" role="dialog"
                                            aria-labelledby="modalEditar-{{$votante->id}}Label" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalEditar-{{$votante->id}}Label">Editar al
                                                            votante {{$votante->nombre}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('votantes.editar', $votante->id) }}"
                                                            method="post" class="form-horizontal" id="formulario-editar">
                                                            @csrf
                                                            <div class="row form-group">
                                                                <div class="col col-md-12">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i
                                                                                class="fa fa-user"></i></div>
                                                                        <input type="text" id="input1-group1" name="cedula"
                                                                            placeholder="Cédula" class="form-control"
                                                                            value="{{$votante->cedula}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col col-md-12">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i
                                                                                class="fa fa-user"></i></div>
                                                                        <input type="text" id="input1-group1" name="nombre"
                                                                            placeholder="Nombre completo" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col col-md-12">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i
                                                                                class="fa fa-user"></i></div>
                                                                        <input type="number" id="input1-group1" name="telefono"
                                                                            placeholder="Telefono" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col col-md-12">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i
                                                                                class="fa fa-user"></i></div>
                                                                        <select name="municipio" id="municipio"
                                                                            class="form-control">
                                                                            <option selected disabled>Municipio</option>
                                                                            @foreach ($municipios as $municipio)
                                                                                <option value="{{ $municipio->id }}">
                                                                                    {{ $municipio->nombre }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col col-md-12">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i
                                                                                class="fa fa-user"></i></div>
                                                                        <select name="corregimiento" id="corregimiento"
                                                                            class="form-control">
                                                                            <option selected disabled>Corregimiento</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col col-md-12">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i
                                                                                class="fa fa-user"></i></div>
                                                                        <select name="barrio" id="barrio" class="form-control">
                                                                            <option selected disabled>Barrio</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col col-md-12">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i
                                                                                class="fa fa-user"></i></div>
                                                                        <select name="puesto" id="puesto" class="form-control">
                                                                            <option selected disabled>Puesto de votación
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col col-md-12">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i
                                                                                class="fa fa-user"></i></div>
                                                                        <select name="mesa" id="mesa" class="form-control">
                                                                            <option selected disabled>Mesa de votación</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col col-md-12">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i
                                                                                class="fa fa-user"></i></div>
                                                                        <select name="compromiso" id="select"
                                                                            class="form-control">
                                                                            <option selected disabled>Compromiso</option>
                                                                            @foreach ($compromisos as $compromiso)
                                                                                <option value="{{ $compromiso->id }}">
                                                                                    {{ $compromiso->nombre }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col col-md-12">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i
                                                                                class="fa fa-user"></i></div>
                                                                        <input type="text" id="input1-group1"
                                                                            name="recomendacion"
                                                                            placeholder="A quién recomienda"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-primary"
                                                            form="formulario-editar">Editar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#modalEliminar-{{$votante->id}}">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>

                                        <div class="modal fade" id="modalEliminar-{{$votante->id}}" tabindex="-1" role="dialog"
                                            aria-labelledby="modalEliminar-{{$votante->id}}Title" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalEliminar-{{$votante->id}}Title">
                                                            Borrar un votante
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span class="font-weight-bold">¿Estás seguro de que quieres borrar
                                                            al votante {{$votante->nombre}}?</span>
                                                        <form action="{{ route('votantes.borrar', $votante->id) }}"
                                                            method="post" id="formulario-borrar">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cerrar</button>
                                                        <button type="submit" form="formulario-borrar"
                                                            class="btn btn-danger">Borrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-2">
                    Mostrando {{ $votantes->count() }} votantes de {{ $votantes->total() }} guardados
                    {{ $votantes->onEachSide(5)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite('resources/js/votantes/correlacion.js')
@endsection