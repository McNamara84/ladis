@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title text-primary">{{ $pageTitle }}</h1>
                    <p class="text-muted small mb-4">Last updated: {{ $lastUpdated }}</p>
                    <p class="card-text">Welcome to the Advanced Search!</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
