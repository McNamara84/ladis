@extends('layouts.app')

@section('title', 'Eingabeformular Device')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Neues Material hinzufügen</h4>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label for="material_name" class="form-label">Material <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="material_name" name="material_name" required
                                placeholder="Geben Sie den Namen für das Material an">
                            <div class="form-text">
                                Bitte geben Sie einen Namen für das Material an
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection