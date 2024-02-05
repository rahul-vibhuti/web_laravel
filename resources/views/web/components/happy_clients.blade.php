<section class="happyclients">
    <div class="container">
        <div class="common-heading text-l text-center">
            <h2 class="mb30 commonHeading2" style="margin-top: -3px; width: 60%; margin: auto">
                Our Happy <span class="text-second text-bold">Clients</span>
            </h2>
            <p class="commonPara text-center">
                {!! $metaData[Config::get('constants.CLIENT_TITLE')] !!}
            </p>
        </div>
        <div id="happy-clients">
            @isset($clients)
            @foreach ($clients as $client )

            <div class="happyClient-items">
                <a class="card-image" href="#" title="Good Firms" target="_blank" rel="noopener noreferrer nofollow">
                    <div class="client-image">
                        <img src="{{ asset('assets/web/Images/Avatar.png') }}" alt="img" />
                    </div>
                    <div class="client-details">
                        <h5>{{$client->name}}</h5>
                        <!-- <p>Designation</p>
                        <div class="social-icons">
                            <i class="fa-solid fa-brands fa-twitter"></i>
                        </div> -->
                    </div>
                </a>
            </div>
            @endforeach

            @endisset
        </div>
    </div>
</section>