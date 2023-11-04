<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <style>
        .carousel-inner img{
            width: 100%;
            height: 400px;
            object-fit: cover;
        }
        .kurir img{
            height: 200px;
            object-fit: cover;
            width: 100%;
        }
    </style>
  </head>
  <body>

    @include('pages.frontend._navbar')

    <form action="{{ route("prosesLogin") }}" method="post">
        @csrf

        <div class="row justify-content-center mt-5">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="h2">Login</div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="email" value="{{ old("email") }}">
                        </div>

                        <div class="mb-3">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" value="{{ old("password") }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Login</button>

                    </div>
                </div>
            </div>
        </div>

    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
