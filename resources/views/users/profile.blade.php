@extends('layouts.app')

@section('content')
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

<body>
<div class="container">
    <div class="main-body">



        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->

        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="https://www.blast.hk/attachments/64805/" alt="Admin" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4>{{ Auth::user()->name }}</h4>
                                <p class="text-secondary mb-1"></p>
                                <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <a class="btn btn-outline-primary" target="__blank" href="/admin/prepods/">Список преподов</a>
                    <a class="btn btn-outline-primary" target="__blank" href="/admin/groups/">Список групп</a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Никнейм</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $user->name }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Универ</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $user->university->title ?? null }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Группа</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $user->group->title ?? null }}
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <a class="btn btn-primary"  href="/user/{{ $user->id }}/{{ $user->name }}/edit">Отредачить</a>
                            </div>
                        </div>
                    </div>
                </div>





            </div>
        </div>

    </div>
</div>
</body>

@endsection
