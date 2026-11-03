@extends('layouts.app')

@section('title', 'Eingabeformular Objekt')

@section('content')
    <div class="container">
        <div class="row justify-content-center m-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Neues Objekt hinzufügen</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('inputform_artifact.store') }}">
                            @csrf

                            <x-form.alerts :showRequiredHint="true" />

                            <x-form.input
                                name="artifact_name"
                                label="Objektname"
                                placeholder="Legen Sie den Name eines neuen Objekts an."
                                :required="true"
                            />

                            <x-form.input
                                name="artifact_inventory_number"
                                label="Inventarnummer"
                                placeholder="Geben Sie hier die Inventarnummer an."
                            />

                            <x-form.select
                                name="artifact_location_id"
                                label="Standort"
                                :options="$locations"
                                placeholder="Wählen Sie einen Standort aus."
                                :required="true"
                            >
                                <x-slot:hint>
                                    Kein passender Standort verfügbar?
                                    <a href="{{ route('locations.create') }}" class="link-primary">Legen Sie einen neuen Standort an.</a>
                                </x-slot:hint>
                            </x-form.select>

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

