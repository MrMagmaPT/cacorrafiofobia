@extends('layouts.app')

@section('title', $playerClass->name)

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <br>
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title dragon-text">{{ $playerClass->name }}</h1>
                        <hr>
                        <p class="text-muted">Class Information</p>
                        <p><strong>ID:</strong> {{ $playerClass->id }}</p>
                        <p><strong>Created:</strong> {{ $playerClass->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Last Updated:</strong> {{ $playerClass->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <br>
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Actions</h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-block mb-2">Dashboard</a>
                        <form action="{{ route('classes.destroy', $playerClass) }}" method="POST" style="display: inline; width: 100%;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Are you sure you want to delete the class {{ $playerClass->name }}?\n\nThis action cannot be undone.')">Delete Class</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
