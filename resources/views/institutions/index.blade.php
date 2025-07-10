@extends('layouts.app')

@section('title', __('Institutions'))

@section('content')
    <div class="container">
        <h1 class="h3 mb-4">{{ $pageTitle }}</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ __("ID") }}</th>
                        <th>{{ __("Name") }}</th>
                        <th>{{ __("Contact Information") }}</th>
                        @auth
                            <th>{{ __("Actions") }}</th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @forelse($institutions as $institution)
                        <tr>
                            <td>{{ $institution->id }}</td>
                            <td>{{ $institution->name }}</td>
                            <td>{!! nl2br(e($institution->contact_information)) !!}</td>
                            @auth
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteInstitution{{ $institution->id }}">
                                        {{ __("Delete") }}
                                    </button>
                                    <div class="modal fade" id="deleteInstitution{{ $institution->id }}" tabindex="-1" aria-labelledby="deleteInstitution{{ $institution->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteInstitution{{ $institution->id }}Label">{{ __("Delete Institution") }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! __("messages.l00", ["institutionName" => $institution->name]) !!}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("Cancel") }}</button>
                                                    <form method="POST" action="{{ route('institutions.destroy', $institution->id) }}" class="d-inline">
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
                            <td colspan="@auth 4 @else 3 @endauth">{{ __("No institutions available.") }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @auth
            <a href="{{ url('/institutions/create') }}" class="btn btn-primary mt-3">{{ __("Add Institution") }}</a>
        @endauth
    </div>
@endsection