(() => {
    function e(n) {
        return e = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
            return typeof e
        } : function(e) {
            return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
        }, e(n)
    }

    function n(e, n) {
        for (var i = 0; i < n.length; i++) {
            var o = n[i];
            o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, t(o.key), o)
        }
    }

    function t(n) {
        var t = function(n, t) {
            if ("object" != e(n) || !n) return n;
            var i = n[Symbol.toPrimitive];
            if (void 0 !== i) {
                var o = i.call(n, t || "default");
                if ("object" != e(o)) return o;
                throw new TypeError("@@toPrimitive must return a primitive value.")
            }
            return ("string" === t ? String : Number)(n)
        }(n, "string");
        return "symbol" == e(t) ? t : t + ""
    }
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    }), window.__ = function(e) {
        return window.trans = window.trans || {}, "undefined" !== window.trans[e] && window.trans[e] ? window.trans[e] : e
    }, $(document).ready((function() {
        var e = $("#home");
        "undefined" != typeof easy_background && e.length && easy_background("#home", {
            slide: e.data("images") || [],
            delay: [4e3, 4e3, 4e3]
        }), (new i).init()
    }));
    var i = function() {
        return e = function e() {
            ! function(e, n) {
                if (!(e instanceof n)) throw new TypeError("Cannot call a class as a function")
            }(this, e)
        }, t = [{
            key: "init",
            value: function() {
                this.keyword(), this.location(), this.project();
                var e = new URLSearchParams(window.location.search),
                    n = $(".item-search.search-ajax");
                if (n.length) {
                    "property" === n.data("target") && e.get("type") && $("#" + e.get("type") + "-tab").click();
                    var t = $(".item-search.search-ajax").data("target"),
                        i = $("#searchTab"),
                        o = $(".search-filter");
                    "property" === t ? (i.find("#projects-tab").remove(), o.find("#projects").remove(), ($("#sale-tab") || $("#rent-tab")).click()) : "project" === t && i.remove()
                }
                $(document).on("click", ".search-filter .toggle-advanced-search", (function() {
                    $(this).siblings(".advanced-search").toggleClass("hidden")
                })), $("#searchTab").on("click", "button", (function() {
                    $(this).parents("#searchTab").siblings(".search-filter").find(".advanced-search").addClass("hidden")
                })), $("body").on("click", (function(e) {
                    $(e.target).is("#location-suggestion") || $("#location-suggestion").find("ul").html(null), $(e.target).is("#keyword-suggestion") || $("#keyword-suggestion").find("ul").html(null)
                }))
            }
        }, {
            key: "keyword",
            // value: function() {
            //     $(".search-filter").on("keyup", 'input[name="k"]', (function() {
            //         var e = $(this).closest("form"),
            //             n = e.find('input[name="k"]').parent();
            //             console.log(n)
            //         n.find(".mdi-loading").removeClass("hidden"), setTimeout((function() {
            //             var t = e.find('input[name="k"]').val(),
            //                 i = e.find('input[name="type"]').val(),
            //                 o = new URLSearchParams;
            //             o.append("type", i), o.append("k", t), o.append("minimal", !0);
            //             var a = "".concat(e.data("ajax-url"), "?").concat(o.toString());
            //             $.post(a, (function(e) {
            //                 n.find(".mdi-loading").addClass("hidden"), n.append(e), n.find("#keyword-suggestion").removeClass("hidden")
            //             }))
            //         }), 500)
            //     })).on("keydown", 'input[name="k"]', (function() {
            //         $(".search-filter").find("#keyword-suggestion").remove()
            //     }))
            // }
        }, {
            key: "location",
            value: function() {
                var e = null;
                $(".search-filter").on("keyup", 'input[name="location"]', (function() {
                    var n = $(this);
                    n.siblings(".mdi-loading").removeClass("hidden"), clearTimeout(e), e = setTimeout((function() {
                        var e = n.val(),
                            t = "".concat(n.data("url"), "?location=").concat(e);
                        $.get(t, (function(e) {
                            n.siblings(".mdi-loading").addClass("hidden");
                            var t = n.closest(".filter-search-form");
                            t.append(e.data), t.find("#location-suggestion").removeClass("hidden")
                        }))
                    }), 500)
                })).on("keydown", 'input[name="location"]', (function() {
                    $(".search-filter").find("#location-suggestion").remove()
                })).on("click", "#location-suggestion ul li", (function() {
                    $(this).closest(".filter-search-form").find('input[name="location"]').val($(this).data("location")), $(".search-filter").find("#location-suggestion ul").remove()
                }))
            }
        }, {
            key: "project",
            value: function() {
                var e = null;
                $(".search-filter").on("keyup", 'input[name="project"]', (function() {
                    var n = $(this);
                    n.siblings(".mdi-loading").removeClass("hidden"), clearTimeout(e), e = setTimeout((function() {
                        var e = n.val(),
                            t = "".concat(n.data("url"), "?project=").concat(e);
                        $.get(t, (function(e) {
                            n.siblings(".mdi-loading").addClass("hidden");
                            var t = n.closest(".filter-search-form");
                            t.append(e.data), t.find("#projects-suggestion").removeClass("hidden")
                        }))
                    }), 500)
                })).on("keydown", 'input[name="project"]', (function() {
                    $(".search-filter").find("#projects-suggestion").remove()
                })).on("click", "#projects-suggestion ul li", (function() {
                    $(this).closest(".filter-search-form").find('input[name="project"]').val($(this).data("project")), $(".search-filter").find("#projects-suggestion ul").remove()
                }))
            }
        }], t && n(e.prototype, t), i && n(e, i), Object.defineProperty(e, "prototype", {
            writable: !1
        }), e;
        var e, t, i
    }()
})();