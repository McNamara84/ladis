@extends('layouts.app')

@section('title', 'Materialien')

@section('content')
    <div class="container">
        <h1 class="h3 mb-4">Alle Materialien</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Übergeordnetes Material</th>
                        @auth
                            <th>Aktionen</th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @forelse($materials as $material)
                        <tr class="table-primary fw-bold">
                            <td>{{ $material->id }}</td>
                            <td>
                                <a class="link-underline link-underline-opacity-0" href="{{ route('materials.show', $material) }}">
                                    {{ $material->name }}
                                </a>
                            </td>
                            <td>–</td>
                            @auth
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteMaterial{{ $material->id }}">
                                        Löschen
                                    </button>
                                    @component('components.delete-modal', [
                                        'modalId' => 'deleteMaterial' . $material->id,
                                        'title' => 'Material löschen',
                                        'message' => 'Soll das Material <strong>' . e($material->name) . '</strong> wirklich gelöscht werden?',
                                        'actionRoute' => route('materials.destroy', $material->id),
                                    ])
                                    @endcomponent
                                </td>
                            @endauth
                        </tr>
                        @foreach($material->children->sortBy('name') as $child)
                            <tr>
                                <td>{{ $child->id }}</td>
                                <td class="ps-4">
                                    &mdash;
                                    <a class="link-underline link-underline-opacity-0" href="{{ route('materials.show', $child) }}">
                                        {{ $child->name }}
                                    </a>
                                </td>
                                <td>
                                    <a class="link-underline link-underline-opacity-0" href="{{ route('materials.show', $material) }}">
                                        {{ $material->name }}
                                    </a>
                                </td>
                                @auth
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteMaterial{{ $child->id }}">
                                            Löschen
                                        </button>
                                        @component('components.delete-modal', [
                                            'modalId' => 'deleteMaterial' . $child->id,
                                            'title' => 'Material löschen',
                                            'message' => 'Soll das Material <strong>' . e($child->name) . '</strong> wirklich gelöscht werden?',
                                            'actionRoute' => route('materials.destroy', $child->id),
                                        ])
                                        @endcomponent
                                    </td>
                                @endauth
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="@auth 4 @else 3 @endauth">Keine Materialien vorhanden.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @auth
            <a href="{{ route('inputform_material.index') }}" class="btn btn-primary mt-3">Material hinzufügen</a>
        @endauth
    </div>
@endsection