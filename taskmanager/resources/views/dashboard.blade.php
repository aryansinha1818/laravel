@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page-heading">
    <h1>Dashboard</h1>
    <a class="btn btn-primary" href="{{ route('tasks.index') }}">Open Tasks</a>
</div>
@endsection
