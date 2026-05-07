@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
@include('categories.form', ['category' => $category, 'action' => route('categories.update', $category), 'method' => 'PUT', 'title' => 'Edit Category'])
@endsection
