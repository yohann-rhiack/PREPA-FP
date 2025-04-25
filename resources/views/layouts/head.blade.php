{{-- @section('head')
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset ('/frontend')}}/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset ('/frontend')}}/dist/css/adminlte.min.css">
    </head>
@endsection  --}}

@section('head')
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{$title}}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset ('/frontend')}}/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" defer></script>
        <style>
        body {
            background-color: #f8f9fa;
        }
    
        .sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: white;
            padding: 4rem 2rem 1rem 1rem;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            
        }
    
        .sidebar .nav-link {
            border-radius: 12px;
            padding: 10px 16px;
            color: #333;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
        }
    
        .sidebar .nav-link:hover {
            background-color: #ece9fb;
            color: #6c63ff;
        }
    
        .sidebar .nav-link.active {
            background-color: #6c63ff;
            color: white;
        }
    
        .sidebar .nav-link.active i {
            color: white;
        }
    
        .sidebar i {
            color: #6c63ff;
        }
    
        /* Topbar avec espacement à gauche */
        .navbar {
            background-color: #c9c4f9;
            height: 60px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1050;
            display: flex;
            align-items: center;
            padding: 0 1rem;
        }
        /* Contenu principal avec un padding à gauche pour séparer de la sidebar */
        .content {
            margin-left: 240px;  /* Espacement de 240px à gauche pour ne pas être collé à la sidebar */
            padding: 2rem;  /* Padding pour le contenu */
        }
    
        .card-icon {
            font-size: 24px;
            padding: 10px;
            border-radius: 50%;
            display: inline-block;
        }
    
        .icon-blue {
            background-color: #e7edfb;
            color: #3e7ee0;
        }
    
        .icon-red {
            background-color: #fdecea;
            color: #e65c4f;
        }
    
        .icon-green {
            background-color: #e9f7ef;
            color: #4caf50;
        }
    
        /* Padding entre les cartes */
        .content .row .col-md-3 {
            margin-bottom: 2px;
        }

        .content {
            margin-left: 240px;
            margin-top: 60px;
            padding: 2rem;
        }
            
        /* Styles pour la sidebar rétractable en mode téléphone */
        @media (max-width: 992px) {
            .sidebar {
            transform: translateX(-240px); /* Cache la sidebar sur les petits écrans */
            }
    
            .sidebar.active {
            transform: translateX(0); /* Affiche la sidebar lorsque le bouton est cliqué */
            }
    
            .content {
            margin-left: 0; /* Retire l'espacement à gauche */
            }
        }
        </style>
    </head>
@endsection