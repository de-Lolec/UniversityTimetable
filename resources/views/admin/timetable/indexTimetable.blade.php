@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('admin.includes.result_messages')
                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <a class="btn btn-primary" href="{{ route('timetable.create', ['group_id' => $group_id]) }}">Добавить</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Название пары</th>
                                <th>Препод</th>
                                <th>Группа</th>
                                <th>День недели</th>
                                <th>Четность недели</th>
                                <th>Время</th>
                                <th>Аудитория</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paginator as $item)
                                @php /** @var \App\Models\BlogPost $item */ @endphp
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <a href="{{ route('timetable.edit', ['group_id' => $group_id, 'timetable' => $item->id]) }}">
                                            {{ $item->predmets->title??null }}
                                        </a>
                                    </td>
                                    <td>{{ $item->prepods->name??null}}</td>
                                    <td>{{ $item->groups->title??null }}</td>
                                    <td>{{ $item->day_num }}</td>
                                    <td>{{ $item->week_parity }}</td>
                                    <td>{{ $item->time }}</td>
                                    <td>{{ $item->audience }}</td>
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
