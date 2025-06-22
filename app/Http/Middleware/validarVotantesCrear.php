<?php

namespace App\Http\Middleware;

use App\Rules\correlacion;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class validarVotantesCrear
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $reglas = [
            "nombre" => "required|string|max:255",
            "cedula" => "required|string|max:255|unique:votantes,cedula",
            "telefono" => "required|string|max:10",
            "municipio" => "required|integer|exists:municipios,id",
            "corregimiento" => [
                "required",
                "integer",
                new correlacion(
                    'corregimientos',
                    'municipio_id',
                    $request->input('municipio'),
                    'El corregimiento no pertenece al municipio seleccionado'
                )
            ],
            "barrio" => [
                "required",
                "integer",
                new Correlacion(
                    'barrios',
                    'corregimiento_id',
                    $request->input('corregimiento'),
                    'El barrio no pertenece al corregimiento seleccionado'
                )
            ],
            "puesto" => [
                "required",
                "integer",
                new correlacion(
                    'puestos',
                    'barrio_id',
                    $request->input('barrio'),
                    'El puesto no pertenece al barrio seleccionado'
                )
            ],
            "mesa" => [
                "required",
                "integer",
                new correlacion(
                    'mesas',
                    'puesto_id',
                    $request->input('puesto'),
                    'La mesa no pertenece al puesto seleccionado'
                )
            ],
            "compromiso" => "required|integer|exists:compromisos,id",
            "recomendacion" => "nullable|string|max:255"
        ];


        // Mensajes de error personalizados
        $mensajesNombre = [
            "nombre.required" => "El campo nombre es obligatorio.",
            "nombre.string" => "El campo nombre debe ser un texto.",
            "nombre.max" => "El campo nombre no debe exceder los 255 caracteres."
        ];

        $mensajesCedula = [
            "cedula.required" => "El campo cédula es obligatorio.",
            "cedula.string" => "El campo cédula debe ser una cadena de texto.",
            "cedula.max" => "El campo cédula no debe exceder los 255 caracteres.",
            "cedula.unique" => "La cédula ya está registrada."
        ];

        $mensajesTelefono = [
            "telefono.required" => "El campo teléfono es obligatorio.",
            "telefono.string" => "El campo teléfono debe ser una cadena de texto.",
            "telefono.max" => "El campo teléfono no debe exceder los 10 digitos.",
        ];

        $mensajesMunicipio = [
            "municipio.required" => "El campo municipio es obligatorio.",
            "municipio.integer" => "El campo municipio debe ser uno de la lista.",
            "municipio.exists" => "El municipio seleccionado no es válido.",
        ];

        $mensajesCorregimiento = [
            "corregimiento.required" => "El campo corregimiento es obligatorio.",
            "corregimiento.integer" => "El campo corregimiento debe ser uno de la lista.",
        ];

        $mensajesBarrio = [
            "barrio.required" => "El campo barrio es obligatorio.",
            "barrio.integer" => "El campo barrio debe ser uno de la lista.",
        ];

        $mensajesPuesto = [
            "puesto.required" => "El campo puesto es obligatorio.",
            "puesto.integer" => "El campo puesto debe ser uno de la lista.",
        ];

        $mensajesMesa = [
            "mesa.required" => "El campo mesa es obligatorio.",
            "mesa.integer" => "El campo mesa debe ser uno de la lista.",
        ];

        $mensajesCompromiso = [
            "compromiso.required" => "El campo compromiso es obligatorio.",
            "compromiso.integer" => "El campo compromiso debe ser uno de la lista.",
            "compromiso.exists" => "El compromiso seleccionado no es válido.",
        ];

        $mensajesRecomendacion = [
            "recomendacion.string" => "El campo recomendación debe ser una cadena de texto.",
            "recomendacion.max" => "El campo recomendación no debe exceder los 255 caracteres."
        ];

        $mensajes = [
            ...$mensajesNombre,
            ...$mensajesCedula,
            ...$mensajesTelefono,
            ...$mensajesMunicipio,
            ...$mensajesCorregimiento,
            ...$mensajesBarrio,
            ...$mensajesPuesto,
            ...$mensajesMesa,
            ...$mensajesCompromiso,
            ...$mensajesRecomendacion
        ];

        $validator = Validator::make($request->all(), $reglas, $mensajes);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator->errors())
                ->withInput()
                ->with("error_crear", "si");
        }

        return $next($request);
    }
}
