@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')
<div class="content">
    <div class="container-fluid"> 
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Détails utilisateur</h3>
            </div>
            <div class="card-body">
                <h3>Nom :{{ $users->fname }}</h3>
                <h2>Prénom :{{ $users->lname }}</h3>
                <h3>Téléphone :{{ $users->phone }}</h3>
                <h3>Email :{{ $users->email }}</h3>

                <h3>Role :</h3>
                <ul>
                    @if(!$users->role)
                        <li>Aucun rôle attribué</li>
                    @else
                        <li>{{ $users->role->title }}</li>
                    @endif
                </ul>

                <a href="{{ route('frontend.utilisateur') }}" class="btn btn-primary">Retour</a>
            </div>
        </div>
    </div>
</div>

@endsection

@extends('layouts.footer')
@extends('layouts.script')
