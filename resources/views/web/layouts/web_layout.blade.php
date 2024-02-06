<!DOCTYPE html>
<html lang="en">
@include('web.components.head')
<body>
    @include('web.components.navbar')

    @yield('content')

    <script src="{{ asset('assets/web/Js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/web/Js/index.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>

    <script>
        $("#happy-clients").slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 5,
            autoplay: true,
            slidesToScroll: 1,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true,
                    },
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 2,
                    },
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    },
                },
            ],
        });

        $(".single-item").slick();
    </script>

    @yield('script')
</body>

</html>