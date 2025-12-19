@extends('layouts.app')

@section('title', 'Eingabeformular Projekt')

@section('content')
    <div class="container">
        <div class="row justify-content-center m-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">{{ $pageTitle }}</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('inputform_project.store') }}">
                            @csrf

                            <x-form.alerts />

                            <x-form.select
                                name="person_id"
                                label="Projektleitung"
                                :options="$persons"
                                placeholder="Wählen Sie die Projektleitung aus"
                                :required="true"
                            />

                            <x-form.select
                                name="venue_id"
                                label="Objektname"
                                :options="$venues"
                                placeholder="Wählen Sie den Objektnamen aus"
                                :required="true"
                            />

                            <x-form.input
                                name="name"
                                label="Name"
                                placeholder="Projektname"
                                hint="Bitte geben Sie eine eindeutige Bezeichnung für das Projekt an."
                                :required="true"
                            />

                            <x-form.textarea
                                name="description"
                                label="Beschreibung"
                                placeholder="Projektbeschreibung"
                                hint="Bitte geben Sie eine Beschreibung für das Projekt an."
                                :required="true"
                            />

                            <x-form.input
                                name="url"
                                label="URL"
                                placeholder="Projekt-URL"
                                hint="Bitte geben Sie eine eindeutige URL des Projektes an."
                                :required="true"
                            />

                            <x-form.input
                                name="started_at"
                                label="Beginn"
                                type="date"
                                hint="Bitte geben Sie das Startdatum des Projektes an."
                                :required="true"
                            />

                            <x-form.input
                                name="ended_at"
                                label="Ende"
                                type="date"
                                hint="Bitte geben Sie das Enddatum des Projektes an."
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