@extends('layouts.login.layout')

@section('styles')

<link rel="stylesheet" type="text/css" href="{{asset('css/reset.css')}}">  
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
       <!--<div class="col-md-8"> -->
            <div class="card">
               <div class="flex">
                   <div class="card-header" >{{ __('Recuperar Contraseña') }}</div>
               </div> 

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Se ha enviado el link de recuperación.') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                    <div class="text-center">
                        <img src="{{asset('images/logo-dirdeporte-small.png')}}" class="img-responsive mb-4" width="200">
                    </div>
                        @csrf

                        <div class="form-group row">

                             <div class="col-md-12"> 
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Correo Electronico" required autocomplete="email" autofocus>

                                @error('email')
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
                                    <a href="{{ url()->previous() }}" id="to-recover" class="text-dark pull-right">
                                        <i class="fa fa-arrow-left m-r-5"></i> 
                                        Volver
                                    </a>
                                   
                                </div> 
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Enviar Link de recuperación') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <!--</div> -->
    </div>
</div>
@endsection
