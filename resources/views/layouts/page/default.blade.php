@extends('layouts.app')

@section('content')
    <div class="container my-5 pt-5 page-header">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="mb-5 page-title">@yield('title')</h1>

                @hasSection('excerpt')
                    <div class="lead page-excerpt">
                        @yield('excerpt')
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="container my-5 page-body">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @yield('page-content')
            </div>
        </div>
    </div>
@endsection
