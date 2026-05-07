@extends('layouts.app')

@section('title', 'Create Tag')

@section('content')
@include('tags.form', ['tag' => null, 'action' => route('tags.store'), 'method' => 'POST', 'title' => 'Create Tag'])
@endsection
