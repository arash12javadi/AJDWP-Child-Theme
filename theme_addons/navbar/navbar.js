var AJDWP_theme_navbar_js;
!(function (e, t) {
  "use strict";
  (AJDWP_theme_navbar_js = {
    eventID: "AJDWP_theme_navbar_js",
    $document: e(document),
    $window: e(window),
    $body: e("body"),
    classes: {
      toggled: "toggled",
      isOverlay: "overlay-enabled",
      headerMenuActive: "header-menu-active",
      headerSearchActive: "header-search-active",
    },
    init: function () {
      this.$document.on("ready", this.documentReadyRender.bind(this)),
        this.$document.on("ready", this.processAutoheight.bind(this)),
        this.$document.on("ready", this.mobileMenuClone.bind(this)),
        this.$document.on("ready", this.aboveHeaderMobile.bind(this)),
        this.$window.on("ready", this.documentReadyRender.bind(this));
    },
    documentReadyRender: function () {
      this.$document
        .on("click." + this.eventID, ".menu-toggle", this.menuToggleHandler.bind(this))
        .on("click." + this.eventID, ".header-close-menu", this.menuToggleHandler.bind(this))
        .on("click." + this.eventID, this.hideHeaderMobilePopup.bind(this))
        .on("click." + this.eventID, ".mobile-toggler", this.verticalMobileSubMenuLinkHandle.bind(this))
        .on("click." + this.eventID, ".header-close-menu", this.resetVerticalMobileMenu.bind(this))
        .on("hideHeaderMobilePopup." + this.eventID, this.resetVerticalMobileMenu.bind(this))
        .on("resize." + this.eventID, this.processAutoheight.bind(this))
        .on("click." + this.eventID, ".header-search-toggle", this.searchToggleHandler.bind(this))
        .on("click." + this.eventID, ".header-search-close", this.searchToggleHandler.bind(this))
        .on("click." + this.eventID, ".scrollup", this.scrollUpClick.bind(this)),
        this.$window
          .on("scroll." + this.eventID, this.scrollToSticky.bind(this))
          .on("scroll." + this.eventID, this.scrollUp.bind(this))
          .on("load." + this.eventID, this.mobileMenuRight.bind(this))
          .on("load." + this.eventID, this.menuFocusAccessibility.bind(this))
          .on("resize." + this.eventID, this.processAutoheight.bind(this));
    },
    scrollUp: function (t) {
      var s = e(".scrollup");
      this.$window.scrollTop() > 280 ? s.addClass("is-active") : s.removeClass("is-active");
    },
    scrollUpClick: function (t) {
      return (
        e("html, body").animate(
          {
            scrollTop: 0,
          },
          600
        ),
        !1
      );
    },
    scrollToSticky: function (t) {
      var s = e(".sticky-nav");
      this.$window.scrollTop() >= 220 ? s.addClass("sticky-menu") : s.removeClass("sticky-menu");
    },
    processAutoheight: function (t) {
      var s = e(".navigator-wrapper"),
        i = e(".navigator-wrapper > .theme-mobile-nav"),
        n = e(
          ".navigator-wrapper > .nav-area *:not(.logo):not(.search-button *):not(.cart-wrapper *):not(.dropdown-menu):not(.about-toggle-list *):not(.av-button-area *):not(.widget-wrap *):not(.hamburger-about *)"
        ),
        o = 0;
      e("body").find("div").hasClass("sticky-nav") &&
        ("block" == e("div.theme-mobile-nav").css("display")
          ? (i.each(function () {
              var t = e(this).outerHeight(!0);
              t > o && (o = t);
            }),
            s.css("min-height", o))
          : (n.each(function () {
              var t = e(this).outerHeight(!0);
              t > o && (o = t);
            }),
            s.css("min-height", o)));
    },
    mobileMenuRight: function (t) {
      e(".header-wrap-right").children().not(".search-button, .about-toggle-list").clone().appendTo(".mobile-menu-right .header-wrap-right");
    },
    mobileMenuClone: function (t) {
      e(".menubar .menu-wrap").clone().appendTo(".mobile-menu");
    },
    aboveHeaderAccessibility: function () {
      var e,
        t,
        s,
        i = document.querySelector(".mobi-head-top");
      let n = document.querySelector(".header-above-toggle"),
        o = i.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'),
        a = o[o.length - 1];
      if (!i) return !1;
      for (t = 0, s = (e = i.getElementsByTagName("a")).length; t < s; t++) e[t].addEventListener("focus", l, !0), e[t].addEventListener("blur", l, !0);

      function l() {
        for (var e = this; -1 === e.className.indexOf("mobi-head-top"); )
          "li" === e.tagName.toLowerCase() &&
            (-1 !== e.className.indexOf("focus") ? (e.className = e.className.replace(" focus", "")) : (e.className += " focus")),
            (e = e.parentElement);
      }
      document.addEventListener("keydown", function (e) {
        ("Tab" === e.key || 9 === e.keyCode) &&
          (e.shiftKey ? document.activeElement === n && (a.focus(), e.preventDefault()) : document.activeElement === a && (n.focus(), e.preventDefault()));
      });
    },
    aboveHeaderMobile: function () {
      var t = e(".mobi-head-top"),
        s = e(".header-widget"),
        i = e(".header-above-toggle");
      !s.children().length > 0
        ? (s.hide(), i.hide())
        : (i.show(),
          s.clone().appendTo(".mobi-head-top"),
          i.on("click", function (e) {
            t.toggleClass("active"), i.toggleClass("active"), e.preventDefault();
          }),
          this.aboveHeaderAccessibility());
    },
    menuFocusAccessibility: function (t) {
      e(".menubar, .widget_nav_menu")
        .find("a")
        .on("focus blur", function () {
          e(this).parents("ul, li").toggleClass("focus");
        });
    },
    menuToggleHandler: function (t) {
      var s = e(".menu-toggle");
      this.$body.toggleClass(this.classes.headerMenuActive),
        this.$body.toggleClass(this.classes.isOverlay),
        s.toggleClass(this.classes.toggled),
        this.$body.hasClass(this.classes.headerMenuActive) ? e(".header-close-menu").focus() : s.focus(),
        this.menuAccessibility();
    },
    hideHeaderMobilePopup: function (t) {
      var s = e(".menu-toggle"),
        i = e(".mobile-menu");
      e(t.target).closest(s).length ||
        e(t.target).closest(i).length ||
        (this.$body.hasClass(this.classes.headerMenuActive) &&
          (this.$body.removeClass(this.classes.headerMenuActive),
          this.$body.removeClass(this.classes.isOverlay),
          s.removeClass(this.classes.toggled),
          this.$document.trigger("hideHeaderMobilePopup." + this.eventID),
          t.stopPropagation()));
    },
    verticalMobileSubMenuLinkHandle: function (t) {
      t.preventDefault();
      var s = e(t.currentTarget),
        i = (s.closest(".mobile-menu .menu-wrap"), s.parents(".dropdown-menu").length);
      this.isRTL;
      setTimeout(function () {
        s.parent().toggleClass("current"), s.next().slideToggle();
      }, 250);
    },
    resetVerticalMobileMenu: function (t) {
      e(".mobile-menu .menu-wrap");
      var s = e(".mobile-menu  .menu-item"),
        i = e(".mobile-menu .dropdown-menu");
      setTimeout(function () {
        s.removeClass("current"), i.hide();
      }, 250);
    },
    menuAccessibility: function () {
      var e,
        t,
        s,
        i = document.querySelector(".mobile-menu");
      let n = document.querySelector(".header-close-menu"),
        o = i.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'),
        a = o[o.length - 1];
      if (!i) return !1;
      for (t = 0, s = (e = i.getElementsByTagName("a")).length; t < s; t++) e[t].addEventListener("focus", l, !0), e[t].addEventListener("blur", l, !0);

      function l() {
        for (var e = this; -1 === e.className.indexOf("mobile-menu"); )
          "li" === e.tagName.toLowerCase() &&
            (-1 !== e.className.indexOf("focus") ? (e.className = e.className.replace(" focus", "")) : (e.className += " focus")),
            (e = e.parentElement);
      }
      document.addEventListener("keydown", function (e) {
        ("Tab" === e.key || 9 === e.keyCode) &&
          (e.shiftKey ? document.activeElement === n && (a.focus(), e.preventDefault()) : document.activeElement === a && (n.focus(), e.preventDefault()));
      });
    },
    searchToggleHandler: function (t) {
      var s = e(".header-search-toggle"),
        i = e(".header-search-field");
      this.$body.toggleClass(this.classes.headerSearchActive),
        this.$body.toggleClass(this.classes.isOverlay),
        this.$body.hasClass(this.classes.headerSearchActive) ? i.focus() : s.focus(),
        this.searchPopupAccessibility();
    },
    searchPopupAccessibility: function () {
      var e,
        t,
        i,
        n = document.querySelector(".header-search-popup");
      let a = document.querySelector(".header-search-field"),
        s = n.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'),
        o = s[s.length - 1];
      if (!n) return !1;
      for (t = 0, i = (e = n.getElementsByTagName("button")).length; t < i; t++) e[t].addEventListener("focus", c, !0), e[t].addEventListener("blur", c, !0);

      function c() {
        for (var e = this; -1 === e.className.indexOf("header-search-popup"); )
          "input" === e.tagName.toLowerCase() &&
            (-1 !== e.className.indexOf("focus") ? (e.className = e.className.replace("focus", "")) : (e.className += " focus")),
            (e = e.parentElement);
      }
      document.addEventListener("keydown", function (e) {
        ("Tab" === e.key || 9 === e.keyCode) &&
          (e.shiftKey ? document.activeElement === a && (o.focus(), e.preventDefault()) : document.activeElement === o && (a.focus(), e.preventDefault()));
      });
    },
  }).init();
})(jQuery, window.gradiantConfig);

//Rotating the mobile menu icon v to ^
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".mobile-toggler").forEach((button) => {
    button.addEventListener("click", function () {
      // Toggle the 'rotated' class
      this.classList.toggle("rotated");
    });
  });
});
