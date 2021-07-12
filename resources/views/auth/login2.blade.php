@extends('layouts.login.layout')

@section('content')
    <form class="form-horizontal form-material" id="loginform" method="POST" action="{{ route('login') }}">
        @csrf

        <h3 class="box-title m-b-20">{{ __('Iniciar Sesión') }}</h3>

       <div class="form-group">
            <div class="col-xs-12">
                <input id="email" placeholder="Correo" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <input id="password" placeholder="Clave" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>


        <div class="form-group row">
            <div class="col-md-12">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Recordarme</label>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Recuperar contraseña</a>
                     @endif 
                </div> 
            </div>
        </div>

        <div class="form-group text-center">
            <div class="col-xs-12 p-b-20">
                <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">{{ __('Ingresar') }}</button>
            </div>
        </div>
        {{--  <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                <div class="social">
                    <a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a>
                    <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a>
                </div>
            </div>
        </div>
        <div class="form-group m-b-0">
            <div class="col-sm-12 text-center">
                ¿No tiene cuenta?<a href="#" class="text-info m-l-5"><b>Registrarse</b></a>
            </div>
        </div> --}}
    </form>
@endsection
