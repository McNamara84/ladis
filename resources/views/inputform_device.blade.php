@extends('layouts.app')

@section('title', 'Eingabeformular Device')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Neues Lasergerät hinzufügen</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="device_name" class="form-label">Gerätename <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="device_name" name="device_name" required
                                    placeholder="Geben Sie den Namen des Lasergeräts ein">
                                <div class="form-text">
                                    Bitte geben Sie eine eindeutige Bezeichnung für das Lasergerät ein.
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> Gerät hinzufügen
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
