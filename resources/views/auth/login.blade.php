<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto mt-5">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="text-center text-light">Login Form</h3>
                    </div>
                    @if (session()->has('success_password'))
                        <strong class="text-success text-center mt-2">{{ session()->get('success_password') }}</strong>
                    @endif
                    @if (session()->has('error'))
                        <strong class="text-danger text-center mt-2">{{ session()->get('error') }}</strong>
                    @endif
                    @if (session()->has('not_allow'))
                        <strong class="text-danger text-center mt-2">{{ session()->get('not_allow') }}</strong>
                    @endif

                    <div class="card-body">
                        <form method="post" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" id="email">
                                @error('email')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" id="password">
                                @error('password')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>
