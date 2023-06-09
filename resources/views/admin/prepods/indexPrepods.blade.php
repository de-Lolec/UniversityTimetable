@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @include('admin.includes.result_messages')

                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <a class="btn btn-primary" href="{{ route('prepods.create') }}">Добавить</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>ФИО</th>
                                <th>email</th>
                                <th>Университет</th>
                                <th>Инфа</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paginator as $prepod)
                                @php /** @var \App\Models\BlogPost $item */ @endphp
                                <tr>
                                    <td>{{ $prepod->id }}</td>
                                    <td>
                                        <a href="{{ route('prepods.edit', $prepod->id) }}">
                                            {{ $prepod->name }}
                                        </a>
                                    </td>
                                    <td>{{ $prepod->email }}</td>
                                    <td>{{ $prepod->university->title??null }}</td>
                                    <td>{{ $prepod->info }}</td>
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
