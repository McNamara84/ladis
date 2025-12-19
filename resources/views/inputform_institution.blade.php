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
                        <x-form.alerts />

                        <form action="{{ route('inputform_institution.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <x-form.input
                                        name="name"
                                        label="Name der Institution"
                                        hint="Bitte geben Sie eine eindeutige Bezeichnung der Institution ein."
                                        :required="true"
                                    />

                                    <x-form.select
                                        name="type"
                                        label="Typ"
                                        :options="[
                                            Institution::TYPE_CLIENT => 'Auftraggeber',
                                            Institution::TYPE_CONTRACTOR => 'Auftragnehmer',
                                            Institution::TYPE_MANUFACTURER => 'Hersteller',
                                        ]"
                                        placeholder="Bitte auswählen"
                                        hint="Bitte wählen Sie die passende Typenbezeichnung aus der Liste aus."
                                        :required="true"
                                    />

                                    <x-form.textarea
                                        name="contact_information"
                                        label="Kontaktinformation"
                                        hint="Bitte geben Sie eine Kontaktinformation ein, wie z.B. einen Webseitenlink."
                                        :required="true"
                                    />

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