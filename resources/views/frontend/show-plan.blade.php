@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')
<div class="container-fluid px-0">
    <div class="row justify-content-center mx-0"> <!-- Centre horizontalement -->
        <div class="col-12 col-md-10 col-lg-8"> <!-- Largeur adaptable -->
            <div class="card mb-4 shadow-sm rounded-0">
                <div class="card-header bg-primary text-white" id="card-header">
                    <h3 class="card-title mb-0">Détails du plan</h3>
                </div>
                <div class="card-body">
                    <p><strong>Titre :</strong> {{ $plans->title }}</p>
                    <p><strong>Description :</strong> {{ $plans->description }}</p>
                    <p><strong>Prix :</strong> {{ $plans->price }} FCFA</p>
                    <p><strong>Cours :</strong> {{ $plans->course->title ?? 'N/A' }}</p>

                    <a href="{{ route('frontend.plan') }}" class="btn mt-4" style="background-color: #6c63ff; color: white;">← Retour à la liste des plans</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #card-header{
        background-color: #6c63ff !important; /* Couleur de fond */
        
    }
</style>
@endsection

@extends('layouts.footer')
@extends('layouts.script')
