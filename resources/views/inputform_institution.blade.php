@php
    use App\Models\Institution;
@endphp

@extends('layouts.app')
@section('title', $pageTitle)
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Neue Institution hinzufügen</h4>
                    </div>
                    <div class="card-body">
                        {{-- Display validation errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif 

                        {{-- Display success message --}}
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('inputform_institution.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Name der Institution: *</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') }}" required>
                                        <div class="form-text">
                                            Bitte geben Sie eine eindeutige Bezeichnung Institution ein.
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="type" class="form-label">Typ *</label>
                                        <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                                            <option value="">Bitte wählen Sie die passende Typbezeichnung aus</option>
                                            <option value="{{ Institution::TYPE_CLIENT}}" {{ old('type') == Institution::TYPE_CLIENT ? 'selected' : '' }}>Auftraggeber</option>
                                            <option value="{{ Institution::TYPE_CONTRACTOR}}" {{ old('type') == Institution::TYPE_CONTRACTOR ? 'selected' : '' }}>Auftragnehmer</option>
                                            <option value="{{ Institution::TYPE_MANUFACTURER}}" {{ old('type') == Institution::TYPE_MANUFACTURER ? 'selected' : '' }}>Hersteller</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="contact_information" class="form-label">Kontaktinformation: *</label>
                                        <textarea class="form-control @error('contact_information') is-invalid @enderror"
                                            name="contact_information" rows="3" required>{{ old('contact_information') }}</textarea>
                                        <div class="form-text">
                                            Bitte geben Sie eine Kontaktinformation ein, wie z.B. einen Webseitenlink.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <button type="reset" class="btn btn-secondary">Werte zurücksetzen</button>
                                <button type="submit" class="btn btn-primary">Hinzufügen</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection