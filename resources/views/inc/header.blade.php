<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ISPAM') }}</title>

    <!-- Styles -->
    
    <link href="css/custom.css" rel="stylesheet"><!--our css-->
    <link href="css/contact.css" rel="stylesheet"><!--our css-->
    
    <link href="css/animate.css" rel="stylesheet"><!--our animation css-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!--fonts-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Diplomata+SC" rel="stylesheet">
</head>