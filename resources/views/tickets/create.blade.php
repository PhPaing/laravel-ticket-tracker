@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">New Ticket</h1>
    <form method="POST" action="{{ route('tickets.store') }}" class="bg-white p-3 p-md-4 rounded shadow-sm">
        @include('tickets._form')
    </form>
@endsection
