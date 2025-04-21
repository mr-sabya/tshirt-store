@extends('backend.layouts.app')

@section('title', 'Blogs')

@section('content')

<livewire:backend.blog.manage blogId="{{ $blog->id }}" />

@endsection