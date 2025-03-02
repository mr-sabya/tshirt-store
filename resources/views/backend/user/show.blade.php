@extends('backend.layouts.app')

@section('title', 'User')

@section('content')

<livewire:backend.user.show userId="{{ $user->id }}" />

@endsection