@extends('layouts.app')

@section('content')

    <div class="page-box">
        <h2 class="heading">Travel and Accommodation</h2>

        <p>Need somewhere to stop, or looking for things to do and make a weekend out of it? Check out our list here</p>

        <travel></travel>
    </div>
    </div>

@endsection

@section('scripts')
    <script src="https://maps.google.com/maps/api/js?key={{ config('services.google.map') }}"></script>
@endsection
