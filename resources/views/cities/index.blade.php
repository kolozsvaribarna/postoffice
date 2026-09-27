@extends('layouts.app')

@section('title', 'Városok')

@section('content')
    <h1>Városok 🏘️</h1>

    <div class="card">
        <form action="{{ route('cities.index') }}" method="get" class="search-bar">
            <input type="search" name="search" placeholder="Keresés név szerint..." value="{{ $search }}">

            <select name="county_id">
                <option value="">Összes megye</option>
                @foreach ($counties as $county)
                    <option value="{{ $county->id }}" @selected((string) $countyId === (string) $county->id)>{{ $county->name }}</option>
                @endforeach
            </select>

            <button type="submit">Szűrés</button>
            @if ($search || $countyId)
                <a href="{{ route('cities.index') }}" class="button" style="background:#999;">Törlés</a>
            @endif
            <span class="spacer"></span>
            <a href="{{ route('cities.create') }}" class="button">+ Új város</a>
        </form>
    </div>

    @if ($cities->isEmpty())
        <p class="empty-state">Nincs találat.</p>
    @else
        <table>
            <tr>
                <th>Név</th>
                <th>Irányítószám</th>
                <th>Népesség</th>
                <th>Megye</th>
                <th></th>
            </tr>
            @foreach ($cities as $city)
                <tr>
                    <td>{{ $city->name }}</td>
                    <td>{{ $city->zip_code }}</td>
                    <td>{{ number_format($city->population, 0, ',', ' ') }}</td>
                    <td>{{ $city->county->name ?? '' }}</td>
                    <td>
                        <a href="{{ route('cities.show', $city->id) }}" class="button">Megtekintés</a>
                        <a href="{{ route('cities.edit', $city->id) }}" class="button">Szerkesztés</a>
                        <form action="{{ route('cities.destroy', $city->id) }}" method="post" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button class="button delete" type="submit" onclick="return confirm('Biztosan törlöd?')">Törlés</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        <div class="pagination">
            {{ $cities->links('pagination::bootstrap-4') }}
        </div>
    @endif
@endsection
