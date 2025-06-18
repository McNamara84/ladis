@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title text-primary">Advanced Search</h1>
                    <p class="card-text">Welcome to the Advanced Search!</p>
                        <form>
                            <div class="mb-3"> 
                                <label for="device_name" class="form-label"> device name:</label>
                                <input type="text" id="device_name" name="device_name" class="form-control" placeholder="Enter your search term here.">
                            </div>
                            <div class="mb-3">
                                <label for="project_name" class="form-label"> project name:</label>
                                <input type="text" id="project_name" name="project_name" class="form-control" placeholder="Enter your search term here.">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search"></i> Search
                                </button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
