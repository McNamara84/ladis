@extends('layouts.page.default')

@section('title', 'Kontakt')

@section('page-content')
    <div class="flow">
        <address>
            <span class="fw-bold">{{ config('site_info.contact_fhp.name') }}<br>
                {{ config('site_info.contact_fhp.name_adjunct') }}</span><br>
            {{ config('site_info.contact_fhp.street') }}<br>
            {{ config('site_info.contact_fhp.postal_code') }} {{ config('site_info.contact_fhp.city') }}<br>
            <br>
            <span class="fw-bold">Telefon:</span><a
                href="tel:{{ config('site_info.contact_fhp.phone') }}">{{ config('site_info.contact_fhp.phone') }}</a><br>
            <span class="fw-bold">Fax: </span>{{ config('site_info.contact_fhp.fax') }}<br>
            <span class="fw-bold">E-Mail: </span><a
                href="mailto:{{ config('site_info.contact_fhp.email') }}">{{ config('site_info.contact_fhp.email') }}</a><br>
            <span class="fw-bold">Webseite: </span><a
                href="{{ config('site_info.contact_fhp.website') }}">{{ config('site_info.contact_fhp.website') }}</a><br>
        </address>
    </div>
@endsection
