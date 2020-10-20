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
            <img src="/assets/images/us-1.jpg" alt="Alison and Jamie" class="mb-2 xs:w-1/2 xs:pr-2 xs:pb-2 xs:mb-0 xs:float-left" />

            <template v-if="show === 'story'">
                <p>
                    We first 'met' online on Facebook, Alison ran a Green Day fan page which Jamie came across one day
                    in
                    2011,
                    the page became one of Jamie's favourites when over time he learnt more about the person who ran it,
                    who
                    was
                    also English, into the same music, and shared a lot of interests including Web Design, Harry Potter
                    and
                    other fantasy stories.
                </p>

                <p>
                    In December 2011 the friendship moved from a Facebook page to Facebook friends and over the next few
                    months
                    we began chatting on Facebook messenger, before in July 2012 we exchanged phone numbers when Alison
                    was
                    on
                    holiday and the mobile internet signal was poor at best!
                </p>

                <p>
                    Very quickly we were exchanging 100s of texts per week, talking all the time, and then in October
                    2012
                    we
                    met in person for the first time at a Bowling for Soup concert at Manchester Academy. Over the next
                    few
                    weeks and months we were talking more and there were hints from both of us about something further.
                </p>

                <p>
                    Valentines Day 2013 we 'got together' for the first time, and a couple of days later we met up in
                    Manchester
                    to go on a 'date' round the Natural History museum and Science museum, but Alison wasn't ready for a
                    relationship and ended it, but we remained friends.
                </p>

                <p>
                    Over the next few months we met regularly, from going to concerts together, Leeds festival for the
                    day
                    and
                    more, and in that time Jamie remained interested, and Alison's feelings began to grow. In early
                    September
                    2013 Alison invited Jamie to join her in seeing Harry Radford in Manchester on his first solo show
                    after
                    her
                    friend had to cancel last minute, Jamie agreed, and as part of his set he covered 'Just the Way You
                    Are'
                    by
                    Bruno Mars, a song Jamie had previously said was written about Alison, and while Jamie was miming
                    along
                    the
                    words while glancing at Alison she realised that she did have strong feelings for him, and a few
                    days
                    later,
                    on 11th September 2013 we made it official.
                </p>

                <p>
                    A matter of weeks later we went on our first 'holiday' together, a week following Bowling for Soup
                    around
                    the country on tour.
                </p>

                <p>
                    We got engaged on Valentines Day 2016, Alison asked Jamie while they were having a weekend away on
                    Anglesey,
                    she asked him on the cliff tops near Treadurr Bay, the same spot her grandparents ashes were
                    scattered
                    from,
                    a spot that means a lot to her, of course he said yes straight away, and it was something he himself
                    had
                    been thinking about for a long time.
                </p>

                <p>
                    We had both said it would be nice to get married on the day we got together, and that day happened
                    to
                    fall
                    on a Saturday in 2021, Jamie thought it wouldn't happen, it's expensive, and then with Coronavirus
                    through
                    2020 it looked even more unlikely, but in late September 2020 Alison mentioned that she enquired on
                    the
                    off
                    chance about that date, and it was available, and we booked it!
                </p>

                <p>
                    And then so begins the actual wedding planning, after the ceremony was booked spur of the moment we
                    began
                    looking at reception venues and more, and everything began to fall into place!
                </p>

                <p>
                    And we can't wait to see you there!
                </p>
            </template>

            <template v-if="show === 'info'">
                <div v-for="(tidbit, index) in tidbits" class="border-b border-gray-400 last:border-b-0 pb-3" :class="index > 0 ? 'pt-3' : ''">
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
                answer: 'We first \'met\' online on Facebook in 2011 before becoming closer friends in July 2012, and meeting in person for the first time in October 2012 at a Bowling for soup concert in Manchester, and then finally getting together on 11th September 2013.',
            },
            {
                question: 'Who was interested first?',
                answer: 'Jamie was definitely interested first, but Alison also had a slight interest, but was scared to go further, we got together for a couple of days on Valentines Day 2013, but Alison found she couldn\'t cope and wasn\'t ready for a relationship. Over the next few months they remained very close friends and Alison\'s feelings grew before she admitted the extent of her feelings and they got together on September 11th 2013.',
            },
            {
                question: 'Favourite holiday together?',
                answer: 'I think it was when we went to Edinburgh for a week in October 2017, it was our first and longest proper holiday as a couple, the other times we had been away was either with parents, or weekend breaks alone, or following bands on tour, this was our first in a proper holiday cottage for a week on our own. We came to Edinburgh for the first time the year before for a weekend and we both loved the city and came back for a week, and Edinburgh has become one of our favourite places to visit.',
            },
            {
                question: 'Any shared hobbies or interests?',
                answer: 'We actually have a lot in common, from the majority of our music tastes, to reading material, even TV/Films, whatever one of us reads/listens too/watches, nine times out of ten, the other one likes it too. We\'re both computer geeks too, enjoy web design, though that\'s more Jamie\'s domain now than Alison, and we both are keen amateur photographers.',
            },
            {
                question: 'When and how did we get engaged?',
                answer: 'We got engaged on Valentines Day 2016, Jamie had been thinking about proposing for a while but hadn\'t yet. We were on holiday for the weekend together stopping near Treardurr Bay, Anglesey, we were walking round the headland together and ended up on the clifftops where Alison\'s grandparents ashes were scattered from when out of the blue Alison proposed to Jamie, and obviously he said yes straight away.',
            },
            {
                question: 'What\'s the honeymoon plans?',
                answer: 'Well as we mentioned above we both love Edinburgh and even Scotland has a whole, our honeymoon plans are spread over 2 weeks and 3 locations. Our first night we will be in a luxury hotel overlooking Loch Lomond before heading into the Scotish Highlands the next day for the rest of the week stopping near John O\'Groats, and then for the final week we\'re heading down to Edinburgh.'
            },
        ],
    }),
}
</script>
