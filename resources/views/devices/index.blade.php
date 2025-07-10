@extends('layouts.app')

@section('title', __('Devices'))

@section('content')
    <div class="container">
        <h1 class="h3 mb-4">{{ __("All Laser Devices") }}</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ __("ID") }}</th>
                        <th>{{ __("Name") }}</th>
                        <th>{{ __("Institution") }}</th>
                        <th>{{ __("Build Year") }}</th>
                        <th>{{ __("Build Type") }}</th>
                        <th>{{ __("Beam Profile") }}</th>
                        <th>{{ __("Max. Power") }} (in W)</th>
                        @auth
                            <th>{{ __("Actions") }}</th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @forelse($devices as $device)
                        <tr>
                            <td>{{ $device->id }}</td>
                            <td>{{ $device->name }}</td>
                            <td>{{ $device->institution->name ?? '–' }}</td>
                            <td>{{ $device->year ?? '–' }}</td>
                            <td>{{ $device->build_type }}</td>
                            <td>{{ $device->beam_type_name }}</td>
                            <td>{{ $device->max_output ?? '–' }}</td>
                            @auth
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteDevice{{ $device->id }}">
                                        {{ __("Delete") }}
                                    </button>

                                    <div class="modal fade" id="deleteDevice{{ $device->id }}" tabindex="-1" aria-labelledby="deleteDevice{{ $device->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteDevice{{ $device->id }}Label">{{ __("Delete Device") }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __("Close") }}"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! __("messages.m00", [":deviceName" => $device->name]) !!}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("Cancel") }}</button>
                                                    <form method="POST" action="{{ route('devices.destroy', $device->id) }}" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">{{ __("Delete") }}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            @endauth
                        </tr>
                    @empty
                        <tr>
                            <td colspan="@auth 8 @else 7 @endauth">{{ __("No devices available.") }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @auth
            <a href="{{ url('/devices/create') }}" class="btn btn-primary mt-3">{{ __("Add Laser Device") }}</a>
        @endauth
    </div>
@endsection