@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">Edit Ticket</h1>
    <form method="POST" action="{{ route('tickets.update', $ticket) }}" class="bg-white p-3 p-md-4 rounded shadow-sm">
        @method('PUT')
        @include('tickets._form')
    </form>
@endsection
