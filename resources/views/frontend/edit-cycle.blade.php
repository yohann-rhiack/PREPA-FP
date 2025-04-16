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
                    <h3 class="card-title">Modifier le cycle</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('cycle.update', $cycle->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                    
                        <div class="form-group">
                            <label for="name">Nom du cycle</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $cycle->name }}" required>
                        </div>
                    
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control">{{ $cycle->description }}</textarea>
                        </div>
                    
                        <div class="form-group">
                            <label for="subjects">Matières</label>
                            <select name="subjects[]" id="subjects" class="form-control" multiple>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" 
                                        {{ in_array($subject->id, $cycle->subjects->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $subject->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>
                    
                </div>
            </div>
       </div>
    </div>
</div>
@endsection

@extends('layouts.footer')
@extends('layouts.script')
