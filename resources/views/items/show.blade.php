@extends('layouts.app')

@section('title', 'Item - ' . $item->i_name)

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">{{ $item->i_name }}</h1>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Type:</strong> {{ $item->type }}</p>
                                <p><strong>Tier:</strong> {{ $item->tier }}</p>
                                <p><strong>Price:</strong> {{ $item->price }} gold</p>
                                <p><strong>Size:</strong> {{ $item->size }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Bonus:</strong> {{ $item->bonus }}</p>
                            </div>
                        </div>

                        <h5 class="mt-4">Description</h5>
                        <p>{{ $item->i_desc }}</p>

                        @if($item->image)
                            <div class="mt-4">
                                <h5>Item Image</h5>
                                <img src="{{ $item->image }}" alt="{{ $item->i_name }}" style="max-width: 300px; border-radius: 8px;">
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Actions</h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('items.index') }}" class="btn btn-secondary btn-block mb-2">Back to Items</a>
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-block">Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
