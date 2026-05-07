@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <br><br><br>
        <h1 class="title text-center"><b class="dragon-text">Dashboard</b></h1>

        <!-- PLAYER CHARACTERS SECTION -->
        <div class="dashboard-section">
            <h2 class="section-title">Player Characters</h2>
            @if($characters->count() > 0)
                <div class="scrollable-row">
                    @foreach($characters as $character)
                        <a href="{{ route('characters.show', $character->id) }}" class="character-card-small" style="text-decoration: none; color: inherit;">
                            <!-- Image Placeholder -->
                            <div class="character-image-placeholder">
                                [Character Image]
                            </div>
                            <!-- Character Info -->
                            <div class="character-info">
                                <div class="name">{{ $character->u_name }}</div>
                                <div class="stat">
                                    <span>Race:</span>
                                    <span>{{ $character->race->name ?? 'N/A' }}</span>
                                </div>
                                <div class="stat">
                                    <span>Class:</span>
                                    <span>{{ $character->playerClass->name ?? 'N/A' }}</span>
                                </div>
                                <div class="stat">
                                    <span>HP:</span>
                                    <span>{{ $character->hp ?? 0 }}</span>
                                </div>
                                <div class="stat">
                                    <span>DEF:</span>
                                    <span>{{ $character->stats->defence ?? 0 }}</span>
                                </div>
                                <div class="stat">
                                    <span>Magic:</span>
                                    <span>{{ $character->stats->magic ?? 0 }}</span>
                                </div>
                                <div class="stat">
                                    <span>Mana:</span>
                                    <span>{{ $character->stats->mana ?? 0 }}</span>
                                </div>

                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="empty-banner">
                    No registered characters yet.
                </div>
            @endif

            <div class="section-controls">
                <a href="{{ route('characters.create') }}" class="btn btn-primary">+ Create Character</a>
            </div>
        </div>

        <div class="section-divider"></div>

        <!-- CLASSES & RACES ROW -->
        <div class="row">
            <div class="col-md-6">
                <!-- CLASSES SECTION -->
                <div class="dashboard-section">
                    <h2 class="section-title">Classes</h2>

                    @if($classes->count() > 0)
                        <div class="card-grid">
                            @foreach($classes as $class)
                                <a href="{{ route('classes.show', $class->id) }}" class="grid-card" style="text-decoration: none; color: inherit;">
                                    <div class="grid-card-name">{{ $class->name }}</div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-banner">
                            No registered classes yet.
                        </div>
                    @endif

                    <div class="section-controls">
                        <a href="{{ route('classes.create') }}" class="btn btn-primary">+ Create Class</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <!-- RACES SECTION -->
                <div class="dashboard-section">
                    <h2 class="section-title">Races</h2>

                    @if($races->count() > 0)
                        <div class="card-grid">
                            @foreach($races as $race)
                                <a href="{{ route('races.show', $race->id) }}" class="grid-card" style="text-decoration: none; color: inherit;">
                                    <div class="grid-card-name">{{ $race->name }}</div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-banner">
                            No registered races yet.
                        </div>
                    @endif

                    <div class="section-controls">
                        <a href="{{ route('races.create') }}" class="btn btn-primary">+ Create Race</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-divider"></div>

        <!-- ITEMS & MARKET ROW -->
        <div class="row">
            <div class="col-md-6">
                <!-- ITEMS SECTION -->
                <div class="dashboard-section">
                    <h2 class="section-title">Items</h2>

                    @if($items->count() > 0)
                        <div class="card-grid">
                            @foreach($items as $item)
                                <a href="{{ route('items.show', $item->id) }}" class="grid-card" style="text-decoration: none; color: inherit;">
                                    <div class="grid-card-name">{{ $item->i_name }}</div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-banner">
                            No registered items yet.
                        </div>
                    @endif

                    <div class="section-controls">
                        <a href="#" class="btn btn-primary">+ Create Item</a>
                        <a href="#" class="btn btn-secondary">View All</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <!-- MARKET SECTION -->
                <div class="dashboard-section">
                    <h2 class="section-title">Market</h2>
                    <div class="wip-container">
                        <div class="wip-text dragon-text">WIP</div>
                    </div>

                    <div class="section-controls">
                        <a href="#" class="btn btn-primary">+ Create Listing</a>
                        <a href="#" class="btn btn-secondary">Check Listings</a>
                    </div>
                </div>
            </div>
        </div>

        <br><br>
    </div>
@endsection
