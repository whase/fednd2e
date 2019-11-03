@extends('layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            {{ $character->name }}
        </div>
        <div class="card-body">
            <table>
                <tr>
                    <td>
                        lvl {{ $character->level }}
                    </td>
                </tr>
                <tr>
                    <td>
                        stars: {{ $character->stars }}
                    </td>
                </tr>
                <tr>
                    <td>
                        experience: {{ $character->experience }}
                        <form method="post" action="{{ route('character.getExp', $character->id)}}">
                            @csrf
                            <input type="hidden" name="character" value="{{$character}}">
                            <button class="btn" type="submit">+10 exp</button>
                        </form>
                        @if($character->experience >= 100)
                        <form method="post" action="{{ route('character.levelUp', $character->id)}}">
                            @csrf
                            <input type="hidden" name="character" value="{{$character}}">
                            <button class="btn" type="submit">level up!</button>
                        </form>
                        @endif
                    </td>
                </tr>
            </table>

            <table>
                @foreach($character->stats as $stat)
                    <tr>
                        <td>
                            {{ $stat->name }} : {{ $stat->pivot->value}}
                        </td>
                    </tr>
                @endforeach
            </table>

            {{ $character->notes }}
        </div>
    </div>
@endsection
