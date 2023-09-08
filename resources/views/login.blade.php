<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
       
        <title>Login | Reimbur App</title>

        <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">

        <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">

    </head>
    <body>
       
        <div class="container">
            <div class="card card-login mx-auto text-center bg-dark">
                <div class="card-header mx-auto bg-dark">
                    <h3>Sign in</h3>
                    
                    @if(session()->has('LoginError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('LoginError') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                </div>
                <div class="card-body">

                    <form action="/login" method="post">
                        @csrf
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                            <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" placeholder="NIP" autocomplete="off">

                            @error('nip')
                            <div class="invalid-feedback text-left">
                                Harap mengisi NIP
                            </div>
                            @enderror
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-key"></i>
                                </span>
                            </div>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" autocomplete="off">

                            @error('password')
                            <div class="invalid-feedback text-left">
                                Invalid password
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-danger float-right login_btn">Login</button>                    
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/vendor/jquery/jquery.slim.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/jquery/popper.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    </body>
</html>