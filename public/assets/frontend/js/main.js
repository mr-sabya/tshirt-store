document.addEventListener('livewire:navigated', () => {


    (function ($) {
        "use strict";

        /*----------------------------- Site Cookie function --------------------*/
        // Calling Function On Each Time Site Load | Reload


        // On click method for Clear Cookie

        /*----------------------------- Site Loader & Popup --------------------*/
        // $(window).load(function () {
        //     $("#ec-overlay").fadeOut("slow");
        // });

        /*--------------------- Search Bar On Focus -------------------------------- */
        $(".ec-search-bar").focus(function () {
            $(".ec-search-tab").addClass("active");
        });

        $(".ec-search-bar").focusout(function () {
            setTimeout(function () {
                $(".ec-search-tab").removeClass("active");
            }, 100);
        });


        // add image to banner background
        document.querySelectorAll('.banner-bg').forEach(el => {
            el.style.backgroundImage = `url('${el.getAttribute('data-bg')}')`;
        });



        /*----------------------------- Animate On Scroll --------------------*/
        var Animation = function ({ offset } = { offset: 10 }) {
            var _elements;

            // Define a dobra superior, inferior e laterais da tela
            var windowTop = offset * window.innerHeight / 100;
            var windowBottom = window.innerHeight - windowTop;
            var windowLeft = 0;
            var windowRight = window.innerWidth;

            function start(element) {
                // Seta os atributos customizados
                element.style.animationDelay = element.dataset.animationDelay;
                element.style.animationDuration = element.dataset.animationDuration;
                // Inicia a animacao setando a classe da animacao
                element.classList.add(element.dataset.animation);
                // Seta o elemento como animado
                element.dataset.animated = "true";
            }

            function isElementOnScreen(element) {
                // Obtem o boundingbox do elemento
                var elementRect = element.getBoundingClientRect();
                var elementTop =
                    elementRect.top + parseInt(element.dataset.animationOffset) ||
                    elementRect.top;
                var elementBottom =
                    elementRect.bottom - parseInt(element.dataset.animationOffset) ||
                    elementRect.bottom;
                var elementLeft = elementRect.left;
                var elementRight = elementRect.right;

                // Verifica se o elemento esta na tela
                return (
                    elementTop <= windowBottom &&
                    elementBottom >= windowTop &&
                    elementLeft <= windowRight &&
                    elementRight >= windowLeft
                );
            }
            var els = _elements = document.querySelectorAll(
                "[data-animation]:not([data-animated])"
            );
            // Percorre o array de elementos, verifica se o elemento está na tela e inicia animação
            function checkElementsOnScreen(_elements) {
                var els = _elements;
                for (var i = 0, len = els.length; i < len; i++) {
                    // Passa para o proximo laço se o elemento ja estiver animado
                    if (els[i].dataset.animated) continue;

                    isElementOnScreen(els[i]) && start(els[i]);
                }
            }

            // Atualiza a lista de elementos a serem animados
            function update() {
                _elements = document.querySelectorAll(
                    "[data-animation]:not([data-animated])"
                );
                checkElementsOnScreen(_elements);
            }

            // Inicia os eventos
            window.addEventListener("load", update, false);
            window.addEventListener("scroll", () => checkElementsOnScreen(_elements), { passive: true });
            window.addEventListener("resize", () => checkElementsOnScreen(_elements), false);

            // Retorna funcoes publicas
            return {
                start,
                isElementOnScreen,
                update
            };
        };

        // Initialize
        var options = {
            offset: 20 //percentage of window
        };

        var animation = new Animation(options);

        /*----------------------------- Stickey headre on scroll &&  Menu Fixed On Scroll Active  --------------------*/
        var doc = document.documentElement;
        var w = window;

        var ecprevScroll = w.scrollY || doc.scrollTop;
        var eccurScroll;
        var ecdirection = 0;
        var ecprevDirection = 0;
        var ecscroll_top = $(window).scrollTop() + 1;
        var echeader = document.getElementById('ec-main-menu-desk');

        var checkScroll = function () {

            eccurScroll = w.scrollY || doc.scrollTop;
            if (eccurScroll > ecprevScroll) {
                //scrolled up
                ecdirection = 2;
            }
            else if (eccurScroll < ecprevScroll) {
                //scrolled down
                ecdirection = 1;
            }

            if (ecdirection !== ecprevDirection) {
                toggleHeader(ecdirection, eccurScroll);
            }

            ecprevScroll = eccurScroll;
        };

        var toggleHeader = function (ecdirection, eccurScroll) {

            if (ecdirection === 2 && eccurScroll > 52) {
                // echeader.classList.add('hide');
                ecprevDirection = ecdirection;
                $("#ec-main-menu-desk").addClass("menu_fixed_up");
                // $("#ec-main-menu-desk").removeClass("menu_fixed");
            }
            else if (ecdirection === 1) {
                // echeader.classList.remove('hide');
                ecprevDirection = ecdirection;
                $("#ec-main-menu-desk").addClass("menu_fixed");
                $("#ec-main-menu-desk").removeClass("menu_fixed_up");
            }
        };

        $(window).on("scroll", function () {
            var distance = $('.sticky-header-next-sec').offset().top,
                $window = $(window);

            if ($window.scrollTop() <= distance + 50) {
                // alert("1");
                $("#ec-main-menu-desk").removeClass("menu_fixed");
            }
            else {
                // alert("2");
                checkScroll();
            }
        });


        /*-----------------------------  Navigation for scroll section to section  --------------------*/
        $(document).ready(function () {
            $('.scroll-to ul li a.nav-scroll').bind('click', function (e) {
                $('.scroll-to ul li').removeClass('active');
                $(this).parents('li').addClass('active');

                var target_ID = $(this).attr('data-scroll');
                // alert(target_ID);
                $('html, body').animate({
                    scrollTop: $("#" + target_ID).offset().top - 50
                }, 500);
            });
        });

        /*----------------------------- Bootstrap dropdown   --------------------*/
        $('.dropdown').on('show.bs.dropdown', function () {
            $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
        });

        $('.dropdown').on('hide.bs.dropdown', function () {
            $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
        });

        /*----------------------------- Language and Currency Click to Active -------------------------------- */
        $(document).ready(function () {
            $(".header-top-lan li").click(function () {
                $(this).addClass('active').siblings().removeClass('active');
            });
            $(".header-top-curr li").click(function () {
                $(this).addClass('active').siblings().removeClass('active');
            });
        });

        /*----------------------------- Toggle Search Bar --------------------- */
        $(".search-btn").on("click", function () {
            $(this).toggleClass('active');
            $('.dropdown_search').slideToggle('medium');
        });

        /*----------------------------- Sidebar js | Toggle Icon OnClick Open sidebar  -----------------------------------*/

        $(".ec-sidebar-toggle").on("click", function () {
            $(".ec-side-cat-overlay").fadeIn();
            $(".category-sidebar").addClass("ec-open");
        });

        $(".ec-close").on("click", function () {
            $(".category-sidebar").removeClass("ec-open");
            $(".ec-side-cat-overlay").fadeOut();
        });

        $(".ec-side-cat-overlay").on("click", function () {
            $(".category-sidebar").removeClass("ec-open");
            $(".ec-side-cat-overlay").fadeOut();
        });

        /*----------------------------- Product page category Toggle -------------------------------- */


        /*----------------------------- Siderbar Product Slider -------------------------------- */
        $(document).ready(function () {
            $('.ec-sidebar-slider-cat .ec-sb-pro-sl').slick({
                rows: 4,
                dots: false,
                arrows: true,
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 8000,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            rows: 4,
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: false
                        }
                    },
                    {
                        breakpoint: 479,
                        settings: {
                            rows: 4,
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: false
                        }
                    }
                ]
            });
        });

        /*----------------------------- Instagram slider & Category slider & Tooltips -----------------------------------*/
        $(function () {
            $('.insta-auto, .cat-auto').infiniteslide({
                direction: 'left',
                speed: 50,
                clone: 10
            });

            $('[data-toggle="tooltip"]').tooltip();
        });

        /*----------------------------- Filter Icon OnClick Open filter Sidebar on shop page -----------------------------------*/
        $('#shop_sidebar').stickySidebar({
            topSpacing: 30,
            bottomSpacing: 30
        });

        $(".sidebar-toggle-icon").on("click", function () {
            $(".filter-sidebar-overlay").fadeIn();
            $(".filter-sidebar").addClass("toggle-sidebar-swipe");
        });

        $(".filter-cls-btn").on("click", function () {
            $(".filter-sidebar").removeClass("toggle-sidebar-swipe");
            $(".filter-sidebar-overlay").fadeOut();
        });

        $(".filter-sidebar-overlay").on("click", function () {
            $(".filter-sidebar").removeClass("toggle-sidebar-swipe");
            $(".filter-sidebar-overlay").fadeOut();
        });

        /*----------------------------- Remove product on compare and wishlish page -----------------------------------*/
        $(".ec-remove-wish").on("click", function () {
            $(this).parents(".pro-gl-content").remove();
            var wish_product_count = $(".pro-gl-content").length;
            if (wish_product_count == 0) {
                $('.ec-wish-rightside, .wish-empt').html('<p class="emp-wishlist-msg">Your wishlist is empty!</p>');
            }
        });

        $(".ec-remove-compare").on("click", function () {
            $(this).parents(".pro-gl-content").remove();
            var comp_product_count = $(".pro-gl-content").length;
            if (comp_product_count == 0) {
                $('.ec-compare-rightside').html('<p class="emp-wishlist-msg">Your Compare list is empty!</p>');
            }
        });

        /*----------------------------- Sidekka And SideMenu -----------------------------------*/


        (function () {
            var $ekkaToggle = $(".ec-side-toggle"),
                $ekka = $(".ec-side-cart"),
                $ecMenuToggle = $(".mobile-menu-toggle");

            $ekkaToggle.on("click", function (e) {
                e.preventDefault();
                var $this = $(this),
                    $target = $this.attr("href");
                // $("body").addClass("ec-open");
                $(".ec-side-cart-overlay").fadeIn();
                $($target).addClass("ec-open");
                if ($this.parent().hasClass("mobile-menu-toggle")) {
                    $this.addClass("close");
                    $(".ec-side-cart-overlay").fadeOut();
                }
            });

            $(".ec-side-cart-overlay").on("click", function (e) {
                $(".ec-side-cart-overlay").fadeOut();
                $ekka.removeClass("ec-open");
                $ecMenuToggle.find("a").removeClass("close");
            });

            $(".ec-close").on("click", function (e) {
                e.preventDefault();
                $(".ec-side-cart-overlay").fadeOut();
                $ekka.removeClass("ec-open");
                $ecMenuToggle.find("a").removeClass("close");
            });



        })();

        /*----------------------------- ekka Responsive Menu -----------------------------------*/
        function ResponsiveMobileekkaMenu() {
            var $ekkaNav = $(".ec-menu-content, .overlay-menu"),
                $ekkaNavSubMenu = $ekkaNav.find(".sub-menu");
            $ekkaNavSubMenu.parent().prepend('<span class="menu-toggle"></span>');

            $ekkaNav.on("click", "li a, .menu-toggle", function (e) {
                var $this = $(this);
                if ($this.attr("href") === "#" || $this.hasClass("menu-toggle")) {
                    e.preventDefault();
                    if ($this.siblings("ul:visible").length) {
                        $this.parent("li").removeClass("active");
                        $this.siblings("ul").slideUp();
                        $this.parent("li").find("li").removeClass("active");
                        $this.parent("li").find("ul:visible").slideUp();
                    } else {
                        $this.parent("li").addClass("active");
                        $this.closest("li").siblings("li").removeClass("active").find("li").removeClass("active");
                        $this.closest("li").siblings("li").find("ul:visible").slideUp();
                        $this.siblings("ul").slideDown();
                    }
                }
            });
        }

        ResponsiveMobileekkaMenu();

        /*----------------------------- Main Slider ---------------------- */
        var EcMainSlider = new Swiper('.ec-slider.swiper-container', {
            autoplay: false,
            loop: true,
            speed: 2000,
            effect: "slide",
            // autoplay: {
            //     delay: 7000,
            //     disableOnInteraction: false,
            // },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },

            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            }
        });

        /*----------------------------- Quick view Slider ------------------------------ */
        $('.qty-product-cover').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: false,
            asNavFor: '.qty-nav-thumb',
        });

        $('.qty-nav-thumb').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '.qty-product-cover',
            dots: false,
            arrows: true,
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 479,
                    settings: {
                        slidesToScroll: 1,
                        slidesToShow: 2,
                    }
                }
            ]
        });

        /*----------------------------- Product Image Zoom --------------------------------*/
        $('.zoom-image-hover').zoom();

        /*----------------------------- Qty Plus Minus Button  ------------------------------ */


        /*----------------------------- Single Product Slider ---------------------------------*/
        var swiper = new Swiper(".single-product-slider", {
            slidesPerView: 4,
            spaceBetween: 20,
            speed: 1500,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                478: {
                    slidesPerView: 1,
                },
                576: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                992: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 4,
                },
                1200: {
                    slidesPerView: 4,
                },
            },
        });

        /*----------------------------- Scroll Up Button --------------------- */
        $.scrollUp({
            scrollText: '<i class="ecicon eci-arrow-up" aria-hidden="true"></i>',
            easingType: "linear",
            scrollSpeed: 900,
            animation: "fade",
        });

        /*----------------------------- Product Countdown --------------------- */
        $("#ec-fs-count-1").countdowntimer({
            startDate: "2024/01/01 00:00:00",
            dateAndTime: "2025/01/01 00:00:00",
            labelsFormat: true,
            displayFormat: "DHMS"
        });

        $("#ec-fs-count-2").countdowntimer({
            startDate: "2024/01/01 00:00:00",
            dateAndTime: "2025/12/01 00:00:00",
            labelsFormat: true,
            displayFormat: "DHMS"
        });

        $("#ec-fs-count-3").countdowntimer({
            startDate: "2024/01/01 00:00:00",
            dateAndTime: "2025/11/01 00:00:00",
            labelsFormat: true,
            displayFormat: "DHMS"
        });

        $("#ec-fs-count-4").countdowntimer({
            startDate: "2024/01/01 00:00:00",
            dateAndTime: "2025/03/01 00:00:00",
            labelsFormat: true,
            displayFormat: "DHMS"
        });

        /*----------------------------- Feature Product Slider   -------------------------------- */
        $('.ec-fre-products').slick({
            rows: 1,
            dots: false,
            arrows: true,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1
        });

        /*-----------------------------  Offer Product Slider  -------------------------------- */
        $('.ec-spe-products').slick({
            rows: 1,
            dots: false,
            arrows: true,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1
        });

        /*----------------------------- Theme Color Change -------------------------------- */


        /*----------------------------- Theme RTL Change -------------------------------- */


        /*----------------------------- Theme Dark mode Change -------------------------------- */

        /*----------------------------- Full Screen mode Change -------------------------------- */
        $(".ec-tools-sidebar .ec-fullscreen-mode .ec-fullscreen-switch").click(function (e) {
            e.preventDefault();

            $(this).parent().toggleClass('active');

            if (
                !document.fullscreenElement && // alternative standard method
                !document.mozFullScreenElement &&
                !document.webkitFullscreenElement &&
                !document.msFullscreenElement
            ) {
                // current working methods
                if (document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen();
                } else if (document.documentElement.msRequestFullscreen) {
                    document.documentElement.msRequestFullscreen();
                } else if (document.documentElement.mozRequestFullScreen) {
                    document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullscreen) {
                    document.documentElement.webkitRequestFullscreen(
                        Element.ALLOW_KEYBOARD_INPUT
                    );
                }
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                }
            }
        });

        /*----------------------------- Menu Active -------------------------------- */
        var current_page_URL = location.href;
        $(".ec-main-menu ul li a").each(function () {
            if ($(this).attr("href") !== "#") {
                var target_URL = $(this).prop("href");
                if (target_URL == current_page_URL) {
                    $('.ec-main-menu a').parents('li, ul').removeClass('active');
                    $(this).parent('li').addClass('active');
                    return false;
                }
            }
        });

        /*----------------------------- Color Hover To Image Change -------------------------------- */


        /*----------------------------- Size Hover To Active -------------------------------- */
        $('.ec-opt-size').each(function () {


            $(this).on('click', 'li', function () {
                // alert("2");
                onSizeChange($(this));
            });

            function onSizeChange(thisObj) {
                // alert("3");
                var $this = thisObj;
                var $old_data = $this.find('a').attr('data-old');
                var $new_data = $this.find('a').attr('data-new');
                var $old_price = $this.closest('.ec-pro-content').find('.old-price');
                var $new_price = $this.closest('.ec-pro-content').find('.new-price');

                $old_price.text($old_data);
                $new_price.text($new_data);

                $this.addClass('active').siblings().removeClass('active');
            }
        });

        /*----------------------------- Testimonial Slider -------------------------------- */
        $('#ec-testimonial-slider').slick({
            rows: 1,
            dots: true,
            arrows: false,
            centerMode: true,
            infinite: false,
            speed: 500,
            centerPadding: 0,
            slidesToShow: 1,
            slidesToScroll: 1
        });

        $("#ec-testimonial-slider").find(".slick-slide").each(function (i) {

            var t = $(this).find(".ec-test-img").html(), o = "li:eq(" + i + ")";
            $("#ec-testimonial-slider").find(".slick-dots").find(o).html(t);
        });

        /*----------------------------- Brand Slider -------------------------------- */
        $('#ec-brand-slider').slick({
            rows: 1,
            dots: false,
            arrows: true,
            infinite: true,
            speed: 500,
            slidesToShow: 7,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToScroll: 1,
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 360,
                    settings: {
                        slidesToScroll: 1,
                        slidesToShow: 2,
                    }
                }
            ]
        });

        /*----------------------------- Footer Toggle -------------------------------- */
        $(document).ready(function () {
            $("footer .footer-top .ec-footer-widget .ec-footer-links").addClass("ec-footer-dropdown");

            $('.ec-footer-heading').append("<div class='ec-heading-res'><i class='ecicon eci-angle-down'></i></div>");

            $(".ec-footer-heading .ec-heading-res").click(function () {
                var $this = $(this).closest('.footer-top .col-sm-12').find('.ec-footer-dropdown');
                $this.slideToggle('slow');
                $('.ec-footer-dropdown').not($this).slideUp('slow');
            });
        });

        /*----------------------------- Gallery image popup on single product page -------------------------------- */
        $('.popup-gallery').magnificPopup({
            type: 'image',
            mainClass: 'mfp-with-zoom',
            gallery: {
                enabled: true,
            },
            zoom: {
                enabled: true,
                duration: 300,
                easing: 'ease-in-out',
                opener: function (openerElement) {
                    return openerElement.is('img') ? openerElement : openerElement.find('img');
                }
            }
        });

        /*----------------------------- List Grid View -------------------------------- */
        $('.ec-gl-btn').on('click', 'button', function () {
            var $this = $(this);
            $this.addClass('active').siblings().removeClass('active');
        });

        // for 100% width list view
        function showList(e) {
            var $gridCont = $('.shop-pro-inner');
            var $listView = $('.pro-gl-content');
            e.preventDefault();
            $gridCont.addClass('list-view');
            $listView.addClass('width-100');
        }

        function gridList(e) {
            var $gridCont = $('.shop-pro-inner');
            var $gridView = $('.pro-gl-content');
            e.preventDefault();
            $gridCont.removeClass('list-view');
            $gridView.removeClass('width-100');
        }

        $(document).on('click', '.btn-grid', gridList);
        $(document).on('click', '.btn-list', showList);

        // for 50% width list view
        function showList50(e) {
            var $gridCont = $('.shop-pro-inner');
            var $listView = $('.pro-gl-content');
            e.preventDefault();
            $gridCont.addClass('list-view-50');
            $listView.addClass('width-50');
        }

        function gridList50(e) {
            var $gridCont = $('.shop-pro-inner');
            var $gridView = $('.pro-gl-content');
            e.preventDefault();
            $gridCont.removeClass('list-view-50');
            $gridView.removeClass('width-50');
        }

        $(document).on('click', '.btn-grid-50', gridList50);
        $(document).on('click', '.btn-list-50', showList50);

        /*----------------------------- Sidebar Block Toggle -------------------------------- */
        $(document).ready(function () {
            $(".ec-shop-leftside .ec-sidebar-block .ec-sb-block-content,.ec-blogs-leftside .ec-sidebar-block .ec-sb-block-content,.ec-cart-rightside .ec-sidebar-block .ec-sb-block-content,.ec-checkout-rightside .ec-sidebar-block .ec-sb-block-content").addClass("ec-sidebar-dropdown");

            $('.ec-sidebar-title').append("<div class='ec-sidebar-res'><i class='ecicon eci-angle-down'></i></div>");

            $(".ec-sidebar-title .ec-sidebar-res").click(function () {
                var $this = $(this).closest('.ec-shop-leftside .ec-sidebar-block,.ec-blogs-leftside .ec-sidebar-block,.ec-cart-rightside .ec-sidebar-block,.ec-checkout-rightside .ec-sidebar-wrap').find('.ec-sidebar-dropdown');
                $this.slideToggle('slow');
                $('.ec-sidebar-dropdown').not($this).slideUp('slow');
            });
        });

        /*----------------------------- Load More Category -------------------------------- */
        $(document).ready(function () {
            $(".ec-more-toggle").click(function () {
                var elem = $(".ec-more-toggle #ec-more-toggle").text();
                if (elem == "More Categories") {
                    $(".ec-more-toggle #ec-more-toggle").text("Less Categories");
                    $(".ec-more-toggle").toggleClass('active');
                    $("#ec-more-toggle-content").slideDown();
                } else {

                    $(".ec-more-toggle  #ec-more-toggle").text("More Categories");
                    $(".ec-more-toggle").removeClass('active');
                    $("#ec-more-toggle-content").slideUp();
                }
            });
        });

        /*----------------------------- Sidebar Color Click to Active -------------------------------- */
        $(document).ready(function () {
            $(".ec-sidebar-block.ec-sidebar-block-clr li").click(function () {
                $(this).addClass('active').siblings().removeClass('active');
            });
        });

        /*----------------------------- Faq Block Toggle -------------------------------- */
        $(document).ready(function () {
            $(".ec-faq-wrapper .ec-faq-block .ec-faq-content").addClass("ec-faq-dropdown");

            $(".ec-faq-block .ec-faq-title ").click(function () {
                var $this = $(this).closest('.ec-faq-wrapper .ec-faq-block').find('.ec-faq-dropdown');
                $this.slideToggle('slow');
                $('.ec-faq-dropdown').not($this).slideUp('slow');
            });
        });

        /*----------------------------- siderbar Product Slider -------------------------------- */
        $(document).ready(function () {
            $('.ec-sidebar-slider .ec-sb-pro-sl').slick({
                rows: 4,
                dots: false,
                arrows: true,
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            rows: 2,
                            slidesToShow: 2,
                            slidesToScroll: 2,
                            dots: false
                        }
                    },
                    {
                        breakpoint: 479,
                        settings: {
                            rows: 2,
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: false
                        }
                    }
                ]
            });
        });

        /*----------------------------- category Slider -------------------------------- */
        $('.ec-category-section .ec_cat_slider').slick({
            rows: 1,
            dots: false,
            arrows: true,
            infinite: true,
            speed: 500,
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToScroll: 3,
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToScroll: 2,
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 425,
                    settings: {
                        slidesToScroll: 1,
                        slidesToShow: 1,
                    }
                }
            ]
        });

        /*----------------------------- Catalog multi vendor Slider -------------------------------- */
        $('.ec-catalog-multi-vendor .ec-multi-vendor-slider').slick({
            rows: 1,
            dots: false,
            arrows: true,
            infinite: true,
            speed: 500,
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToScroll: 2,
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToScroll: 2,
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 425,
                    settings: {
                        slidesToScroll: 1,
                        slidesToShow: 1,
                    }
                }
            ]
        });

        /*----------------------------- single product Slider  ------------------------------ */
        $('.single-product-cover').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: false,
            asNavFor: '.single-nav-thumb',
        });

        $('.single-nav-thumb').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '.single-product-cover',
            dots: false,
            arrows: true,
            focusOnSelect: true
        });

        /*----------------------------- single product countdowntimer  ------------------------------ */
        $("#ec-single-countdown").countdowntimer({
            startDate: "2024/01/01 00:00:00",
            dateAndTime: "2025/01/01 00:00:00",
            labelsFormat: true,
            displayFormat: "DHMS"
        });

        /*----------------------------- Single Product Color and Size Click to Active -------------------------------- */
        $(document).ready(function () {
            $(".single-pro-content .ec-pro-variation .ec-pro-variation-content li").click(function () {
                $(this).addClass('active').siblings().removeClass('active');
            });
        });

        /*----------------------------- Slider Price -------------------------------- */
        const slider = document.getElementById('ec-sliderPrice');
        if (slider) {
            const rangeMin = parseInt(slider.dataset.min);
            const rangeMax = parseInt(slider.dataset.max);
            const step = parseInt(slider.dataset.step);
            const filterInputs = document.querySelectorAll('input.filter__input');

            noUiSlider.create(slider, {
                start: [rangeMin, rangeMax],
                connect: true,
                step: step,
                range: {
                    'min': rangeMin,
                    'max': rangeMax
                },

                // make numbers whole
                format: {
                    to: value => value,
                    from: value => value
                }
            });

            // bind inputs with noUiSlider 
            slider.noUiSlider.on('update', (values, handle) => {
                filterInputs[handle].value = values[handle];
            });

            filterInputs.forEach((input, indexInput) => {
                input.addEventListener('change', () => {
                    slider.noUiSlider.setHandle(indexInput, input.value);
                })
            });
        }

        /*----------------------------- Cart Page Qty Plus Minus Button  ------------------------------ */

        /*----------------------------- Cart  Shipping Toggle -------------------------------- */
        $(document).ready(function () {
            $(".ec-sb-block-content .ec-ship-title").click(function () {
                $('.ec-sb-block-content .ec-cart-form').slideToggle('slow');
            });
        });

        $(document).ready(function () {
            $("button.add-to-cart").click(function () {
                //$("#addtocart_toast").addClass("show");
                // setTimeout(function(){ $("#addtocart_toast").removeClass("show") }, 3000);
            });
            $(".ec-btn-group.wishlist").click(function () {
                var isWishlist = $(this).hasClass("active");
                if (isWishlist) {
                    $(this).removeClass("active");
                } else {
                    $(this).addClass("active");
                }


                $("#wishlist_toast").addClass("show");
                setTimeout(function () { $("#wishlist_toast").removeClass("show") }, 3000);
            });
        });

        $(document).ready(function () {
            $('.ec-pro-image').append("<div class='ec-pro-loader'></div>");
        });

        /*----------------------------- Apply Coupen Toggle -------------------------------- */
        $(document).ready(function () {
            $(".ec-cart-coupan").click(function () {
                $('.ec-cart-coupan-content').slideToggle('slow');
            });
            $(".ec-checkout-coupan").click(function () {
                $('.ec-checkout-coupan-content').slideToggle('slow');
            });
        });

        /*----------------------------- Recent auto popup -----------------------------------*/
        setInterval(function () { $(".recent-purchase").stop().slideToggle('slow'); }, 10000);
        $(".recent-close").click(function () {
            $(".recent-purchase").stop().slideToggle('slow');
        });

        /*----------------------------- Whatsapp chat --------------------------------*/
        $(document).ready(function () {

            //click event on a tag
            $('.ec-list').on("click", function () {

                var number = $(this).attr("data-number");
                var message = $(this).attr("data-message");

                //checking for device type
                if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                    // redirect link for mobile WhatsApp chat awc
                    window.open('https://wa.me/' + number + '/?text=' + message, '-blank');
                }
                else {
                    // redirect link for WhatsApp chat in website
                    window.open('https://web.WhatsApp.com/send?phone=' + number + '&text=' + message, '-blank');
                }
            })

            // chat widget open/close duration
            $('ec-style1').launchBtn({ openDuration: 400, closeDuration: 300 });
        });

        // chat panel open/close function
        $.fn.launchBtn = function (options) {
            var mainBtn, panel, clicks, settings, launchPanelAnim, closePanelAnim, openPanel, boxClick;

            mainBtn = $(".ec-button");
            panel = $(".ec-panel");
            clicks = 0;

            //default settings
            settings = $.extend({
                openDuration: 600,
                closeDuration: 200,
                rotate: true
            }, options);

            //Open panel animation
            launchPanelAnim = function () {
                panel.animate({
                    opacity: "toggle",
                    height: "toggle"
                }, settings.openDuration);
            };

            //Close panel animation
            closePanelAnim = function () {
                panel.animate({
                    opacity: "hide",
                    height: "hide"
                }, settings.closeDuration);
            };

            //Open panel and rotate icon
            openPanel = function (e) {
                if (clicks === 0) {
                    if (settings.rotate) {
                        $(this).removeClass('rotateBackward').toggleClass('rotateForward');
                    }

                    launchPanelAnim();
                    clicks++;
                } else {
                    if (settings.rotate) {
                        $(this).removeClass('rotateForward').toggleClass('rotateBackward');
                    }

                    closePanelAnim();
                    clicks--;
                }
                e.preventDefault();
                return false;
            };

            //Allow clicking in panel
            boxClick = function (e) {
                e.stopPropagation();
            };

            //Main button click
            mainBtn.on('click', openPanel);

            //Prevent closing panel when clicking inside
            panel.click(boxClick);

            //Click away closes panel when clicked in document
            $(document).click(function () {
                closePanelAnim();
                if (clicks === 1) {
                    mainBtn.removeClass('rotateForward').toggleClass('rotateBackward');
                }
                clicks = 0;
            });
        };

        /*----------------------------- User Profile Change on Upload -----------------------------------*/
        $("body").on("change", ".ec-image-upload", function (e) {

            var lkthislk = $(this);

            if (this.files && this.files[0]) {

                var reader = new FileReader();
                reader.onload = function (e) {

                    var ec_image_preview = lkthislk.parent().parent().children('.ec-preview').find('.ec-image-preview').attr('src', e.target.result);

                    ec_image_preview.hide();
                    ec_image_preview.fadeIn(650);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        /*----------------------------- bg skin ---------------------- */
        (function () {
            $().appendTo($('body'));
        })();

        $(".bg-option-box").on("click", function (e) {
            e.preventDefault();
            if ($(this).hasClass("in-out")) {
                $(".bg-switcher").stop().animate({ right: "0px" }, 100);
                if ($(".color-option-box").not("in-out")) {
                    $(".skin-switcher").stop().animate({ right: "-163px" }, 100);
                    $(".color-option-box").addClass("in-out");
                }
                if ($(".layout-option-box").not("in-out")) {
                    $(".layout-switcher").stop().animate({ right: "-163px" }, 100);
                    $(".layout-option-box").addClass("in-out");
                }
            } else {
                $(".bg-switcher").stop().animate({ right: "-163px" }, 100);
            }

            $(this).toggleClass("in-out");
            return false;

        });

        /*----------------------------- bg Image ---------------------- */
        $('.back-bg-1').on('click', function (e) {
            var bgID = $(this).attr("id");
            var bgClass = "body-bg-1";
            setBGImage(bgID, bgClass);
        });

        $('.back-bg-2').on('click', function (e) {
            var bgID = $(this).attr("id");
            var bgClass = "body-bg-2";
            setBGImage(bgID, bgClass);
        });

        $('.back-bg-3').on('click', function (e) {
            var bgID = $(this).attr("id");
            var bgClass = "body-bg-3";
            setBGImage(bgID, bgClass);
        });

        $('.back-bg-4').on('click', function (e) {
            var bgID = $(this).attr("id");
            var bgClass = "body-bg-4";
            setBGImage(bgID, bgClass);
        });



        /*----------------------------- Tools sidebar ---------------------- */
        $(".ec-tools-sidebar-toggle").on("click", function (e) {
            e.preventDefault();
            if ($(this).hasClass("in-out")) {
                $(".ec-tools-sidebar").stop().animate({ right: "0px" }, 100);
                $(".ec-tools-sidebar-overlay").fadeIn();
                if ($(".ec-tools-sidebar-toggle").not("in-out")) {
                    $(".ec-tools-sidebar").stop().animate({ right: "-200px" }, 100);
                    $(".ec-tools-sidebar-toggle").addClass("in-out");
                }
                if ($(".ec-tools-sidebar-toggle").not("in-out")) {
                    $(".ec-tools-sidebar").stop().animate({ right: "0" }, 100);
                    $(".ec-tools-sidebar-toggle").addClass("in-out");
                    $(".ec-tools-sidebar-overlay").fadeIn();
                }
            } else {
                $(".ec-tools-sidebar").stop().animate({ right: "-200px" }, 100);
                $(".ec-tools-sidebar-overlay").fadeOut();
            }

            $(this).toggleClass("in-out");
            return false;

        });

        $(".ec-tools-sidebar-overlay").on("click", function (e) {
            $(".ec-tools-sidebar-toggle").addClass("in-out");
            $(".ec-tools-sidebar").stop().animate({ right: "-200px" }, 100);
            $(".ec-tools-sidebar-overlay").fadeOut();
        });

        /*--------------------- Copyright years JS -------------------------------- */
        var date = new Date().getFullYear();

        // document.getElementById("copyright_year").innerHTML = date;

    })(jQuery);
});