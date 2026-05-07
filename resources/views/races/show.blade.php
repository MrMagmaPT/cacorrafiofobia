@extends('layouts.app')

@section('title', $race->name)

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <br>
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title dragon-text">{{ $race->name }}</h1>
                        <hr>

                        <p class="text-muted">Race Information</p>
                        <p><strong>ID:</strong> {{ $race->id }}</p>
                        <p><strong>Created:</strong> {{ $race->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Last Updated:</strong> {{ $race->updated_at->format('d/m/Y H:i') }}</p>
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
                        <form action="{{ route('races.destroy', $race) }}" method="POST" style="display: inline; width: 100%;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Are you sure you want to delete the race {{ $race->name }}?\n\nThis action cannot be undone.')">Delete Race</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
