@extends('backend.layouts.app')

@section('title', 'Blogs')

@section('content')

<livewire:backend.blog.comment blogId="{{ $blog->id }}" />

@endsection