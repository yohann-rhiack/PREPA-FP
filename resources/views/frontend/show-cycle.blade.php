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
                <h3 class="card-title">Détails du Cycle</h3>
            </div>
            <div class="card-body">
                <h2>{{ $cycle->name }}</h2>
                <p><strong>Description :</strong> {{ $cycle->description }}</p>

                <h3>Matières associées :</h3>
                <ul>
                    @foreach($cycle->subjects as $subject)
                        <li>{{ $subject->title }} - {{ $subject->description }}</li>
                    @endforeach
                </ul>

                <a href="{{ route('frontend.cycle') }}" class="btn btn-primary">Retour</a>
            </div>
        </div>
    </div>
</div>

@endsection

@extends('layouts.footer')
@extends('layouts.script')
