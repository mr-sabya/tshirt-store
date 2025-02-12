@extends('backend.layouts.app')

@section('title', 'Leads')

@section('content')

<livewire:backend.call-history.index leadId="{{ $lead->id }}" />

@endsection