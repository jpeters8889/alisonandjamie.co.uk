@extends('layouts.app')

@section('content')

    <div class="page-box">
        <h2 class="heading">Venues and Schedule</h2>

        <p>
            Our day is spread over 3 main venues starting at midday! Due to limitations on numbers at each venue your
            invitation will confirm which venues you are invited to.
        </p>

        <div class="flex flex-col space-y-3">
            <x-venue-card
                title="Wedding Ceremony"
                location="Crewe Municipal Buildings"
                time="12pm"
                lat="53.0984322"
                lng="-2.4394894"
                address="Earle St, Crewe CW1 2BJ">
                The main ceremony will be held in the Mayor's Parlour, Crewe Municipal Buildings.
            </x-venue-card>

            <x-venue-card
                title="Afternoon Reception"
                location="Cheshire Cat, Nantwich"
                time="3pm - 7pm"
                lat="53.0677436"
                lng="-2.5259287"
                address="26 Welsh Row, Nantwich CW5 5ED">
                A few of us will be having lunch and drinks at the Cheshire Cat in Nantwich between the ceremony and
                evening reception.<br/>
                <br/>
                <em>(This is also where the bridal party will be before the wedding!)</em>
            </x-venue-card>

            <x-venue-card
                title="Evening Reception"
                location="Nantwich Town Football Club"
                time="7.30pm - 12am"
                lat="53.0722095"
                lng="-2.5281136"
                address="The Weaver Stadium, Water-Lode, Nantwich CW5 5BS">
                Party Time!<br/>
                <br/>
                Come join us in our concert / music themed evening reception, featuring live music from
                <a href="https://funtimefrankies.co.uk/" target="_blank" class="font-semibold hover:underline">The
                    Funtime Frankies</a>!
            </x-venue-card>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://maps.google.com/maps/api/js?key={{ config('services.google.map') }}"></script>
@endsection
