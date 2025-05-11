@extends('layouts.tailwind')

@section('titulo', 'Guardar votante')

@section('css')
    @vite('resources/css/votantes/style.css')
@endsection

@section('contenido')
    <main class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            <div class="rounded-lg border bg-card text-card-foreground border-none shadow-lg" data-v0-t="card">
                <div class="flex flex-col space-y-1.5 p-6 bg-blue-600 text-white rounded-t-lg">
                    <h3 class="tracking-tight text-xl font-medium">Nuevo Votante</h3>
                </div>
                <div class="p-6">
                    <form class="space-y-5" method="POST" action="{{ route('votantes.guardar') }}">
                        @csrf
                        <div class="space-y-1.5">
                            <label class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium"
                                for="nombre">Nombre Completo</label>
                            <input
                                class="{{ $errors->has('nombre') ? 'border-red-500!' : null }} border border-input flex w-full rounded-md bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-gray-500 disabled:cursor-not-allowed disabled:opacity-50 h-10"
                                id="nombre" name="nombre" placeholder="Ingrese el nombre completo" required type="text"
                                maxlength="255">

                            @if ($errors->has('nombre'))
                                <span class="text-[12px] text-red-500 select-none">{{$errors->first('nombre')}}</span>
                            @endif
                        </div>
                        <div class="space-y-1.5">
                            <label class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium"
                                for="cedula">Cédula</label>
                            <input
                                class="{{ $errors->has('cedula') ? 'border-red-500!' : null }} flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-gray-500 disabled:cursor-not-allowed disabled:opacity-50 h-10"
                                id="cedula" name="cedula" placeholder="ingrese la cédula" required="" type="text"
                                maxlength="255">

                            @if ($errors->has('cedula'))
                                <span class="text-[12px] text-red-500 select-none">{{$errors->first('cedula')}}</span>
                            @endif
                        </div>
                        <div class="space-y-1.5">
                            <label class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium"
                                for="telefono">Teléfono</label>
                            <input
                                class="{{ $errors->has('telefono') ? 'border-red-500!' : null }} flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-gray-500 disabled:cursor-not-allowed disabled:opacity-50 h-10"
                                id="telefono" name="telefono" placeholder="Número de teléfono" required type="number"
                                maxlength="10">

                            @if ($errors->has('telefono'))
                                <span class="text-[12px] text-red-500 select-none">{{$errors->first('telefono')}}</span>
                            @endif
                        </div>
                        <div class="space-y-1.5">
                            <label class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium"
                                for="municipio">Municipio</label>
                            <select required name="municipio" id="municipio"
                                class="{{ $errors->has('municipio') ? 'border-red-500!' : null }} hover:cursor-pointer w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus-visible:outline-gray-500">
                                <option value="" selected disabled>Seleccione un municipio</option>
                                @foreach ($municipios as $municipio)
                                    <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('municipio'))
                                <span class="text-[12px] text-red-500 select-none">{{$errors->first('municipio')}}</span>
                            @endif
                        </div>
                        <div class="space-y-1.5">
                            <label class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium"
                                for="corregimiento">Corregimiento</label>
                            <select required name="corregimiento" id="corregimiento"
                                class="{{ $errors->has('corregimiento') ? 'border-red-500!' : null }} hover:cursor-pointer w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus-visible:outline-gray-500">
                                <option value="" selected disabled>Seleccione un corregimiento</option>
                                <option value="corregimiento1">Corregimiento 1</option>
                                <option value="corregimiento2">Corregimiento 2</option>
                                <option value="corregimiento3">Corregimiento 3</option>
                            </select>

                            @if ($errors->has('corregimiento'))
                                <span class="text-[12px] text-red-500 select-none">{{$errors->first('corregimiento')}}</span>
                            @endif
                        </div>
                        <div class="space-y-1.5">
                            <label class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium"
                                for="barrio">Barrio</label>
                            <select required name="barrio" id="barrio"
                                class="{{ $errors->has('barrio') ? 'border-red-500!' : null }} hover:cursor-pointer w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus-visible:outline-gray-500">
                                <option value="" selected disabled>Seleccione un barrio</option>
                                <option value="barrio1">Barrio 1</option>
                                <option value="barrio2">Barrio 2</option>
                                <option value="barrio3">Barrio 3</option>
                            </select>

                            @if ($errors->has('barrio'))
                                <span class="text-[12px] text-red-500 select-none">{{$errors->first('barrio')}}</span>
                            @endif
                        </div>
                        <div class="space-y-1.5">
                            <label class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium"
                                for="puesto">Puesto de votacion</label>
                            <select required name="puesto" id="puesto"
                                class="{{ $errors->has('puesto') ? 'border-red-500!' : null }} hover:cursor-pointer w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus-visible:outline-gray-500">
                                <option value="" selected disabled>Seleccione un puesto</option>
                                <option value="puesto1">puesto 1</option>
                                <option value="puesto2">puesto 2</option>
                                <option value="puesto3">puesto 3</option>
                            </select>

                            @if ($errors->has('puesto'))
                                <span class="text-[12px] text-red-500 select-none">{{$errors->first('puesto')}}</span>
                            @endif
                        </div>
                        <div class="space-y-1.5">
                            <label class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium"
                                for="mesa">Mesa de votación</label>
                            <select required name="mesa" id="mesa"
                                class="{{ $errors->has('mesa') ? 'border-red-500!' : null }} hover:cursor-pointer w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus-visible:outline-gray-500">
                                <option value="" selected disabled>Seleccione una mesa</option>
                                <option value="mesa1">mesa 1</option>
                                <option value="mesa2">mesa 2</option>
                                <option value="mesa3">mesa 3</option>
                            </select>

                            @if ($errors->has('mesa'))
                                <span class="text-[12px] text-red-500 select-none">{{$errors->first('mesa')}}</span>
                            @endif
                        </div>
                        <div class="space-y-1.5">
                            <label class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium"
                                for="compromiso">Compromiso</label>
                            <select required name="compromiso" id="compromiso"
                                class="{{ $errors->has('compromiso') ? 'border-red-500!' : null }} hover:cursor-pointer w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus-visible:outline-gray-500">
                                <option value="" selected disabled>Seleccione un compromiso</option>
                                @foreach ($compromisos as $compromiso)
                                    <option value="{{ $compromiso->id }}">{{ $compromiso->nombre }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('compromiso'))
                                <span class="text-[12px] text-red-500 select-none">{{$errors->first('compromiso')}}</span>
                            @endif
                        </div>
                        <div class="space-y-1.5">
                            <label class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium"
                                for="recomendación">¿A quién recomienda?</label>
                            <input
                                class="{{ $errors->has('recomendacion') ? 'border-red-500!' : null}} flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-gray-500 disabled:cursor-not-allowed disabled:opacity-50 h-10"
                                id="recomendación" name="recomendación" placeholder="Ingresa a quien recomienda" type="text"
                                maxlength="255">

                            @if ($errors->has('recomendacion'))
                                <span class="text-[12px] text-red-500 select-none">{{$errors->first('recomendacion')}}</span>
                            @endif
                        </div>
                        <div class="flex space-x-3 pt-2">
                            <button
                                class="hover:cursor-pointer inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 px-4 py-2 flex-1 bg-blue-500 hover:bg-blue-600 text-white h-10"
                                type="submit">
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-check mr-2 h-4 w-4">
                                        <path d="M20 6 9 17l-5-5"></path>
                                    </svg>
                                    Registrar
                                </span>
                            </button>
                            <a href="{{ route('votantes.listado') }}"
                                class="hover:cursor-pointer inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border bg-background hover:text-accent-foreground px-4 py-2 flex-1 border-red-500 text-red-500 hover:bg-red-50 h-10">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection