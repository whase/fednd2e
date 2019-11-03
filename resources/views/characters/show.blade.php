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
