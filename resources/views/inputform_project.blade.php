@extends('layouts.app')

@section('title', 'Eingabeformular Project')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Neues Projekt anlegen</h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="project_name" class="form-label">Projektname <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="project_name" name="project_name" required
                                placeholder="Geben Sie den Namen des Projektes an">
                            <div class="form-text">
                                Bitte geben Sie eine eindeutige Bezeichnung für das Projekt an
                            </div>
                        </div>









                    </form>
                </div>