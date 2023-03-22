@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('admin.includes.result_messages')
                <div class="card">
                    <div class="card-header">{{ __('') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('groups.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Название') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="title" value="{{ $item->title }}">
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
