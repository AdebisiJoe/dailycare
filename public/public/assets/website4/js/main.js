/* Document map
   [1] Declaration of general variables
   [2] Create a gallery items
   [3] Declarations of general constants
   [4] Preload
   [5] Mobile menu setting
   [6] Animate Css
   [7] Section settings
   [8] Modal settings
   [9] Interface settings
   [10] Digits canvas
   [11] Apply settings
   [12] Modal window adaptation
   [13] Functionality of alerts
   [14] Initializing accordions
   [15] Initializing counters
   [16] Initializing tabs
   [17] Parallax setting
   [18] Initializing progress bars
   [19] Typed text setting
   [20] Gallery setting
   [21] Initializing default modal
   [22] Initializing search modal
   [23] Initializing video modal
   [24] Menu button setting
   [25] Change screens in the portfolio
   [26] Google map setting
   [27] Mobile menu function
   [28] Typed text function
   [29] Random function
   [30] Google map initialization function
   [31] Progress bars animation
   [32] Initializing particles

*/


(function () {
    "use strict";
    jQuery(document).ready(function ($) {
        /* [1] Declaration of general variables */
        let gallery = $(".gallery");
        let gallery_items = $(gallery).find(".grid-item");
        let src_arr = [];
        let modalSize = {
            mini: 400,
            medium: 600,
            large: 800,
            padding: 15
        };
        let videoModalSize = {
            default: 400,
            padding: 15
        };
        let preload = $("#preload");

        /* [2] Create a gallery items */
        (function () {
            for (let i = 0; i < gallery_items.length; i++) {
                $(gallery).append('<div class="gallery-modal"></div>');
            }
        }());

        /* [3] Declarations of general constants */
        const win = window;
        const doc = document;
        const html = $("*");
        const nav = $("nav");
        const menuBtn = $(".menu-btn");
        const section = $("section, .optionBox");
        const countersSection = $(".counters-section");
        const tabsSection = $(".tab-elem");
        const digitsSection = $("#canvas-digits");
        const particlesWrapper = $("#particles-wrapper");

        if ($(html).is('.demo-preview')) {
            /* AOS Init */
            AOS.init();
        }
        /* [4] Preload */
        $(doc).imagesLoaded(function () {
            $(preload).css("animation", "hidePreload .5s 1 ease forwards");
            $('body').css("overflow-y", "auto");
        });

        /* [5] Mobile menu setting */
        mobileMenu();

        /* [6] Animate Css */
        $.fn.extend({
            animateCss: function (animationName) {
                let animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
                this.addClass('animated ' + animationName).one(animationEnd, function () {
                    $(this).removeClass('animated ' + animationName);
                });
                return this;
            }
        });

        /* [7] Section settings */
        class sectionOpt {
            /* Constructor */
            constructor(container) {
                this.container = $(container);
                this.slickBox = this.container.find(".slick-carousel");
                this.owlBox = this.container.find(".owl-carousel");
                this.parallaxWindow = $(".parallax-window");
                this.videoBox = this.container.find("#bgndVideo");
                this._check = function () {
                    return $(html).is(this.container);
                }
            }

            /* Parallax setting */
            parallax(speed) {
                if ((this._check()) && (this.container.hasClass("parallax-window"))) {
                    let path = this.parallaxWindow.data("parallax");
                    $(this.parallaxWindow).parallax({
                        imageSrc: path,
                        speed: speed
                    });
                }
                else {
                    return false;
                }
            }

            /* Slick slider setting */
            slickSlider(config) {
                if ((this._check()) && (this.container.find(this.slickBox))) {
                    $(this.slickBox).slick(config);
                }
            }

            /* Owl slider setting */
            owlSlider(config) {
                if ((this._check()) && (this.container.find(".owl-carousel"))) {
                    $(this.owlBox).owlCarousel(config);
                }
            }

            /* YTPlayer setting */
            YTPlayer() {
                if ((this._check()) && ($(html).is(this.videoBox))) {
                    jQuery(this.videoBox).YTPlayer();
                }
            }

            /* Masonry grid setting */
            masonryGrid() {
                if ((this._check()) && ($(this.container).find("#masonry-grid"))) {
                    let grid_masonry = $(this.container).find("#masonry-grid");
                    $(grid_masonry).imagesLoaded(function () {
                        $(grid_masonry).masonry({
                            itemSelector: "#masonry-grid .grid-item"
                        });
                    });
                }
            }

            /* Isotope grid setting */
            isotopeGrid() {
                //
                let grid_isotope = $(this.container).find(".isotope-grid");
                if ((this._check()) && ($(this.container).find(".isotope-grid"))) {
                    $(grid_isotope).imagesLoaded(function () {
                        $(grid_isotope).isotope({
                            itemSelector: '.grid-item',
                            percentPosition: true,
                            masonry: {
                                columnWidth: '.grid-sizer'
                            },
                            layoutMode: $(grid_isotope).data("layout-mode")
                        });
                    });
                }
                if ((this._check()) && ($(this.container).find(".btn-wrapper-isotope"))) {
                    let btn_group = $(this.container).find(".btn-wrapper-isotope");
                    let btn = $(btn_group).find("a");
                    $(btn_group).on("click", function (e) {
                        let target = $(e.target);
                        while (!$(target).is(this)) {
                            if ($(target).is(btn)) {
                                let selector = $(target).data("filter");
                                $(grid_isotope).imagesLoaded(function () {
                                    grid_isotope.isotope({filter: selector});
                                });
                                $(btn).removeClass("active");
                                $(target).addClass("active");
                            }
                            target = $(target).parent();
                        }
                    });
                }
            }
        }

        /* [8] Modal settings */
        class modalOpt {
            /* Constructor */
            constructor(modal) {
                this.modal = $(modal);
            }

            /* Default modal window setting */
            modalDefault(trigger, config) {
                $(this.modal).iziModal(config);
                let selfModal = this.modal;
                $(trigger).on("click", function () {
                    $(selfModal).iziModal('open');
                });
            }

            /* Blog modal window setting */
            modalBlog(trigger, config) {
                $(this.modal).iziModal(config);
                let selfModal = this.modal;
                $(trigger).on("click", function () {
                    let src = $(this).parent(".post-header").find(".img-blog").attr('src');
                    $(selfModal).find(".iziModal-content img").remove();
                    $(selfModal).find(".iziModal-content").append('<img class="img-fluid img-modal" ' + 'src=' + src + '>');
                    $(selfModal).iziModal('open');
                });
            }

            /* Video modal window setting */
            modalVideo(trigger, config) {
                let selfModal = this.modal;
                let videoUrl = "";
                $(trigger).on("click", function () {
                    videoUrl = $(this).data("url");
                    config.iframeURL = videoUrl;
                    $(selfModal).iziModal(config);
                    $(selfModal).iziModal('open');
                });
            }
        }

        /* [9] Interface settings */
        class interfaceOpt {
            /* Constructor */
            constructor(element) {
                this.element = $(element);
            }

            /* Tab setting */
            tabInit() {
                let tabContainer = $(this.element);
                let tabHeader = tabContainer.find(".tabs-header");
                $(tabHeader).on("click", function (e) {
                    let target = $(e.target);
                    let tabContent = tabContainer.find(".tab-content");
                    let tabToggle = tabContainer.find(".tab-toggle");
                    tabToggle.removeClass("active");
                    tabContent.removeClass("active");
                    while (!$(target).is(this)) {
                        if ($(target).is(tabToggle)) {
                            $(target).addClass("active");
                            let classElem = target.data("tab");
                            $(tabContainer).find(classElem).addClass("active");
                        }
                        target = $(target).parent();
                    }
                });
            }

            /* Accordion setting */
            acrdnInit() {
                let accordion = this.element;
                let openLi = accordion.find(".open-li");
                $(openLi).slideDown("fast");
                $(accordion).on("click", function (e) {
                    let target = $(e.target);
                    let header = $(this).find(".header");
                    let content = $(this).find(".content");
                    let plus = $(this).find(".plus");
                    while (!$(target).is(this)) {
                        if ($(target).is(header)) {
                            $(content).removeClass("open");
                            $(target).parent(".accordion-body").find(".content").slideToggle("fast").addClass("open");
                            $(target).find(".plus").toggleClass("active");
                            for (let i = 0; i < content.length; i++) {
                                if (!$(content[i]).hasClass("open")) {
                                    $(content[i]).slideUp("fast");
                                    $(plus[i]).removeClass("active");
                                }
                            }
                        }
                        target = $(target).parent();
                    }
                });
            }

            /* Counters setting */
            countersInit() {
                if ($(html).is(this.element)) {
                    let $this = this.element;
                    $($this).waypoint(function () {
                        if (!$this.hasClass("finished-counters")) {
                            let propertiesObj = {
                                    prop1: 0,
                                    prop2: 0,
                                    prop3: 0,
                                    prop4: 0
                                },
                                anim_element = anime({
                                    targets: propertiesObj,
                                    prop1: $this.find(".prop-obj1").data("count"),
                                    prop2: $this.find(".prop-obj2").data("count"),
                                    prop3: $this.find(".prop-obj3").data("count"),
                                    prop4: $this.find(".prop-obj4").data("count"),
                                    easing: 'easeInQuad',
                                    round: 1,
                                    duration: function (el, i, l) {
                                        return 4000 + (i * 300);
                                    },
                                    update: function () {
                                        let el = $this.find(".prop-obj");
                                        let i = 0;
                                        for (const prop in propertiesObj) {
                                            el[i].innerHTML = JSON.stringify(propertiesObj[prop]);
                                            i++;
                                        }
                                    }
                                });
                            $this.addClass("finished-counters");
                        }
                    }, {
                        offset: '70%'
                    });
                }
            }
        }

        /* [10] Digits canvas */
        if ($(html).is(digitsSection)) {
            class getContext {
                constructor() {
                    this.canvasArr = [doc.querySelector("#canvas-digits")];
                }

                _context() {
                    let ctxArr = [];
                    for (let i = 0; i < this.canvasArr.length; i++) {
                        ctxArr[i] = this.canvasArr[i].getContext("2d");
                    }
                    return ctxArr;
                }

                setSize() {
                    for (let i = 0; i < this.canvasArr.length; i++) {
                        this.canvasArr[i].width = win.innerWidth;
                        this.canvasArr[i].height = win.innerHeight;
                    }
                }
            }

            const canvasCtx = new getContext();
            const ctxArr = [];
            canvasCtx.setSize();
            for (let i = 0; i < canvasCtx._context().length; i++) {
                ctxArr[i] = canvasCtx._context()[i];
            }
            let minX = 0;
            let maxX = win.innerWidth;
            let widthElem = 10;
            let heightElem = 10;
            let elementNumber = 0;
            let elements = [];
            let digits = [];
            let alphaChanel = [];
            let staticAlphaChanel = [];
            let positionElementsArr = [];
            setInterval(function () {
                for (let i = 0; i < ctxArr.length; i++) {
                    ctxArr[i].clearRect(0, 0, win.innerWidth, win.innerHeight);
                }
                let randomStart = parseInt(getRandom(minX, maxX), 10);
                let randomDigit = parseInt(getRandom(0, 10), 10);
                let randomAlpha = getRandom(0.1, 1).toFixed(1);

                for (let i = 0; i < elements.length; i++) {
                    if (positionElementsArr[i] === undefined) {
                        positionElementsArr[i] = win.innerHeight;
                    }
                    let positionY = positionElementsArr[i] - heightElem;
                    ctxArr[0].fillStyle = "rgba(255,255,255," + alphaChanel[i] + ")";
                    ctxArr[0].font = "16px Raleway";
                    ctxArr[0].fillText(digits[i], elements[i] - widthElem, positionY);
                    if (alphaChanel[i] >= 0.7) {
                        positionElementsArr[i] -= 1;
                    }
                    if (alphaChanel[i] >= 0.5) {
                        positionElementsArr[i] -= 0.8;
                    }
                    if (alphaChanel[i] < 0.5) {
                        positionElementsArr[i] -= 0.7;
                    }
                    if ((positionElementsArr[i] < win.innerHeight / 1.8) || (positionElementsArr[i] === win.innerHeight / 1.8)) {
                        positionElementsArr[i] = win.innerHeight;
                    }
                    if (positionElementsArr[i] > win.innerHeight / 1.4) {
                        alphaChanel[i] = staticAlphaChanel[i];
                    }
                    if ((positionElementsArr[i] < win.innerHeight / 1.4) || (positionElementsArr[i] === win.innerHeight / 1.4)) {
                        alphaChanel[i] -= 0.01;
                    }
                }
                if ((randomStart % 2) && (elementNumber < 300)) {
                    elements[elementNumber] = randomStart;
                    digits[elementNumber] = randomDigit;
                    alphaChanel[elementNumber] = randomAlpha;
                    staticAlphaChanel[elementNumber] = randomAlpha;
                    elementNumber++;
                }
            }, 1000 / 80);
        }

        /* [11] Apply settings */
        $(section).each(function () {
            let selfSectionOpt = new sectionOpt(this);
            switch ($(this).data("section-type")) {
                case "parallax":
                    selfSectionOpt.parallax(0.3);
                    break;
                case "slick-slider-home":
                    selfSectionOpt.slickSlider({
                        infinite: true,
                        fade: true,
                        easing: 'ease',
                        nav: true,
                        dots: true,
                        arrows: true,
                        appendDots: selfSectionOpt.slickBox,
                        appendArrows: selfSectionOpt.slickBox,
                        autoplay: true,
                        autoplaySpeed: 3500,
                        prevArrow: "<div class='prev'>" +
                        "<i class='fa fa-angle-left' aria-hidden='true'></i></div>",
                        nextArrow: "<div class='next'>" +
                        "<i class='fa fa-angle-right' aria-hidden='true'></i></div>"
                    });
                    break;
                case "slider-owl-default":
                    selfSectionOpt.owlSlider({
                        dots: true,
                        nav: false,
                        loop: true,
                        autoplay: true,
                        slideSpeed: 300,
                        paginationSpeed: 400,
                        items: 1
                    });
                    break;
                case "slider-owl-testimonials":
                    selfSectionOpt.owlSlider({
                        loop: true,
                        dots: true,
                        nav: false,
                        autoplay: true,
                        responsive: {
                            0: {
                                items: 1
                            },
                            768: {
                                items: 2
                            },
                            1000: {
                                items: 3
                            }
                        }
                    });
                    break;
                case "slider-owl-only":
                    selfSectionOpt.owlSlider({
                        loop: true,
                        dots: false,
                        nav: false,
                        autoplay: true,
                        responsive: {
                            0: {
                                items: 1
                            },
                            768: {
                                items: 2
                            },
                            1000: {
                                items: 4
                            }
                        }
                    });
                    break;
                case "youtube-video":
                    selfSectionOpt.YTPlayer();
                    break;
                case "masonry-grid":
                    selfSectionOpt.masonryGrid();
                    break;
                case "isotope-grid":
                    selfSectionOpt.isotopeGrid();
                    break;
                default:
                    break;
            }
        });

        /* [12] Modal window adaptation */
        {
            if ($(win).width() < 1440) {
                modalSize.medium = 500;
                modalSize.padding = 10;
            }
            if ($(win).width() < 576) {
                modalSize.medium = 300;
                modalSize.mini = 320;
                modalSize.large = 350;
                modalSize.padding = 5;
                videoModalSize.default = 200;
                videoModalSize.padding = 5;
            }
        }

        /* [13] Functionality of alerts */
        {
            let alertWrapper = $(".alert-wrapper");
            let closeIcon = alertWrapper.find(".close-icon");
            closeIcon.on("click", function () {
                let $this = $(this);
                $this.parent(".alert-wrapper").remove();
            })
        }

        /* [14] Initializing accordions */
        {
            let acrdnSection = $(".accordion-wrapper");
            for (let i = 0; i < acrdnSection.length; i++) {
                let acrdnType = new interfaceOpt(acrdnSection[i]);
                acrdnType.acrdnInit();
            }
        }

        /* [15] Initializing counters */
        {
            for (let i = 0; i < countersSection.length; i++) {
                let countersInit = new interfaceOpt(countersSection[i]);
                countersInit.countersInit();
            }
        }

        /* [16] Initializing tabs */
        {
            for (let i = 0; i < tabsSection.length; i++) {
                let tabType = new interfaceOpt(tabsSection[i]);
                tabType.tabInit();
            }
        }

        /* [17] Parallax setting */
        {
            let scene1 = document.getElementById("scene-parallax");
            if ($(html).is(scene1)) {
                let parallaxInstance = new Parallax(scene1);
            }
        }

        /* [18] Initializing progress bars */
        {
            const progressBarsSection = $(".progress-bar-wrapper");
            if ($(html).is(progressBarsSection)) {
                let progressBarsType1 = doc.querySelectorAll(".progress-type-1");
                let progressBarsType2 = doc.querySelectorAll(".progress-type-2");
                let progressBarsType1Arr = [];
                let progressBarsType2Arr = [];
                for (let j = 0; j < progressBarsType1.length; j++) {
                    progressBarsType1Arr[j] = new ProgressBar.Circle(progressBarsType1[j], {
                        color: '#f04b41',
                        strokeWidth: 4,
                        trailWidth: 1,
                        trailColor: "rgba(255,255,255,0.3)",
                        easing: 'easeInOut',
                        duration: 1400,
                        text: {
                            autoStyleContainer: false
                        },
                        from: {color: '#f6f6f6', width: 4},
                        to: {color: '#f6f6f6', width: 4},
                        // Set default step function for all animate calls
                        step: function (state, circle) {
                            circle.path.setAttribute('stroke', state.color);
                            circle.path.setAttribute('stroke-width', state.width);
                            let value = Math.round(circle.value() * 100);
                            if (value === 0) {
                                circle.setText('');
                            } else {
                                circle.setText(value);
                            }
                        }
                    });
                    /**/
                    progressBarsType1Arr[j].text.style.fontFamily = '"Open Sans"';
                    progressBarsType1Arr[j].text.style.fontSize = '24px';
                    progressBarsType1Arr[j].text.style.fontWeight = '600';
                }
                for (let i = 0; i < progressBarsType2.length; i++) {
                    progressBarsType2Arr[i] = new ProgressBar.Circle(progressBarsType2[i], {
                        color: '#f04b41',
                        strokeWidth: 4,
                        trailWidth: 1,
                        trailColor: "rgba(33,33,33,0.1)",
                        easing: 'easeInOut',
                        duration: 1400,
                        text: {
                            autoStyleContainer: false
                        },
                        from: {color: 'rgba(33,33,33,0.5)', width: 4},
                        to: {color: 'rgba(33,33,33,0.8)', width: 4},
                        // Set default step function for all animate calls
                        step: function (state, circle) {
                            circle.path.setAttribute('stroke', state.color);
                            circle.path.setAttribute('stroke-width', state.width);
                            let value = Math.round(circle.value() * 100);
                            if (value === 0) {
                                circle.setText('');
                            } else {
                                circle.setText(value);
                            }
                        }
                    });
                    /**/
                    progressBarsType2Arr[i].text.style.fontFamily = '"Open Sans"';
                    progressBarsType2Arr[i].text.style.fontSize = '24px';
                    progressBarsType2Arr[i].text.style.fontWeight = '600';
                }
                $(progressBarsSection).waypoint(function () {
                    let progressBarsType1 = $(".progress-type-1");
                    let progressBarsType2 = $(".progress-type-2");
                    animProgress(progressBarsType1, progressBarsType1Arr);
                    animProgress(progressBarsType2, progressBarsType2Arr);
                }, {
                    offset: '70%'
                });
            }
        }

        /* [19] Typed text setting */
        {
            const typedBox = doc.querySelector(".typed-text");
            if ($(html).is(typedBox)) {
                typedText(typedBox,
                    ["professional.", "modern.", "innovative.", "successful.", "responsible."], 45, 45, 2000);
            }
        }

        /* [20] Gallery setting */
        {
            if ($(html).is(gallery)) {
                let triggerModal = $('.trigger-modal');
                let modal_gallery = $(".gallery-modal");
                for (let j = 0; j < gallery_items.length; j++) {
                    $(modal_gallery[j]).iziModal({
                        headerColor: '#f04b41',
                        background: "#f6f9fa",
                        width: modalSize.medium,
                        padding: modalSize.padding,
                        navigateCaption: true,
                        navigateArrows: true,
                        group: 'gallery',
                        loop: true,
                        overlayColor: 'rgba(0, 0, 0, 0.7)',
                        fullscreen: false,
                        transitionIn: 'comingIn',
                        transitionOut: 'comingOut',
                        transitionInOverlay: 'fadeIn',
                        transitionOutOverlay: 'fadeOut'
                    });
                }
                for (let i = 0; i < gallery_items.length; i++) {
                    src_arr[i] = $(gallery_items[i]).find(".img-gallery").attr('src')
                    $(modal_gallery[i]).find(".iziModal-content").append('<img class="img-fluid img-modal" ' + 'src=' + src_arr[i] + '>');
                }
                $(triggerModal).on("click", function () {
                    let index = $(triggerModal).index($(this)) - 1;
                    $(modal_gallery[index]).iziModal('open');
                });
            }
        }

        /* [21] Initializing default modal */
        {
            let defaultModal = $("#modal-img");
            if ($(html).is(defaultModal)) {
                let defaultModalTrigger = $(".post-header .trigger-modal");
                let newModalBlog = new modalOpt(defaultModal);
                newModalBlog.modalBlog(defaultModalTrigger, {
                    title: " ",
                    subtitle: " ",
                    headerColor: '#f04b41',
                    background: "#f6f9fa",
                    icon: "fa fa-picture-o",
                    iconColor: 'rgba(255, 255, 255, 0.4)',
                    overlayColor: 'rgba(0, 0, 0, 0.7)',
                    width: modalSize.large,
                    padding: modalSize.padding,
                    bodyOverflow: false,
                    fullscreen: true,
                    transitionIn: 'comingIn',
                    transitionOut: 'comingOut',
                    transitionInOverlay: 'fadeIn',
                    transitionOutOverlay: 'fadeOut'
                    //For developers
                    //Ajax loading (optional)
                    /*
                    ,onOpening: function (modal) {
                       modal.startLoading();
                       $.get('', function () {
                           $("").html();
                           modal.stopLoading();
                       });
                     }
                     */
                });
            }
        }

        /* [22] Initializing search modal */
        {
            let searchModal = $("#modal-search");
            if ($(html).is(searchModal)) {
                let searchModalTrigger = $("header .trigger-modal");
                let newModalSearch = new modalOpt(searchModal);
                newModalSearch.modalDefault(searchModalTrigger, {
                    title: " ",
                    subtitle: " ",
                    headerColor: '#f04b41',
                    overlayColor: 'rgba(0, 0, 0, 0.7)',
                    background: "#f6f9fa",
                    width: modalSize.mini,
                    padding: modalSize.padding,
                    fullscreen: false,
                    transitionIn: 'comingIn',
                    transitionOut: 'comingOut',
                    transitionInOverlay: 'fadeIn',
                    transitionOutOverlay: 'fadeOut'
                });
            }
        }

        /* [23] Initializing video modal */
        {
            let videoModal = $("#modal-video");
            if ($(html).is(videoModal)) {
                let videoModalTrigger = $(".video-col .trigger-modal");
                let newModalVideo = new modalOpt(videoModal);
                newModalVideo.modalVideo(videoModalTrigger, {
                    title: ' ',
                    subtitle: ' ',
                    headerColor: '#f04b41',
                    background: "#f6f9fa",
                    width: modalSize.large,
                    padding: videoModalSize.padding,
                    iframe: true,
                    iframeHeight: videoModalSize.default,
                    bodyOverflow: false,
                    overlayColor: 'rgba(0, 0, 0, 0.7)',
                    transitionIn: 'comingIn',
                    transitionOut: 'comingOut',
                    transitionInOverlay: 'fadeIn',
                    transitionOutOverlay: 'fadeOut',
                });
            }
        }

        /* [24] Menu button setting */
        {
            $(menuBtn).on("click", function () {
                let btn_wrap = $(this).find(".btn-wrap");
                btn_wrap.toggleClass("active-btn");
                nav.toggleClass("mobile-menu-disable");
            });
        }

        /* [25] Change screens in the portfolio */
        {
            let parentContainer = $("#portfolio .responsive-box");
            let triggerTarget = $("#portfolio .responsive-box .btn-responsive");
            let connectedImages = [$(".desktop-img"), $(".mobile-img"), $(".laptop-img")];
            $(parentContainer).on("click", function (e) {
                let target = $(e.target);
                if ($(target).is(triggerTarget)) {
                    for (let i = 0; i < connectedImages.length; i++) {
                        triggerTarget.removeClass("active-size");
                        connectedImages[i].removeClass("active");
                    }
                    $(target).addClass("active-size");
                    switch ($(target).data("device")) {
                        case "desktop-img":
                            connectedImages[0].addClass("active");
                            break;
                        case "mobile-img":
                            connectedImages[1].addClass("active");
                            break;
                        case "laptop-img":
                            connectedImages[2].addClass("active");
                            break;
                        default:
                            break;
                    }
                }
            });
        }

        /* [26] Google map setting */
        {
            let mapElem = doc.getElementById('map-default-1');
            googleMapInit(mapElem);
        }


        /* [27] Mobile menu function */
        function mobileMenu() {
            if (win.innerWidth < 992) {
                let menuItem = $("nav .menu .inside-li-wrapper");
                let menuItemInner = $("nav .menu .menu-item-inner");
                $(menuItem).on("click", function () {
                    $(this).parent(".menu-item").find('.dropdown-menu-custom').slideToggle('fast');
                    $(this).parent(".menu-item").find('.fa-angle-down').toggleClass("active-icon");
                });
                $(menuItemInner).on("click", function () {
                    $(this).find('.dropdown-inner').slideToggle('fast');
                    $(this).find('.fa-angle-right').toggleClass("active-inner-icon");
                });
            }
        }

        /* [28] Typed text function */
        function typedText(path, array, typeSpeed, backSpeed, delay) {
            let typedConfig = {
                    strings: array,
                    typeSpeed: typeSpeed,
                    backSpeed: backSpeed,
                    backDelay: delay,
                    smartBackspace: false,
                    loop: true
                },
                typed = new Typed(path, typedConfig);
        }

        /* [29] Random function */
        function getRandom(min, max) {
            return Math.random() * (max - min) + min;
        }

        /* [30] Google map initialization function */
        function googleMapInit(mapElem) {
            if (mapElem) {
                google.maps.event.addDomListener(window, 'load', initMap);

                function initMap() {
                    let map = new google.maps.Map(mapElem, {
                        zoom: 12,
                        center: new google.maps.LatLng(34.0768184, -118.3932536),
                        scrollwheel: false
                    });
                    let marker = new google.maps.Marker({
                        position: new google.maps.LatLng(34.0768184, -118.3932536),
                        map: map
                    });
                    let infowindow = new google.maps.InfoWindow({
                        content: 'One Boulevard, Beverly Hills'
                    });
                    google.maps.event.addListener(marker, 'click', function () {
                        infowindow.open(map, marker);
                    });
                }
            }
        }

        /* [31] Progress bars animation */
        function animProgress(arr1, arr2) {
            for (let i = 0; i < arr1.length; i++) {
                let value = $(arr1[i]).data("status");
                if (value <= 1) {
                    arr2[i].animate(value);
                } else {
                    value = 1;
                    arr2[i].animate(value);
                }
            }
        }

        /* [32] Initializing particles */
        if ($(html).is(particlesWrapper)) {
            const json = {
                "particles": {
                    "number": {
                        "value": 100,
                        "density": {
                            "enable": true,
                            "value_area": 1000
                        }
                    },
                    "color": {
                        "value": "#f3f3f3"
                    },
                    "shape": {
                        "type": "circle",
                        "stroke": {
                            "width": 1,
                            "color": "#f3f3f3"
                        },
                        "polygon": {
                            "nb_sides": 5
                        },
                        "image": {
                            "src": "img/github.svg",
                            "width": 100,
                            "height": 100
                        }
                    },
                    "opacity": {
                        "value": 0.5,
                        "random": false,
                        "anim": {
                            "enable": false,
                            "speed": 3,
                            "opacity_min": 0.5,
                            "sync": true
                        }
                    },
                    "size": {
                        "value": 1,
                        "random": true,
                        "anim": {
                            "enable": false,
                            "speed": 1,
                            "size_min": 1,
                            "sync": true
                        }
                    },
                    "line_linked": {
                        "enable": true,
                        "distance": 120,
                        "color": "#fff",
                        "opacity": 0.5,
                        "width": 1
                    },
                    "move": {
                        "enable": true,
                        "speed": 5,
                        "direction": "none",
                        "random": true,
                        "straight": false,
                        "out_mode": "out",
                        "bounce": true,
                        "attract": {
                            "enable": true,
                            "rotateX": 600,
                            "rotateY": 1200
                        }
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {
                            "enable": false,
                            "mode": "repulse"
                        },
                        "onclick": {
                            "enable": false,
                            "mode": "push"
                        },
                        "resize": false
                    },
                    "modes": {
                        "grab": {
                            "distance": 400,
                            "line_linked": {
                                "opacity": 1
                            }
                        },
                        "bubble": {
                            "distance": 400,
                            "size": 40,
                            "duration": 2,
                            "opacity": 8,
                            "speed": 3
                        },
                        "repulse": {
                            "distance": 200,
                            "duration": 0.4
                        },
                        "push": {
                            "particles_nb": 4
                        },
                        "remove": {
                            "particles_nb": 2
                        }
                    }
                },
                "retina_detect": true
            }
            particlesJS('particles-wrapper', json);
        }

        /* DEMO */
        let anchor = $(".anchor-link");
        $(anchor).on("click", function (e) {
            e.preventDefault();
            let id = $(this).attr('href');
            let top = $(id).offset().top;
            $('body,html').animate({scrollTop: top}, 1500);
        });
        let docUl = $(".nav-menu-doc .doc-ul");
        $(win).scroll(function () {
            if ($(win).scrollTop() >= 65) {
                $(docUl).css("padding-top", "0");
            } else {
                $(docUl).css("padding-top", "65px");
            }
        });
    });
})();