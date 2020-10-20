@extends('layouts.app')

@section('header')
    <div class="w-full main-header px-2 py-8">
        <div class="w-full max-w-site mx-auto flex flex-col">
            <h1 class="font-punk text-center text-3xl">nice day for a white wedding</h1>

            <div
                class="flex flex-col font-headline text-center mt-4 sm:flex-row sm:space-x-4 sm:items-center sm:justify-center sm:mt-8">
                <h1 class="text-3xl">Alison Wheatley</h1>
                <h2>and</h2>
                <h1 class="text-3xl">Jamie Peters</h1>
            </div>

            <h2 class="font-headline text-center mt-4 text-2xl">
                Saturday 11th September 2021
            </h2>
        </div>
    </div>
@endsection

@section('content')

    <div class="page-box">
        <div class="text-center">
            <h2 class="heading">We can't wait to celebrate our special day with you!</h2>
            <h3 class="font-headline">
                <countdown></countdown>
            </h3>
        </div>
    </div>

    <div class="page-box">
        <our-story></our-story>
    </div>

@endsection
