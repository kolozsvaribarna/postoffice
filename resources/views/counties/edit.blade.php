@extends('layouts.app')

@section('title', 'Megye szerkesztése')

@section('content')
    <h1>Megye szerkesztése</h1>

    <div class="card">
        <form action="{{ route('counties.update', $county->id) }}" method="post">
            @csrf
            @method('PUT')
            <fieldset>
                <div>
                    <label for="name">Név</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $county->name) }}">
                </div>
                <div>
                    <label for="coat_of_arms_url">Címer url</label>
                    <input type="text" name="coat_of_arms_url" id="coat_of_arms_url" value="{{ old('coat_of_arms_url', $county->coat_of_arms_url) }}">
                </div>
                <div>
                    <button type="submit">Mentés</button>
                    <a href="{{ route('counties.index') }}" class="button" style="background:#999;">Mégse</a>
                </div>
            </fieldset>
        </form>
    </div>
@endsection
