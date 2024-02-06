@extends('web.layouts.web_layout')

@section('content')
<!-------BannerSection--------->
@include('web.components.banner')
<!------ServicesSection-------->
<section class="about-sec-app pad-tb commonSection serviceSection">
    <div class="container" style="height: 100% !important">
        <div class="row">
            <div class="col-lg-6">
                <div class="common-heading text-l">
                    <h2 class="mb30" style="margin-top: -3px">
                        <!-- <span class="text-second text-bold">Experience</span>
                        World-class Agile Product Development -->
                         {!! $metaData[Config::get('constants.INDEX_PAGE_SUB_TITLE')] !!}
                    </h2>
                    {!! $metaData[Config::get('constants.INDEX_PAGE_SUB_DESC')] !!}

                </div>
                <div class="cta-card mt40">
                    <h3 class="mb30">Let's Start a New Project Together</h3>
                    <form class="inquire_now">
                        <div class="flex-wrap">
                            <a class="btn large-btn move-btn" href="#query-section">Get A Quote</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="funfact">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <div class="funfct srcl1">
                                <img src="{{ asset('assets/web/images/20-years.png') }}" alt="" />
                                <span class="services-cuntr counter">{{ $metaData[Config::get('constants.EXPERIENCE')] }}</span><span class="services-cuntr">+</span>
                                <p>Years Experience</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <div class="funfct srcl2">
                                <img src="{{ asset('assets/web/images/talented-squad.png') }}" alt="" />
                                <span class="services-cuntr counter">{{ $metaData[Config::get('constants.TEAM')] }}</span><span class="services-cuntr">+</span>
                                <p>Talented Squad</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <div class="funfct srcl3">
                                <img src="{{ asset('assets/web/images/apps.png') }}" alt="" />
                                <span class="services-cuntr counter">{{ $metaData[Config::get('constants.APP_DELIVERED')] }}</span><span class="services-cuntr">+</span>
                                <p>Apps Developed</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <div class="funfct srcl4">
                                <img src="{{ asset('assets/web/images/projects--delivered.png') }}" alt="" />
                                <span class="services-cuntr counter">{{ $metaData[Config::get('constants.PROJECTS')] }}</span><span class="services-cuntr">+</span>
                                <p>Total Projects</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <div class="funfct srcl5">
                                <img src="{{ asset('assets/web/images/120-countries.png') }}" alt="" />
                                <span class="services-cuntr counter">{{ $metaData[Config::get('constants.COUNTRY_SERVED')] }}</span><span class="services-cuntr">+</span>
                                <p>Countries </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <div class="funfct srcl1">
                                <img src="{{ asset('assets/web/images/client-satisfication.png') }}" alt="" />
                                <span class="services-cuntr counter">{{ $metaData[Config::get('constants.CLIENTS')] }}</span><span class="services-cuntr">+</span>
                                <p>Happy Clients</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!------Services-TabsSection------>
@include('web.components.service')

<!------successStories------->
@include('web.components.success_stroy')
<!----ReviewSection--------->
@include('web.components.review')

<!----expertSection--------->
<section class="expertSection">
    <div class="container">
        <div class="common-heading text-l text-center">
            <h2 class="mb30 commonHeading2" style="margin-top: -3px; width: 60%; margin: auto">
                Our Experts Have An <span> Exceptional Skill</span> Set For
                Utilinzing Cutting-edge Technology
            </h2>
            <p class="commonPara text-center">
                Harness digitized business solutions comprising web, android and iOS
                app solutions leveraging Blockchain, AI Chatbots, Machine Learning
                and IoT technologies for your startup or enterprise.
            </p>
        </div>
        <div class="technologyImages">
            <div class="imageOuter">
                <img src="Images/ai.png" alt="img" />
                <p class="techName">Laravel</p>
            </div>
            <div class="imageOuter">
                <img src="Images/ui.png" alt="img" />
                <p class="techName">Laravel</p>
            </div>
            <div class="imageOuter">
                <img src="Images/ai.png" alt="img" />
                <p class="techName">Laravel</p>
            </div>
            <div class="imageOuter">
                <img src="Images/ai.png" alt="img" />
                <p class="techName">Laravel</p>
            </div>
            <div class="imageOuter">
                <img src="Images/ai.png" alt="img" />
                <p class="techName">Laravel</p>
            </div>
            <div class="imageOuter">
                <img src="Images/ai.png" alt="img" />
                <p class="techName">Laravel</p>
            </div>
            <div class="imageOuter">
                <img src="Images/ai.png" alt="img" />
                <p class="techName">Laravel</p>
            </div>
        </div>
    </div>
</section>
<!-------happyClients------>

@include('web.components.happy_clients')
<!-----formSectiom--------->
@include('web.components.query')

@endsection


@section('script')
<script>
    $(document).ready(() => {
        let subcriptionForm = $('#subcription_form');
        subcriptionForm.validate({
            highlight: function(element, errorClass, validClass) {
                // Add the 'invalid' class to the element when there is an error
                $(element).addClass("invalid");
            },
            unhighlight: function(element, errorClass, validClass) {
                // Remove the 'invalid' class from the element when it becomes valid
                $(element).removeClass("invalid");
            }
        });

        subcriptionForm.submit((e) => {
            e.preventDefault();
            if ($("#subcription_form").valid()) {

                $('#contact-submit').html(`<span class="loader"></span>`);
                $.ajax({
                    url: "{{ route('query.store') }}",
                    method: 'POST',
                    data: new FormData(document.getElementById('subcription_form')),
                    processData: false,
                    contentType: false,
                    success: function(result) {
                        if (result.status == 200) {
                            Swal.fire({
                                icon: "success",
                                title: result.message,
                                timer: 1500
                            });
                        }
                        if (result.status == 400) {
                            Swal.fire({
                                icon: "warning",
                                title: result.message,
                                timer: 1500
                            });
                        }
                        subcriptionForm[0].reset();
                    }
                });
            }

        });
    });
</script>
@endsection