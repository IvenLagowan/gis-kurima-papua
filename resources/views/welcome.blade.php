@extends('layouts.app')
@push('style')
    @livewireStyles()
@endpush
@push('script')
    @livewireScripts()
@endpush
@section('content')
    @livewire('welcome')
@endsection