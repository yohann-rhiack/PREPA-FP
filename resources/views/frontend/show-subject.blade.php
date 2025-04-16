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
                <h3 class="card-title">Détails de la Matière</h3>
            </div>
            <div class="card-body">
                <h2>{{ $subjects->title }}</h2>
                <p><strong>Description :</strong> {{ $subjects->description }}</p>

                <h3>Cours associés :</h3>
                <ul>
                    @foreach($subjects->courses as $course)
                        <li>{{ $course->title }}</li>
                        <p>Description : {{ $course->content }}</p>
                    @endforeach
                </ul>

                <a href="{{ route('frontend.subject') }}" class="btn btn-primary">Retour</a>
            </div>
        </div>
    </div>
</div>

@endsection

@extends('layouts.footer')
@extends('layouts.script')
