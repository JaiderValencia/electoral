@extends('layouts.bootstrap')

@section('titulo', 'votantes')

@section('contenido')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Votantes</strong>

            <!-- Modal para registrar -->
            <button type="button" id="btn-abrir-crear" class="btn btn-primary" data-toggle="modal"
                data-target="#modalCrear">
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
                                        <div class="input-group" id="cedula-group">
                                            <div class="input-group-addon"><i class="bi bi-hash"></i></div>
                                            @php
                                                $hayErrorCedula = $errors->has('cedula') && session('error_crear');
                                                $valorCedula = session('error_crear') && !$errors->has('cedula') ? old('cedula') : null;
                                            @endphp

                                            <input type="text" maxlength="255" id="cedula" name="cedula"
                                                placeholder="Cédula" value="{{$valorCedula}}"
                                                class="{{$hayErrorCedula ? "is-invalid" : null}} form-control">
                                        </div>
                                        @if ($hayErrorCedula)
                                            <span class="text-danger mt-2">{{$errors->first('cedula')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <div class="input-group" id="nombre-group">
                                            <div class="input-group-addon"><i class="bi bi-alphabet"></i></div>                                            

                                            @php
                                                $hayErrorNombre = $errors->has('nombre') && session('error_crear');
                                                $valorNombre = session('error_crear') && !$errors->has('nombre') ? old('nombre') : null;
                                            @endphp

                                            <input type="text" maxlength="255" id="nombre" name="nombre"
                                                placeholder="Nombre completo" value="{{$valorNombre}}"
                                                class="{{$hayErrorNombre ? "is-invalid" : null}} form-control">
                                        </div>

                                        @if ($hayErrorNombre)
                                            <span class="text-danger mt-2">{{$errors->first('nombre')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <div class="input-group" id="telefono-group">
                                            <div class="input-group-addon"><i class="bi bi-phone"></i></div>

                                            @php
                                                $hayErrorTelefono = $errors->has('telefono') && session('error_crear');
                                                $valorTelefono = session('error_crear') && !$errors->has('telefono') ? old('telefono') : null;
                                            @endphp

                                            <input type="number" id="telefono" name="telefono" placeholder="Telefono"
                                                value="{{$valorTelefono}}"
                                                class="{{$hayErrorTelefono ? "is-invalid" : null}} form-control">
                                        </div>
                                        @if ($hayErrorTelefono)
                                            <span class="text-danger mt-2">{{$errors->first('telefono')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <div class="input-group" id="genero-group">
                                            <div class="input-group-addon"><i class="bi bi-gender-ambiguous"></i></div>

                                            @php
                                                $hayErrorGenero = $errors->has('genero') && session('error_crear');

                                                $idSelected = -1;

                                                if (session('error_crear') && !$errors->has('genero')) {
                                                    $idSelected = old('genero');
                                                }
                                            @endphp

                                            <select name="genero" id="genero"
                                                class="{{$hayErrorGenero ? "is-invalid" : null}} form-control">
                                                <option selected disabled>Genero</option>
                                                @foreach ($generos as $genero)
                                                    <option {{$idSelected == $genero->id ? "selected" : null}}
                                                        value="{{ $genero->id }}">{{ $genero->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($hayErrorGenero)
                                            <span class="text-danger mt-2">{{$errors->first('genero')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <div class="input-group" id="municipio-group">
                                            <div class="input-group-addon"><i class="fa-solid fa-location-dot"></i></div>

                                            @php
                                                $hayErrorMunicipio = $errors->has('municipio') && session('error_crear');

                                                $idSelected = -1;

                                                if (session('error_crear') && !$errors->has('municipio')) {
                                                    $idSelected = old('municipio');
                                                }
                                            @endphp

                                            <select name="municipio" id="municipio"
                                                class="{{$hayErrorMunicipio ? "is-invalid" : null}} form-control">
                                                <option selected disabled>Municipio</option>
                                                @foreach ($municipios as $municipio)
                                                    <option {{$idSelected == $municipio->id ? "selected" : null}}
                                                        value="{{ $municipio->id }}">{{ $municipio->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($hayErrorMunicipio)
                                            <span class="text-danger mt-2">{{$errors->first('municipio')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <div class="input-group" id="corregimiento-group">
                                            <div class="input-group-addon"><i class="fa-solid fa-map-location-dot"></i></div>

                                            @php
                                                $hayErrorCorregimiento = $errors->has('corregimiento') && session('error_crear');
                                            @endphp

                                            <select name="corregimiento" id="corregimiento"
                                                class="{{$hayErrorMunicipio ? "is-invalid" : null}} form-control">
                                                <option selected disabled>Corregimiento</option>
                                            </select>
                                        </div>
                                        @if ($hayErrorCorregimiento)
                                            <span class="text-danger mt-2">{{$errors->first('corregimiento')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <div class="input-group" id="barrio-group">
                                            <div class="input-group-addon"><i class="fa-solid fa-location-arrow"></i></div>

                                            @php
                                                $hayErrorBarrio = $errors->has('barrio') && session('error_crear');
                                            @endphp

                                            <select name="barrio" id="barrio"
                                                class="{{ $hayErrorBarrio ? "is-invalid" : null }} form-control">
                                                <option selected disabled>Barrio</option>
                                            </select>
                                        </div>
                                        @if ($hayErrorBarrio)
                                            <span class="text-danger mt-2">{{$errors->first('barrio')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <div class="input-group" id="puesto-group">
                                            <div class="input-group-addon"><i class="fa-solid fa-building-user"></i></div>
                                            @php
                                                $hayErrorPuesto = $errors->has('puesto') && session('error_crear');
                                            @endphp

                                            <select name="puesto" id="puesto"
                                                class="{{ $hayErrorPuesto ? "is-invalid" : null }} form-control">
                                                <option selected disabled>Puesto de votación</option>
                                            </select>
                                        </div>
                                        @if ($hayErrorPuesto)
                                            <span class="text-danger mt-2">{{$errors->first('puesto')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <div class="input-group" id="mesa-group">
                                            <div class="input-group-addon"><i class="fa-solid fa-person-booth"></i></div>

                                            @php
                                                $hayErrorMesa = $errors->has('mesa') && session('error_crear');
                                            @endphp

                                            <select name="mesa" id="mesa"
                                                class="{{ $hayErrorMesa ? "is-invalid" : null }} form-control">
                                                <option selected disabled>Mesa de votación</option>
                                            </select>
                                        </div>
                                        @if ($hayErrorMesa)
                                            <span class="text-danger mt-2">{{$errors->first('mesa')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <div class="input-group" id="compromiso-group">
                                            <div class="input-group-addon"><i class="bi bi-person-heart"></i></div>

                                            @php
                                                $hayErrorCompromiso = $errors->has('compromiso') && session('error_crear');
                                                $idSelected = -1;

                                                if (session('error_crear') && !$errors->has('compromiso')) {
                                                    $idSelected = old('compromiso');
                                                }
                                            @endphp
                                            
                                            <select name="compromiso" id="compromiso"
                                                class="{{ $hayErrorCompromiso ? "is-invalid" : null }} form-control">
                                                <option selected disabled>Compromiso</option>
                                                @foreach ($compromisos as $compromiso)
                                                    <option {{ $idSelected == $compromiso->id ? "selected" : null }}
                                                        value="{{ $compromiso->id }}">{{ $compromiso->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($hayErrorCompromiso)
                                            <span class="text-danger mt-2">{{$errors->first('compromiso')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <div class="input-group" id="recomendacion-group">
                                            <div class="input-group-addon"><i class="fa fa-user"></i></div>

                                            @php
                                                $hayErrorRecomendacion = $errors->has('recomendacion') && session('error_crear');
                                                $valorRecomendacion = session('error_crear') && !$errors->has('recomendacion') ? old('recomendacion') : null;
                                            @endphp

                                            <input type="text" value="{{$valorRecomendacion}}" maxlength="255"
                                                id="recomendacion" name="recomendacion" placeholder="A quién recomienda"
                                                class="{{ $hayErrorRecomendacion ? "is-invalid" : null }} form-control">
                                        </div>
                                        @if ($hayErrorRecomendacion)
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

            <div class="row mb-3 mt-3">
                <div class="col">
                    <input type="text" id="buscador" class="form-control" placeholder="Buscar...">
                </div>
            </div>
            <div class="card-body">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                                <th class="text-center">Cedula</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Telefono</th>                                
                                <th class="text-center">Compromiso</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($votantes as $votante)
                            <tr>
                                <td class="text-nowrap text-center">{{ $votante->cedula }}</td>
                                <td class="text-nowrap text-center">{{ $votante->nombre }}</td>
                                <td class="text-nowrap text-center">{{ $votante->telefono }}</td>                 
                                <td class="text-nowrap text-center">{{ $votante->compromiso->nombre}}</td>
                                <td class="d-flex flex-row justify-content-center acciones-container">

                                    <button type="button" id="btn-modal-editar-{{$votante->id}}"
                                        class="btn btn-warning text-white btn-modal-editar" data-toggle="modal"
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
                                                        method="post" class="form-horizontal"
                                                        id="formulario-editar-{{$votante->id}}">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="row form-group">
                                                            <div class="col col-md-12">
                                                                <div class="input-group" id="cedula-group-{{$votante->id}}">
                                                                    <div class="input-group-addon"><i class="bi bi-hash"></i></div>

                                                                    @php
                                                                        $hayErrorCedula = $errors->has('cedula') && (session('edit_error_id') == $votante->id);
                                                                    @endphp                                                                

                                                                    <input type="text" maxlength="255" id="cedula-{{$votante->id}}"
                                                                        name="cedula" placeholder="Cédula"
                                                                        value="{{$hayErrorCedula ? $votante->cedula : old('cedula',$votante->cedula)}}"
                                                                        class="{{$hayErrorCedula ? "is-invalid" : null}} form-control cedula-editar">
                                                                </div>   
                                                                                                                        
                                                                @if ($hayErrorCedula)
                                                                    <span
                                                                        class="text-danger mt-2">{{$errors->first('cedula')}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col col-md-12">
                                                                <div class="input-group" id="nombre-group-{{$votante->id}}">
                                                                    <div class="input-group-addon"><i class="bi bi-alphabet"></i></div>

                                                                    @php
                                                                        $hayErrorNombre = $errors->has('nombre') && (session('edit_error_id') == $votante->id);
                                                                    @endphp

                                                                    <input type="text" maxlength="255" id="nombre-{{$votante->id}}"
                                                                        name="nombre" placeholder="Nombre completo"
                                                                        value="{{$hayErrorNombre ? old('nombre') : $votante->nombre}}"
                                                                        class="{{$hayErrorNombre ? "is-invalid" : null}} form-control nombre-editar">
                                                                </div>
                                                                @if ($hayErrorNombre)
                                                                    <span
                                                                        class="text-danger mt-2">{{$errors->first('nombre')}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col col-md-12">
                                                                <div class="input-group" id="telefono-group-{{$votante->id}}">
                                                                    <div class="input-group-addon"><i class="bi bi-phone"></i></div>

                                                                    @php
                                                                        $hayErrorTelefono = $errors->has('telefono') && (session('edit_error_id') == $votante->id);
                                                                    @endphp

                                                                    <input type="number" id="telefono-{{$votante->id}}" name="telefono"
                                                                        placeholder="Telefono"
                                                                        value="{{$hayErrorTelefono ? old('telefono') : $votante->telefono}}"
                                                                        class="{{$hayErrorTelefono ? "is-invalid" : null}} form-control telefono-editar">
                                                                </div>
                                                                @if ($hayErrorTelefono)
                                                                    <span
                                                                        class="text-danger mt-2">{{$errors->first('telefono')}}</span>
                                                                @endif
                                                            </div>
                                                        </div>                                                

                                                        <div class="row form-group">
                                                            <div class="col col-md-12">
                                                                <div class="input-group" id="genero-group-{{$votante->id}}">
                                                                    <div class="input-group-addon"><i class="bi bi-gender-ambiguous"></i></div>

                                                                    @php
                                                                        $hayErrorGenero = $errors->has('genero') && (session('edit_error_id') == $votante->id);

                                                                        $idSelected = -1;

                                                                        if ($hayErrorGenero) {
                                                                            $idSelected = $votante->genero->id;
                                                                        }else{
                                                                            $idSelected = old('genero',$votante->genero->id);
                                                                        }                                                                    
                                                                    @endphp

                                                                    <select name="genero" id="genero-{{$votante->id}}"                                                                        
                                                                        class="{{$hayErrorGenero ? "is-invalid" : null}} form-control genero-editar">
                                                                        <option selected disabled>Género</option>
                                                                        @foreach ($generos as $genero)
                                                                            <option                                                           
                                                                                {{$idSelected == $genero->id ? "selected" : null}}
                                                                                value="{{ $genero->id }}">
                                                                                {{ $genero->nombre }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @if ($hayErrorGenero)
                                                                    <span
                                                                        class="text-danger mt-2">{{$errors->first('genero')}}</span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="row form-group">
                                                            <div class="col col-md-12">
                                                                <div class="input-group" id="municipio-group-{{$votante->id}}">
                                                                    <div class="input-group-addon"><i class="fa-solid fa-location-dot"></i></div>

                                                                    @php
                                                                        $hayErrorMunicipio = $errors->has('municipio') && (session('edit_error_id') == $votante->id);

                                                                        $idSelected = -1;

                                                                        if ($hayErrorMunicipio) {
                                                                            $idSelected = $votante->barrio->corregimiento->municipio->id;
                                                                        }else{
                                                                            $idSelected = old('municipio',$votante->barrio->corregimiento->municipio->id);
                                                                        }                                                                    
                                                                    @endphp

                                                                    <select name="municipio" id="municipio-{{$votante->id}}"                                                                        
                                                                        class="{{$hayErrorMunicipio ? "is-invalid" : null}} form-control municipio-editar">
                                                                        <option selected disabled>Municipio</option>
                                                                        @foreach ($municipios as $municipio)
                                                                            <option                                                           
                                                                                {{$idSelected == $municipio->id ? "selected" : null}}
                                                                                value="{{ $municipio->id }}">
                                                                                {{ $municipio->nombre }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @if ($hayErrorMunicipio)
                                                                    <span
                                                                        class="text-danger mt-2">{{$errors->first('municipio')}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col col-md-12">
                                                                <div class="input-group" id="corregimiento-group-{{$votante->id}}">
                                                                    <div class="input-group-addon"><i class="fa-solid fa-map-location-dot"></i></div>

                                                                    @php
                                                                        $hayErrorCorregimiento = $errors->has('corregimiento') && (session('edit_error_id') == $votante->id);
                                                                    @endphp

                                                                    <select name="corregimiento" id="corregimiento-{{$votante->id}}"                                                                        
                                                                        class="{{$hayErrorCorregimiento ? "is-invalid" : ""}} form-control corregimiento-editar"
                                                                        data-votante-corregimiento="{{$hayErrorCorregimiento ? $votante->corregimiento_id : old('corregimiento',$votante->corregimiento_id)}}">
                                                                        <option selected disabled>Corregimiento</option>
                                                                    </select>
                                                                </div>
                                                                @if ($hayErrorCorregimiento)
                                                                    <span
                                                                        class="text-danger mt-2">{{$errors->first('corregimiento')}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col col-md-12">
                                                                <div class="input-group" id="barrio-group-{{$votante->id}}">
                                                                    <div class="input-group-addon"><i class="fa-solid fa-location-arrow"></i></div>
                                                                    @php
                                                                        $hayErrorBarrio = $errors->has('barrio') && (session('edit_error_id') == $votante->id);
                                                                    @endphp

                                                                    <select name="barrio" id="barrio-{{$votante->id}}"
                                                                        data-votante-barrio="{{$hayErrorBarrio ? $votante->barrio_id : old('barrio',$votante->barrio_id)}}"
                                                                        class="{{$hayErrorBarrio ? "is-invalid" : ""}} form-control barrio-editar">
                                                                        <option selected disabled>Barrio</option>
                                                                    </select>
                                                                </div>
                                                                @if ($hayErrorBarrio)
                                                                    <span
                                                                        class="text-danger mt-2">{{$errors->first('barrio')}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col col-md-12">
                                                                <div class="input-group" id="puesto-group-{{$votante->id}}">
                                                                    <div class="input-group-addon"><i class="fa-solid fa-building-user"></i></div>
                                                                    @php
                                                                        $hayErrorPuesto = $errors->has('puesto') && (session('edit_error_id') == $votante->id);
                                                                    @endphp

                                                                    <select name="puesto" id="puesto-{{$votante->id}}"
                                                                        data-votante-puesto="{{$hayErrorPuesto ? $votante->mesa->puesto->id : old('puesto',$votante->mesa->puesto->id)}}"
                                                                        class="{{$hayErrorPuesto ? "is-invalid" : ""}} form-control puesto-editar">
                                                                        <option selected disabled>Puesto de votación
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                @if ($hayErrorPuesto)
                                                                    <span
                                                                        class="text-danger mt-2">{{$errors->first('puesto')}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col col-md-12">
                                                                <div class="input-group" id="mesa-group-{{$votante->id}}">
                                                                    <div class="input-group-addon"><i class="fa-solid fa-person-booth"></i></div>

                                                                    @php
                                                                        $hayErrorMesa = $errors->has('mesa') && (session('edit_error_id') == $votante->id);
                                                                    @endphp

                                                                    <select name="mesa" id="mesa-{{$votante->id}}"
                                                                        data-votante-mesa="{{$hayErrorMesa ? $votante->mesa_id : old('mesa',$votante->mesa_id)}}"
                                                                        class="{{$hayErrorMesa ? "is-invalid" : ""}} form-control mesa-editar">
                                                                        <option selected disabled>Mesa de votación</option>
                                                                    </select>
                                                                </div>
                                                                @if ($hayErrorMesa)
                                                                    <span
                                                                        class="text-danger mt-2">{{$errors->first('mesa')}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col col-md-12">
                                                                <div class="input-group" id="compromiso-group-{{$votante->id}}">
                                                                    <div class="input-group-addon"><i class="bi bi-person-heart"></i></div>
                                                                    @php
                                                                        $hayErrorCompromiso = $errors->has('compromiso') && (session('edit_error_id') == $votante->id);
                                                                        
                                                                        if ($hayErrorCompromiso) {
                                                                            $idSelected = $votante->compromiso_id;
                                                                        }else{
                                                                            $idSelected = old('compromiso',$votante->compromiso_id);
                                                                        }                                                                    
                                                                    @endphp

                                                                    <select name="compromiso" id="compromiso-{{$votante->id}}"
                                                                        class="{{$hayErrorCompromiso ? "is-invalid" : null}} form-control compromiso-editar">
                                                                        <option selected disabled>Compromiso</option>
                                                                        @foreach ($compromisos as $compromiso)
                                                                            <option 
                                                                                {{$idSelected == $compromiso->id ? "selected" : null}}
                                                                                value="{{ $compromiso->id }}">
                                                                                {{ $compromiso->nombre }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @if ($hayErrorCompromiso)
                                                                    <span
                                                                        class="text-danger mt-2">{{$errors->first('compromiso')}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col col-md-12">
                                                                <div class="input-group" id="recomendacion-group-{{$votante->id}}">
                                                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>

                                                                    @php
                                                                        $hayErrorRecomendacion = $errors->has('recomendacion') && (session('edit_error_id') == $votante->id);                                                                                                                                        
                                                                    @endphp

                                                                    <input type="text"
                                                                        maxlength="255" id="recomendacion-{{$votante->id}}"
                                                                        name="recomendacion"
                                                                        placeholder="A quién recomienda"
                                                                        value="{{$hayErrorRecomendacion ? $votante->recomendacion : old('recomendacion', $votante->recomendacion) }}"
                                                                        class="{{$hayErrorRecomendacion ? "is-invalid" : null}} form-control recomendacion-editar">
                                                                </div>
                                                                @if ($hayErrorRecomendacion)
                                                                    <span
                                                                        class="text-danger mt-2">{{$errors->first('recomendacion')}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary"
                                                        form="formulario-editar-{{$votante->id}}">Editar</button>
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
                                                        method="post" id="formulario-borrar-{{$votante->id}}">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" form="formulario-borrar-{{$votante->id}}"
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
    <script>        
        @if(session('error_crear'))
            document.getElementById('btn-abrir-crear').click();

            const oldCorregimiento = {{ old('corregimiento', -1) }};
            const oldBarrio = {{ old('barrio', -1) }};
            const oldPuesto = {{ old('puesto', -1) }};
            const oldMesa = {{ old('mesa', -1) }};
        @endif

        @if(session('edit_error_id'))
            document.addEventListener('DOMContentLoaded', () => {
                const edit_error_id = {{session('edit_error_id', -1)}};
                document.getElementById(`btn-modal-editar-${edit_error_id}`).click();
            })
        @endif

        @if (session('alerta'))
            Swal.fire({
                icon: "{{ session('alerta.icon') }}",
                title: "{{ session('alerta.title') }}",
                text: "{{ session('alerta.text') }}",
                confirmButtonText: "{{ session('alerta.confirmButtonText') }}"
            });
        @endif
    </script>
@endsection