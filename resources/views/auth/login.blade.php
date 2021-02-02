@extends('auth.contenido')

@section('login')
    <div class="container ">
        <div class="row ">
            <div class="col-sm-10 login-box">
                <div class="row">
                    <div class="col-lg-8 col-md-7 log-det">
                        <div class="small-logo">
                            <i class="fab fa-asymmetrik"></i> Refaccionaria el Águila
                        </div>
                        <h2>Inicia Sesión En SVFA</h2>
                        <div class="row">
                            <ul>
                                <li><i class="fab fa-facebook-f"></i></li>
                                <li><i class="fab fa-twitter"></i></li>
                                <li><i class="fab fa-linkedin-in"></i></li>
                            </ul>
                        </div>
                        <div class="row">
                            <p class="small-info">Usando tu cuenta de usuario</p>
                        </div>
                        <form lass="form-horizontal form-simple was-validated" action="{{ route('login')}}" method="POST">
                        {{ csrf_field() }}
                            <div class="text-box-cont">
                                <div class="input-group mb-3 {{$errors->has('usuario' ? 'is-invalid' : '')}}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" id="usuario" name="usuario" value="{{ old('usuario')}}" class="form-control" placeholder="usuario" >
                                    {!!$errors->first('usuario','<span class="invalid-feedback">:message</span>')!!}
                                </div>
                                <div class="input-group mb-3 {{$errors->has('password' ? 'is-invalid' : '')}}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="contraseña" >
                                    {!!$errors->first('password','<span class="invalid-feedback">:message</span>')!!}
                                </div>
                                <div class="row">
                                    <p class="forget-p">¿Olvidaste tu contraseña?</p>
                                </div>
                                <div class="input-group center mb-3">
                                    <button type="submit" class="btn btn-success btn-round">Acceder</button>
                                </div>    
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4 col-md-5 box-de">
                        <div class="ditk-inf">
                            <!-- <h2 class="w-100">Din't Have an Account </h2>
                            <p>Simply Create your account by clicking the Signup Button</p>
                            <a href="signup.html">
                            <button type="button" class="btn btn-outline-light">SIGN UP</button>
                            </a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
