@extends('layouts.app')

@section('title', 'Create New Character')

@section('content')
    <div class="container mt-5 mb-5">
        <br><br><br>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="dragon-text mb-4">Create New Character</h1>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Oops! There were some errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('characters.store') }}" class="needs-validation">
                    @csrf
                    <!-- Character Basic Info Section -->
                    <div class="card mb-4">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0">Character Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="u_name" class="form-label fw-bold">Character Name</label>
                                    <input type="text" class="form-control @error('u_name') is-invalid @enderror"
                                           id="u_name" name="u_name" placeholder="Enter character name"
                                           value="{{ old('u_name') }}" required>
                                    @error('u_name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="u_age" class="form-label fw-bold">Age</label>
                                    <input type="number" class="form-control @error('u_age') is-invalid @enderror"
                                           id="u_age" name="u_age" placeholder="Enter age"
                                           value="{{ old('u_age') }}" required min="1">
                                    @error('u_age')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="LVL" class="form-label fw-bold">Level</label>
                                    <input type="number" class="form-control stat-input @error('LVL') is-invalid @enderror"
                                           id="LVL" name="LVL" placeholder="Enter level"
                                           value="{{ old('LVL') }}" required min="1" max="99">
                                    @error('LVL')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="hp" class="form-label fw-bold">Health Points (HP)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control bg-white"
                                               id="hp" name="hp" placeholder="0"
                                               value="{{ old('hp') }}" readonly step="0.01">
                                        <span class="input-group-text">Auto-Calculated</span>
                                    </div>
                                    <small class="form-text text-muted">Formula: 15 + (5 × (LVL - 1)) + ((CON + RES) / 2)</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="aligment" class="form-label fw-bold">Alignment</label>
                                    <select class="form-select @error('aligment') is-invalid @enderror"
                                            id="aligment" name="aligment">
                                        <option value="opt1" {{ old('aligment') == 'opt1' ? 'selected' : '' }}>Option 1</option>
                                        <option value="opt2" {{ old('aligment') == 'opt2' ? 'selected' : '' }}>Option 2</option>
                                        <option value="opt3" {{ old('aligment') == 'opt3' ? 'selected' : '' }}>Option 3</option>
                                    </select>
                                    @error('aligment')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="race_id" class="form-label fw-bold">Race *</label>
                                    <select class="form-select @error('race_id') is-invalid @enderror"
                                            id="race_id" name="race_id" required>
                                        @foreach($races as $race)
                                            <option value="{{ $race->id }}" {{ old('race_id') == $race->id ? 'selected' : '' }}>
                                                {{ $race->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('race_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="subrace_id" class="form-label fw-bold">Sub Race</label>
                                    <select class="form-select @error('subrace_id') is-invalid @enderror"
                                            id="subrace_id" name="subrace_id">
                                        <option value="">-- None (Optional) --</option>
                                        @foreach($races as $race)
                                            <option value="{{ $race->id }}" {{ old('subrace_id') == $race->id ? 'selected' : '' }}>
                                                {{ $race->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('subrace_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="money" class="form-label fw-bold">Starting Money</label>
                                    <input type="number" class="form-control @error('money') is-invalid @enderror"
                                           id="money" name="money" placeholder="0"
                                           value="{{ old('money') }}" min="0" step="0.01">
                                    @error('money')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="class_id" class="form-label fw-bold">Class *</label>
                                    <select class="form-select @error('class_id') is-invalid @enderror"
                                            id="class_id" name="class_id" required>
                                        @foreach($classes as $class)
                                            <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                                {{ $class->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('class_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="subclass_id" class="form-label fw-bold">Sub Class</label>
                                    <select class="form-select @error('subclass_id') is-invalid @enderror"
                                            id="subclass_id" name="subclass_id">
                                        <option value="">-- None (Optional) --</option>
                                        @foreach($classes as $class)
                                            <option value="{{ $class->id }}" {{ old('subclass_id') == $class->id ? 'selected' : '' }}>
                                                {{ $class->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('subclass_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Character Attributes Section -->
                    <div class="card mb-4">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0">Character Attributes</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="Inte" class="form-label fw-bold">Intelligence (Int)</label>
                                    <input type="number" class="form-control stat-input @error('Inte') is-invalid @enderror"
                                           id="Inte" name="Inte" placeholder="0"
                                           value="{{ old('Inte') }}" required min="0" step="1">
                                    @error('Inte')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="Ma" class="form-label fw-bold">Magical Afinity (Ma)</label>
                                    <input type="number" class="form-control stat-input @error('Ma') is-invalid @enderror"
                                           id="Ma" name="Ma" placeholder="0"
                                           value="{{ old('Ma') }}" required min="0" step="1">
                                    @error('Ma')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="Uc" class="form-label fw-bold">Understanding Customs (Uc)</label>
                                    <input type="number" class="form-control stat-input @error('Uc') is-invalid @enderror"
                                           id="Uc" name="Uc" placeholder="0"
                                           value="{{ old('Uc') }}" required min="0" step="1">
                                    @error('Uc')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="Lu" class="form-label fw-bold">Luck (Lu)</label>
                                    <input type="number" class="form-control stat-input @error('Lu') is-invalid @enderror"
                                           id="Lu" name="Lu" placeholder="0"
                                           value="{{ old('Lu') }}" required min="0" step="1">
                                    @error('Lu')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="Com" class="form-label fw-bold">Charisma (Com)</label>
                                    <input type="number" class="form-control stat-input @error('Com') is-invalid @enderror"
                                           id="Com" name="Com" placeholder="0"
                                           value="{{ old('Com') }}" required min="0" step="1">
                                    @error('Com')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="Agi" class="form-label fw-bold">Agility (Agi)</label>
                                    <input type="number" class="form-control stat-input @error('Agi') is-invalid @enderror"
                                           id="Agi" name="Agi" placeholder="0"
                                           value="{{ old('Agi') }}" required min="0" step="1">
                                    @error('Agi')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="Str" class="form-label fw-bold">Strength (Str)</label>
                                    <input type="number" class="form-control stat-input @error('Str') is-invalid @enderror"
                                           id="Str" name="Str" placeholder="0"
                                           value="{{ old('Str') }}" required min="0" step="1">
                                    @error('Str')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="Md" class="form-label fw-bold">Magical Defense (Md)</label>
                                    <input type="number" class="form-control stat-input @error('Md') is-invalid @enderror"
                                           id="Md" name="Md" placeholder="0"
                                           value="{{ old('Md') }}" required min="0" step="1">
                                    @error('Md')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="Con" class="form-label fw-bold">Constitution (Con)</label>
                                    <input type="number" class="form-control stat-input @error('Con') is-invalid @enderror"
                                           id="Con" name="Con" placeholder="0"
                                           value="{{ old('Con') }}" required min="0" step="1">
                                    @error('Con')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="Res" class="form-label fw-bold">Resistance (Res)</label>
                                    <input type="number" class="form-control stat-input @error('Res') is-invalid @enderror"
                                           id="Res" name="Res" placeholder="0"
                                           value="{{ old('Res') }}" required min="0" step="1">
                                    @error('Res')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Calculated Stats Section -->
                    <div class="card mb-4 bg-light">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0">Calculated Stats (Auto-Updated)</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="defence" class="form-label fw-bold">Defence</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control bg-white"
                                               id="defence" name="defence" placeholder="0"
                                               value="{{ old('defence') }}" readonly step="0.01">
                                        <span class="input-group-text">Formula: (Md + Str + Res) / 1.1</span>
                                    </div>
                                    <small class="form-text text-muted">Calculated from Mind + Strength + Resistance</small>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="magic" class="form-label fw-bold">Magic</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control bg-white"
                                               id="magic" name="magic" placeholder="0"
                                               value="{{ old('magic') }}" readonly step="0.01">
                                        <span class="input-group-text">Formula: (Ma + Int + Lu) / 1.1</span>
                                    </div>
                                    <small class="form-text text-muted">Calculated from Magic + Intelligence + Luck</small>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="mana" class="form-label fw-bold">Mana</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control bg-white"
                                               id="mana" name="mana" placeholder="0"
                                               value="{{ old('mana') }}" readonly step="0.01">
                                        <span class="input-group-text">Formula: Magic × 2.5</span>
                                    </div>
                                    <small class="form-text text-muted">Calculated from Magic stat</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="d-flex gap-2 mb-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save"></i> Create Character
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .stat-input {
            font-size: 1rem;
            padding: 0.75rem;
        }

        .card {
            border: 1px solid #dee2e6;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .card-header {
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
        }

        .form-label {
            margin-bottom: 0.5rem;
            color: #333;
        }

        .input-group-text {
            background-color: #e9ecef;
            border-color: #dee2e6;
            font-size: 0.85rem;
            white-space: nowrap;
        }

        @media (max-width: 768px) {
            .col-md-4 {
                margin-bottom: 1rem;
            }
        }
    </style>

    <script>
        // Function to calculate stats automatically
        function calculateStats() {
            const inte = parseFloat(document.getElementById('Inte').value) || 0;
            const ma = parseFloat(document.getElementById('Ma').value) || 0;
            const lu = parseFloat(document.getElementById('Lu').value) || 0;
            const str = parseFloat(document.getElementById('Str').value) || 0;
            const md = parseFloat(document.getElementById('Md').value) || 0;
            const res = parseFloat(document.getElementById('Res').value) || 0;
            const con = parseFloat(document.getElementById('Con').value) || 0;
            const lvl = parseFloat(document.getElementById('LVL').value) || 1;

            // Calculate Defence: (Md + Str + Res) / 1.1
            const defence = Math.floor((md + str + res) / 1.1);
            document.getElementById('defence').value = defence;

            // Calculate Magic: (Ma + Int + Lu) / 1.1
            const magic = Math.floor((ma + inte + lu) / 1.1);
            document.getElementById('magic').value = magic;

            // Calculate Mana: Magic x 2.5
            const mana = Math.floor(magic * 2.5);
            document.getElementById('mana').value = mana;

            // Calculate HP based on level
            // Level 1: 15 + ((CON + RES) / 2)
            // Level 2+: 15 + (5 × (LVL - 1)) + ((CON + RES) / 2)
            let hp;
            if (lvl === 1) {
                hp = 15 + ((con + res) / 2);
            } else {
                hp = 15 + (5 * (lvl - 1)) + ((con + res) / 2);
            }
            // Truncate decimals
            hp = Math.floor(hp);
            document.getElementById('hp').value = hp;
        }

        // Add event listeners to all stat inputs
        document.querySelectorAll('.stat-input').forEach(input => {
            input.addEventListener('input', calculateStats);
        });

        // Calculate stats on page load if old values exist
        document.addEventListener('DOMContentLoaded', calculateStats);
    </script>

@endsection
