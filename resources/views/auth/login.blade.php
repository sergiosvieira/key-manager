@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center section-aquamarine cover"
        style="background-image: url({{ asset('img/cover.jpg') }});">
        <div class="container border-0">
            <div class="row">
                <div class="col-md-12">
                    <img class="img-fluid d-block mx-auto" src="{{ asset('img/ifce.png') }}">
                </div>
            </div>
            @if($errors->any())
            <div class="row">
                <div class="col-lg-6 ml-auto mr-auto alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $errors->first() }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="form-ifce col-lg-6 ml-auto mr-auto mt-2 shadow-lg p-3">
                    <h2>Portaria - Controle de Chaves</h2>
                    <div class="col-md-12">
                        {!! Form::open([
                        'route'=>'login',
                        'method'=>'post'
                        ]) !!}
                        <div class="form-group form-row">
                            <label class="col-sm-2 col-form-label">Usuário</label>
                            <div class="col-sm-10">
                                {!! Form::text('email', null, [
                                'class'=> 'form-control',
                                'placeholder'=>'E-mail do usuário',
                                'required'=>'required'
                                ]) !!}
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label class="col-sm-2 col-form-label">Senha</label>
                            <div class="col-sm-10">
                                {!! Form::password('password', [
                                'class'=> 'form-control text-dark',
                                'placeholder'=>'Digite a senha',
                                'required'=>'required'
                                ]) !!}
                            </div>
                        </div>
                        {!! Form::submit('Acessar', ['class' => 'btn btn-info']) !!}
                        @if (Route::has('register'))
                            <a class="btn btn-info" role="button" aria-pressed="false" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif

                        <div class="form-group offset-sm-1 row">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        <div class="form-group row mb-0">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link text-light" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
