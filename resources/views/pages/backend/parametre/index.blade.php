@extends('layouts/layoutMaster')

@section('title', 'Paramètre - Page')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
    @vite(['resources/assets/vendor/libs/sweetalert2/sweetalert2.js'])
@endsection

<!-- Page Scripts -->
@section('page-script')
@endsection

@section('content')
    @livewire('Parametre.Index')
@endsection
