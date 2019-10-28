@extends('layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Edit Character
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
            <form method="post" action="{{ route('characters.update', $character->id) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="character_name" value="{{ $character->name }}" />
                </div>
                <div class="form-group">
                    <label for="level">Level :</label>
                    <input type="text" class="form-control" name="level" value="{{ $character->level }}" />
                </div>
                <div class="form-group">
                    <label for="stars">Stars:</label>
                    <input type="text" class="form-control" name="stars" value="{{ $character->stars }}" />
                </div>
                <div class="form-group">
                    <label for="notes">Notes:</label>
                    <input type="text" class="form-control" name="notes" value="{{ $character->notes }}" />
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
