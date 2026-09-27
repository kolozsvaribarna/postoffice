@extends('layouts.app')

@section('title', 'Új megye')

@section('content')
    <h2>Új megye</h2>

    <div class="card">
        <form action="{{ route('counties.store') }}" method="POST">
            @csrf
            <fieldset>
                <div>
                    <label for="name">Név</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}">
                </div>
                <div>
                    <label for="coat_of_arms_url">Címer link</label>
                    <input type="url" name="coat_of_arms_url" id="coat_of_arms_url" value="{{ old('coat_of_arms_url') }}">
                </div>
                <div>
                    <button type="submit">Mentés</button>
                    <a href="{{ route('counties.index') }}" class="button" style="background:#999;">Mégse</a>
                </div>
            </fieldset>
        </form>
    </div>
@endsection
