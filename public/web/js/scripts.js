! function(e) {
    "use strict";
    e(function() {
        e('.header-menu a[href="#"]').on("click", function(e) {
            e.preventDefault()
        }), e(".header-menu").menumaker({
            title: '<i class="fa fa-bars"></i>',
            format: "multitoggle"
        });
        var t = e(".main-header");
        if (t.length) new Waypoint.Sticky({
            element: t[0]
        });
        e("[data-bg-img]").css("background", function() {
            return "url(" + e(this).data("bg-img") + ") center center"
        }), e(".parsley-validate, .parsley-validate form").parsley(), e(".comment-content > a").on("click", function(t) {
            t.preventDefault();
            var i = e(".comment-form");
            i.length && (e("html, body").animate({
                scrollTop: i.offset().top - 120
            }, 500), i.find("textarea").focus())
        }), new Swiper(".main-slider", {
            loop: true,
            spaceBetween: 1,
            speed: 500,
            autoplay: true,
            pagination: true
        }).on("slideChangeTransitionStart", function() {
            e(this.slides[this.activeIndex]).find("[data-animate]").each(function() {
                var t = e(this);
                t.removeClass("animated " + t.data("animate"))
            })
        }).on("slideChangeTransitionEnd", function() {
            e(this.slides[this.activeIndex]).find("[data-animate]").each(function() {
                var t = e(this),
                    i = t.data("duration"),
                    a = t.data("delay");
                i = void 0 === i ? "0.6" : i, a = void 0 === a ? "0" : a, t.addClass("animated " + t.data("animate")).css({
                    "animation-duration": i + "s",
                    "animation-delay": a + "s"
                })
            })
        });
        new Swiper(".review-slider", {
            spaceBetween: 30,
            speed: 500,
            autoplay: {
                delay: 5e3,
                disableOnInteraction: !0
            },
            navigation: {
                prevEl: ".prev-review",
                nextEl: ".next-review"
            }
        }), new Swiper(".team-carousel", {
            slidesPerView: 4,
            spaceBetween: 30,
            speed: 500,
            autoplay: {
                delay: 5e3,
                disableOnInteraction: !0
            },
            navigation: {
                prevEl: ".prev-member",
                nextEl: ".next-member"
            },
            breakpoints: {
                991: {
                    slidesPerView: 3
                },
                767: {
                    slidesPerView: 2
                },
                575: {
                    slidesPerView: 1
                }
            }
        }), new Swiper(".news-carousel", {
            slidesPerView: 3,
            spaceBetween: 30,
            speed: 500,
            autoplay: {
                delay: 5e3,
                disableOnInteraction: !0
            },
            pagination: {
                el: ".news-pagination",
                clickable: !0
            },
            breakpoints: {
                991: {
                    slidesPerView: 2
                },
                767: {
                    slidesPerView: 1
                }
            }
        }), new Swiper(".pricing-carousel", {
            slidesPerView: 3,
            spaceBetween: 30,
            speed: 500,
            autoplay: {
                delay: 5e3,
                disableOnInteraction: !0
            },
            pagination: {
                el: ".pricing-pagination",
                clickable: !0
            },
            breakpoints: {
                991: {
                    slidesPerView: 2
                },
                767: {
                    slidesPerView: 1
                }
            }
        }), new Swiper(".service-carousel", {
            slidesPerView: 3,
            spaceBetween: 30,
            speed: 500,
            autoplay: {
                delay: 5e3,
                disableOnInteraction: !0
            },
            navigation: {
                prevEl: ".prev-service",
                nextEl: ".next-service"
            },
            breakpoints: {
                991: {
                    slidesPerView: 3
                },
                767: {
                    slidesPerView: 2
                },
                575: {
                    slidesPerView: 1
                }
            }
        }), new Swiper(".includes-carousel", {
            slidesPerView: 5,
            spaceBetween: 30,
            speed: 500,
            autoplay: {
                delay: 5e3,
                disableOnInteraction: !0
            },
            navigation: {
                prevEl: ".prev-inc-car",
                nextEl: ".next-inc-car"
            },
            breakpoints: {
                1199: {
                    slidesPerView: 4
                },
                991: {
                    slidesPerView: 3
                },
                767: {
                    slidesPerView: 2
                },
                575: {
                    slidesPerView: 1
                }
            }
        });
        var i = e(".product-gallery"),
            a = e(".product-thumbs");
        if (i.length) {
            var s = new Swiper(i[0], {
                spaceBetween: 1,
                touchRatio: 0,
                pagination: {
                    el: ".product-gallery-pagination",
                    clickable: !1
                }
            });
            new Swiper(a[0], {
                spaceBetween: 10,
                slidesPerView: 3,
                slideToClickedSlide: !0
            });
            a.on("click", ".swiper-slide", function(t) {
                var i = e(this);
                s.slideTo(i.index()), i.addClass("active").siblings().removeClass("active")
            })
        }
        var o = e("#map");
        o.length && (o.css("height", 400), function() {
            var e = new google.maps.Map(o[0], {
                center: {
                    lat: o.data("map-latitude"),
                    lng: o.data("map-longitude")
                },
                zoom: o.data("map-zoom"),
                scrollwheel: !1,
                disableDefaultUI: !0,
                zoomControl: !0,
                styles: [{
                    featureType: "all",
                    elementType: "labels.text.fill",
                    stylers: [{
                        saturation: 36
                    }, {
                        color: "#000000"
                    }, {
                        lightness: 40
                    }]
                }, {
                    featureType: "all",
                    elementType: "labels.text.stroke",
                    stylers: [{
                        visibility: "on"
                    }, {
                        color: "#000000"
                    }, {
                        lightness: 16
                    }]
                }, {
                    featureType: "all",
                    elementType: "labels.icon",
                    stylers: [{
                        visibility: "off"
                    }]
                }, {
                    featureType: "administrative",
                    elementType: "geometry.fill",
                    stylers: [{
                        color: "#000000"
                    }, {
                        lightness: 20
                    }]
                }, {
                    featureType: "administrative",
                    elementType: "geometry.stroke",
                    stylers: [{
                        color: "#000000"
                    }, {
                        lightness: 17
                    }, {
                        weight: 1.2
                    }]
                }, {
                    featureType: "landscape",
                    elementType: "geometry",
                    stylers: [{
                        color: "#000000"
                    }, {
                        lightness: 20
                    }]
                }, {
                    featureType: "poi",
                    elementType: "geometry",
                    stylers: [{
                        color: "#000000"
                    }, {
                        lightness: 21
                    }]
                }, {
                    featureType: "road.highway",
                    elementType: "geometry.fill",
                    stylers: [{
                        color: "#000000"
                    }, {
                        lightness: 17
                    }]
                }, {
                    featureType: "road.highway",
                    elementType: "geometry.stroke",
                    stylers: [{
                        color: "#000000"
                    }, {
                        lightness: 29
                    }, {
                        weight: .2
                    }]
                }, {
                    featureType: "road.arterial",
                    elementType: "geometry",
                    stylers: [{
                        color: "#000000"
                    }, {
                        lightness: 18
                    }]
                }, {
                    featureType: "road.local",
                    elementType: "geometry",
                    stylers: [{
                        color: "#000000"
                    }, {
                        lightness: 16
                    }]
                }, {
                    featureType: "transit",
                    elementType: "geometry",
                    stylers: [{
                        color: "#000000"
                    }, {
                        lightness: 19
                    }]
                }, {
                    featureType: "water",
                    elementType: "geometry",
                    stylers: [{
                        color: "#000000"
                    }, {
                        lightness: 17
                    }]
                }]
            });
            if (void 0 !== o.data("map-marker"))
                for (var t = o.data("map-marker"), i = 0; i < t.length; i++) new google.maps.Marker({
                    position: {
                        lat: t[i][0],
                        lng: t[i][1]
                    },
                    map: e,
                    animation: google.maps.Animation.DROP,
                    draggable: !0
                })
        }());
        var r = e(".back-to-top");
        if (r.length) {
            var n = function() {
                e(window).scrollTop() > 400 ? r.addClass("show") : r.removeClass("show")
            };
            n(), e(window).on("scroll", function() {
                n()
            }), r.on("click", function(t) {
                t.preventDefault(), e("html,body").animate({
                    scrollTop: 0
                }, 700)
            })
        }

        function l() {
            e(".page-image").height(function() {
                return e(this).width()
            })
        }
        e(".plus").on("click", function() {
            var t = e(this).parent().find("input"),
                i = parseInt(t.val());
            isNaN(i) || t.val(i + 1)
        }), e(".minus").on("click", function() {
            var t = e(this).parent().find("input"),
                i = parseInt(t.val());
            !isNaN(i) && i > 1 && t.val(i - 1)
        }), e(".isotope").isotope({
            itemSelector: ".isotope > div"
        }), jQuery("img.svg").each(function() {
            var e = jQuery(this),
                t = e.attr("id"),
                i = e.attr("class"),
                a = e.attr("src");
            jQuery.get(a, function(a) {
                var s = jQuery(a).find("svg");
                void 0 !== t && (s = s.attr("id", t)), void 0 !== i && (s = s.attr("class", i + " replaced-svg")), !(s = s.removeAttr("xmlns:a")).attr("viewBox") && s.attr("height") && s.attr("width") && s.attr("viewBox", "0 0 " + s.attr("height") + " " + s.attr("width")), e.replaceWith(s)
            }, "xml")
        }), l(), e(window).resize(function() {
            l()
        });
        ColorSwitcher.init([{
            color: "#00c544",
            title: "Switch to color-1",
            href: "css/colors/theme-color-1.css"
        }, {
            color: "#f69323",
            title: "Switch to color-2",
            href: "css/colors/theme-color-2.css"
        }, {
            color: "#605CB8",
            title: "Switch to color-3",
            href: "css/colors/theme-color-3.css"
        }, {
            color: "#2E5AE8",
            title: "Switch to color-4",
            href: "css/colors/theme-color-4.css"
        }, {
            color: "#303030",
            title: "Switch to color-5",
            href: "css/colors/theme-color-5.css"
        }, {
            color: "#ffcb1a",
            title: "Switch to color-6",
            href: "css/colors/theme-color-6.css"
        }, {
            color: "#7d1935",
            title: "Switch to color-7",
            href: "css/colors/theme-color-7.css"
        }, {
            color: "#d48b91",
            title: "Switch to color-8",
            href: "css/colors/theme-color-8.css"
        }, {
            color: "#179ea8",
            title: "Switch to color-9",
            href: "css/colors/theme-color-9.css"
        }, {
            color: "#871df1",
            title: "Switch to color-10",
            href: "css/colors/theme-color-10.css"
        }])
    }), e(window).on("load", function() {
        setTimeout(function() {
            e(".preLoader").fadeOut()
        }, 250)
    }), e(window).on("load", function() {
        e("[data-animate]").each(function() {
            var t = e(this),
                i = t.data("animate"),
                a = t.data("duration"),
                s = t.data("delay");
            a = void 0 === a ? "0.6" : a, s = void 0 === s ? ".1" : s, t.waypoint(function() {
                t.addClass("animated " + i).css({
                    "animation-duration": a + "s",
                    "animation-delay": s + "s"
                })
            }, {
                offset: "93%"
            })
        })
    }), 
    // e(window).on("load", function() {
    //     e(".gallery-item").isotope({
    //         itemSelector: ".grid-item",
    //         percentPosition: !0,
    //         masonry: {
    //             columnWidth: ".grid-item"
    //         }
    //     }), e(".gallery_filter li").on("click", function() {
    //         e(this).addClass("active").siblings().removeClass("active");
    //         var t = e(this).attr("data-filter");
    //         e(".grid").isotope({
    //             filter: t
    //         })
    //     })
    // }),
    //  e(function() {
    //     e("#slider-range").slider({
    //         range: !0,
    //         min: 0,
    //         max: 99,
    //         values: [0, 99],
    //         slide: function(t, i) {
    //             e("#amount").val("$" + i.values[0] + " - $" + i.values[1])
    //         }
    //     }), e("#amount").val("$" + e("#slider-range").slider("values", 0) + " - $" + e("#slider-range").slider("values", 1))
    // });
    // var t = e(".product-gallery"),
    //     i = e(".product-thumbs");
    // if (t.length) {
    //     var a = new Swiper(t[0], {
    //         spaceBetween: 1,
    //         touchRatio: 0,
    //         pagination: {
    //             el: ".product-gallery-pagination",
    //             clickable: !0
    //         }
    //     });
    //     new Swiper(i[0], {
    //         spaceBetween: 10,
    //         slidesPerView: 3,
    //         slideToClickedSlide: !0
    //     }), new Swiper(".product-gallery", {
    //         pagination: {
    //             el: ".swiper-pagination",
    //             clickable: !0
    //         },
    //         navigation: {
    //             nextEl: ".swiper-button-next",
    //             prevEl: ".swiper-button-prev"
    //         }
    //     });
    //     i.on("click", ".swiper-slide", function(t) {
    //         var i = e(this);
    //         a.slideTo(i.index()), i.addClass("active").siblings().removeClass("active")
    //     })
    // }
    // lightbox.option({
    //     resizeDuration: 200,
    //     wrapAround: !0,
    //     fixedNavigation: !0,
    //     alwaysShowNav: !0
    // })
    // , 
    e(".plus").on("click", function() {
        var t = e(this).parent().find("input"),
            i = parseInt(t.val());
        isNaN(i) || t.val(i + 1)
    }), e(".minus").on("click", function() {
        var t = e(this).parent().find("input"),
            i = parseInt(t.val());
        !isNaN(i) && i > 1 && t.val(i - 1)
    }), e(".header-search input").on("focus", function() {
        e(this).css({
            width: "170px"
        }), e(".header-menu>ul").css("margin-right", "55px"), e(window).width() < 992 && e(".header-menu").css("margin-right", "55px")
    }).on("blur", function() {
        e(this).css("width", "82px"), e(".header-menu>ul").css("margin-right", "0px"), e(window).width() < 992 && e(".header-menu").css("margin-right", "0")
    });
    new Swiper(".partner-slider", {
        loop: !0,
        slidesPerView: 4,
        spaceBetween: 70,
        speed: 500,
        autoplay: {
            delay: 5e3,
            disableOnInteraction: !0
        },
        breakpoints: {
            1199: {
                slidesPerView: 3
            },
            991: {
                slidesPerView: 5
            },
            767: {
                slidesPerView: 4
            },
            575: {
                slidesPerView: 1
            }
        }
    })
}(jQuery);