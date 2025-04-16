@extends('layouts.main')
@extends('layouts.head')
@extends('layouts.header')
@extends('layouts.sidebar')
@extends('layouts.navbar')

@section('body')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Modifier le plan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('plan.update', $plan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="title">Titre du plan</label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ $plan->title }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4" required>{{ $plan->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="price">Prix</label>
                            <input type="number" class="form-control" name="price" id="price" value="{{ $plan->price }}" required>
                        </div>

                        <div class="form-group">
                            <label for="courses">Cours reliés</label>
                            <select name="course_id" id="course_id" class="form-control">
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" 
                                        {{ $plan->course_id == $course->id ? 'selected' : '' }}>
                                        {{ $course->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <!-- Update Button -->
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success w-100">Mettre à Jour</button>
                            </div>

                            <!-- Back to List Button -->
                            <div class="col-md-6">
                                <a href="{{ route('frontend.plan') }}" class="btn btn-secondary w-100">Retour à la Liste</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
       </div>
    </div>
</div>
@endsection

@extends('layouts.footer')
@extends('layouts.script')
