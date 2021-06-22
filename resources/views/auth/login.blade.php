@extends('layouts.app')

@section('content')
<!-- <div class="container"> -->
<!--     <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->


    <section class="login-block">
        <div class="container">
            <div class="row">
                <div class="col-md-4 login-sec">
                    <h2 class="text-center">Iniciar sesión</h2>
                <form class="login-form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="exampleInputEmail1" class="text-uppercase">EMAIL</label>
                        <input type="text" class="form-control" placeholder="" id="email" name="email" value="{{ old('email') }}" required>  

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="text-uppercase">Password</label>
                        <input type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                      
                      
                    <div class="form-check">
                        <!-- <label class="form-check-label">
                          <input type="checkbox" class="form-check-input">
                          <small>Remember Me</small>
                        </label> -->
                        <button type="submit" class="btn btn-login float-right">Ingresar</button>
                    </div>
          
                </form>
                <div class="copy-text text-center">
                    <img src="{{asset('images/logo.png')}}" class="img-fluid" alt="">
                    <!-- <strong>Copyright ©</strong> 2018 <a>Kuravaina</a>  -->
                </div>
                </div>
                <div class="col-md-8 banner-sec">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                         <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                          </ol>
                    <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="{{asset('images/login/fondo_800_x_600.jpg')}}" alt="First slide">
              <div class="carousel-caption d-none d-md-block">
                <div class="banner-text">
                    <h2>Gran Sabana</h2>
                    <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p> -->
                </div>  
          </div>
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="{{asset('images/login/saltoange_800_x_600.jpg')}}" alt="First slide">
              <div class="carousel-caption d-none d-md-block">
                <div class="banner-text">
                    <h2>Salto Angel</h2>
                    <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p> -->
                </div>  
            </div>
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="{{asset('images/login/canaima_800_x_600.jpg')}}" alt="First slide">
              <div class="carousel-caption d-none d-md-block">
                <div class="banner-text">
                    <h2>Canaima</h2>
                    <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p> -->
                </div>  
            </div>
          </div>
                    </div>     
                    
                </div>
            </div>
        </div>
        </section>
<!-- </div> -->
@endsection
