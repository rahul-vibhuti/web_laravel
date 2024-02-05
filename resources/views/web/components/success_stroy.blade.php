<section class="storySection">
    <div class="container">
        <div class="common-heading text-l text-center">
            <h2 class="mb30 commonHeading2" style="margin-top: -3px; width: 60%; margin: auto">
                Success <span class="text-second text-bold">Stories</span>
            </h2>
            <p class="commonPara text-center">
                {!! $metaData[Config::get('constants.SUCCESS_STORIES')] !!}
            </p>
        </div>
        <div class="mainSliderouter responsive2">
            @isset($stories)
            @foreach ($stories as $key => $story )

            <div class="slickOuter">
                <div class="successStories">
                    <div class="mainData">
                        <div class="funfct srcl4">
                            <span class="services-cuntr counter">{{ $story->project_name}}</span>
                            <!-- <p>Projects</p> -->
                        </div>
                        <div class="funfct srcl4">
                            <span class="services-cuntr counter">{{ $story->tasks}}</span>
                            <p>Projects Tasks</p>
                        </div>
                        <div class="funfct srcl4">
                            <span class="services-cuntr counter">{{ $story->issues}}</span>
                            <p>Projects Issues</p>
                        </div>
                    </div>
                    <div class="mainData">
                        <div class="reviewOuter">
                            <div class="imageSuccess">
                                <img src="{{ asset('assets/web/Images/kf-logo-1.png') }}" alt="img" />
                            </div>
                            <div class="writtenData">
                                <p class="trustHeading">
                                    {{ $story->feedback }}
                                </p>

                                <p><strong> {{ $story->client_name }} </strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            @endisset

        </div>
    </div>
</section>