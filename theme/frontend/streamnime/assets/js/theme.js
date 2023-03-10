document.addEventListener("DOMContentLoaded", function () {
    /* ==================================================
     DEFINE VARIABLES
    ================================================== */
    const navbar = document.getElementById("navbar"),
        mobileNavMenu = document.querySelector(".navbar-collapse"),
        mobileNavToggler = document.querySelector(".navbar-toggler");

    /* ==================================================
         CHANGING NAVBAR STYLING ON SCROLL
    ================================================== */
    window.addEventListener("scroll", function () {
        let windowScroll = document.scrollingElement.scrollTop;
        if (windowScroll >= 1) {
            navbar.classList.add("navbar-active");
        } else {
            navbar.classList.remove("navbar-active");
        }
    });

    /* =====================================================
        SHOW/HIDE NAVBAR ON SCROLLING
    ===================================================== */
    let c = 0,
        currentScrollTop = 0;

    window.addEventListener("scroll", function () {
        let a = document.body.parentNode.scrollTop;
        let b = navbar.offsetHeight;

        currentScrollTop = a;

        if (c < currentScrollTop && a > b + b) {
            navbar.classList.add("scrollUp");
            mobileNavToggler.classList.remove("collapsed");
            mobileNavMenu.classList.remove("show");
        } else if (c > currentScrollTop && !(a <= b)) {
            navbar.classList.remove("scrollUp");
        }
        c = currentScrollTop;
    });

    /* =====================================================
        AUTHOR FILTER CUSTOM SELECT
    ===================================================== */

    // Inject custom classes to Choices.js plugin
    function injectClassess(x) {
        let pickerCustomClass = x.dataset.customclass;
        let pickerSevClasses = pickerCustomClass.split(" ");
        x.parentElement.classList.add.apply(x.parentElement.classList, pickerSevClasses);
    }

    // All cateogries select
    const allCategoriesChoices = document.querySelector(".all-categories-choices");
    if (allCategoriesChoices) {
        const catChoices = new Choices(allCategoriesChoices, {
            searchEnabled: false,
            placeholder: true,
            itemSelectText: "",
            callbackOnInit: () => injectClassess(allCategoriesChoices),
        });
    }

    // All auctions select
    const allAuctionsChoices = document.querySelector(".all-auctions-choices");
    if (allAuctionsChoices) {
        const aucChoices = new Choices(allAuctionsChoices, {
            searchEnabled: false,
            placeholder: true,
            itemSelectText: "",
            callbackOnInit: () => injectClassess(allAuctionsChoices),
        });
    }

    // All items select
    const allItemsChoices = document.querySelector(".all-items-choices");
    if (allItemsChoices) {
        const itemsChoices = new Choices(allItemsChoices, {
            searchEnabled: false,
            placeholder: true,
            itemSelectText: "",
            callbackOnInit: () => injectClassess(allItemsChoices),
        });
    }

    /* =====================================================
        MIXITUP INITIALIZATION
    ===================================================== */
    if (document.querySelector(".mixitUpContainer")) {
        var mixer = mixitup(".mixitUpContainer");
    }

    /* =====================================================
        CHANGE INPUT GROUP ICON BORDER ON INPUT FOCUS 
    ===================================================== */
    const formInputs = document.querySelectorAll(".input-group .form-control");
    formInputs.forEach((el) => {
        if (el) {
            el.addEventListener("focus", () => {
                el.parentElement.querySelector(".input-group-text").classList.add("border-primary");
                el.classList.add("border-primary");
            });
            el.addEventListener("blur", () => {
                el.parentElement.querySelector(".input-group-text").classList.remove("border-primary");
                el.classList.remove("border-primary");
            });
        }
    });

    /* =====================================================
        AUTO FOCUS CONTACT PAGE FORM ON LOAD 
    ===================================================== */
    const contactForm = document.querySelector(".contact-form");
    if (contactForm) {
        window.addEventListener("load", function () {
            contactForm.querySelector(".form-control").focus();
        });
    }

    /* =====================================================
        CHANGE CREATE ITEM UNPUTS DEPENDING ON EACH METHOD
    ===================================================== */
    const createFormCheckboxes = document.querySelectorAll(".item-type input");
    createFormCheckboxes.forEach((el) => {
        el.addEventListener("change", () => {
            const timedAuction = document.querySelector("#timedAuction");
            const fixedPrice = document.querySelector("#fixedPrice");
            const openForBids = document.querySelector("#openForBids");
            if (timedAuction.checked == true) {
                document.querySelector("[data-form=fixedPrice]").style.display = "none";
                document.querySelector("[data-form=timedAuction]").style.display = "block";
            } else if (fixedPrice.checked == true) {
                document.querySelector("[data-form=timedAuction]").style.display = "none";
                document.querySelector("[data-form=fixedPrice]").style.display = "block";
            } else if (openForBids.checked == true) {
                document.querySelector("[data-form=timedAuction]").style.display = "none";
                document.querySelector("[data-form=fixedPrice]").style.display = "none";
            }
        });
    });

    /* =====================================================
        ITEMS SLIDER
    ===================================================== */
    const homeItemsSlider = new Swiper(".items-slider", {
        slidesPerView: 1,
        spaceBetween: 10,

        breakpoints: {
            761: {
                slidesPerView: 2,
            },
            991: {
                slidesPerView: 3,
            },
            1300: {
                slidesPerView: 4,
            },
        },

        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    /* =====================================================
        AUCTIONS SLIDER
    ===================================================== */
    const homeAuctionsSlider = new Swiper(".auctions-slider", {
        slidesPerView: 1,
        spaceBetween: 0,

        breakpoints: {
            761: {
                slidesPerView: 2,
            },
            991: {
                slidesPerView: 3,
            },
            1300: {
                slidesPerView: 4,
            },
        },

        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    /* =====================================================
        REMOVE PRELOADER AFTER DOM CONTENT LOADED
    ===================================================== */
    document.body.style.overflow = "auto";
    document.body.style.overflowX = "hidden";
    const preloaderInner = document.querySelector(".preloader-inner");

    if (preloaderInner) {
        preloaderInner.style.opacity = 0;
        setTimeout(function () {
            preloaderInner.parentElement.style.display = "none";
        }, 500);
    }

    /* =====================================================
        SCROLL TOP BUTTON [SHOW & HIDE & CLICKING]
    ===================================================== */
    const scrollTopBtn = document.querySelector(".scroll-top-btn");
    if (scrollTopBtn) {
        scrollTopBtn.addEventListener("click", function () {
            window.scrollTo(0, 0);
        });

        window.addEventListener("scroll", function () {
            if (window.pageYOffset >= 1000) {
                scrollTopBtn.classList.add("is-visible");
            } else {
                scrollTopBtn.classList.remove("is-visible");
            }
        });
    }

    /* =====================================================
        TOOLTIP INITALIZATION
    ===================================================== */
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    /* =================================================
        Bootstrap Toast
    ================================================= */
    // Initialize Bootstrap Toast
    var toastElList = [].slice.call(document.querySelectorAll(".toast"));
    var toastList = toastElList.map(function (toastEl) {
        return new bootstrap.Toast(toastEl);
    });

    // Show toast on first visit
    showToast(2000);

    function showToast(x) {
        for (let i = 0; i < toastList.length; i++) {
            setTimeout(function () {
                toastList[i].show();
            }, i * x);
        }
    }
    setInterval(function () {
        showToast(4000);
    }, 30000);

    /* =================================================
        Exit Intent Popups
    ================================================= */
    function addEvent(obj, evt, fn) {
        if (obj.addEventListener) {
            obj.addEventListener(evt, fn, false);
        } else if (obj.attachEvent) {
            obj.attachEvent("on" + evt, fn);
        }
    }

    if (document.getElementById("exitModal")) {
        addEvent(document, "mouseout", function (evt) {
            var modalId = "exitModal";
            if (evt.toElement === null && evt.relatedTarget === null && !sessionStorage.getItem("modal." + modalId)) {
                var modal = new bootstrap.Modal("#" + modalId);
                modal.show();
                sessionStorage.setItem("modal." + modalId, "1");
            }
            window.addEventListener("beforeunload", () => sessionStorage.removeItem("modal." + modalId));
        });
    }
});

/* =====================================================
        COPY TEXT ON CLICK
    ===================================================== */
function copyIdText() {
    /* Get the text field */
    const copyText = document.querySelector(".id-text");

    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */

    /* Copy the text inside the text field */
    navigator.clipboard.writeText(copyText.value);
}
