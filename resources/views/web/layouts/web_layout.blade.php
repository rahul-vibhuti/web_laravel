<!DOCTYPE html>
<html lang="en">
@include('web.components.head')
<script>
    // navbar
    $(function() {
        var header = $(".clearHeader");

        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            if (scroll >= 50) {
                header.addClass("affix");
            } else {
                header.removeClass("affix");
            }
        });
    });
</script>

<body>
    @include('web.components.navbar')

    @yield('content')

    <script src="{{ asset('assets/web/Js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/web/Js/index.js') }}"></script>

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
    </script>a

    @yield('script')
</body>

</html>