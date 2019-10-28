@extends('layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="uper">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif
        <a href="{{ route('characters.create')}}" class="btn btn-primary">New</a>
        <form action="{{route("character.search")}}" method="post">
            @csrf
            <input type="text" name="query" placeholder="search"><input type="submit">
        </form>
        <table class="table table-striped">
            <thead>
            <tr>
                <td>Favorite <a href="{{ route('characters.index', ["sort"=>"favorite"])}}">^</a> </td>
                <td>Name <a href="{{ route('characters.index', ["sort"=>"name"])}}">^</a> </td>
                <td>level <a href="{{ route('characters.index', ["sort"=>"level"])}}">^</a> </td>
                <td>stars <a href="{{ route('characters.index', ["sort"=>"stars"])}}">^</a> </td>
                <td colspan="2">Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($characters as $character)
                <tr>
                    <td>{{$character->favorite}}</td>
                    <td>{{$character->name}}</td>
                    <td>{{$character->level}}</td>
                    <td>{{$character->stars}}</td>
                    <td><a href="{{ route('characters.edit',$character->id)}}" class="btn btn-primary">Edit</a></td>
                    <td>
                        <form action="{{ route('characters.destroy', $character->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>

    @if(isset($characters))
        {{$characters}}
    @endif
@endsection
