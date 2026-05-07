@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
@include('categories.form', ['category' => null, 'action' => route('categories.store'), 'method' => 'POST', 'title' => 'Create Category'])
@endsection
