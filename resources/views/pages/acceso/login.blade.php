@extends('layouts.bootstrap')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/css/acceso/login.css')
@endsection

@section('contenido')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form">
                    <!--<span class="login100-form-title p-b-26">
                                                Welcome
                                            </span>-->
                    <span class="login100-form-title p-b-48">
                        <img src="{{ asset('images/logo.png') }}" alt="" width="100%">
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="Digite su usuario">
                        <input class="input100" type="text" name="text">
                        <span class="focus-input100" data-placeholder="Usuario"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Digite su contraseña">
                        <span class="btn-show-pass">
                            <i class="fa-solid fa-eye" style="color: #999999;"></i>
                        </span>
                        <input class="input100" type="password" name="pass">
                        <span class="focus-input100" data-placeholder="Contraseña"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                Ingresar
                            </button>
                        </div>
                    </div>

                    <div class="text-center p-t-115">
                        <span class="txt1">
                            ¿Has olvidado tu contraseña?
                        </span>

                        <a class="txt2" href="#">
                            clic aquí
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite('resources/js/acceso/login.js')
@endsection