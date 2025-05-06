@extends('layouts.app')

@section('titulo', 'Vista de votantes')

@section('css')
    @vite('resources/css/votantes/style.css')
@endsection

@section('contenido')
    <main class="min-h-screen">
        <div class="container mx-auto py-6">
            <div class="rounded-lg border bg-card text-card-foreground border-none shadow-sm" data-v0-t="card">
                <div class="flex flex-col space-y-1.5 p-6 pb-3">
                    <div class="flex items-center justify-between">
                        <h3 class="tracking-tight text-2xl font-bold">Votantes registrados</h3>
                        <a href="{{ route('votantes.vistaGuardar') }}"
                            class="hover:cursor-pointer inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 text-white h-10 px-4 py-2 bg-emerald-600 hover:bg-emerald-700">Nuevo
                            votante</a>
                    </div>
                </div>
                <div class="p-6 pt-0">
                    <div class="mb-4">
                        <div class="relative">
                            <input
                                class="flex h-10 w-full rounded-md border px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-gray-500 focus-visible:outline-2 focus-visible:outline-gray-500 disabled:cursor-not-allowed disabled:opacity-50 pl-10 bg-slate-50 border-slate-200"
                                placeholder="Buscar por nombre o documento...">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="rounded-xl relative w-full overflow-auto">
                        <table class="[&amp;_tr]:border-gray-500 w-full caption-bottom text-sm">
                            <thead class="bg-slate-100">
                                <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                    <th
                                        class="h-12 px-4 text-center align-middle text-gray-500 [&amp;:has([role=checkbox])]:pr-0 font-semibold">
                                        Nombre</th>
                                    <th
                                        class="h-12 px-4 text-center align-middle text-gray-500 [&amp;:has([role=checkbox])]:pr-0 font-semibold">
                                        Documento</th>
                                    <th
                                        class="h-12 px-4 text-center align-middle text-gray-500 [&amp;:has([role=checkbox])]:pr-0 font-semibold">
                                        Teléfono</th>
                                    <th
                                        class="h-12 px-4 text-center align-middle text-gray-500 [&amp;:has([role=checkbox])]:pr-0 font-semibold">
                                        Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b transition-colors data-[state=selected]:bg-muted hover:bg-slate-50">
                                    <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium text-center">
                                        José
                                        Martínez</td>
                                    <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 text-center">
                                        1076331914
                                    </td>
                                    <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 text-center">
                                        3218258785
                                    </td>
                                    <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 text-center">
                                        <div class="flex justify-center gap-2">
                                            <button
                                                class="hover:cursor-pointer inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border rounded-md px-3 h-8 border-yellow-500 bg-yellow-50 text-yellow-700 hover:bg-yellow-100 hover:text-yellow-800"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-pencil h-4 w-4">
                                                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"></path>
                                                    <path d="m15 5 4 4"></path>
                                                </svg><span class="sr-only">Editar</span>
                                            </button>
                                            <button
                                                class="hover:cursor-pointer inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border rounded-md px-3 h-8 border-red-500 bg-red-50 text-red-700 hover:bg-red-100 hover:text-red-800"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-trash2 h-4 w-4">
                                                    <path d="M3 6h18"></path>
                                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                                    <line x1="10" x2="10" y1="11" y2="17"></line>
                                                    <line x1="14" x2="14" y1="11" y2="17"></line>
                                                </svg><span class="sr-only">Eliminar</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 flex justify-between items-center text-sm text-slate-500">
                        <div>Mostrando 8 de 8 registros</div>
                        <div class="flex items-center gap-2">
                            <button
                                class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background hover:bg-gray-300 hover:text-black rounded-md px-3 h-8 hover:cursor-pointer">Anterior</button>
                            <button
                                class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background hover:bg-gray-300 hover:text-black rounded-md px-3 h-8 hover:cursor-pointer">Siguiente</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection