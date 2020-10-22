<template>
    <div class="w-full">
        <div class="bg-gray-900 w-full">
            <div
                class="w-full max-w-site mx-auto flex justify-end items-center text-3xl leading-none p-2 text-white cursor-pointer relative lg:p-0">
                <div @click="showMobileNav = true" class="lg:hidden">
                    <span class="font-headline tracking-wider mr-4 leading-none pt-1">
                        Menu
                    </span>
                    <span>
                        <font-awesome-icon :icon="['fas', 'bars']"></font-awesome-icon>
                    </span>
                </div>

                <div v-if="showMobileNav"
                     class="fixed top-0 left-0 bg-gray-900 text-white leading-none w-full h-full font-headline flex flex-col lg:hidden">
                    <ul class="text-center flex-1 flex flex-col items-center justify-center space-y-6">
                        <li v-for="item in navigation">
                            <a :href="item.href" class="p-4 text-center">{{ item.text }}</a>
                        </li>
                    </ul>
                    <div class="pt-4 pb-8 text center text-xl" @click="showMobileNav = false">
                        <span class="block text-center">Close</span>
                    </div>
                </div>
            </div>

            <ul class="hidden lg:flex text-white leading-none w-full font-headline text-base items-center justify-center">
                <li v-for="item in navigation">
                    <a :href="item.href" class="block text-center px-2 pt-3 pb-2 hover:bg-gray-800 transition-bg">{{ item.text }}</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        showMobileNav: false,
        navigation: [
            {
                text: 'Home',
                href: '/',
            },
            {
                text: 'Venues and Schedule',
                href: '/venues-and-schedule',
            },
            {
                text: 'Travel and Accommodation',
                href: '/travel-and-accommodation',
            },
            // {
            //     text: 'Wedding Party',
            //     href: '/',
            // },

            {
                text: 'Q and A',
                href: '/q-and-a',
            },

            {
                text: 'RSVP',
                href: '/',
            },
        ]
    }),
}
</script>
