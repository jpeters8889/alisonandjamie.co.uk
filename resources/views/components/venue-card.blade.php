@props(['title', 'location', 'time', 'lat', 'lng', 'address'])

<div class="flex flex-col bg-gray-200 rounded shadow p-2">
    <div class="text-center">
        <h2 class="heading">{{ $title }}</h2>
        <div class="flex flex-col md:flex-row space-x-4 mx-auto w-full md:justify-center md:items-center mb-2">
            <h3 class="font-headline text-base">{{ $location }}</h3>
            <h3 class="font-headline text-sm md:text-base">{{ $time }}</h3>
        </div>
    </div>

    <div class="flex flex-col md:flex-row md:space-x-2">
        <div>
            <p>
                {!! $slot !!}
            </p>
        </div>

        <div class="flex flex-col md:w-1/2">
            <div class="w-full mx-auto">
                <google-map :lat="{{ $lat }}" :lng="{{ $lng }}"></google-map>
            </div>

            <p class="text-xxs mt-1">{{ $address }}</p>
            <p class="text-xxs -mt-2 font-semibold hover:underline">
                <a href="https://www.google.com/maps/search/{{ $lat }},{{ $lng }}" target="_blank">
                    View on Google
                </a>
            </p>
        </div>
    </div>
</div>
