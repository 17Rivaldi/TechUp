@extends('dashboard.layouts.master')

@section('content')
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 mt-1">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                Total Article
                            </p>
                            <h5 class="font-weight-bolder">{{ $totalArticle }}</h5>
                        </div>
                        <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                            <i class="fas fa-newspaper text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 mt-1">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                Total Article Bulan Ini
                            </p>
                            <h5 class="font-weight-bolder">{{ $totalArticlePerMonth }}</h5>
                        </div>
                        <div class="icon icon-shape bg-gradient-secondary shadow-secondary text-center rounded-circle">
                            <i class="fa-solid fa-calendar-plus text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (auth()->check() && auth()->user()->hasRole('admin'))
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 mt-1">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                    Total User
                                </p>
                                <h5 class="font-weight-bolder">{{ $totalUser }}</h5>
                            </div>
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="fas fa-users text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 mt-1">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                    Category
                                </p>
                                <h5 class="font-weight-bolder">{{ $totalCategory }}</h5>
                            </div>
                            <div class="icon icon-shape bg-gradient-success shadow-danger text-center rounded-circle">
                                <i class="fas fa-user-tie text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 mt-1">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                    Role
                                </p>
                                <h5 class="font-weight-bolder">{{ $totalRole }}</h5>
                            </div>
                            <div class="icon icon-shape bg-gradient-secondary shadow-danger text-center rounded-circle">
                                <i class="fas fa-building text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
