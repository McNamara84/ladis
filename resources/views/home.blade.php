@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row m-4">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <svg width="20" height="20" fill="currentColor" class="bi bi-lightning-charge me-2 text-primary"
                                viewBox="0 0 16 16">
                                <path
                                    d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z" />
                            </svg>
                            Schnellzugriff
                        </h5>
                    </div>
                    <div class="card-body">
                        <x-link route="hilfe" text="Dokumentation" disabled class="btn btn-outline-primary" />
                        <x-link route="user-management.index" text="Accounts" class="btn btn-outline-primary" />
                        <x-link route="devices.all" text="Geräte" class="btn btn-outline-primary" />
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="card">
                    <div class="card-header">
                        Angemeldet als {{ Auth::user()->name }}
                    </div>
                    <div class="card-body">
                        <p>Konto erstellt am {{ Auth::user()->created_at->format('d.m.Y H:i') }}</p>
                        <hr>
                        <x-link route="logout" text="Abmelden" class="btn btn-outline-primary" />
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="card">
                    <div class="card-header">
                        <svg width="20" height="20" fill="currentColor" class="bi bi-info-circle me-2 text-primary"
                            viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                        </svg>
                        System-Information
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>LADIS Version</td>
                                    <td><span class="badge fs-6 bg-success">{{ $appVersion }}</span></td>
                                </tr>
                                <tr>
                                    <td>Laravel Version</td>
                                    <td><span class="badge fs-6 bg-danger">{{ app()->version() }}</span></td>
                                </tr>
                                <tr>
                                    <td>PHP Version</td>
                                    <td><span class="badge fs-6 bg-primary">{{ PHP_VERSION }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row m-4">
            <div class="col-5 mb-4 mb-lg-0">
                <div class="card">
                    <div class="card-header">Statistiken</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Schema</th>
                                    <th>Erfassten Datensätze</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Projekte</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>Laser</td>
                                    <td>10</td>
                                </tr>
                                <tr>
                                    <td>Messreihen</td>
                                    <td>128</td>
                                </tr>
                                <tr>
                                    <td>Artefakte</td>
                                    <td>33</td>
                                </tr>
                                <tr>
                                    <td>…</td>
                                    <td>42</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-7 mb-4 mb-lg-0">
                <div class="card">
                    <div class="card-header">Latzte Aktivitäten</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Aktion</th>
                                    <th>Datum</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Account erstellt</td>
                                    <td>2025-07-09</td>
                                </tr>
                                <tr>
                                    <td>Gerät bearbeitet</td>
                                    <td>2025-07-09</td>
                                </tr>
                                <tr>
                                    <td>Messreihe erfasst</td>
                                    <td>2025-07-08</td>
                                </tr>
                                <tr>
                                    <td>Messreihe erfasst</td>
                                    <td>2025-07-08</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
