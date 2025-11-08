@extends('layouts.app')

@section('title', 'SportHub - Criar Local')

@section('content')
    <x-header title="Criar Local" />
    <main class="px-4 py-6 bg-white rounded-2xl shadow-md">
        @include('locais._form')
    </main>
@endsection

@push('scripts')
    @include('locais.partials.scripts-locais')
@endpush
