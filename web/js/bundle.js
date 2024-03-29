function initialize() {
    var e = [{
        featureType: "road.highway",
        elementType: "geometry",
        stylers: [{saturation: -100}, {lightness: -8}, {gamma: 1.18}]
    }, {
        featureType: "road.arterial",
        elementType: "geometry",
        stylers: [{saturation: -100}, {gamma: 1}, {lightness: -24}]
    }, {featureType: "poi", elementType: "geometry", stylers: [{saturation: -100}]}, {
        featureType: "administrative",
        stylers: [{saturation: -100}]
    }, {featureType: "transit", stylers: [{saturation: -100}]}, {
        featureType: "water",
        elementType: "geometry.fill",
        stylers: [{saturation: -100}]
    }, {featureType: "road", stylers: [{saturation: -100}]}, {
        featureType: "administrative",
        stylers: [{saturation: -100}]
    }, {featureType: "landscape", stylers: [{saturation: -100}]}, {
        featureType: "poi",
        stylers: [{saturation: -100}]
    }, {}], t = {
        zoom: 15,
        scrollwheel: !1,
        center: mapAddress,
        mapTypeControlOptions: {mapTypeIds: [google.maps.MapTypeId.ROADMAP, "usroadatlas"]}
    };
    map = new google.maps.Map(document.getElementById("map-canvas"), t);
    var n = {}, i = (new google.maps.Marker({position: mapAddress, map: map}), new google.maps.StyledMapType(e, n));
    map.mapTypes.set("usroadatlas", i), map.setMapTypeId("usroadatlas")
}
if (function (e, t) {
        if ("function" == typeof define && define.amd) define(["module", "exports"], t); else if ("undefined" != typeof exports) t(module, exports); else {
            var n = {exports: {}};
            t(n, n.exports), e.WOW = n.exports
        }
    }(this, function (e, t) {
        "use strict";
        function n(e, t) {
            if (!(e instanceof t))throw new TypeError("Cannot call a class as a function")
        }

        function i(e, t) {
            return t.indexOf(e) >= 0
        }

        function a(e, t) {
            for (var n in t)if (null == e[n]) {
                var i = t[n];
                e[n] = i
            }
            return e
        }

        function r(e) {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(e)
        }

        function o(e) {
            var t = arguments.length <= 1 || void 0 === arguments[1] ? !1 : arguments[1], n = arguments.length <= 2 || void 0 === arguments[2] ? !1 : arguments[2], i = arguments.length <= 3 || void 0 === arguments[3] ? null : arguments[3], a = void 0;
            return null != document.createEvent ? (a = document.createEvent("CustomEvent"), a.initCustomEvent(e, t, n, i)) : null != document.createEventObject ? (a = document.createEventObject(), a.eventType = e) : a.eventName = e, a
        }

        function s(e, t) {
            null != e.dispatchEvent ? e.dispatchEvent(t) : t in (null != e) ? e[t]() : "on" + t in (null != e) && e["on" + t]()
        }

        function l(e, t, n) {
            null != e.addEventListener ? e.addEventListener(t, n, !1) : null != e.attachEvent ? e.attachEvent("on" + t, n) : e[t] = n
        }

        function d(e, t, n) {
            null != e.removeEventListener ? e.removeEventListener(t, n, !1) : null != e.detachEvent ? e.detachEvent("on" + t, n) : delete e[t]
        }

        function u() {
            return "innerHeight" in window ? window.innerHeight : document.documentElement.clientHeight
        }

        Object.defineProperty(t, "__esModule", {value: !0});
        var p, c, f = function () {
            function e(e, t) {
                for (var n = 0; n < t.length; n++) {
                    var i = t[n];
                    i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
                }
            }

            return function (t, n, i) {
                return n && e(t.prototype, n), i && e(t, i), t
            }
        }(), h = window.WeakMap || window.MozWeakMap || function () {
                function e() {
                    n(this, e), this.keys = [], this.values = []
                }

                return f(e, [{
                    key: "get", value: function (e) {
                        for (var t = 0; t < this.keys.length; t++) {
                            var n = this.keys[t];
                            if (n === e)return this.values[t]
                        }
                        return void 0
                    }
                }, {
                    key: "set", value: function (e, t) {
                        for (var n = 0; n < this.keys.length; n++) {
                            var i = this.keys[n];
                            if (i === e)return this.values[n] = t, this
                        }
                        return this.keys.push(e), this.values.push(t), this
                    }
                }]), e
            }(), m = window.MutationObserver || window.WebkitMutationObserver || window.MozMutationObserver || (c = p = function () {
                function e() {
                    n(this, e), "undefined" != typeof console && null !== console && (console.warn("MutationObserver is not supported by your browser."), console.warn("WOW.js cannot detect dom mutations, please call .sync() after loading new content."))
                }

                return f(e, [{
                    key: "observe", value: function () {
                    }
                }]), e
            }(), p.notSupported = !0, c), g = window.getComputedStyle || function (e) {
                var t = /(\-([a-z]){1})/g;
                return {
                    getPropertyValue: function (n) {
                        "float" === n && (n = "styleFloat"), t.test(n) && n.replace(t, function (e, t) {
                            return t.toUpperCase()
                        });
                        var i = e.currentStyle;
                        return (null != i ? i[n] : void 0) || null
                    }
                }
            }, v = function () {
            function e() {
                var t = arguments.length <= 0 || void 0 === arguments[0] ? {} : arguments[0];
                n(this, e), this.defaults = {
                    boxClass: "wow",
                    animateClass: "animated",
                    offset: 0,
                    mobile: !0,
                    live: !0,
                    callback: null,
                    scrollContainer: null
                }, this.animate = function () {
                    return "requestAnimationFrame" in window ? function (e) {
                            return window.requestAnimationFrame(e)
                        } : function (e) {
                            return e()
                        }
                }(), this.vendors = ["moz", "webkit"], this.start = this.start.bind(this), this.resetAnimation = this.resetAnimation.bind(this), this.scrollHandler = this.scrollHandler.bind(this), this.scrollCallback = this.scrollCallback.bind(this), this.scrolled = !0, this.config = a(t, this.defaults), null != t.scrollContainer && (this.config.scrollContainer = document.querySelector(t.scrollContainer)), this.animationNameCache = new h, this.wowEvent = o(this.config.boxClass)
            }

            return f(e, [{
                key: "init", value: function () {
                    this.element = window.document.documentElement, i(document.readyState, ["interactive", "complete"]) ? this.start() : l(document, "DOMContentLoaded", this.start), this.finished = []
                }
            }, {
                key: "start", value: function () {
                    var e = this;
                    if (this.stopped = !1, this.boxes = [].slice.call(this.element.querySelectorAll("." + this.config.boxClass)), this.all = this.boxes.slice(0), this.boxes.length)if (this.disabled()) this.resetStyle(); else for (var t = 0; t < this.boxes.length; t++) {
                        var n = this.boxes[t];
                        this.applyStyle(n, !0)
                    }
                    if (this.disabled() || (l(this.config.scrollContainer || window, "scroll", this.scrollHandler), l(window, "resize", this.scrollHandler), this.interval = setInterval(this.scrollCallback, 50)), this.config.live) {
                        var i = new m(function (t) {
                            for (var n = 0; n < t.length; n++)for (var i = t[n], a = 0; a < i.addedNodes.length; a++) {
                                var r = i.addedNodes[a];
                                e.doSync(r)
                            }
                            return void 0
                        });
                        i.observe(document.body, {childList: !0, subtree: !0})
                    }
                }
            }, {
                key: "stop", value: function () {
                    this.stopped = !0, d(this.config.scrollContainer || window, "scroll", this.scrollHandler), d(window, "resize", this.scrollHandler), null != this.interval && clearInterval(this.interval)
                }
            }, {
                key: "sync", value: function () {
                    m.notSupported && this.doSync(this.element)
                }
            }, {
                key: "doSync", value: function (e) {
                    if (("undefined" == typeof e || null === e) && (e = this.element), 1 === e.nodeType) {
                        e = e.parentNode || e;
                        for (var t = e.querySelectorAll("." + this.config.boxClass), n = 0; n < t.length; n++) {
                            var a = t[n];
                            i(a, this.all) || (this.boxes.push(a), this.all.push(a), this.stopped || this.disabled() ? this.resetStyle() : this.applyStyle(a, !0), this.scrolled = !0)
                        }
                    }
                }
            }, {
                key: "show", value: function (e) {
                    return this.applyStyle(e), e.className = e.className + " " + this.config.animateClass, null != this.config.callback && this.config.callback(e), s(e, this.wowEvent), l(e, "animationend", this.resetAnimation), l(e, "oanimationend", this.resetAnimation), l(e, "webkitAnimationEnd", this.resetAnimation), l(e, "MSAnimationEnd", this.resetAnimation), e
                }
            }, {
                key: "applyStyle", value: function (e, t) {
                    var n = this, i = e.getAttribute("data-wow-duration"), a = e.getAttribute("data-wow-delay"), r = e.getAttribute("data-wow-iteration");
                    return this.animate(function () {
                        return n.customStyle(e, t, i, a, r)
                    })
                }
            }, {
                key: "resetStyle", value: function () {
                    for (var e = 0; e < this.boxes.length; e++) {
                        var t = this.boxes[e];
                        t.style.visibility = "visible"
                    }
                    return void 0
                }
            }, {
                key: "resetAnimation", value: function (e) {
                    if (e.type.toLowerCase().indexOf("animationend") >= 0) {
                        var t = e.target || e.srcElement;
                        t.className = t.className.replace(this.config.animateClass, "").trim()
                    }
                }
            }, {
                key: "customStyle", value: function (e, t, n, i, a) {
                    return t && this.cacheAnimationName(e), e.style.visibility = t ? "hidden" : "visible", n && this.vendorSet(e.style, {animationDuration: n}), i && this.vendorSet(e.style, {animationDelay: i}), a && this.vendorSet(e.style, {animationIterationCount: a}), this.vendorSet(e.style, {animationName: t ? "none" : this.cachedAnimationName(e)}), e
                }
            }, {
                key: "vendorSet", value: function (e, t) {
                    for (var n in t)if (t.hasOwnProperty(n)) {
                        var i = t[n];
                        e["" + n] = i;
                        for (var a = 0; a < this.vendors.length; a++) {
                            var r = this.vendors[a];
                            e["" + r + n.charAt(0).toUpperCase() + n.substr(1)] = i
                        }
                    }
                }
            }, {
                key: "vendorCSS", value: function (e, t) {
                    for (var n = g(e), i = n.getPropertyCSSValue(t), a = 0; a < this.vendors.length; a++) {
                        var r = this.vendors[a];
                        i = i || n.getPropertyCSSValue("-" + r + "-" + t)
                    }
                    return i
                }
            }, {
                key: "animationName", value: function (e) {
                    var t = void 0;
                    try {
                        t = this.vendorCSS(e, "animation-name").cssText
                    } catch (n) {
                        t = g(e).getPropertyValue("animation-name")
                    }
                    return "none" === t ? "" : t
                }
            }, {
                key: "cacheAnimationName", value: function (e) {
                    return this.animationNameCache.set(e, this.animationName(e))
                }
            }, {
                key: "cachedAnimationName", value: function (e) {
                    return this.animationNameCache.get(e)
                }
            }, {
                key: "scrollHandler", value: function () {
                    this.scrolled = !0
                }
            }, {
                key: "scrollCallback", value: function () {
                    if (this.scrolled) {
                        this.scrolled = !1;
                        for (var e = [], t = 0; t < this.boxes.length; t++) {
                            var n = this.boxes[t];
                            if (n) {
                                if (this.isVisible(n)) {
                                    this.show(n);
                                    continue
                                }
                                e.push(n)
                            }
                        }
                        this.boxes = e, this.boxes.length || this.config.live || this.stop()
                    }
                }
            }, {
                key: "offsetTop", value: function (e) {
                    for (; void 0 === e.offsetTop;)e = e.parentNode;
                    for (var t = e.offsetTop; e.offsetParent;)e = e.offsetParent, t += e.offsetTop;
                    return t
                }
            }, {
                key: "isVisible", value: function (e) {
                    var t = e.getAttribute("data-wow-offset") || this.config.offset, n = this.config.scrollContainer && this.config.scrollContainer.scrollTop || window.pageYOffset, i = n + Math.min(this.element.clientHeight, u()) - t, a = this.offsetTop(e), r = a + e.clientHeight;
                    return i >= a && r >= n
                }
            }, {
                key: "disabled", value: function () {
                    return !this.config.mobile && r(navigator.userAgent)
                }
            }]), e
        }();
        t["default"] = v, e.exports = t["default"]
    }), !function (e, t) {
        "object" == typeof module && "object" == typeof module.exports ? module.exports = e.document ? t(e, !0) : function (e) {
                    if (!e.document)throw new Error("jQuery requires a window with a document");
                    return t(e)
                } : t(e)
    }("undefined" != typeof window ? window : this, function (e, t) {
        function n(e) {
            var t = e.length, n = ae.type(e);
            return "function" === n || ae.isWindow(e) ? !1 : 1 === e.nodeType && t ? !0 : "array" === n || 0 === t || "number" == typeof t && t > 0 && t - 1 in e
        }

        function i(e, t, n) {
            if (ae.isFunction(t))return ae.grep(e, function (e, i) {
                return !!t.call(e, i, e) !== n
            });
            if (t.nodeType)return ae.grep(e, function (e) {
                return e === t !== n
            });
            if ("string" == typeof t) {
                if (ce.test(t))return ae.filter(t, e, n);
                t = ae.filter(t, e)
            }
            return ae.grep(e, function (e) {
                return ae.inArray(e, t) >= 0 !== n
            })
        }

        function a(e, t) {
            do e = e[t]; while (e && 1 !== e.nodeType);
            return e
        }

        function r(e) {
            var t = be[e] = {};
            return ae.each(e.match(we) || [], function (e, n) {
                t[n] = !0
            }), t
        }

        function o() {
            he.addEventListener ? (he.removeEventListener("DOMContentLoaded", s, !1), e.removeEventListener("load", s, !1)) : (he.detachEvent("onreadystatechange", s), e.detachEvent("onload", s))
        }

        function s() {
            (he.addEventListener || "load" === event.type || "complete" === he.readyState) && (o(), ae.ready())
        }

        function l(e, t, n) {
            if (void 0 === n && 1 === e.nodeType) {
                var i = "data-" + t.replace(Ee, "-$1").toLowerCase();
                if (n = e.getAttribute(i), "string" == typeof n) {
                    try {
                        n = "true" === n ? !0 : "false" === n ? !1 : "null" === n ? null : +n + "" === n ? +n : Se.test(n) ? ae.parseJSON(n) : n
                    } catch (a) {
                    }
                    ae.data(e, t, n)
                } else n = void 0
            }
            return n
        }

        function d(e) {
            var t;
            for (t in e)if (("data" !== t || !ae.isEmptyObject(e[t])) && "toJSON" !== t)return !1;
            return !0
        }

        function u(e, t, n, i) {
            if (ae.acceptData(e)) {
                var a, r, o = ae.expando, s = e.nodeType, l = s ? ae.cache : e, d = s ? e[o] : e[o] && o;
                if (d && l[d] && (i || l[d].data) || void 0 !== n || "string" != typeof t)return d || (d = s ? e[o] = U.pop() || ae.guid++ : o), l[d] || (l[d] = s ? {} : {toJSON: ae.noop}), ("object" == typeof t || "function" == typeof t) && (i ? l[d] = ae.extend(l[d], t) : l[d].data = ae.extend(l[d].data, t)), r = l[d], i || (r.data || (r.data = {}), r = r.data), void 0 !== n && (r[ae.camelCase(t)] = n), "string" == typeof t ? (a = r[t], null == a && (a = r[ae.camelCase(t)])) : a = r, a
            }
        }

        function p(e, t, n) {
            if (ae.acceptData(e)) {
                var i, a, r = e.nodeType, o = r ? ae.cache : e, s = r ? e[ae.expando] : ae.expando;
                if (o[s]) {
                    if (t && (i = n ? o[s] : o[s].data)) {
                        ae.isArray(t) ? t = t.concat(ae.map(t, ae.camelCase)) : t in i ? t = [t] : (t = ae.camelCase(t), t = t in i ? [t] : t.split(" ")), a = t.length;
                        for (; a--;)delete i[t[a]];
                        if (n ? !d(i) : !ae.isEmptyObject(i))return
                    }
                    (n || (delete o[s].data, d(o[s]))) && (r ? ae.cleanData([e], !0) : ne.deleteExpando || o != o.window ? delete o[s] : o[s] = null)
                }
            }
        }

        function c() {
            return !0
        }

        function f() {
            return !1
        }

        function h() {
            try {
                return he.activeElement
            } catch (e) {
            }
        }

        function m(e) {
            var t = He.split("|"), n = e.createDocumentFragment();
            if (n.createElement)for (; t.length;)n.createElement(t.pop());
            return n
        }

        function g(e, t) {
            var n, i, a = 0, r = typeof e.getElementsByTagName !== Ce ? e.getElementsByTagName(t || "*") : typeof e.querySelectorAll !== Ce ? e.querySelectorAll(t || "*") : void 0;
            if (!r)for (r = [], n = e.childNodes || e; null != (i = n[a]); a++)!t || ae.nodeName(i, t) ? r.push(i) : ae.merge(r, g(i, t));
            return void 0 === t || t && ae.nodeName(e, t) ? ae.merge([e], r) : r
        }

        function v(e) {
            Ae.test(e.type) && (e.defaultChecked = e.checked)
        }

        function y(e, t) {
            return ae.nodeName(e, "table") && ae.nodeName(11 !== t.nodeType ? t : t.firstChild, "tr") ? e.getElementsByTagName("tbody")[0] || e.appendChild(e.ownerDocument.createElement("tbody")) : e
        }

        function w(e) {
            return e.type = (null !== ae.find.attr(e, "type")) + "/" + e.type, e
        }

        function b(e) {
            var t = Xe.exec(e.type);
            return t ? e.type = t[1] : e.removeAttribute("type"), e
        }

        function x(e, t) {
            for (var n, i = 0; null != (n = e[i]); i++)ae._data(n, "globalEval", !t || ae._data(t[i], "globalEval"))
        }

        function T(e, t) {
            if (1 === t.nodeType && ae.hasData(e)) {
                var n, i, a, r = ae._data(e), o = ae._data(t, r), s = r.events;
                if (s) {
                    delete o.handle, o.events = {};
                    for (n in s)for (i = 0, a = s[n].length; a > i; i++)ae.event.add(t, n, s[n][i])
                }
                o.data && (o.data = ae.extend({}, o.data))
            }
        }

        function C(e, t) {
            var n, i, a;
            if (1 === t.nodeType) {
                if (n = t.nodeName.toLowerCase(), !ne.noCloneEvent && t[ae.expando]) {
                    a = ae._data(t);
                    for (i in a.events)ae.removeEvent(t, i, a.handle);
                    t.removeAttribute(ae.expando)
                }
                "script" === n && t.text !== e.text ? (w(t).text = e.text, b(t)) : "object" === n ? (t.parentNode && (t.outerHTML = e.outerHTML), ne.html5Clone && e.innerHTML && !ae.trim(t.innerHTML) && (t.innerHTML = e.innerHTML)) : "input" === n && Ae.test(e.type) ? (t.defaultChecked = t.checked = e.checked, t.value !== e.value && (t.value = e.value)) : "option" === n ? t.defaultSelected = t.selected = e.defaultSelected : ("input" === n || "textarea" === n) && (t.defaultValue = e.defaultValue)
            }
        }

        function S(t, n) {
            var i, a = ae(n.createElement(t)).appendTo(n.body), r = e.getDefaultComputedStyle && (i = e.getDefaultComputedStyle(a[0])) ? i.display : ae.css(a[0], "display");
            return a.detach(), r
        }

        function E(e) {
            var t = he, n = Ze[e];
            return n || (n = S(e, t), "none" !== n && n || (Je = (Je || ae("<iframe frameborder='0' width='0' height='0'/>")).appendTo(t.documentElement), t = (Je[0].contentWindow || Je[0].contentDocument).document, t.write(), t.close(), n = S(e, t), Je.detach()), Ze[e] = n), n
        }

        function k(e, t) {
            return {
                get: function () {
                    var n = e();
                    return null != n ? n ? void delete this.get : (this.get = t).apply(this, arguments) : void 0
                }
            }
        }

        function N(e, t) {
            if (t in e)return t;
            for (var n = t.charAt(0).toUpperCase() + t.slice(1), i = t, a = ct.length; a--;)if (t = ct[a] + n, t in e)return t;
            return i
        }

        function D(e, t) {
            for (var n, i, a, r = [], o = 0, s = e.length; s > o; o++)i = e[o], i.style && (r[o] = ae._data(i, "olddisplay"), n = i.style.display, t ? (r[o] || "none" !== n || (i.style.display = ""), "" === i.style.display && De(i) && (r[o] = ae._data(i, "olddisplay", E(i.nodeName)))) : (a = De(i), (n && "none" !== n || !a) && ae._data(i, "olddisplay", a ? n : ae.css(i, "display"))));
            for (o = 0; s > o; o++)i = e[o], i.style && (t && "none" !== i.style.display && "" !== i.style.display || (i.style.display = t ? r[o] || "" : "none"));
            return e
        }

        function M(e, t, n) {
            var i = lt.exec(t);
            return i ? Math.max(0, i[1] - (n || 0)) + (i[2] || "px") : t
        }

        function A(e, t, n, i, a) {
            for (var r = n === (i ? "border" : "content") ? 4 : "width" === t ? 1 : 0, o = 0; 4 > r; r += 2)"margin" === n && (o += ae.css(e, n + Ne[r], !0, a)), i ? ("content" === n && (o -= ae.css(e, "padding" + Ne[r], !0, a)), "margin" !== n && (o -= ae.css(e, "border" + Ne[r] + "Width", !0, a))) : (o += ae.css(e, "padding" + Ne[r], !0, a), "padding" !== n && (o += ae.css(e, "border" + Ne[r] + "Width", !0, a)));
            return o
        }

        function I(e, t, n) {
            var i = !0, a = "width" === t ? e.offsetWidth : e.offsetHeight, r = et(e), o = ne.boxSizing && "border-box" === ae.css(e, "boxSizing", !1, r);
            if (0 >= a || null == a) {
                if (a = tt(e, t, r), (0 > a || null == a) && (a = e.style[t]), it.test(a))return a;
                i = o && (ne.boxSizingReliable() || a === e.style[t]), a = parseFloat(a) || 0
            }
            return a + A(e, t, n || (o ? "border" : "content"), i, r) + "px"
        }

        function L(e, t, n, i, a) {
            return new L.prototype.init(e, t, n, i, a)
        }

        function $() {
            return setTimeout(function () {
                ft = void 0
            }), ft = ae.now()
        }

        function P(e, t) {
            var n, i = {height: e}, a = 0;
            for (t = t ? 1 : 0; 4 > a; a += 2 - t)n = Ne[a], i["margin" + n] = i["padding" + n] = e;
            return t && (i.opacity = i.width = e), i
        }

        function z(e, t, n) {
            for (var i, a = (wt[t] || []).concat(wt["*"]), r = 0, o = a.length; o > r; r++)if (i = a[r].call(n, t, e))return i
        }

        function H(e, t, n) {
            var i, a, r, o, s, l, d, u, p = this, c = {}, f = e.style, h = e.nodeType && De(e), m = ae._data(e, "fxshow");
            n.queue || (s = ae._queueHooks(e, "fx"), null == s.unqueued && (s.unqueued = 0, l = s.empty.fire, s.empty.fire = function () {
                s.unqueued || l()
            }), s.unqueued++, p.always(function () {
                p.always(function () {
                    s.unqueued--, ae.queue(e, "fx").length || s.empty.fire()
                })
            })), 1 === e.nodeType && ("height" in t || "width" in t) && (n.overflow = [f.overflow, f.overflowX, f.overflowY], d = ae.css(e, "display"), u = "none" === d ? ae._data(e, "olddisplay") || E(e.nodeName) : d, "inline" === u && "none" === ae.css(e, "float") && (ne.inlineBlockNeedsLayout && "inline" !== E(e.nodeName) ? f.zoom = 1 : f.display = "inline-block")), n.overflow && (f.overflow = "hidden", ne.shrinkWrapBlocks() || p.always(function () {
                f.overflow = n.overflow[0], f.overflowX = n.overflow[1], f.overflowY = n.overflow[2]
            }));
            for (i in t)if (a = t[i], mt.exec(a)) {
                if (delete t[i], r = r || "toggle" === a, a === (h ? "hide" : "show")) {
                    if ("show" !== a || !m || void 0 === m[i])continue;
                    h = !0
                }
                c[i] = m && m[i] || ae.style(e, i)
            } else d = void 0;
            if (ae.isEmptyObject(c)) "inline" === ("none" === d ? E(e.nodeName) : d) && (f.display = d); else {
                m ? "hidden" in m && (h = m.hidden) : m = ae._data(e, "fxshow", {}), r && (m.hidden = !h), h ? ae(e).show() : p.done(function () {
                        ae(e).hide()
                    }), p.done(function () {
                    var t;
                    ae._removeData(e, "fxshow");
                    for (t in c)ae.style(e, t, c[t])
                });
                for (i in c)o = z(h ? m[i] : 0, i, p), i in m || (m[i] = o.start, h && (o.end = o.start, o.start = "width" === i || "height" === i ? 1 : 0))
            }
        }

        function B(e, t) {
            var n, i, a, r, o;
            for (n in e)if (i = ae.camelCase(n), a = t[i], r = e[n], ae.isArray(r) && (a = r[1], r = e[n] = r[0]), n !== i && (e[i] = r, delete e[n]), o = ae.cssHooks[i], o && "expand" in o) {
                r = o.expand(r), delete e[i];
                for (n in r)n in e || (e[n] = r[n], t[n] = a)
            } else t[i] = a
        }

        function O(e, t, n) {
            var i, a, r = 0, o = yt.length, s = ae.Deferred().always(function () {
                delete l.elem
            }), l = function () {
                if (a)return !1;
                for (var t = ft || $(), n = Math.max(0, d.startTime + d.duration - t), i = n / d.duration || 0, r = 1 - i, o = 0, l = d.tweens.length; l > o; o++)d.tweens[o].run(r);
                return s.notifyWith(e, [d, r, n]), 1 > r && l ? n : (s.resolveWith(e, [d]), !1)
            }, d = s.promise({
                elem: e,
                props: ae.extend({}, t),
                opts: ae.extend(!0, {specialEasing: {}}, n),
                originalProperties: t,
                originalOptions: n,
                startTime: ft || $(),
                duration: n.duration,
                tweens: [],
                createTween: function (t, n) {
                    var i = ae.Tween(e, d.opts, t, n, d.opts.specialEasing[t] || d.opts.easing);
                    return d.tweens.push(i), i
                },
                stop: function (t) {
                    var n = 0, i = t ? d.tweens.length : 0;
                    if (a)return this;
                    for (a = !0; i > n; n++)d.tweens[n].run(1);
                    return t ? s.resolveWith(e, [d, t]) : s.rejectWith(e, [d, t]), this
                }
            }), u = d.props;
            for (B(u, d.opts.specialEasing); o > r; r++)if (i = yt[r].call(d, e, u, d.opts))return i;
            return ae.map(u, z, d), ae.isFunction(d.opts.start) && d.opts.start.call(e, d), ae.fx.timer(ae.extend(l, {
                elem: e,
                anim: d,
                queue: d.opts.queue
            })), d.progress(d.opts.progress).done(d.opts.done, d.opts.complete).fail(d.opts.fail).always(d.opts.always)
        }

        function j(e) {
            return function (t, n) {
                "string" != typeof t && (n = t, t = "*");
                var i, a = 0, r = t.toLowerCase().match(we) || [];
                if (ae.isFunction(n))for (; i = r[a++];)"+" === i.charAt(0) ? (i = i.slice(1) || "*", (e[i] = e[i] || []).unshift(n)) : (e[i] = e[i] || []).push(n)
            }
        }

        function R(e, t, n, i) {
            function a(s) {
                var l;
                return r[s] = !0, ae.each(e[s] || [], function (e, s) {
                    var d = s(t, n, i);
                    return "string" != typeof d || o || r[d] ? o ? !(l = d) : void 0 : (t.dataTypes.unshift(d), a(d), !1)
                }), l
            }

            var r = {}, o = e === _t;
            return a(t.dataTypes[0]) || !r["*"] && a("*")
        }

        function F(e, t) {
            var n, i, a = ae.ajaxSettings.flatOptions || {};
            for (i in t)void 0 !== t[i] && ((a[i] ? e : n || (n = {}))[i] = t[i]);
            return n && ae.extend(!0, e, n), e
        }

        function W(e, t, n) {
            for (var i, a, r, o, s = e.contents, l = e.dataTypes; "*" === l[0];)l.shift(), void 0 === a && (a = e.mimeType || t.getResponseHeader("Content-Type"));
            if (a)for (o in s)if (s[o] && s[o].test(a)) {
                l.unshift(o);
                break
            }
            if (l[0] in n) r = l[0]; else {
                for (o in n) {
                    if (!l[0] || e.converters[o + " " + l[0]]) {
                        r = o;
                        break
                    }
                    i || (i = o)
                }
                r = r || i
            }
            return r ? (r !== l[0] && l.unshift(r), n[r]) : void 0
        }

        function _(e, t, n, i) {
            var a, r, o, s, l, d = {}, u = e.dataTypes.slice();
            if (u[1])for (o in e.converters)d[o.toLowerCase()] = e.converters[o];
            for (r = u.shift(); r;)if (e.responseFields[r] && (n[e.responseFields[r]] = t), !l && i && e.dataFilter && (t = e.dataFilter(t, e.dataType)), l = r, r = u.shift())if ("*" === r) r = l; else if ("*" !== l && l !== r) {
                if (o = d[l + " " + r] || d["* " + r], !o)for (a in d)if (s = a.split(" "), s[1] === r && (o = d[l + " " + s[0]] || d["* " + s[0]])) {
                    o === !0 ? o = d[a] : d[a] !== !0 && (r = s[0], u.unshift(s[1]));
                    break
                }
                if (o !== !0)if (o && e["throws"]) t = o(t); else try {
                    t = o(t)
                } catch (p) {
                    return {state: "parsererror", error: o ? p : "No conversion from " + l + " to " + r}
                }
            }
            return {state: "success", data: t}
        }

        function q(e, t, n, i) {
            var a;
            if (ae.isArray(t)) ae.each(t, function (t, a) {
                n || Xt.test(e) ? i(e, a) : q(e + "[" + ("object" == typeof a ? t : "") + "]", a, n, i)
            }); else if (n || "object" !== ae.type(t)) i(e, t); else for (a in t)q(e + "[" + a + "]", t[a], n, i)
        }

        function G() {
            try {
                return new e.XMLHttpRequest
            } catch (t) {
            }
        }

        function V() {
            try {
                return new e.ActiveXObject("Microsoft.XMLHTTP")
            } catch (t) {
            }
        }

        function X(e) {
            return ae.isWindow(e) ? e : 9 === e.nodeType ? e.defaultView || e.parentWindow : !1
        }

        var U = [], Y = U.slice, Q = U.concat, K = U.push, J = U.indexOf, Z = {}, ee = Z.toString, te = Z.hasOwnProperty, ne = {}, ie = "1.11.2", ae = function (e, t) {
            return new ae.fn.init(e, t)
        }, re = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, oe = /^-ms-/, se = /-([\da-z])/gi, le = function (e, t) {
            return t.toUpperCase()
        };
        ae.fn = ae.prototype = {
            jquery: ie, constructor: ae, selector: "", length: 0, toArray: function () {
                return Y.call(this)
            }, get: function (e) {
                return null != e ? 0 > e ? this[e + this.length] : this[e] : Y.call(this)
            }, pushStack: function (e) {
                var t = ae.merge(this.constructor(), e);
                return t.prevObject = this, t.context = this.context, t
            }, each: function (e, t) {
                return ae.each(this, e, t)
            }, map: function (e) {
                return this.pushStack(ae.map(this, function (t, n) {
                    return e.call(t, n, t)
                }))
            }, slice: function () {
                return this.pushStack(Y.apply(this, arguments))
            }, first: function () {
                return this.eq(0)
            }, last: function () {
                return this.eq(-1)
            }, eq: function (e) {
                var t = this.length, n = +e + (0 > e ? t : 0);
                return this.pushStack(n >= 0 && t > n ? [this[n]] : [])
            }, end: function () {
                return this.prevObject || this.constructor(null)
            }, push: K, sort: U.sort, splice: U.splice
        }, ae.extend = ae.fn.extend = function () {
            var e, t, n, i, a, r, o = arguments[0] || {}, s = 1, l = arguments.length, d = !1;
            for ("boolean" == typeof o && (d = o, o = arguments[s] || {}, s++), "object" == typeof o || ae.isFunction(o) || (o = {}), s === l && (o = this, s--); l > s; s++)if (null != (a = arguments[s]))for (i in a)e = o[i], n = a[i], o !== n && (d && n && (ae.isPlainObject(n) || (t = ae.isArray(n))) ? (t ? (t = !1, r = e && ae.isArray(e) ? e : []) : r = e && ae.isPlainObject(e) ? e : {}, o[i] = ae.extend(d, r, n)) : void 0 !== n && (o[i] = n));
            return o
        }, ae.extend({
            expando: "jQuery" + (ie + Math.random()).replace(/\D/g, ""), isReady: !0, error: function (e) {
                throw new Error(e)
            }, noop: function () {
            }, isFunction: function (e) {
                return "function" === ae.type(e)
            }, isArray: Array.isArray || function (e) {
                return "array" === ae.type(e)
            }, isWindow: function (e) {
                return null != e && e == e.window
            }, isNumeric: function (e) {
                return !ae.isArray(e) && e - parseFloat(e) + 1 >= 0
            }, isEmptyObject: function (e) {
                var t;
                for (t in e)return !1;
                return !0
            }, isPlainObject: function (e) {
                var t;
                if (!e || "object" !== ae.type(e) || e.nodeType || ae.isWindow(e))return !1;
                try {
                    if (e.constructor && !te.call(e, "constructor") && !te.call(e.constructor.prototype, "isPrototypeOf"))return !1
                } catch (n) {
                    return !1
                }
                if (ne.ownLast)for (t in e)return te.call(e, t);
                for (t in e);
                return void 0 === t || te.call(e, t)
            }, type: function (e) {
                return null == e ? e + "" : "object" == typeof e || "function" == typeof e ? Z[ee.call(e)] || "object" : typeof e
            }, globalEval: function (t) {
                t && ae.trim(t) && (e.execScript || function (t) {
                    e.eval.call(e, t)
                })(t)
            }, camelCase: function (e) {
                return e.replace(oe, "ms-").replace(se, le)
            }, nodeName: function (e, t) {
                return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase()
            }, each: function (e, t, i) {
                var a, r = 0, o = e.length, s = n(e);
                if (i) {
                    if (s)for (; o > r && (a = t.apply(e[r], i), a !== !1); r++); else for (r in e)if (a = t.apply(e[r], i), a === !1)break
                } else if (s)for (; o > r && (a = t.call(e[r], r, e[r]), a !== !1); r++); else for (r in e)if (a = t.call(e[r], r, e[r]), a === !1)break;
                return e
            }, trim: function (e) {
                return null == e ? "" : (e + "").replace(re, "")
            }, makeArray: function (e, t) {
                var i = t || [];
                return null != e && (n(Object(e)) ? ae.merge(i, "string" == typeof e ? [e] : e) : K.call(i, e)), i
            }, inArray: function (e, t, n) {
                var i;
                if (t) {
                    if (J)return J.call(t, e, n);
                    for (i = t.length, n = n ? 0 > n ? Math.max(0, i + n) : n : 0; i > n; n++)if (n in t && t[n] === e)return n
                }
                return -1
            }, merge: function (e, t) {
                for (var n = +t.length, i = 0, a = e.length; n > i;)e[a++] = t[i++];
                if (n !== n)for (; void 0 !== t[i];)e[a++] = t[i++];
                return e.length = a, e
            }, grep: function (e, t, n) {
                for (var i, a = [], r = 0, o = e.length, s = !n; o > r; r++)i = !t(e[r], r), i !== s && a.push(e[r]);
                return a
            }, map: function (e, t, i) {
                var a, r = 0, o = e.length, s = n(e), l = [];
                if (s)for (; o > r; r++)a = t(e[r], r, i), null != a && l.push(a); else for (r in e)a = t(e[r], r, i), null != a && l.push(a);
                return Q.apply([], l)
            }, guid: 1, proxy: function (e, t) {
                var n, i, a;
                return "string" == typeof t && (a = e[t], t = e, e = a), ae.isFunction(e) ? (n = Y.call(arguments, 2), i = function () {
                        return e.apply(t || this, n.concat(Y.call(arguments)))
                    }, i.guid = e.guid = e.guid || ae.guid++, i) : void 0
            }, now: function () {
                return +new Date
            }, support: ne
        }), ae.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function (e, t) {
            Z["[object " + t + "]"] = t.toLowerCase()
        });
        var de = function (e) {
            function t(e, t, n, i) {
                var a, r, o, s, l, d, p, f, h, m;
                if ((t ? t.ownerDocument || t : R) !== L && I(t), t = t || L, n = n || [], s = t.nodeType, "string" != typeof e || !e || 1 !== s && 9 !== s && 11 !== s)return n;
                if (!i && P) {
                    if (11 !== s && (a = ye.exec(e)))if (o = a[1]) {
                        if (9 === s) {
                            if (r = t.getElementById(o), !r || !r.parentNode)return n;
                            if (r.id === o)return n.push(r), n
                        } else if (t.ownerDocument && (r = t.ownerDocument.getElementById(o)) && O(t, r) && r.id === o)return n.push(r), n
                    } else {
                        if (a[2])return J.apply(n, t.getElementsByTagName(e)), n;
                        if ((o = a[3]) && x.getElementsByClassName)return J.apply(n, t.getElementsByClassName(o)), n
                    }
                    if (x.qsa && (!z || !z.test(e))) {
                        if (f = p = j, h = t, m = 1 !== s && e, 1 === s && "object" !== t.nodeName.toLowerCase()) {
                            for (d = E(e), (p = t.getAttribute("id")) ? f = p.replace(be, "\\$&") : t.setAttribute("id", f), f = "[id='" + f + "'] ", l = d.length; l--;)d[l] = f + c(d[l]);
                            h = we.test(e) && u(t.parentNode) || t, m = d.join(",")
                        }
                        if (m)try {
                            return J.apply(n, h.querySelectorAll(m)), n
                        } catch (g) {
                        } finally {
                            p || t.removeAttribute("id")
                        }
                    }
                }
                return N(e.replace(le, "$1"), t, n, i)
            }

            function n() {
                function e(n, i) {
                    return t.push(n + " ") > T.cacheLength && delete e[t.shift()], e[n + " "] = i
                }

                var t = [];
                return e
            }

            function i(e) {
                return e[j] = !0, e
            }

            function a(e) {
                var t = L.createElement("div");
                try {
                    return !!e(t)
                } catch (n) {
                    return !1
                } finally {
                    t.parentNode && t.parentNode.removeChild(t), t = null
                }
            }

            function r(e, t) {
                for (var n = e.split("|"), i = e.length; i--;)T.attrHandle[n[i]] = t
            }

            function o(e, t) {
                var n = t && e, i = n && 1 === e.nodeType && 1 === t.nodeType && (~t.sourceIndex || X) - (~e.sourceIndex || X);
                if (i)return i;
                if (n)for (; n = n.nextSibling;)if (n === t)return -1;
                return e ? 1 : -1
            }

            function s(e) {
                return function (t) {
                    var n = t.nodeName.toLowerCase();
                    return "input" === n && t.type === e
                }
            }

            function l(e) {
                return function (t) {
                    var n = t.nodeName.toLowerCase();
                    return ("input" === n || "button" === n) && t.type === e
                }
            }

            function d(e) {
                return i(function (t) {
                    return t = +t, i(function (n, i) {
                        for (var a, r = e([], n.length, t), o = r.length; o--;)n[a = r[o]] && (n[a] = !(i[a] = n[a]))
                    })
                })
            }

            function u(e) {
                return e && "undefined" != typeof e.getElementsByTagName && e
            }

            function p() {
            }

            function c(e) {
                for (var t = 0, n = e.length, i = ""; n > t; t++)i += e[t].value;
                return i
            }

            function f(e, t, n) {
                var i = t.dir, a = n && "parentNode" === i, r = W++;
                return t.first ? function (t, n, r) {
                        for (; t = t[i];)if (1 === t.nodeType || a)return e(t, n, r)
                    } : function (t, n, o) {
                        var s, l, d = [F, r];
                        if (o) {
                            for (; t = t[i];)if ((1 === t.nodeType || a) && e(t, n, o))return !0
                        } else for (; t = t[i];)if (1 === t.nodeType || a) {
                            if (l = t[j] || (t[j] = {}), (s = l[i]) && s[0] === F && s[1] === r)return d[2] = s[2];
                            if (l[i] = d, d[2] = e(t, n, o))return !0
                        }
                    }
            }

            function h(e) {
                return e.length > 1 ? function (t, n, i) {
                        for (var a = e.length; a--;)if (!e[a](t, n, i))return !1;
                        return !0
                    } : e[0]
            }

            function m(e, n, i) {
                for (var a = 0, r = n.length; r > a; a++)t(e, n[a], i);
                return i
            }

            function g(e, t, n, i, a) {
                for (var r, o = [], s = 0, l = e.length, d = null != t; l > s; s++)(r = e[s]) && (!n || n(r, i, a)) && (o.push(r), d && t.push(s));
                return o
            }

            function v(e, t, n, a, r, o) {
                return a && !a[j] && (a = v(a)), r && !r[j] && (r = v(r, o)), i(function (i, o, s, l) {
                    var d, u, p, c = [], f = [], h = o.length, v = i || m(t || "*", s.nodeType ? [s] : s, []), y = !e || !i && t ? v : g(v, c, e, s, l), w = n ? r || (i ? e : h || a) ? [] : o : y;
                    if (n && n(y, w, s, l), a)for (d = g(w, f), a(d, [], s, l), u = d.length; u--;)(p = d[u]) && (w[f[u]] = !(y[f[u]] = p));
                    if (i) {
                        if (r || e) {
                            if (r) {
                                for (d = [], u = w.length; u--;)(p = w[u]) && d.push(y[u] = p);
                                r(null, w = [], d, l)
                            }
                            for (u = w.length; u--;)(p = w[u]) && (d = r ? ee(i, p) : c[u]) > -1 && (i[d] = !(o[d] = p))
                        }
                    } else w = g(w === o ? w.splice(h, w.length) : w), r ? r(null, o, w, l) : J.apply(o, w)
                })
            }

            function y(e) {
                for (var t, n, i, a = e.length, r = T.relative[e[0].type], o = r || T.relative[" "], s = r ? 1 : 0, l = f(function (e) {
                    return e === t
                }, o, !0), d = f(function (e) {
                    return ee(t, e) > -1
                }, o, !0), u = [function (e, n, i) {
                    var a = !r && (i || n !== D) || ((t = n).nodeType ? l(e, n, i) : d(e, n, i));
                    return t = null, a
                }]; a > s; s++)if (n = T.relative[e[s].type]) u = [f(h(u), n)]; else {
                    if (n = T.filter[e[s].type].apply(null, e[s].matches), n[j]) {
                        for (i = ++s; a > i && !T.relative[e[i].type]; i++);
                        return v(s > 1 && h(u), s > 1 && c(e.slice(0, s - 1).concat({value: " " === e[s - 2].type ? "*" : ""})).replace(le, "$1"), n, i > s && y(e.slice(s, i)), a > i && y(e = e.slice(i)), a > i && c(e))
                    }
                    u.push(n)
                }
                return h(u)
            }

            function w(e, n) {
                var a = n.length > 0, r = e.length > 0, o = function (i, o, s, l, d) {
                    var u, p, c, f = 0, h = "0", m = i && [], v = [], y = D, w = i || r && T.find.TAG("*", d), b = F += null == y ? 1 : Math.random() || .1, x = w.length;
                    for (d && (D = o !== L && o); h !== x && null != (u = w[h]); h++) {
                        if (r && u) {
                            for (p = 0; c = e[p++];)if (c(u, o, s)) {
                                l.push(u);
                                break
                            }
                            d && (F = b)
                        }
                        a && ((u = !c && u) && f--, i && m.push(u))
                    }
                    if (f += h, a && h !== f) {
                        for (p = 0; c = n[p++];)c(m, v, o, s);
                        if (i) {
                            if (f > 0)for (; h--;)m[h] || v[h] || (v[h] = Q.call(l));
                            v = g(v)
                        }
                        J.apply(l, v), d && !i && v.length > 0 && f + n.length > 1 && t.uniqueSort(l)
                    }
                    return d && (F = b, D = y), m
                };
                return a ? i(o) : o
            }

            var b, x, T, C, S, E, k, N, D, M, A, I, L, $, P, z, H, B, O, j = "sizzle" + 1 * new Date, R = e.document, F = 0, W = 0, _ = n(), q = n(), G = n(), V = function (e, t) {
                return e === t && (A = !0), 0
            }, X = 1 << 31, U = {}.hasOwnProperty, Y = [], Q = Y.pop, K = Y.push, J = Y.push, Z = Y.slice, ee = function (e, t) {
                for (var n = 0, i = e.length; i > n; n++)if (e[n] === t)return n;
                return -1
            }, te = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped", ne = "[\\x20\\t\\r\\n\\f]", ie = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+", ae = ie.replace("w", "w#"), re = "\\[" + ne + "*(" + ie + ")(?:" + ne + "*([*^$|!~]?=)" + ne + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + ae + "))|)" + ne + "*\\]", oe = ":(" + ie + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + re + ")*)|.*)\\)|)", se = new RegExp(ne + "+", "g"), le = new RegExp("^" + ne + "+|((?:^|[^\\\\])(?:\\\\.)*)" + ne + "+$", "g"), de = new RegExp("^" + ne + "*," + ne + "*"), ue = new RegExp("^" + ne + "*([>+~]|" + ne + ")" + ne + "*"), pe = new RegExp("=" + ne + "*([^\\]'\"]*?)" + ne + "*\\]", "g"), ce = new RegExp(oe), fe = new RegExp("^" + ae + "$"), he = {
                ID: new RegExp("^#(" + ie + ")"),
                CLASS: new RegExp("^\\.(" + ie + ")"),
                TAG: new RegExp("^(" + ie.replace("w", "w*") + ")"),
                ATTR: new RegExp("^" + re),
                PSEUDO: new RegExp("^" + oe),
                CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + ne + "*(even|odd|(([+-]|)(\\d*)n|)" + ne + "*(?:([+-]|)" + ne + "*(\\d+)|))" + ne + "*\\)|)", "i"),
                bool: new RegExp("^(?:" + te + ")$", "i"),
                needsContext: new RegExp("^" + ne + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + ne + "*((?:-\\d)?\\d*)" + ne + "*\\)|)(?=[^-]|$)", "i")
            }, me = /^(?:input|select|textarea|button)$/i, ge = /^h\d$/i, ve = /^[^{]+\{\s*\[native \w/, ye = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/, we = /[+~]/, be = /'|\\/g, xe = new RegExp("\\\\([\\da-f]{1,6}" + ne + "?|(" + ne + ")|.)", "ig"), Te = function (e, t, n) {
                var i = "0x" + t - 65536;
                return i !== i || n ? t : 0 > i ? String.fromCharCode(i + 65536) : String.fromCharCode(i >> 10 | 55296, 1023 & i | 56320)
            }, Ce = function () {
                I()
            };
            try {
                J.apply(Y = Z.call(R.childNodes), R.childNodes), Y[R.childNodes.length].nodeType
            } catch (Se) {
                J = {
                    apply: Y.length ? function (e, t) {
                            K.apply(e, Z.call(t))
                        } : function (e, t) {
                            for (var n = e.length, i = 0; e[n++] = t[i++];);
                            e.length = n - 1
                        }
                }
            }
            x = t.support = {}, S = t.isXML = function (e) {
                var t = e && (e.ownerDocument || e).documentElement;
                return t ? "HTML" !== t.nodeName : !1
            }, I = t.setDocument = function (e) {
                var t, n, i = e ? e.ownerDocument || e : R;
                return i !== L && 9 === i.nodeType && i.documentElement ? (L = i, $ = i.documentElement, n = i.defaultView, n && n !== n.top && (n.addEventListener ? n.addEventListener("unload", Ce, !1) : n.attachEvent && n.attachEvent("onunload", Ce)), P = !S(i), x.attributes = a(function (e) {
                        return e.className = "i", !e.getAttribute("className")
                    }), x.getElementsByTagName = a(function (e) {
                        return e.appendChild(i.createComment("")), !e.getElementsByTagName("*").length
                    }), x.getElementsByClassName = ve.test(i.getElementsByClassName), x.getById = a(function (e) {
                        return $.appendChild(e).id = j, !i.getElementsByName || !i.getElementsByName(j).length
                    }), x.getById ? (T.find.ID = function (e, t) {
                            if ("undefined" != typeof t.getElementById && P) {
                                var n = t.getElementById(e);
                                return n && n.parentNode ? [n] : []
                            }
                        }, T.filter.ID = function (e) {
                            var t = e.replace(xe, Te);
                            return function (e) {
                                return e.getAttribute("id") === t
                            }
                        }) : (delete T.find.ID, T.filter.ID = function (e) {
                            var t = e.replace(xe, Te);
                            return function (e) {
                                var n = "undefined" != typeof e.getAttributeNode && e.getAttributeNode("id");
                                return n && n.value === t
                            }
                        }), T.find.TAG = x.getElementsByTagName ? function (e, t) {
                            return "undefined" != typeof t.getElementsByTagName ? t.getElementsByTagName(e) : x.qsa ? t.querySelectorAll(e) : void 0
                        } : function (e, t) {
                            var n, i = [], a = 0, r = t.getElementsByTagName(e);
                            if ("*" === e) {
                                for (; n = r[a++];)1 === n.nodeType && i.push(n);
                                return i
                            }
                            return r
                        }, T.find.CLASS = x.getElementsByClassName && function (e, t) {
                            return P ? t.getElementsByClassName(e) : void 0
                        }, H = [], z = [], (x.qsa = ve.test(i.querySelectorAll)) && (a(function (e) {
                        $.appendChild(e).innerHTML = "<a id='" + j + "'></a><select id='" + j + "-\f]' msallowcapture=''><option selected=''></option></select>", e.querySelectorAll("[msallowcapture^='']").length && z.push("[*^$]=" + ne + "*(?:''|\"\")"), e.querySelectorAll("[selected]").length || z.push("\\[" + ne + "*(?:value|" + te + ")"), e.querySelectorAll("[id~=" + j + "-]").length || z.push("~="), e.querySelectorAll(":checked").length || z.push(":checked"), e.querySelectorAll("a#" + j + "+*").length || z.push(".#.+[+~]")
                    }), a(function (e) {
                        var t = i.createElement("input");
                        t.setAttribute("type", "hidden"), e.appendChild(t).setAttribute("name", "D"), e.querySelectorAll("[name=d]").length && z.push("name" + ne + "*[*^$|!~]?="), e.querySelectorAll(":enabled").length || z.push(":enabled", ":disabled"), e.querySelectorAll("*,:x"), z.push(",.*:")
                    })), (x.matchesSelector = ve.test(B = $.matches || $.webkitMatchesSelector || $.mozMatchesSelector || $.oMatchesSelector || $.msMatchesSelector)) && a(function (e) {
                        x.disconnectedMatch = B.call(e, "div"), B.call(e, "[s!='']:x"), H.push("!=", oe)
                    }), z = z.length && new RegExp(z.join("|")), H = H.length && new RegExp(H.join("|")), t = ve.test($.compareDocumentPosition), O = t || ve.test($.contains) ? function (e, t) {
                            var n = 9 === e.nodeType ? e.documentElement : e, i = t && t.parentNode;
                            return e === i || !(!i || 1 !== i.nodeType || !(n.contains ? n.contains(i) : e.compareDocumentPosition && 16 & e.compareDocumentPosition(i)))
                        } : function (e, t) {
                            if (t)for (; t = t.parentNode;)if (t === e)return !0;
                            return !1
                        }, V = t ? function (e, t) {
                            if (e === t)return A = !0, 0;
                            var n = !e.compareDocumentPosition - !t.compareDocumentPosition;
                            return n ? n : (n = (e.ownerDocument || e) === (t.ownerDocument || t) ? e.compareDocumentPosition(t) : 1, 1 & n || !x.sortDetached && t.compareDocumentPosition(e) === n ? e === i || e.ownerDocument === R && O(R, e) ? -1 : t === i || t.ownerDocument === R && O(R, t) ? 1 : M ? ee(M, e) - ee(M, t) : 0 : 4 & n ? -1 : 1)
                        } : function (e, t) {
                            if (e === t)return A = !0, 0;
                            var n, a = 0, r = e.parentNode, s = t.parentNode, l = [e], d = [t];
                            if (!r || !s)return e === i ? -1 : t === i ? 1 : r ? -1 : s ? 1 : M ? ee(M, e) - ee(M, t) : 0;
                            if (r === s)return o(e, t);
                            for (n = e; n = n.parentNode;)l.unshift(n);
                            for (n = t; n = n.parentNode;)d.unshift(n);
                            for (; l[a] === d[a];)a++;
                            return a ? o(l[a], d[a]) : l[a] === R ? -1 : d[a] === R ? 1 : 0
                        }, i) : L
            }, t.matches = function (e, n) {
                return t(e, null, null, n)
            }, t.matchesSelector = function (e, n) {
                if ((e.ownerDocument || e) !== L && I(e), n = n.replace(pe, "='$1']"), !(!x.matchesSelector || !P || H && H.test(n) || z && z.test(n)))try {
                    var i = B.call(e, n);
                    if (i || x.disconnectedMatch || e.document && 11 !== e.document.nodeType)return i
                } catch (a) {
                }
                return t(n, L, null, [e]).length > 0
            }, t.contains = function (e, t) {
                return (e.ownerDocument || e) !== L && I(e), O(e, t)
            }, t.attr = function (e, t) {
                (e.ownerDocument || e) !== L && I(e);
                var n = T.attrHandle[t.toLowerCase()], i = n && U.call(T.attrHandle, t.toLowerCase()) ? n(e, t, !P) : void 0;
                return void 0 !== i ? i : x.attributes || !P ? e.getAttribute(t) : (i = e.getAttributeNode(t)) && i.specified ? i.value : null
            }, t.error = function (e) {
                throw new Error("Syntax error, unrecognized expression: " + e)
            }, t.uniqueSort = function (e) {
                var t, n = [], i = 0, a = 0;
                if (A = !x.detectDuplicates, M = !x.sortStable && e.slice(0), e.sort(V), A) {
                    for (; t = e[a++];)t === e[a] && (i = n.push(a));
                    for (; i--;)e.splice(n[i], 1)
                }
                return M = null, e
            }, C = t.getText = function (e) {
                var t, n = "", i = 0, a = e.nodeType;
                if (a) {
                    if (1 === a || 9 === a || 11 === a) {
                        if ("string" == typeof e.textContent)return e.textContent;
                        for (e = e.firstChild; e; e = e.nextSibling)n += C(e)
                    } else if (3 === a || 4 === a)return e.nodeValue
                } else for (; t = e[i++];)n += C(t);
                return n
            }, T = t.selectors = {
                cacheLength: 50,
                createPseudo: i,
                match: he,
                attrHandle: {},
                find: {},
                relative: {
                    ">": {dir: "parentNode", first: !0},
                    " ": {dir: "parentNode"},
                    "+": {dir: "previousSibling", first: !0},
                    "~": {dir: "previousSibling"}
                },
                preFilter: {
                    ATTR: function (e) {
                        return e[1] = e[1].replace(xe, Te), e[3] = (e[3] || e[4] || e[5] || "").replace(xe, Te), "~=" === e[2] && (e[3] = " " + e[3] + " "), e.slice(0, 4)
                    }, CHILD: function (e) {
                        return e[1] = e[1].toLowerCase(), "nth" === e[1].slice(0, 3) ? (e[3] || t.error(e[0]), e[4] = +(e[4] ? e[5] + (e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3])), e[5] = +(e[7] + e[8] || "odd" === e[3])) : e[3] && t.error(e[0]), e
                    }, PSEUDO: function (e) {
                        var t, n = !e[6] && e[2];
                        return he.CHILD.test(e[0]) ? null : (e[3] ? e[2] = e[4] || e[5] || "" : n && ce.test(n) && (t = E(n, !0)) && (t = n.indexOf(")", n.length - t) - n.length) && (e[0] = e[0].slice(0, t), e[2] = n.slice(0, t)), e.slice(0, 3))
                    }
                },
                filter: {
                    TAG: function (e) {
                        var t = e.replace(xe, Te).toLowerCase();
                        return "*" === e ? function () {
                                return !0
                            } : function (e) {
                                return e.nodeName && e.nodeName.toLowerCase() === t
                            }
                    }, CLASS: function (e) {
                        var t = _[e + " "];
                        return t || (t = new RegExp("(^|" + ne + ")" + e + "(" + ne + "|$)")) && _(e, function (e) {
                                return t.test("string" == typeof e.className && e.className || "undefined" != typeof e.getAttribute && e.getAttribute("class") || "")
                            })
                    }, ATTR: function (e, n, i) {
                        return function (a) {
                            var r = t.attr(a, e);
                            return null == r ? "!=" === n : n ? (r += "", "=" === n ? r === i : "!=" === n ? r !== i : "^=" === n ? i && 0 === r.indexOf(i) : "*=" === n ? i && r.indexOf(i) > -1 : "$=" === n ? i && r.slice(-i.length) === i : "~=" === n ? (" " + r.replace(se, " ") + " ").indexOf(i) > -1 : "|=" === n ? r === i || r.slice(0, i.length + 1) === i + "-" : !1) : !0
                        }
                    }, CHILD: function (e, t, n, i, a) {
                        var r = "nth" !== e.slice(0, 3), o = "last" !== e.slice(-4), s = "of-type" === t;
                        return 1 === i && 0 === a ? function (e) {
                                return !!e.parentNode
                            } : function (t, n, l) {
                                var d, u, p, c, f, h, m = r !== o ? "nextSibling" : "previousSibling", g = t.parentNode, v = s && t.nodeName.toLowerCase(), y = !l && !s;
                                if (g) {
                                    if (r) {
                                        for (; m;) {
                                            for (p = t; p = p[m];)if (s ? p.nodeName.toLowerCase() === v : 1 === p.nodeType)return !1;
                                            h = m = "only" === e && !h && "nextSibling"
                                        }
                                        return !0
                                    }
                                    if (h = [o ? g.firstChild : g.lastChild], o && y) {
                                        for (u = g[j] || (g[j] = {}), d = u[e] || [], f = d[0] === F && d[1], c = d[0] === F && d[2], p = f && g.childNodes[f]; p = ++f && p && p[m] || (c = f = 0) || h.pop();)if (1 === p.nodeType && ++c && p === t) {
                                            u[e] = [F, f, c];
                                            break
                                        }
                                    } else if (y && (d = (t[j] || (t[j] = {}))[e]) && d[0] === F) c = d[1]; else for (; (p = ++f && p && p[m] || (c = f = 0) || h.pop()) && ((s ? p.nodeName.toLowerCase() !== v : 1 !== p.nodeType) || !++c || (y && ((p[j] || (p[j] = {}))[e] = [F, c]), p !== t)););
                                    return c -= a, c === i || c % i === 0 && c / i >= 0
                                }
                            }
                    }, PSEUDO: function (e, n) {
                        var a, r = T.pseudos[e] || T.setFilters[e.toLowerCase()] || t.error("unsupported pseudo: " + e);
                        return r[j] ? r(n) : r.length > 1 ? (a = [e, e, "", n], T.setFilters.hasOwnProperty(e.toLowerCase()) ? i(function (e, t) {
                                        for (var i, a = r(e, n), o = a.length; o--;)i = ee(e, a[o]), e[i] = !(t[i] = a[o])
                                    }) : function (e) {
                                        return r(e, 0, a)
                                    }) : r
                    }
                },
                pseudos: {
                    not: i(function (e) {
                        var t = [], n = [], a = k(e.replace(le, "$1"));
                        return a[j] ? i(function (e, t, n, i) {
                                for (var r, o = a(e, null, i, []), s = e.length; s--;)(r = o[s]) && (e[s] = !(t[s] = r))
                            }) : function (e, i, r) {
                                return t[0] = e, a(t, null, r, n), t[0] = null, !n.pop()
                            }
                    }), has: i(function (e) {
                        return function (n) {
                            return t(e, n).length > 0
                        }
                    }), contains: i(function (e) {
                        return e = e.replace(xe, Te), function (t) {
                            return (t.textContent || t.innerText || C(t)).indexOf(e) > -1
                        }
                    }), lang: i(function (e) {
                        return fe.test(e || "") || t.error("unsupported lang: " + e), e = e.replace(xe, Te).toLowerCase(), function (t) {
                            var n;
                            do if (n = P ? t.lang : t.getAttribute("xml:lang") || t.getAttribute("lang"))return n = n.toLowerCase(), n === e || 0 === n.indexOf(e + "-"); while ((t = t.parentNode) && 1 === t.nodeType);
                            return !1
                        }
                    }), target: function (t) {
                        var n = e.location && e.location.hash;
                        return n && n.slice(1) === t.id
                    }, root: function (e) {
                        return e === $
                    }, focus: function (e) {
                        return e === L.activeElement && (!L.hasFocus || L.hasFocus()) && !!(e.type || e.href || ~e.tabIndex)
                    }, enabled: function (e) {
                        return e.disabled === !1
                    }, disabled: function (e) {
                        return e.disabled === !0
                    }, checked: function (e) {
                        var t = e.nodeName.toLowerCase();
                        return "input" === t && !!e.checked || "option" === t && !!e.selected
                    }, selected: function (e) {
                        return e.parentNode && e.parentNode.selectedIndex, e.selected === !0
                    }, empty: function (e) {
                        for (e = e.firstChild; e; e = e.nextSibling)if (e.nodeType < 6)return !1;
                        return !0
                    }, parent: function (e) {
                        return !T.pseudos.empty(e)
                    }, header: function (e) {
                        return ge.test(e.nodeName)
                    }, input: function (e) {
                        return me.test(e.nodeName)
                    }, button: function (e) {
                        var t = e.nodeName.toLowerCase();
                        return "input" === t && "button" === e.type || "button" === t
                    }, text: function (e) {
                        var t;
                        return "input" === e.nodeName.toLowerCase() && "text" === e.type && (null == (t = e.getAttribute("type")) || "text" === t.toLowerCase())
                    }, first: d(function () {
                        return [0]
                    }), last: d(function (e, t) {
                        return [t - 1]
                    }), eq: d(function (e, t, n) {
                        return [0 > n ? n + t : n]
                    }), even: d(function (e, t) {
                        for (var n = 0; t > n; n += 2)e.push(n);
                        return e
                    }), odd: d(function (e, t) {
                        for (var n = 1; t > n; n += 2)e.push(n);
                        return e
                    }), lt: d(function (e, t, n) {
                        for (var i = 0 > n ? n + t : n; --i >= 0;)e.push(i);
                        return e
                    }), gt: d(function (e, t, n) {
                        for (var i = 0 > n ? n + t : n; ++i < t;)e.push(i);
                        return e
                    })
                }
            }, T.pseudos.nth = T.pseudos.eq;
            for (b in{radio: !0, checkbox: !0, file: !0, password: !0, image: !0})T.pseudos[b] = s(b);
            for (b in{submit: !0, reset: !0})T.pseudos[b] = l(b);
            return p.prototype = T.filters = T.pseudos, T.setFilters = new p, E = t.tokenize = function (e, n) {
                var i, a, r, o, s, l, d, u = q[e + " "];
                if (u)return n ? 0 : u.slice(0);
                for (s = e, l = [], d = T.preFilter; s;) {
                    (!i || (a = de.exec(s))) && (a && (s = s.slice(a[0].length) || s), l.push(r = [])), i = !1, (a = ue.exec(s)) && (i = a.shift(), r.push({
                        value: i,
                        type: a[0].replace(le, " ")
                    }), s = s.slice(i.length));
                    for (o in T.filter)!(a = he[o].exec(s)) || d[o] && !(a = d[o](a)) || (i = a.shift(), r.push({
                        value: i,
                        type: o,
                        matches: a
                    }), s = s.slice(i.length));
                    if (!i)break
                }
                return n ? s.length : s ? t.error(e) : q(e, l).slice(0)
            }, k = t.compile = function (e, t) {
                var n, i = [], a = [], r = G[e + " "];
                if (!r) {
                    for (t || (t = E(e)), n = t.length; n--;)r = y(t[n]), r[j] ? i.push(r) : a.push(r);
                    r = G(e, w(a, i)), r.selector = e
                }
                return r
            }, N = t.select = function (e, t, n, i) {
                var a, r, o, s, l, d = "function" == typeof e && e, p = !i && E(e = d.selector || e);
                if (n = n || [], 1 === p.length) {
                    if (r = p[0] = p[0].slice(0), r.length > 2 && "ID" === (o = r[0]).type && x.getById && 9 === t.nodeType && P && T.relative[r[1].type]) {
                        if (t = (T.find.ID(o.matches[0].replace(xe, Te), t) || [])[0], !t)return n;
                        d && (t = t.parentNode), e = e.slice(r.shift().value.length)
                    }
                    for (a = he.needsContext.test(e) ? 0 : r.length; a-- && (o = r[a], !T.relative[s = o.type]);)if ((l = T.find[s]) && (i = l(o.matches[0].replace(xe, Te), we.test(r[0].type) && u(t.parentNode) || t))) {
                        if (r.splice(a, 1), e = i.length && c(r), !e)return J.apply(n, i), n;
                        break
                    }
                }
                return (d || k(e, p))(i, t, !P, n, we.test(e) && u(t.parentNode) || t), n
            }, x.sortStable = j.split("").sort(V).join("") === j, x.detectDuplicates = !!A, I(), x.sortDetached = a(function (e) {
                return 1 & e.compareDocumentPosition(L.createElement("div"))
            }), a(function (e) {
                return e.innerHTML = "<a href='#'></a>", "#" === e.firstChild.getAttribute("href")
            }) || r("type|href|height|width", function (e, t, n) {
                return n ? void 0 : e.getAttribute(t, "type" === t.toLowerCase() ? 1 : 2)
            }), x.attributes && a(function (e) {
                return e.innerHTML = "<input/>", e.firstChild.setAttribute("value", ""), "" === e.firstChild.getAttribute("value")
            }) || r("value", function (e, t, n) {
                return n || "input" !== e.nodeName.toLowerCase() ? void 0 : e.defaultValue
            }), a(function (e) {
                return null == e.getAttribute("disabled")
            }) || r(te, function (e, t, n) {
                var i;
                return n ? void 0 : e[t] === !0 ? t.toLowerCase() : (i = e.getAttributeNode(t)) && i.specified ? i.value : null
            }), t
        }(e);
        ae.find = de, ae.expr = de.selectors, ae.expr[":"] = ae.expr.pseudos, ae.unique = de.uniqueSort, ae.text = de.getText, ae.isXMLDoc = de.isXML, ae.contains = de.contains;
        var ue = ae.expr.match.needsContext, pe = /^<(\w+)\s*\/?>(?:<\/\1>|)$/, ce = /^.[^:#\[\.,]*$/;
        ae.filter = function (e, t, n) {
            var i = t[0];
            return n && (e = ":not(" + e + ")"), 1 === t.length && 1 === i.nodeType ? ae.find.matchesSelector(i, e) ? [i] : [] : ae.find.matches(e, ae.grep(t, function (e) {
                    return 1 === e.nodeType
                }))
        }, ae.fn.extend({
            find: function (e) {
                var t, n = [], i = this, a = i.length;
                if ("string" != typeof e)return this.pushStack(ae(e).filter(function () {
                    for (t = 0; a > t; t++)if (ae.contains(i[t], this))return !0
                }));
                for (t = 0; a > t; t++)ae.find(e, i[t], n);
                return n = this.pushStack(a > 1 ? ae.unique(n) : n), n.selector = this.selector ? this.selector + " " + e : e, n
            }, filter: function (e) {
                return this.pushStack(i(this, e || [], !1))
            }, not: function (e) {
                return this.pushStack(i(this, e || [], !0))
            }, is: function (e) {
                return !!i(this, "string" == typeof e && ue.test(e) ? ae(e) : e || [], !1).length
            }
        });
        var fe, he = e.document, me = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/, ge = ae.fn.init = function (e, t) {
            var n, i;
            if (!e)return this;
            if ("string" == typeof e) {
                if (n = "<" === e.charAt(0) && ">" === e.charAt(e.length - 1) && e.length >= 3 ? [null, e, null] : me.exec(e), !n || !n[1] && t)return !t || t.jquery ? (t || fe).find(e) : this.constructor(t).find(e);
                if (n[1]) {
                    if (t = t instanceof ae ? t[0] : t, ae.merge(this, ae.parseHTML(n[1], t && t.nodeType ? t.ownerDocument || t : he, !0)), pe.test(n[1]) && ae.isPlainObject(t))for (n in t)ae.isFunction(this[n]) ? this[n](t[n]) : this.attr(n, t[n]);
                    return this
                }
                if (i = he.getElementById(n[2]), i && i.parentNode) {
                    if (i.id !== n[2])return fe.find(e);
                    this.length = 1, this[0] = i
                }
                return this.context = he, this.selector = e, this
            }
            return e.nodeType ? (this.context = this[0] = e, this.length = 1, this) : ae.isFunction(e) ? "undefined" != typeof fe.ready ? fe.ready(e) : e(ae) : (void 0 !== e.selector && (this.selector = e.selector, this.context = e.context), ae.makeArray(e, this))
        };
        ge.prototype = ae.fn, fe = ae(he);
        var ve = /^(?:parents|prev(?:Until|All))/, ye = {children: !0, contents: !0, next: !0, prev: !0};
        ae.extend({
            dir: function (e, t, n) {
                for (var i = [], a = e[t]; a && 9 !== a.nodeType && (void 0 === n || 1 !== a.nodeType || !ae(a).is(n));)1 === a.nodeType && i.push(a), a = a[t];
                return i
            }, sibling: function (e, t) {
                for (var n = []; e; e = e.nextSibling)1 === e.nodeType && e !== t && n.push(e);
                return n
            }
        }), ae.fn.extend({
            has: function (e) {
                var t, n = ae(e, this), i = n.length;
                return this.filter(function () {
                    for (t = 0; i > t; t++)if (ae.contains(this, n[t]))return !0
                })
            }, closest: function (e, t) {
                for (var n, i = 0, a = this.length, r = [], o = ue.test(e) || "string" != typeof e ? ae(e, t || this.context) : 0; a > i; i++)for (n = this[i]; n && n !== t; n = n.parentNode)if (n.nodeType < 11 && (o ? o.index(n) > -1 : 1 === n.nodeType && ae.find.matchesSelector(n, e))) {
                    r.push(n);
                    break
                }
                return this.pushStack(r.length > 1 ? ae.unique(r) : r)
            }, index: function (e) {
                return e ? "string" == typeof e ? ae.inArray(this[0], ae(e)) : ae.inArray(e.jquery ? e[0] : e, this) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
            }, add: function (e, t) {
                return this.pushStack(ae.unique(ae.merge(this.get(), ae(e, t))))
            }, addBack: function (e) {
                return this.add(null == e ? this.prevObject : this.prevObject.filter(e))
            }
        }), ae.each({
            parent: function (e) {
                var t = e.parentNode;
                return t && 11 !== t.nodeType ? t : null
            }, parents: function (e) {
                return ae.dir(e, "parentNode")
            }, parentsUntil: function (e, t, n) {
                return ae.dir(e, "parentNode", n)
            }, next: function (e) {
                return a(e, "nextSibling")
            }, prev: function (e) {
                return a(e, "previousSibling")
            }, nextAll: function (e) {
                return ae.dir(e, "nextSibling")
            }, prevAll: function (e) {
                return ae.dir(e, "previousSibling")
            }, nextUntil: function (e, t, n) {
                return ae.dir(e, "nextSibling", n)
            }, prevUntil: function (e, t, n) {
                return ae.dir(e, "previousSibling", n)
            }, siblings: function (e) {
                return ae.sibling((e.parentNode || {}).firstChild, e)
            }, children: function (e) {
                return ae.sibling(e.firstChild)
            }, contents: function (e) {
                return ae.nodeName(e, "iframe") ? e.contentDocument || e.contentWindow.document : ae.merge([], e.childNodes)
            }
        }, function (e, t) {
            ae.fn[e] = function (n, i) {
                var a = ae.map(this, t, n);
                return "Until" !== e.slice(-5) && (i = n), i && "string" == typeof i && (a = ae.filter(i, a)), this.length > 1 && (ye[e] || (a = ae.unique(a)), ve.test(e) && (a = a.reverse())), this.pushStack(a)
            }
        });
        var we = /\S+/g, be = {};
        ae.Callbacks = function (e) {
            e = "string" == typeof e ? be[e] || r(e) : ae.extend({}, e);
            var t, n, i, a, o, s, l = [], d = !e.once && [], u = function (r) {
                for (n = e.memory && r, i = !0, o = s || 0, s = 0, a = l.length, t = !0; l && a > o; o++)if (l[o].apply(r[0], r[1]) === !1 && e.stopOnFalse) {
                    n = !1;
                    break
                }
                t = !1, l && (d ? d.length && u(d.shift()) : n ? l = [] : p.disable())
            }, p = {
                add: function () {
                    if (l) {
                        var i = l.length;
                        !function r(t) {
                            ae.each(t, function (t, n) {
                                var i = ae.type(n);
                                "function" === i ? e.unique && p.has(n) || l.push(n) : n && n.length && "string" !== i && r(n)
                            })
                        }(arguments), t ? a = l.length : n && (s = i, u(n))
                    }
                    return this
                }, remove: function () {
                    return l && ae.each(arguments, function (e, n) {
                        for (var i; (i = ae.inArray(n, l, i)) > -1;)l.splice(i, 1), t && (a >= i && a--, o >= i && o--)
                    }), this
                }, has: function (e) {
                    return e ? ae.inArray(e, l) > -1 : !(!l || !l.length)
                }, empty: function () {
                    return l = [], a = 0, this
                }, disable: function () {
                    return l = d = n = void 0, this
                }, disabled: function () {
                    return !l
                }, lock: function () {
                    return d = void 0, n || p.disable(), this
                }, locked: function () {
                    return !d
                }, fireWith: function (e, n) {
                    return !l || i && !d || (n = n || [], n = [e, n.slice ? n.slice() : n], t ? d.push(n) : u(n)), this
                }, fire: function () {
                    return p.fireWith(this, arguments), this
                }, fired: function () {
                    return !!i
                }
            };
            return p
        }, ae.extend({
            Deferred: function (e) {
                var t = [["resolve", "done", ae.Callbacks("once memory"), "resolved"], ["reject", "fail", ae.Callbacks("once memory"), "rejected"], ["notify", "progress", ae.Callbacks("memory")]], n = "pending", i = {
                    state: function () {
                        return n
                    }, always: function () {
                        return a.done(arguments).fail(arguments), this
                    }, then: function () {
                        var e = arguments;
                        return ae.Deferred(function (n) {
                            ae.each(t, function (t, r) {
                                var o = ae.isFunction(e[t]) && e[t];
                                a[r[1]](function () {
                                    var e = o && o.apply(this, arguments);
                                    e && ae.isFunction(e.promise) ? e.promise().done(n.resolve).fail(n.reject).progress(n.notify) : n[r[0] + "With"](this === i ? n.promise() : this, o ? [e] : arguments)
                                })
                            }), e = null
                        }).promise()
                    }, promise: function (e) {
                        return null != e ? ae.extend(e, i) : i
                    }
                }, a = {};
                return i.pipe = i.then, ae.each(t, function (e, r) {
                    var o = r[2], s = r[3];
                    i[r[1]] = o.add, s && o.add(function () {
                        n = s
                    }, t[1 ^ e][2].disable, t[2][2].lock), a[r[0]] = function () {
                        return a[r[0] + "With"](this === a ? i : this, arguments), this
                    }, a[r[0] + "With"] = o.fireWith
                }), i.promise(a), e && e.call(a, a), a
            }, when: function (e) {
                var t, n, i, a = 0, r = Y.call(arguments), o = r.length, s = 1 !== o || e && ae.isFunction(e.promise) ? o : 0, l = 1 === s ? e : ae.Deferred(), d = function (e, n, i) {
                    return function (a) {
                        n[e] = this, i[e] = arguments.length > 1 ? Y.call(arguments) : a, i === t ? l.notifyWith(n, i) : --s || l.resolveWith(n, i)
                    }
                };
                if (o > 1)for (t = new Array(o), n = new Array(o), i = new Array(o); o > a; a++)r[a] && ae.isFunction(r[a].promise) ? r[a].promise().done(d(a, i, r)).fail(l.reject).progress(d(a, n, t)) : --s;
                return s || l.resolveWith(i, r), l.promise()
            }
        });
        var xe;
        ae.fn.ready = function (e) {
            return ae.ready.promise().done(e), this
        }, ae.extend({
            isReady: !1, readyWait: 1, holdReady: function (e) {
                e ? ae.readyWait++ : ae.ready(!0)
            }, ready: function (e) {
                if (e === !0 ? !--ae.readyWait : !ae.isReady) {
                    if (!he.body)return setTimeout(ae.ready);
                    ae.isReady = !0, e !== !0 && --ae.readyWait > 0 || (xe.resolveWith(he, [ae]), ae.fn.triggerHandler && (ae(he).triggerHandler("ready"), ae(he).off("ready")))
                }
            }
        }), ae.ready.promise = function (t) {
            if (!xe)if (xe = ae.Deferred(), "complete" === he.readyState) setTimeout(ae.ready); else if (he.addEventListener) he.addEventListener("DOMContentLoaded", s, !1), e.addEventListener("load", s, !1); else {
                he.attachEvent("onreadystatechange", s), e.attachEvent("onload", s);
                var n = !1;
                try {
                    n = null == e.frameElement && he.documentElement
                } catch (i) {
                }
                n && n.doScroll && !function a() {
                    if (!ae.isReady) {
                        try {
                            n.doScroll("left")
                        } catch (e) {
                            return setTimeout(a, 50)
                        }
                        o(), ae.ready()
                    }
                }()
            }
            return xe.promise(t)
        };
        var Te, Ce = "undefined";
        for (Te in ae(ne))break;
        ne.ownLast = "0" !== Te, ne.inlineBlockNeedsLayout = !1, ae(function () {
            var e, t, n, i;
            n = he.getElementsByTagName("body")[0], n && n.style && (t = he.createElement("div"), i = he.createElement("div"), i.style.cssText = "position:absolute;border:0;width:0;height:0;top:0;left:-9999px", n.appendChild(i).appendChild(t), typeof t.style.zoom !== Ce && (t.style.cssText = "display:inline;margin:0;border:0;padding:1px;width:1px;zoom:1", ne.inlineBlockNeedsLayout = e = 3 === t.offsetWidth, e && (n.style.zoom = 1)), n.removeChild(i))
        }), function () {
            var e = he.createElement("div");
            if (null == ne.deleteExpando) {
                ne.deleteExpando = !0;
                try {
                    delete e.test
                } catch (t) {
                    ne.deleteExpando = !1
                }
            }
            e = null
        }(), ae.acceptData = function (e) {
            var t = ae.noData[(e.nodeName + " ").toLowerCase()], n = +e.nodeType || 1;
            return 1 !== n && 9 !== n ? !1 : !t || t !== !0 && e.getAttribute("classid") === t
        };
        var Se = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/, Ee = /([A-Z])/g;
        ae.extend({
            cache: {},
            noData: {"applet ": !0, "embed ": !0, "object ": "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"},
            hasData: function (e) {
                return e = e.nodeType ? ae.cache[e[ae.expando]] : e[ae.expando], !!e && !d(e)
            },
            data: function (e, t, n) {
                return u(e, t, n)
            },
            removeData: function (e, t) {
                return p(e, t)
            },
            _data: function (e, t, n) {
                return u(e, t, n, !0)
            },
            _removeData: function (e, t) {
                return p(e, t, !0)
            }
        }), ae.fn.extend({
            data: function (e, t) {
                var n, i, a, r = this[0], o = r && r.attributes;
                if (void 0 === e) {
                    if (this.length && (a = ae.data(r), 1 === r.nodeType && !ae._data(r, "parsedAttrs"))) {
                        for (n = o.length; n--;)o[n] && (i = o[n].name, 0 === i.indexOf("data-") && (i = ae.camelCase(i.slice(5)), l(r, i, a[i])));
                        ae._data(r, "parsedAttrs", !0)
                    }
                    return a
                }
                return "object" == typeof e ? this.each(function () {
                        ae.data(this, e)
                    }) : arguments.length > 1 ? this.each(function () {
                            ae.data(this, e, t)
                        }) : r ? l(r, e, ae.data(r, e)) : void 0
            }, removeData: function (e) {
                return this.each(function () {
                    ae.removeData(this, e)
                })
            }
        }), ae.extend({
            queue: function (e, t, n) {
                var i;
                return e ? (t = (t || "fx") + "queue", i = ae._data(e, t), n && (!i || ae.isArray(n) ? i = ae._data(e, t, ae.makeArray(n)) : i.push(n)), i || []) : void 0
            }, dequeue: function (e, t) {
                t = t || "fx";
                var n = ae.queue(e, t), i = n.length, a = n.shift(), r = ae._queueHooks(e, t), o = function () {
                    ae.dequeue(e, t)
                };
                "inprogress" === a && (a = n.shift(), i--), a && ("fx" === t && n.unshift("inprogress"), delete r.stop, a.call(e, o, r)), !i && r && r.empty.fire()
            }, _queueHooks: function (e, t) {
                var n = t + "queueHooks";
                return ae._data(e, n) || ae._data(e, n, {
                        empty: ae.Callbacks("once memory").add(function () {
                            ae._removeData(e, t + "queue"), ae._removeData(e, n)
                        })
                    })
            }
        }), ae.fn.extend({
            queue: function (e, t) {
                var n = 2;
                return "string" != typeof e && (t = e, e = "fx", n--), arguments.length < n ? ae.queue(this[0], e) : void 0 === t ? this : this.each(function () {
                            var n = ae.queue(this, e, t);
                            ae._queueHooks(this, e), "fx" === e && "inprogress" !== n[0] && ae.dequeue(this, e)
                        })
            }, dequeue: function (e) {
                return this.each(function () {
                    ae.dequeue(this, e)
                })
            }, clearQueue: function (e) {
                return this.queue(e || "fx", [])
            }, promise: function (e, t) {
                var n, i = 1, a = ae.Deferred(), r = this, o = this.length, s = function () {
                    --i || a.resolveWith(r, [r])
                };
                for ("string" != typeof e && (t = e, e = void 0), e = e || "fx"; o--;)n = ae._data(r[o], e + "queueHooks"), n && n.empty && (i++, n.empty.add(s));
                return s(), a.promise(t)
            }
        });
        var ke = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source, Ne = ["Top", "Right", "Bottom", "Left"], De = function (e, t) {
            return e = t || e, "none" === ae.css(e, "display") || !ae.contains(e.ownerDocument, e)
        }, Me = ae.access = function (e, t, n, i, a, r, o) {
            var s = 0, l = e.length, d = null == n;
            if ("object" === ae.type(n)) {
                a = !0;
                for (s in n)ae.access(e, t, s, n[s], !0, r, o)
            } else if (void 0 !== i && (a = !0, ae.isFunction(i) || (o = !0), d && (o ? (t.call(e, i), t = null) : (d = t, t = function (e, t, n) {
                        return d.call(ae(e), n)
                    })), t))for (; l > s; s++)t(e[s], n, o ? i : i.call(e[s], s, t(e[s], n)));
            return a ? e : d ? t.call(e) : l ? t(e[0], n) : r
        }, Ae = /^(?:checkbox|radio)$/i;
        !function () {
            var e = he.createElement("input"), t = he.createElement("div"), n = he.createDocumentFragment();
            if (t.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", ne.leadingWhitespace = 3 === t.firstChild.nodeType, ne.tbody = !t.getElementsByTagName("tbody").length, ne.htmlSerialize = !!t.getElementsByTagName("link").length, ne.html5Clone = "<:nav></:nav>" !== he.createElement("nav").cloneNode(!0).outerHTML, e.type = "checkbox", e.checked = !0, n.appendChild(e), ne.appendChecked = e.checked, t.innerHTML = "<textarea>x</textarea>", ne.noCloneChecked = !!t.cloneNode(!0).lastChild.defaultValue, n.appendChild(t), t.innerHTML = "<input type='radio' checked='checked' name='t'/>", ne.checkClone = t.cloneNode(!0).cloneNode(!0).lastChild.checked, ne.noCloneEvent = !0, t.attachEvent && (t.attachEvent("onclick", function () {
                    ne.noCloneEvent = !1
                }), t.cloneNode(!0).click()), null == ne.deleteExpando) {
                ne.deleteExpando = !0;
                try {
                    delete t.test
                } catch (i) {
                    ne.deleteExpando = !1
                }
            }
        }(), function () {
            var t, n, i = he.createElement("div");
            for (t in{
                submit: !0,
                change: !0,
                focusin: !0
            })n = "on" + t, (ne[t + "Bubbles"] = n in e) || (i.setAttribute(n, "t"), ne[t + "Bubbles"] = i.attributes[n].expando === !1);
            i = null
        }();
        var Ie = /^(?:input|select|textarea)$/i, Le = /^key/, $e = /^(?:mouse|pointer|contextmenu)|click/, Pe = /^(?:focusinfocus|focusoutblur)$/, ze = /^([^.]*)(?:\.(.+)|)$/;
        ae.event = {
            global: {},
            add: function (e, t, n, i, a) {
                var r, o, s, l, d, u, p, c, f, h, m, g = ae._data(e);
                if (g) {
                    for (n.handler && (l = n, n = l.handler, a = l.selector), n.guid || (n.guid = ae.guid++), (o = g.events) || (o = g.events = {}), (u = g.handle) || (u = g.handle = function (e) {
                        return typeof ae === Ce || e && ae.event.triggered === e.type ? void 0 : ae.event.dispatch.apply(u.elem, arguments)
                    }, u.elem = e), t = (t || "").match(we) || [""], s = t.length; s--;)r = ze.exec(t[s]) || [], f = m = r[1], h = (r[2] || "").split(".").sort(), f && (d = ae.event.special[f] || {}, f = (a ? d.delegateType : d.bindType) || f, d = ae.event.special[f] || {}, p = ae.extend({
                        type: f,
                        origType: m,
                        data: i,
                        handler: n,
                        guid: n.guid,
                        selector: a,
                        needsContext: a && ae.expr.match.needsContext.test(a),
                        namespace: h.join(".")
                    }, l), (c = o[f]) || (c = o[f] = [], c.delegateCount = 0, d.setup && d.setup.call(e, i, h, u) !== !1 || (e.addEventListener ? e.addEventListener(f, u, !1) : e.attachEvent && e.attachEvent("on" + f, u))), d.add && (d.add.call(e, p), p.handler.guid || (p.handler.guid = n.guid)), a ? c.splice(c.delegateCount++, 0, p) : c.push(p), ae.event.global[f] = !0);
                    e = null
                }
            },
            remove: function (e, t, n, i, a) {
                var r, o, s, l, d, u, p, c, f, h, m, g = ae.hasData(e) && ae._data(e);
                if (g && (u = g.events)) {
                    for (t = (t || "").match(we) || [""], d = t.length; d--;)if (s = ze.exec(t[d]) || [], f = m = s[1], h = (s[2] || "").split(".").sort(), f) {
                        for (p = ae.event.special[f] || {}, f = (i ? p.delegateType : p.bindType) || f, c = u[f] || [], s = s[2] && new RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)"), l = r = c.length; r--;)o = c[r], !a && m !== o.origType || n && n.guid !== o.guid || s && !s.test(o.namespace) || i && i !== o.selector && ("**" !== i || !o.selector) || (c.splice(r, 1), o.selector && c.delegateCount--, p.remove && p.remove.call(e, o));
                        l && !c.length && (p.teardown && p.teardown.call(e, h, g.handle) !== !1 || ae.removeEvent(e, f, g.handle), delete u[f])
                    } else for (f in u)ae.event.remove(e, f + t[d], n, i, !0);
                    ae.isEmptyObject(u) && (delete g.handle, ae._removeData(e, "events"))
                }
            },
            trigger: function (t, n, i, a) {
                var r, o, s, l, d, u, p, c = [i || he], f = te.call(t, "type") ? t.type : t, h = te.call(t, "namespace") ? t.namespace.split(".") : [];
                if (s = u = i = i || he, 3 !== i.nodeType && 8 !== i.nodeType && !Pe.test(f + ae.event.triggered) && (f.indexOf(".") >= 0 && (h = f.split("."), f = h.shift(), h.sort()), o = f.indexOf(":") < 0 && "on" + f, t = t[ae.expando] ? t : new ae.Event(f, "object" == typeof t && t), t.isTrigger = a ? 2 : 3, t.namespace = h.join("."), t.namespace_re = t.namespace ? new RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, t.result = void 0, t.target || (t.target = i), n = null == n ? [t] : ae.makeArray(n, [t]), d = ae.event.special[f] || {}, a || !d.trigger || d.trigger.apply(i, n) !== !1)) {
                    if (!a && !d.noBubble && !ae.isWindow(i)) {
                        for (l = d.delegateType || f, Pe.test(l + f) || (s = s.parentNode); s; s = s.parentNode)c.push(s), u = s;
                        u === (i.ownerDocument || he) && c.push(u.defaultView || u.parentWindow || e)
                    }
                    for (p = 0; (s = c[p++]) && !t.isPropagationStopped();)t.type = p > 1 ? l : d.bindType || f, r = (ae._data(s, "events") || {})[t.type] && ae._data(s, "handle"), r && r.apply(s, n), r = o && s[o], r && r.apply && ae.acceptData(s) && (t.result = r.apply(s, n), t.result === !1 && t.preventDefault());
                    if (t.type = f, !a && !t.isDefaultPrevented() && (!d._default || d._default.apply(c.pop(), n) === !1) && ae.acceptData(i) && o && i[f] && !ae.isWindow(i)) {
                        u = i[o], u && (i[o] = null), ae.event.triggered = f;
                        try {
                            i[f]()
                        } catch (m) {
                        }
                        ae.event.triggered = void 0, u && (i[o] = u)
                    }
                    return t.result
                }
            },
            dispatch: function (e) {
                e = ae.event.fix(e);
                var t, n, i, a, r, o = [], s = Y.call(arguments), l = (ae._data(this, "events") || {})[e.type] || [], d = ae.event.special[e.type] || {};
                if (s[0] = e, e.delegateTarget = this, !d.preDispatch || d.preDispatch.call(this, e) !== !1) {
                    for (o = ae.event.handlers.call(this, e, l), t = 0; (a = o[t++]) && !e.isPropagationStopped();)for (e.currentTarget = a.elem, r = 0; (i = a.handlers[r++]) && !e.isImmediatePropagationStopped();)(!e.namespace_re || e.namespace_re.test(i.namespace)) && (e.handleObj = i, e.data = i.data, n = ((ae.event.special[i.origType] || {}).handle || i.handler).apply(a.elem, s), void 0 !== n && (e.result = n) === !1 && (e.preventDefault(), e.stopPropagation()));
                    return d.postDispatch && d.postDispatch.call(this, e), e.result
                }
            },
            handlers: function (e, t) {
                var n, i, a, r, o = [], s = t.delegateCount, l = e.target;
                if (s && l.nodeType && (!e.button || "click" !== e.type))for (; l != this; l = l.parentNode || this)if (1 === l.nodeType && (l.disabled !== !0 || "click" !== e.type)) {
                    for (a = [], r = 0; s > r; r++)i = t[r], n = i.selector + " ", void 0 === a[n] && (a[n] = i.needsContext ? ae(n, this).index(l) >= 0 : ae.find(n, this, null, [l]).length), a[n] && a.push(i);
                    a.length && o.push({elem: l, handlers: a})
                }
                return s < t.length && o.push({elem: this, handlers: t.slice(s)}), o
            },
            fix: function (e) {
                if (e[ae.expando])return e;
                var t, n, i, a = e.type, r = e, o = this.fixHooks[a];
                for (o || (this.fixHooks[a] = o = $e.test(a) ? this.mouseHooks : Le.test(a) ? this.keyHooks : {}), i = o.props ? this.props.concat(o.props) : this.props, e = new ae.Event(r), t = i.length; t--;)n = i[t], e[n] = r[n];
                return e.target || (e.target = r.srcElement || he), 3 === e.target.nodeType && (e.target = e.target.parentNode), e.metaKey = !!e.metaKey, o.filter ? o.filter(e, r) : e
            },
            props: "altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
            fixHooks: {},
            keyHooks: {
                props: "char charCode key keyCode".split(" "), filter: function (e, t) {
                    return null == e.which && (e.which = null != t.charCode ? t.charCode : t.keyCode), e
                }
            },
            mouseHooks: {
                props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
                filter: function (e, t) {
                    var n, i, a, r = t.button, o = t.fromElement;
                    return null == e.pageX && null != t.clientX && (i = e.target.ownerDocument || he, a = i.documentElement, n = i.body, e.pageX = t.clientX + (a && a.scrollLeft || n && n.scrollLeft || 0) - (a && a.clientLeft || n && n.clientLeft || 0), e.pageY = t.clientY + (a && a.scrollTop || n && n.scrollTop || 0) - (a && a.clientTop || n && n.clientTop || 0)), !e.relatedTarget && o && (e.relatedTarget = o === e.target ? t.toElement : o), e.which || void 0 === r || (e.which = 1 & r ? 1 : 2 & r ? 3 : 4 & r ? 2 : 0), e
                }
            },
            special: {
                load: {noBubble: !0}, focus: {
                    trigger: function () {
                        if (this !== h() && this.focus)try {
                            return this.focus(), !1
                        } catch (e) {
                        }
                    }, delegateType: "focusin"
                }, blur: {
                    trigger: function () {
                        return this === h() && this.blur ? (this.blur(), !1) : void 0
                    }, delegateType: "focusout"
                }, click: {
                    trigger: function () {
                        return ae.nodeName(this, "input") && "checkbox" === this.type && this.click ? (this.click(), !1) : void 0
                    }, _default: function (e) {
                        return ae.nodeName(e.target, "a")
                    }
                }, beforeunload: {
                    postDispatch: function (e) {
                        void 0 !== e.result && e.originalEvent && (e.originalEvent.returnValue = e.result)
                    }
                }
            },
            simulate: function (e, t, n, i) {
                var a = ae.extend(new ae.Event, n, {type: e, isSimulated: !0, originalEvent: {}});
                i ? ae.event.trigger(a, null, t) : ae.event.dispatch.call(t, a), a.isDefaultPrevented() && n.preventDefault()
            }
        }, ae.removeEvent = he.removeEventListener ? function (e, t, n) {
                e.removeEventListener && e.removeEventListener(t, n, !1)
            } : function (e, t, n) {
                var i = "on" + t;
                e.detachEvent && (typeof e[i] === Ce && (e[i] = null), e.detachEvent(i, n))
            }, ae.Event = function (e, t) {
            return this instanceof ae.Event ? (e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented = e.defaultPrevented || void 0 === e.defaultPrevented && e.returnValue === !1 ? c : f) : this.type = e, t && ae.extend(this, t), this.timeStamp = e && e.timeStamp || ae.now(), void(this[ae.expando] = !0)) : new ae.Event(e, t)
        }, ae.Event.prototype = {
            isDefaultPrevented: f,
            isPropagationStopped: f,
            isImmediatePropagationStopped: f,
            preventDefault: function () {
                var e = this.originalEvent;
                this.isDefaultPrevented = c, e && (e.preventDefault ? e.preventDefault() : e.returnValue = !1)
            },
            stopPropagation: function () {
                var e = this.originalEvent;
                this.isPropagationStopped = c, e && (e.stopPropagation && e.stopPropagation(), e.cancelBubble = !0)
            },
            stopImmediatePropagation: function () {
                var e = this.originalEvent;
                this.isImmediatePropagationStopped = c, e && e.stopImmediatePropagation && e.stopImmediatePropagation(), this.stopPropagation()
            }
        }, ae.each({
            mouseenter: "mouseover",
            mouseleave: "mouseout",
            pointerenter: "pointerover",
            pointerleave: "pointerout"
        }, function (e, t) {
            ae.event.special[e] = {
                delegateType: t, bindType: t, handle: function (e) {
                    var n, i = this, a = e.relatedTarget, r = e.handleObj;
                    return (!a || a !== i && !ae.contains(i, a)) && (e.type = r.origType, n = r.handler.apply(this, arguments), e.type = t), n
                }
            }
        }), ne.submitBubbles || (ae.event.special.submit = {
            setup: function () {
                return ae.nodeName(this, "form") ? !1 : void ae.event.add(this, "click._submit keypress._submit", function (e) {
                        var t = e.target, n = ae.nodeName(t, "input") || ae.nodeName(t, "button") ? t.form : void 0;
                        n && !ae._data(n, "submitBubbles") && (ae.event.add(n, "submit._submit", function (e) {
                            e._submit_bubble = !0
                        }), ae._data(n, "submitBubbles", !0))
                    })
            }, postDispatch: function (e) {
                e._submit_bubble && (delete e._submit_bubble, this.parentNode && !e.isTrigger && ae.event.simulate("submit", this.parentNode, e, !0))
            }, teardown: function () {
                return ae.nodeName(this, "form") ? !1 : void ae.event.remove(this, "._submit")
            }
        }), ne.changeBubbles || (ae.event.special.change = {
            setup: function () {
                return Ie.test(this.nodeName) ? (("checkbox" === this.type || "radio" === this.type) && (ae.event.add(this, "propertychange._change", function (e) {
                        "checked" === e.originalEvent.propertyName && (this._just_changed = !0)
                    }), ae.event.add(this, "click._change", function (e) {
                        this._just_changed && !e.isTrigger && (this._just_changed = !1), ae.event.simulate("change", this, e, !0)
                    })), !1) : void ae.event.add(this, "beforeactivate._change", function (e) {
                        var t = e.target;
                        Ie.test(t.nodeName) && !ae._data(t, "changeBubbles") && (ae.event.add(t, "change._change", function (e) {
                            !this.parentNode || e.isSimulated || e.isTrigger || ae.event.simulate("change", this.parentNode, e, !0)
                        }), ae._data(t, "changeBubbles", !0))
                    })
            }, handle: function (e) {
                var t = e.target;
                return this !== t || e.isSimulated || e.isTrigger || "radio" !== t.type && "checkbox" !== t.type ? e.handleObj.handler.apply(this, arguments) : void 0
            }, teardown: function () {
                return ae.event.remove(this, "._change"), !Ie.test(this.nodeName)
            }
        }), ne.focusinBubbles || ae.each({focus: "focusin", blur: "focusout"}, function (e, t) {
            var n = function (e) {
                ae.event.simulate(t, e.target, ae.event.fix(e), !0)
            };
            ae.event.special[t] = {
                setup: function () {
                    var i = this.ownerDocument || this, a = ae._data(i, t);
                    a || i.addEventListener(e, n, !0), ae._data(i, t, (a || 0) + 1)
                }, teardown: function () {
                    var i = this.ownerDocument || this, a = ae._data(i, t) - 1;
                    a ? ae._data(i, t, a) : (i.removeEventListener(e, n, !0), ae._removeData(i, t))
                }
            }
        }), ae.fn.extend({
            on: function (e, t, n, i, a) {
                var r, o;
                if ("object" == typeof e) {
                    "string" != typeof t && (n = n || t, t = void 0);
                    for (r in e)this.on(r, t, n, e[r], a);
                    return this
                }
                if (null == n && null == i ? (i = t, n = t = void 0) : null == i && ("string" == typeof t ? (i = n, n = void 0) : (i = n, n = t, t = void 0)), i === !1) i = f; else if (!i)return this;
                return 1 === a && (o = i, i = function (e) {
                    return ae().off(e), o.apply(this, arguments)
                }, i.guid = o.guid || (o.guid = ae.guid++)), this.each(function () {
                    ae.event.add(this, e, i, n, t)
                })
            }, one: function (e, t, n, i) {
                return this.on(e, t, n, i, 1)
            }, off: function (e, t, n) {
                var i, a;
                if (e && e.preventDefault && e.handleObj)return i = e.handleObj, ae(e.delegateTarget).off(i.namespace ? i.origType + "." + i.namespace : i.origType, i.selector, i.handler), this;
                if ("object" == typeof e) {
                    for (a in e)this.off(a, t, e[a]);
                    return this
                }
                return (t === !1 || "function" == typeof t) && (n = t, t = void 0), n === !1 && (n = f), this.each(function () {
                    ae.event.remove(this, e, n, t)
                })
            }, trigger: function (e, t) {
                return this.each(function () {
                    ae.event.trigger(e, t, this)
                })
            }, triggerHandler: function (e, t) {
                var n = this[0];
                return n ? ae.event.trigger(e, t, n, !0) : void 0
            }
        });
        var He = "abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video", Be = / jQuery\d+="(?:null|\d+)"/g, Oe = new RegExp("<(?:" + He + ")[\\s/>]", "i"), je = /^\s+/, Re = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi, Fe = /<([\w:]+)/, We = /<tbody/i, _e = /<|&#?\w+;/, qe = /<(?:script|style|link)/i, Ge = /checked\s*(?:[^=]|=\s*.checked.)/i, Ve = /^$|\/(?:java|ecma)script/i, Xe = /^true\/(.*)/, Ue = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g, Ye = {
            option: [1, "<select multiple='multiple'>", "</select>"],
            legend: [1, "<fieldset>", "</fieldset>"],
            area: [1, "<map>", "</map>"],
            param: [1, "<object>", "</object>"],
            thead: [1, "<table>", "</table>"],
            tr: [2, "<table><tbody>", "</tbody></table>"],
            col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"],
            td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
            _default: ne.htmlSerialize ? [0, "", ""] : [1, "X<div>", "</div>"]
        }, Qe = m(he), Ke = Qe.appendChild(he.createElement("div"));
        Ye.optgroup = Ye.option, Ye.tbody = Ye.tfoot = Ye.colgroup = Ye.caption = Ye.thead, Ye.th = Ye.td, ae.extend({
            clone: function (e, t, n) {
                var i, a, r, o, s, l = ae.contains(e.ownerDocument, e);
                if (ne.html5Clone || ae.isXMLDoc(e) || !Oe.test("<" + e.nodeName + ">") ? r = e.cloneNode(!0) : (Ke.innerHTML = e.outerHTML, Ke.removeChild(r = Ke.firstChild)), !(ne.noCloneEvent && ne.noCloneChecked || 1 !== e.nodeType && 11 !== e.nodeType || ae.isXMLDoc(e)))for (i = g(r), s = g(e), o = 0; null != (a = s[o]); ++o)i[o] && C(a, i[o]);
                if (t)if (n)for (s = s || g(e), i = i || g(r), o = 0; null != (a = s[o]); o++)T(a, i[o]); else T(e, r);
                return i = g(r, "script"), i.length > 0 && x(i, !l && g(e, "script")), i = s = a = null, r
            }, buildFragment: function (e, t, n, i) {
                for (var a, r, o, s, l, d, u, p = e.length, c = m(t), f = [], h = 0; p > h; h++)if (r = e[h], r || 0 === r)if ("object" === ae.type(r)) ae.merge(f, r.nodeType ? [r] : r); else if (_e.test(r)) {
                    for (s = s || c.appendChild(t.createElement("div")), l = (Fe.exec(r) || ["", ""])[1].toLowerCase(), u = Ye[l] || Ye._default, s.innerHTML = u[1] + r.replace(Re, "<$1></$2>") + u[2], a = u[0]; a--;)s = s.lastChild;
                    if (!ne.leadingWhitespace && je.test(r) && f.push(t.createTextNode(je.exec(r)[0])), !ne.tbody)for (r = "table" !== l || We.test(r) ? "<table>" !== u[1] || We.test(r) ? 0 : s : s.firstChild, a = r && r.childNodes.length; a--;)ae.nodeName(d = r.childNodes[a], "tbody") && !d.childNodes.length && r.removeChild(d);
                    for (ae.merge(f, s.childNodes), s.textContent = ""; s.firstChild;)s.removeChild(s.firstChild);
                    s = c.lastChild
                } else f.push(t.createTextNode(r));
                for (s && c.removeChild(s), ne.appendChecked || ae.grep(g(f, "input"), v), h = 0; r = f[h++];)if ((!i || -1 === ae.inArray(r, i)) && (o = ae.contains(r.ownerDocument, r), s = g(c.appendChild(r), "script"), o && x(s), n))for (a = 0; r = s[a++];)Ve.test(r.type || "") && n.push(r);
                return s = null, c
            }, cleanData: function (e, t) {
                for (var n, i, a, r, o = 0, s = ae.expando, l = ae.cache, d = ne.deleteExpando, u = ae.event.special; null != (n = e[o]); o++)if ((t || ae.acceptData(n)) && (a = n[s], r = a && l[a])) {
                    if (r.events)for (i in r.events)u[i] ? ae.event.remove(n, i) : ae.removeEvent(n, i, r.handle);
                    l[a] && (delete l[a], d ? delete n[s] : typeof n.removeAttribute !== Ce ? n.removeAttribute(s) : n[s] = null, U.push(a))
                }
            }
        }), ae.fn.extend({
            text: function (e) {
                return Me(this, function (e) {
                    return void 0 === e ? ae.text(this) : this.empty().append((this[0] && this[0].ownerDocument || he).createTextNode(e))
                }, null, e, arguments.length)
            }, append: function () {
                return this.domManip(arguments, function (e) {
                    if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                        var t = y(this, e);
                        t.appendChild(e)
                    }
                })
            }, prepend: function () {
                return this.domManip(arguments, function (e) {
                    if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                        var t = y(this, e);
                        t.insertBefore(e, t.firstChild)
                    }
                })
            }, before: function () {
                return this.domManip(arguments, function (e) {
                    this.parentNode && this.parentNode.insertBefore(e, this)
                })
            }, after: function () {
                return this.domManip(arguments, function (e) {
                    this.parentNode && this.parentNode.insertBefore(e, this.nextSibling)
                })
            }, remove: function (e, t) {
                for (var n, i = e ? ae.filter(e, this) : this, a = 0; null != (n = i[a]); a++)t || 1 !== n.nodeType || ae.cleanData(g(n)), n.parentNode && (t && ae.contains(n.ownerDocument, n) && x(g(n, "script")), n.parentNode.removeChild(n));
                return this
            }, empty: function () {
                for (var e, t = 0; null != (e = this[t]); t++) {
                    for (1 === e.nodeType && ae.cleanData(g(e, !1)); e.firstChild;)e.removeChild(e.firstChild);
                    e.options && ae.nodeName(e, "select") && (e.options.length = 0)
                }
                return this
            }, clone: function (e, t) {
                return e = null == e ? !1 : e, t = null == t ? e : t, this.map(function () {
                    return ae.clone(this, e, t)
                })
            }, html: function (e) {
                return Me(this, function (e) {
                    var t = this[0] || {}, n = 0, i = this.length;
                    if (void 0 === e)return 1 === t.nodeType ? t.innerHTML.replace(Be, "") : void 0;
                    if (!("string" != typeof e || qe.test(e) || !ne.htmlSerialize && Oe.test(e) || !ne.leadingWhitespace && je.test(e) || Ye[(Fe.exec(e) || ["", ""])[1].toLowerCase()])) {
                        e = e.replace(Re, "<$1></$2>");
                        try {
                            for (; i > n; n++)t = this[n] || {}, 1 === t.nodeType && (ae.cleanData(g(t, !1)), t.innerHTML = e);
                            t = 0
                        } catch (a) {
                        }
                    }
                    t && this.empty().append(e)
                }, null, e, arguments.length)
            }, replaceWith: function () {
                var e = arguments[0];
                return this.domManip(arguments, function (t) {
                    e = this.parentNode, ae.cleanData(g(this)), e && e.replaceChild(t, this)
                }), e && (e.length || e.nodeType) ? this : this.remove()
            }, detach: function (e) {
                return this.remove(e, !0)
            }, domManip: function (e, t) {
                e = Q.apply([], e);
                var n, i, a, r, o, s, l = 0, d = this.length, u = this, p = d - 1, c = e[0], f = ae.isFunction(c);
                if (f || d > 1 && "string" == typeof c && !ne.checkClone && Ge.test(c))return this.each(function (n) {
                    var i = u.eq(n);
                    f && (e[0] = c.call(this, n, i.html())), i.domManip(e, t)
                });
                if (d && (s = ae.buildFragment(e, this[0].ownerDocument, !1, this), n = s.firstChild, 1 === s.childNodes.length && (s = n), n)) {
                    for (r = ae.map(g(s, "script"), w), a = r.length; d > l; l++)i = s, l !== p && (i = ae.clone(i, !0, !0), a && ae.merge(r, g(i, "script"))), t.call(this[l], i, l);
                    if (a)for (o = r[r.length - 1].ownerDocument, ae.map(r, b), l = 0; a > l; l++)i = r[l], Ve.test(i.type || "") && !ae._data(i, "globalEval") && ae.contains(o, i) && (i.src ? ae._evalUrl && ae._evalUrl(i.src) : ae.globalEval((i.text || i.textContent || i.innerHTML || "").replace(Ue, "")));
                    s = n = null
                }
                return this
            }
        }), ae.each({
            appendTo: "append",
            prependTo: "prepend",
            insertBefore: "before",
            insertAfter: "after",
            replaceAll: "replaceWith"
        }, function (e, t) {
            ae.fn[e] = function (e) {
                for (var n, i = 0, a = [], r = ae(e), o = r.length - 1; o >= i; i++)n = i === o ? this : this.clone(!0), ae(r[i])[t](n), K.apply(a, n.get());
                return this.pushStack(a)
            }
        });
        var Je, Ze = {};
        !function () {
            var e;
            ne.shrinkWrapBlocks = function () {
                if (null != e)return e;
                e = !1;
                var t, n, i;
                return n = he.getElementsByTagName("body")[0], n && n.style ? (t = he.createElement("div"), i = he.createElement("div"), i.style.cssText = "position:absolute;border:0;width:0;height:0;top:0;left:-9999px", n.appendChild(i).appendChild(t), typeof t.style.zoom !== Ce && (t.style.cssText = "-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:1px;width:1px;zoom:1", t.appendChild(he.createElement("div")).style.width = "5px", e = 3 !== t.offsetWidth), n.removeChild(i), e) : void 0
            }
        }();
        var et, tt, nt = /^margin/, it = new RegExp("^(" + ke + ")(?!px)[a-z%]+$", "i"), at = /^(top|right|bottom|left)$/;
        e.getComputedStyle ? (et = function (t) {
                return t.ownerDocument.defaultView.opener ? t.ownerDocument.defaultView.getComputedStyle(t, null) : e.getComputedStyle(t, null)
            }, tt = function (e, t, n) {
                var i, a, r, o, s = e.style;
                return n = n || et(e), o = n ? n.getPropertyValue(t) || n[t] : void 0, n && ("" !== o || ae.contains(e.ownerDocument, e) || (o = ae.style(e, t)), it.test(o) && nt.test(t) && (i = s.width, a = s.minWidth, r = s.maxWidth, s.minWidth = s.maxWidth = s.width = o, o = n.width, s.width = i, s.minWidth = a, s.maxWidth = r)), void 0 === o ? o : o + ""
            }) : he.documentElement.currentStyle && (et = function (e) {
                return e.currentStyle
            }, tt = function (e, t, n) {
                var i, a, r, o, s = e.style;
                return n = n || et(e), o = n ? n[t] : void 0, null == o && s && s[t] && (o = s[t]), it.test(o) && !at.test(t) && (i = s.left, a = e.runtimeStyle, r = a && a.left, r && (a.left = e.currentStyle.left), s.left = "fontSize" === t ? "1em" : o, o = s.pixelLeft + "px", s.left = i, r && (a.left = r)), void 0 === o ? o : o + "" || "auto"
            }), !function () {
            function t() {
                var t, n, i, a;
                n = he.getElementsByTagName("body")[0], n && n.style && (t = he.createElement("div"), i = he.createElement("div"), i.style.cssText = "position:absolute;border:0;width:0;height:0;top:0;left:-9999px", n.appendChild(i).appendChild(t), t.style.cssText = "-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;display:block;margin-top:1%;top:1%;border:1px;padding:1px;width:4px;position:absolute", r = o = !1, l = !0, e.getComputedStyle && (r = "1%" !== (e.getComputedStyle(t, null) || {}).top, o = "4px" === (e.getComputedStyle(t, null) || {width: "4px"}).width, a = t.appendChild(he.createElement("div")), a.style.cssText = t.style.cssText = "-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:0", a.style.marginRight = a.style.width = "0", t.style.width = "1px", l = !parseFloat((e.getComputedStyle(a, null) || {}).marginRight), t.removeChild(a)), t.innerHTML = "<table><tr><td></td><td>t</td></tr></table>", a = t.getElementsByTagName("td"), a[0].style.cssText = "margin:0;border:0;padding:0;display:none", s = 0 === a[0].offsetHeight, s && (a[0].style.display = "", a[1].style.display = "none", s = 0 === a[0].offsetHeight), n.removeChild(i))
            }

            var n, i, a, r, o, s, l;
            n = he.createElement("div"), n.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", a = n.getElementsByTagName("a")[0], (i = a && a.style) && (i.cssText = "float:left;opacity:.5", ne.opacity = "0.5" === i.opacity, ne.cssFloat = !!i.cssFloat, n.style.backgroundClip = "content-box", n.cloneNode(!0).style.backgroundClip = "", ne.clearCloneStyle = "content-box" === n.style.backgroundClip, ne.boxSizing = "" === i.boxSizing || "" === i.MozBoxSizing || "" === i.WebkitBoxSizing, ae.extend(ne, {
                reliableHiddenOffsets: function () {
                    return null == s && t(), s
                }, boxSizingReliable: function () {
                    return null == o && t(), o
                }, pixelPosition: function () {
                    return null == r && t(), r
                }, reliableMarginRight: function () {
                    return null == l && t(), l
                }
            }))
        }(), ae.swap = function (e, t, n, i) {
            var a, r, o = {};
            for (r in t)o[r] = e.style[r], e.style[r] = t[r];
            a = n.apply(e, i || []);
            for (r in t)e.style[r] = o[r];
            return a
        };
        var rt = /alpha\([^)]*\)/i, ot = /opacity\s*=\s*([^)]*)/, st = /^(none|table(?!-c[ea]).+)/, lt = new RegExp("^(" + ke + ")(.*)$", "i"), dt = new RegExp("^([+-])=(" + ke + ")", "i"), ut = {
            position: "absolute",
            visibility: "hidden",
            display: "block"
        }, pt = {letterSpacing: "0", fontWeight: "400"}, ct = ["Webkit", "O", "Moz", "ms"];
        ae.extend({
            cssHooks: {
                opacity: {
                    get: function (e, t) {
                        if (t) {
                            var n = tt(e, "opacity");
                            return "" === n ? "1" : n
                        }
                    }
                }
            },
            cssNumber: {
                columnCount: !0,
                fillOpacity: !0,
                flexGrow: !0,
                flexShrink: !0,
                fontWeight: !0,
                lineHeight: !0,
                opacity: !0,
                order: !0,
                orphans: !0,
                widows: !0,
                zIndex: !0,
                zoom: !0
            },
            cssProps: {"float": ne.cssFloat ? "cssFloat" : "styleFloat"},
            style: function (e, t, n, i) {
                if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) {
                    var a, r, o, s = ae.camelCase(t), l = e.style;
                    if (t = ae.cssProps[s] || (ae.cssProps[s] = N(l, s)), o = ae.cssHooks[t] || ae.cssHooks[s], void 0 === n)return o && "get" in o && void 0 !== (a = o.get(e, !1, i)) ? a : l[t];
                    if (r = typeof n, "string" === r && (a = dt.exec(n)) && (n = (a[1] + 1) * a[2] + parseFloat(ae.css(e, t)), r = "number"), null != n && n === n && ("number" !== r || ae.cssNumber[s] || (n += "px"), ne.clearCloneStyle || "" !== n || 0 !== t.indexOf("background") || (l[t] = "inherit"), !(o && "set" in o && void 0 === (n = o.set(e, n, i)))))try {
                        l[t] = n
                    } catch (d) {
                    }
                }
            },
            css: function (e, t, n, i) {
                var a, r, o, s = ae.camelCase(t);
                return t = ae.cssProps[s] || (ae.cssProps[s] = N(e.style, s)), o = ae.cssHooks[t] || ae.cssHooks[s], o && "get" in o && (r = o.get(e, !0, n)), void 0 === r && (r = tt(e, t, i)), "normal" === r && t in pt && (r = pt[t]), "" === n || n ? (a = parseFloat(r), n === !0 || ae.isNumeric(a) ? a || 0 : r) : r
            }
        }), ae.each(["height", "width"], function (e, t) {
            ae.cssHooks[t] = {
                get: function (e, n, i) {
                    return n ? st.test(ae.css(e, "display")) && 0 === e.offsetWidth ? ae.swap(e, ut, function () {
                                return I(e, t, i)
                            }) : I(e, t, i) : void 0
                }, set: function (e, n, i) {
                    var a = i && et(e);
                    return M(e, n, i ? A(e, t, i, ne.boxSizing && "border-box" === ae.css(e, "boxSizing", !1, a), a) : 0)
                }
            }
        }), ne.opacity || (ae.cssHooks.opacity = {
            get: function (e, t) {
                return ot.test((t && e.currentStyle ? e.currentStyle.filter : e.style.filter) || "") ? .01 * parseFloat(RegExp.$1) + "" : t ? "1" : ""
            }, set: function (e, t) {
                var n = e.style, i = e.currentStyle, a = ae.isNumeric(t) ? "alpha(opacity=" + 100 * t + ")" : "", r = i && i.filter || n.filter || "";
                n.zoom = 1, (t >= 1 || "" === t) && "" === ae.trim(r.replace(rt, "")) && n.removeAttribute && (n.removeAttribute("filter"), "" === t || i && !i.filter) || (n.filter = rt.test(r) ? r.replace(rt, a) : r + " " + a)
            }
        }), ae.cssHooks.marginRight = k(ne.reliableMarginRight, function (e, t) {
            return t ? ae.swap(e, {display: "inline-block"}, tt, [e, "marginRight"]) : void 0
        }), ae.each({margin: "", padding: "", border: "Width"}, function (e, t) {
            ae.cssHooks[e + t] = {
                expand: function (n) {
                    for (var i = 0, a = {}, r = "string" == typeof n ? n.split(" ") : [n]; 4 > i; i++)a[e + Ne[i] + t] = r[i] || r[i - 2] || r[0];
                    return a
                }
            }, nt.test(e) || (ae.cssHooks[e + t].set = M)
        }), ae.fn.extend({
            css: function (e, t) {
                return Me(this, function (e, t, n) {
                    var i, a, r = {}, o = 0;
                    if (ae.isArray(t)) {
                        for (i = et(e), a = t.length; a > o; o++)r[t[o]] = ae.css(e, t[o], !1, i);
                        return r
                    }
                    return void 0 !== n ? ae.style(e, t, n) : ae.css(e, t)
                }, e, t, arguments.length > 1)
            }, show: function () {
                return D(this, !0)
            }, hide: function () {
                return D(this)
            }, toggle: function (e) {
                return "boolean" == typeof e ? e ? this.show() : this.hide() : this.each(function () {
                        De(this) ? ae(this).show() : ae(this).hide()
                    })
            }
        }), ae.Tween = L, L.prototype = {
            constructor: L, init: function (e, t, n, i, a, r) {
                this.elem = e, this.prop = n, this.easing = a || "swing", this.options = t, this.start = this.now = this.cur(), this.end = i, this.unit = r || (ae.cssNumber[n] ? "" : "px")
            }, cur: function () {
                var e = L.propHooks[this.prop];
                return e && e.get ? e.get(this) : L.propHooks._default.get(this)
            }, run: function (e) {
                var t, n = L.propHooks[this.prop];
                return this.pos = t = this.options.duration ? ae.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration) : e, this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : L.propHooks._default.set(this), this
            }
        }, L.prototype.init.prototype = L.prototype, L.propHooks = {
            _default: {
                get: function (e) {
                    var t;
                    return null == e.elem[e.prop] || e.elem.style && null != e.elem.style[e.prop] ? (t = ae.css(e.elem, e.prop, ""), t && "auto" !== t ? t : 0) : e.elem[e.prop]
                }, set: function (e) {
                    ae.fx.step[e.prop] ? ae.fx.step[e.prop](e) : e.elem.style && (null != e.elem.style[ae.cssProps[e.prop]] || ae.cssHooks[e.prop]) ? ae.style(e.elem, e.prop, e.now + e.unit) : e.elem[e.prop] = e.now
                }
            }
        }, L.propHooks.scrollTop = L.propHooks.scrollLeft = {
            set: function (e) {
                e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now)
            }
        }, ae.easing = {
            linear: function (e) {
                return e
            }, swing: function (e) {
                return .5 - Math.cos(e * Math.PI) / 2
            }
        }, ae.fx = L.prototype.init, ae.fx.step = {};
        var ft, ht, mt = /^(?:toggle|show|hide)$/, gt = new RegExp("^(?:([+-])=|)(" + ke + ")([a-z%]*)$", "i"), vt = /queueHooks$/, yt = [H], wt = {
            "*": [function (e, t) {
                var n = this.createTween(e, t), i = n.cur(), a = gt.exec(t), r = a && a[3] || (ae.cssNumber[e] ? "" : "px"), o = (ae.cssNumber[e] || "px" !== r && +i) && gt.exec(ae.css(n.elem, e)), s = 1, l = 20;
                if (o && o[3] !== r) {
                    r = r || o[3], a = a || [], o = +i || 1;
                    do s = s || ".5", o /= s, ae.style(n.elem, e, o + r); while (s !== (s = n.cur() / i) && 1 !== s && --l)
                }
                return a && (o = n.start = +o || +i || 0, n.unit = r, n.end = a[1] ? o + (a[1] + 1) * a[2] : +a[2]), n
            }]
        };
        ae.Animation = ae.extend(O, {
            tweener: function (e, t) {
                ae.isFunction(e) ? (t = e, e = ["*"]) : e = e.split(" ");
                for (var n, i = 0, a = e.length; a > i; i++)n = e[i], wt[n] = wt[n] || [], wt[n].unshift(t)
            }, prefilter: function (e, t) {
                t ? yt.unshift(e) : yt.push(e)
            }
        }), ae.speed = function (e, t, n) {
            var i = e && "object" == typeof e ? ae.extend({}, e) : {
                    complete: n || !n && t || ae.isFunction(e) && e,
                    duration: e,
                    easing: n && t || t && !ae.isFunction(t) && t
                };
            return i.duration = ae.fx.off ? 0 : "number" == typeof i.duration ? i.duration : i.duration in ae.fx.speeds ? ae.fx.speeds[i.duration] : ae.fx.speeds._default, (null == i.queue || i.queue === !0) && (i.queue = "fx"), i.old = i.complete, i.complete = function () {
                ae.isFunction(i.old) && i.old.call(this), i.queue && ae.dequeue(this, i.queue)
            }, i
        }, ae.fn.extend({
            fadeTo: function (e, t, n, i) {
                return this.filter(De).css("opacity", 0).show().end().animate({opacity: t}, e, n, i)
            }, animate: function (e, t, n, i) {
                var a = ae.isEmptyObject(e), r = ae.speed(t, n, i), o = function () {
                    var t = O(this, ae.extend({}, e), r);
                    (a || ae._data(this, "finish")) && t.stop(!0)
                };
                return o.finish = o, a || r.queue === !1 ? this.each(o) : this.queue(r.queue, o)
            }, stop: function (e, t, n) {
                var i = function (e) {
                    var t = e.stop;
                    delete e.stop, t(n)
                };
                return "string" != typeof e && (n = t, t = e, e = void 0), t && e !== !1 && this.queue(e || "fx", []), this.each(function () {
                    var t = !0, a = null != e && e + "queueHooks", r = ae.timers, o = ae._data(this);
                    if (a) o[a] && o[a].stop && i(o[a]); else for (a in o)o[a] && o[a].stop && vt.test(a) && i(o[a]);
                    for (a = r.length; a--;)r[a].elem !== this || null != e && r[a].queue !== e || (r[a].anim.stop(n), t = !1, r.splice(a, 1));
                    (t || !n) && ae.dequeue(this, e)
                })
            }, finish: function (e) {
                return e !== !1 && (e = e || "fx"), this.each(function () {
                    var t, n = ae._data(this), i = n[e + "queue"], a = n[e + "queueHooks"], r = ae.timers, o = i ? i.length : 0;
                    for (n.finish = !0, ae.queue(this, e, []), a && a.stop && a.stop.call(this, !0), t = r.length; t--;)r[t].elem === this && r[t].queue === e && (r[t].anim.stop(!0), r.splice(t, 1));
                    for (t = 0; o > t; t++)i[t] && i[t].finish && i[t].finish.call(this);
                    delete n.finish
                })
            }
        }), ae.each(["toggle", "show", "hide"], function (e, t) {
            var n = ae.fn[t];
            ae.fn[t] = function (e, i, a) {
                return null == e || "boolean" == typeof e ? n.apply(this, arguments) : this.animate(P(t, !0), e, i, a)
            }
        }), ae.each({
            slideDown: P("show"),
            slideUp: P("hide"),
            slideToggle: P("toggle"),
            fadeIn: {opacity: "show"},
            fadeOut: {opacity: "hide"},
            fadeToggle: {opacity: "toggle"}
        }, function (e, t) {
            ae.fn[e] = function (e, n, i) {
                return this.animate(t, e, n, i)
            }
        }), ae.timers = [], ae.fx.tick = function () {
            var e, t = ae.timers, n = 0;
            for (ft = ae.now(); n < t.length; n++)e = t[n], e() || t[n] !== e || t.splice(n--, 1);
            t.length || ae.fx.stop(), ft = void 0
        }, ae.fx.timer = function (e) {
            ae.timers.push(e), e() ? ae.fx.start() : ae.timers.pop()
        }, ae.fx.interval = 13, ae.fx.start = function () {
            ht || (ht = setInterval(ae.fx.tick, ae.fx.interval))
        }, ae.fx.stop = function () {
            clearInterval(ht), ht = null
        }, ae.fx.speeds = {slow: 600, fast: 200, _default: 400}, ae.fn.delay = function (e, t) {
            return e = ae.fx ? ae.fx.speeds[e] || e : e, t = t || "fx", this.queue(t, function (t, n) {
                var i = setTimeout(t, e);
                n.stop = function () {
                    clearTimeout(i)
                }
            })
        }, function () {
            var e, t, n, i, a;
            t = he.createElement("div"), t.setAttribute("className", "t"), t.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", i = t.getElementsByTagName("a")[0], n = he.createElement("select"), a = n.appendChild(he.createElement("option")), e = t.getElementsByTagName("input")[0], i.style.cssText = "top:1px", ne.getSetAttribute = "t" !== t.className, ne.style = /top/.test(i.getAttribute("style")), ne.hrefNormalized = "/a" === i.getAttribute("href"), ne.checkOn = !!e.value, ne.optSelected = a.selected, ne.enctype = !!he.createElement("form").enctype, n.disabled = !0, ne.optDisabled = !a.disabled, e = he.createElement("input"), e.setAttribute("value", ""), ne.input = "" === e.getAttribute("value"), e.value = "t", e.setAttribute("type", "radio"), ne.radioValue = "t" === e.value
        }();
        var bt = /\r/g;
        ae.fn.extend({
            val: function (e) {
                var t, n, i, a = this[0];
                return arguments.length ? (i = ae.isFunction(e), this.each(function (n) {
                        var a;
                        1 === this.nodeType && (a = i ? e.call(this, n, ae(this).val()) : e, null == a ? a = "" : "number" == typeof a ? a += "" : ae.isArray(a) && (a = ae.map(a, function (e) {
                                    return null == e ? "" : e + ""
                                })), t = ae.valHooks[this.type] || ae.valHooks[this.nodeName.toLowerCase()], t && "set" in t && void 0 !== t.set(this, a, "value") || (this.value = a))
                    })) : a ? (t = ae.valHooks[a.type] || ae.valHooks[a.nodeName.toLowerCase()], t && "get" in t && void 0 !== (n = t.get(a, "value")) ? n : (n = a.value, "string" == typeof n ? n.replace(bt, "") : null == n ? "" : n)) : void 0
            }
        }), ae.extend({
            valHooks: {
                option: {
                    get: function (e) {
                        var t = ae.find.attr(e, "value");
                        return null != t ? t : ae.trim(ae.text(e))
                    }
                }, select: {
                    get: function (e) {
                        for (var t, n, i = e.options, a = e.selectedIndex, r = "select-one" === e.type || 0 > a, o = r ? null : [], s = r ? a + 1 : i.length, l = 0 > a ? s : r ? a : 0; s > l; l++)if (n = i[l], !(!n.selected && l !== a || (ne.optDisabled ? n.disabled : null !== n.getAttribute("disabled")) || n.parentNode.disabled && ae.nodeName(n.parentNode, "optgroup"))) {
                            if (t = ae(n).val(), r)return t;
                            o.push(t)
                        }
                        return o
                    }, set: function (e, t) {
                        for (var n, i, a = e.options, r = ae.makeArray(t), o = a.length; o--;)if (i = a[o], ae.inArray(ae.valHooks.option.get(i), r) >= 0)try {
                            i.selected = n = !0
                        } catch (s) {
                            i.scrollHeight
                        } else i.selected = !1;
                        return n || (e.selectedIndex = -1), a
                    }
                }
            }
        }), ae.each(["radio", "checkbox"], function () {
            ae.valHooks[this] = {
                set: function (e, t) {
                    return ae.isArray(t) ? e.checked = ae.inArray(ae(e).val(), t) >= 0 : void 0
                }
            }, ne.checkOn || (ae.valHooks[this].get = function (e) {
                return null === e.getAttribute("value") ? "on" : e.value
            })
        });
        var xt, Tt, Ct = ae.expr.attrHandle, St = /^(?:checked|selected)$/i, Et = ne.getSetAttribute, kt = ne.input;
        ae.fn.extend({
            attr: function (e, t) {
                return Me(this, ae.attr, e, t, arguments.length > 1)
            }, removeAttr: function (e) {
                return this.each(function () {
                    ae.removeAttr(this, e)
                })
            }
        }), ae.extend({
            attr: function (e, t, n) {
                var i, a, r = e.nodeType;
                return e && 3 !== r && 8 !== r && 2 !== r ? typeof e.getAttribute === Ce ? ae.prop(e, t, n) : (1 === r && ae.isXMLDoc(e) || (t = t.toLowerCase(), i = ae.attrHooks[t] || (ae.expr.match.bool.test(t) ? Tt : xt)), void 0 === n ? i && "get" in i && null !== (a = i.get(e, t)) ? a : (a = ae.find.attr(e, t), null == a ? void 0 : a) : null !== n ? i && "set" in i && void 0 !== (a = i.set(e, n, t)) ? a : (e.setAttribute(t, n + ""), n) : void ae.removeAttr(e, t)) : void 0
            }, removeAttr: function (e, t) {
                var n, i, a = 0, r = t && t.match(we);
                if (r && 1 === e.nodeType)for (; n = r[a++];)i = ae.propFix[n] || n, ae.expr.match.bool.test(n) ? kt && Et || !St.test(n) ? e[i] = !1 : e[ae.camelCase("default-" + n)] = e[i] = !1 : ae.attr(e, n, ""), e.removeAttribute(Et ? n : i)
            }, attrHooks: {
                type: {
                    set: function (e, t) {
                        if (!ne.radioValue && "radio" === t && ae.nodeName(e, "input")) {
                            var n = e.value;
                            return e.setAttribute("type", t), n && (e.value = n), t
                        }
                    }
                }
            }
        }), Tt = {
            set: function (e, t, n) {
                return t === !1 ? ae.removeAttr(e, n) : kt && Et || !St.test(n) ? e.setAttribute(!Et && ae.propFix[n] || n, n) : e[ae.camelCase("default-" + n)] = e[n] = !0, n
            }
        }, ae.each(ae.expr.match.bool.source.match(/\w+/g), function (e, t) {
            var n = Ct[t] || ae.find.attr;
            Ct[t] = kt && Et || !St.test(t) ? function (e, t, i) {
                    var a, r;
                    return i || (r = Ct[t], Ct[t] = a, a = null != n(e, t, i) ? t.toLowerCase() : null, Ct[t] = r), a
                } : function (e, t, n) {
                    return n ? void 0 : e[ae.camelCase("default-" + t)] ? t.toLowerCase() : null
                }
        }), kt && Et || (ae.attrHooks.value = {
            set: function (e, t, n) {
                return ae.nodeName(e, "input") ? void(e.defaultValue = t) : xt && xt.set(e, t, n)
            }
        }), Et || (xt = {
            set: function (e, t, n) {
                var i = e.getAttributeNode(n);
                return i || e.setAttributeNode(i = e.ownerDocument.createAttribute(n)), i.value = t += "", "value" === n || t === e.getAttribute(n) ? t : void 0
            }
        }, Ct.id = Ct.name = Ct.coords = function (e, t, n) {
            var i;
            return n ? void 0 : (i = e.getAttributeNode(t)) && "" !== i.value ? i.value : null
        }, ae.valHooks.button = {
            get: function (e, t) {
                var n = e.getAttributeNode(t);
                return n && n.specified ? n.value : void 0
            }, set: xt.set
        }, ae.attrHooks.contenteditable = {
            set: function (e, t, n) {
                xt.set(e, "" === t ? !1 : t, n)
            }
        }, ae.each(["width", "height"], function (e, t) {
            ae.attrHooks[t] = {
                set: function (e, n) {
                    return "" === n ? (e.setAttribute(t, "auto"), n) : void 0
                }
            }
        })), ne.style || (ae.attrHooks.style = {
            get: function (e) {
                return e.style.cssText || void 0
            }, set: function (e, t) {
                return e.style.cssText = t + ""
            }
        });
        var Nt = /^(?:input|select|textarea|button|object)$/i, Dt = /^(?:a|area)$/i;
        ae.fn.extend({
            prop: function (e, t) {
                return Me(this, ae.prop, e, t, arguments.length > 1)
            }, removeProp: function (e) {
                return e = ae.propFix[e] || e, this.each(function () {
                    try {
                        this[e] = void 0, delete this[e]
                    } catch (t) {
                    }
                })
            }
        }), ae.extend({
            propFix: {"for": "htmlFor", "class": "className"}, prop: function (e, t, n) {
                var i, a, r, o = e.nodeType;
                return e && 3 !== o && 8 !== o && 2 !== o ? (r = 1 !== o || !ae.isXMLDoc(e), r && (t = ae.propFix[t] || t, a = ae.propHooks[t]), void 0 !== n ? a && "set" in a && void 0 !== (i = a.set(e, n, t)) ? i : e[t] = n : a && "get" in a && null !== (i = a.get(e, t)) ? i : e[t]) : void 0
            }, propHooks: {
                tabIndex: {
                    get: function (e) {
                        var t = ae.find.attr(e, "tabindex");
                        return t ? parseInt(t, 10) : Nt.test(e.nodeName) || Dt.test(e.nodeName) && e.href ? 0 : -1
                    }
                }
            }
        }), ne.hrefNormalized || ae.each(["href", "src"], function (e, t) {
            ae.propHooks[t] = {
                get: function (e) {
                    return e.getAttribute(t, 4)
                }
            }
        }), ne.optSelected || (ae.propHooks.selected = {
            get: function (e) {
                var t = e.parentNode;
                return t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex), null
            }
        }), ae.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function () {
            ae.propFix[this.toLowerCase()] = this
        }), ne.enctype || (ae.propFix.enctype = "encoding");
        var Mt = /[\t\r\n\f]/g;
        ae.fn.extend({
            addClass: function (e) {
                var t, n, i, a, r, o, s = 0, l = this.length, d = "string" == typeof e && e;
                if (ae.isFunction(e))return this.each(function (t) {
                    ae(this).addClass(e.call(this, t, this.className))
                });
                if (d)for (t = (e || "").match(we) || []; l > s; s++)if (n = this[s], i = 1 === n.nodeType && (n.className ? (" " + n.className + " ").replace(Mt, " ") : " ")) {
                    for (r = 0; a = t[r++];)i.indexOf(" " + a + " ") < 0 && (i += a + " ");
                    o = ae.trim(i), n.className !== o && (n.className = o)
                }
                return this
            }, removeClass: function (e) {
                var t, n, i, a, r, o, s = 0, l = this.length, d = 0 === arguments.length || "string" == typeof e && e;
                if (ae.isFunction(e))return this.each(function (t) {
                    ae(this).removeClass(e.call(this, t, this.className))
                });
                if (d)for (t = (e || "").match(we) || []; l > s; s++)if (n = this[s], i = 1 === n.nodeType && (n.className ? (" " + n.className + " ").replace(Mt, " ") : "")) {
                    for (r = 0; a = t[r++];)for (; i.indexOf(" " + a + " ") >= 0;)i = i.replace(" " + a + " ", " ");
                    o = e ? ae.trim(i) : "", n.className !== o && (n.className = o)
                }
                return this
            }, toggleClass: function (e, t) {
                var n = typeof e;
                return "boolean" == typeof t && "string" === n ? t ? this.addClass(e) : this.removeClass(e) : this.each(ae.isFunction(e) ? function (n) {
                            ae(this).toggleClass(e.call(this, n, this.className, t), t)
                        } : function () {
                            if ("string" === n)for (var t, i = 0, a = ae(this), r = e.match(we) || []; t = r[i++];)a.hasClass(t) ? a.removeClass(t) : a.addClass(t); else(n === Ce || "boolean" === n) && (this.className && ae._data(this, "__className__", this.className), this.className = this.className || e === !1 ? "" : ae._data(this, "__className__") || "")
                        })
            }, hasClass: function (e) {
                for (var t = " " + e + " ", n = 0, i = this.length; i > n; n++)if (1 === this[n].nodeType && (" " + this[n].className + " ").replace(Mt, " ").indexOf(t) >= 0)return !0;
                return !1
            }
        }), ae.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function (e, t) {
            ae.fn[t] = function (e, n) {
                return arguments.length > 0 ? this.on(t, null, e, n) : this.trigger(t)
            }
        }), ae.fn.extend({
            hover: function (e, t) {
                return this.mouseenter(e).mouseleave(t || e)
            }, bind: function (e, t, n) {
                return this.on(e, null, t, n)
            }, unbind: function (e, t) {
                return this.off(e, null, t)
            }, delegate: function (e, t, n, i) {
                return this.on(t, e, n, i)
            }, undelegate: function (e, t, n) {
                return 1 === arguments.length ? this.off(e, "**") : this.off(t, e || "**", n)
            }
        });
        var At = ae.now(), It = /\?/, Lt = /(,)|(\[|{)|(}|])|"(?:[^"\\\r\n]|\\["\\\/bfnrt]|\\u[\da-fA-F]{4})*"\s*:?|true|false|null|-?(?!0\d)\d+(?:\.\d+|)(?:[eE][+-]?\d+|)/g;
        ae.parseJSON = function (t) {
            if (e.JSON && e.JSON.parse)return e.JSON.parse(t + "");
            var n, i = null, a = ae.trim(t + "");
            return a && !ae.trim(a.replace(Lt, function (e, t, a, r) {
                return n && t && (i = 0), 0 === i ? e : (n = a || t, i += !r - !a, "")
            })) ? Function("return " + a)() : ae.error("Invalid JSON: " + t)
        }, ae.parseXML = function (t) {
            var n, i;
            if (!t || "string" != typeof t)return null;
            try {
                e.DOMParser ? (i = new DOMParser, n = i.parseFromString(t, "text/xml")) : (n = new ActiveXObject("Microsoft.XMLDOM"), n.async = "false", n.loadXML(t))
            } catch (a) {
                n = void 0
            }
            return n && n.documentElement && !n.getElementsByTagName("parsererror").length || ae.error("Invalid XML: " + t), n
        };
        var $t, Pt, zt = /#.*$/, Ht = /([?&])_=[^&]*/, Bt = /^(.*?):[ \t]*([^\r\n]*)\r?$/gm, Ot = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/, jt = /^(?:GET|HEAD)$/, Rt = /^\/\//, Ft = /^([\w.+-]+:)(?:\/\/(?:[^\/?#]*@|)([^\/?#:]*)(?::(\d+)|)|)/, Wt = {}, _t = {}, qt = "*/".concat("*");
        try {
            Pt = location.href
        } catch (Gt) {
            Pt = he.createElement("a"), Pt.href = "", Pt = Pt.href
        }
        $t = Ft.exec(Pt.toLowerCase()) || [], ae.extend({
            active: 0,
            lastModified: {},
            etag: {},
            ajaxSettings: {
                url: Pt,
                type: "GET",
                isLocal: Ot.test($t[1]),
                global: !0,
                processData: !0,
                async: !0,
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                accepts: {
                    "*": qt,
                    text: "text/plain",
                    html: "text/html",
                    xml: "application/xml, text/xml",
                    json: "application/json, text/javascript"
                },
                contents: {xml: /xml/, html: /html/, json: /json/},
                responseFields: {xml: "responseXML", text: "responseText", json: "responseJSON"},
                converters: {"* text": String, "text html": !0, "text json": ae.parseJSON, "text xml": ae.parseXML},
                flatOptions: {url: !0, context: !0}
            },
            ajaxSetup: function (e, t) {
                return t ? F(F(e, ae.ajaxSettings), t) : F(ae.ajaxSettings, e)
            },
            ajaxPrefilter: j(Wt),
            ajaxTransport: j(_t),
            ajax: function (e, t) {
                function n(e, t, n, i) {
                    var a, u, v, y, b, T = t;
                    2 !== w && (w = 2, s && clearTimeout(s), d = void 0, o = i || "", x.readyState = e > 0 ? 4 : 0, a = e >= 200 && 300 > e || 304 === e, n && (y = W(p, x, n)), y = _(p, y, x, a), a ? (p.ifModified && (b = x.getResponseHeader("Last-Modified"), b && (ae.lastModified[r] = b), b = x.getResponseHeader("etag"), b && (ae.etag[r] = b)), 204 === e || "HEAD" === p.type ? T = "nocontent" : 304 === e ? T = "notmodified" : (T = y.state, u = y.data, v = y.error, a = !v)) : (v = T, (e || !T) && (T = "error", 0 > e && (e = 0))), x.status = e, x.statusText = (t || T) + "", a ? h.resolveWith(c, [u, T, x]) : h.rejectWith(c, [x, T, v]), x.statusCode(g), g = void 0, l && f.trigger(a ? "ajaxSuccess" : "ajaxError", [x, p, a ? u : v]), m.fireWith(c, [x, T]), l && (f.trigger("ajaxComplete", [x, p]), --ae.active || ae.event.trigger("ajaxStop")))
                }

                "object" == typeof e && (t = e, e = void 0), t = t || {};
                var i, a, r, o, s, l, d, u, p = ae.ajaxSetup({}, t), c = p.context || p, f = p.context && (c.nodeType || c.jquery) ? ae(c) : ae.event, h = ae.Deferred(), m = ae.Callbacks("once memory"), g = p.statusCode || {}, v = {}, y = {}, w = 0, b = "canceled", x = {
                    readyState: 0,
                    getResponseHeader: function (e) {
                        var t;
                        if (2 === w) {
                            if (!u)for (u = {}; t = Bt.exec(o);)u[t[1].toLowerCase()] = t[2];
                            t = u[e.toLowerCase()]
                        }
                        return null == t ? null : t
                    },
                    getAllResponseHeaders: function () {
                        return 2 === w ? o : null
                    },
                    setRequestHeader: function (e, t) {
                        var n = e.toLowerCase();
                        return w || (e = y[n] = y[n] || e, v[e] = t), this
                    },
                    overrideMimeType: function (e) {
                        return w || (p.mimeType = e), this
                    },
                    statusCode: function (e) {
                        var t;
                        if (e)if (2 > w)for (t in e)g[t] = [g[t], e[t]]; else x.always(e[x.status]);
                        return this
                    },
                    abort: function (e) {
                        var t = e || b;
                        return d && d.abort(t), n(0, t), this
                    }
                };
                if (h.promise(x).complete = m.add, x.success = x.done, x.error = x.fail, p.url = ((e || p.url || Pt) + "").replace(zt, "").replace(Rt, $t[1] + "//"), p.type = t.method || t.type || p.method || p.type, p.dataTypes = ae.trim(p.dataType || "*").toLowerCase().match(we) || [""], null == p.crossDomain && (i = Ft.exec(p.url.toLowerCase()), p.crossDomain = !(!i || i[1] === $t[1] && i[2] === $t[2] && (i[3] || ("http:" === i[1] ? "80" : "443")) === ($t[3] || ("http:" === $t[1] ? "80" : "443")))), p.data && p.processData && "string" != typeof p.data && (p.data = ae.param(p.data, p.traditional)), R(Wt, p, t, x), 2 === w)return x;
                l = ae.event && p.global, l && 0 === ae.active++ && ae.event.trigger("ajaxStart"), p.type = p.type.toUpperCase(), p.hasContent = !jt.test(p.type), r = p.url, p.hasContent || (p.data && (r = p.url += (It.test(r) ? "&" : "?") + p.data, delete p.data), p.cache === !1 && (p.url = Ht.test(r) ? r.replace(Ht, "$1_=" + At++) : r + (It.test(r) ? "&" : "?") + "_=" + At++)), p.ifModified && (ae.lastModified[r] && x.setRequestHeader("If-Modified-Since", ae.lastModified[r]), ae.etag[r] && x.setRequestHeader("If-None-Match", ae.etag[r])), (p.data && p.hasContent && p.contentType !== !1 || t.contentType) && x.setRequestHeader("Content-Type", p.contentType), x.setRequestHeader("Accept", p.dataTypes[0] && p.accepts[p.dataTypes[0]] ? p.accepts[p.dataTypes[0]] + ("*" !== p.dataTypes[0] ? ", " + qt + "; q=0.01" : "") : p.accepts["*"]);
                for (a in p.headers)x.setRequestHeader(a, p.headers[a]);
                if (p.beforeSend && (p.beforeSend.call(c, x, p) === !1 || 2 === w))return x.abort();
                b = "abort";
                for (a in{success: 1, error: 1, complete: 1})x[a](p[a]);
                if (d = R(_t, p, t, x)) {
                    x.readyState = 1, l && f.trigger("ajaxSend", [x, p]), p.async && p.timeout > 0 && (s = setTimeout(function () {
                        x.abort("timeout")
                    }, p.timeout));
                    try {
                        w = 1, d.send(v, n)
                    } catch (T) {
                        if (!(2 > w))throw T;
                        n(-1, T)
                    }
                } else n(-1, "No Transport");
                return x
            },
            getJSON: function (e, t, n) {
                return ae.get(e, t, n, "json")
            },
            getScript: function (e, t) {
                return ae.get(e, void 0, t, "script")
            }
        }), ae.each(["get", "post"], function (e, t) {
            ae[t] = function (e, n, i, a) {
                return ae.isFunction(n) && (a = a || i, i = n, n = void 0), ae.ajax({
                    url: e,
                    type: t,
                    dataType: a,
                    data: n,
                    success: i
                })
            }
        }), ae._evalUrl = function (e) {
            return ae.ajax({url: e, type: "GET", dataType: "script", async: !1, global: !1, "throws": !0})
        }, ae.fn.extend({
            wrapAll: function (e) {
                if (ae.isFunction(e))return this.each(function (t) {
                    ae(this).wrapAll(e.call(this, t))
                });
                if (this[0]) {
                    var t = ae(e, this[0].ownerDocument).eq(0).clone(!0);
                    this[0].parentNode && t.insertBefore(this[0]), t.map(function () {
                        for (var e = this; e.firstChild && 1 === e.firstChild.nodeType;)e = e.firstChild;
                        return e
                    }).append(this)
                }
                return this
            }, wrapInner: function (e) {
                return this.each(ae.isFunction(e) ? function (t) {
                        ae(this).wrapInner(e.call(this, t))
                    } : function () {
                        var t = ae(this), n = t.contents();
                        n.length ? n.wrapAll(e) : t.append(e)
                    })
            }, wrap: function (e) {
                var t = ae.isFunction(e);
                return this.each(function (n) {
                    ae(this).wrapAll(t ? e.call(this, n) : e)
                })
            }, unwrap: function () {
                return this.parent().each(function () {
                    ae.nodeName(this, "body") || ae(this).replaceWith(this.childNodes)
                }).end()
            }
        }), ae.expr.filters.hidden = function (e) {
            return e.offsetWidth <= 0 && e.offsetHeight <= 0 || !ne.reliableHiddenOffsets() && "none" === (e.style && e.style.display || ae.css(e, "display"))
        }, ae.expr.filters.visible = function (e) {
            return !ae.expr.filters.hidden(e)
        };
        var Vt = /%20/g, Xt = /\[\]$/, Ut = /\r?\n/g, Yt = /^(?:submit|button|image|reset|file)$/i, Qt = /^(?:input|select|textarea|keygen)/i;
        ae.param = function (e, t) {
            var n, i = [], a = function (e, t) {
                t = ae.isFunction(t) ? t() : null == t ? "" : t, i[i.length] = encodeURIComponent(e) + "=" + encodeURIComponent(t)
            };
            if (void 0 === t && (t = ae.ajaxSettings && ae.ajaxSettings.traditional), ae.isArray(e) || e.jquery && !ae.isPlainObject(e)) ae.each(e, function () {
                a(this.name, this.value)
            }); else for (n in e)q(n, e[n], t, a);
            return i.join("&").replace(Vt, "+")
        }, ae.fn.extend({
            serialize: function () {
                return ae.param(this.serializeArray())
            }, serializeArray: function () {
                return this.map(function () {
                    var e = ae.prop(this, "elements");
                    return e ? ae.makeArray(e) : this
                }).filter(function () {
                    var e = this.type;
                    return this.name && !ae(this).is(":disabled") && Qt.test(this.nodeName) && !Yt.test(e) && (this.checked || !Ae.test(e))
                }).map(function (e, t) {
                    var n = ae(this).val();
                    return null == n ? null : ae.isArray(n) ? ae.map(n, function (e) {
                                return {name: t.name, value: e.replace(Ut, "\r\n")}
                            }) : {name: t.name, value: n.replace(Ut, "\r\n")}
                }).get()
            }
        }), ae.ajaxSettings.xhr = void 0 !== e.ActiveXObject ? function () {
                return !this.isLocal && /^(get|post|head|put|delete|options)$/i.test(this.type) && G() || V()
            } : G;
        var Kt = 0, Jt = {}, Zt = ae.ajaxSettings.xhr();
        e.attachEvent && e.attachEvent("onunload", function () {
            for (var e in Jt)Jt[e](void 0, !0)
        }), ne.cors = !!Zt && "withCredentials" in Zt, Zt = ne.ajax = !!Zt, Zt && ae.ajaxTransport(function (e) {
            if (!e.crossDomain || ne.cors) {
                var t;
                return {
                    send: function (n, i) {
                        var a, r = e.xhr(), o = ++Kt;
                        if (r.open(e.type, e.url, e.async, e.username, e.password), e.xhrFields)for (a in e.xhrFields)r[a] = e.xhrFields[a];
                        e.mimeType && r.overrideMimeType && r.overrideMimeType(e.mimeType), e.crossDomain || n["X-Requested-With"] || (n["X-Requested-With"] = "XMLHttpRequest");
                        for (a in n)void 0 !== n[a] && r.setRequestHeader(a, n[a] + "");
                        r.send(e.hasContent && e.data || null), t = function (n, a) {
                            var s, l, d;
                            if (t && (a || 4 === r.readyState))if (delete Jt[o], t = void 0, r.onreadystatechange = ae.noop, a) 4 !== r.readyState && r.abort(); else {
                                d = {}, s = r.status, "string" == typeof r.responseText && (d.text = r.responseText);
                                try {
                                    l = r.statusText
                                } catch (u) {
                                    l = ""
                                }
                                s || !e.isLocal || e.crossDomain ? 1223 === s && (s = 204) : s = d.text ? 200 : 404
                            }
                            d && i(s, l, d, r.getAllResponseHeaders())
                        }, e.async ? 4 === r.readyState ? setTimeout(t) : r.onreadystatechange = Jt[o] = t : t()
                    }, abort: function () {
                        t && t(void 0, !0)
                    }
                }
            }
        }), ae.ajaxSetup({
            accepts: {script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},
            contents: {script: /(?:java|ecma)script/},
            converters: {
                "text script": function (e) {
                    return ae.globalEval(e), e
                }
            }
        }), ae.ajaxPrefilter("script", function (e) {
            void 0 === e.cache && (e.cache = !1), e.crossDomain && (e.type = "GET", e.global = !1)
        }), ae.ajaxTransport("script", function (e) {
            if (e.crossDomain) {
                var t, n = he.head || ae("head")[0] || he.documentElement;
                return {
                    send: function (i, a) {
                        t = he.createElement("script"), t.async = !0, e.scriptCharset && (t.charset = e.scriptCharset), t.src = e.url, t.onload = t.onreadystatechange = function (e, n) {
                            (n || !t.readyState || /loaded|complete/.test(t.readyState)) && (t.onload = t.onreadystatechange = null, t.parentNode && t.parentNode.removeChild(t), t = null, n || a(200, "success"))
                        }, n.insertBefore(t, n.firstChild)
                    }, abort: function () {
                        t && t.onload(void 0, !0)
                    }
                }
            }
        });
        var en = [], tn = /(=)\?(?=&|$)|\?\?/;
        ae.ajaxSetup({
            jsonp: "callback", jsonpCallback: function () {
                var e = en.pop() || ae.expando + "_" + At++;
                return this[e] = !0, e
            }
        }), ae.ajaxPrefilter("json jsonp", function (t, n, i) {
            var a, r, o, s = t.jsonp !== !1 && (tn.test(t.url) ? "url" : "string" == typeof t.data && !(t.contentType || "").indexOf("application/x-www-form-urlencoded") && tn.test(t.data) && "data");
            return s || "jsonp" === t.dataTypes[0] ? (a = t.jsonpCallback = ae.isFunction(t.jsonpCallback) ? t.jsonpCallback() : t.jsonpCallback, s ? t[s] = t[s].replace(tn, "$1" + a) : t.jsonp !== !1 && (t.url += (It.test(t.url) ? "&" : "?") + t.jsonp + "=" + a), t.converters["script json"] = function () {
                    return o || ae.error(a + " was not called"), o[0]
                }, t.dataTypes[0] = "json", r = e[a], e[a] = function () {
                    o = arguments
                }, i.always(function () {
                    e[a] = r, t[a] && (t.jsonpCallback = n.jsonpCallback, en.push(a)), o && ae.isFunction(r) && r(o[0]), o = r = void 0
                }), "script") : void 0
        }), ae.parseHTML = function (e, t, n) {
            if (!e || "string" != typeof e)return null;
            "boolean" == typeof t && (n = t, t = !1), t = t || he;
            var i = pe.exec(e), a = !n && [];
            return i ? [t.createElement(i[1])] : (i = ae.buildFragment([e], t, a), a && a.length && ae(a).remove(), ae.merge([], i.childNodes))
        };
        var nn = ae.fn.load;
        ae.fn.load = function (e, t, n) {
            if ("string" != typeof e && nn)return nn.apply(this, arguments);
            var i, a, r, o = this, s = e.indexOf(" ");
            return s >= 0 && (i = ae.trim(e.slice(s, e.length)), e = e.slice(0, s)), ae.isFunction(t) ? (n = t, t = void 0) : t && "object" == typeof t && (r = "POST"), o.length > 0 && ae.ajax({
                url: e,
                type: r,
                dataType: "html",
                data: t
            }).done(function (e) {
                a = arguments, o.html(i ? ae("<div>").append(ae.parseHTML(e)).find(i) : e)
            }).complete(n && function (e, t) {
                    o.each(n, a || [e.responseText, t, e])
                }), this
        }, ae.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function (e, t) {
            ae.fn[t] = function (e) {
                return this.on(t, e)
            }
        }), ae.expr.filters.animated = function (e) {
            return ae.grep(ae.timers, function (t) {
                return e === t.elem
            }).length
        };
        var an = e.document.documentElement;
        ae.offset = {
            setOffset: function (e, t, n) {
                var i, a, r, o, s, l, d, u = ae.css(e, "position"), p = ae(e), c = {};
                "static" === u && (e.style.position = "relative"), s = p.offset(), r = ae.css(e, "top"), l = ae.css(e, "left"), d = ("absolute" === u || "fixed" === u) && ae.inArray("auto", [r, l]) > -1, d ? (i = p.position(), o = i.top, a = i.left) : (o = parseFloat(r) || 0, a = parseFloat(l) || 0), ae.isFunction(t) && (t = t.call(e, n, s)), null != t.top && (c.top = t.top - s.top + o), null != t.left && (c.left = t.left - s.left + a), "using" in t ? t.using.call(e, c) : p.css(c)
            }
        }, ae.fn.extend({
            offset: function (e) {
                if (arguments.length)return void 0 === e ? this : this.each(function (t) {
                        ae.offset.setOffset(this, e, t)
                    });
                var t, n, i = {top: 0, left: 0}, a = this[0], r = a && a.ownerDocument;
                return r ? (t = r.documentElement, ae.contains(t, a) ? (typeof a.getBoundingClientRect !== Ce && (i = a.getBoundingClientRect()), n = X(r), {
                            top: i.top + (n.pageYOffset || t.scrollTop) - (t.clientTop || 0),
                            left: i.left + (n.pageXOffset || t.scrollLeft) - (t.clientLeft || 0)
                        }) : i) : void 0
            }, position: function () {
                if (this[0]) {
                    var e, t, n = {top: 0, left: 0}, i = this[0];
                    return "fixed" === ae.css(i, "position") ? t = i.getBoundingClientRect() : (e = this.offsetParent(), t = this.offset(), ae.nodeName(e[0], "html") || (n = e.offset()), n.top += ae.css(e[0], "borderTopWidth", !0), n.left += ae.css(e[0], "borderLeftWidth", !0)), {
                        top: t.top - n.top - ae.css(i, "marginTop", !0),
                        left: t.left - n.left - ae.css(i, "marginLeft", !0)
                    }
                }
            }, offsetParent: function () {
                return this.map(function () {
                    for (var e = this.offsetParent || an; e && !ae.nodeName(e, "html") && "static" === ae.css(e, "position");)e = e.offsetParent;
                    return e || an
                })
            }
        }), ae.each({scrollLeft: "pageXOffset", scrollTop: "pageYOffset"}, function (e, t) {
            var n = /Y/.test(t);
            ae.fn[e] = function (i) {
                return Me(this, function (e, i, a) {
                    var r = X(e);
                    return void 0 === a ? r ? t in r ? r[t] : r.document.documentElement[i] : e[i] : void(r ? r.scrollTo(n ? ae(r).scrollLeft() : a, n ? a : ae(r).scrollTop()) : e[i] = a)
                }, e, i, arguments.length, null)
            }
        }), ae.each(["top", "left"], function (e, t) {
            ae.cssHooks[t] = k(ne.pixelPosition, function (e, n) {
                return n ? (n = tt(e, t), it.test(n) ? ae(e).position()[t] + "px" : n) : void 0
            })
        }), ae.each({Height: "height", Width: "width"}, function (e, t) {
            ae.each({padding: "inner" + e, content: t, "": "outer" + e}, function (n, i) {
                ae.fn[i] = function (i, a) {
                    var r = arguments.length && (n || "boolean" != typeof i), o = n || (i === !0 || a === !0 ? "margin" : "border");
                    return Me(this, function (t, n, i) {
                        var a;
                        return ae.isWindow(t) ? t.document.documentElement["client" + e] : 9 === t.nodeType ? (a = t.documentElement, Math.max(t.body["scroll" + e], a["scroll" + e], t.body["offset" + e], a["offset" + e], a["client" + e])) : void 0 === i ? ae.css(t, n, o) : ae.style(t, n, i, o)
                    }, t, r ? i : void 0, r, null)
                }
            })
        }), ae.fn.size = function () {
            return this.length
        }, ae.fn.andSelf = ae.fn.addBack, "function" == typeof define && define.amd && define("jquery", [], function () {
            return ae
        });
        var rn = e.jQuery, on = e.$;
        return ae.noConflict = function (t) {
            return e.$ === ae && (e.$ = on), t && e.jQuery === ae && (e.jQuery = rn), ae
        }, typeof t === Ce && (e.jQuery = e.$ = ae), ae
    }), !function () {
        "use strict";
        function e(e) {
            e.fn.swiper = function (t) {
                var i;
                return e(this).each(function () {
                    var e = new n(this, t);
                    i || (i = e)
                }), i
            }
        }

        var t, n = function (e, a) {
            function r(e) {
                return Math.floor(e)
            }

            function o() {
                b.autoplayTimeoutId = setTimeout(function () {
                    b.params.loop ? (b.fixLoop(), b._slideNext(), b.emit("onAutoplay", b)) : b.isEnd ? a.autoplayStopOnLast ? b.stopAutoplay() : (b._slideTo(0), b.emit("onAutoplay", b)) : (b._slideNext(), b.emit("onAutoplay", b))
                }, b.params.autoplay)
            }

            function s(e, n) {
                var i = t(e.target);
                if (!i.is(n))if ("string" == typeof n) i = i.parents(n); else if (n.nodeType) {
                    var a;
                    return i.parents().each(function (e, t) {
                        t === n && (a = n)
                    }), a ? n : void 0
                }
                return 0 !== i.length ? i[0] : void 0
            }

            function l(e, t) {
                t = t || {};
                var n = window.MutationObserver || window.WebkitMutationObserver, i = new n(function (e) {
                    e.forEach(function (e) {
                        b.onResize(!0), b.emit("onObserverUpdate", b, e)
                    })
                });
                i.observe(e, {
                    attributes: "undefined" == typeof t.attributes ? !0 : t.attributes,
                    childList: "undefined" == typeof t.childList ? !0 : t.childList,
                    characterData: "undefined" == typeof t.characterData ? !0 : t.characterData
                }), b.observers.push(i)
            }

            function d(e) {
                e.originalEvent && (e = e.originalEvent);
                var t = e.keyCode || e.charCode;
                if (!b.params.allowSwipeToNext && (b.isHorizontal() && 39 === t || !b.isHorizontal() && 40 === t))return !1;
                if (!b.params.allowSwipeToPrev && (b.isHorizontal() && 37 === t || !b.isHorizontal() && 38 === t))return !1;
                if (!(e.shiftKey || e.altKey || e.ctrlKey || e.metaKey || document.activeElement && document.activeElement.nodeName && ("input" === document.activeElement.nodeName.toLowerCase() || "textarea" === document.activeElement.nodeName.toLowerCase()))) {
                    if (37 === t || 39 === t || 38 === t || 40 === t) {
                        var n = !1;
                        if (b.container.parents(".swiper-slide").length > 0 && 0 === b.container.parents(".swiper-slide-active").length)return;
                        var i = {
                            left: window.pageXOffset,
                            top: window.pageYOffset
                        }, a = window.innerWidth, r = window.innerHeight, o = b.container.offset();
                        b.rtl && (o.left = o.left - b.container[0].scrollLeft);
                        for (var s = [[o.left, o.top], [o.left + b.width, o.top], [o.left, o.top + b.height], [o.left + b.width, o.top + b.height]], l = 0; l < s.length; l++) {
                            var d = s[l];
                            d[0] >= i.left && d[0] <= i.left + a && d[1] >= i.top && d[1] <= i.top + r && (n = !0)
                        }
                        if (!n)return
                    }
                    b.isHorizontal() ? ((37 === t || 39 === t) && (e.preventDefault ? e.preventDefault() : e.returnValue = !1), (39 === t && !b.rtl || 37 === t && b.rtl) && b.slideNext(), (37 === t && !b.rtl || 39 === t && b.rtl) && b.slidePrev()) : ((38 === t || 40 === t) && (e.preventDefault ? e.preventDefault() : e.returnValue = !1), 40 === t && b.slideNext(), 38 === t && b.slidePrev())
                }
            }

            function u(e) {
                e.originalEvent && (e = e.originalEvent);
                var t = b.mousewheel.event, n = 0, i = b.rtl ? -1 : 1;
                if ("mousewheel" === t)if (b.params.mousewheelForceToAxis)if (b.isHorizontal()) {
                    if (!(Math.abs(e.wheelDeltaX) > Math.abs(e.wheelDeltaY)))return;
                    n = e.wheelDeltaX * i
                } else {
                    if (!(Math.abs(e.wheelDeltaY) > Math.abs(e.wheelDeltaX)))return;
                    n = e.wheelDeltaY
                } else n = Math.abs(e.wheelDeltaX) > Math.abs(e.wheelDeltaY) ? -e.wheelDeltaX * i : -e.wheelDeltaY; else if ("DOMMouseScroll" === t) n = -e.detail; else if ("wheel" === t)if (b.params.mousewheelForceToAxis)if (b.isHorizontal()) {
                    if (!(Math.abs(e.deltaX) > Math.abs(e.deltaY)))return;
                    n = -e.deltaX * i
                } else {
                    if (!(Math.abs(e.deltaY) > Math.abs(e.deltaX)))return;
                    n = -e.deltaY
                } else n = Math.abs(e.deltaX) > Math.abs(e.deltaY) ? -e.deltaX * i : -e.deltaY;
                if (0 !== n) {
                    if (b.params.mousewheelInvert && (n = -n), b.params.freeMode) {
                        var a = b.getWrapperTranslate() + n * b.params.mousewheelSensitivity, r = b.isBeginning, o = b.isEnd;
                        if (a >= b.minTranslate() && (a = b.minTranslate()), a <= b.maxTranslate() && (a = b.maxTranslate()), b.setWrapperTransition(0), b.setWrapperTranslate(a), b.updateProgress(), b.updateActiveIndex(), (!r && b.isBeginning || !o && b.isEnd) && b.updateClasses(), b.params.freeModeSticky ? (clearTimeout(b.mousewheel.timeout), b.mousewheel.timeout = setTimeout(function () {
                                    b.slideReset()
                                }, 300)) : b.params.lazyLoading && b.lazy && b.lazy.load(), 0 === a || a === b.maxTranslate())return
                    } else {
                        if ((new window.Date).getTime() - b.mousewheel.lastScrollTime > 60)if (0 > n)if (b.isEnd && !b.params.loop || b.animating) {
                            if (b.params.mousewheelReleaseOnEdges)return !0
                        } else b.slideNext(); else if (b.isBeginning && !b.params.loop || b.animating) {
                            if (b.params.mousewheelReleaseOnEdges)return !0
                        } else b.slidePrev();
                        b.mousewheel.lastScrollTime = (new window.Date).getTime()
                    }
                    return b.params.autoplay && b.stopAutoplay(), e.preventDefault ? e.preventDefault() : e.returnValue = !1, !1
                }
            }

            function p(e, n) {
                e = t(e);
                var i, a, r, o = b.rtl ? -1 : 1;
                i = e.attr("data-swiper-parallax") || "0", a = e.attr("data-swiper-parallax-x"), r = e.attr("data-swiper-parallax-y"), a || r ? (a = a || "0", r = r || "0") : b.isHorizontal() ? (a = i, r = "0") : (r = i, a = "0"), a = a.indexOf("%") >= 0 ? parseInt(a, 10) * n * o + "%" : a * n * o + "px", r = r.indexOf("%") >= 0 ? parseInt(r, 10) * n + "%" : r * n + "px", e.transform("translate3d(" + a + ", " + r + ",0px)")
            }

            function c(e) {
                return 0 !== e.indexOf("on") && (e = e[0] !== e[0].toUpperCase() ? "on" + e[0].toUpperCase() + e.substring(1) : "on" + e), e
            }

            if (!(this instanceof n))return new n(e, a);
            var f = {
                direction: "horizontal",
                touchEventsTarget: "container",
                initialSlide: 0,
                speed: 300,
                autoplay: !1,
                autoplayDisableOnInteraction: !0,
                autoplayStopOnLast: !1,
                iOSEdgeSwipeDetection: !1,
                iOSEdgeSwipeThreshold: 20,
                freeMode: !1,
                freeModeMomentum: !0,
                freeModeMomentumRatio: 1,
                freeModeMomentumBounce: !0,
                freeModeMomentumBounceRatio: 1,
                freeModeSticky: !1,
                freeModeMinimumVelocity: .02,
                autoHeight: !1,
                setWrapperSize: !1,
                virtualTranslate: !1,
                effect: "slide",
                coverflow: {rotate: 50, stretch: 0, depth: 100, modifier: 1, slideShadows: !0},
                flip: {slideShadows: !0, limitRotation: !0},
                cube: {slideShadows: !0, shadow: !0, shadowOffset: 20, shadowScale: .94},
                fade: {crossFade: !1},
                parallax: !1,
                scrollbar: null,
                scrollbarHide: !0,
                scrollbarDraggable: !1,
                scrollbarSnapOnRelease: !1,
                keyboardControl: !1,
                mousewheelControl: !1,
                mousewheelReleaseOnEdges: !1,
                mousewheelInvert: !1,
                mousewheelForceToAxis: !1,
                mousewheelSensitivity: 1,
                hashnav: !1,
                breakpoints: void 0,
                spaceBetween: 0,
                slidesPerView: 1,
                slidesPerColumn: 1,
                slidesPerColumnFill: "column",
                slidesPerGroup: 1,
                centeredSlides: !1,
                slidesOffsetBefore: 0,
                slidesOffsetAfter: 0,
                roundLengths: !1,
                touchRatio: 1,
                touchAngle: 45,
                simulateTouch: !0,
                shortSwipes: !0,
                longSwipes: !0,
                longSwipesRatio: .5,
                longSwipesMs: 300,
                followFinger: !0,
                onlyExternal: !1,
                threshold: 0,
                touchMoveStopPropagation: !0,
                uniqueNavElements: !0,
                pagination: null,
                paginationElement: "span",
                paginationClickable: !1,
                paginationHide: !1,
                paginationBulletRender: null,
                paginationProgressRender: null,
                paginationFractionRender: null,
                paginationCustomRender: null,
                paginationType: "bullets",
                resistance: !0,
                resistanceRatio: .85,
                nextButton: null,
                prevButton: null,
                watchSlidesProgress: !1,
                watchSlidesVisibility: !1,
                grabCursor: !1,
                preventClicks: !0,
                preventClicksPropagation: !0,
                slideToClickedSlide: !1,
                lazyLoading: !1,
                lazyLoadingInPrevNext: !1,
                lazyLoadingInPrevNextAmount: 1,
                lazyLoadingOnTransitionStart: !1,
                preloadImages: !0,
                updateOnImagesReady: !0,
                loop: !1,
                loopAdditionalSlides: 0,
                loopedSlides: null,
                control: void 0,
                controlInverse: !1,
                controlBy: "slide",
                allowSwipeToPrev: !0,
                allowSwipeToNext: !0,
                swipeHandler: null,
                noSwiping: !0,
                noSwipingClass: "swiper-no-swiping",
                slideClass: "swiper-slide",
                slideActiveClass: "swiper-slide-active",
                slideVisibleClass: "swiper-slide-visible",
                slideDuplicateClass: "swiper-slide-duplicate",
                slideNextClass: "swiper-slide-next",
                slidePrevClass: "swiper-slide-prev",
                wrapperClass: "swiper-wrapper",
                bulletClass: "swiper-pagination-bullet",
                bulletActiveClass: "swiper-pagination-bullet-active",
                buttonDisabledClass: "swiper-button-disabled",
                paginationCurrentClass: "swiper-pagination-current",
                paginationTotalClass: "swiper-pagination-total",
                paginationHiddenClass: "swiper-pagination-hidden",
                paginationProgressbarClass: "swiper-pagination-progressbar",
                observer: !1,
                observeParents: !1,
                a11y: !1,
                prevSlideMessage: "Previous slide",
                nextSlideMessage: "Next slide",
                firstSlideMessage: "This is the first slide",
                lastSlideMessage: "This is the last slide",
                paginationBulletMessage: "Go to slide {{index}}",
                runCallbacksOnInit: !0
            }, h = a && a.virtualTranslate;
            a = a || {};
            var m = {};
            for (var g in a)if ("object" != typeof a[g] || null === a[g] || a[g].nodeType || a[g] === window || a[g] === document || "undefined" != typeof i && a[g] instanceof i || "undefined" != typeof jQuery && a[g] instanceof jQuery) m[g] = a[g]; else {
                m[g] = {};
                for (var v in a[g])m[g][v] = a[g][v]
            }
            for (var y in f)if ("undefined" == typeof a[y]) a[y] = f[y]; else if ("object" == typeof a[y])for (var w in f[y])"undefined" == typeof a[y][w] && (a[y][w] = f[y][w]);
            var b = this;
            if (b.params = a, b.originalParams = m, b.classNames = [], "undefined" != typeof t && "undefined" != typeof i && (t = i), ("undefined" != typeof t || (t = "undefined" == typeof i ? window.Dom7 || window.Zepto || window.jQuery : i)) && (b.$ = t, b.currentBreakpoint = void 0, b.getActiveBreakpoint = function () {
                    if (!b.params.breakpoints)return !1;
                    var e, t = !1, n = [];
                    for (e in b.params.breakpoints)b.params.breakpoints.hasOwnProperty(e) && n.push(e);
                    n.sort(function (e, t) {
                        return parseInt(e, 10) > parseInt(t, 10)
                    });
                    for (var i = 0; i < n.length; i++)e = n[i], e >= window.innerWidth && !t && (t = e);
                    return t || "max"
                }, b.setBreakpoint = function () {
                    var e = b.getActiveBreakpoint();
                    if (e && b.currentBreakpoint !== e) {
                        var t = e in b.params.breakpoints ? b.params.breakpoints[e] : b.originalParams, n = b.params.loop && t.slidesPerView !== b.params.slidesPerView;
                        for (var i in t)b.params[i] = t[i];
                        b.currentBreakpoint = e, n && b.destroyLoop && b.reLoop(!0)
                    }
                }, b.params.breakpoints && b.setBreakpoint(), b.container = t(e), 0 !== b.container.length)) {
                if (b.container.length > 1) {
                    var x = [];
                    return b.container.each(function () {
                        x.push(new n(this, a))
                    }), x
                }
                b.container[0].swiper = b, b.container.data("swiper", b), b.classNames.push("swiper-container-" + b.params.direction), b.params.freeMode && b.classNames.push("swiper-container-free-mode"), b.support.flexbox || (b.classNames.push("swiper-container-no-flexbox"), b.params.slidesPerColumn = 1), b.params.autoHeight && b.classNames.push("swiper-container-autoheight"), (b.params.parallax || b.params.watchSlidesVisibility) && (b.params.watchSlidesProgress = !0), ["cube", "coverflow", "flip"].indexOf(b.params.effect) >= 0 && (b.support.transforms3d ? (b.params.watchSlidesProgress = !0, b.classNames.push("swiper-container-3d")) : b.params.effect = "slide"), "slide" !== b.params.effect && b.classNames.push("swiper-container-" + b.params.effect), "cube" === b.params.effect && (b.params.resistanceRatio = 0, b.params.slidesPerView = 1, b.params.slidesPerColumn = 1, b.params.slidesPerGroup = 1, b.params.centeredSlides = !1, b.params.spaceBetween = 0, b.params.virtualTranslate = !0, b.params.setWrapperSize = !1), ("fade" === b.params.effect || "flip" === b.params.effect) && (b.params.slidesPerView = 1, b.params.slidesPerColumn = 1, b.params.slidesPerGroup = 1, b.params.watchSlidesProgress = !0, b.params.spaceBetween = 0, b.params.setWrapperSize = !1, "undefined" == typeof h && (b.params.virtualTranslate = !0)), b.params.grabCursor && b.support.touch && (b.params.grabCursor = !1), b.wrapper = b.container.children("." + b.params.wrapperClass), b.params.pagination && (b.paginationContainer = t(b.params.pagination), b.params.uniqueNavElements && "string" == typeof b.params.pagination && b.paginationContainer.length > 1 && 1 === b.container.find(b.params.pagination).length && (b.paginationContainer = b.container.find(b.params.pagination)), "bullets" === b.params.paginationType && b.params.paginationClickable ? b.paginationContainer.addClass("swiper-pagination-clickable") : b.params.paginationClickable = !1, b.paginationContainer.addClass("swiper-pagination-" + b.params.paginationType)), (b.params.nextButton || b.params.prevButton) && (b.params.nextButton && (b.nextButton = t(b.params.nextButton), b.params.uniqueNavElements && "string" == typeof b.params.nextButton && b.nextButton.length > 1 && 1 === b.container.find(b.params.nextButton).length && (b.nextButton = b.container.find(b.params.nextButton))), b.params.prevButton && (b.prevButton = t(b.params.prevButton), b.params.uniqueNavElements && "string" == typeof b.params.prevButton && b.prevButton.length > 1 && 1 === b.container.find(b.params.prevButton).length && (b.prevButton = b.container.find(b.params.prevButton)))), b.isHorizontal = function () {
                    return "horizontal" === b.params.direction
                }, b.rtl = b.isHorizontal() && ("rtl" === b.container[0].dir.toLowerCase() || "rtl" === b.container.css("direction")), b.rtl && b.classNames.push("swiper-container-rtl"), b.rtl && (b.wrongRTL = "-webkit-box" === b.wrapper.css("display")), b.params.slidesPerColumn > 1 && b.classNames.push("swiper-container-multirow"), b.device.android && b.classNames.push("swiper-container-android"), b.container.addClass(b.classNames.join(" ")), b.translate = 0, b.progress = 0, b.velocity = 0, b.lockSwipeToNext = function () {
                    b.params.allowSwipeToNext = !1
                }, b.lockSwipeToPrev = function () {
                    b.params.allowSwipeToPrev = !1
                }, b.lockSwipes = function () {
                    b.params.allowSwipeToNext = b.params.allowSwipeToPrev = !1
                }, b.unlockSwipeToNext = function () {
                    b.params.allowSwipeToNext = !0
                }, b.unlockSwipeToPrev = function () {
                    b.params.allowSwipeToPrev = !0
                }, b.unlockSwipes = function () {
                    b.params.allowSwipeToNext = b.params.allowSwipeToPrev = !0
                }, b.params.grabCursor && (b.container[0].style.cursor = "move", b.container[0].style.cursor = "-webkit-grab", b.container[0].style.cursor = "-moz-grab", b.container[0].style.cursor = "grab"), b.imagesToLoad = [], b.imagesLoaded = 0, b.loadImage = function (e, t, n, i, a) {
                    function r() {
                        a && a()
                    }

                    var o;
                    e.complete && i ? r() : t ? (o = new window.Image, o.onload = r, o.onerror = r, n && (o.srcset = n), t && (o.src = t)) : r()
                }, b.preloadImages = function () {
                    function e() {
                        "undefined" != typeof b && null !== b && (void 0 !== b.imagesLoaded && b.imagesLoaded++, b.imagesLoaded === b.imagesToLoad.length && (b.params.updateOnImagesReady && b.update(), b.emit("onImagesReady", b)))
                    }

                    b.imagesToLoad = b.container.find("img");
                    for (var t = 0; t < b.imagesToLoad.length; t++)b.loadImage(b.imagesToLoad[t], b.imagesToLoad[t].currentSrc || b.imagesToLoad[t].getAttribute("src"), b.imagesToLoad[t].srcset || b.imagesToLoad[t].getAttribute("srcset"), !0, e)
                }, b.autoplayTimeoutId = void 0, b.autoplaying = !1, b.autoplayPaused = !1, b.startAutoplay = function () {
                    return "undefined" != typeof b.autoplayTimeoutId ? !1 : b.params.autoplay ? b.autoplaying ? !1 : (b.autoplaying = !0, b.emit("onAutoplayStart", b), void o()) : !1
                }, b.stopAutoplay = function (e) {
                    b.autoplayTimeoutId && (b.autoplayTimeoutId && clearTimeout(b.autoplayTimeoutId), b.autoplaying = !1, b.autoplayTimeoutId = void 0, b.emit("onAutoplayStop", b))
                }, b.pauseAutoplay = function (e) {
                    b.autoplayPaused || (b.autoplayTimeoutId && clearTimeout(b.autoplayTimeoutId), b.autoplayPaused = !0, 0 === e ? (b.autoplayPaused = !1, o()) : b.wrapper.transitionEnd(function () {
                            b && (b.autoplayPaused = !1, b.autoplaying ? o() : b.stopAutoplay())
                        }))
                }, b.minTranslate = function () {
                    return -b.snapGrid[0]
                }, b.maxTranslate = function () {
                    return -b.snapGrid[b.snapGrid.length - 1]
                }, b.updateAutoHeight = function () {
                    var e = b.slides.eq(b.activeIndex)[0];
                    if ("undefined" != typeof e) {
                        var t = e.offsetHeight;
                        t && b.wrapper.css("height", t + "px")
                    }
                }, b.updateContainerSize = function () {
                    var e, t;
                    e = "undefined" != typeof b.params.width ? b.params.width : b.container[0].clientWidth, t = "undefined" != typeof b.params.height ? b.params.height : b.container[0].clientHeight, 0 === e && b.isHorizontal() || 0 === t && !b.isHorizontal() || (e = e - parseInt(b.container.css("padding-left"), 10) - parseInt(b.container.css("padding-right"), 10), t = t - parseInt(b.container.css("padding-top"), 10) - parseInt(b.container.css("padding-bottom"), 10), b.width = e, b.height = t, b.size = b.isHorizontal() ? b.width : b.height)
                }, b.updateSlidesSize = function () {
                    b.slides = b.wrapper.children("." + b.params.slideClass), b.snapGrid = [], b.slidesGrid = [], b.slidesSizesGrid = [];
                    var e, t = b.params.spaceBetween, n = -b.params.slidesOffsetBefore, i = 0, a = 0;
                    if ("undefined" != typeof b.size) {
                        "string" == typeof t && t.indexOf("%") >= 0 && (t = parseFloat(t.replace("%", "")) / 100 * b.size), b.virtualSize = -t, b.rtl ? b.slides.css({
                                marginLeft: "",
                                marginTop: ""
                            }) : b.slides.css({marginRight: "", marginBottom: ""});
                        var o;
                        b.params.slidesPerColumn > 1 && (o = Math.floor(b.slides.length / b.params.slidesPerColumn) === b.slides.length / b.params.slidesPerColumn ? b.slides.length : Math.ceil(b.slides.length / b.params.slidesPerColumn) * b.params.slidesPerColumn, "auto" !== b.params.slidesPerView && "row" === b.params.slidesPerColumnFill && (o = Math.max(o, b.params.slidesPerView * b.params.slidesPerColumn)));
                        var s, l = b.params.slidesPerColumn, d = o / l, u = d - (b.params.slidesPerColumn * d - b.slides.length);
                        for (e = 0; e < b.slides.length; e++) {
                            s = 0;
                            var p = b.slides.eq(e);
                            if (b.params.slidesPerColumn > 1) {
                                var c, f, h;
                                "column" === b.params.slidesPerColumnFill ? (f = Math.floor(e / l), h = e - f * l, (f > u || f === u && h === l - 1) && ++h >= l && (h = 0, f++), c = f + h * o / l, p.css({
                                        "-webkit-box-ordinal-group": c,
                                        "-moz-box-ordinal-group": c,
                                        "-ms-flex-order": c,
                                        "-webkit-order": c,
                                        order: c
                                    })) : (h = Math.floor(e / d), f = e - h * d), p.css({"margin-top": 0 !== h && b.params.spaceBetween && b.params.spaceBetween + "px"}).attr("data-swiper-column", f).attr("data-swiper-row", h)
                            }
                            "none" !== p.css("display") && ("auto" === b.params.slidesPerView ? (s = b.isHorizontal() ? p.outerWidth(!0) : p.outerHeight(!0), b.params.roundLengths && (s = r(s))) : (s = (b.size - (b.params.slidesPerView - 1) * t) / b.params.slidesPerView, b.params.roundLengths && (s = r(s)), b.isHorizontal() ? b.slides[e].style.width = s + "px" : b.slides[e].style.height = s + "px"), b.slides[e].swiperSlideSize = s, b.slidesSizesGrid.push(s), b.params.centeredSlides ? (n = n + s / 2 + i / 2 + t, 0 === e && (n = n - b.size / 2 - t), Math.abs(n) < .001 && (n = 0), a % b.params.slidesPerGroup === 0 && b.snapGrid.push(n), b.slidesGrid.push(n)) : (a % b.params.slidesPerGroup === 0 && b.snapGrid.push(n), b.slidesGrid.push(n), n = n + s + t), b.virtualSize += s + t, i = s, a++)
                        }
                        b.virtualSize = Math.max(b.virtualSize, b.size) + b.params.slidesOffsetAfter;
                        var m;
                        if (b.rtl && b.wrongRTL && ("slide" === b.params.effect || "coverflow" === b.params.effect) && b.wrapper.css({width: b.virtualSize + b.params.spaceBetween + "px"}), (!b.support.flexbox || b.params.setWrapperSize) && (b.isHorizontal() ? b.wrapper.css({width: b.virtualSize + b.params.spaceBetween + "px"}) : b.wrapper.css({height: b.virtualSize + b.params.spaceBetween + "px"})), b.params.slidesPerColumn > 1 && (b.virtualSize = (s + b.params.spaceBetween) * o, b.virtualSize = Math.ceil(b.virtualSize / b.params.slidesPerColumn) - b.params.spaceBetween, b.wrapper.css({width: b.virtualSize + b.params.spaceBetween + "px"}), b.params.centeredSlides)) {
                            for (m = [], e = 0; e < b.snapGrid.length; e++)b.snapGrid[e] < b.virtualSize + b.snapGrid[0] && m.push(b.snapGrid[e]);
                            b.snapGrid = m
                        }
                        if (!b.params.centeredSlides) {
                            for (m = [], e = 0; e < b.snapGrid.length; e++)b.snapGrid[e] <= b.virtualSize - b.size && m.push(b.snapGrid[e]);
                            b.snapGrid = m, Math.floor(b.virtualSize - b.size) - Math.floor(b.snapGrid[b.snapGrid.length - 1]) > 1 && b.snapGrid.push(b.virtualSize - b.size)
                        }
                        0 === b.snapGrid.length && (b.snapGrid = [0]), 0 !== b.params.spaceBetween && (b.isHorizontal() ? b.rtl ? b.slides.css({marginLeft: t + "px"}) : b.slides.css({marginRight: t + "px"}) : b.slides.css({marginBottom: t + "px"})), b.params.watchSlidesProgress && b.updateSlidesOffset()
                    }
                }, b.updateSlidesOffset = function () {
                    for (var e = 0; e < b.slides.length; e++)b.slides[e].swiperSlideOffset = b.isHorizontal() ? b.slides[e].offsetLeft : b.slides[e].offsetTop
                }, b.updateSlidesProgress = function (e) {
                    if ("undefined" == typeof e && (e = b.translate || 0), 0 !== b.slides.length) {
                        "undefined" == typeof b.slides[0].swiperSlideOffset && b.updateSlidesOffset();
                        var t = -e;
                        b.rtl && (t = e), b.slides.removeClass(b.params.slideVisibleClass);
                        for (var n = 0; n < b.slides.length; n++) {
                            var i = b.slides[n], a = (t - i.swiperSlideOffset) / (i.swiperSlideSize + b.params.spaceBetween);
                            if (b.params.watchSlidesVisibility) {
                                var r = -(t - i.swiperSlideOffset), o = r + b.slidesSizesGrid[n], s = r >= 0 && r < b.size || o > 0 && o <= b.size || 0 >= r && o >= b.size;
                                s && b.slides.eq(n).addClass(b.params.slideVisibleClass)
                            }
                            i.progress = b.rtl ? -a : a
                        }
                    }
                }, b.updateProgress = function (e) {
                    "undefined" == typeof e && (e = b.translate || 0);
                    var t = b.maxTranslate() - b.minTranslate(), n = b.isBeginning, i = b.isEnd;
                    0 === t ? (b.progress = 0, b.isBeginning = b.isEnd = !0) : (b.progress = (e - b.minTranslate()) / t, b.isBeginning = b.progress <= 0, b.isEnd = b.progress >= 1), b.isBeginning && !n && b.emit("onReachBeginning", b), b.isEnd && !i && b.emit("onReachEnd", b), b.params.watchSlidesProgress && b.updateSlidesProgress(e), b.emit("onProgress", b, b.progress)
                }, b.updateActiveIndex = function () {
                    var e, t, n, i = b.rtl ? b.translate : -b.translate;
                    for (t = 0; t < b.slidesGrid.length; t++)"undefined" != typeof b.slidesGrid[t + 1] ? i >= b.slidesGrid[t] && i < b.slidesGrid[t + 1] - (b.slidesGrid[t + 1] - b.slidesGrid[t]) / 2 ? e = t : i >= b.slidesGrid[t] && i < b.slidesGrid[t + 1] && (e = t + 1) : i >= b.slidesGrid[t] && (e = t);
                    (0 > e || "undefined" == typeof e) && (e = 0), n = Math.floor(e / b.params.slidesPerGroup), n >= b.snapGrid.length && (n = b.snapGrid.length - 1), e !== b.activeIndex && (b.snapIndex = n, b.previousIndex = b.activeIndex, b.activeIndex = e, b.updateClasses())
                }, b.updateClasses = function () {
                    b.slides.removeClass(b.params.slideActiveClass + " " + b.params.slideNextClass + " " + b.params.slidePrevClass);
                    var e = b.slides.eq(b.activeIndex);
                    e.addClass(b.params.slideActiveClass);
                    var n = e.next("." + b.params.slideClass).addClass(b.params.slideNextClass);
                    b.params.loop && 0 === n.length && b.slides.eq(0).addClass(b.params.slideNextClass);
                    var i = e.prev("." + b.params.slideClass).addClass(b.params.slidePrevClass);
                    if (b.params.loop && 0 === i.length && b.slides.eq(-1).addClass(b.params.slidePrevClass), b.paginationContainer && b.paginationContainer.length > 0) {
                        var a, r = b.params.loop ? Math.ceil((b.slides.length - 2 * b.loopedSlides) / b.params.slidesPerGroup) : b.snapGrid.length;
                        if (b.params.loop ? (a = Math.ceil((b.activeIndex - b.loopedSlides) / b.params.slidesPerGroup), a > b.slides.length - 1 - 2 * b.loopedSlides && (a -= b.slides.length - 2 * b.loopedSlides), a > r - 1 && (a -= r), 0 > a && "bullets" !== b.params.paginationType && (a = r + a)) : a = "undefined" != typeof b.snapIndex ? b.snapIndex : b.activeIndex || 0, "bullets" === b.params.paginationType && b.bullets && b.bullets.length > 0 && (b.bullets.removeClass(b.params.bulletActiveClass), b.paginationContainer.length > 1 ? b.bullets.each(function () {
                                    t(this).index() === a && t(this).addClass(b.params.bulletActiveClass)
                                }) : b.bullets.eq(a).addClass(b.params.bulletActiveClass)), "fraction" === b.params.paginationType && (b.paginationContainer.find("." + b.params.paginationCurrentClass).text(a + 1), b.paginationContainer.find("." + b.params.paginationTotalClass).text(r)), "progress" === b.params.paginationType) {
                            var o = (a + 1) / r, s = o, l = 1;
                            b.isHorizontal() || (l = o, s = 1), b.paginationContainer.find("." + b.params.paginationProgressbarClass).transform("translate3d(0,0,0) scaleX(" + s + ") scaleY(" + l + ")").transition(b.params.speed)
                        }
                        "custom" === b.params.paginationType && b.params.paginationCustomRender && (b.paginationContainer.html(b.params.paginationCustomRender(b, a + 1, r)), b.emit("onPaginationRendered", b, b.paginationContainer[0]))
                    }
                    b.params.loop || (b.params.prevButton && b.prevButton && b.prevButton.length > 0 && (b.isBeginning ? (b.prevButton.addClass(b.params.buttonDisabledClass), b.params.a11y && b.a11y && b.a11y.disable(b.prevButton)) : (b.prevButton.removeClass(b.params.buttonDisabledClass), b.params.a11y && b.a11y && b.a11y.enable(b.prevButton))), b.params.nextButton && b.nextButton && b.nextButton.length > 0 && (b.isEnd ? (b.nextButton.addClass(b.params.buttonDisabledClass), b.params.a11y && b.a11y && b.a11y.disable(b.nextButton)) : (b.nextButton.removeClass(b.params.buttonDisabledClass), b.params.a11y && b.a11y && b.a11y.enable(b.nextButton))))
                }, b.updatePagination = function () {
                    if (b.params.pagination && b.paginationContainer && b.paginationContainer.length > 0) {
                        var e = "";
                        if ("bullets" === b.params.paginationType) {
                            for (var t = b.params.loop ? Math.ceil((b.slides.length - 2 * b.loopedSlides) / b.params.slidesPerGroup) : b.snapGrid.length, n = 0; t > n; n++)e += b.params.paginationBulletRender ? b.params.paginationBulletRender(n, b.params.bulletClass) : "<" + b.params.paginationElement + ' class="' + b.params.bulletClass + '"></' + b.params.paginationElement + ">";
                            b.paginationContainer.html(e), b.bullets = b.paginationContainer.find("." + b.params.bulletClass), b.params.paginationClickable && b.params.a11y && b.a11y && b.a11y.initPagination()
                        }
                        "fraction" === b.params.paginationType && (e = b.params.paginationFractionRender ? b.params.paginationFractionRender(b, b.params.paginationCurrentClass, b.params.paginationTotalClass) : '<span class="' + b.params.paginationCurrentClass + '"></span> / <span class="' + b.params.paginationTotalClass + '"></span>', b.paginationContainer.html(e)), "progress" === b.params.paginationType && (e = b.params.paginationProgressRender ? b.params.paginationProgressRender(b, b.params.paginationProgressbarClass) : '<span class="' + b.params.paginationProgressbarClass + '"></span>', b.paginationContainer.html(e)), "custom" !== b.params.paginationType && b.emit("onPaginationRendered", b, b.paginationContainer[0])
                    }
                }, b.update = function (e) {
                    function t() {
                        i = Math.min(Math.max(b.translate, b.maxTranslate()), b.minTranslate()), b.setWrapperTranslate(i), b.updateActiveIndex(), b.updateClasses()
                    }

                    if (b.updateContainerSize(), b.updateSlidesSize(), b.updateProgress(), b.updatePagination(), b.updateClasses(), b.params.scrollbar && b.scrollbar && b.scrollbar.set(), e) {
                        var n, i;
                        b.controller && b.controller.spline && (b.controller.spline = void 0), b.params.freeMode ? (t(), b.params.autoHeight && b.updateAutoHeight()) : (n = ("auto" === b.params.slidesPerView || b.params.slidesPerView > 1) && b.isEnd && !b.params.centeredSlides ? b.slideTo(b.slides.length - 1, 0, !1, !0) : b.slideTo(b.activeIndex, 0, !1, !0), n || t())
                    } else b.params.autoHeight && b.updateAutoHeight()
                }, b.onResize = function (e) {
                    b.params.breakpoints && b.setBreakpoint();
                    var t = b.params.allowSwipeToPrev, n = b.params.allowSwipeToNext;
                    b.params.allowSwipeToPrev = b.params.allowSwipeToNext = !0, b.updateContainerSize(), b.updateSlidesSize(), ("auto" === b.params.slidesPerView || b.params.freeMode || e) && b.updatePagination(), b.params.scrollbar && b.scrollbar && b.scrollbar.set(), b.controller && b.controller.spline && (b.controller.spline = void 0);
                    var i = !1;
                    if (b.params.freeMode) {
                        var a = Math.min(Math.max(b.translate, b.maxTranslate()), b.minTranslate());
                        b.setWrapperTranslate(a), b.updateActiveIndex(), b.updateClasses(), b.params.autoHeight && b.updateAutoHeight()
                    } else b.updateClasses(), i = ("auto" === b.params.slidesPerView || b.params.slidesPerView > 1) && b.isEnd && !b.params.centeredSlides ? b.slideTo(b.slides.length - 1, 0, !1, !0) : b.slideTo(b.activeIndex, 0, !1, !0);
                    b.params.lazyLoading && !i && b.lazy && b.lazy.load(), b.params.allowSwipeToPrev = t, b.params.allowSwipeToNext = n
                };
                var T = ["mousedown", "mousemove", "mouseup"];
                window.navigator.pointerEnabled ? T = ["pointerdown", "pointermove", "pointerup"] : window.navigator.msPointerEnabled && (T = ["MSPointerDown", "MSPointerMove", "MSPointerUp"]), b.touchEvents = {
                    start: b.support.touch || !b.params.simulateTouch ? "touchstart" : T[0],
                    move: b.support.touch || !b.params.simulateTouch ? "touchmove" : T[1],
                    end: b.support.touch || !b.params.simulateTouch ? "touchend" : T[2]
                }, (window.navigator.pointerEnabled || window.navigator.msPointerEnabled) && ("container" === b.params.touchEventsTarget ? b.container : b.wrapper).addClass("swiper-wp8-" + b.params.direction), b.initEvents = function (e) {
                    var t = e ? "off" : "on", n = e ? "removeEventListener" : "addEventListener", i = "container" === b.params.touchEventsTarget ? b.container[0] : b.wrapper[0], r = b.support.touch ? i : document, o = b.params.nested ? !0 : !1;
                    b.browser.ie ? (i[n](b.touchEvents.start, b.onTouchStart, !1), r[n](b.touchEvents.move, b.onTouchMove, o), r[n](b.touchEvents.end, b.onTouchEnd, !1)) : (b.support.touch && (i[n](b.touchEvents.start, b.onTouchStart, !1), i[n](b.touchEvents.move, b.onTouchMove, o), i[n](b.touchEvents.end, b.onTouchEnd, !1)), !a.simulateTouch || b.device.ios || b.device.android || (i[n]("mousedown", b.onTouchStart, !1), document[n]("mousemove", b.onTouchMove, o), document[n]("mouseup", b.onTouchEnd, !1))), window[n]("resize", b.onResize), b.params.nextButton && b.nextButton && b.nextButton.length > 0 && (b.nextButton[t]("click", b.onClickNext), b.params.a11y && b.a11y && b.nextButton[t]("keydown", b.a11y.onEnterKey)), b.params.prevButton && b.prevButton && b.prevButton.length > 0 && (b.prevButton[t]("click", b.onClickPrev), b.params.a11y && b.a11y && b.prevButton[t]("keydown", b.a11y.onEnterKey)), b.params.pagination && b.params.paginationClickable && (b.paginationContainer[t]("click", "." + b.params.bulletClass, b.onClickIndex), b.params.a11y && b.a11y && b.paginationContainer[t]("keydown", "." + b.params.bulletClass, b.a11y.onEnterKey)), (b.params.preventClicks || b.params.preventClicksPropagation) && i[n]("click", b.preventClicks, !0)
                }, b.attachEvents = function () {
                    b.initEvents()
                }, b.detachEvents = function () {
                    b.initEvents(!0)
                }, b.allowClick = !0, b.preventClicks = function (e) {
                    b.allowClick || (b.params.preventClicks && e.preventDefault(), b.params.preventClicksPropagation && b.animating && (e.stopPropagation(), e.stopImmediatePropagation()))
                }, b.onClickNext = function (e) {
                    e.preventDefault(), (!b.isEnd || b.params.loop) && b.slideNext()
                }, b.onClickPrev = function (e) {
                    e.preventDefault(), (!b.isBeginning || b.params.loop) && b.slidePrev()
                }, b.onClickIndex = function (e) {
                    e.preventDefault();
                    var n = t(this).index() * b.params.slidesPerGroup;
                    b.params.loop && (n += b.loopedSlides), b.slideTo(n)
                }, b.updateClickedSlide = function (e) {
                    var n = s(e, "." + b.params.slideClass), i = !1;
                    if (n)for (var a = 0; a < b.slides.length; a++)b.slides[a] === n && (i = !0);
                    if (!n || !i)return b.clickedSlide = void 0, void(b.clickedIndex = void 0);
                    if (b.clickedSlide = n, b.clickedIndex = t(n).index(), b.params.slideToClickedSlide && void 0 !== b.clickedIndex && b.clickedIndex !== b.activeIndex) {
                        var r, o = b.clickedIndex;
                        if (b.params.loop) {
                            if (b.animating)return;
                            r = t(b.clickedSlide).attr("data-swiper-slide-index"), b.params.centeredSlides ? o < b.loopedSlides - b.params.slidesPerView / 2 || o > b.slides.length - b.loopedSlides + b.params.slidesPerView / 2 ? (b.fixLoop(), o = b.wrapper.children("." + b.params.slideClass + '[data-swiper-slide-index="' + r + '"]:not(.swiper-slide-duplicate)').eq(0).index(), setTimeout(function () {
                                        b.slideTo(o)
                                    }, 0)) : b.slideTo(o) : o > b.slides.length - b.params.slidesPerView ? (b.fixLoop(), o = b.wrapper.children("." + b.params.slideClass + '[data-swiper-slide-index="' + r + '"]:not(.swiper-slide-duplicate)').eq(0).index(), setTimeout(function () {
                                        b.slideTo(o)
                                    }, 0)) : b.slideTo(o)
                        } else b.slideTo(o)
                    }
                };
                var C, S, E, k, N, D, M, A, I, L, $ = "input, select, textarea, button", P = Date.now(), z = [];
                b.animating = !1, b.touches = {startX: 0, startY: 0, currentX: 0, currentY: 0, diff: 0};
                var H, B;
                if (b.onTouchStart = function (e) {
                        if (e.originalEvent && (e = e.originalEvent), H = "touchstart" === e.type, H || !("which" in e) || 3 !== e.which) {
                            if (b.params.noSwiping && s(e, "." + b.params.noSwipingClass))return void(b.allowClick = !0);
                            if (!b.params.swipeHandler || s(e, b.params.swipeHandler)) {
                                var n = b.touches.currentX = "touchstart" === e.type ? e.targetTouches[0].pageX : e.pageX, i = b.touches.currentY = "touchstart" === e.type ? e.targetTouches[0].pageY : e.pageY;
                                if (!(b.device.ios && b.params.iOSEdgeSwipeDetection && n <= b.params.iOSEdgeSwipeThreshold)) {
                                    if (C = !0, S = !1, E = !0, N = void 0, B = void 0, b.touches.startX = n, b.touches.startY = i, k = Date.now(), b.allowClick = !0, b.updateContainerSize(), b.swipeDirection = void 0, b.params.threshold > 0 && (A = !1), "touchstart" !== e.type) {
                                        var a = !0;
                                        t(e.target).is($) && (a = !1), document.activeElement && t(document.activeElement).is($) && document.activeElement.blur(), a && e.preventDefault()
                                    }
                                    b.emit("onTouchStart", b, e)
                                }
                            }
                        }
                    }, b.onTouchMove = function (e) {
                        if (e.originalEvent && (e = e.originalEvent), !H || "mousemove" !== e.type) {
                            if (e.preventedByNestedSwiper)return b.touches.startX = "touchmove" === e.type ? e.targetTouches[0].pageX : e.pageX, void(b.touches.startY = "touchmove" === e.type ? e.targetTouches[0].pageY : e.pageY);
                            if (b.params.onlyExternal)return b.allowClick = !1, void(C && (b.touches.startX = b.touches.currentX = "touchmove" === e.type ? e.targetTouches[0].pageX : e.pageX, b.touches.startY = b.touches.currentY = "touchmove" === e.type ? e.targetTouches[0].pageY : e.pageY, k = Date.now()));
                            if (H && document.activeElement && e.target === document.activeElement && t(e.target).is($))return S = !0, void(b.allowClick = !1);
                            if (E && b.emit("onTouchMove", b, e), !(e.targetTouches && e.targetTouches.length > 1)) {
                                if (b.touches.currentX = "touchmove" === e.type ? e.targetTouches[0].pageX : e.pageX, b.touches.currentY = "touchmove" === e.type ? e.targetTouches[0].pageY : e.pageY, "undefined" == typeof N) {
                                    var n = 180 * Math.atan2(Math.abs(b.touches.currentY - b.touches.startY), Math.abs(b.touches.currentX - b.touches.startX)) / Math.PI;
                                    N = b.isHorizontal() ? n > b.params.touchAngle : 90 - n > b.params.touchAngle
                                }
                                if (N && b.emit("onTouchMoveOpposite", b, e), "undefined" == typeof B && b.browser.ieTouch && (b.touches.currentX !== b.touches.startX || b.touches.currentY !== b.touches.startY) && (B = !0), C) {
                                    if (N)return void(C = !1);
                                    if (B || !b.browser.ieTouch) {
                                        b.allowClick = !1, b.emit("onSliderMove", b, e), e.preventDefault(), b.params.touchMoveStopPropagation && !b.params.nested && e.stopPropagation(), S || (a.loop && b.fixLoop(), M = b.getWrapperTranslate(), b.setWrapperTransition(0), b.animating && b.wrapper.trigger("webkitTransitionEnd transitionend oTransitionEnd MSTransitionEnd msTransitionEnd"), b.params.autoplay && b.autoplaying && (b.params.autoplayDisableOnInteraction ? b.stopAutoplay() : b.pauseAutoplay()), L = !1, b.params.grabCursor && (b.container[0].style.cursor = "move", b.container[0].style.cursor = "-webkit-grabbing", b.container[0].style.cursor = "-moz-grabbin", b.container[0].style.cursor = "grabbing")), S = !0;
                                        var i = b.touches.diff = b.isHorizontal() ? b.touches.currentX - b.touches.startX : b.touches.currentY - b.touches.startY;
                                        i *= b.params.touchRatio, b.rtl && (i = -i), b.swipeDirection = i > 0 ? "prev" : "next", D = i + M;
                                        var r = !0;
                                        if (i > 0 && D > b.minTranslate() ? (r = !1, b.params.resistance && (D = b.minTranslate() - 1 + Math.pow(-b.minTranslate() + M + i, b.params.resistanceRatio))) : 0 > i && D < b.maxTranslate() && (r = !1, b.params.resistance && (D = b.maxTranslate() + 1 - Math.pow(b.maxTranslate() - M - i, b.params.resistanceRatio))), r && (e.preventedByNestedSwiper = !0), !b.params.allowSwipeToNext && "next" === b.swipeDirection && M > D && (D = M), !b.params.allowSwipeToPrev && "prev" === b.swipeDirection && D > M && (D = M), b.params.followFinger) {
                                            if (b.params.threshold > 0) {
                                                if (!(Math.abs(i) > b.params.threshold || A))return void(D = M);
                                                if (!A)return A = !0, b.touches.startX = b.touches.currentX, b.touches.startY = b.touches.currentY, D = M, void(b.touches.diff = b.isHorizontal() ? b.touches.currentX - b.touches.startX : b.touches.currentY - b.touches.startY)
                                            }
                                            (b.params.freeMode || b.params.watchSlidesProgress) && b.updateActiveIndex(), b.params.freeMode && (0 === z.length && z.push({
                                                position: b.touches[b.isHorizontal() ? "startX" : "startY"],
                                                time: k
                                            }), z.push({
                                                position: b.touches[b.isHorizontal() ? "currentX" : "currentY"],
                                                time: (new window.Date).getTime()
                                            })), b.updateProgress(D), b.setWrapperTranslate(D)
                                        }
                                    }
                                }
                            }
                        }
                    }, b.onTouchEnd = function (e) {
                        if (e.originalEvent && (e = e.originalEvent), E && b.emit("onTouchEnd", b, e), E = !1, C) {
                            b.params.grabCursor && S && C && (b.container[0].style.cursor = "move", b.container[0].style.cursor = "-webkit-grab", b.container[0].style.cursor = "-moz-grab", b.container[0].style.cursor = "grab");
                            var n = Date.now(), i = n - k;
                            if (b.allowClick && (b.updateClickedSlide(e), b.emit("onTap", b, e), 300 > i && n - P > 300 && (I && clearTimeout(I), I = setTimeout(function () {
                                    b && (b.params.paginationHide && b.paginationContainer.length > 0 && !t(e.target).hasClass(b.params.bulletClass) && b.paginationContainer.toggleClass(b.params.paginationHiddenClass), b.emit("onClick", b, e))
                                }, 300)), 300 > i && 300 > n - P && (I && clearTimeout(I), b.emit("onDoubleTap", b, e))), P = Date.now(), setTimeout(function () {
                                    b && (b.allowClick = !0)
                                }, 0), !C || !S || !b.swipeDirection || 0 === b.touches.diff || D === M)return void(C = S = !1);
                            C = S = !1;
                            var a;
                            if (a = b.params.followFinger ? b.rtl ? b.translate : -b.translate : -D, b.params.freeMode) {
                                if (a < -b.minTranslate())return void b.slideTo(b.activeIndex);
                                if (a > -b.maxTranslate())return void(b.slides.length < b.snapGrid.length ? b.slideTo(b.snapGrid.length - 1) : b.slideTo(b.slides.length - 1));
                                if (b.params.freeModeMomentum) {
                                    if (z.length > 1) {
                                        var r = z.pop(), o = z.pop(), s = r.position - o.position, l = r.time - o.time;
                                        b.velocity = s / l, b.velocity = b.velocity / 2, Math.abs(b.velocity) < b.params.freeModeMinimumVelocity && (b.velocity = 0), (l > 150 || (new window.Date).getTime() - r.time > 300) && (b.velocity = 0)
                                    } else b.velocity = 0;
                                    z.length = 0;
                                    var d = 1e3 * b.params.freeModeMomentumRatio, u = b.velocity * d, p = b.translate + u;
                                    b.rtl && (p = -p);
                                    var c, f = !1, h = 20 * Math.abs(b.velocity) * b.params.freeModeMomentumBounceRatio;
                                    if (p < b.maxTranslate()) b.params.freeModeMomentumBounce ? (p + b.maxTranslate() < -h && (p = b.maxTranslate() - h), c = b.maxTranslate(), f = !0, L = !0) : p = b.maxTranslate(); else if (p > b.minTranslate()) b.params.freeModeMomentumBounce ? (p - b.minTranslate() > h && (p = b.minTranslate() + h), c = b.minTranslate(), f = !0, L = !0) : p = b.minTranslate(); else if (b.params.freeModeSticky) {
                                        var m, g = 0;
                                        for (g = 0; g < b.snapGrid.length; g += 1)if (b.snapGrid[g] > -p) {
                                            m = g;
                                            break
                                        }
                                        p = Math.abs(b.snapGrid[m] - p) < Math.abs(b.snapGrid[m - 1] - p) || "next" === b.swipeDirection ? b.snapGrid[m] : b.snapGrid[m - 1], b.rtl || (p = -p)
                                    }
                                    if (0 !== b.velocity) d = b.rtl ? Math.abs((-p - b.translate) / b.velocity) : Math.abs((p - b.translate) / b.velocity); else if (b.params.freeModeSticky)return void b.slideReset();
                                    b.params.freeModeMomentumBounce && f ? (b.updateProgress(c), b.setWrapperTransition(d), b.setWrapperTranslate(p), b.onTransitionStart(), b.animating = !0, b.wrapper.transitionEnd(function () {
                                            b && L && (b.emit("onMomentumBounce", b), b.setWrapperTransition(b.params.speed), b.setWrapperTranslate(c), b.wrapper.transitionEnd(function () {
                                                b && b.onTransitionEnd()
                                            }))
                                        })) : b.velocity ? (b.updateProgress(p), b.setWrapperTransition(d), b.setWrapperTranslate(p), b.onTransitionStart(), b.animating || (b.animating = !0, b.wrapper.transitionEnd(function () {
                                                b && b.onTransitionEnd()
                                            }))) : b.updateProgress(p), b.updateActiveIndex()
                                }
                                return void((!b.params.freeModeMomentum || i >= b.params.longSwipesMs) && (b.updateProgress(), b.updateActiveIndex()))
                            }
                            var v, y = 0, w = b.slidesSizesGrid[0];
                            for (v = 0; v < b.slidesGrid.length; v += b.params.slidesPerGroup)"undefined" != typeof b.slidesGrid[v + b.params.slidesPerGroup] ? a >= b.slidesGrid[v] && a < b.slidesGrid[v + b.params.slidesPerGroup] && (y = v, w = b.slidesGrid[v + b.params.slidesPerGroup] - b.slidesGrid[v]) : a >= b.slidesGrid[v] && (y = v, w = b.slidesGrid[b.slidesGrid.length - 1] - b.slidesGrid[b.slidesGrid.length - 2]);
                            var x = (a - b.slidesGrid[y]) / w;
                            if (i > b.params.longSwipesMs) {
                                if (!b.params.longSwipes)return void b.slideTo(b.activeIndex);
                                "next" === b.swipeDirection && (x >= b.params.longSwipesRatio ? b.slideTo(y + b.params.slidesPerGroup) : b.slideTo(y)), "prev" === b.swipeDirection && (x > 1 - b.params.longSwipesRatio ? b.slideTo(y + b.params.slidesPerGroup) : b.slideTo(y))
                            } else {
                                if (!b.params.shortSwipes)return void b.slideTo(b.activeIndex);
                                "next" === b.swipeDirection && b.slideTo(y + b.params.slidesPerGroup), "prev" === b.swipeDirection && b.slideTo(y)
                            }
                        }
                    }, b._slideTo = function (e, t) {
                        return b.slideTo(e, t, !0, !0)
                    }, b.slideTo = function (e, t, n, i) {
                        "undefined" == typeof n && (n = !0), "undefined" == typeof e && (e = 0), 0 > e && (e = 0), b.snapIndex = Math.floor(e / b.params.slidesPerGroup), b.snapIndex >= b.snapGrid.length && (b.snapIndex = b.snapGrid.length - 1);
                        var a = -b.snapGrid[b.snapIndex];
                        b.params.autoplay && b.autoplaying && (i || !b.params.autoplayDisableOnInteraction ? b.pauseAutoplay(t) : b.stopAutoplay()), b.updateProgress(a);
                        for (var r = 0; r < b.slidesGrid.length; r++)-Math.floor(100 * a) >= Math.floor(100 * b.slidesGrid[r]) && (e = r);
                        return !b.params.allowSwipeToNext && a < b.translate && a < b.minTranslate() ? !1 : !b.params.allowSwipeToPrev && a > b.translate && a > b.maxTranslate() && (b.activeIndex || 0) !== e ? !1 : ("undefined" == typeof t && (t = b.params.speed), b.previousIndex = b.activeIndex || 0, b.activeIndex = e, b.rtl && -a === b.translate || !b.rtl && a === b.translate ? (b.params.autoHeight && b.updateAutoHeight(), b.updateClasses(), "slide" !== b.params.effect && b.setWrapperTranslate(a), !1) : (b.updateClasses(), b.onTransitionStart(n), 0 === t ? (b.setWrapperTranslate(a), b.setWrapperTransition(0), b.onTransitionEnd(n)) : (b.setWrapperTranslate(a), b.setWrapperTransition(t), b.animating || (b.animating = !0, b.wrapper.transitionEnd(function () {
                                            b && b.onTransitionEnd(n)
                                        }))), !0))
                    }, b.onTransitionStart = function (e) {
                        "undefined" == typeof e && (e = !0), b.params.autoHeight && b.updateAutoHeight(), b.lazy && b.lazy.onTransitionStart(), e && (b.emit("onTransitionStart", b), b.activeIndex !== b.previousIndex && (b.emit("onSlideChangeStart", b), b.activeIndex > b.previousIndex ? b.emit("onSlideNextStart", b) : b.emit("onSlidePrevStart", b)))
                    }, b.onTransitionEnd = function (e) {
                        b.animating = !1, b.setWrapperTransition(0), "undefined" == typeof e && (e = !0), b.lazy && b.lazy.onTransitionEnd(), e && (b.emit("onTransitionEnd", b), b.activeIndex !== b.previousIndex && (b.emit("onSlideChangeEnd", b), b.activeIndex > b.previousIndex ? b.emit("onSlideNextEnd", b) : b.emit("onSlidePrevEnd", b))), b.params.hashnav && b.hashnav && b.hashnav.setHash()
                    }, b.slideNext = function (e, t, n) {
                        return b.params.loop ? b.animating ? !1 : (b.fixLoop(), b.container[0].clientLeft, b.slideTo(b.activeIndex + b.params.slidesPerGroup, t, e, n)) : b.slideTo(b.activeIndex + b.params.slidesPerGroup, t, e, n)
                    }, b._slideNext = function (e) {
                        return b.slideNext(!0, e, !0)
                    }, b.slidePrev = function (e, t, n) {
                        return b.params.loop ? b.animating ? !1 : (b.fixLoop(), b.container[0].clientLeft, b.slideTo(b.activeIndex - 1, t, e, n)) : b.slideTo(b.activeIndex - 1, t, e, n)
                    }, b._slidePrev = function (e) {
                        return b.slidePrev(!0, e, !0)
                    }, b.slideReset = function (e, t, n) {
                        return b.slideTo(b.activeIndex, t, e)
                    }, b.setWrapperTransition = function (e, t) {
                        b.wrapper.transition(e), "slide" !== b.params.effect && b.effects[b.params.effect] && b.effects[b.params.effect].setTransition(e), b.params.parallax && b.parallax && b.parallax.setTransition(e), b.params.scrollbar && b.scrollbar && b.scrollbar.setTransition(e), b.params.control && b.controller && b.controller.setTransition(e, t), b.emit("onSetTransition", b, e)
                    }, b.setWrapperTranslate = function (e, t, n) {
                        var i = 0, a = 0, o = 0;
                        b.isHorizontal() ? i = b.rtl ? -e : e : a = e, b.params.roundLengths && (i = r(i), a = r(a)), b.params.virtualTranslate || (b.support.transforms3d ? b.wrapper.transform("translate3d(" + i + "px, " + a + "px, " + o + "px)") : b.wrapper.transform("translate(" + i + "px, " + a + "px)")), b.translate = b.isHorizontal() ? i : a;
                        var s, l = b.maxTranslate() - b.minTranslate();
                        s = 0 === l ? 0 : (e - b.minTranslate()) / l, s !== b.progress && b.updateProgress(e), t && b.updateActiveIndex(), "slide" !== b.params.effect && b.effects[b.params.effect] && b.effects[b.params.effect].setTranslate(b.translate), b.params.parallax && b.parallax && b.parallax.setTranslate(b.translate), b.params.scrollbar && b.scrollbar && b.scrollbar.setTranslate(b.translate), b.params.control && b.controller && b.controller.setTranslate(b.translate, n), b.emit("onSetTranslate", b, b.translate)
                    }, b.getTranslate = function (e, t) {
                        var n, i, a, r;
                        return "undefined" == typeof t && (t = "x"), b.params.virtualTranslate ? b.rtl ? -b.translate : b.translate : (a = window.getComputedStyle(e, null), window.WebKitCSSMatrix ? (i = a.transform || a.webkitTransform, i.split(",").length > 6 && (i = i.split(", ").map(function (e) {
                                    return e.replace(",", ".")
                                }).join(", ")), r = new window.WebKitCSSMatrix("none" === i ? "" : i)) : (r = a.MozTransform || a.OTransform || a.MsTransform || a.msTransform || a.transform || a.getPropertyValue("transform").replace("translate(", "matrix(1, 0, 0, 1,"), n = r.toString().split(",")), "x" === t && (i = window.WebKitCSSMatrix ? r.m41 : 16 === n.length ? parseFloat(n[12]) : parseFloat(n[4])), "y" === t && (i = window.WebKitCSSMatrix ? r.m42 : 16 === n.length ? parseFloat(n[13]) : parseFloat(n[5])), b.rtl && i && (i = -i), i || 0)
                    }, b.getWrapperTranslate = function (e) {
                        return "undefined" == typeof e && (e = b.isHorizontal() ? "x" : "y"), b.getTranslate(b.wrapper[0], e)
                    }, b.observers = [], b.initObservers = function () {
                        if (b.params.observeParents)for (var e = b.container.parents(), t = 0; t < e.length; t++)l(e[t]);
                        l(b.container[0], {childList: !1}), l(b.wrapper[0], {attributes: !1})
                    }, b.disconnectObservers = function () {
                        for (var e = 0; e < b.observers.length; e++)b.observers[e].disconnect();
                        b.observers = []
                    }, b.createLoop = function () {
                        b.wrapper.children("." + b.params.slideClass + "." + b.params.slideDuplicateClass).remove();
                        var e = b.wrapper.children("." + b.params.slideClass);
                        "auto" !== b.params.slidesPerView || b.params.loopedSlides || (b.params.loopedSlides = e.length), b.loopedSlides = parseInt(b.params.loopedSlides || b.params.slidesPerView, 10), b.loopedSlides = b.loopedSlides + b.params.loopAdditionalSlides, b.loopedSlides > e.length && (b.loopedSlides = e.length);
                        var n, i = [], a = [];
                        for (e.each(function (n, r) {
                            var o = t(this);
                            n < b.loopedSlides && a.push(r), n < e.length && n >= e.length - b.loopedSlides && i.push(r), o.attr("data-swiper-slide-index", n)
                        }), n = 0; n < a.length; n++)b.wrapper.append(t(a[n].cloneNode(!0)).addClass(b.params.slideDuplicateClass));
                        for (n = i.length - 1; n >= 0; n--)b.wrapper.prepend(t(i[n].cloneNode(!0)).addClass(b.params.slideDuplicateClass))
                    }, b.destroyLoop = function () {
                        b.wrapper.children("." + b.params.slideClass + "." + b.params.slideDuplicateClass).remove(), b.slides.removeAttr("data-swiper-slide-index")
                    }, b.reLoop = function (e) {
                        var t = b.activeIndex - b.loopedSlides;
                        b.destroyLoop(), b.createLoop(), b.updateSlidesSize(), e && b.slideTo(t + b.loopedSlides, 0, !1)
                    }, b.fixLoop = function () {
                        var e;
                        b.activeIndex < b.loopedSlides ? (e = b.slides.length - 3 * b.loopedSlides + b.activeIndex, e += b.loopedSlides, b.slideTo(e, 0, !1, !0)) : ("auto" === b.params.slidesPerView && b.activeIndex >= 2 * b.loopedSlides || b.activeIndex > b.slides.length - 2 * b.params.slidesPerView) && (e = -b.slides.length + b.activeIndex + b.loopedSlides, e += b.loopedSlides, b.slideTo(e, 0, !1, !0))
                    }, b.appendSlide = function (e) {
                        if (b.params.loop && b.destroyLoop(), "object" == typeof e && e.length)for (var t = 0; t < e.length; t++)e[t] && b.wrapper.append(e[t]); else b.wrapper.append(e);
                        b.params.loop && b.createLoop(), b.params.observer && b.support.observer || b.update(!0)
                    }, b.prependSlide = function (e) {
                        b.params.loop && b.destroyLoop();
                        var t = b.activeIndex + 1;
                        if ("object" == typeof e && e.length) {
                            for (var n = 0; n < e.length; n++)e[n] && b.wrapper.prepend(e[n]);
                            t = b.activeIndex + e.length
                        } else b.wrapper.prepend(e);
                        b.params.loop && b.createLoop(), b.params.observer && b.support.observer || b.update(!0), b.slideTo(t, 0, !1)
                    }, b.removeSlide = function (e) {
                        b.params.loop && (b.destroyLoop(), b.slides = b.wrapper.children("." + b.params.slideClass));
                        var t, n = b.activeIndex;
                        if ("object" == typeof e && e.length) {
                            for (var i = 0; i < e.length; i++)t = e[i], b.slides[t] && b.slides.eq(t).remove(), n > t && n--;
                            n = Math.max(n, 0)
                        } else t = e, b.slides[t] && b.slides.eq(t).remove(), n > t && n--, n = Math.max(n, 0);
                        b.params.loop && b.createLoop(), b.params.observer && b.support.observer || b.update(!0), b.params.loop ? b.slideTo(n + b.loopedSlides, 0, !1) : b.slideTo(n, 0, !1)
                    }, b.removeAllSlides = function () {
                        for (var e = [], t = 0; t < b.slides.length; t++)e.push(t);
                        b.removeSlide(e)
                    }, b.effects = {
                        fade: {
                            setTranslate: function () {
                                for (var e = 0; e < b.slides.length; e++) {
                                    var t = b.slides.eq(e), n = t[0].swiperSlideOffset, i = -n;
                                    b.params.virtualTranslate || (i -= b.translate);
                                    var a = 0;
                                    b.isHorizontal() || (a = i, i = 0);
                                    var r = b.params.fade.crossFade ? Math.max(1 - Math.abs(t[0].progress), 0) : 1 + Math.min(Math.max(t[0].progress, -1), 0);
                                    t.css({opacity: r}).transform("translate3d(" + i + "px, " + a + "px, 0px)")
                                }
                            }, setTransition: function (e) {
                                if (b.slides.transition(e), b.params.virtualTranslate && 0 !== e) {
                                    var t = !1;
                                    b.slides.transitionEnd(function () {
                                        if (!t && b) {
                                            t = !0, b.animating = !1;
                                            for (var e = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"], n = 0; n < e.length; n++)b.wrapper.trigger(e[n])
                                        }
                                    })
                                }
                            }
                        }, flip: {
                            setTranslate: function () {
                                for (var e = 0; e < b.slides.length; e++) {
                                    var n = b.slides.eq(e), i = n[0].progress;
                                    b.params.flip.limitRotation && (i = Math.max(Math.min(n[0].progress, 1), -1));
                                    var a = n[0].swiperSlideOffset, r = -180 * i, o = r, s = 0, l = -a, d = 0;
                                    if (b.isHorizontal() ? b.rtl && (o = -o) : (d = l, l = 0, s = -o, o = 0), n[0].style.zIndex = -Math.abs(Math.round(i)) + b.slides.length, b.params.flip.slideShadows) {
                                        var u = b.isHorizontal() ? n.find(".swiper-slide-shadow-left") : n.find(".swiper-slide-shadow-top"), p = b.isHorizontal() ? n.find(".swiper-slide-shadow-right") : n.find(".swiper-slide-shadow-bottom");
                                        0 === u.length && (u = t('<div class="swiper-slide-shadow-' + (b.isHorizontal() ? "left" : "top") + '"></div>'), n.append(u)), 0 === p.length && (p = t('<div class="swiper-slide-shadow-' + (b.isHorizontal() ? "right" : "bottom") + '"></div>'), n.append(p)), u.length && (u[0].style.opacity = Math.max(-i, 0)), p.length && (p[0].style.opacity = Math.max(i, 0))
                                    }
                                    n.transform("translate3d(" + l + "px, " + d + "px, 0px) rotateX(" + s + "deg) rotateY(" + o + "deg)")
                                }
                            }, setTransition: function (e) {
                                if (b.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e), b.params.virtualTranslate && 0 !== e) {
                                    var n = !1;
                                    b.slides.eq(b.activeIndex).transitionEnd(function () {
                                        if (!n && b && t(this).hasClass(b.params.slideActiveClass)) {
                                            n = !0, b.animating = !1;
                                            for (var e = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"], i = 0; i < e.length; i++)b.wrapper.trigger(e[i])
                                        }
                                    })
                                }
                            }
                        }, cube: {
                            setTranslate: function () {
                                var e, n = 0;
                                b.params.cube.shadow && (b.isHorizontal() ? (e = b.wrapper.find(".swiper-cube-shadow"), 0 === e.length && (e = t('<div class="swiper-cube-shadow"></div>'), b.wrapper.append(e)), e.css({height: b.width + "px"})) : (e = b.container.find(".swiper-cube-shadow"), 0 === e.length && (e = t('<div class="swiper-cube-shadow"></div>'), b.container.append(e))));
                                for (var i = 0; i < b.slides.length; i++) {
                                    var a = b.slides.eq(i), r = 90 * i, o = Math.floor(r / 360);
                                    b.rtl && (r = -r, o = Math.floor(-r / 360));
                                    var s = Math.max(Math.min(a[0].progress, 1), -1), l = 0, d = 0, u = 0;
                                    i % 4 === 0 ? (l = 4 * -o * b.size, u = 0) : (i - 1) % 4 === 0 ? (l = 0, u = 4 * -o * b.size) : (i - 2) % 4 === 0 ? (l = b.size + 4 * o * b.size, u = b.size) : (i - 3) % 4 === 0 && (l = -b.size, u = 3 * b.size + 4 * b.size * o), b.rtl && (l = -l), b.isHorizontal() || (d = l, l = 0);
                                    var p = "rotateX(" + (b.isHorizontal() ? 0 : -r) + "deg) rotateY(" + (b.isHorizontal() ? r : 0) + "deg) translate3d(" + l + "px, " + d + "px, " + u + "px)";
                                    if (1 >= s && s > -1 && (n = 90 * i + 90 * s, b.rtl && (n = 90 * -i - 90 * s)), a.transform(p), b.params.cube.slideShadows) {
                                        var c = b.isHorizontal() ? a.find(".swiper-slide-shadow-left") : a.find(".swiper-slide-shadow-top"), f = b.isHorizontal() ? a.find(".swiper-slide-shadow-right") : a.find(".swiper-slide-shadow-bottom");
                                        0 === c.length && (c = t('<div class="swiper-slide-shadow-' + (b.isHorizontal() ? "left" : "top") + '"></div>'), a.append(c)), 0 === f.length && (f = t('<div class="swiper-slide-shadow-' + (b.isHorizontal() ? "right" : "bottom") + '"></div>'), a.append(f)), c.length && (c[0].style.opacity = Math.max(-s, 0)), f.length && (f[0].style.opacity = Math.max(s, 0))
                                    }
                                }
                                if (b.wrapper.css({
                                        "-webkit-transform-origin": "50% 50% -" + b.size / 2 + "px",
                                        "-moz-transform-origin": "50% 50% -" + b.size / 2 + "px",
                                        "-ms-transform-origin": "50% 50% -" + b.size / 2 + "px",
                                        "transform-origin": "50% 50% -" + b.size / 2 + "px"
                                    }), b.params.cube.shadow)if (b.isHorizontal()) e.transform("translate3d(0px, " + (b.width / 2 + b.params.cube.shadowOffset) + "px, " + -b.width / 2 + "px) rotateX(90deg) rotateZ(0deg) scale(" + b.params.cube.shadowScale + ")"); else {
                                    var h = Math.abs(n) - 90 * Math.floor(Math.abs(n) / 90), m = 1.5 - (Math.sin(2 * h * Math.PI / 360) / 2 + Math.cos(2 * h * Math.PI / 360) / 2), g = b.params.cube.shadowScale, v = b.params.cube.shadowScale / m, y = b.params.cube.shadowOffset;
                                    e.transform("scale3d(" + g + ", 1, " + v + ") translate3d(0px, " + (b.height / 2 + y) + "px, " + -b.height / 2 / v + "px) rotateX(-90deg)")
                                }
                                var w = b.isSafari || b.isUiWebView ? -b.size / 2 : 0;
                                b.wrapper.transform("translate3d(0px,0," + w + "px) rotateX(" + (b.isHorizontal() ? 0 : n) + "deg) rotateY(" + (b.isHorizontal() ? -n : 0) + "deg)")
                            }, setTransition: function (e) {
                                b.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e), b.params.cube.shadow && !b.isHorizontal() && b.container.find(".swiper-cube-shadow").transition(e)
                            }
                        }, coverflow: {
                            setTranslate: function () {
                                for (var e = b.translate, n = b.isHorizontal() ? -e + b.width / 2 : -e + b.height / 2, i = b.isHorizontal() ? b.params.coverflow.rotate : -b.params.coverflow.rotate, a = b.params.coverflow.depth, r = 0, o = b.slides.length; o > r; r++) {
                                    var s = b.slides.eq(r), l = b.slidesSizesGrid[r], d = s[0].swiperSlideOffset, u = (n - d - l / 2) / l * b.params.coverflow.modifier, p = b.isHorizontal() ? i * u : 0, c = b.isHorizontal() ? 0 : i * u, f = -a * Math.abs(u), h = b.isHorizontal() ? 0 : b.params.coverflow.stretch * u, m = b.isHorizontal() ? b.params.coverflow.stretch * u : 0;
                                    Math.abs(m) < .001 && (m = 0), Math.abs(h) < .001 && (h = 0), Math.abs(f) < .001 && (f = 0), Math.abs(p) < .001 && (p = 0), Math.abs(c) < .001 && (c = 0);
                                    var g = "translate3d(" + m + "px," + h + "px," + f + "px)  rotateX(" + c + "deg) rotateY(" + p + "deg)";
                                    if (s.transform(g), s[0].style.zIndex = -Math.abs(Math.round(u)) + 1, b.params.coverflow.slideShadows) {
                                        var v = b.isHorizontal() ? s.find(".swiper-slide-shadow-left") : s.find(".swiper-slide-shadow-top"), y = b.isHorizontal() ? s.find(".swiper-slide-shadow-right") : s.find(".swiper-slide-shadow-bottom");
                                        0 === v.length && (v = t('<div class="swiper-slide-shadow-' + (b.isHorizontal() ? "left" : "top") + '"></div>'), s.append(v)), 0 === y.length && (y = t('<div class="swiper-slide-shadow-' + (b.isHorizontal() ? "right" : "bottom") + '"></div>'), s.append(y)), v.length && (v[0].style.opacity = u > 0 ? u : 0), y.length && (y[0].style.opacity = -u > 0 ? -u : 0)
                                    }
                                }
                                if (b.browser.ie) {
                                    var w = b.wrapper[0].style;
                                    w.perspectiveOrigin = n + "px 50%"
                                }
                            }, setTransition: function (e) {
                                b.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e)
                            }
                        }
                    }, b.lazy = {
                        initialImageLoaded: !1, loadImageInSlide: function (e, n) {
                            if ("undefined" != typeof e && ("undefined" == typeof n && (n = !0), 0 !== b.slides.length)) {
                                var i = b.slides.eq(e), a = i.find(".swiper-lazy:not(.swiper-lazy-loaded):not(.swiper-lazy-loading)");
                                !i.hasClass("swiper-lazy") || i.hasClass("swiper-lazy-loaded") || i.hasClass("swiper-lazy-loading") || (a = a.add(i[0])), 0 !== a.length && a.each(function () {
                                    var e = t(this);
                                    e.addClass("swiper-lazy-loading");
                                    var a = e.attr("data-background"), r = e.attr("data-src"), o = e.attr("data-srcset");
                                    b.loadImage(e[0], r || a, o, !1, function () {
                                        if (a ? (e.css("background-image", 'url("' + a + '")'), e.removeAttr("data-background")) : (o && (e.attr("srcset", o), e.removeAttr("data-srcset")), r && (e.attr("src", r), e.removeAttr("data-src"))), e.addClass("swiper-lazy-loaded").removeClass("swiper-lazy-loading"), i.find(".swiper-lazy-preloader, .preloader").remove(), b.params.loop && n) {
                                            var t = i.attr("data-swiper-slide-index");
                                            if (i.hasClass(b.params.slideDuplicateClass)) {
                                                var s = b.wrapper.children('[data-swiper-slide-index="' + t + '"]:not(.' + b.params.slideDuplicateClass + ")");
                                                b.lazy.loadImageInSlide(s.index(), !1)
                                            } else {
                                                var l = b.wrapper.children("." + b.params.slideDuplicateClass + '[data-swiper-slide-index="' + t + '"]');
                                                b.lazy.loadImageInSlide(l.index(), !1)
                                            }
                                        }
                                        b.emit("onLazyImageReady", b, i[0], e[0])
                                    }), b.emit("onLazyImageLoad", b, i[0], e[0])
                                })
                            }
                        }, load: function () {
                            var e;
                            if (b.params.watchSlidesVisibility) b.wrapper.children("." + b.params.slideVisibleClass).each(function () {
                                b.lazy.loadImageInSlide(t(this).index())
                            }); else if (b.params.slidesPerView > 1)for (e = b.activeIndex; e < b.activeIndex + b.params.slidesPerView; e++)b.slides[e] && b.lazy.loadImageInSlide(e); else b.lazy.loadImageInSlide(b.activeIndex);
                            if (b.params.lazyLoadingInPrevNext)if (b.params.slidesPerView > 1 || b.params.lazyLoadingInPrevNextAmount && b.params.lazyLoadingInPrevNextAmount > 1) {
                                var n = b.params.lazyLoadingInPrevNextAmount, i = b.params.slidesPerView, a = Math.min(b.activeIndex + i + Math.max(n, i), b.slides.length), r = Math.max(b.activeIndex - Math.max(i, n), 0);
                                for (e = b.activeIndex + b.params.slidesPerView; a > e; e++)b.slides[e] && b.lazy.loadImageInSlide(e);
                                for (e = r; e < b.activeIndex; e++)b.slides[e] && b.lazy.loadImageInSlide(e)
                            } else {
                                var o = b.wrapper.children("." + b.params.slideNextClass);
                                o.length > 0 && b.lazy.loadImageInSlide(o.index());
                                var s = b.wrapper.children("." + b.params.slidePrevClass);
                                s.length > 0 && b.lazy.loadImageInSlide(s.index())
                            }
                        }, onTransitionStart: function () {
                            b.params.lazyLoading && (b.params.lazyLoadingOnTransitionStart || !b.params.lazyLoadingOnTransitionStart && !b.lazy.initialImageLoaded) && b.lazy.load()
                        }, onTransitionEnd: function () {
                            b.params.lazyLoading && !b.params.lazyLoadingOnTransitionStart && b.lazy.load()
                        }
                    }, b.scrollbar = {
                        isTouched: !1, setDragPosition: function (e) {
                            var t = b.scrollbar, n = b.isHorizontal() ? "touchstart" === e.type || "touchmove" === e.type ? e.targetTouches[0].pageX : e.pageX || e.clientX : "touchstart" === e.type || "touchmove" === e.type ? e.targetTouches[0].pageY : e.pageY || e.clientY, i = n - t.track.offset()[b.isHorizontal() ? "left" : "top"] - t.dragSize / 2, a = -b.minTranslate() * t.moveDivider, r = -b.maxTranslate() * t.moveDivider;
                            a > i ? i = a : i > r && (i = r), i = -i / t.moveDivider, b.updateProgress(i), b.setWrapperTranslate(i, !0)
                        }, dragStart: function (e) {
                            var t = b.scrollbar;
                            t.isTouched = !0, e.preventDefault(), e.stopPropagation(), t.setDragPosition(e), clearTimeout(t.dragTimeout), t.track.transition(0), b.params.scrollbarHide && t.track.css("opacity", 1), b.wrapper.transition(100), t.drag.transition(100), b.emit("onScrollbarDragStart", b)
                        }, dragMove: function (e) {
                            var t = b.scrollbar;
                            t.isTouched && (e.preventDefault ? e.preventDefault() : e.returnValue = !1, t.setDragPosition(e), b.wrapper.transition(0), t.track.transition(0), t.drag.transition(0), b.emit("onScrollbarDragMove", b))
                        }, dragEnd: function (e) {
                            var t = b.scrollbar;
                            t.isTouched && (t.isTouched = !1, b.params.scrollbarHide && (clearTimeout(t.dragTimeout), t.dragTimeout = setTimeout(function () {
                                t.track.css("opacity", 0), t.track.transition(400)
                            }, 1e3)), b.emit("onScrollbarDragEnd", b), b.params.scrollbarSnapOnRelease && b.slideReset())
                        }, enableDraggable: function () {
                            var e = b.scrollbar, n = b.support.touch ? e.track : document;
                            t(e.track).on(b.touchEvents.start, e.dragStart),
                                t(n).on(b.touchEvents.move, e.dragMove), t(n).on(b.touchEvents.end, e.dragEnd)
                        }, disableDraggable: function () {
                            var e = b.scrollbar, n = b.support.touch ? e.track : document;
                            t(e.track).off(b.touchEvents.start, e.dragStart), t(n).off(b.touchEvents.move, e.dragMove), t(n).off(b.touchEvents.end, e.dragEnd)
                        }, set: function () {
                            if (b.params.scrollbar) {
                                var e = b.scrollbar;
                                e.track = t(b.params.scrollbar), b.params.uniqueNavElements && "string" == typeof b.params.scrollbar && e.track.length > 1 && 1 === b.container.find(b.params.scrollbar).length && (e.track = b.container.find(b.params.scrollbar)), e.drag = e.track.find(".swiper-scrollbar-drag"), 0 === e.drag.length && (e.drag = t('<div class="swiper-scrollbar-drag"></div>'), e.track.append(e.drag)), e.drag[0].style.width = "", e.drag[0].style.height = "", e.trackSize = b.isHorizontal() ? e.track[0].offsetWidth : e.track[0].offsetHeight, e.divider = b.size / b.virtualSize, e.moveDivider = e.divider * (e.trackSize / b.size), e.dragSize = e.trackSize * e.divider, b.isHorizontal() ? e.drag[0].style.width = e.dragSize + "px" : e.drag[0].style.height = e.dragSize + "px", e.divider >= 1 ? e.track[0].style.display = "none" : e.track[0].style.display = "", b.params.scrollbarHide && (e.track[0].style.opacity = 0)
                            }
                        }, setTranslate: function () {
                            if (b.params.scrollbar) {
                                var e, t = b.scrollbar, n = (b.translate || 0, t.dragSize);
                                e = (t.trackSize - t.dragSize) * b.progress, b.rtl && b.isHorizontal() ? (e = -e, e > 0 ? (n = t.dragSize - e, e = 0) : -e + t.dragSize > t.trackSize && (n = t.trackSize + e)) : 0 > e ? (n = t.dragSize + e, e = 0) : e + t.dragSize > t.trackSize && (n = t.trackSize - e), b.isHorizontal() ? (b.support.transforms3d ? t.drag.transform("translate3d(" + e + "px, 0, 0)") : t.drag.transform("translateX(" + e + "px)"), t.drag[0].style.width = n + "px") : (b.support.transforms3d ? t.drag.transform("translate3d(0px, " + e + "px, 0)") : t.drag.transform("translateY(" + e + "px)"), t.drag[0].style.height = n + "px"), b.params.scrollbarHide && (clearTimeout(t.timeout), t.track[0].style.opacity = 1, t.timeout = setTimeout(function () {
                                    t.track[0].style.opacity = 0, t.track.transition(400)
                                }, 1e3))
                            }
                        }, setTransition: function (e) {
                            b.params.scrollbar && b.scrollbar.drag.transition(e)
                        }
                    }, b.controller = {
                        LinearSpline: function (e, t) {
                            this.x = e, this.y = t, this.lastIndex = e.length - 1;
                            var n, i;
                            this.x.length, this.interpolate = function (e) {
                                return e ? (i = a(this.x, e), n = i - 1, (e - this.x[n]) * (this.y[i] - this.y[n]) / (this.x[i] - this.x[n]) + this.y[n]) : 0
                            };
                            var a = function () {
                                var e, t, n;
                                return function (i, a) {
                                    for (t = -1, e = i.length; e - t > 1;)i[n = e + t >> 1] <= a ? t = n : e = n;
                                    return e
                                }
                            }()
                        }, getInterpolateFunction: function (e) {
                            b.controller.spline || (b.controller.spline = b.params.loop ? new b.controller.LinearSpline(b.slidesGrid, e.slidesGrid) : new b.controller.LinearSpline(b.snapGrid, e.snapGrid))
                        }, setTranslate: function (e, t) {
                            function i(t) {
                                e = t.rtl && "horizontal" === t.params.direction ? -b.translate : b.translate, "slide" === b.params.controlBy && (b.controller.getInterpolateFunction(t), r = -b.controller.spline.interpolate(-e)), r && "container" !== b.params.controlBy || (a = (t.maxTranslate() - t.minTranslate()) / (b.maxTranslate() - b.minTranslate()), r = (e - b.minTranslate()) * a + t.minTranslate()), b.params.controlInverse && (r = t.maxTranslate() - r), t.updateProgress(r), t.setWrapperTranslate(r, !1, b), t.updateActiveIndex()
                            }

                            var a, r, o = b.params.control;
                            if (b.isArray(o))for (var s = 0; s < o.length; s++)o[s] !== t && o[s] instanceof n && i(o[s]); else o instanceof n && t !== o && i(o)
                        }, setTransition: function (e, t) {
                            function i(t) {
                                t.setWrapperTransition(e, b), 0 !== e && (t.onTransitionStart(), t.wrapper.transitionEnd(function () {
                                    r && (t.params.loop && "slide" === b.params.controlBy && t.fixLoop(), t.onTransitionEnd())
                                }))
                            }

                            var a, r = b.params.control;
                            if (b.isArray(r))for (a = 0; a < r.length; a++)r[a] !== t && r[a] instanceof n && i(r[a]); else r instanceof n && t !== r && i(r)
                        }
                    }, b.hashnav = {
                        init: function () {
                            if (b.params.hashnav) {
                                b.hashnav.initialized = !0;
                                var e = document.location.hash.replace("#", "");
                                if (e)for (var t = 0, n = 0, i = b.slides.length; i > n; n++) {
                                    var a = b.slides.eq(n), r = a.attr("data-hash");
                                    if (r === e && !a.hasClass(b.params.slideDuplicateClass)) {
                                        var o = a.index();
                                        b.slideTo(o, t, b.params.runCallbacksOnInit, !0)
                                    }
                                }
                            }
                        }, setHash: function () {
                            b.hashnav.initialized && b.params.hashnav && (document.location.hash = b.slides.eq(b.activeIndex).attr("data-hash") || "")
                        }
                    }, b.disableKeyboardControl = function () {
                        b.params.keyboardControl = !1, t(document).off("keydown", d)
                    }, b.enableKeyboardControl = function () {
                        b.params.keyboardControl = !0, t(document).on("keydown", d)
                    }, b.mousewheel = {
                        event: !1,
                        lastScrollTime: (new window.Date).getTime()
                    }, b.params.mousewheelControl) {
                    try {
                        new window.WheelEvent("wheel"), b.mousewheel.event = "wheel"
                    } catch (O) {
                        (window.WheelEvent || b.container[0] && "wheel" in b.container[0]) && (b.mousewheel.event = "wheel")
                    }
                    !b.mousewheel.event && window.WheelEvent, b.mousewheel.event || void 0 === document.onmousewheel || (b.mousewheel.event = "mousewheel"), b.mousewheel.event || (b.mousewheel.event = "DOMMouseScroll")
                }
                b.disableMousewheelControl = function () {
                    return b.mousewheel.event ? (b.container.off(b.mousewheel.event, u), !0) : !1
                }, b.enableMousewheelControl = function () {
                    return b.mousewheel.event ? (b.container.on(b.mousewheel.event, u), !0) : !1
                }, b.parallax = {
                    setTranslate: function () {
                        b.container.children("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function () {
                            p(this, b.progress)
                        }), b.slides.each(function () {
                            var e = t(this);
                            e.find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function () {
                                var t = Math.min(Math.max(e[0].progress, -1), 1);
                                p(this, t)
                            })
                        })
                    }, setTransition: function (e) {
                        "undefined" == typeof e && (e = b.params.speed), b.container.find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function () {
                            var n = t(this), i = parseInt(n.attr("data-swiper-parallax-duration"), 10) || e;
                            0 === e && (i = 0), n.transition(i)
                        })
                    }
                }, b._plugins = [];
                for (var j in b.plugins) {
                    var R = b.plugins[j](b, b.params[j]);
                    R && b._plugins.push(R)
                }
                return b.callPlugins = function (e) {
                    for (var t = 0; t < b._plugins.length; t++)e in b._plugins[t] && b._plugins[t][e](arguments[1], arguments[2], arguments[3], arguments[4], arguments[5])
                }, b.emitterEventListeners = {}, b.emit = function (e) {
                    b.params[e] && b.params[e](arguments[1], arguments[2], arguments[3], arguments[4], arguments[5]);
                    var t;
                    if (b.emitterEventListeners[e])for (t = 0; t < b.emitterEventListeners[e].length; t++)b.emitterEventListeners[e][t](arguments[1], arguments[2], arguments[3], arguments[4], arguments[5]);
                    b.callPlugins && b.callPlugins(e, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5])
                }, b.on = function (e, t) {
                    return e = c(e), b.emitterEventListeners[e] || (b.emitterEventListeners[e] = []), b.emitterEventListeners[e].push(t), b
                }, b.off = function (e, t) {
                    var n;
                    if (e = c(e), "undefined" == typeof t)return b.emitterEventListeners[e] = [], b;
                    if (b.emitterEventListeners[e] && 0 !== b.emitterEventListeners[e].length) {
                        for (n = 0; n < b.emitterEventListeners[e].length; n++)b.emitterEventListeners[e][n] === t && b.emitterEventListeners[e].splice(n, 1);
                        return b
                    }
                }, b.once = function (e, t) {
                    e = c(e);
                    var n = function () {
                        t(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4]), b.off(e, n)
                    };
                    return b.on(e, n), b
                }, b.a11y = {
                    makeFocusable: function (e) {
                        return e.attr("tabIndex", "0"), e
                    },
                    addRole: function (e, t) {
                        return e.attr("role", t), e
                    },
                    addLabel: function (e, t) {
                        return e.attr("aria-label", t), e
                    },
                    disable: function (e) {
                        return e.attr("aria-disabled", !0), e
                    },
                    enable: function (e) {
                        return e.attr("aria-disabled", !1), e
                    },
                    onEnterKey: function (e) {
                        13 === e.keyCode && (t(e.target).is(b.params.nextButton) ? (b.onClickNext(e), b.isEnd ? b.a11y.notify(b.params.lastSlideMessage) : b.a11y.notify(b.params.nextSlideMessage)) : t(e.target).is(b.params.prevButton) && (b.onClickPrev(e), b.isBeginning ? b.a11y.notify(b.params.firstSlideMessage) : b.a11y.notify(b.params.prevSlideMessage)), t(e.target).is("." + b.params.bulletClass) && t(e.target)[0].click())
                    },
                    liveRegion: t('<span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>'),
                    notify: function (e) {
                        var t = b.a11y.liveRegion;
                        0 !== t.length && (t.html(""), t.html(e))
                    },
                    init: function () {
                        b.params.nextButton && b.nextButton && b.nextButton.length > 0 && (b.a11y.makeFocusable(b.nextButton), b.a11y.addRole(b.nextButton, "button"), b.a11y.addLabel(b.nextButton, b.params.nextSlideMessage)), b.params.prevButton && b.prevButton && b.prevButton.length > 0 && (b.a11y.makeFocusable(b.prevButton), b.a11y.addRole(b.prevButton, "button"), b.a11y.addLabel(b.prevButton, b.params.prevSlideMessage)), t(b.container).append(b.a11y.liveRegion)
                    },
                    initPagination: function () {
                        b.params.pagination && b.params.paginationClickable && b.bullets && b.bullets.length && b.bullets.each(function () {
                            var e = t(this);
                            b.a11y.makeFocusable(e), b.a11y.addRole(e, "button"), b.a11y.addLabel(e, b.params.paginationBulletMessage.replace(/{{index}}/, e.index() + 1))
                        })
                    },
                    destroy: function () {
                        b.a11y.liveRegion && b.a11y.liveRegion.length > 0 && b.a11y.liveRegion.remove()
                    }
                }, b.init = function () {
                    b.params.loop && b.createLoop(), b.updateContainerSize(), b.updateSlidesSize(), b.updatePagination(), b.params.scrollbar && b.scrollbar && (b.scrollbar.set(), b.params.scrollbarDraggable && b.scrollbar.enableDraggable()), "slide" !== b.params.effect && b.effects[b.params.effect] && (b.params.loop || b.updateProgress(), b.effects[b.params.effect].setTranslate()), b.params.loop ? b.slideTo(b.params.initialSlide + b.loopedSlides, 0, b.params.runCallbacksOnInit) : (b.slideTo(b.params.initialSlide, 0, b.params.runCallbacksOnInit), 0 === b.params.initialSlide && (b.parallax && b.params.parallax && b.parallax.setTranslate(), b.lazy && b.params.lazyLoading && (b.lazy.load(), b.lazy.initialImageLoaded = !0))), b.attachEvents(), b.params.observer && b.support.observer && b.initObservers(), b.params.preloadImages && !b.params.lazyLoading && b.preloadImages(), b.params.autoplay && b.startAutoplay(), b.params.keyboardControl && b.enableKeyboardControl && b.enableKeyboardControl(), b.params.mousewheelControl && b.enableMousewheelControl && b.enableMousewheelControl(), b.params.hashnav && b.hashnav && b.hashnav.init(), b.params.a11y && b.a11y && b.a11y.init(), b.emit("onInit", b)
                }, b.cleanupStyles = function () {
                    b.container.removeClass(b.classNames.join(" ")).removeAttr("style"), b.wrapper.removeAttr("style"), b.slides && b.slides.length && b.slides.removeClass([b.params.slideVisibleClass, b.params.slideActiveClass, b.params.slideNextClass, b.params.slidePrevClass].join(" ")).removeAttr("style").removeAttr("data-swiper-column").removeAttr("data-swiper-row"), b.paginationContainer && b.paginationContainer.length && b.paginationContainer.removeClass(b.params.paginationHiddenClass), b.bullets && b.bullets.length && b.bullets.removeClass(b.params.bulletActiveClass), b.params.prevButton && t(b.params.prevButton).removeClass(b.params.buttonDisabledClass), b.params.nextButton && t(b.params.nextButton).removeClass(b.params.buttonDisabledClass), b.params.scrollbar && b.scrollbar && (b.scrollbar.track && b.scrollbar.track.length && b.scrollbar.track.removeAttr("style"), b.scrollbar.drag && b.scrollbar.drag.length && b.scrollbar.drag.removeAttr("style"))
                }, b.destroy = function (e, t) {
                    b.detachEvents(), b.stopAutoplay(), b.params.scrollbar && b.scrollbar && b.params.scrollbarDraggable && b.scrollbar.disableDraggable(), b.params.loop && b.destroyLoop(), t && b.cleanupStyles(), b.disconnectObservers(), b.params.keyboardControl && b.disableKeyboardControl && b.disableKeyboardControl(), b.params.mousewheelControl && b.disableMousewheelControl && b.disableMousewheelControl(), b.params.a11y && b.a11y && b.a11y.destroy(), b.emit("onDestroy"), e !== !1 && (b = null)
                }, b.init(), b
            }
        };
        n.prototype = {
            isSafari: function () {
                var e = navigator.userAgent.toLowerCase();
                return e.indexOf("safari") >= 0 && e.indexOf("chrome") < 0 && e.indexOf("android") < 0
            }(),
            isUiWebView: /(iPhone|iPod|iPad).*AppleWebKit(?!.*Safari)/i.test(navigator.userAgent),
            isArray: function (e) {
                return "[object Array]" === Object.prototype.toString.apply(e)
            },
            browser: {
                ie: window.navigator.pointerEnabled || window.navigator.msPointerEnabled,
                ieTouch: window.navigator.msPointerEnabled && window.navigator.msMaxTouchPoints > 1 || window.navigator.pointerEnabled && window.navigator.maxTouchPoints > 1
            },
            device: function () {
                var e = navigator.userAgent, t = e.match(/(Android);?[\s\/]+([\d.]+)?/), n = e.match(/(iPad).*OS\s([\d_]+)/), i = e.match(/(iPod)(.*OS\s([\d_]+))?/), a = !n && e.match(/(iPhone\sOS)\s([\d_]+)/);
                return {ios: n || a || i, android: t}
            }(),
            support: {
                touch: window.Modernizr && Modernizr.touch === !0 || function () {
                    return !!("ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch)
                }(), transforms3d: window.Modernizr && Modernizr.csstransforms3d === !0 || function () {
                    var e = document.createElement("div").style;
                    return "webkitPerspective" in e || "MozPerspective" in e || "OPerspective" in e || "MsPerspective" in e || "perspective" in e
                }(), flexbox: function () {
                    for (var e = document.createElement("div").style, t = "alignItems webkitAlignItems webkitBoxAlign msFlexAlign mozBoxAlign webkitFlexDirection msFlexDirection mozBoxDirection mozBoxOrient webkitBoxDirection webkitBoxOrient".split(" "), n = 0; n < t.length; n++)if (t[n] in e)return !0
                }(), observer: function () {
                    return "MutationObserver" in window || "WebkitMutationObserver" in window
                }()
            },
            plugins: {}
        };
        for (var i = (function () {
            var e = function (e) {
                var t = this, n = 0;
                for (n = 0; n < e.length; n++)t[n] = e[n];
                return t.length = e.length, this
            }, t = function (t, n) {
                var i = [], a = 0;
                if (t && !n && t instanceof e)return t;
                if (t)if ("string" == typeof t) {
                    var r, o, s = t.trim();
                    if (s.indexOf("<") >= 0 && s.indexOf(">") >= 0) {
                        var l = "div";
                        for (0 === s.indexOf("<li") && (l = "ul"), 0 === s.indexOf("<tr") && (l = "tbody"), (0 === s.indexOf("<td") || 0 === s.indexOf("<th")) && (l = "tr"), 0 === s.indexOf("<tbody") && (l = "table"), 0 === s.indexOf("<option") && (l = "select"), o = document.createElement(l), o.innerHTML = t, a = 0; a < o.childNodes.length; a++)i.push(o.childNodes[a])
                    } else for (r = n || "#" !== t[0] || t.match(/[ .<>:~]/) ? (n || document).querySelectorAll(t) : [document.getElementById(t.split("#")[1])], a = 0; a < r.length; a++)r[a] && i.push(r[a])
                } else if (t.nodeType || t === window || t === document) i.push(t); else if (t.length > 0 && t[0].nodeType)for (a = 0; a < t.length; a++)i.push(t[a]);
                return new e(i)
            };
            return e.prototype = {
                addClass: function (e) {
                    if ("undefined" == typeof e)return this;
                    for (var t = e.split(" "), n = 0; n < t.length; n++)for (var i = 0; i < this.length; i++)this[i].classList.add(t[n]);
                    return this
                }, removeClass: function (e) {
                    for (var t = e.split(" "), n = 0; n < t.length; n++)for (var i = 0; i < this.length; i++)this[i].classList.remove(t[n]);
                    return this
                }, hasClass: function (e) {
                    return this[0] ? this[0].classList.contains(e) : !1
                }, toggleClass: function (e) {
                    for (var t = e.split(" "), n = 0; n < t.length; n++)for (var i = 0; i < this.length; i++)this[i].classList.toggle(t[n]);
                    return this
                }, attr: function (e, t) {
                    if (1 === arguments.length && "string" == typeof e)return this[0] ? this[0].getAttribute(e) : void 0;
                    for (var n = 0; n < this.length; n++)if (2 === arguments.length) this[n].setAttribute(e, t); else for (var i in e)this[n][i] = e[i], this[n].setAttribute(i, e[i]);
                    return this
                }, removeAttr: function (e) {
                    for (var t = 0; t < this.length; t++)this[t].removeAttribute(e);
                    return this
                }, data: function (e, t) {
                    if ("undefined" != typeof t) {
                        for (var n = 0; n < this.length; n++) {
                            var i = this[n];
                            i.dom7ElementDataStorage || (i.dom7ElementDataStorage = {}), i.dom7ElementDataStorage[e] = t
                        }
                        return this
                    }
                    if (this[0]) {
                        var a = this[0].getAttribute("data-" + e);
                        return a ? a : this[0].dom7ElementDataStorage && e in this[0].dom7ElementDataStorage ? this[0].dom7ElementDataStorage[e] : void 0
                    }
                }, transform: function (e) {
                    for (var t = 0; t < this.length; t++) {
                        var n = this[t].style;
                        n.webkitTransform = n.MsTransform = n.msTransform = n.MozTransform = n.OTransform = n.transform = e
                    }
                    return this
                }, transition: function (e) {
                    "string" != typeof e && (e += "ms");
                    for (var t = 0; t < this.length; t++) {
                        var n = this[t].style;
                        n.webkitTransitionDuration = n.MsTransitionDuration = n.msTransitionDuration = n.MozTransitionDuration = n.OTransitionDuration = n.transitionDuration = e
                    }
                    return this
                }, on: function (e, n, i, a) {
                    function r(e) {
                        var a = e.target;
                        if (t(a).is(n)) i.call(a, e); else for (var r = t(a).parents(), o = 0; o < r.length; o++)t(r[o]).is(n) && i.call(r[o], e)
                    }

                    var o, s, l = e.split(" ");
                    for (o = 0; o < this.length; o++)if ("function" == typeof n || n === !1)for ("function" == typeof n && (i = arguments[1], a = arguments[2] || !1), s = 0; s < l.length; s++)this[o].addEventListener(l[s], i, a); else for (s = 0; s < l.length; s++)this[o].dom7LiveListeners || (this[o].dom7LiveListeners = []), this[o].dom7LiveListeners.push({
                        listener: i,
                        liveListener: r
                    }), this[o].addEventListener(l[s], r, a);
                    return this
                }, off: function (e, t, n, i) {
                    for (var a = e.split(" "), r = 0; r < a.length; r++)for (var o = 0; o < this.length; o++)if ("function" == typeof t || t === !1) "function" == typeof t && (n = arguments[1], i = arguments[2] || !1), this[o].removeEventListener(a[r], n, i); else if (this[o].dom7LiveListeners)for (var s = 0; s < this[o].dom7LiveListeners.length; s++)this[o].dom7LiveListeners[s].listener === n && this[o].removeEventListener(a[r], this[o].dom7LiveListeners[s].liveListener, i);
                    return this
                }, once: function (e, t, n, i) {
                    function a(o) {
                        n(o), r.off(e, t, a, i)
                    }

                    var r = this;
                    "function" == typeof t && (t = !1, n = arguments[1], i = arguments[2]), r.on(e, t, a, i)
                }, trigger: function (e, t) {
                    for (var n = 0; n < this.length; n++) {
                        var i;
                        try {
                            i = new window.CustomEvent(e, {detail: t, bubbles: !0, cancelable: !0})
                        } catch (a) {
                            i = document.createEvent("Event"), i.initEvent(e, !0, !0), i.detail = t
                        }
                        this[n].dispatchEvent(i)
                    }
                    return this
                }, transitionEnd: function (e) {
                    function t(r) {
                        if (r.target === this)for (e.call(this, r), n = 0; n < i.length; n++)a.off(i[n], t)
                    }

                    var n, i = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"], a = this;
                    if (e)for (n = 0; n < i.length; n++)a.on(i[n], t);
                    return this
                }, width: function () {
                    return this[0] === window ? window.innerWidth : this.length > 0 ? parseFloat(this.css("width")) : null
                }, outerWidth: function (e) {
                    return this.length > 0 ? e ? this[0].offsetWidth + parseFloat(this.css("margin-right")) + parseFloat(this.css("margin-left")) : this[0].offsetWidth : null
                }, height: function () {
                    return this[0] === window ? window.innerHeight : this.length > 0 ? parseFloat(this.css("height")) : null
                }, outerHeight: function (e) {
                    return this.length > 0 ? e ? this[0].offsetHeight + parseFloat(this.css("margin-top")) + parseFloat(this.css("margin-bottom")) : this[0].offsetHeight : null
                }, offset: function () {
                    if (this.length > 0) {
                        var e = this[0], t = e.getBoundingClientRect(), n = document.body, i = e.clientTop || n.clientTop || 0, a = e.clientLeft || n.clientLeft || 0, r = window.pageYOffset || e.scrollTop, o = window.pageXOffset || e.scrollLeft;
                        return {top: t.top + r - i, left: t.left + o - a}
                    }
                    return null
                }, css: function (e, t) {
                    var n;
                    if (1 === arguments.length) {
                        if ("string" != typeof e) {
                            for (n = 0; n < this.length; n++)for (var i in e)this[n].style[i] = e[i];
                            return this
                        }
                        if (this[0])return window.getComputedStyle(this[0], null).getPropertyValue(e)
                    }
                    if (2 === arguments.length && "string" == typeof e) {
                        for (n = 0; n < this.length; n++)this[n].style[e] = t;
                        return this
                    }
                    return this
                }, each: function (e) {
                    for (var t = 0; t < this.length; t++)e.call(this[t], t, this[t]);
                    return this
                }, html: function (e) {
                    if ("undefined" == typeof e)return this[0] ? this[0].innerHTML : void 0;
                    for (var t = 0; t < this.length; t++)this[t].innerHTML = e;
                    return this
                }, text: function (e) {
                    if ("undefined" == typeof e)return this[0] ? this[0].textContent.trim() : null;
                    for (var t = 0; t < this.length; t++)this[t].textContent = e;
                    return this
                }, is: function (n) {
                    if (!this[0])return !1;
                    var i, a;
                    if ("string" == typeof n) {
                        var r = this[0];
                        if (r === document)return n === document;
                        if (r === window)return n === window;
                        if (r.matches)return r.matches(n);
                        if (r.webkitMatchesSelector)return r.webkitMatchesSelector(n);
                        if (r.mozMatchesSelector)return r.mozMatchesSelector(n);
                        if (r.msMatchesSelector)return r.msMatchesSelector(n);
                        for (i = t(n), a = 0; a < i.length; a++)if (i[a] === this[0])return !0;
                        return !1
                    }
                    if (n === document)return this[0] === document;
                    if (n === window)return this[0] === window;
                    if (n.nodeType || n instanceof e) {
                        for (i = n.nodeType ? [n] : n, a = 0; a < i.length; a++)if (i[a] === this[0])return !0;
                        return !1
                    }
                    return !1
                }, index: function () {
                    if (this[0]) {
                        for (var e = this[0], t = 0; null !== (e = e.previousSibling);)1 === e.nodeType && t++;
                        return t
                    }
                }, eq: function (t) {
                    if ("undefined" == typeof t)return this;
                    var n, i = this.length;
                    return t > i - 1 ? new e([]) : 0 > t ? (n = i + t, new e(0 > n ? [] : [this[n]])) : new e([this[t]])
                }, append: function (t) {
                    var n, i;
                    for (n = 0; n < this.length; n++)if ("string" == typeof t) {
                        var a = document.createElement("div");
                        for (a.innerHTML = t; a.firstChild;)this[n].appendChild(a.firstChild)
                    } else if (t instanceof e)for (i = 0; i < t.length; i++)this[n].appendChild(t[i]); else this[n].appendChild(t);
                    return this
                }, prepend: function (t) {
                    var n, i;
                    for (n = 0; n < this.length; n++)if ("string" == typeof t) {
                        var a = document.createElement("div");
                        for (a.innerHTML = t, i = a.childNodes.length - 1; i >= 0; i--)this[n].insertBefore(a.childNodes[i], this[n].childNodes[0])
                    } else if (t instanceof e)for (i = 0; i < t.length; i++)this[n].insertBefore(t[i], this[n].childNodes[0]); else this[n].insertBefore(t, this[n].childNodes[0]);
                    return this
                }, insertBefore: function (e) {
                    for (var n = t(e), i = 0; i < this.length; i++)if (1 === n.length) n[0].parentNode.insertBefore(this[i], n[0]); else if (n.length > 1)for (var a = 0; a < n.length; a++)n[a].parentNode.insertBefore(this[i].cloneNode(!0), n[a])
                }, insertAfter: function (e) {
                    for (var n = t(e), i = 0; i < this.length; i++)if (1 === n.length) n[0].parentNode.insertBefore(this[i], n[0].nextSibling); else if (n.length > 1)for (var a = 0; a < n.length; a++)n[a].parentNode.insertBefore(this[i].cloneNode(!0), n[a].nextSibling)
                }, next: function (n) {
                    return new e(this.length > 0 ? n ? this[0].nextElementSibling && t(this[0].nextElementSibling).is(n) ? [this[0].nextElementSibling] : [] : this[0].nextElementSibling ? [this[0].nextElementSibling] : [] : [])
                }, nextAll: function (n) {
                    var i = [], a = this[0];
                    if (!a)return new e([]);
                    for (; a.nextElementSibling;) {
                        var r = a.nextElementSibling;
                        n ? t(r).is(n) && i.push(r) : i.push(r), a = r
                    }
                    return new e(i)
                }, prev: function (n) {
                    return new e(this.length > 0 ? n ? this[0].previousElementSibling && t(this[0].previousElementSibling).is(n) ? [this[0].previousElementSibling] : [] : this[0].previousElementSibling ? [this[0].previousElementSibling] : [] : [])
                }, prevAll: function (n) {
                    var i = [], a = this[0];
                    if (!a)return new e([]);
                    for (; a.previousElementSibling;) {
                        var r = a.previousElementSibling;
                        n ? t(r).is(n) && i.push(r) : i.push(r), a = r
                    }
                    return new e(i)
                }, parent: function (e) {
                    for (var n = [], i = 0; i < this.length; i++)e ? t(this[i].parentNode).is(e) && n.push(this[i].parentNode) : n.push(this[i].parentNode);
                    return t(t.unique(n))
                }, parents: function (e) {
                    for (var n = [], i = 0; i < this.length; i++)for (var a = this[i].parentNode; a;)e ? t(a).is(e) && n.push(a) : n.push(a), a = a.parentNode;
                    return t(t.unique(n))
                }, find: function (t) {
                    for (var n = [], i = 0; i < this.length; i++)for (var a = this[i].querySelectorAll(t), r = 0; r < a.length; r++)n.push(a[r]);
                    return new e(n)
                }, children: function (n) {
                    for (var i = [], a = 0; a < this.length; a++)for (var r = this[a].childNodes, o = 0; o < r.length; o++)n ? 1 === r[o].nodeType && t(r[o]).is(n) && i.push(r[o]) : 1 === r[o].nodeType && i.push(r[o]);
                    return new e(t.unique(i))
                }, remove: function () {
                    for (var e = 0; e < this.length; e++)this[e].parentNode && this[e].parentNode.removeChild(this[e]);
                    return this
                }, add: function () {
                    var e, n, i = this;
                    for (e = 0; e < arguments.length; e++) {
                        var a = t(arguments[e]);
                        for (n = 0; n < a.length; n++)i[i.length] = a[n], i.length++
                    }
                    return i
                }
            }, t.fn = e.prototype, t.unique = function (e) {
                for (var t = [], n = 0; n < e.length; n++)-1 === t.indexOf(e[n]) && t.push(e[n]);
                return t
            }, t
        }()), a = ["jQuery", "Zepto", "Dom7"], r = 0; r < a.length; r++)window[a[r]] && e(window[a[r]]);
        var o;
        o = "undefined" == typeof i ? window.Dom7 || window.Zepto || window.jQuery : i, o && ("transitionEnd" in o.fn || (o.fn.transitionEnd = function (e) {
            function t(r) {
                if (r.target === this)for (e.call(this, r), n = 0; n < i.length; n++)a.off(i[n], t)
            }

            var n, i = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"], a = this;
            if (e)for (n = 0; n < i.length; n++)a.on(i[n], t);
            return this
        }), "transform" in o.fn || (o.fn.transform = function (e) {
            for (var t = 0; t < this.length; t++) {
                var n = this[t].style;
                n.webkitTransform = n.MsTransform = n.msTransform = n.MozTransform = n.OTransform = n.transform = e
            }
            return this
        }), "transition" in o.fn || (o.fn.transition = function (e) {
            "string" != typeof e && (e += "ms");
            for (var t = 0; t < this.length; t++) {
                var n = this[t].style;
                n.webkitTransitionDuration = n.MsTransitionDuration = n.msTransitionDuration = n.MozTransitionDuration = n.OTransitionDuration = n.transitionDuration = e
            }
            return this
        })), window.Swiper = n
    }(), "undefined" != typeof module ? module.exports = window.Swiper : "function" == typeof define && define.amd && define([], function () {
            "use strict";
            return window.Swiper
        }), "undefined" == typeof jQuery)throw new Error("Bootstrap's JavaScript requires jQuery");
+function (e) {
    "use strict";
    var t = e.fn.jquery.split(" ")[0].split(".");
    if (t[0] < 2 && t[1] < 9 || 1 == t[0] && 9 == t[1] && t[2] < 1 || t[0] > 3)throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher, but lower than version 4")
}(jQuery), +function (e) {
    "use strict";
    function t() {
        var e = document.createElement("bootstrap"), t = {
            WebkitTransition: "webkitTransitionEnd",
            MozTransition: "transitionend",
            OTransition: "oTransitionEnd otransitionend",
            transition: "transitionend"
        };
        for (var n in t)if (void 0 !== e.style[n])return {end: t[n]};
        return !1
    }

    e.fn.emulateTransitionEnd = function (t) {
        var n = !1, i = this;
        e(this).one("bsTransitionEnd", function () {
            n = !0
        });
        var a = function () {
            n || e(i).trigger(e.support.transition.end)
        };
        return setTimeout(a, t), this
    }, e(function () {
        e.support.transition = t(), e.support.transition && (e.event.special.bsTransitionEnd = {
            bindType: e.support.transition.end,
            delegateType: e.support.transition.end,
            handle: function (t) {
                return e(t.target).is(this) ? t.handleObj.handler.apply(this, arguments) : void 0
            }
        })
    })
}(jQuery), +function (e) {
    "use strict";
    function t(t) {
        return this.each(function () {
            var n = e(this), a = n.data("bs.alert");
            a || n.data("bs.alert", a = new i(this)), "string" == typeof t && a[t].call(n)
        })
    }

    var n = '[data-dismiss="alert"]', i = function (t) {
        e(t).on("click", n, this.close)
    };
    i.VERSION = "3.3.7", i.TRANSITION_DURATION = 150, i.prototype.close = function (t) {
        function n() {
            o.detach().trigger("closed.bs.alert").remove()
        }

        var a = e(this), r = a.attr("data-target");
        r || (r = a.attr("href"), r = r && r.replace(/.*(?=#[^\s]*$)/, ""));
        var o = e("#" === r ? [] : r);
        t && t.preventDefault(), o.length || (o = a.closest(".alert")), o.trigger(t = e.Event("close.bs.alert")), t.isDefaultPrevented() || (o.removeClass("in"), e.support.transition && o.hasClass("fade") ? o.one("bsTransitionEnd", n).emulateTransitionEnd(i.TRANSITION_DURATION) : n())
    };
    var a = e.fn.alert;
    e.fn.alert = t, e.fn.alert.Constructor = i, e.fn.alert.noConflict = function () {
        return e.fn.alert = a, this
    }, e(document).on("click.bs.alert.data-api", n, i.prototype.close)
}(jQuery), +function (e) {
    "use strict";
    function t(t) {
        return this.each(function () {
            var i = e(this), a = i.data("bs.button"), r = "object" == typeof t && t;
            a || i.data("bs.button", a = new n(this, r)), "toggle" == t ? a.toggle() : t && a.setState(t)
        })
    }

    var n = function (t, i) {
        this.$element = e(t), this.options = e.extend({}, n.DEFAULTS, i), this.isLoading = !1
    };
    n.VERSION = "3.3.7", n.DEFAULTS = {loadingText: "loading..."}, n.prototype.setState = function (t) {
        var n = "disabled", i = this.$element, a = i.is("input") ? "val" : "html", r = i.data();
        t += "Text", null == r.resetText && i.data("resetText", i[a]()), setTimeout(e.proxy(function () {
            i[a](null == r[t] ? this.options[t] : r[t]), "loadingText" == t ? (this.isLoading = !0, i.addClass(n).attr(n, n).prop(n, !0)) : this.isLoading && (this.isLoading = !1, i.removeClass(n).removeAttr(n).prop(n, !1))
        }, this), 0)
    }, n.prototype.toggle = function () {
        var e = !0, t = this.$element.closest('[data-toggle="buttons"]');
        if (t.length) {
            var n = this.$element.find("input");
            "radio" == n.prop("type") ? (n.prop("checked") && (e = !1), t.find(".active").removeClass("active"), this.$element.addClass("active")) : "checkbox" == n.prop("type") && (n.prop("checked") !== this.$element.hasClass("active") && (e = !1), this.$element.toggleClass("active")), n.prop("checked", this.$element.hasClass("active")), e && n.trigger("change")
        } else this.$element.attr("aria-pressed", !this.$element.hasClass("active")), this.$element.toggleClass("active")
    };
    var i = e.fn.button;
    e.fn.button = t, e.fn.button.Constructor = n, e.fn.button.noConflict = function () {
        return e.fn.button = i, this
    }, e(document).on("click.bs.button.data-api", '[data-toggle^="button"]', function (n) {
        var i = e(n.target).closest(".btn");
        t.call(i, "toggle"), e(n.target).is('input[type="radio"], input[type="checkbox"]') || (n.preventDefault(), i.is("input,button") ? i.trigger("focus") : i.find("input:visible,button:visible").first().trigger("focus"))
    }).on("focus.bs.button.data-api blur.bs.button.data-api", '[data-toggle^="button"]', function (t) {
        e(t.target).closest(".btn").toggleClass("focus", /^focus(in)?$/.test(t.type))
    })
}(jQuery), +function (e) {
    "use strict";
    function t(t) {
        return this.each(function () {
            var i = e(this), a = i.data("bs.carousel"), r = e.extend({}, n.DEFAULTS, i.data(), "object" == typeof t && t), o = "string" == typeof t ? t : r.slide;
            a || i.data("bs.carousel", a = new n(this, r)), "number" == typeof t ? a.to(t) : o ? a[o]() : r.interval && a.pause().cycle()
        })
    }

    var n = function (t, n) {
        this.$element = e(t), this.$indicators = this.$element.find(".carousel-indicators"), this.options = n, this.paused = null, this.sliding = null, this.interval = null, this.$active = null, this.$items = null, this.options.keyboard && this.$element.on("keydown.bs.carousel", e.proxy(this.keydown, this)), "hover" == this.options.pause && !("ontouchstart" in document.documentElement) && this.$element.on("mouseenter.bs.carousel", e.proxy(this.pause, this)).on("mouseleave.bs.carousel", e.proxy(this.cycle, this))
    };
    n.VERSION = "3.3.7", n.TRANSITION_DURATION = 600, n.DEFAULTS = {
        interval: 5e3,
        pause: "hover",
        wrap: !0,
        keyboard: !0
    }, n.prototype.keydown = function (e) {
        if (!/input|textarea/i.test(e.target.tagName)) {
            switch (e.which) {
                case 37:
                    this.prev();
                    break;
                case 39:
                    this.next();
                    break;
                default:
                    return
            }
            e.preventDefault()
        }
    }, n.prototype.cycle = function (t) {
        return t || (this.paused = !1), this.interval && clearInterval(this.interval), this.options.interval && !this.paused && (this.interval = setInterval(e.proxy(this.next, this), this.options.interval)), this
    }, n.prototype.getItemIndex = function (e) {
        return this.$items = e.parent().children(".item"), this.$items.index(e || this.$active)
    }, n.prototype.getItemForDirection = function (e, t) {
        var n = this.getItemIndex(t), i = "prev" == e && 0 === n || "next" == e && n == this.$items.length - 1;
        if (i && !this.options.wrap)return t;
        var a = "prev" == e ? -1 : 1, r = (n + a) % this.$items.length;
        return this.$items.eq(r)
    }, n.prototype.to = function (e) {
        var t = this, n = this.getItemIndex(this.$active = this.$element.find(".item.active"));
        return e > this.$items.length - 1 || 0 > e ? void 0 : this.sliding ? this.$element.one("slid.bs.carousel", function () {
                    t.to(e)
                }) : n == e ? this.pause().cycle() : this.slide(e > n ? "next" : "prev", this.$items.eq(e))
    }, n.prototype.pause = function (t) {
        return t || (this.paused = !0), this.$element.find(".next, .prev").length && e.support.transition && (this.$element.trigger(e.support.transition.end), this.cycle(!0)), this.interval = clearInterval(this.interval), this
    }, n.prototype.next = function () {
        return this.sliding ? void 0 : this.slide("next")
    }, n.prototype.prev = function () {
        return this.sliding ? void 0 : this.slide("prev")
    }, n.prototype.slide = function (t, i) {
        var a = this.$element.find(".item.active"), r = i || this.getItemForDirection(t, a), o = this.interval, s = "next" == t ? "left" : "right", l = this;
        if (r.hasClass("active"))return this.sliding = !1;
        var d = r[0], u = e.Event("slide.bs.carousel", {relatedTarget: d, direction: s});
        if (this.$element.trigger(u), !u.isDefaultPrevented()) {
            if (this.sliding = !0, o && this.pause(), this.$indicators.length) {
                this.$indicators.find(".active").removeClass("active");
                var p = e(this.$indicators.children()[this.getItemIndex(r)]);
                p && p.addClass("active")
            }
            var c = e.Event("slid.bs.carousel", {relatedTarget: d, direction: s});
            return e.support.transition && this.$element.hasClass("slide") ? (r.addClass(t), r[0].offsetWidth, a.addClass(s), r.addClass(s), a.one("bsTransitionEnd", function () {
                    r.removeClass([t, s].join(" ")).addClass("active"), a.removeClass(["active", s].join(" ")), l.sliding = !1, setTimeout(function () {
                        l.$element.trigger(c)
                    }, 0)
                }).emulateTransitionEnd(n.TRANSITION_DURATION)) : (a.removeClass("active"), r.addClass("active"), this.sliding = !1, this.$element.trigger(c)), o && this.cycle(), this
        }
    };
    var i = e.fn.carousel;
    e.fn.carousel = t, e.fn.carousel.Constructor = n, e.fn.carousel.noConflict = function () {
        return e.fn.carousel = i, this
    };
    var a = function (n) {
        var i, a = e(this), r = e(a.attr("data-target") || (i = a.attr("href")) && i.replace(/.*(?=#[^\s]+$)/, ""));
        if (r.hasClass("carousel")) {
            var o = e.extend({}, r.data(), a.data()), s = a.attr("data-slide-to");
            s && (o.interval = !1), t.call(r, o), s && r.data("bs.carousel").to(s), n.preventDefault()
        }
    };
    e(document).on("click.bs.carousel.data-api", "[data-slide]", a).on("click.bs.carousel.data-api", "[data-slide-to]", a), e(window).on("load", function () {
        e('[data-ride="carousel"]').each(function () {
            var n = e(this);
            t.call(n, n.data())
        })
    })
}(jQuery), +function (e) {
    "use strict";
    function t(t) {
        var n, i = t.attr("data-target") || (n = t.attr("href")) && n.replace(/.*(?=#[^\s]+$)/, "");
        return e(i)
    }

    function n(t) {
        return this.each(function () {
            var n = e(this), a = n.data("bs.collapse"), r = e.extend({}, i.DEFAULTS, n.data(), "object" == typeof t && t);
            !a && r.toggle && /show|hide/.test(t) && (r.toggle = !1), a || n.data("bs.collapse", a = new i(this, r)), "string" == typeof t && a[t]()
        })
    }

    var i = function (t, n) {
        this.$element = e(t), this.options = e.extend({}, i.DEFAULTS, n), this.$trigger = e('[data-toggle="collapse"][href="#' + t.id + '"],[data-toggle="collapse"][data-target="#' + t.id + '"]'), this.transitioning = null, this.options.parent ? this.$parent = this.getParent() : this.addAriaAndCollapsedClass(this.$element, this.$trigger),
        this.options.toggle && this.toggle()
    };
    i.VERSION = "3.3.7", i.TRANSITION_DURATION = 350, i.DEFAULTS = {toggle: !0}, i.prototype.dimension = function () {
        var e = this.$element.hasClass("width");
        return e ? "width" : "height"
    }, i.prototype.show = function () {
        if (!this.transitioning && !this.$element.hasClass("in")) {
            var t, a = this.$parent && this.$parent.children(".panel").children(".in, .collapsing");
            if (!(a && a.length && (t = a.data("bs.collapse"), t && t.transitioning))) {
                var r = e.Event("show.bs.collapse");
                if (this.$element.trigger(r), !r.isDefaultPrevented()) {
                    a && a.length && (n.call(a, "hide"), t || a.data("bs.collapse", null));
                    var o = this.dimension();
                    this.$element.removeClass("collapse").addClass("collapsing")[o](0).attr("aria-expanded", !0), this.$trigger.removeClass("collapsed").attr("aria-expanded", !0), this.transitioning = 1;
                    var s = function () {
                        this.$element.removeClass("collapsing").addClass("collapse in")[o](""), this.transitioning = 0, this.$element.trigger("shown.bs.collapse")
                    };
                    if (!e.support.transition)return s.call(this);
                    var l = e.camelCase(["scroll", o].join("-"));
                    this.$element.one("bsTransitionEnd", e.proxy(s, this)).emulateTransitionEnd(i.TRANSITION_DURATION)[o](this.$element[0][l])
                }
            }
        }
    }, i.prototype.hide = function () {
        if (!this.transitioning && this.$element.hasClass("in")) {
            var t = e.Event("hide.bs.collapse");
            if (this.$element.trigger(t), !t.isDefaultPrevented()) {
                var n = this.dimension();
                this.$element[n](this.$element[n]())[0].offsetHeight, this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded", !1), this.$trigger.addClass("collapsed").attr("aria-expanded", !1), this.transitioning = 1;
                var a = function () {
                    this.transitioning = 0, this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")
                };
                return e.support.transition ? void this.$element[n](0).one("bsTransitionEnd", e.proxy(a, this)).emulateTransitionEnd(i.TRANSITION_DURATION) : a.call(this)
            }
        }
    }, i.prototype.toggle = function () {
        this[this.$element.hasClass("in") ? "hide" : "show"]()
    }, i.prototype.getParent = function () {
        return e(this.options.parent).find('[data-toggle="collapse"][data-parent="' + this.options.parent + '"]').each(e.proxy(function (n, i) {
            var a = e(i);
            this.addAriaAndCollapsedClass(t(a), a)
        }, this)).end()
    }, i.prototype.addAriaAndCollapsedClass = function (e, t) {
        var n = e.hasClass("in");
        e.attr("aria-expanded", n), t.toggleClass("collapsed", !n).attr("aria-expanded", n)
    };
    var a = e.fn.collapse;
    e.fn.collapse = n, e.fn.collapse.Constructor = i, e.fn.collapse.noConflict = function () {
        return e.fn.collapse = a, this
    }, e(document).on("click.bs.collapse.data-api", '[data-toggle="collapse"]', function (i) {
        var a = e(this);
        a.attr("data-target") || i.preventDefault();
        var r = t(a), o = r.data("bs.collapse"), s = o ? "toggle" : a.data();
        n.call(r, s)
    })
}(jQuery), +function (e) {
    "use strict";
    function t(t) {
        var n = t.attr("data-target");
        n || (n = t.attr("href"), n = n && /#[A-Za-z]/.test(n) && n.replace(/.*(?=#[^\s]*$)/, ""));
        var i = n && e(n);
        return i && i.length ? i : t.parent()
    }

    function n(n) {
        n && 3 === n.which || (e(a).remove(), e(r).each(function () {
            var i = e(this), a = t(i), r = {relatedTarget: this};
            a.hasClass("open") && (n && "click" == n.type && /input|textarea/i.test(n.target.tagName) && e.contains(a[0], n.target) || (a.trigger(n = e.Event("hide.bs.dropdown", r)), n.isDefaultPrevented() || (i.attr("aria-expanded", "false"), a.removeClass("open").trigger(e.Event("hidden.bs.dropdown", r)))))
        }))
    }

    function i(t) {
        return this.each(function () {
            var n = e(this), i = n.data("bs.dropdown");
            i || n.data("bs.dropdown", i = new o(this)), "string" == typeof t && i[t].call(n)
        })
    }

    var a = ".dropdown-backdrop", r = '[data-toggle="dropdown"]', o = function (t) {
        e(t).on("click.bs.dropdown", this.toggle)
    };
    o.VERSION = "3.3.7", o.prototype.toggle = function (i) {
        var a = e(this);
        if (!a.is(".disabled, :disabled")) {
            var r = t(a), o = r.hasClass("open");
            if (n(), !o) {
                "ontouchstart" in document.documentElement && !r.closest(".navbar-nav").length && e(document.createElement("div")).addClass("dropdown-backdrop").insertAfter(e(this)).on("click", n);
                var s = {relatedTarget: this};
                if (r.trigger(i = e.Event("show.bs.dropdown", s)), i.isDefaultPrevented())return;
                a.trigger("focus").attr("aria-expanded", "true"), r.toggleClass("open").trigger(e.Event("shown.bs.dropdown", s))
            }
            return !1
        }
    }, o.prototype.keydown = function (n) {
        if (/(38|40|27|32)/.test(n.which) && !/input|textarea/i.test(n.target.tagName)) {
            var i = e(this);
            if (n.preventDefault(), n.stopPropagation(), !i.is(".disabled, :disabled")) {
                var a = t(i), o = a.hasClass("open");
                if (!o && 27 != n.which || o && 27 == n.which)return 27 == n.which && a.find(r).trigger("focus"), i.trigger("click");
                var s = " li:not(.disabled):visible a", l = a.find(".dropdown-menu" + s);
                if (l.length) {
                    var d = l.index(n.target);
                    38 == n.which && d > 0 && d--, 40 == n.which && d < l.length - 1 && d++, ~d || (d = 0), l.eq(d).trigger("focus")
                }
            }
        }
    };
    var s = e.fn.dropdown;
    e.fn.dropdown = i, e.fn.dropdown.Constructor = o, e.fn.dropdown.noConflict = function () {
        return e.fn.dropdown = s, this
    }, e(document).on("click.bs.dropdown.data-api", n).on("click.bs.dropdown.data-api", ".dropdown form", function (e) {
        e.stopPropagation()
    }).on("click.bs.dropdown.data-api", r, o.prototype.toggle).on("keydown.bs.dropdown.data-api", r, o.prototype.keydown).on("keydown.bs.dropdown.data-api", ".dropdown-menu", o.prototype.keydown)
}(jQuery), +function (e) {
    "use strict";
    function t(t, i) {
        return this.each(function () {
            var a = e(this), r = a.data("bs.modal"), o = e.extend({}, n.DEFAULTS, a.data(), "object" == typeof t && t);
            r || a.data("bs.modal", r = new n(this, o)), "string" == typeof t ? r[t](i) : o.show && r.show(i)
        })
    }

    var n = function (t, n) {
        this.options = n, this.$body = e(document.body), this.$element = e(t), this.$dialog = this.$element.find(".modal-dialog"), this.$backdrop = null, this.isShown = null, this.originalBodyPad = null, this.scrollbarWidth = 0, this.ignoreBackdropClick = !1, this.options.remote && this.$element.find(".modal-content").load(this.options.remote, e.proxy(function () {
            this.$element.trigger("loaded.bs.modal")
        }, this))
    };
    n.VERSION = "3.3.7", n.TRANSITION_DURATION = 300, n.BACKDROP_TRANSITION_DURATION = 150, n.DEFAULTS = {
        backdrop: !0,
        keyboard: !0,
        show: !0
    }, n.prototype.toggle = function (e) {
        return this.isShown ? this.hide() : this.show(e)
    }, n.prototype.show = function (t) {
        var i = this, a = e.Event("show.bs.modal", {relatedTarget: t});
        this.$element.trigger(a), this.isShown || a.isDefaultPrevented() || (this.isShown = !0, this.checkScrollbar(), this.setScrollbar(), this.$body.addClass("modal-open"), this.escape(), this.resize(), this.$element.on("click.dismiss.bs.modal", '[data-dismiss="modal"]', e.proxy(this.hide, this)), this.$dialog.on("mousedown.dismiss.bs.modal", function () {
            i.$element.one("mouseup.dismiss.bs.modal", function (t) {
                e(t.target).is(i.$element) && (i.ignoreBackdropClick = !0)
            })
        }), this.backdrop(function () {
            var a = e.support.transition && i.$element.hasClass("fade");
            i.$element.parent().length || i.$element.appendTo(i.$body), i.$element.show().scrollTop(0), i.adjustDialog(), a && i.$element[0].offsetWidth, i.$element.addClass("in"), i.enforceFocus();
            var r = e.Event("shown.bs.modal", {relatedTarget: t});
            a ? i.$dialog.one("bsTransitionEnd", function () {
                    i.$element.trigger("focus").trigger(r)
                }).emulateTransitionEnd(n.TRANSITION_DURATION) : i.$element.trigger("focus").trigger(r)
        }))
    }, n.prototype.hide = function (t) {
        t && t.preventDefault(), t = e.Event("hide.bs.modal"), this.$element.trigger(t), this.isShown && !t.isDefaultPrevented() && (this.isShown = !1, this.escape(), this.resize(), e(document).off("focusin.bs.modal"), this.$element.removeClass("in").off("click.dismiss.bs.modal").off("mouseup.dismiss.bs.modal"), this.$dialog.off("mousedown.dismiss.bs.modal"), e.support.transition && this.$element.hasClass("fade") ? this.$element.one("bsTransitionEnd", e.proxy(this.hideModal, this)).emulateTransitionEnd(n.TRANSITION_DURATION) : this.hideModal())
    }, n.prototype.enforceFocus = function () {
        e(document).off("focusin.bs.modal").on("focusin.bs.modal", e.proxy(function (e) {
            document === e.target || this.$element[0] === e.target || this.$element.has(e.target).length || this.$element.trigger("focus")
        }, this))
    }, n.prototype.escape = function () {
        this.isShown && this.options.keyboard ? this.$element.on("keydown.dismiss.bs.modal", e.proxy(function (e) {
                27 == e.which && this.hide()
            }, this)) : this.isShown || this.$element.off("keydown.dismiss.bs.modal")
    }, n.prototype.resize = function () {
        this.isShown ? e(window).on("resize.bs.modal", e.proxy(this.handleUpdate, this)) : e(window).off("resize.bs.modal")
    }, n.prototype.hideModal = function () {
        var e = this;
        this.$element.hide(), this.backdrop(function () {
            e.$body.removeClass("modal-open"), e.resetAdjustments(), e.resetScrollbar(), e.$element.trigger("hidden.bs.modal")
        })
    }, n.prototype.removeBackdrop = function () {
        this.$backdrop && this.$backdrop.remove(), this.$backdrop = null
    }, n.prototype.backdrop = function (t) {
        var i = this, a = this.$element.hasClass("fade") ? "fade" : "";
        if (this.isShown && this.options.backdrop) {
            var r = e.support.transition && a;
            if (this.$backdrop = e(document.createElement("div")).addClass("modal-backdrop " + a).appendTo(this.$body), this.$element.on("click.dismiss.bs.modal", e.proxy(function (e) {
                    return this.ignoreBackdropClick ? void(this.ignoreBackdropClick = !1) : void(e.target === e.currentTarget && ("static" == this.options.backdrop ? this.$element[0].focus() : this.hide()))
                }, this)), r && this.$backdrop[0].offsetWidth, this.$backdrop.addClass("in"), !t)return;
            r ? this.$backdrop.one("bsTransitionEnd", t).emulateTransitionEnd(n.BACKDROP_TRANSITION_DURATION) : t()
        } else if (!this.isShown && this.$backdrop) {
            this.$backdrop.removeClass("in");
            var o = function () {
                i.removeBackdrop(), t && t()
            };
            e.support.transition && this.$element.hasClass("fade") ? this.$backdrop.one("bsTransitionEnd", o).emulateTransitionEnd(n.BACKDROP_TRANSITION_DURATION) : o()
        } else t && t()
    }, n.prototype.handleUpdate = function () {
        this.adjustDialog()
    }, n.prototype.adjustDialog = function () {
        var e = this.$element[0].scrollHeight > document.documentElement.clientHeight;
        this.$element.css({
            paddingLeft: !this.bodyIsOverflowing && e ? this.scrollbarWidth : "",
            paddingRight: this.bodyIsOverflowing && !e ? this.scrollbarWidth : ""
        })
    }, n.prototype.resetAdjustments = function () {
        this.$element.css({paddingLeft: "", paddingRight: ""})
    }, n.prototype.checkScrollbar = function () {
        var e = window.innerWidth;
        if (!e) {
            var t = document.documentElement.getBoundingClientRect();
            e = t.right - Math.abs(t.left)
        }
        this.bodyIsOverflowing = document.body.clientWidth < e, this.scrollbarWidth = this.measureScrollbar()
    }, n.prototype.setScrollbar = function () {
        var e = parseInt(this.$body.css("padding-right") || 0, 10);
        this.originalBodyPad = document.body.style.paddingRight || "", this.bodyIsOverflowing && this.$body.css("padding-right", e + this.scrollbarWidth)
    }, n.prototype.resetScrollbar = function () {
        this.$body.css("padding-right", this.originalBodyPad)
    }, n.prototype.measureScrollbar = function () {
        var e = document.createElement("div");
        e.className = "modal-scrollbar-measure", this.$body.append(e);
        var t = e.offsetWidth - e.clientWidth;
        return this.$body[0].removeChild(e), t
    };
    var i = e.fn.modal;
    e.fn.modal = t, e.fn.modal.Constructor = n, e.fn.modal.noConflict = function () {
        return e.fn.modal = i, this
    }, e(document).on("click.bs.modal.data-api", '[data-toggle="modal"]', function (n) {
        var i = e(this), a = i.attr("href"), r = e(i.attr("data-target") || a && a.replace(/.*(?=#[^\s]+$)/, "")), o = r.data("bs.modal") ? "toggle" : e.extend({remote: !/#/.test(a) && a}, r.data(), i.data());
        i.is("a") && n.preventDefault(), r.one("show.bs.modal", function (e) {
            e.isDefaultPrevented() || r.one("hidden.bs.modal", function () {
                i.is(":visible") && i.trigger("focus")
            })
        }), t.call(r, o, this)
    })
}(jQuery), +function (e) {
    "use strict";
    function t(t) {
        return this.each(function () {
            var i = e(this), a = i.data("bs.tooltip"), r = "object" == typeof t && t;
            !a && /destroy|hide/.test(t) || (a || i.data("bs.tooltip", a = new n(this, r)), "string" == typeof t && a[t]())
        })
    }

    var n = function (e, t) {
        this.type = null, this.options = null, this.enabled = null, this.timeout = null, this.hoverState = null, this.$element = null, this.inState = null, this.init("tooltip", e, t)
    };
    n.VERSION = "3.3.7", n.TRANSITION_DURATION = 150, n.DEFAULTS = {
        animation: !0,
        placement: "top",
        selector: !1,
        template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
        trigger: "hover focus",
        title: "",
        delay: 0,
        html: !1,
        container: !1,
        viewport: {selector: "body", padding: 0}
    }, n.prototype.init = function (t, n, i) {
        if (this.enabled = !0, this.type = t, this.$element = e(n), this.options = this.getOptions(i), this.$viewport = this.options.viewport && e(e.isFunction(this.options.viewport) ? this.options.viewport.call(this, this.$element) : this.options.viewport.selector || this.options.viewport), this.inState = {
                click: !1,
                hover: !1,
                focus: !1
            }, this.$element[0] instanceof document.constructor && !this.options.selector)throw new Error("`selector` option must be specified when initializing " + this.type + " on the window.document object!");
        for (var a = this.options.trigger.split(" "), r = a.length; r--;) {
            var o = a[r];
            if ("click" == o) this.$element.on("click." + this.type, this.options.selector, e.proxy(this.toggle, this)); else if ("manual" != o) {
                var s = "hover" == o ? "mouseenter" : "focusin", l = "hover" == o ? "mouseleave" : "focusout";
                this.$element.on(s + "." + this.type, this.options.selector, e.proxy(this.enter, this)), this.$element.on(l + "." + this.type, this.options.selector, e.proxy(this.leave, this))
            }
        }
        this.options.selector ? this._options = e.extend({}, this.options, {
                trigger: "manual",
                selector: ""
            }) : this.fixTitle()
    }, n.prototype.getDefaults = function () {
        return n.DEFAULTS
    }, n.prototype.getOptions = function (t) {
        return t = e.extend({}, this.getDefaults(), this.$element.data(), t), t.delay && "number" == typeof t.delay && (t.delay = {
            show: t.delay,
            hide: t.delay
        }), t
    }, n.prototype.getDelegateOptions = function () {
        var t = {}, n = this.getDefaults();
        return this._options && e.each(this._options, function (e, i) {
            n[e] != i && (t[e] = i)
        }), t
    }, n.prototype.enter = function (t) {
        var n = t instanceof this.constructor ? t : e(t.currentTarget).data("bs." + this.type);
        return n || (n = new this.constructor(t.currentTarget, this.getDelegateOptions()), e(t.currentTarget).data("bs." + this.type, n)), t instanceof e.Event && (n.inState["focusin" == t.type ? "focus" : "hover"] = !0), n.tip().hasClass("in") || "in" == n.hoverState ? void(n.hoverState = "in") : (clearTimeout(n.timeout), n.hoverState = "in", n.options.delay && n.options.delay.show ? void(n.timeout = setTimeout(function () {
                    "in" == n.hoverState && n.show()
                }, n.options.delay.show)) : n.show())
    }, n.prototype.isInStateTrue = function () {
        for (var e in this.inState)if (this.inState[e])return !0;
        return !1
    }, n.prototype.leave = function (t) {
        var n = t instanceof this.constructor ? t : e(t.currentTarget).data("bs." + this.type);
        return n || (n = new this.constructor(t.currentTarget, this.getDelegateOptions()), e(t.currentTarget).data("bs." + this.type, n)), t instanceof e.Event && (n.inState["focusout" == t.type ? "focus" : "hover"] = !1), n.isInStateTrue() ? void 0 : (clearTimeout(n.timeout), n.hoverState = "out", n.options.delay && n.options.delay.hide ? void(n.timeout = setTimeout(function () {
                    "out" == n.hoverState && n.hide()
                }, n.options.delay.hide)) : n.hide())
    }, n.prototype.show = function () {
        var t = e.Event("show.bs." + this.type);
        if (this.hasContent() && this.enabled) {
            this.$element.trigger(t);
            var i = e.contains(this.$element[0].ownerDocument.documentElement, this.$element[0]);
            if (t.isDefaultPrevented() || !i)return;
            var a = this, r = this.tip(), o = this.getUID(this.type);
            this.setContent(), r.attr("id", o), this.$element.attr("aria-describedby", o), this.options.animation && r.addClass("fade");
            var s = "function" == typeof this.options.placement ? this.options.placement.call(this, r[0], this.$element[0]) : this.options.placement, l = /\s?auto?\s?/i, d = l.test(s);
            d && (s = s.replace(l, "") || "top"), r.detach().css({
                top: 0,
                left: 0,
                display: "block"
            }).addClass(s).data("bs." + this.type, this), this.options.container ? r.appendTo(this.options.container) : r.insertAfter(this.$element), this.$element.trigger("inserted.bs." + this.type);
            var u = this.getPosition(), p = r[0].offsetWidth, c = r[0].offsetHeight;
            if (d) {
                var f = s, h = this.getPosition(this.$viewport);
                s = "bottom" == s && u.bottom + c > h.bottom ? "top" : "top" == s && u.top - c < h.top ? "bottom" : "right" == s && u.right + p > h.width ? "left" : "left" == s && u.left - p < h.left ? "right" : s, r.removeClass(f).addClass(s)
            }
            var m = this.getCalculatedOffset(s, u, p, c);
            this.applyPlacement(m, s);
            var g = function () {
                var e = a.hoverState;
                a.$element.trigger("shown.bs." + a.type), a.hoverState = null, "out" == e && a.leave(a)
            };
            e.support.transition && this.$tip.hasClass("fade") ? r.one("bsTransitionEnd", g).emulateTransitionEnd(n.TRANSITION_DURATION) : g()
        }
    }, n.prototype.applyPlacement = function (t, n) {
        var i = this.tip(), a = i[0].offsetWidth, r = i[0].offsetHeight, o = parseInt(i.css("margin-top"), 10), s = parseInt(i.css("margin-left"), 10);
        isNaN(o) && (o = 0), isNaN(s) && (s = 0), t.top += o, t.left += s, e.offset.setOffset(i[0], e.extend({
            using: function (e) {
                i.css({top: Math.round(e.top), left: Math.round(e.left)})
            }
        }, t), 0), i.addClass("in");
        var l = i[0].offsetWidth, d = i[0].offsetHeight;
        "top" == n && d != r && (t.top = t.top + r - d);
        var u = this.getViewportAdjustedDelta(n, t, l, d);
        u.left ? t.left += u.left : t.top += u.top;
        var p = /top|bottom/.test(n), c = p ? 2 * u.left - a + l : 2 * u.top - r + d, f = p ? "offsetWidth" : "offsetHeight";
        i.offset(t), this.replaceArrow(c, i[0][f], p)
    }, n.prototype.replaceArrow = function (e, t, n) {
        this.arrow().css(n ? "left" : "top", 50 * (1 - e / t) + "%").css(n ? "top" : "left", "")
    }, n.prototype.setContent = function () {
        var e = this.tip(), t = this.getTitle();
        e.find(".tooltip-inner")[this.options.html ? "html" : "text"](t), e.removeClass("fade in top bottom left right")
    }, n.prototype.hide = function (t) {
        function i() {
            "in" != a.hoverState && r.detach(), a.$element && a.$element.removeAttr("aria-describedby").trigger("hidden.bs." + a.type), t && t()
        }

        var a = this, r = e(this.$tip), o = e.Event("hide.bs." + this.type);
        return this.$element.trigger(o), o.isDefaultPrevented() ? void 0 : (r.removeClass("in"), e.support.transition && r.hasClass("fade") ? r.one("bsTransitionEnd", i).emulateTransitionEnd(n.TRANSITION_DURATION) : i(), this.hoverState = null, this)
    }, n.prototype.fixTitle = function () {
        var e = this.$element;
        (e.attr("title") || "string" != typeof e.attr("data-original-title")) && e.attr("data-original-title", e.attr("title") || "").attr("title", "")
    }, n.prototype.hasContent = function () {
        return this.getTitle()
    }, n.prototype.getPosition = function (t) {
        t = t || this.$element;
        var n = t[0], i = "BODY" == n.tagName, a = n.getBoundingClientRect();
        null == a.width && (a = e.extend({}, a, {width: a.right - a.left, height: a.bottom - a.top}));
        var r = window.SVGElement && n instanceof window.SVGElement, o = i ? {
                top: 0,
                left: 0
            } : r ? null : t.offset(), s = {scroll: i ? document.documentElement.scrollTop || document.body.scrollTop : t.scrollTop()}, l = i ? {
                width: e(window).width(),
                height: e(window).height()
            } : null;
        return e.extend({}, a, s, l, o)
    }, n.prototype.getCalculatedOffset = function (e, t, n, i) {
        return "bottom" == e ? {
                top: t.top + t.height,
                left: t.left + t.width / 2 - n / 2
            } : "top" == e ? {
                    top: t.top - i,
                    left: t.left + t.width / 2 - n / 2
                } : "left" == e ? {
                        top: t.top + t.height / 2 - i / 2,
                        left: t.left - n
                    } : {top: t.top + t.height / 2 - i / 2, left: t.left + t.width}
    }, n.prototype.getViewportAdjustedDelta = function (e, t, n, i) {
        var a = {top: 0, left: 0};
        if (!this.$viewport)return a;
        var r = this.options.viewport && this.options.viewport.padding || 0, o = this.getPosition(this.$viewport);
        if (/right|left/.test(e)) {
            var s = t.top - r - o.scroll, l = t.top + r - o.scroll + i;
            s < o.top ? a.top = o.top - s : l > o.top + o.height && (a.top = o.top + o.height - l)
        } else {
            var d = t.left - r, u = t.left + r + n;
            d < o.left ? a.left = o.left - d : u > o.right && (a.left = o.left + o.width - u)
        }
        return a
    }, n.prototype.getTitle = function () {
        var e, t = this.$element, n = this.options;
        return e = t.attr("data-original-title") || ("function" == typeof n.title ? n.title.call(t[0]) : n.title)
    }, n.prototype.getUID = function (e) {
        do e += ~~(1e6 * Math.random()); while (document.getElementById(e));
        return e
    }, n.prototype.tip = function () {
        if (!this.$tip && (this.$tip = e(this.options.template), 1 != this.$tip.length))throw new Error(this.type + " `template` option must consist of exactly 1 top-level element!");
        return this.$tip
    }, n.prototype.arrow = function () {
        return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow")
    }, n.prototype.enable = function () {
        this.enabled = !0
    }, n.prototype.disable = function () {
        this.enabled = !1
    }, n.prototype.toggleEnabled = function () {
        this.enabled = !this.enabled
    }, n.prototype.toggle = function (t) {
        var n = this;
        t && (n = e(t.currentTarget).data("bs." + this.type), n || (n = new this.constructor(t.currentTarget, this.getDelegateOptions()), e(t.currentTarget).data("bs." + this.type, n))), t ? (n.inState.click = !n.inState.click, n.isInStateTrue() ? n.enter(n) : n.leave(n)) : n.tip().hasClass("in") ? n.leave(n) : n.enter(n)
    }, n.prototype.destroy = function () {
        var e = this;
        clearTimeout(this.timeout), this.hide(function () {
            e.$element.off("." + e.type).removeData("bs." + e.type), e.$tip && e.$tip.detach(), e.$tip = null, e.$arrow = null, e.$viewport = null, e.$element = null
        })
    };
    var i = e.fn.tooltip;
    e.fn.tooltip = t, e.fn.tooltip.Constructor = n, e.fn.tooltip.noConflict = function () {
        return e.fn.tooltip = i, this
    }
}(jQuery), +function (e) {
    "use strict";
    function t(t) {
        return this.each(function () {
            var i = e(this), a = i.data("bs.popover"), r = "object" == typeof t && t;
            !a && /destroy|hide/.test(t) || (a || i.data("bs.popover", a = new n(this, r)), "string" == typeof t && a[t]())
        })
    }

    var n = function (e, t) {
        this.init("popover", e, t)
    };
    if (!e.fn.tooltip)throw new Error("Popover requires tooltip.js");
    n.VERSION = "3.3.7", n.DEFAULTS = e.extend({}, e.fn.tooltip.Constructor.DEFAULTS, {
        placement: "right",
        trigger: "click",
        content: "",
        template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
    }), n.prototype = e.extend({}, e.fn.tooltip.Constructor.prototype), n.prototype.constructor = n, n.prototype.getDefaults = function () {
        return n.DEFAULTS
    }, n.prototype.setContent = function () {
        var e = this.tip(), t = this.getTitle(), n = this.getContent();
        e.find(".popover-title")[this.options.html ? "html" : "text"](t), e.find(".popover-content").children().detach().end()[this.options.html ? "string" == typeof n ? "html" : "append" : "text"](n), e.removeClass("fade top bottom left right in"), e.find(".popover-title").html() || e.find(".popover-title").hide()
    }, n.prototype.hasContent = function () {
        return this.getTitle() || this.getContent()
    }, n.prototype.getContent = function () {
        var e = this.$element, t = this.options;
        return e.attr("data-content") || ("function" == typeof t.content ? t.content.call(e[0]) : t.content)
    }, n.prototype.arrow = function () {
        return this.$arrow = this.$arrow || this.tip().find(".arrow")
    };
    var i = e.fn.popover;
    e.fn.popover = t, e.fn.popover.Constructor = n, e.fn.popover.noConflict = function () {
        return e.fn.popover = i, this
    }
}(jQuery), +function (e) {
    "use strict";
    function t(n, i) {
        this.$body = e(document.body), this.$scrollElement = e(e(n).is(document.body) ? window : n), this.options = e.extend({}, t.DEFAULTS, i), this.selector = (this.options.target || "") + " .nav li > a", this.offsets = [], this.targets = [], this.activeTarget = null, this.scrollHeight = 0, this.$scrollElement.on("scroll.bs.scrollspy", e.proxy(this.process, this)), this.refresh(), this.process()
    }

    function n(n) {
        return this.each(function () {
            var i = e(this), a = i.data("bs.scrollspy"), r = "object" == typeof n && n;
            a || i.data("bs.scrollspy", a = new t(this, r)), "string" == typeof n && a[n]()
        })
    }

    t.VERSION = "3.3.7", t.DEFAULTS = {offset: 10}, t.prototype.getScrollHeight = function () {
        return this.$scrollElement[0].scrollHeight || Math.max(this.$body[0].scrollHeight, document.documentElement.scrollHeight)
    }, t.prototype.refresh = function () {
        var t = this, n = "offset", i = 0;
        this.offsets = [], this.targets = [], this.scrollHeight = this.getScrollHeight(), e.isWindow(this.$scrollElement[0]) || (n = "position", i = this.$scrollElement.scrollTop()), this.$body.find(this.selector).map(function () {
            var t = e(this), a = t.data("target") || t.attr("href"), r = /^#./.test(a) && e(a);
            return r && r.length && r.is(":visible") && [[r[n]().top + i, a]] || null
        }).sort(function (e, t) {
            return e[0] - t[0]
        }).each(function () {
            t.offsets.push(this[0]), t.targets.push(this[1])
        })
    }, t.prototype.process = function () {
        var e, t = this.$scrollElement.scrollTop() + this.options.offset, n = this.getScrollHeight(), i = this.options.offset + n - this.$scrollElement.height(), a = this.offsets, r = this.targets, o = this.activeTarget;
        if (this.scrollHeight != n && this.refresh(), t >= i)return o != (e = r[r.length - 1]) && this.activate(e);
        if (o && t < a[0])return this.activeTarget = null, this.clear();
        for (e = a.length; e--;)o != r[e] && t >= a[e] && (void 0 === a[e + 1] || t < a[e + 1]) && this.activate(r[e])
    }, t.prototype.activate = function (t) {
        this.activeTarget = t, this.clear();
        var n = this.selector + '[data-target="' + t + '"],' + this.selector + '[href="' + t + '"]', i = e(n).parents("li").addClass("active");
        i.parent(".dropdown-menu").length && (i = i.closest("li.dropdown").addClass("active")), i.trigger("activate.bs.scrollspy")
    }, t.prototype.clear = function () {
        e(this.selector).parentsUntil(this.options.target, ".active").removeClass("active")
    };
    var i = e.fn.scrollspy;
    e.fn.scrollspy = n, e.fn.scrollspy.Constructor = t, e.fn.scrollspy.noConflict = function () {
        return e.fn.scrollspy = i, this
    }, e(window).on("load.bs.scrollspy.data-api", function () {
        e('[data-spy="scroll"]').each(function () {
            var t = e(this);
            n.call(t, t.data())
        })
    })
}(jQuery), +function (e) {
    "use strict";
    function t(t) {
        return this.each(function () {
            var i = e(this), a = i.data("bs.tab");
            a || i.data("bs.tab", a = new n(this)), "string" == typeof t && a[t]()
        })
    }

    var n = function (t) {
        this.element = e(t)
    };
    n.VERSION = "3.3.7", n.TRANSITION_DURATION = 150, n.prototype.show = function () {
        var t = this.element, n = t.closest("ul:not(.dropdown-menu)"), i = t.data("target");
        if (i || (i = t.attr("href"), i = i && i.replace(/.*(?=#[^\s]*$)/, "")), !t.parent("li").hasClass("active")) {
            var a = n.find(".active:last a"), r = e.Event("hide.bs.tab", {relatedTarget: t[0]}), o = e.Event("show.bs.tab", {relatedTarget: a[0]});
            if (a.trigger(r), t.trigger(o), !o.isDefaultPrevented() && !r.isDefaultPrevented()) {
                var s = e(i);
                this.activate(t.closest("li"), n), this.activate(s, s.parent(), function () {
                    a.trigger({type: "hidden.bs.tab", relatedTarget: t[0]}), t.trigger({
                        type: "shown.bs.tab",
                        relatedTarget: a[0]
                    })
                })
            }
        }
    }, n.prototype.activate = function (t, i, a) {
        function r() {
            o.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !1), t.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded", !0), s ? (t[0].offsetWidth, t.addClass("in")) : t.removeClass("fade"), t.parent(".dropdown-menu").length && t.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !0), a && a()
        }

        var o = i.find("> .active"), s = a && e.support.transition && (o.length && o.hasClass("fade") || !!i.find("> .fade").length);
        o.length && s ? o.one("bsTransitionEnd", r).emulateTransitionEnd(n.TRANSITION_DURATION) : r(), o.removeClass("in")
    };
    var i = e.fn.tab;
    e.fn.tab = t, e.fn.tab.Constructor = n, e.fn.tab.noConflict = function () {
        return e.fn.tab = i, this
    };
    var a = function (n) {
        n.preventDefault(), t.call(e(this), "show")
    };
    e(document).on("click.bs.tab.data-api", '[data-toggle="tab"]', a).on("click.bs.tab.data-api", '[data-toggle="pill"]', a)
}(jQuery), +function (e) {
    "use strict";
    function t(t) {
        return this.each(function () {
            var i = e(this), a = i.data("bs.affix"), r = "object" == typeof t && t;
            a || i.data("bs.affix", a = new n(this, r)), "string" == typeof t && a[t]()
        })
    }

    var n = function (t, i) {
        this.options = e.extend({}, n.DEFAULTS, i), this.$target = e(this.options.target).on("scroll.bs.affix.data-api", e.proxy(this.checkPosition, this)).on("click.bs.affix.data-api", e.proxy(this.checkPositionWithEventLoop, this)), this.$element = e(t), this.affixed = null, this.unpin = null, this.pinnedOffset = null, this.checkPosition()
    };
    n.VERSION = "3.3.7", n.RESET = "affix affix-top affix-bottom", n.DEFAULTS = {
        offset: 0,
        target: window
    }, n.prototype.getState = function (e, t, n, i) {
        var a = this.$target.scrollTop(), r = this.$element.offset(), o = this.$target.height();
        if (null != n && "top" == this.affixed)return n > a && "top";
        if ("bottom" == this.affixed)return null != n ? !(a + this.unpin <= r.top) && "bottom" : !(e - i >= a + o) && "bottom";
        var s = null == this.affixed, l = s ? a : r.top, d = s ? o : t;
        return null != n && n >= a ? "top" : null != i && l + d >= e - i && "bottom"
    }, n.prototype.getPinnedOffset = function () {
        if (this.pinnedOffset)return this.pinnedOffset;
        this.$element.removeClass(n.RESET).addClass("affix");
        var e = this.$target.scrollTop(), t = this.$element.offset();
        return this.pinnedOffset = t.top - e
    }, n.prototype.checkPositionWithEventLoop = function () {
        setTimeout(e.proxy(this.checkPosition, this), 1)
    }, n.prototype.checkPosition = function () {
        if (this.$element.is(":visible")) {
            var t = this.$element.height(), i = this.options.offset, a = i.top, r = i.bottom, o = Math.max(e(document).height(), e(document.body).height());
            "object" != typeof i && (r = a = i), "function" == typeof a && (a = i.top(this.$element)), "function" == typeof r && (r = i.bottom(this.$element));
            var s = this.getState(o, t, a, r);
            if (this.affixed != s) {
                null != this.unpin && this.$element.css("top", "");
                var l = "affix" + (s ? "-" + s : ""), d = e.Event(l + ".bs.affix");
                if (this.$element.trigger(d), d.isDefaultPrevented())return;
                this.affixed = s, this.unpin = "bottom" == s ? this.getPinnedOffset() : null, this.$element.removeClass(n.RESET).addClass(l).trigger(l.replace("affix", "affixed") + ".bs.affix")
            }
            "bottom" == s && this.$element.offset({top: o - t - r})
        }
    };
    var i = e.fn.affix;
    e.fn.affix = t, e.fn.affix.Constructor = n, e.fn.affix.noConflict = function () {
        return e.fn.affix = i, this
    }, e(window).on("load", function () {
        e('[data-spy="affix"]').each(function () {
            var n = e(this), i = n.data();
            i.offset = i.offset || {}, null != i.offsetBottom && (i.offset.bottom = i.offsetBottom), null != i.offsetTop && (i.offset.top = i.offsetTop), t.call(n, i)
        })
    })
}(jQuery), function (e) {
    function t(e, t) {
        return e.toFixed(t.decimals)
    }

    e.fn.countTo = function (t) {
        return t = t || {}, e(this).each(function () {
            function n() {
                u += o, d++, i(u), "function" == typeof a.onUpdate && a.onUpdate.call(s, u), d >= r && (l.removeData("countTo"), clearInterval(p.interval), u = a.to, "function" == typeof a.onComplete && a.onComplete.call(s, u))
            }

            function i(e) {
                var t = a.formatter.call(s, e, a);
                l.text(t)
            }

            var a = e.extend({}, e.fn.countTo.defaults, {
                from: e(this).data("from"),
                to: e(this).data("to"),
                speed: e(this).data("speed"),
                refreshInterval: e(this).data("refresh-interval"),
                decimals: e(this).data("decimals")
            }, t), r = Math.ceil(a.speed / a.refreshInterval), o = (a.to - a.from) / r, s = this, l = e(this), d = 0, u = a.from, p = l.data("countTo") || {};
            l.data("countTo", p), p.interval && clearInterval(p.interval), p.interval = setInterval(n, a.refreshInterval), i(u)
        })
    }, e.fn.countTo.defaults = {
        from: 0,
        to: 0,
        speed: 1e3,
        refreshInterval: 100,
        decimals: 0,
        formatter: t,
        onUpdate: null,
        onComplete: null
    }
}(jQuery), !function (e) {
    function t() {
        var t, n, i = {height: d.innerHeight, width: d.innerWidth};
        return i.height || (t = l.compatMode, (t || !e.support.boxModel) && (n = "CSS1Compat" === t ? u : l.body, i = {
            height: n.clientHeight,
            width: n.clientWidth
        })), i
    }

    function n() {
        return {
            top: d.pageYOffset || u.scrollTop || l.body.scrollTop,
            left: d.pageXOffset || u.scrollLeft || l.body.scrollLeft
        }
    }

    function i() {
        var i, o = e(), l = 0;
        if (e.each(s, function (e, t) {
                var n = t.data.selector, i = t.$element;
                o = o.add(n ? i.find(n) : i)
            }), i = o.length)for (a = a || t(), r = r || n(); i > l; l++)if (e.contains(u, o[l])) {
            var d, p, c, f = e(o[l]), h = {height: f.height(), width: f.width()}, m = f.offset(), g = f.data("inview");
            if (!r || !a)return;
            m.top + h.height > r.top && m.top < r.top + a.height && m.left + h.width > r.left && m.left < r.left + a.width ? (d = r.left > m.left ? "right" : r.left + a.width < m.left + h.width ? "left" : "both", p = r.top > m.top ? "bottom" : r.top + a.height < m.top + h.height ? "top" : "both", c = d + "-" + p, g && g === c || f.data("inview", c).trigger("inview", [!0, d, p])) : g && f.data("inview", !1).trigger("inview", [!1])
        }
    }

    var a, r, o, s = {}, l = document, d = window, u = l.documentElement, p = e.expando;
    e.event.special.inview = {
        add: function (t) {
            s[t.guid + "-" + this[p]] = {
                data: t,
                $element: e(this)
            }, o || e.isEmptyObject(s) || (o = setInterval(i, 250))
        }, remove: function (t) {
            try {
                delete s[t.guid + "-" + this[p]]
            } catch (n) {
            }
            e.isEmptyObject(s) && (clearInterval(o), o = null)
        }
    }, e(d).bind("scroll resize scrollstop", function () {
        a = r = null
    }), !u.addEventListener && u.attachEvent && u.attachEvent("onfocusin", function () {
        r = null
    })
}(jQuery), !function (e) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], e) : e(jQuery)
}(function (e) {
    "use strict";
    function t(e) {
        if (e instanceof Date)return e;
        if (String(e).match(o))return String(e).match(/^[0-9]*$/) && (e = Number(e)), String(e).match(/\-/) && (e = String(e).replace(/\-/g, "/")), new Date(e);
        throw new Error("Couldn't cast `" + e + "` to a date object.")
    }

    function n(e) {
        var t = e.toString().replace(/([.?*+^$[\]\\(){}|-])/g, "\\$1");
        return new RegExp(t)
    }

    function i(e) {
        return function (t) {
            var i = t.match(/%(-|!)?[A-Z]{1}(:[^;]+;)?/gi);
            if (i)for (var r = 0, o = i.length; o > r; ++r) {
                var s = i[r].match(/%(-|!)?([a-zA-Z]{1})(:[^;]+;)?/), d = n(s[0]), u = s[1] || "", p = s[3] || "", c = null;
                s = s[2], l.hasOwnProperty(s) && (c = l[s], c = Number(e[c])), null !== c && ("!" === u && (c = a(p, c)), "" === u && 10 > c && (c = "0" + c.toString()), t = t.replace(d, c.toString()))
            }
            return t = t.replace(/%%/, "%")
        }
    }

    function a(e, t) {
        var n = "s", i = "";
        return e && (e = e.replace(/(:|;|\s)/gi, "").split(/\,/), 1 === e.length ? n = e[0] : (i = e[0], n = e[1])), Math.abs(t) > 1 ? n : i
    }

    var r = [], o = [], s = {precision: 100, elapse: !1, defer: !1};
    o.push(/^[0-9]*$/.source), o.push(/([0-9]{1,2}\/){2}[0-9]{4}( [0-9]{1,2}(:[0-9]{2}){2})?/.source), o.push(/[0-9]{4}([\/\-][0-9]{1,2}){2}( [0-9]{1,2}(:[0-9]{2}){2})?/.source), o = new RegExp(o.join("|"));
    var l = {
        Y: "years",
        m: "months",
        n: "daysToMonth",
        d: "daysToWeek",
        w: "weeks",
        W: "weeksToMonth",
        H: "hours",
        M: "minutes",
        S: "seconds",
        D: "totalDays",
        I: "totalHours",
        N: "totalMinutes",
        T: "totalSeconds"
    }, d = function (t, n, i) {
        this.el = t, this.$el = e(t),
            this.interval = null, this.offset = {}, this.options = e.extend({}, s), this.instanceNumber = r.length, r.push(this), this.$el.data("countdown-instance", this.instanceNumber), i && ("function" == typeof i ? (this.$el.on("update.countdown", i), this.$el.on("stoped.countdown", i), this.$el.on("finish.countdown", i)) : this.options = e.extend({}, s, i)), this.setFinalDate(n), this.options.defer === !1 && this.start()
    };
    e.extend(d.prototype, {
        start: function () {
            null !== this.interval && clearInterval(this.interval);
            var e = this;
            this.update(), this.interval = setInterval(function () {
                e.update.call(e)
            }, this.options.precision)
        }, stop: function () {
            clearInterval(this.interval), this.interval = null, this.dispatchEvent("stoped")
        }, toggle: function () {
            this.interval ? this.stop() : this.start()
        }, pause: function () {
            this.stop()
        }, resume: function () {
            this.start()
        }, remove: function () {
            this.stop.call(this), r[this.instanceNumber] = null, delete this.$el.data().countdownInstance
        }, setFinalDate: function (e) {
            this.finalDate = t(e)
        }, update: function () {
            if (0 === this.$el.closest("html").length)return void this.remove();
            var t, n = void 0 !== e._data(this.el, "events"), i = new Date;
            t = this.finalDate.getTime() - i.getTime(), t = Math.ceil(t / 1e3), t = !this.options.elapse && 0 > t ? 0 : Math.abs(t), this.totalSecsLeft !== t && n && (this.totalSecsLeft = t, this.elapsed = i >= this.finalDate, this.offset = {
                seconds: this.totalSecsLeft % 60,
                minutes: Math.floor(this.totalSecsLeft / 60) % 60,
                hours: Math.floor(this.totalSecsLeft / 60 / 60) % 24,
                days: Math.floor(this.totalSecsLeft / 60 / 60 / 24) % 7,
                daysToWeek: Math.floor(this.totalSecsLeft / 60 / 60 / 24) % 7,
                daysToMonth: Math.floor(this.totalSecsLeft / 60 / 60 / 24 % 30.4368),
                weeks: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 7),
                weeksToMonth: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 7) % 4,
                months: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 30.4368),
                years: Math.abs(this.finalDate.getFullYear() - i.getFullYear()),
                totalDays: Math.floor(this.totalSecsLeft / 60 / 60 / 24),
                totalHours: Math.floor(this.totalSecsLeft / 60 / 60),
                totalMinutes: Math.floor(this.totalSecsLeft / 60),
                totalSeconds: this.totalSecsLeft
            }, this.options.elapse || 0 !== this.totalSecsLeft ? this.dispatchEvent("update") : (this.stop(), this.dispatchEvent("finish")))
        }, dispatchEvent: function (t) {
            var n = e.Event(t + ".countdown");
            n.finalDate = this.finalDate, n.elapsed = this.elapsed, n.offset = e.extend({}, this.offset), n.strftime = i(this.offset), this.$el.trigger(n)
        }
    }), e.fn.countdown = function () {
        var t = Array.prototype.slice.call(arguments, 0);
        return this.each(function () {
            var n = e(this).data("countdown-instance");
            if (void 0 !== n) {
                var i = r[n], a = t[0];
                d.prototype.hasOwnProperty(a) ? i[a].apply(i, t.slice(1)) : null === String(a).match(/^[$A-Z_][0-9A-Z_$]*$/i) ? (i.setFinalDate.call(i, a), i.start()) : e.error("Method %s does not exist on jQuery.countdown".replace(/\%s/gi, a))
            } else new d(this, t[0], t[1])
        })
    }
}), window.onload = function() {

    //BANDEAU AGE LEGAL
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    var sessionAge = getCookie("sessionAge");
    if (sessionAge != "") {
        document.getElementById("bandeau-age").style.display = "none";
    } else {
        document.getElementById("bandeau-age").style.display = "block";
        document.getElementById("bouton-bandeau").addEventListener("click", function (ev) {
            setCookie("sessionAge", "valide", 365);
            document.getElementById("bandeau-age").style.display = "none";
        });
    }

    //sessionStorage.setItem("SessionAge", "true");

    //PANIER
    var panier = JSON.parse(window.localStorage.getItem('panier'));
    var idList = "";
    var quantityList = "";

    var curCost = 0;
    var curName = 0;
    var cartItems = [];
    var cindex = 0;
    var fx = 0,
        fy = 0;
    var tx = 0,
        ty = 0;
    var curItem = "";
    var item_list = document.querySelectorAll(".add-item");
    $delivery = $("input[name=delivery]:checked").val();
    var delivery = Number($delivery);

    loadItems();

    document.getElementById("cost_delivery").innerHTML = delivery.toFixed(2);
    for (var i = 0; i < item_list.length; i++) {
        item_list[i].addEventListener("click", function(ev) {
            var id = this.getAttribute("data-id");
            var inCard = false;
            for(var j = 0 ; j < panier.length ; j++)
            {
                if(panier[j].id == id) {
                    inCard = true;
                    break;
                }
            }
            if(inCard)
                return;
            curCost = this.getAttribute("data-cost");
            curName = this.getAttribute("data-name");
            curImage = this.getAttribute("data-image");
            quantity = 1;


            panier.push({prix: curCost, nom: curName, image: curImage, id: id, quantity: quantity});
            window.localStorage.setItem('panier', JSON.stringify(panier));

            var x = $(this).position();
            fx = (((window.innerWidth) - 982) / 2) + (160 * (id - 1));
            (function() {
                mover_animator(fx, fy, tx, ty);
            })(setTimeout(function() {
                addItem(id, curCost, curName, curImage);
            }, 350));
            panierToString();
            $("#id_list").val(idList);
            $("#quantity_list").val(quantityList);
        })
    }

    $(document).on("click", ".cart-item-remove", function() {
        curCost = $(this).parent(".cart-item").find(".cvalue").text();

        //this.parentNode.remove(); // ie fix
        this.parentNode.outerHTML='';
        //$( "#items-counter" ).empty();
        toggleEptyCart();
        curCounter = $("#items .cart-item").length;
        $("#items-counter").empty();
        document.getElementById("items-counter").innerHTML += "<span class='animate'>" + curCounter +
            "<span class='circle'></span></span>";
        var quantity = 1;

        for(var i = 0; i < panier.length; i++)
        {
            if(panier[i].id == $(this).parent(".cart-item").attr("data-id"))
            {
                quantity = panier[i].quantity;
                panier.splice(i, 1);
                window.localStorage.setItem('panier', JSON.stringify(panier));
            }
        }
        panierToString();
        $("#id_list").val(idList);
        $("#quantity_list").val(quantityList);
        removeCost(curCost*quantity);
    });

    function addItem(id, cost) {
        cindex++;
        cartItems[cindex] = cost;
        $("#items-counter").empty();
        curCounter = (panier != null ? panier.length : $("#items .cart-item").length + 1);
        document.getElementById("items").innerHTML += "<div class='cart-item' id='item" + cindex +
            "' data-id='" + id + "'><span class='cart-item-image'><img alt='" + curName + "' src='" + curImage +
            "'/></span><span class='cart-item-name h4'>" + curName +
            "</span><span class='cart-item-price'>$<span class='cvalue'>" + cost +
            "</span></span><span class='cart-item-remove'>✘</span>" +
            "<br/><br/><br/><span class='cart cart-item-name'>quantity<input class='quantityInput' type='number' min='1' max='1023' data-id='" + id +"' value='"+quantity+"'></span></div>";
        document.getElementById("items-counter").innerHTML += "<span class='animate '><div class='caddie glyphicon glyphicon-shopping-cart'></div>" + curCounter +
            "<span class='circle'></span></span>";
        document.getElementById("item" + cindex).classList.remove("hidden");
        panierToString();
        $("#id_list").val(idList);
        $("#quantity_list").val(quantityList);
        toggleEptyCart();

        $('input').change(function() {
            $delivery = $(this).val();
            $total = document.getElementById("cost_value").innerHTML;
            var total = Number($total);
            var delivery = Number($delivery);
            var carttotal = total + delivery;
            document.getElementById("total-total").innerHTML = carttotal.toFixed(2);
            $("#amount").val(carttotal.toFixed(2));
            document.getElementById("cost_delivery").innerHTML = delivery.toFixed(2);


            var id = this.getAttribute("data-id");
            var value = this.value;
            panier.forEach(function (element) {
                if(element.id == id){
                    var diff = element.quantity - value;
                    element.quantity = value;
                    removeCost(diff*element.prix);
                    window.localStorage.setItem('panier', JSON.stringify(panier));
                }
            });

            panierToString();
            $("#quantity_list").val(quantityList);
        });
    }

    function addCost(amount) {
        $delivery = $("input[name=delivery]:checked").val();
        var delivery = Number($delivery);
        var oldcost = document.getElementById("cost_value").innerHTML;
        oldcost = parseFloat(oldcost);
        amount = parseFloat(amount);
        var newcost = oldcost + amount;
        var total = oldcost + amount;
        document.getElementById("cost_value").innerHTML = newcost.toFixed(2);
        var carttotal = total + delivery;
        document.getElementById("total-total").innerHTML = carttotal.toFixed(2);
        $("#amount").val(carttotal.toFixed(2));
    }

    function loadItems() {
        if(panier == null){
            panier = [];
        }else {
            if(panier.length > 0){
                for(var indice = 0; indice < panier.length; indice++){
                    curCost = panier[indice].prix;
                    curName = panier[indice].nom;
                    curImage = panier[indice].image;
                    cindex = panier[indice].id;
                    quantity = panier[indice].quantity;
                    addItem(cindex, curCost, quantity, curName, curImage);
                    addCost(curCost*quantity);
                }
            }
        }
        panierToString();
        $("#id_list").val(idList);
        $("#quantity_list").val(quantityList);
    }

    function panierToString(){
        idList = "";
        quantityList = "";
        if(panier.length > 0){
            for(var i = 0; i < panier.length - 1; i++){
                idList += panier[i].id + ",";
                quantityList += panier[i].quantity + ",";
            }
            idList += panier[i].id;
            quantityList += panier[i].quantity;
        }

    }

    function removeItem() {}

    function removeCost(amount) {
        $delivery = $("input[name=delivery]:checked").val();
        var delivery = Number($delivery);
        var oldcost = document.getElementById("cost_value").innerHTML;
        oldcost = parseFloat(oldcost);
        amount = parseFloat(amount);
        var newcost = (oldcost - amount);
        if (newcost == "NaN") {
            newcost = 0.00
        }
        var total = (oldcost - amount);
        if (total == "NaN") {
            total = 0.00
        }
        var carttotal = total + delivery;
        document.getElementById("total-total").innerHTML = carttotal.toFixed(2);
        document.getElementById("cost_value").innerHTML = newcost.toFixed(2);
        document.getElementById("cost_delivery").innerHTML = delivery.toFixed(2);
        $("#amount").val(carttotal.toFixed(2));
    }

    function mover_animator(x1, y1, x2, y2) {
        var div = document.createElement("div");
        div.className = "mover_animator " + cindex;
        div.style.display = "none";
        document.body.appendChild(div);
        $(div).css({
            "left": x1 + "px",
            "bottom": y1 + "px",
            "top": "auto",
            "right": "auto"
        })
            .fadeIn(10)
            .animate({
                "right": "auto",
                "top": "auto",
                "left": (window.innerWidth - 200) + "px",
                "bottom": (window.innerHeight - 240) + "px"
            }, 300, function() {
                addCost(curCost)
            })
        setTimeout(function() {
            $(div).remove();
            toggleEptyCart();
        }, 200);
    }

    function updateNumber() {
        var nums = document.querySelectorAll(".cart-item");
        var len = nums.length;
        if (len > 0) {
            for (var i = 0; i < len; i++) {
                nums[i].querySelector(".cart-item-name h3").innerHTML = "Item " + (i + 1) + " ---";
            }
        }
    }

    function toggleEptyCart() {
        if (document.querySelectorAll(".cart-item").length >= 1) {
            document.getElementById("cart-summary").style.display = "block";
            document.getElementById("cart-delivery").style.display = "block";
            document.getElementById("cart-form").style.display = "block";
            document.getElementById("cart-empty").style.display = "none";
            document.getElementById("items-counter").style.display = "block";
        }
        else {
            document.getElementById("cart-summary").style.display = "none";
            document.getElementById("cart-delivery").style.display = "none";
            document.getElementById("cart-form").style.display = "none";
            document.getElementById("cart-empty").style.display = "block";
            document.getElementById("items-counter").style.display = "none";
        }
    }
},
    // COUNTDOWN
    $('#countdown').countdown('2018/10/10', function(event) {
        var $this = $(this).html(event.strftime(''
            //+ '<li><span>%w</span> weeks</li> '
            + '<li><span>%D</span> days</li> '
            + '<li><span>%H</span> hr</li> '
            + '<li><span>%M</span> min</li> '
            + '<li><span>%S</span> sec</li>'));
    }),
    // initialize and configuration for wow js - animations
    wow = new WOW({
        animateClass: 'animated',
        offset: 100,
        mobile: false,
        callback: function(box) {
            //console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
    }), wow.init(), $(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle=popover]').popover();
}),
    // js counters
    $('#about-counter').bind('inview', function(event, visible, visiblePartX, visiblePartY) {
        if (visible) {
            $(this).find('.timer').each(function() {
                var $this = $(this);
                $({
                    Counter: 0
                }).animate({
                    Counter: $this.text()
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function() {
                        $this.text(Math.ceil(this.Counter));
                    }
                });
            });
            $(this).unbind('inview');
        }
    }),
    // cart widget toggle
    $(function() {
        $("#items-counter").click(function() {
            $("body").toggleClass("cart-widget-open");
        });
        $("#cart-widget-close").click(function() {
            /* sert à rafraichir la table reservation (et donc également la table product) dans la DB
            $.post(refresh_route, { panier: JSON.parse(window.localStorage.getItem('panier')) })
                .done(function (data) {
                
                })
                .fail(function (data) {

            });
            */
            
            $("body").toggleClass("cart-widget-open");
        });

    });
//initialize swipers
//home slider
var swiper = new Swiper('.home-slider', {
    pagination: '.home-pagination',
    paginationClickable: true,
    nextButton: '.home-slider-next',
    prevButton: '.home-slider-prev'
}), swiper = new Swiper(".testimonials-slider", {
    pagination: ".testimonials-pagination",
    paginationClickable: !0,
    slidesPerView: 1,
    spaceBetween: 30,
    nextButton: ".testimonials-slider-next",
    prevButton: ".testimonials-slider-prev"
}), swiper = new Swiper(".product-list-slider", {
    slidesPerView: 3,
    pagination: ".product-list-pagination",
    paginationClickable: !0,
    nextButton: ".product-list-slider-next",
    prevButton: ".product-list-slider-prev",
    spaceBetween: 30,
    breakpoints: {
        1024: {slidesPerView: 2, spaceBetween: 30},
        768: {slidesPerView: 2, spaceBetween: 30},
        640: {slidesPerView: 2, spaceBetween: 20},
        420: {slidesPerView: 1, spaceBetween: 10}
    }
}), swiper = new Swiper(".post-slider", {
    pagination: ".post-pagination",
    paginationClickable: !0,
    nextButton: ".post-slider-next",
    prevButton: ".post-slider-prev",
    slidesPerView: 3,
    spaceBetween: 30,
    breakpoints: {
        1024: {slidesPerView: 2, spaceBetween: 30},
        768: {slidesPerView: 2, spaceBetween: 30},
        640: {slidesPerView: 1, spaceBetween: 0},
        320: {slidesPerView: 1, spaceBetween: 0}
    }
});
// smoth scroll
$(".navbar-nav li a[href^='#']").on("click", function (e) {
    // prevent default anchor click behavior
    e.preventDefault();

    // store hash
    var hash = this.hash;

    // animate
    $('html, body').animate({
        scrollTop: $(this.hash).offset().top
    }, 300, function(){

        // when done, add hash to url
        // (default click behaviour)
        window.location.hash = hash;
    });

});
//var map, mapAddress = new google.maps.LatLng(52.406374, 16.925168100000064);
//google.maps.event.addDomListener(window, "load", initialize);







