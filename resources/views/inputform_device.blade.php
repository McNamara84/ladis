{{-- Credits: View design and breakpoints auto-generated via ai model Claude Sonnet 4 --}}
@extends('layouts.app')
@section('title', 'Input Form: Device')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">{{ __("Add New Laser Device") }}</h4>
                    </div>
                    <div class="card-body">
                        {{-- Display validation errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Display success message --}}
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('inputform.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">{{ __("Device Name") }}
                                            <span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') }}" required>
                                        <div class="form-text">
                                            {{ __("messages.d00") }}
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="year" class="form-label">{{ __("Build Year") }}
                                            <span class="text-danger"> *</span></label>
                                        <input type="number" class="form-control @error('year') is-invalid @enderror"
                                            id="year" name="year" value="{{ old('year') }}" min="1900" max="2099" required>
                                        <div class="form-text">
                                            {{  __("messages.d01") }}
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="build" class="form-label">{{ __("Build Type") }}
                                            <span class="text-danger"> *</span></label>
                                        <select class="form-control @error('build') is-invalid @enderror" id="build"
                                            name="build" required>
                                            <option value="">{{ __("Please select …") }}</option>
                                            <option value="0" {{ old('build') == '0' ? 'selected' : '' }}>{{ __("Fiber Optics") }}</option>
                                            <option value="1" {{ old('build') == '1' ? 'selected' : '' }}>{{ __("Mirror Arm") }}</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="safety_class" class="form-label">{{ __("Safety Class") }}</label>
                                        <select class="form-control @error('safety_class') is-invalid @enderror" id="safety_class" name="safety_class">
                                            <option value="">{{ __("Please select …") }}</option>
                                            {{-- safety subclasses 1M, 2M, 3R, 3B missing --}}
                                            <option value="1" {{ old('safety_class') == '1' ? 'selected' : '' }}>{{ __("Class") }} 1</option>
                                            <option value="2" {{ old('safety_class') == '2' ? 'selected' : '' }}>{{ __("Class") }} 2</option>
                                            <option value="3" {{ old('safety_class') == '3' ? 'selected' : '' }}>{{ __("Class") }} 3</option>
                                            <option value="4" {{ old('safety_class') == '4' ? 'selected' : '' }}>{{ __("Class") }} 4</option>
                                        </select>
                                    </div>

                                    {{-- Masses --}}
                                    <div class="form-group mb-3">
                                        <fieldset>
                                            <legend class="fs-6">{{ __("Metrics") }}</legend>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="height" class="form-label">{{ __("Height") }}
                                                        <span class="text-danger"> *</span></label>
                                                    <input type="number"
                                                        class="form-control @error('height') is-invalid @enderror"
                                                        id="height" name="height" value="{{ old('height') }}" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="width" class="form-label">{{ __("Width") }}
                                                        <span class="text-danger"> *</span></label>
                                                    <input type="number"
                                                        class="form-control @error('width') is-invalid @enderror" id="width"
                                                        name="width" value="{{ old('width') }}" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="depth" class="form-label">{{ __("Depth") }}
                                                        <span class="text-danger"> *</span></label>
                                                    <input type="number"
                                                        class="form-control @error('depth') is-invalid @enderror" id="depth"
                                                        name="depth" value="{{ old('depth') }}" required>
                                                </div>
                                            </div>
                                            <div class="form-text">
                                                {{ __("messages.d02") }}
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="weight" class="form-label">{{ __("Weight") }}
                                            <span class="text-danger"> *</span></label>
                                        <input type="number" step="0.01"
                                            class="form-control @error('weight') is-invalid @enderror" id="weight"
                                            name="weight" value="{{ old('weight') }}" required>
                                        <div class="form-text">
                                            {{ __("messages.d03") }}
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="fiber_length" class="form-label">{{ __("Fiber Length") }}
                                            <span class="text-danger"> *</span></label>
                                        <input type="number" step="0.01"
                                            class="form-control @error('fiber_length') is-invalid @enderror"
                                            id="fiber_length" name="fiber_length" value="{{ old('fiber_length') }}"
                                            required>
                                        <div class="form-text">
                                            {{ __("messages.d04") }}
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="cooling" class="form-label">{{ __("Cooling System") }}
                                            <span class="text-danger"> *</span></label>
                                        <select class="form-control @error('cooling') is-invalid @enderror" id="cooling"
                                            name="cooling" required>
                                            <option value="">{{ __("Please select …") }}</option>
                                            <option value="0" {{ old('cooling') == '0' ? 'selected' : '' }}>{{ __("internal") }}</option>
                                            <option value="1" {{ old('cooling') == '1' ? 'selected' : '' }}>{{ __("external") }}</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="mounting" class="form-label">{{ __("Mounting") }}
                                            <span class="text-danger"> *</span></label>
                                        <select class="form-control @error('mounting') is-invalid @enderror" id="mounting"
                                            name="mounting" required>
                                            <option value="">{{ __("Please select …") }}</option>
                                            <option value="1" {{ old('mounting') == '1' ? 'selected' : '' }}>{{ __("available") }}</option>
                                            <option value="0" {{ old('mounting') == '0' ? 'selected' : '' }}>{{ __("not available") }}</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="automation" class="form-label">{{ __("Automation System") }}
                                            <span class="text-danger"> *</span></label>
                                        <select class="form-control @error('automation') is-invalid @enderror"
                                            id="automation" name="automation" required>
                                            <option value="">{{ __("Please select …") }}</option>
                                            <option value="1" {{ old('automation') == '1' ? 'selected' : '' }}>{{ __("available") }}</option>
                                            <option value="0" {{ old('automation') == '0' ? 'selected' : '' }}>{{ __("not available") }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    {{-- Power data --}}
                                    <div class="form-group mb-3">
                                        <fieldset>
                                            <legend class="fs-6">{{ __("Energy Output") }}</legend>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="max_output" class="form-label">{{ __("Max. Energy Output") }}
                                                        <span class="text-danger"> *</span></label>
                                                    <input type="number" step="0.01"
                                                        class="form-control @error('max_output') is-invalid @enderror"
                                                        id="max_output" name="max_output" value="{{ old('max_output') }}"
                                                        required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="mean_output" class="form-label">{{ __("Mean Energy Output") }}
                                                        <span class="text-danger"> *</span></label>
                                                    <input type="number" step="0.01"
                                                        class="form-control @error('mean_output') is-invalid @enderror"
                                                        id="mean_output" name="mean_output" value="{{ old('mean_output') }}"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="form-text">
                                                {{ __("messages.d05") }}
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="max_wattage" class="form-label">{{ __("Max. Wattage") }}
                                            <span class="text-danger"> *</span></label>
                                        <input type="number" step="0.01"
                                            class="form-control @error('max_wattage') is-invalid @enderror" id="max_wattage"
                                            name="max_wattage" value="{{ old('max_wattage') }}" required>
                                        <div class="form-text">
                                            {{ __("messages.d06") }}
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="head" class="form-label">{{  __("Machining Head") }}
                                            <span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control @error('head') is-invalid @enderror"
                                            id="head" name="head" value="{{ old('head') }}" required>
                                        <div class="form-text">
                                            {{ __("messages.d07") }}
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="emission_source" class="form-label">{{ __("Emission Source") }}
                                            <span class="text-danger"> *</span></label>
                                        <select class="form-control @error('emission_source') is-invalid @enderror"
                                            id="emission_source" name="emission_source" required>
                                            <option value="">{{ __("Please select …") }}</option>
                                            <option value="0" {{ old('emission_source') == '0' ? 'selected' : '' }}>{{ __("Type") }} A
                                            </option>
                                            <option value="1" {{ old('emission_source') == '1' ? 'selected' : '' }}>{{ __("Type") }} B
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="beam_type" class="form-label">{{ __("Laser Beam Geometry") }}
                                            <span class="text-danger"> *</span></label>
                                        <select class="form-control @error('beam_type') is-invalid @enderror" id="beam_type"
                                            name="beam_type" required>
                                            <option value="">{{ __("Please select …") }}</option>
                                            <option value="0" {{ old('beam_type') == '0' ? 'selected' : '' }}>{{ __("Point Laser") }}</option>
                                            <option value="1" {{ old('beam_type') == '1' ? 'selected' : '' }}>{{ __("Line Laser") }}</option>
                                            <option value="2" {{ old('beam_type') == '2' ? 'selected' : '' }}>{{ __("Broad-Area Laser") }}</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="beam_profile" class="form-label">{{ __("Laser Beam Profile") }}
                                            <span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control @error('beam_profile') is-invalid @enderror"
                                            id="beam_profile" name="beam_profile" value="{{ old('beam_profile') }}"
                                            required>
                                        <div class="form-text">
                                            {{ __("messages.d08") }}
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="wavelength" class="form-label">{{ __("Wavelength") }}
                                            <span class="text-danger"> *</span></label>
                                        <input type="number" step="0.01"
                                            class="form-control @error('wavelength') is-invalid @enderror" id="wavelength"
                                            name="wavelength" value="{{ old('wavelength') }}" required>
                                        <div class="form-text">
                                            {{ __("messages.d09") }}
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">{{ __("Description") }}</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                            name="description" rows="3">{{ old('description') }}</textarea>
                                        <div class="form-text">
                                            {{ __("messages.d10") }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button type="reset" class="btn btn-secondary">{{ __("Reset Values") }}</button>
                                <button type="submit" class="btn btn-primary">{{ __("Add Device") }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection