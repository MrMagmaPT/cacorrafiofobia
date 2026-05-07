@extends('layouts.app')

@section('title', $character->u_name)

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <br>
                <div class="card character-card">
                    <div class="card-body">
                        <h1 class="card-title dragon-text">{{ $character->u_name }}</h1>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Age:</strong> {{ $character->u_age }}</p>
                                <p><strong>Level:</strong> {{ $character->LVL }}</p>
                                <p><strong>Race:</strong> {{ $character->race->name ?? 'N/A' }}</p>
                                @if($character->subRace)
                                    <p><strong>Sub-Race:</strong> {{ $character->subRace->name }}</p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <p><strong>Class:</strong> {{ $character->playerClass->name ?? 'N/A' }}</p>
                                @if($character->subClass)
                                    <p><strong>Sub-Class:</strong> {{ $character->subClass->name }}</p>
                                @endif
                                <p><strong>Alignment:</strong> {{ $character->aligment }}</p>
                                <p><strong>Money:</strong> {{ $character->money }} gold</p>
                            </div>
                        </div>

                        <h5 class="mt-4">Combat Stats</h5>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="stat-box">
                                    <div class="stat-label">HP</div>
                                    <div class="stat-value">{{ $character->hp }}</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-box">
                                    <div class="stat-label">Mana</div>
                                    <div class="stat-value">{{ $character->stats->mana ?? 'N/A' }}</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-box">
                                    <div class="stat-label">Defence</div>
                                    <div class="stat-value">{{ $character->stats->defence ?? 'N/A' }}</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-box">
                                    <div class="stat-label">Magic</div>
                                    <div class="stat-value">{{ $character->stats->magic ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-4">Attributes</h5>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="stat-box">
                                    <div class="stat-label">Inte</div>
                                    <div class="stat-value">{{ $character->stats->Inte ?? 'N/A' }}</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-box">
                                    <div class="stat-label">Ma</div>
                                    <div class="stat-value">{{ $character->stats->Ma ?? 'N/A' }}</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-box">
                                    <div class="stat-label">Uc</div>
                                    <div class="stat-value">{{ $character->stats->Uc ?? 'N/A' }}</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-box">
                                    <div class="stat-label">Lu</div>
                                    <div class="stat-value">{{ $character->stats->Lu ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-3">
                                <div class="stat-box">
                                    <div class="stat-label">Com</div>
                                    <div class="stat-value">{{ $character->stats->Com ?? 'N/A' }}</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-box">
                                    <div class="stat-label">Agi</div>
                                    <div class="stat-value">{{ $character->stats->Agi ?? 'N/A' }}</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-box">
                                    <div class="stat-label">Str</div>
                                    <div class="stat-value">{{ $character->stats->Str ?? 'N/A' }}</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-box">
                                    <div class="stat-label">Md</div>
                                    <div class="stat-value">{{ $character->stats->Md ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-3">
                                <div class="stat-box">
                                    <div class="stat-label">Con</div>
                                    <div class="stat-value">{{ $character->stats->Con ?? 'N/A' }}</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-box">
                                    <div class="stat-label">Res</div>
                                    <div class="stat-value">{{ $character->stats->Res ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
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
                        <form action="{{ route('characters.destroy', $character) }}" method="POST" style="display: inline; width: 100%;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Are you sure you want to delete {{ $character->u_name }}?\n\nThis action cannot be undone. Associated stats will also be deleted.')">Delete Character</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
