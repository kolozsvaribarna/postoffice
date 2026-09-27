@extends('layouts.app')

@section('title', 'Város szerkesztése')

@section('content')
    <h1>Város szerkesztése</h1>

    <div class="card">
        <form action="{{ route('cities.update', $city->id) }}" method="post">
            @csrf
            @method('PUT')
            <fieldset>
                <div>
                    <label for="name">Név</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $city->name) }}">
                </div>
                <div>
                    <label for="zip_code">Irányítószám</label>
                    <input type="number" min="1" max="9999" step="1" name="zip_code" id="zip_code" value="{{ old('zip_code', $city->zip_code) }}">
                </div>
                <div>
                    <label for="population">Népesség</label>
                    <input type="number" min="1" step="1" name="population" id="population" value="{{ old('population', $city->population) }}">
                </div>
                <div>
                    <label for="county_id">Megye</label>
                    <select name="county_id" id="county_id">
                        @foreach ($counties as $county)
                            <option value="{{ $county->id }}" @selected(old('county_id', $city->county_id) == $county->id)>{{ $county->name }}</option>
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
