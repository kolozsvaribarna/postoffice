@extends('layouts.app')

@section('title', 'Megyék')

@section('content')
    <h1>Megyék 🗺️</h1>

    <div class="card">
        <form action="{{ route('counties.index') }}" method="get" class="search-bar">
            <input type="search" name="search" placeholder="Keresés név szerint..." value="{{ $search }}">
            <button type="submit">Keresés</button>
            @if ($search)
                <a href="{{ route('counties.index') }}" class="button" style="background:#999;">Törlés</a>
            @endif
            <span class="spacer"></span>
            <a href="{{ route('counties.create') }}" class="button">+ Új megye</a>
        </form>
    </div>

    @if ($counties->isEmpty())
        <p class="empty-state">Nincs találat.</p>
    @else
        <ul class="county-list">
            @foreach ($counties as $county)
                <li>
                    @if ($county->coat_of_arms_url)
                        <img width="70" src="{{ $county->coat_of_arms_url }}" alt="{{ $county->name }} címere">
                    @endif

                    <div>
                        <div class="county-name">{{ $county->name }}</div>
                        <div class="county-pop">Összlakosság: {{ number_format($county->cities_sum_population ?? 0, 0, ',', ' ') }} fő</div>
                    </div>

                    <span class="spacer"></span>

                    <a href="{{ route('counties.show', $county->id) }}" class="button">Megtekintés</a>
                    <a href="{{ route('counties.edit', $county->id) }}" class="button">Szerkesztés</a>
                    <form action="{{ route('counties.destroy', $county->id) }}" method="post" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button class="button delete" type="submit" onclick="return confirm('Biztosan törlöd?')">Törlés</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
