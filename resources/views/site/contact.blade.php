@extends('layouts.page.default')

@section('title', 'Kontakt')

@section('page-content')
    <div class="flow">
        <x-contact :contact="config('site_info.contact_fhp')" />
    </div>
@endsection
