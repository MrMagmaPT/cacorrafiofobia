@extends('layouts.app')

@section('title', 'Characters')

@section('content')
    <!-- Character List -->
    <div class="container-fluid">
        <br><br><br>
        <div class="text-center mb-5">
            <h1 class="title"><b class="dragon-text">Characters</b></h1>
            <a href="{{ route('characters.create') }}" class="btn btn-primary mt-3">+ Create New Character</a>
        </div>

        @if($characters->count() > 0)
            <div class="row">
                @foreach($characters as $character)
                    <div class="col-md-4 mb-4">
                        <div class="card character-card h-100 shadow-sm">
                            <div class="card-body">
                                <!-- Character Header -->
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <h3 class="card-title dragon-text mb-1">{{ $character->u_name }}</h3>
                                        <p class="text-muted mb-0"><small>Level {{ $character->LVL }}</small></p>
                                    </div>
                                </div>

                                <hr>

                                <!-- Character Info -->
                                <div class="mb-3">
                                    <p class="mb-1"><strong>Age:</strong> {{ $character->u_age }}</p>
                                    <p class="mb-1"><strong>Race:</strong> {{ $character->race->name ?? 'N/A' }}</p>
                                    @if($character->subRace)
                                        <p class="mb-1"><strong>Sub-Race:</strong> {{ $character->subRace->name }}</p>
                                    @endif
                                    <p class="mb-1"><strong>Class:</strong> {{ $character->playerClass->name ?? 'N/A' }}</p>
                                    @if($character->subClass)
                                        <p class="mb-1"><strong>Sub-Class:</strong> {{ $character->subClass->name }}</p>
                                    @endif
                                    <p class="mb-0"><strong>Alignment:</strong> {{ $character->aligment ?? 'N/A' }}</p>
                                </div>

                                <hr>

                                <!-- Combat Stats -->
                                <div class="mb-3">
                                    <p class="text-muted mb-2"><small><strong>Combat Stats</strong></small></p>
                                    <div class="row text-center">
                                        <div class="col-4">
                                            <div class="stat-box-mini">
                                                <div class="stat-value-mini text-danger">{{ $character->hp }}</div>
                                                <div class="stat-label-mini"><small>HP</small></div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="stat-box-mini">
                                                <div class="stat-value-mini text-info">{{ $character->stats->mana ?? 0 }}</div>
                                                <div class="stat-label-mini"><small>Mana</small></div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="stat-box-mini">
                                                <div class="stat-value-mini text-warning">{{ $character->stats->defence ?? 0 }}</div>
                                                <div class="stat-label-mini"><small>DEF</small></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row text-center mt-2">
                                        <div class="col-4">
                                            <div class="stat-box-mini">
                                                <div class="stat-value-mini text-success">{{ $character->stats->magic ?? 0 }}</div>
                                                <div class="stat-label-mini"><small>Magic</small></div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="stat-box-mini">
                                                <div class="stat-value-mini text-secondary">{{ $character->money ?? 0 }}</div>
                                                <div class="stat-label-mini"><small>Gold</small></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <!-- Action Buttons -->
                                <div class="d-grid gap-2">
                                    <a href="{{ route('characters.show', $character) }}" class="btn btn-sm btn-info">View Details</a>
                                    <form action="{{ route('characters.destroy', $character) }}" method="POST" style="display: inline; width: 100%;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger w-100" onclick="return confirm('Are you sure you want to delete {{ $character->u_name }}?\n\nThis action cannot be undone.')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center" role="alert">
                <h4 class="alert-heading">No characters yet!</h4>
                <p>Start your adventure by creating your first character.</p>
                <a href="{{ route('characters.create') }}" class="btn btn-primary mt-3">Create Character</a>
            </div>
        @endif
    </div>

    <style>
        .stat-box-mini {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 8px;
        }

        .stat-value-mini {
            font-weight: bold;
            font-size: 1.2rem;
        }

        .stat-label-mini {
            color: #6c757d;
            margin-top: 4px;
        }

        .character-card {
            transition: transform 0.2s, box-shadow 0.2s;
            border: none;
        }

        .character-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.1) !important;
        }
    </style>
@endsection
