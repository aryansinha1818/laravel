@extends('layouts.app')

@section('title', 'Edit Tag')

@section('content')
@include('tags.form', ['tag' => $tag, 'action' => route('tags.update', $tag), 'method' => 'PUT', 'title' => 'Edit Tag'])
@endsection
