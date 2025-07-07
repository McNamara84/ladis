@extends('layouts.app')

@section('title', '{{ __("User Management") }}')

@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center mb-3">
            <div class="col">
                <h1 class="h3 mb-0">{{ __("User Management") }}</h1>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ __("ID") }}</th>
                        <th>{{ __("Name") }}</th>
                        <th>{{ __("E-Mail") }}</th>
                        <th>{{ __("Created On") }}</th>
                        <th>{{ __("Actions") }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d.m.Y H:i') }}</td>
                        <td>
                            @if ($user->id !== 1)
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteUser{{ $user->id }}">
                                    {{ __("Delete") }}
                                </button>
                                <div class="modal fade" id="deleteUser{{ $user->id }}" tabindex="-1" aria-labelledby="deleteUser{{ $user->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteUser{{ $user->id }}Label">{{ __("Delete Account") }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __("Close") }}"></button>
                                            </div>
                                            <div class="modal-body">
                                                {!! __("messages.b00", ["userName" => $user->name]) !!}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("Cancel") }}</button>
                                                <form method="POST" action="{{ route('user-management.destroy', $user->id) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">{{ __("Delete") }}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-auto text-center">
            <a href="{{ route('user-management.create') }}" class="btn btn-primary">{{ __("Create New Account") }}</a>
        </div>
    </div>
@endsection