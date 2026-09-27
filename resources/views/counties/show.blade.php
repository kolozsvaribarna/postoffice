@extends('layouts.app')

@section('title', $county->name)

@section('content')
    <h1>Megye adatai</h1>

    <div class="card">
        <h3>Név</h3>
        <h4>{{ $county->name }}</h4>

        <h3>Összlakosság</h3>
        <h4>{{ number_format($county->cities_sum_population ?? 0, 0, ',', ' ') }} fő</h4>

        <h3>Címer</h3>
        @if ($county->coat_of_arms_url)
            <img width="140" src="{{ $county->coat_of_arms_url }}" alt="coat of arms">
        @else
            <p style="color: #a4453a;">Nincs kép feltöltve.</p>
        @endif

        <p><a href="{{ route('counties.index') }}" class="button">← Vissza a listához</a></p>
    </div>
@endsection
