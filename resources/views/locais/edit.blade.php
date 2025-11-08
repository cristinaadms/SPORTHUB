@extends('layouts.app')

@section('title', 'SportHub - Editar Local')

@section('content')
    <x-header title="Editar Local" />
    <main class="px-4 py-6 bg-white rounded-2xl shadow-md">
        @include('locais._form', ['local' => $local])
    </main>
@endsection

@push('scripts')
    @include('locais.partials.scripts-locais')
@endpush
