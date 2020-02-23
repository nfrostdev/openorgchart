@extends('layouts.app')

@section('title', 'Site Settings')

@section('content')
    {{-- TODO: Tests for this route and its relevant models. --}}
    @include('includes.site-settings')

    @component('components.form')
        @slot('method', 'PATCH')
        @slot('action', route('settings.update'))
        @slot('submit_text', 'Save')

        @component('components.input')
            @slot('id', 'title')
            @slot('label', 'Site Title')
            @slot('type', 'text')
            @slot('value', env('SITE_TITLE', ''))
            @slot('required', true)
        @endcomponent

        @component('components.input')
            @slot('id', 'color')
            @slot('label', 'Site Color')
            @slot('type', 'color')
            @slot('value', env('SITE_COLOR', ''))
            @slot('required', true)
        @endcomponent

    @endcomponent
@endsection
