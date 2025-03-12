@extends('backend.layouts.app')

@section('title', 'Update Page')

@section('content')

<livewire:backend.page.edit pageId="{{ $page->id }}" />

@endsection