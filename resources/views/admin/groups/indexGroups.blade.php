@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @include('admin.includes.result_messages')

                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <a class="btn btn-primary" href="{{ route('groups.create') }}">Добавить</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Название</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paginator as $groups)
                                @php /** @var \App\Models\BlogPost $item */ @endphp
                                <tr>
                                    <td>{{ $groups->id }}</td>
                                    <td>
                                        <a class="text-decoration-none text" href="{{ route('groups.edit', $groups->id) }}">
                                            {{ $groups->title }}
                                        </a>
                                    </td>
                                    <td>   <a class="text-decoration-none text" href="{{ route('timetable.index', ['group_id' => $groups->id]) }}"> Расписание </a>

                                    <td>  <a class="text-decoration-none text" href="{{ route('predmet.index',['group_id' => $groups->id]) }}">Предметы</a> </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="row justify-content-center">
            <div class="col-md-8">
            @if($paginator->total() > $paginator->count())
            <br>
            {{ $paginator->links() }}


                </div>
            </div>
        @endif
    </div>
@endsection
