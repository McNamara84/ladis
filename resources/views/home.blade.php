@extends('layouts.app')

@section('title', '{{ __("Dashboard") }}')

@section('content')
    <div class="container">
        <!-- Welcome Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-primary text-white rounded p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="h3 mb-2">{!! __("messages.c00", ["userName" => Auth::user()->name]) !!}</h1>
                            <p class="mb-0 opacity-75">
                                {{ __("messages.c01") }}
                            </p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="bg-white bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 80px; height: 80px;">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="text-white">
                                    <path d="M12 2L13.09 8.26L22 9L13.09 9.74L12 16L10.91 9.74L2 9L10.91 8.26L12 2Z"
                                        fill="currentColor" />
                                    <circle cx="12" cy="18" r="2" fill="currentColor" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (session('status'))
            <div class="row mb-4">
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <svg width="16" height="16" fill="currentColor" class="bi bi-check-circle me-2" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                        </svg>
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __("Close") }}"></button>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <!-- Quick Actions -->
            <div class="col-lg-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom-0">
                        <h5 class="card-title mb-0">
                            <svg width="20" height="20" fill="currentColor" class="bi bi-lightning-charge me-2 text-primary"
                                viewBox="0 0 16 16">
                                <path
                                    d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z" />
                            </svg>
                            {{ __("Quick Access") }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center text-muted py-4">
                            <svg width="48" height="48" fill="currentColor" class="bi bi-inbox mb-3" viewBox="0 0 16 16">
                                <path
                                    d="M4.98 4a.5.5 0 0 0-.39.188L1.54 8H6a.5.5 0 0 1 .5.5 1.5 1.5 0 1 0 3 0A.5.5 0 0 1 10 8h4.46l-3.05-3.812A.5.5 0 0 0 11.02 4H4.98zm9.954 5H10.45a2.5 2.5 0 0 1-4.9 0H1.066l.32 2.562a.5.5 0 0 0 .497.438h12.234a.5.5 0 0 0 .497-.438L14.933 9zM3.809 3.563A1.5 1.5 0 0 1 4.981 3h6.038a1.5 1.5 0 0 1 1.172.563l3.7 4.625a.5.5 0 0 1 .089.563l-.5 4A1.5 1.5 0 0 1 13.998 14H2.002a1.5 1.5 0 0 1-1.482-1.249l-.5-4a.5.5 0 0 1 .089-.563l3.7-4.625z" />
                            </svg>
                            <p class="mb-0">{{ __("No activities registered") }}</p>
                            <small>{{ __("messages.c02") }}</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom-0">
                        <h5 class="card-title mb-0">
                            <svg width="20" height="20" fill="currentColor" class="bi bi-info-circle me-2 text-primary"
                                viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                            </svg>
                            {{ __("System Information") }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                    <span class="text-muted small">{{ __("Laravel Version") }}</span>
                                    <span class="badge bg-success">{{ app()->version() }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                    <span class="text-muted small">{{ __("PHP Version") }}</span>
                                    <span class="badge bg-info">{{ PHP_VERSION }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                    <span class="text-muted small">{{ __("Registration") }}</span>
                                    <span class="small">{{ Auth::user()->created_at->format('d.m.Y H:i') }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-2">
                                    <span class="text-muted small">{{ __("Status") }}</span>
                                    <span class="badge bg-success">
                                        <svg width="12" height="12" fill="currentColor" class="bi bi-check-circle me-1"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path
                                                d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                        </svg>
                                        {{ __("Online") }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Getting Started -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm bg-light">
                    <div class="card-body text-center py-5">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="text-primary mb-4">
                            <path d="M12 2L13.09 8.26L22 9L13.09 9.74L12 16L10.91 9.74L2 9L10.91 8.26L12 2Z"
                                fill="currentColor" />
                            <circle cx="12" cy="18" r="2" fill="currentColor" />
                            <path d="M8 20H16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                        <h3 class="h4 mb-3">{!! __("messages.c03", ["appName" => config('app.name')]) !!}</h3>
                        <p class="text-muted mb-4">
                            {{ __("messages.c04") }}
                        </p>
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <button class="btn btn-primary me-2" disabled>
                                    <svg width="16" height="16" fill="currentColor" class="bi bi-plus-circle me-2"
                                        viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                    </svg>
                                    {{ __("Add first laser") }}
                                </button>
                                <button class="btn btn-outline-secondary" disabled>
                                    <svg width="16" height="16" fill="currentColor" class="bi bi-book me-2"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                                    </svg>
                                    {{ __("Documentation") }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<div class="d-grid gap-2">
    <button class="btn btn-outline-primary btn-sm" disabled>
        <svg width="16" height="16" fill="currentColor" class="bi bi-plus-circle me-2" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
            <path
                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
        </svg>
        {{ __("Add New Laser") }}
    </button>
    <button class="btn btn-outline-secondary btn-sm" disabled>
        <svg width="16" height="16" fill="currentColor" class="bi bi-search me-2" viewBox="0 0 16 16">
            <path
                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
        </svg>
        {{ __("Advanced Search") }}
    </button>
    <button class="btn btn-outline-info btn-sm" disabled>
        <svg width="16" height="16" fill="currentColor" class="bi bi-file-earmark-text me-2" viewBox="0 0 16 16">
            <path
                d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z" />
            <path
                d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
        </svg>
        {{ __("Create Project") }}
    </button>
</div>
</div>
</div>
</div>

<!-- Statistics -->
<div class="col-lg-8 mb-4">
    <div class="card h-100 border-0 shadow-sm">
        <div class="card-header bg-white border-bottom-0">
            <h5 class="card-title mb-0">
                <svg width="20" height="20" fill="currentColor" class="bi bi-bar-chart me-2 text-primary"
                    viewBox="0 0 16 16">
                    <path
                        d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zM4 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3z" />
                </svg>
                {{ __("Project Statistics") }}
            </h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="text-center p-3 bg-primary bg-opacity-10 rounded">
                        <div class="h2 text-primary mb-1">0</div>
                        <div class="small text-muted">{{ __("Lasers registered") }}</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center p-3 bg-success bg-opacity-10 rounded">
                        <div class="h2 text-success mb-1">0</div>
                        <div class="small text-muted">{{ __("Projects active") }}</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center p-3 bg-warning bg-opacity-10 rounded">
                        <div class="h2 text-warning mb-1">0</div>
                        <div class="small text-muted">{{ __("In process") }}</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center p-3 bg-info bg-opacity-10 rounded">
                        <div class="h2 text-info mb-1">{{ Auth::user()->created_at->diffForHumans() }}</div>
                        <div class="small text-muted">{{ __("Member since") }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Recent Activity & System Info -->
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom-0">
                <h5 class="card-title mb-0">
                    <svg width="20" height="20" fill="currentColor" class="bi bi-clock-history me-2 text-primary"
                        viewBox="0 0 16 16">
                        <path
                            d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1.001.025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                        <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                        <path
                            d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                    </svg>
                    {{ __("Last Activities") }}
                </h5>
            </div>
            <div class="card-body">
