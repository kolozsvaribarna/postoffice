@extends('layouts.app')

@section('title', 'Új város')

@section('content')
    <h2>Új város</h2>

    <div class="card">
        <form action="{{ route('cities.store') }}" method="POST">
            @csrf
            <fieldset>
                <div>
                    <label for="name">Név</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}">
                </div>
                <div>
                    <label for="zip_code">Irányítószám</label>
                    <input type="number" min="1" max="9999" step="1" name="zip_code" id="zip_code" value="{{ old('zip_code') }}">
                </div>
                <div>
                    <label for="population">Népesség</label>
                    <input type="number" min="1" step="1" name="population" id="population" value="{{ old('population') }}">
                </div>
                <div>
                    <label for="county_id">Megye</label>
                    <select name="county_id" id="county_id">
                        @foreach ($counties as $county)
                            <option value="{{ $county->id }}" @selected(old('county_id') == $county->id)>{{ $county->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit">Mentés</button>
                    <a href="{{ route('cities.index') }}" class="button" style="background:#999;">Mégse</a>
                </div>
            </fieldset>
        </form>
    </div>
@endsection
