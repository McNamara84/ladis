@extends('layouts.app')

@section('title', 'Eingabeformular Material')

@section('content')
    <div class="container">
        <div class="row justify-content-center m-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Neues Material hinzufügen</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('inputform_material.store') }}">
                            @csrf

                            <x-form.alerts />

                            <x-form.select
                                name="material_parent_id"
                                label="Übergeordnetes Material"
                                :options="$materials"
                                placeholder="-"
                                hint="Ohne Auswahl wird das neue Material als eigenständiges Material angelegt."
                            />

                            <x-form.input
                                name="material_name"
                                label="Material"
                                placeholder="Materialname"
                                hint="Bitte geben Sie einen Materialnamen ein."
                                :required="true"
                            />

                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-primary">Speichern</button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Abbrechen</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
