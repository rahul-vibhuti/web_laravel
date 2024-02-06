// TABS SECTION

function sliderTabs(clickedBtn) {
    const activeTab = clickedBtn.getAttribute("data-tab");
    $(".tabsNav .nav-link").removeClass("slick-current");
    $(".tab-pane").removeClass("active");
    clickedBtn.classList.add("slick-current");
    document.getElementById("tab-content-" + activeTab).classList.add("active");
}
function checkAccordion(value) {
    $(".CollpaseOuter  .collapseToggle").removeClass("activeCollpase");
    $(`#${value}`).addClass("activeCollpase");
}

//   ----------
$(".responsive").slick({
    dots: true,
    infinite: false,
    autoplay: false,
    speed: 300,
    slidesToShow: 2,
    slidesToScroll: 1,
    centerPadding: "30%",
    variableWidth: true,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
                dots: true,
            },
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 576,
            settings: {
                centerMode: true,
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
    ],
});

//----- success stories ----
$(".responsive2").slick({
    dots: true,
    infinite: true,
    autoplay: false,
    speed: 300,
    slidesToShow: 3,
    centerPadding: "80px",
    slidesToScroll: 1,
    variableWidth: true,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
                dots: true,
            },
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 576,
            settings: {
                centerMode: true,
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
    ],
});

$(".responsive3").slick({
    dots: false,
    infinite: true,
    autoplay: true,
    speed: 100,
    slidesToShow: 6,
    slidesToScroll: 1,
    variableWidth: true,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
                dots: true,
            },
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 576,
            settings: {
                centerMode: true,
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        },
    ],
});
 
// ////////////FORMSECTION
// $(window).load(function () {
//     $(".col-3 input").val("");

//     $(".input-effect input").focusout(function () {
//         if ($(this).val() != "") {
//             $(this).addClass("has-content");
//         } else {
//             $(this).removeClass("has-content");
//         }
//     });
// });
// nav
console.log("run");
$(".navbar-nav li.has-sub").click(function () {
    //$(this).addClass("d-block");
    // $('.sub-menu').prev().parent().find();
    $(this).find("ul.sub-menu").addClass("d-block");
});
