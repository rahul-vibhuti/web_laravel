<section class="tabsSection commonSection">
    <div class="container">
        <div class="common-heading text-l text-center">
            <h2 class="mb30" style="margin-top: -3px; width: 60%; margin: auto">
                Offering A
                <span class="text-second text-bold">range of services</span> To Help
                Your Business Prosper
           
            </h2>
        </div>
        <div class="row">
            <div class="col" style="overflow: hidden">
                <nav class="tabsNav">
                    <div class="nav nav-tabs responsive" id="nav-tab" role="tablist">
                        @isset($services)
                        @foreach($services as $key => $service )

                        <button class="nav-link" onclick="sliderTabs(this)" data-tab="{{$key}}" role="tab" aria-controls="nav-home" aria-selected="true">{{ $service->name }}
                        </button>

                        @endforeach
                        @endisset
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    @isset($services)
                    @foreach ($services as $key => $service )
                    <div class="tab-pane fade show {{$key == 0 ?'active':''}}" id="tab-content-{{$key}}" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    @foreach ($service->desc as $desc )


                                    <div class="writtenData">
                                        <p class="trustHeading">{{$desc->title}}</p>
                                        <p class="processPara">
                                            {{ $desc->description}}
                                        </p>
                                    </div>
                                    @endforeach

                                </div>
                                <div class="col-md-6">
                                    <div class="imageTab">
                                        @if(File::exists(public_path($service->feature_image)))
                                        <img style="width: 100%" src="{{asset($service->feature_image)}}" alt="img" />

                                        @else
                                        <img style="width: 100%" src="{{ asset('assets/web/Images/autoTab.svg') }}" alt="img" />
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endisset

                </div>
            </div>
        </div>
    </div>
</section>