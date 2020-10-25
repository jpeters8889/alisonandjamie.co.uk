<template>
    <div>
        <div class="flex leading-none">
            <div
                class="heading w-1/2 text-center hover:bg-gray-500 cursor-pointer transition-bg py-3 cursor-pointer rounded-l-xl pb-2"
                :class="show === 'story' ? 'bg-gray-100 border border-gray-300' : 'bg-gray-300 border-0'"
                @click="show = 'story'">
                Our Story
            </div>

            <div
                class="heading w-1/2 text-center hover:bg-gray-500 cursor-pointer transition-bg py-3 cursor-pointer rounded-r-xl pb-2"
                :class="show === 'info' ? 'bg-gray-100 border border-gray-300' : 'bg-gray-300 border-0'"
                @click="show = 'info'">
                Tidbits
            </div>
        </div>

        <div>
            <img src="/assets/images/us-1.jpg" alt="Alison and Jamie"
                 class="mb-2 xs:w-1/2 xs:pr-2 xs:pb-2 xs:mb-0 xs:float-left"/>

            <template v-if="show === 'story'">
                <p>
                    Alison and Jamie first 'met' online through Facebook, Alison ran a Green Day fan page which Jamie
                    came across one day in 2011, the page became one of Jamie's favourites. Over time he learnt more
                    about the person who ran it, he learnt she also lived in the UK, was into the same music, and shared
                    a lot of interests including Web Design and Harry Potter.
                </p>

                <p>
                    In December 2011 the friendship moved from a Facebook page to Facebook friends and over the next few
                    months they chatted on messenger and then exchanged phone numbers when Alison went on holiday in
                    2012.
                </p>

                <p>
                    It very quickly turned into exchanging 100s of texts per week, then in October 2012 they finally met
                    in person for the first time at a Bowling for Soup concert at Manchester Academy.
                </p>

                <p>
                    Valentines Day 2013 they decided to try life as boyfriend and girlfriend, a couple of days later
                    they met up in Manchester to go on a 'date' round the Natural History museum and Science museum,
                    after that meeting Alison ditched Jamie via text as he travelled back to South Yorkshire on the
                    train, they remained friends though.
                </p>

                <p>
                    Over the next few months they met regularly and slowly Alison's feelings began to grow. In early
                    September 2013 Alison invited Jamie to join her in seeing Harry Radford in Manchester after her
                    friend had to cancel last minute, Jamie agreed, and as part of his set he covered 'Just the Way You
                    Are' by Bruno Mars, a song Jamie had previously said was written about Alison, and while Jamie was
                    miming along the words while glancing at Alison she realised she might be ready to try the
                    relationship thing again, so on 11th September 2013 they made it official… again. A matter of weeks
                    later they followed Bowling For Soup round the country for a week as a first 'holiday' together.
                </p>

                <p>
                    They got engaged on Valentines Day 2016, Alison asked Jamie while they were having a weekend away on
                    Anglesey, she asked him on the cliff tops near Trearddur Bay, of course he said yes straight away,
                    and it was something he himself had been thinking about for a long time.
                </p>

                <p>
                    They both said it would be nice to get married on the day we got together, save Alison remembering
                    another date! That day happened to fall on a Saturday in 2021, Jamie thought it wouldn't happen and
                    didn’t really give it a second thought but in late September 2020 Alison mentioned that she enquired
                    on the off chance about that date, it was available, and they booked it!
                </p>

                <p>
                    Now they can't wait to see you there!
                </p>
            </template>

            <template v-if="show === 'info'">
                <div v-for="(tidbit, index) in tidbits" class="border-b border-gray-400 last:border-b-0 pb-3"
                     :class="index > 0 ? 'pt-3' : ''">
                    <h3 class="font-headline">Q - {{ tidbit.question }}</h3>
                    <p style="margin-bottom: 0">{{ tidbit.answer }}</p>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        show: 'story',

        tidbits: [
            {
                question: 'How did you meet?',
                answer: 'We first \'met\' on Facebook in 2011, met in person October 2012 and then finally got together on 11th September 2013.',
            },
            {
                question: 'Who was interested first?',
                answer: 'Jamie. It took a while for Alison to decide she liked him enough to date him!',
            },
            {
                question: 'Favourite holiday together?',
                answer: 'Probably Edinburgh, October 2017, it was our first proper holiday as a couple. We went to Edinburgh for the first time the year before for a weekend and loved the place.',
            },
            {
                question: 'Any shared hobbies or interests?',
                answer: 'We share a lot of interests, from the majority of our music tastes, to reading material, even TV/Films, whatever one of us reads/listens too/watches, nine times out of ten, the other one likes it too. We\'re both computer geeks too and amateur photographers.',
            },
            {
                question: 'When and how did we get engaged?',
                answer: 'We got engaged on Valentines Day 2016, Jamie had been thinking about proposing for a while but hadn\'t. They were near Treardur Bay, Anglesey on the headlands, Alison proposed to Jamie, and obviously he said yes straight away.',
            },
            {
                question: 'What\'s the honeymoon plans?',
                answer: 'As we love Edinburgh and even Scotland has a whole, the honeymoon plans are spread over 2 weeks and 3 locations starting in a luxury hotel overlooking Loch Lomond for the first night, then heading to just outside John O\'Groats for the rest of the week, and the final week in Edinburgh.'
            },
        ],
    }),
}
</script>
