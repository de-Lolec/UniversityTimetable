@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('admin.includes.result_messages')
                <div class="card">
                    <div class="card-header">{{ __('') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('timetable.store', ['group_id' => $group_id]) }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="predmets_id" class="col-md-4 col-form-label text-md-end">Предмет</label>
                                <div class="col-md-6">
                                    <select class="form-select" aria-label="Default select example" id="predmets_id" name="predmets_id" placeholder="Выберите предмет">

                                        @foreach ($predmetList as $predmetOption)
                                            <option value="{{ $predmetOption->id }}">
                                                {{-- {{ $categoryOption->id }} . {{ $categoryOption->title }} --}}
                                                {{ $predmetOption->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="groups_id" class="col-md-4 col-form-label text-md-end">Группа</label>
                                <div class="col-md-6">
                                    <select class="form-select" aria-label="Default select example" id="groups_id" name="groups_id" placeholder="Выберите предмет">

                                        @foreach ($groupList as $groupOption)
                                            <option value="{{ $groupOption->id }}"
                                                    @if($groupOption->id == $group_id) selected @endif>
                                                {{ $groupOption->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{  __('Препод') }}</label>
                                <div class="col-md-6">
                                    <select class="form-select" aria-label="Default select example" id="prepods_id" name="prepods_id" placeholder="Выберите предмет">

                                        @foreach ($prepodList as $prepodOption)
                                            <option value="{{ $prepodOption->id }}">
                                                {{ $prepodOption->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Аудитория') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="audience" value="{{ $item->audience }}" required autocomplete="email">


                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Время') }}</label>
                                <div class="col-md-6">
                                    <select class="form-select" aria-label="Default select example" name="time" value="{{ $item->time }}">
                                        <option selected>Выберите</option>
                                        <option value="1">1 пара 8:30-10:05</option>
                                        <option value="2">2 пара 10:15-11:50</option>
                                        <option value="3">3 пара 12:00-13:35</option>
                                        <option value="4">4 пара 14:15-15:50</option>
                                        <option value="5">5 пара 16:00-17:35</option>
                                        <option value="6">6 пара 17:45-19:20</option>
                                        <option value="7">7 пара 19:30-21:05</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('День недели') }}</label>
                                <div class="col-md-6">
                                    <select class="form-select" aria-label="Default select example" name="day_num" value="{{ $item->day_num }}">
                                    <option selected>Выберите</option>
                                        <option value="1">Понедельник</option>
                                        <option value="2">Вторник</option>
                                        <option value="3">Среда</option>
                                        <option value="4">Четверг</option>
                                        <option value="5">Пятница</option>
                                        <option value="6">Суббота</option>
                                        <option value="7">Воскресенье</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Четность недели') }}</label>
                                <div class="col-md-6">
                                    <select class="form-select" aria-label="Default select example" name="week_parity" value="{{ $item->week_parity }}" placeholder="Выберите предмет">
                                        <option selected>Выберите</option>
                                        <option value="1">Нечетная</option>
                                        <option value="2">Четная</option>
                                    </select>
                                </div>
                            </div>


                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Добавить') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
