<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- csrf token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title : config('app.name', 'Laravel') }}</title>
    
    <link rel="icon" type="image/png" href="{{asset('tamplate/img/logo-Patron.png')}}">

    <!-- Custom fonts for this template-->
    <link href="{{asset('tamplate/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('tamplate/css/sb-admin-2.min.css')}}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <br><br>
        <h3 class="text-dark text-center">{{ $content->title }}</h3>
        <br>
        <p>{{ $content->opening }}</p>
        {!! $content->content !!}
        <br>
        <p>{{ $content->closing }}</p>
        <hr>
        <div class="row">
            <div class="col">
                    <img src="{{ asset('tamplate/img/logo-patron-pnga.png') }}" style="height: 80px" alt="Patron logo">
                    <br>
                    <div>Copyright <a class="card-link text-danger" href="http://localhost:8000/home">PatronTMS</a> © 2021
                    </div>
                    <div class="text-xs">
                        Develop with <span class="text-danger">❤</span> by 
                        <a class="card-link text-gray-600" href="https://github.com/yudistirachma">Yudistirachma</a>
                    </div>
            </div>
            <div class="col text-xs">
                <div class="font-weight-bold text-lg">Content Information</div>
                <div>Content id : {{ $content->id}}</div>
                <div class="mt-2">Journalist &nbsp;: {{ $content->user->name }}</div> 
                <div>Redaktur &nbsp;&nbsp;: {{ $content->group->user->name }}</div> 
                <div>Created at : {{ $content->created_at->format('d/m/Y')}}</div>
                <div>Verfied at : {{ $content->verification ? $content->verification->format('d/m/Y') : 'Not verified'}}</div>
                <div>UploadLink : <a href="{{ $content->upload}}">{{ $content->upload}}</a></div>

                <div class="mt-2">
                    @if ($content->verification > $content->deadline && $content->deadline !== null)
                    <span class="badge badge-pill mx-auto badge-danger"><small>Late</small></span>
                    @endif
                    @if ($content->upload)
                    <a href="{{ $content->upload }}" class="badge badge-pill mx-auto badge-info"><small>Uploaded</small></a>
                    @endif
                    @if ($content->verification)
                    <span class="badge badge-pill mx-auto badge-success"><small>Verified</small></span>
                    @endif
                </div>
            </div>
            <div class="col"></div>
        </div>
        <br>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('tamplate/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('tamplate/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>