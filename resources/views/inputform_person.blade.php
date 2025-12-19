@extends('layouts.app')
@section('title', $pageTitle)
@section('content')
    <x-card.form title="Neue Person hinzufügen">
        <x-form.alerts />

        <form action="{{ route('inputform_person.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <x-form.input
                        name="name"
                        label="Name"
                        :required="true"
                    />

                    <x-form.select
                        name="institution_id"
                        label="Institution"
                        :options="$institutions"
                        placeholder="Bitte auswählen"
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
    </x-card.form>
@endsection