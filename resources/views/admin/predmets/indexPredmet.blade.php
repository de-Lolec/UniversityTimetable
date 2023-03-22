@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @include('admin.includes.result_messages')

                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <a class="btn btn-primary" href="{{ route('predmet.create', ['group_id' => $group_id]) }}">Добавить</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Название</th>
                                <th>Группа</th>
                                <th>Инфа</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paginator as $predmet)
                                @php /** @var \App\Models\BlogPost $item */ @endphp
                                <tr>
                                    <td>{{ $predmet->id }}</td>
                                    <td>
                                        <a href="{{ route('predmet.edit', ['group_id' => $group_id, 'predmet' => $predmet->id]) }}">
                                            {{ $predmet->title }}
                                        </a>

                                    </td>
                                    <td>{{ $predmet->groups->title??null }}</td>
                                    <td>{{ $predmet->info }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if($paginator->total() > $paginator->count())
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{ $paginator->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
