@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('admin.includes.result_messages')
                <div class="card">
                    <div class="card-header">{{ __('') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('predmet.update', ['group_id' => $group_id, 'predmet' => $item->id]) }}">
                            @method('PATCH')
                            @csrf

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Название') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="title" value="{{ $item->title }}">
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Информация по предмету') }}</label>
                                <div class="col-md-6">

                                   <textarea name="info"
                                             id="exampleFormControlTextarea1"
                                             rows="10"
                                             class="form-control"
                                             rows="20">{{ old('info', $item->info) }}</textarea>
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
                @if($item->exists)
                    <br>
                    <form method="POST" action="{{ route('predmet.update', ['group_id' => $group_id, 'predmet' => $item->id]) }}">
                        @method('DELETE')
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card card-block">
                                    <div class="card-body ml-auto">
                                        <button type="submit" class="btn btn-link">Удалить</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
