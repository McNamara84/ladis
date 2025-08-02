@extends('layouts.app')
@section('title', $pageTitle)
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Neue Person hinzufügen</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('inputform_person.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Name: <strong>*</strong></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="institution_id" class="form-label">Institution: <strong>*</strong></label>
                                        <select class="form-control @error('institution_id') is-invalid @enderror" id="institution_id" name="institution_id" required>
                                            <option value="">Bitte auswählen</option>
                                            @foreach($institutions as $institution)
                                                <option value="{{ $institution->id }}" @selected(old('institution_id') == $institution->id)>{{ $institution->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-text mb-3">
                                        <strong>*</strong> Pflichtangabe
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