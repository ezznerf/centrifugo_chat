<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>
<section class="vh-100">
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-sm-6 text-black d-flex align-items-center justify-content-center">
                <div class="w-100 px-4" style="max-width: 30rem;">
                    <div class="text-center mb-1">
                        <img src="{{ asset('storage') . '/logo.png' }}" style="width:150px"/>
                    </div>

                    <form class="mt-1" action="/registration" method="POST">
                        @csrf
                        <h1 class="fw-bold text-center mb-4" style="letter-spacing: 1px;">Registration</h1>

                        <div class="form-outline mb-4">
                            <input class="form-control form-control-lg" name="name" placeholder="znerf"/>
                            @error('name')
                            <div>
                                <p class="text-danger">{{$message}}</p>
                            </div>
                            @enderror
                        </div>

                        <div class="form-outline mb-4">
                            <input type="email" class="form-control form-control-lg" name="email" placeholder="example@mail.ru"/>
                            @error('email')
                            <div>
                                <p class="text-danger">{{$message}}</p>
                            </div>
                            @enderror
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" class="form-control form-control-lg" name="password" placeholder="**********"/>
                            @error('password')
                            <div>
                                <p class="text-danger">{{$message}}</p>
                            </div>
                            @enderror
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" class="form-control form-control-lg" name="password_confirmation" placeholder="**********"/>
                        </div>

                        <div class="pt-1 mb-4 text-center">
                            <button class="btn btn-info btn-lg btn-block" type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-sm-6 px-0 d-none d-sm-block">
                <img src="{{ asset('storage') . '/sizif_3.webp' }}"
                     alt="Login image" class="w-100" style="min-height: 100vh; object-fit: cover; object-position: left;">
            </div>
        </div>
    </div>
</section>
</body>
</html>
