<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
    	@include('back.login.partials.metas')
    	@include('back.login.partials.styles')
	</head>
    <body class="auth-wrapper">
        <div class="all-wrapper menu-side with-pattern">
            <div class="auth-box-w">
                <div class="logo-w">
                    <a href=""><img alt="liasa" src="{{ asset('front/img/logo-cinpasa.svg') }}" class="img-fluid"></a>
                    <div class="frase">
                        @php
                            $inspire = explode('-', $inspire) ;
                            $quote = $inspire[0] ?? '';
                            $author = $inspire[1] ?? '';
                        @endphp
                        <h1><em>“{{ $quote }}”</em></h1>
                        <h2>{{ $author }}</h2>
                    </div>
                </div>
                <h4 class="auth-header">Bienvenido a CINPASA</h4>
                <form id="form-login" role="form" action="{{ action('Back\LoginController@handleLogin') }}" method="post" v-on:submit="validateForm">
                	{{ csrf_field() }}
                    <div class="form-group">
                        <label for="">E-mail</label>
                        <input type="email" class="form-control" name="email" placeholder="Introduce e-mail" v-model.trim="email.value" @input="validateEmail(email.value)" v-bind:class="{'is-invalid': email.error}">
                        <div class="pre-icon os-icon os-icon-user-male-circle"></div>
                    </div>
                    <div class="form-group">
                        <label for="">Contraseña</label>
                        <input type="password" class="form-control" name="password" placeholder="Contraseña" v-model.trim="password.value" v-bind:class="{'is-invalid': password.error}">
                        <div class="pre-icon os-icon os-icon-fingerprint"></div>
                    </div>
                    <div class="form-check">
		            	<label class="form-check-label"><input class="form-check-input" type="checkbox" value="1" id="checkbox1" name="remember">Recordarme</label>
		          	</div>
                    <div class="buttons-w">
                        <button class="btn btn-primary btn-cons m-t-10" type="submit" id="entrar">Iniciar sesión</button>
                    </div>
                    @if(session('error_login') || $errors->any())
	                    <div class="alert alert-danger alert-message-form-login" role="alert">
		                    @if(session('error_login'))
			                    <p><i class="fa fa-times"></i> {{ session('error_login') }}</p>
			                @endif
			                @if ($errors->any())
		                        @foreach ($errors->all() as $error)
		                            <p><i class="os-icon os-icon-cancel-circle"></i> {{ $error }}</p>
		                        @endforeach
			                @endif
			            </div>
			        @endif
                </form>
            </div>
        </div>
        <script src="{{ asset('plugins/vue/vue.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('back/js/login.js') }}"></script>
    </body>
</html>
