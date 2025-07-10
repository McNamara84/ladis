@extends('layouts.page.default')

@section('title', __('Über Projekt LADIS'))

@section('excerpt')
    <p>
        <span class="fst-italic">{{ __("messages.o00") }}</span><br>
        {{ __("messages.o01") }}<br>
    </p>
@endsection

@section('page-content')
    <div class="flow">
        <h2>{{ __("About The Project") }}</h2>
        <div class="row">
            <div class="col-lg-8">
                <p>{!! __("messages.o02", [
                    "link0" => url('https://www.dbu.de'),
                    "link1" => url('https://www.kulturstiftung-st.de')]) !!}</p>
                <p>{!! __("messages.o03") !!}</p>
                <p>{!! __("messages.o04", [
                    "link" => url('https://www.fh-potsdam.de/studium-weiterbildung/studiengaenge/konservierung-und-restaurierung-ba')]) !!}</p>
            </div>
            <div class="col-lg-4">
                <figure class="figure">
                    <img class="img-fluid rounded-circle"
                        srcset="/images/ladis-illustration-01-400w.webp 400w, /images/ladis-illustration-01-600w.webp 600w, /images/ladis-illustration-01-800w.webp 800w, /images/ladis-illustration-01-1000w.webp 1000w, /images/ladis-illustration-01-1200w.webp 1200w, /images/ladis-illustration-01-1600w.webp 1600w, /images/ladis-illustration-01-2000w.webp 2000w"
                        sizes="(max-width: 400px) 400px, (max-width: 600px) 600px, (max-width: 800px) 800px, (max-width: 1000px) 1000px, (max-width: 1200px) 1200px, (max-width: 1600px) 1600px, (min-width: 1601px) 2000px"
                        src="/images/ladis-illustration.jpg" alt="" width="2881" height="2815" />
                    <figcaption class="figure-caption text-center">{{ __("A Picture in Monochrome") }}Ein Bild in schwarz/weiß</figcaption>
                </figure>

            </div>
        </div>

        <h2>{{ __("The Database") }}</h2>
        <p>{!! __("messages.o05") !!}}</p>
        <p>{!! __("messages.o06") !!}</p>
        <p>{!! __("messages.o07", [
            "link" => url('https://www.fh-potsdam.de/studium-weiterbildung/fachbereiche/fachbereich-informationswissenschaften')]) !!}</p>

        <h2>{{ __("Project Board and Cooperation Partners") }}</h2>
        <dl class="row">
            <dt class="col-sm-4">{{ __("messages.o08") }}</dt>
            <dd class="col-sm-8">{{ __("messages.o09") }}</dd>
            <dt class="col-sm-4">{{ __("messages.o10") }}</dt>
            <dd class="col-sm-8">{{ __("messages.o11") }}</dd>
            <dt class="col-sm-4">{{ __("messages.o12") }}</dt>
            <dd class="col-sm-8">{{ __("messages.o13") }}</dd>
            <dt class="col-sm-4">{{ __("messages.o14") }}
            </dt>
            <dd class="col-sm-8">{{ __("messages.o15") }}</dd>
            <dt class="col-sm-4">{{ __("messages.o16") }}</dt>
            <dd class="col-sm-8">{{ __("messages.o17") }}</dd>
            <dt class="col-sm-4">{{ __("messages.o18") }}</dt>
            <dd class="col-sm-8">{{ __("messages.o19") }}
            </dd>
        </dl>
    </div>
@endsection
