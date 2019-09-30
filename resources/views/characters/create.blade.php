@extends('layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Add Character
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post" action="{{ route('characters.store') }}">
                <div class="form-group">
                    @csrf
                    <label for="name">Character Name:</label>
                    <input type="text" class="form-control" name="character_name"/>
                </div>
                <div class="form-group">
                    <label for="level">Character Level :</label>
                    <input type="text" class="form-control" name="character_level"/>
                </div>
                <div class="form-group">
                    <label for="stars">Stars:</label>
                    <input type="text" class="form-control" name="character_stars"/>
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
@endsection
