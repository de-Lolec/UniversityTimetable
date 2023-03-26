@extends('layouts.app')

@section('content')
    <body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm">
                                <form method="GET" action="{{ route('sort') }}">

                                    <div class='input-group date' id='datetimepicker1'>
                                        <label>

                                        </label>

                                        <input type='text' class="form-control" name="date" value="{{ $date }}"/>
                                        <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
            </span>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        Посмотреть
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    @foreach ($paginator as $block)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm">
                                        <p class="mb-0"><strong>    {{ $timePara[$block->time] }}</strong></p>
                                    </div>
                                    <div class="col-sm">

                                        <p class="text-center"><strong>     {{ $days_week[$block->day_num] }}</strong>
                                        </p>
                                    </div>
                                    <div class="col-sm text-right">
                                        <p class="text-end">
                                            <strong>    {{ $current=\Carbon\Carbon::now()->addDays($block->day_num)->format('d.m.Y') }}</strong>
                                        </p>
                                    </div>

                                    <table class="table align-middle">
                                        <thead>
                                        <tr>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">Название:</th>
                                            <td>{{ $block->predmets->title??null }}</td>


                                        </tr>
                                        <tr>
                                            <th scope="row">Препод:</th>
                                            <td class="text-wrap" style="width: 40rem;">{{ $block->prepods->name }}</td>


                                        </tr>
                                        <tr>
                                            <th scope="row">Аудитория:</th>
                                            <td>{{ $block->audience }}</td>


                                        </tr>
                                        <tr>
                                            <th scope="row">Важность:</th>
                                            <td>&#127569; &#127569;</td>


                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    @endforeach
    </body>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datetimepicker({
                format: 'DD.MM.YYYY'
            });
        });
    </script>
@endsection
