<template>
    <div>
        <div class="flex leading-none">
            <div
                class="heading text-center hover:bg-gray-500 cursor-pointer transition-bg p-3 cursor-pointer rounded-l-xl pb-2"
                :class="show === 'hotels' ? 'bg-gray-100 border border-gray-300' : 'bg-gray-300 border-0'"
                @click="show = 'hotels'">
                Hotels
            </div>

            <div
                class="heading text-center hover:bg-gray-500 cursor-pointer transition-bg p-3 cursor-pointer pb-2"
                :class="show === 'trains' ? 'bg-gray-100 border border-gray-300' : 'bg-gray-300 border-0'"
                @click="show = 'trains'">
                Trains
            </div>

            <div
                class="heading text-center hover:bg-gray-500 cursor-pointer transition-bg p-3 cursor-pointer pb-2"
                :class="show === 'taxi' ? 'bg-gray-100 border border-gray-300' : 'bg-gray-300 border-0'"
                @click="show = 'taxi'">
                Taxis
            </div>

            <div
                class="heading text-center hover:bg-gray-500 cursor-pointer transition-bg p-3 cursor-pointer pb-2 rounded-r-xl"
                :class="show === 'see' ? 'bg-gray-100 border border-gray-300' : 'bg-gray-300 border-0'"
                @click="show = 'see'">
                Things to see
            </div>

<!--            <div-->
<!--                class="heading text-center hover:bg-gray-500 cursor-pointer transition-bg p-3 cursor-pointer pb-2 rounded-r-xl"-->
<!--                :class="show === 'eat' ? 'bg-gray-100 border border-gray-300' : 'bg-gray-300 border-0'"-->
<!--                @click="show = 'eat'">-->
<!--                Places to eat-->
<!--            </div>-->
        </div>

        <div>
            <div class="flex flex-col space-y-3">
                <div class="flex flex-col bg-gray-200 rounded shadow p-2" v-for="place in places">
                    <h2 class="heading">{{ place.name }}</h2>
                    <google-map v-if="place.lat" :lat="place.lat" :lng="place.lng"></google-map>
                    <p class="text-xs" v-if="place.address">{{ place.address }}</p>

                    <p v-html="place.text" v-if="place.text"></p>
                    <p v-if="place.website">
                        <a class="font-semibold hover:underline" :href="place.website" target="_blank">
                            {{ place.websiteLabel }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        show: 'hotels',

        hotels: [
            {
                name: 'Cheshire Cat, Nantwich',
                text: 'Ideally situated for the afternoon and evening receptions, and where the bridal party will be stopping the night before the wedding.',
                lat: 53.0677436,
                lng: -2.5259287,
                address: '26 Welsh Row, Nantwich CW5 5ED',
                website: 'https://cheshirecatnantwich.co.uk/',
                websiteLabel: 'www.cheshirecatnantwich.co.uk',
            },
            {
                name: 'Crown Hotel, Bar and Grill',
                text: 'Located in the center of Nantwich, less than 10 minutes walk from Nantwich Football Club for the evening reception.',
                lat: 53.0673653,
                lng: -2.5229477,
                address: 'High St, Nantwich CW5 5AS',
                website: 'http://crownhotelnantwich.com/accommodation-in-nantwich//',
                websiteLabel: 'www.crownhotelnantwich.com',
            },
            {
                name: 'The Railway Hotel, Nantwich',
                text: 'Located just outside the center of Nantwich, by the train station, less than 15 minutes walk or a 2 minute drive from Nantwich Football Club for the evening reception.',
                lat: 53.0642679,
                lng: -2.5197553,
                address: 'Pillory St, Nantwich CW5 5SS',
                website: 'http://www.railway-hotel.org/rooms/',
                websiteLabel: 'www.railway-hotel.org',
            },
            {
                name: 'Premier Inn, Nantwich',
                text: 'Just outside of Nantwich and 10 minutes drive from the ceremony venue and only 5 minutes drive from the afternoon and evening venues.',
                lat: 53.06956,
                lng: -2.49476,
                address: '221 Crewe Rd, Crewe, Willaston, Nantwich CW5 6NE',
                website: 'https://www.premierinn.com/gb/en/hotels/england/cheshire/crewe/crewe-nantwich.html?ARRdd=11&ARRmm=09&ARRyyyy=2021&NIGHTS=1&ROOMS=1&ADULT1=2&CHILD1=0&COT1=0&INTTYP1=DB&BRAND=PI',
                websiteLabel: 'www.premierinn.com',
            },
            {
                name: 'Premier Inn, Crewe (Central)',
                text: 'Located a few minutes walk from Crewe Train Station, and less than 5 minutes drive to the ceremony venue and 15 minutes from the afternoon and evening venues.',
                lat: 53.0877,
                lng: -2.42972,
                address: 'Coppenhall Ln, Crewe CW2 8SD',
                website: 'https://www.premierinn.com/gb/en/hotels/england/cheshire/crewe/crewe-west.html?ARRdd=11&ARRmm=09&ARRyyyy=2021&NIGHTS=1&ROOMS=1&ADULT1=2&CHILD1=0&COT1=0&INTTYP1=DB&BRAND=PI',
                websiteLabel: 'www.premierinn.com',
            },
            {
                name: 'Premier Inn, Crewe (West)',
                text: 'Located on the outskirts of Crewe, 7 minutes drive from the ceremony venue and 10 minutes from the afternoon an evening venues.',
                lat: 53.09574,
                lng: -2.48503,
                address: 'Weston Rd, Crewe CW1 6FX',
                website: 'https://www.premierinn.com/gb/en/hotels/england/cheshire/crewe/crewe-central.html?ARRdd=11&ARRmm=09&ARRyyyy=2021&NIGHTS=1&ROOMS=1&ADULT1=2&CHILD1=0&COT1=0&INTTYP1=DB&BRAND=PI',
                websiteLabel: 'www.premierinn.com',
            },
            {
                name: 'Best Western, Crewe (Crewe Arms Hotel)',
                text: 'Located across the road from Crewe Train Station, less than 5 minutes drive from the ceremony venue and 15 minutes from the afternoon and evening venues.',
                lat: 53.09015,
                lng: -2.43259,
                address: 'Nantwich Rd, Crewe CW2 6DN',
                website: 'https://www.bestwestern.co.uk/hotels/best-western-crewe-arms-hotel-83984/in-2021-09-11/out-2021-09-12/adults-2/children-0/rooms-1',
                websiteLabel: 'www.bestwestern.co.uk',
            },
            {
                name: 'Travelodge Crewe',
                text: 'Just outside the center of Crewe and 15 minutes from J16 and J17 of the M6, less than 5 minutes drive to the ceremony venue and just over 10 minutes drive to the afternoon and evening venues.',
                lat: 53.0926,
                lng: -2.41431,
                address: 'Beswick Dr, Crewe CW1 5NP',
                website: 'https://www.travelodge.co.uk/search/results?location=Crewe+Travelodge&lat=&long=&action=hotel_amend&checkIn=11%2F09%2F21&checkOut=12%2F09%2F21&rooms%5B0%5D%5Badults%5D=2&rooms%5B0%5D%5Bchildren%5D=0',
                websiteLabel: 'www.travelodge.co.uk',
            },
            {
                name: 'Ibis Crewe',
                text: 'Just outside the center of Crewe and 15 minutes from J16 and J17 of the M6, less than 5 minutes drive to the ceremony venue and just over 10 minutes drive to the afternoon and evening venues.',
                lat: 53.09189,
                lng: -2.41958,
                address: 'Emperor Way, Crewe Business Park, Crewe CW1 6BD',
                website: 'https://all.accor.com/ssr/app/accor/rates/9548/index.en.shtml?dateIn=2021-09-11&nights=1&compositions=2&stayplus=false',
                websiteLabel: 'www.accor.com',
            },
            {
                name: 'Holiday Inn Crewe',
                text: 'Just outside the center of Crewe, and a few minutes walk from the train station, only a couple of minutes drive to the ceremony venue and just over 10 minutes drive to the afternoon and evening venues.',
                lat: 53.09205,
                lng: -2.4302,
                address: 'Macon Way, Crewe CW1 6DR',
                website: 'https://www.hiexpress.com/hotels/gb/en/find-hotels/hotel/rates?qDest=Macon%20Way,%20Crewe,%20GB&qCiMy=82021&qCiD=11&qCoMy=82021&qCoD=12&qAdlt=2&qChld=0&qRms=1&qRtP=6CBARC&qIta=99618783&qSlH=MANUK&qSlRc=CSTN&qAkamaiCC=GB&qSrt=sBR&qBrs=re.ic.in.vn.cp.vx.hi.ex.rs.cv.sb.cw.ma.ul.ki.va.ii.sp.nd.ct.sx&qWch=0&qSmP=1&cm_mmc=hpa_GB_desktop_MANUK_mapresults_1_GBP_2021-09-11_selected_2088121383_&setPMCookies=true&glat=META_hpa_GB_desktop_MANUK_mapresults_1_GBP_2021-09-11_selected_2088121383_&qRad=30&qRdU=mi&srb_u=1&qSHBrC=EX&icdv=99618783',
                websiteLabel: 'www.hiexpress.com',
            },
        ],

        trains: [
            {
                name: 'Crewe Railway Station',
                text: 'Major railway hub with direct trains to and from Manchester, Birmingham, London, Scotland, Derby and more.<br/><br/>From South Yorkshire get a train to Stockport and then a direct train to Crewe.<br/><br/>3 hotels within a few minutes walk, 10 minutes walk from the ceremony venue.',
                lat: 53.0895645,
                lng: -2.4336543,
                address: 'Nantwich Rd, Crewe CW2 6HR',
            },
            {
                name: 'Nantwich Railway Station',
                text: 'Local Railway station with up to one train per hour from Manchester/Stockport and one train per hour from Crewe.<br/><br/>Couple of hotels within walking distance and 15 minutes walk to the evening reception venue.',
                lat: 53.0637811,
                lng: -2.5192545,
                address: 'Pillory Street, Nantwich CW5 5SS',
            }
        ],

        taxi: [
            {
                name: 'Westside Taxis, Crewe',
                text: '01270 211222'
            },
            {
                name: 'Abbey Taxis, Crewe',
                text: '01270 212125'
            },
        ],

        see: [
            {
                name: 'Crewe Heritage Centre',
                text: 'Located in the center of Crewe, a railway museum with vintage trains and a model railway.',
                lat: 53.0938484,
                lng: -2.4360897,
                address: 'Vernon Way, Crewe CW1 2DB',
                website: 'https://www.crewehc.co.uk',
                websiteLabel: 'www.crewehc.co.uk',
            },
            {
                name: 'Queens Park, Crewe',
                text: 'Large park in Crewe, lots of greenery, paths for walking, large lake with lots of waterfowl swan boats to hire, cafe and childrens play equipment,',
                lat: 53.0969288,
                lng: -2.4685341,
                address: 'Victoria Ave, Crewe CW2 7SJ',
            },
            {
                name: 'Nantwich Nuclear Bunker',
                text: 'A former government owned nuclear bunker and once part of the official secrets act.',
                lat: 53.0271108,
                lng: -2.5305562,
                address: 'French Ln, Nantwich CW5 8BL',
                website: 'https://hackgreen.co.uk/',
                websiteLabel: 'www.hackgreen.co.uk',
            },
            {
                name: 'Cheshire Ice Cream Farm',
                text: 'A large dairy farm with indoor and outdoor play equipment for kids, mini golf, tractor rides and more, ice cream cafe with every flavour imaginable and a normal cafe with hot food and drinks',
                lat: 53.1325698,
                lng: -2.7514232,
                address: 'Drumlan Hall, Newton Ln, Cheshire, Chester CH3 9NE',
                website: 'https://theicecreamfarm.co.uk',
                websiteLabel: 'www.theicecreamfarm.co.uk',
            },
        ]
    }),

    computed: {
        places() {
            if (this[this.show]) {
                return this[this.show];
            }

            return [];
        }
    }
}
</script>
