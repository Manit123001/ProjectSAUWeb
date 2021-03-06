(function(factory) {
	if (typeof define === 'function' && define.amd) {
		// AMD
		define(['jquery'], factory);
	} else if (typeof exports === 'object') {
		// CommonJS
		factory(require('jquery'));
	} else {
		// Browser globals
		factory(jQuery);
	}
}(function($) {

	var pluses = /\+/g;

	function encode(s) {
		return config.raw ? s : encodeURIComponent(s);
	}

	function decode(s) {
		return config.raw ? s : decodeURIComponent(s);
	}

	function stringifyCookieValue(value) {
		return encode(config.json ? JSON.stringify(value) : String(value));
	}

	function parseCookieValue(s) {
		if (s.indexOf('"') === 0) {
			// This is a quoted cookie as according to RFC2068, unescape...
			s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
		}

		try {
			// Replace server-side written pluses with spaces.
			// If we can't decode the cookie, ignore it, it's unusable.
			// If we can't parse the cookie, ignore it, it's unusable.
			s = decodeURIComponent(s.replace(pluses, ' '));
			return config.json ? JSON.parse(s) : s;
		} catch (e) {}
	}

	function read(s, converter) {
		var value = config.raw ? s : parseCookieValue(s);
		return $.isFunction(converter) ? converter(value) : value;
	}

	var config = $.cookie = function(key, value, options) {

		// Write

		if (value !== undefined && !$.isFunction(value)) {
			options = $.extend({}, config.defaults, options);

			if (typeof options.expires === 'number') {
				var days = options.expires,
					t = options.expires = new Date();
				t.setTime(+t + days * 864e+5);
			}

			return (document.cookie = [
				encode(key), '=', stringifyCookieValue(value),
				options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
				options.path ? '; path=' + options.path : '',
				options.domain ? '; domain=' + options.domain : '',
				options.secure ? '; secure' : ''
			].join(''));
		}

		// Read

		var result = key ? undefined : {};

		// To prevent the for loop in the first place assign an empty array
		// in case there are no cookies at all. Also prevents odd result when
		// calling $.cookie().
		var cookies = document.cookie ? document.cookie.split('; ') : [];

		for (var i = 0, l = cookies.length; i < l; i++) {
			var parts = cookies[i].split('=');
			var name = decode(parts.shift());
			var cookie = parts.join('=');

			if (key && key === name) {
				// If second argument (value) is a function it's a converter...
				result = read(cookie, value);
				break;
			}

			// Prevent storing a cookie that we couldn't decode.
			if (!key && (cookie = read(cookie)) !== undefined) {
				result[name] = cookie;
			}
		}

		return result;
	};

	config.defaults = {};

	$.removeCookie = function(key, options) {
		if ($.cookie(key) === undefined) {
			return false;
		}

		// Must not alter options, thus extending a fresh object...
		$.cookie(key, '', $.extend({}, options, {
			expires: -1
		}));
		return !$.cookie(key);
	};

}));

/*!
 * The Final Countdown for jQuery v2.1.0 (http://hilios.github.io/jQuery.countdown/)
 * Copyright (c) 2015 Edson Hilios
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in
 * the Software without restriction, including without limitation the rights to
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
 * the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 * FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
 * IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 * CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
! function(a) {
	"use strict";
	"function" == typeof define && define.amd ? define(["jquery"], a) : a(jQuery)
}(function(a) {
	"use strict";

	function b(a) {
		if (a instanceof Date) return a;
		if (String(a).match(g)) return String(a).match(/^[0-9]*$/) && (a = Number(a)),
			String(a).match(/\-/) && (a = String(a).replace(/\-/g, "/")), new Date(a);
		throw new Error("Couldn't cast `" + a + "` to a date object.")
	}

	function c(a) {
		var b = a.toString().replace(/([.?*+^$[\]\\(){}|-])/g, "\\$1");
		return new RegExp(b)
	}

	function d(a) {
		return function(b) {
			var d = b.match(/%(-|!)?[A-Z]{1}(:[^;]+;)?/gi);
			if (d)
				for (var f = 0, g = d.length; g > f; ++f) {
					var h = d[f].match(/%(-|!)?([a-zA-Z]{1})(:[^;]+;)?/),
						j = c(h[0]),
						k = h[1] || "",
						l = h[3] || "",
						m = null;
					h = h[2], i.hasOwnProperty(h) && (m = i[h], m = Number(a[m])), null !==
						m && ("!" === k && (m = e(l, m)), "" === k && 10 > m && (m = "0" + m.toString()),
							b = b.replace(j, m.toString()))
				}
			return b = b.replace(/%%/, "%")
		}
	}

	function e(a, b) {
		var c = "s",
			d = "";
		return a && (a = a.replace(/(:|;|\s)/gi, "").split(/\,/), 1 === a.length ? c =
			a[0] : (d = a[0], c = a[1])), 1 === Math.abs(b) ? d : c
	}
	var f = [],
		g = [],
		h = {
			precision: 100,
			elapse: !1
		};
	g.push(/^[0-9]*$/.source), g.push(
			/([0-9]{1,2}\/){2}[0-9]{4}( [0-9]{1,2}(:[0-9]{2}){2})?/.source), g.push(
			/[0-9]{4}([\/\-][0-9]{1,2}){2}( [0-9]{1,2}(:[0-9]{2}){2})?/.source), g =
		new RegExp(g.join("|"));
	var i = {
			Y: "years",
			m: "months",
			n: "daysToMonth",
			w: "weeks",
			d: "daysToWeek",
			D: "totalDays",
			H: "hours",
			M: "minutes",
			S: "seconds"
		},
		j = function(b, c, d) {
			this.el = b, this.$el = a(b), this.interval = null, this.offset = {}, this.options =
				a.extend({}, h), this.instanceNumber = f.length, f.push(this), this.$el.data(
					"countdown-instance", this.instanceNumber), d && ("function" == typeof d ?
					(this.$el.on("update.countdown", d), this.$el.on("stoped.countdown", d),
						this.$el.on("finish.countdown", d)) : this.options = a.extend({}, h, d)),
				this.setFinalDate(c), this.start()
		};
	a.extend(j.prototype, {
		start: function() {
			null !== this.interval && clearInterval(this.interval);
			var a = this;
			this.update(), this.interval = setInterval(function() {
				a.update.call(a)
			}, this.options.precision)
		},
		stop: function() {
			clearInterval(this.interval), this.interval = null, this.dispatchEvent(
				"stoped")
		},
		toggle: function() {
			this.interval ? this.stop() : this.start()
		},
		pause: function() {
			this.stop()
		},
		resume: function() {
			this.start()
		},
		remove: function() {
			this.stop.call(this), f[this.instanceNumber] = null, delete this.$el.data()
				.countdownInstance
		},
		setFinalDate: function(a) {
			this.finalDate = b(a)
		},
		update: function() {
			if (0 === this.$el.closest("html").length) return void this.remove();
			var b, c = void 0 !== a._data(this.el, "events"),
				d = new Date;
			b = this.finalDate.getTime() - d.getTime(), b = Math.ceil(b / 1e3), b = !
				this.options.elapse && 0 > b ? 0 : Math.abs(b), this.totalSecsLeft !==
				b && c && (this.totalSecsLeft = b, this.elapsed = d >= this.finalDate,
					this.offset = {
						seconds: this.totalSecsLeft % 60,
						minutes: Math.floor(this.totalSecsLeft / 60) % 60,
						hours: Math.floor(this.totalSecsLeft / 60 / 60) % 24,
						days: Math.floor(this.totalSecsLeft / 60 / 60 / 24) % 7,
						daysToWeek: Math.floor(this.totalSecsLeft / 60 / 60 / 24) % 7,
						daysToMonth: Math.floor(this.totalSecsLeft / 60 / 60 / 24 % 30.4368),
						totalDays: Math.floor(this.totalSecsLeft / 60 / 60 / 24),
						weeks: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 7),
						months: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 30.4368),
						years: Math.abs(this.finalDate.getFullYear() - d.getFullYear())
					}, this.options.elapse || 0 !== this.totalSecsLeft ? this.dispatchEvent(
						"update") : (this.stop(), this.dispatchEvent("finish")))
		},
		dispatchEvent: function(b) {
			var c = a.Event(b + ".countdown");
			c.finalDate = this.finalDate, c.elapsed = this.elapsed, c.offset = a.extend({},
				this.offset), c.strftime = d(this.offset), this.$el.trigger(c)
		}
	}), a.fn.countdown = function() {
		var b = Array.prototype.slice.call(arguments, 0);
		return this.each(function() {
			var c = a(this).data("countdown-instance");
			if (void 0 !== c) {
				var d = f[c],
					e = b[0];
				j.prototype.hasOwnProperty(e) ? d[e].apply(d, b.slice(1)) : null ===
					String(e).match(/^[$A-Z_][0-9A-Z_$]*$/i) ? (d.setFinalDate.call(d, e),
						d.start()) : a.error("Method %s does not exist on jQuery.countdown".replace(
						/\%s/gi, e))
			} else new j(this, b[0], b[1])
		})
	}
});
/*!
 * jQuery Mousewheel 3.1.13
 *
 * Copyright 2015 jQuery Foundation and other contributors
 * Released under the MIT license.
 * http://jquery.org/license
 */
! function(a) {
	"function" == typeof define && define.amd ? define(["jquery"], a) : "object" ==
		typeof exports ? module.exports = a : a(jQuery)
}(function(a) {
	function b(b) {
		var g = b || window.event,
			h = i.call(arguments, 1),
			j = 0,
			l = 0,
			m = 0,
			n = 0,
			o = 0,
			p = 0;
		if (b = a.event.fix(g), b.type = "mousewheel", "detail" in g && (m = -1 * g.detail),
			"wheelDelta" in g && (m = g.wheelDelta), "wheelDeltaY" in g && (m = g.wheelDeltaY),
			"wheelDeltaX" in g && (l = -1 * g.wheelDeltaX), "axis" in g && g.axis === g
			.HORIZONTAL_AXIS && (l = -1 * m, m = 0), j = 0 === m ? l : m, "deltaY" in g &&
			(m = -1 * g.deltaY, j = m), "deltaX" in g && (l = g.deltaX, 0 === m && (j = -
				1 * l)), 0 !== m || 0 !== l) {
			if (1 === g.deltaMode) {
				var q = a.data(this, "mousewheel-line-height");
				j *= q, m *= q, l *= q
			} else if (2 === g.deltaMode) {
				var r = a.data(this, "mousewheel-page-height");
				j *= r, m *= r, l *= r
			}
			if (n = Math.max(Math.abs(m), Math.abs(l)), (!f || f > n) && (f = n, d(g, n) &&
					(f /= 40)), d(g, n) && (j /= 40, l /= 40, m /= 40), j = Math[j >= 1 ?
					"floor" : "ceil"](j / f), l = Math[l >= 1 ? "floor" : "ceil"](l / f), m =
				Math[m >= 1 ? "floor" : "ceil"](m / f), k.settings.normalizeOffset && this
				.getBoundingClientRect) {
				var s = this.getBoundingClientRect();
				o = b.clientX - s.left, p = b.clientY - s.top
			}
			return b.deltaX = l, b.deltaY = m, b.deltaFactor = f, b.offsetX = o, b.offsetY =
				p, b.deltaMode = 0, h.unshift(b, j, l, m), e && clearTimeout(e), e =
				setTimeout(c, 200), (a.event.dispatch || a.event.handle).apply(this, h)
		}
	}

	function c() {
		f = null
	}

	function d(a, b) {
		return k.settings.adjustOldDeltas && "mousewheel" === a.type && b % 120 ===
			0
	}
	var e, f, g = ["wheel", "mousewheel", "DOMMouseScroll", "MozMousePixelScroll"],
		h = "onwheel" in document || document.documentMode >= 9 ? ["wheel"] : [
			"mousewheel", "DomMouseScroll", "MozMousePixelScroll"
		],
		i = Array.prototype.slice;
	if (a.event.fixHooks)
		for (var j = g.length; j;) a.event.fixHooks[g[--j]] = a.event.mouseHooks;
	var k = a.event.special.mousewheel = {
		version: "3.1.12",
		setup: function() {
			if (this.addEventListener)
				for (var c = h.length; c;) this.addEventListener(h[--c], b, !1);
			else this.onmousewheel = b;
			a.data(this, "mousewheel-line-height", k.getLineHeight(this)), a.data(
				this, "mousewheel-page-height", k.getPageHeight(this))
		},
		teardown: function() {
			if (this.removeEventListener)
				for (var c = h.length; c;) this.removeEventListener(h[--c], b, !1);
			else this.onmousewheel = null;
			a.removeData(this, "mousewheel-line-height"), a.removeData(this,
				"mousewheel-page-height")
		},
		getLineHeight: function(b) {
			var c = a(b),
				d = c["offsetParent" in a.fn ? "offsetParent" : "parent"]();
			return d.length || (d = a("body")), parseInt(d.css("fontSize"), 10) ||
				parseInt(c.css("fontSize"), 10) || 16
		},
		getPageHeight: function(b) {
			return a(b).height()
		},
		settings: {
			adjustOldDeltas: !0,
			normalizeOffset: !0
		}
	};
	a.fn.extend({
		mousewheel: function(a) {
			return a ? this.bind("mousewheel", a) : this.trigger("mousewheel")
		},
		unmousewheel: function(a) {
			return this.unbind("mousewheel", a)
		}
	})
});
/*!
 * Bootstrap v3.3.6 (http://getbootstrap.com)
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under the MIT license
 */
if ("undefined" == typeof jQuery) throw new Error(
	"Bootstrap's JavaScript requires jQuery"); + function(a) {
	"use strict";
	var b = a.fn.jquery.split(" ")[0].split(".");
	if (b[0] < 2 && b[1] < 9 || 1 == b[0] && 9 == b[1] && b[2] < 1 || b[0] > 2)
		throw new Error(
			"Bootstrap's JavaScript requires jQuery version 1.9.1 or higher, but lower than version 3"
		)
}(jQuery), + function(a) {
	"use strict";

	function b() {
		var a = document.createElement("bootstrap"),
			b = {
				WebkitTransition: "webkitTransitionEnd",
				MozTransition: "transitionend",
				OTransition: "oTransitionEnd otransitionend",
				transition: "transitionend"
			};
		for (var c in b)
			if (void 0 !== a.style[c]) return {
				end: b[c]
			};
		return !1
	}
	a.fn.emulateTransitionEnd = function(b) {
		var c = !1,
			d = this;
		a(this).one("bsTransitionEnd", function() {
			c = !0
		});
		var e = function() {
			c || a(d).trigger(a.support.transition.end)
		};
		return setTimeout(e, b), this
	}, a(function() {
		a.support.transition = b(), a.support.transition && (a.event.special.bsTransitionEnd = {
			bindType: a.support.transition.end,
			delegateType: a.support.transition.end,
			handle: function(b) {
				return a(b.target).is(this) ? b.handleObj.handler.apply(this,
					arguments) : void 0
			}
		})
	})
}(jQuery), + function(a) {
	"use strict";

	function b(b) {
		return this.each(function() {
			var c = a(this),
				e = c.data("bs.alert");
			e || c.data("bs.alert", e = new d(this)), "string" == typeof b && e[b].call(
				c)
		})
	}
	var c = '[data-dismiss="alert"]',
		d = function(b) {
			a(b).on("click", c, this.close)
		};
	d.VERSION = "3.3.6", d.TRANSITION_DURATION = 150, d.prototype.close = function(
		b) {
		function c() {
			g.detach().trigger("closed.bs.alert").remove()
		}
		var e = a(this),
			f = e.attr("data-target");
		f || (f = e.attr("href"), f = f && f.replace(/.*(?=#[^\s]*$)/, ""));
		var g = a(f);
		b && b.preventDefault(), g.length || (g = e.closest(".alert")), g.trigger(b =
			a.Event("close.bs.alert")), b.isDefaultPrevented() || (g.removeClass("in"),
			a.support.transition && g.hasClass("fade") ? g.one("bsTransitionEnd", c).emulateTransitionEnd(
				d.TRANSITION_DURATION) : c())
	};
	var e = a.fn.alert;
	a.fn.alert = b, a.fn.alert.Constructor = d, a.fn.alert.noConflict = function() {
		return a.fn.alert = e, this
	}, a(document).on("click.bs.alert.data-api", c, d.prototype.close)
}(jQuery), + function(a) {
	"use strict";

	function b(b) {
		return this.each(function() {
			var d = a(this),
				e = d.data("bs.button"),
				f = "object" == typeof b && b;
			e || d.data("bs.button", e = new c(this, f)), "toggle" == b ? e.toggle() :
				b && e.setState(b)
		})
	}
	var c = function(b, d) {
		this.$element = a(b), this.options = a.extend({}, c.DEFAULTS, d), this.isLoading = !
			1
	};
	c.VERSION = "3.3.6", c.DEFAULTS = {
		loadingText: "loading..."
	}, c.prototype.setState = function(b) {
		var c = "disabled",
			d = this.$element,
			e = d.is("input") ? "val" : "html",
			f = d.data();
		b += "Text", null == f.resetText && d.data("resetText", d[e]()), setTimeout(
			a.proxy(function() {
				d[e](null == f[b] ? this.options[b] : f[b]), "loadingText" == b ? (this.isLoading = !
					0, d.addClass(c).attr(c, c)) : this.isLoading && (this.isLoading = !1,
					d.removeClass(c).removeAttr(c))
			}, this), 0)
	}, c.prototype.toggle = function() {
		var a = !0,
			b = this.$element.closest('[data-toggle1="buttons"]');
		if (b.length) {
			var c = this.$element.find("input");
			"radio" == c.prop("type") ? (c.prop("checked") && (a = !1), b.find(
					".active").removeClass("active"), this.$element.addClass("active")) :
				"checkbox" == c.prop("type") && (c.prop("checked") !== this.$element.hasClass(
					"active") && (a = !1), this.$element.toggleClass("active")), c.prop(
					"checked", this.$element.hasClass("active")), a && c.trigger("change")
		} else this.$element.attr("aria-pressed", !this.$element.hasClass("active")),
			this.$element.toggleClass("active")
	};
	var d = a.fn.button;
	a.fn.button = b, a.fn.button.Constructor = c, a.fn.button.noConflict =
		function() {
			return a.fn.button = d, this
		}, a(document).on("click.bs.button.data-api", '[data-toggle1^="button"]',
			function(c) {
				var d = a(c.target);
				d.hasClass("btn") || (d = d.closest(".btn")), b.call(d, "toggle"), a(c.target)
					.is('input[type="radio"]') || a(c.target).is('input[type="checkbox"]') ||
					c.preventDefault()
			}).on("focus.bs.button.data-api blur.bs.button.data-api",
			'[data-toggle1^="button"]',
			function(b) {
				a(b.target).closest(".btn").toggleClass("focus", /^focus(in)?$/.test(b.type))
			})
}(jQuery), + function(a) {
	"use strict";

	function b(b) {
		return this.each(function() {
			var d = a(this),
				e = d.data("bs.carousel"),
				f = a.extend({}, c.DEFAULTS, d.data(), "object" == typeof b && b),
				g = "string" == typeof b ? b : f.slide;
			e || d.data("bs.carousel", e = new c(this, f)), "number" == typeof b ? e.to(
				b) : g ? e[g]() : f.interval && e.pause().cycle()
		})
	}
	var c = function(b, c) {
		this.$element = a(b), this.$indicators = this.$element.find(
				".carousel-indicators"), this.options = c, this.paused = null, this.sliding =
			null, this.interval = null, this.$active = null, this.$items = null, this.options
			.keyboard && this.$element.on("keydown.bs.carousel", a.proxy(this.keydown,
				this)), "hover" == this.options.pause && !("ontouchstart" in document.documentElement) &&
			this.$element.on("mouseenter.bs.carousel", a.proxy(this.pause, this)).on(
				"mouseleave.bs.carousel", a.proxy(this.cycle, this))
	};
	c.VERSION = "3.3.6", c.TRANSITION_DURATION = 600, c.DEFAULTS = {
		interval: 5e3,
		pause: "hover",
		wrap: !0,
		keyboard: !0
	}, c.prototype.keydown = function(a) {
		if (!/input|textarea/i.test(a.target.tagName)) {
			switch (a.which) {
				case 37:
					this.prev();
					break;
				case 39:
					this.next();
					break;
				default:
					return
			}
			a.preventDefault()
		}
	}, c.prototype.cycle = function(b) {
		return b || (this.paused = !1), this.interval && clearInterval(this.interval),
			this.options.interval && !this.paused && (this.interval = setInterval(a.proxy(
				this.next, this), this.options.interval)), this
	}, c.prototype.getItemIndex = function(a) {
		return this.$items = a.parent().children(".item"), this.$items.index(a ||
			this.$active)
	}, c.prototype.getItemForDirection = function(a, b) {
		var c = this.getItemIndex(b),
			d = "prev" == a && 0 === c || "next" == a && c == this.$items.length - 1;
		if (d && !this.options.wrap) return b;
		var e = "prev" == a ? -1 : 1,
			f = (c + e) % this.$items.length;
		return this.$items.eq(f)
	}, c.prototype.to = function(a) {
		var b = this,
			c = this.getItemIndex(this.$active = this.$element.find(".item.active"));
		return a > this.$items.length - 1 || 0 > a ? void 0 : this.sliding ? this.$element
			.one("slid.bs.carousel", function() {
				b.to(a)
			}) : c == a ? this.pause().cycle() : this.slide(a > c ? "next" : "prev",
				this.$items.eq(a))
	}, c.prototype.pause = function(b) {
		return b || (this.paused = !0), this.$element.find(".next, .prev").length &&
			a.support.transition && (this.$element.trigger(a.support.transition.end),
				this.cycle(!0)), this.interval = clearInterval(this.interval), this
	}, c.prototype.next = function() {
		return this.sliding ? void 0 : this.slide("next")
	}, c.prototype.prev = function() {
		return this.sliding ? void 0 : this.slide("prev")
	}, c.prototype.slide = function(b, d) {
		var e = this.$element.find(".item.active"),
			f = d || this.getItemForDirection(b, e),
			g = this.interval,
			h = "next" == b ? "left" : "right",
			i = this;
		if (f.hasClass("active")) return this.sliding = !1;
		var j = f[0],
			k = a.Event("slide.bs.carousel", {
				relatedTarget: j,
				direction: h
			});
		if (this.$element.trigger(k), !k.isDefaultPrevented()) {
			if (this.sliding = !0, g && this.pause(), this.$indicators.length) {
				this.$indicators.find(".active").removeClass("active");
				var l = a(this.$indicators.children()[this.getItemIndex(f)]);
				l && l.addClass("active")
			}
			var m = a.Event("slid.bs.carousel", {
				relatedTarget: j,
				direction: h
			});
			return a.support.transition && this.$element.hasClass("slide") ? (f.addClass(
					b), f[0].offsetWidth, e.addClass(h), f.addClass(h), e.one(
					"bsTransitionEnd",
					function() {
						f.removeClass([b, h].join(" ")).addClass("active"), e.removeClass([
							"active", h
						].join(" ")), i.sliding = !1, setTimeout(function() {
							i.$element.trigger(m)
						}, 0)
					}).emulateTransitionEnd(c.TRANSITION_DURATION)) : (e.removeClass("active"),
					f.addClass("active"), this.sliding = !1, this.$element.trigger(m)), g &&
				this.cycle(), this
		}
	};
	var d = a.fn.carousel;
	a.fn.carousel = b, a.fn.carousel.Constructor = c, a.fn.carousel.noConflict =
		function() {
			return a.fn.carousel = d, this
		};
	var e = function(c) {
		var d, e = a(this),
			f = a(e.attr("data-target") || (d = e.attr("href")) && d.replace(
				/.*(?=#[^\s]+$)/, ""));
		if (f.hasClass("carousel")) {
			var g = a.extend({}, f.data(), e.data()),
				h = e.attr("data-slide-to");
			h && (g.interval = !1), b.call(f, g), h && f.data("bs.carousel").to(h), c.preventDefault()
		}
	};
	a(document).on("click.bs.carousel.data-api", "[data-slide]", e).on(
		"click.bs.carousel.data-api", "[data-slide-to]", e), a(window).on("load",
		function() {
			a('[data-ride="carousel"]').each(function() {
				var c = a(this);
				b.call(c, c.data())
			})
		})
}(jQuery), + function(a) {
	"use strict";

	function b(b) {
		var c, d = b.attr("data-target") || (c = b.attr("href")) && c.replace(
			/.*(?=#[^\s]+$)/, "");
		return a(d)
	}

	function c(b) {
		return this.each(function() {
			var c = a(this),
				e = c.data("bs.collapse"),
				f = a.extend({}, d.DEFAULTS, c.data(), "object" == typeof b && b);
			!e && f.toggle && /show|hide/.test(b) && (f.toggle = !1), e || c.data(
				"bs.collapse", e = new d(this, f)), "string" == typeof b && e[b]()
		})
	}
	var d = function(b, c) {
		this.$element = a(b), this.options = a.extend({}, d.DEFAULTS, c), this.$trigger =
			a('[data-toggle1="collapse"][href="#' + b.id +
				'"],[data-toggle1="collapse"][data-target="#' + b.id + '"]'), this.transitioning =
			null, this.options.parent ? this.$parent = this.getParent() : this.addAriaAndCollapsedClass(
				this.$element, this.$trigger), this.options.toggle && this.toggle()
	};
	d.VERSION = "3.3.6", d.TRANSITION_DURATION = 350, d.DEFAULTS = {
		toggle: !0
	}, d.prototype.dimension = function() {
		var a = this.$element.hasClass("width");
		return a ? "width" : "height"
	}, d.prototype.show = function() {
		if (!this.transitioning && !this.$element.hasClass("in")) {
			var b, e = this.$parent && this.$parent.children(".panel").children(
				".in, .collapsing");
			if (!(e && e.length && (b = e.data("bs.collapse"), b && b.transitioning))) {
				var f = a.Event("show.bs.collapse");
				if (this.$element.trigger(f), !f.isDefaultPrevented()) {
					e && e.length && (c.call(e, "hide"), b || e.data("bs.collapse", null));
					var g = this.dimension();
					this.$element.removeClass("collapse").addClass("collapsing")[g](0).attr(
						"aria-expanded", !0), this.$trigger.removeClass("collapsed").attr(
						"aria-expanded", !0), this.transitioning = 1;
					var h = function() {
						this.$element.removeClass("collapsing").addClass("collapse in")[g](""),
							this.transitioning = 0, this.$element.trigger("shown.bs.collapse")
					};
					if (!a.support.transition) return h.call(this);
					var i = a.camelCase(["scroll", g].join("-"));
					this.$element.one("bsTransitionEnd", a.proxy(h, this)).emulateTransitionEnd(
						d.TRANSITION_DURATION)[g](this.$element[0][i])
				}
			}
		}
	}, d.prototype.hide = function() {
		if (!this.transitioning && this.$element.hasClass("in")) {
			var b = a.Event("hide.bs.collapse");
			if (this.$element.trigger(b), !b.isDefaultPrevented()) {
				var c = this.dimension();
				this.$element[c](this.$element[c]())[0].offsetHeight, this.$element.addClass(
						"collapsing").removeClass("collapse in").attr("aria-expanded", !1), this
					.$trigger.addClass("collapsed").attr("aria-expanded", !1), this.transitioning =
					1;
				var e = function() {
					this.transitioning = 0, this.$element.removeClass("collapsing").addClass(
						"collapse").trigger("hidden.bs.collapse")
				};
				return a.support.transition ? void this.$element[c](0).one(
						"bsTransitionEnd", a.proxy(e, this)).emulateTransitionEnd(d.TRANSITION_DURATION) :
					e.call(this)
			}
		}
	}, d.prototype.toggle = function() {
		this[this.$element.hasClass("in") ? "hide" : "show"]()
	}, d.prototype.getParent = function() {
		return a(this.options.parent).find('[data-toggle1="collapse"][data-parent="' +
			this.options.parent + '"]').each(a.proxy(function(c, d) {
			var e = a(d);
			this.addAriaAndCollapsedClass(b(e), e)
		}, this)).end()
	}, d.prototype.addAriaAndCollapsedClass = function(a, b) {
		var c = a.hasClass("in");
		a.attr("aria-expanded", c), b.toggleClass("collapsed", !c).attr(
			"aria-expanded", c)
	};
	var e = a.fn.collapse;
	a.fn.collapse = c, a.fn.collapse.Constructor = d, a.fn.collapse.noConflict =
		function() {
			return a.fn.collapse = e, this
		}, a(document).on("click.bs.collapse.data-api", '[data-toggle1="collapse"]',
			function(d) {
				var e = a(this);
				e.attr("data-target") || d.preventDefault();
				var f = b(e),
					g = f.data("bs.collapse"),
					h = g ? "toggle" : e.data();
				c.call(f, h)
			})
}(jQuery), + function(a) {
	"use strict";

	function b(b) {
		var c = b.attr("data-target");
		c || (c = b.attr("href"), c = c && /#[A-Za-z]/.test(c) && c.replace(
			/.*(?=#[^\s]*$)/, ""));
		var d = c && a(c);
		return d && d.length ? d : b.parent()
	}

	function c(c) {
		c && 3 === c.which || (a(e).remove(), a(f).each(function() {
			var d = a(this),
				e = b(d),
				f = {
					relatedTarget: this
				};
			e.hasClass("open") && (c && "click" == c.type && /input|textarea/i.test(c
				.target.tagName) && a.contains(e[0], c.target) || (e.trigger(c = a.Event(
				"hide.bs.dropdown", f)), c.isDefaultPrevented() || (d.attr(
				"aria-expanded", "false"), e.removeClass("open").trigger(a.Event(
				"hidden.bs.dropdown", f)))))
		}))
	}

	function d(b) {
		return this.each(function() {
			var c = a(this),
				d = c.data("bs.dropdown");
			d || c.data("bs.dropdown", d = new g(this)), "string" == typeof b && d[b].call(
				c)
		})
	}

	var e = ".dropdown-backdrop",
		f = '[data-toggle1="dropdown"]',
		g = function(b) {
			a(b).on("click.bs.dropdown", this.toggle)
		};
	g.VERSION = "3.3.6", g.prototype.toggle = function(d) {
		var e = a(this);
		// if (!e.is(".disabled, :disabled")) {
		// 	var f = b(e),
		// 		g = f.hasClass("open");
		// 	if (c(), !g) {
		// 		"ontouchstart" in document.documentElement && !f.closest(".navbar-nav").length &&
		// 			a(document.createElement("div")).addClass("dropdown-backdrop").insertAfter(
		// 				a(this)).on("click", c);
		// 		var h = {
		// 			relatedTarget: this
		// 		};
		// 		if (f.trigger(d = a.Event("show.bs.dropdown", h)), d.isDefaultPrevented())
		// 			return;
		// 		e.trigger("focus").attr("aria-expanded", "true"), f.toggleClass("open").trigger(
		// 			a.Event("shown.bs.dropdown", h))
		// 	}
		// 	return !1
		// }
	}, g.prototype.keydown = function(c) {
		if (/(38|40|27|32)/.test(c.which) && !/input|textarea/i.test(c.target.tagName)) {
			var d = a(this);
			if (c.preventDefault(), c.stopPropagation(), !d.is(".disabled, :disabled")) {
				var e = b(d),
					g = e.hasClass("open");
				if (!g && 27 != c.which || g && 27 == c.which) return 27 == c.which && e.find(
					f).trigger("focus"), d.trigger("click");
				var h = " li:not(.disabled):visible a",
					i = e.find(".dropdown-menu" + h);
				if (i.length) {
					var j = i.index(c.target);
					38 == c.which && j > 0 && j--, 40 == c.which && j < i.length - 1 && j++, ~
						j || (j = 0), i.eq(j).trigger("focus")
				}
			}
		}
	};
	var h = a.fn.dropdown;
	a.fn.dropdown = d, a.fn.dropdown.Constructor = g, a.fn.dropdown.noConflict =
		function() {
			return a.fn.dropdown = h, this
		}, a(document).on("click.bs.dropdown.data-api", c).on(
			"click.bs.dropdown.data-api", ".dropdown form",
			function(a) {
				a.stopPropagation()
			}).on("click.bs.dropdown.data-api", f, g.prototype.toggle).on(
			"keydown.bs.dropdown.data-api", f, g.prototype.keydown).on(
			"keydown.bs.dropdown.data-api", ".dropdown-menu", g.prototype.keydown)
}(jQuery), + function(a) {
	"use strict";

	function b(b, d) {
		return this.each(function() {
			var e = a(this),
				f = e.data("bs.modal"),
				g = a.extend({}, c.DEFAULTS, e.data(), "object" == typeof b && b);
			f || e.data("bs.modal", f = new c(this, g)), "string" == typeof b ? f[b](d) :
				g.show && f.show(d)
		})
	}
	var c = function(b, c) {
		this.options = c, this.$body = a(document.body), this.$element = a(b), this.$dialog =
			this.$element.find(".modal-dialog"), this.$backdrop = null, this.isShown =
			null, this.originalBodyPad = null, this.scrollbarWidth = 0, this.ignoreBackdropClick = !
			1, this.options.remote && this.$element.find(".modal-content").load(this.options
				.remote, a.proxy(function() {
					this.$element.trigger("loaded.bs.modal")
				}, this))
	};
	c.VERSION = "3.3.6", c.TRANSITION_DURATION = 300, c.BACKDROP_TRANSITION_DURATION =
		150, c.DEFAULTS = {
			backdrop: !0,
			keyboard: !0,
			show: !0
		}, c.prototype.toggle = function(a) {
			return this.isShown ? this.hide() : this.show(a)
		}, c.prototype.show = function(b) {
			var d = this,
				e = a.Event("show.bs.modal", {
					relatedTarget: b
				});
			this.$element.trigger(e), this.isShown || e.isDefaultPrevented() || (this.isShown = !
				0, this.checkScrollbar(), this.setScrollbar(), this.$body.addClass(
					"modal-open"), this.escape(), this.resize(), this.$element.on(
					"click.dismiss.bs.modal", '[data-dismiss="modal"]', a.proxy(this.hide,
						this)), this.$dialog.on("mousedown.dismiss.bs.modal", function() {
					d.$element.one("mouseup.dismiss.bs.modal", function(b) {
						a(b.target).is(d.$element) && (d.ignoreBackdropClick = !0)
					})
				}), this.backdrop(function() {
					var e = a.support.transition && d.$element.hasClass("fade");
					d.$element.parent().length || d.$element.appendTo(d.$body), d.$element.show()
						.scrollTop(0), d.adjustDialog(), e && d.$element[0].offsetWidth, d.$element
						.addClass("in"), d.enforceFocus();
					var f = a.Event("shown.bs.modal", {
						relatedTarget: b
					});
					e ? d.$dialog.one("bsTransitionEnd", function() {
						d.$element.trigger("focus").trigger(f)
					}).emulateTransitionEnd(c.TRANSITION_DURATION) : d.$element.trigger(
						"focus").trigger(f)
				}))
		}, c.prototype.hide = function(b) {
			b && b.preventDefault(), b = a.Event("hide.bs.modal"), this.$element.trigger(
				b), this.isShown && !b.isDefaultPrevented() && (this.isShown = !1, this.escape(),
				this.resize(), a(document).off("focusin.bs.modal"), this.$element.removeClass(
					"in").off("click.dismiss.bs.modal").off("mouseup.dismiss.bs.modal"), this
				.$dialog.off("mousedown.dismiss.bs.modal"), a.support.transition && this.$element
				.hasClass("fade") ? this.$element.one("bsTransitionEnd", a.proxy(this.hideModal,
					this)).emulateTransitionEnd(c.TRANSITION_DURATION) : this.hideModal())
		}, c.prototype.enforceFocus = function() {
			a(document).off("focusin.bs.modal").on("focusin.bs.modal", a.proxy(function(
				a) {
				this.$element[0] === a.target || this.$element.has(a.target).length ||
					this.$element.trigger("focus")
			}, this))
		}, c.prototype.escape = function() {
			this.isShown && this.options.keyboard ? this.$element.on(
				"keydown.dismiss.bs.modal", a.proxy(function(a) {
					27 == a.which && this.hide()
				}, this)) : this.isShown || this.$element.off("keydown.dismiss.bs.modal")
		}, c.prototype.resize = function() {
			this.isShown ? a(window).on("resize.bs.modal", a.proxy(this.handleUpdate,
				this)) : a(window).off("resize.bs.modal")
		}, c.prototype.hideModal = function() {
			var a = this;
			this.$element.hide(), this.backdrop(function() {
				a.$body.removeClass("modal-open"), a.resetAdjustments(), a.resetScrollbar(),
					a.$element.trigger("hidden.bs.modal")
			})
		}, c.prototype.removeBackdrop = function() {
			this.$backdrop && this.$backdrop.remove(), this.$backdrop = null
		}, c.prototype.backdrop = function(b) {
			var d = this,
				e = this.$element.hasClass("fade") ? "fade" : "";
			if (this.isShown && this.options.backdrop) {
				var f = a.support.transition && e;
				if (this.$backdrop = a(document.createElement("div")).addClass(
						"modal-backdrop " + e).appendTo(this.$body), this.$element.on(
						"click.dismiss.bs.modal", a.proxy(function(a) {
							return this.ignoreBackdropClick ? void(this.ignoreBackdropClick = !1) :
								void(a.target === a.currentTarget && ("static" == this.options.backdrop ?
									this.$element[0].focus() : this.hide()))
						}, this)), f && this.$backdrop[0].offsetWidth, this.$backdrop.addClass(
						"in"), !b) return;
				f ? this.$backdrop.one("bsTransitionEnd", b).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION) :
					b()
			} else if (!this.isShown && this.$backdrop) {
				this.$backdrop.removeClass("in");
				var g = function() {
					d.removeBackdrop(), b && b()
				};
				a.support.transition && this.$element.hasClass("fade") ? this.$backdrop.one(
						"bsTransitionEnd", g).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION) :
					g()
			} else b && b()
		}, c.prototype.handleUpdate = function() {
			this.adjustDialog()
		}, c.prototype.adjustDialog = function() {
			var a = this.$element[0].scrollHeight > document.documentElement.clientHeight;
			this.$element.css({
				paddingLeft: !this.bodyIsOverflowing && a ? this.scrollbarWidth : "",
				paddingRight: this.bodyIsOverflowing && !a ? this.scrollbarWidth : ""
			})
		}, c.prototype.resetAdjustments = function() {
			this.$element.css({
				paddingLeft: "",
				paddingRight: ""
			})
		}, c.prototype.checkScrollbar = function() {
			var a = window.innerWidth;
			if (!a) {
				var b = document.documentElement.getBoundingClientRect();
				a = b.right - Math.abs(b.left)
			}
			this.bodyIsOverflowing = document.body.clientWidth < a, this.scrollbarWidth =
				this.measureScrollbar()
		}, c.prototype.setScrollbar = function() {
			var a = parseInt(this.$body.css("padding-right") || 0, 10);
			this.originalBodyPad = document.body.style.paddingRight || "", this.bodyIsOverflowing &&
				this.$body.css("padding-right", a + this.scrollbarWidth)
		}, c.prototype.resetScrollbar = function() {
			this.$body.css("padding-right", this.originalBodyPad)
		}, c.prototype.measureScrollbar = function() {
			var a = document.createElement("div");
			a.className = "modal-scrollbar-measure", this.$body.append(a);
			var b = a.offsetWidth - a.clientWidth;
			return this.$body[0].removeChild(a), b
		};
	var d = a.fn.modal;
	a.fn.modal = b, a.fn.modal.Constructor = c, a.fn.modal.noConflict = function() {
		return a.fn.modal = d, this
	}, a(document).on("click.bs.modal.data-api", '[data-toggle1="modal"]',
		function(c) {
			var d = a(this),
				e = d.attr("href"),
				f = a(d.attr("data-target") || e && e.replace(/.*(?=#[^\s]+$)/, "")),
				g = f.data("bs.modal") ? "toggle" : a.extend({
					remote: !/#/.test(e) && e
				}, f.data(), d.data());
			d.is("a") && c.preventDefault(), f.one("show.bs.modal", function(a) {
				a.isDefaultPrevented() || f.one("hidden.bs.modal", function() {
					d.is(":visible") && d.trigger("focus")
				})
			}), b.call(f, g, this)
		})
}(jQuery), + function(a) {
	"use strict";

	function b(b) {
		return this.each(function() {
			var d = a(this),
				e = d.data("bs.tooltip"),
				f = "object" == typeof b && b;
			(e || !/destroy|hide/.test(b)) && (e || d.data("bs.tooltip", e = new c(
				this, f)), "string" == typeof b && e[b]())
		})
	}
	var c = function(a, b) {
		this.type = null, this.options = null, this.enabled = null, this.timeout =
			null, this.hoverState = null, this.$element = null, this.inState = null,
			this.init("tooltip", a, b)
	};
	c.VERSION = "3.3.6", c.TRANSITION_DURATION = 150, c.DEFAULTS = {
		animation: !0,
		placement: "top",
		selector: !1,
		template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
		trigger: "hover focus",
		title: "",
		delay: 0,
		html: !1,
		container: !1,
		viewport: {
			selector: "body",
			padding: 0
		}
	}, c.prototype.init = function(b, c, d) {
		if (this.enabled = !0, this.type = b, this.$element = a(c), this.options =
			this.getOptions(d), this.$viewport = this.options.viewport && a(a.isFunction(
					this.options.viewport) ? this.options.viewport.call(this, this.$element) :
				this.options.viewport.selector || this.options.viewport), this.inState = {
				click: !1,
				hover: !1,
				focus: !1
			}, this.$element[0] instanceof document.constructor && !this.options.selector
		) throw new Error("`selector` option must be specified when initializing " +
			this.type + " on the window.document object!");
		for (var e = this.options.trigger.split(" "), f = e.length; f--;) {
			var g = e[f];
			if ("click" == g) this.$element.on("click." + this.type, this.options.selector,
				a.proxy(this.toggle, this));
			else if ("manual" != g) {
				var h = "hover" == g ? "mouseenter" : "focusin",
					i = "hover" == g ? "mouseleave" : "focusout";
				this.$element.on(h + "." + this.type, this.options.selector, a.proxy(this.enter,
					this)), this.$element.on(i + "." + this.type, this.options.selector, a.proxy(
					this.leave, this))
			}
		}
		this.options.selector ? this._options = a.extend({}, this.options, {
			trigger: "manual",
			selector: ""
		}) : this.fixTitle()
	}, c.prototype.getDefaults = function() {
		return c.DEFAULTS
	}, c.prototype.getOptions = function(b) {
		return b = a.extend({}, this.getDefaults(), this.$element.data(), b), b.delay &&
			"number" == typeof b.delay && (b.delay = {
				show: b.delay,
				hide: b.delay
			}), b
	}, c.prototype.getDelegateOptions = function() {
		var b = {},
			c = this.getDefaults();
		return this._options && a.each(this._options, function(a, d) {
			c[a] != d && (b[a] = d)
		}), b
	}, c.prototype.enter = function(b) {
		var c = b instanceof this.constructor ? b : a(b.currentTarget).data("bs." +
			this.type);
		return c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()),
			a(b.currentTarget).data("bs." + this.type, c)), b instanceof a.Event && (c
			.inState["focusin" == b.type ? "focus" : "hover"] = !0), c.tip().hasClass(
			"in") || "in" == c.hoverState ? void(c.hoverState = "in") : (clearTimeout(
				c.timeout), c.hoverState = "in", c.options.delay && c.options.delay.show ?
			void(c.timeout = setTimeout(function() {
				"in" == c.hoverState && c.show()
			}, c.options.delay.show)) : c.show())
	}, c.prototype.isInStateTrue = function() {
		for (var a in this.inState)
			if (this.inState[a]) return !0;
		return !1
	}, c.prototype.leave = function(b) {
		var c = b instanceof this.constructor ? b : a(b.currentTarget).data("bs." +
			this.type);
		return c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()),
				a(b.currentTarget).data("bs." + this.type, c)), b instanceof a.Event && (c
				.inState["focusout" == b.type ? "focus" : "hover"] = !1), c.isInStateTrue() ?
			void 0 : (clearTimeout(c.timeout), c.hoverState = "out", c.options.delay &&
				c.options.delay.hide ? void(c.timeout = setTimeout(function() {
					"out" == c.hoverState && c.hide()
				}, c.options.delay.hide)) : c.hide())
	}, c.prototype.show = function() {
		var b = a.Event("show.bs." + this.type);
		if (this.hasContent() && this.enabled) {
			this.$element.trigger(b);
			var d = a.contains(this.$element[0].ownerDocument.documentElement, this.$element[
				0]);
			if (b.isDefaultPrevented() || !d) return;
			var e = this,
				f = this.tip(),
				g = this.getUID(this.type);
			this.setContent(), f.attr("id", g), this.$element.attr("aria-describedby",
				g), this.options.animation && f.addClass("fade");
			var h = "function" == typeof this.options.placement ? this.options.placement
				.call(this, f[0], this.$element[0]) : this.options.placement,
				i = /\s?auto?\s?/i,
				j = i.test(h);
			j && (h = h.replace(i, "") || "top"), f.detach().css({
				top: 0,
				left: 0,
				display: "block"
			}).addClass(h).data("bs." + this.type, this), this.options.container ? f.appendTo(
				this.options.container) : f.insertAfter(this.$element), this.$element.trigger(
				"inserted.bs." + this.type);
			var k = this.getPosition(),
				l = f[0].offsetWidth,
				m = f[0].offsetHeight;
			if (j) {
				var n = h,
					o = this.getPosition(this.$viewport);
				h = "bottom" == h && k.bottom + m > o.bottom ? "top" : "top" == h && k.top -
					m < o.top ? "bottom" : "right" == h && k.right + l > o.width ? "left" :
					"left" == h && k.left - l < o.left ? "right" : h, f.removeClass(n).addClass(
						h)
			}
			var p = this.getCalculatedOffset(h, k, l, m);
			this.applyPlacement(p, h);
			var q = function() {
				var a = e.hoverState;
				e.$element.trigger("shown.bs." + e.type), e.hoverState = null, "out" == a &&
					e.leave(e)
			};
			a.support.transition && this.$tip.hasClass("fade") ? f.one(
				"bsTransitionEnd", q).emulateTransitionEnd(c.TRANSITION_DURATION) : q()
		}
	}, c.prototype.applyPlacement = function(b, c) {
		var d = this.tip(),
			e = d[0].offsetWidth,
			f = d[0].offsetHeight,
			g = parseInt(d.css("margin-top"), 10),
			h = parseInt(d.css("margin-left"), 10);
		isNaN(g) && (g = 0), isNaN(h) && (h = 0), b.top += g, b.left += h, a.offset.setOffset(
			d[0], a.extend({
				using: function(a) {
					d.css({
						top: Math.round(a.top),
						left: Math.round(a.left)
					})
				}
			}, b), 0), d.addClass("in");
		var i = d[0].offsetWidth,
			j = d[0].offsetHeight;
		"top" == c && j != f && (b.top = b.top + f - j);
		var k = this.getViewportAdjustedDelta(c, b, i, j);
		k.left ? b.left += k.left : b.top += k.top;
		var l = /top|bottom/.test(c),
			m = l ? 2 * k.left - e + i : 2 * k.top - f + j,
			n = l ? "offsetWidth" : "offsetHeight";
		d.offset(b), this.replaceArrow(m, d[0][n], l)
	}, c.prototype.replaceArrow = function(a, b, c) {
		this.arrow().css(c ? "left" : "top", 50 * (1 - a / b) + "%").css(c ? "top" :
			"left", "")
	}, c.prototype.setContent = function() {
		var a = this.tip(),
			b = this.getTitle();
		a.find(".tooltip-inner")[this.options.html ? "html" : "text"](b), a.removeClass(
			"fade in top bottom left right")
	}, c.prototype.hide = function(b) {
		function d() {
			"in" != e.hoverState && f.detach(), e.$element.removeAttr(
				"aria-describedby").trigger("hidden.bs." + e.type), b && b()
		}
		var e = this,
			f = a(this.$tip),
			g = a.Event("hide.bs." + this.type);
		return this.$element.trigger(g), g.isDefaultPrevented() ? void 0 : (f.removeClass(
				"in"), a.support.transition && f.hasClass("fade") ? f.one(
				"bsTransitionEnd", d).emulateTransitionEnd(c.TRANSITION_DURATION) : d(),
			this.hoverState = null, this)
	}, c.prototype.fixTitle = function() {
		var a = this.$element;
		(a.attr("title") || "string" != typeof a.attr("data-original-title")) && a.attr(
			"data-original-title", a.attr("title") || "").attr("title", "")
	}, c.prototype.hasContent = function() {
		return this.getTitle()
	}, c.prototype.getPosition = function(b) {
		b = b || this.$element;
		var c = b[0],
			d = "BODY" == c.tagName,
			e = c.getBoundingClientRect();
		null == e.width && (e = a.extend({}, e, {
			width: e.right - e.left,
			height: e.bottom - e.top
		}));
		var f = d ? {
				top: 0,
				left: 0
			} : b.offset(),
			g = {
				scroll: d ? document.documentElement.scrollTop || document.body.scrollTop : b
					.scrollTop()
			},
			h = d ? {
				width: a(window).width(),
				height: a(window).height()
			} : null;
		return a.extend({}, e, g, h, f)
	}, c.prototype.getCalculatedOffset = function(a, b, c, d) {
		return "bottom" == a ? {
			top: b.top + b.height,
			left: b.left + b.width / 2 - c / 2
		} : "top" == a ? {
			top: b.top - d,
			left: b.left + b.width / 2 - c / 2
		} : "left" == a ? {
			top: b.top + b.height / 2 - d / 2,
			left: b.left - c
		} : {
			top: b.top + b.height / 2 - d / 2,
			left: b.left + b.width
		}
	}, c.prototype.getViewportAdjustedDelta = function(a, b, c, d) {
		var e = {
			top: 0,
			left: 0
		};
		if (!this.$viewport) return e;
		var f = this.options.viewport && this.options.viewport.padding || 0,
			g = this.getPosition(this.$viewport);
		if (/right|left/.test(a)) {
			var h = b.top - f - g.scroll,
				i = b.top + f - g.scroll + d;
			h < g.top ? e.top = g.top - h : i > g.top + g.height && (e.top = g.top + g.height -
				i)
		} else {
			var j = b.left - f,
				k = b.left + f + c;
			j < g.left ? e.left = g.left - j : k > g.right && (e.left = g.left + g.width -
				k)
		}
		return e
	}, c.prototype.getTitle = function() {
		var a, b = this.$element,
			c = this.options;
		return a = b.attr("data-original-title") || ("function" == typeof c.title ?
			c.title.call(b[0]) : c.title)
	}, c.prototype.getUID = function(a) {
		do a += ~~(1e6 * Math.random()); while (document.getElementById(a));
		return a
	}, c.prototype.tip = function() {
		if (!this.$tip && (this.$tip = a(this.options.template), 1 != this.$tip.length))
			throw new Error(this.type +
				" `template` option must consist of exactly 1 top-level element!");
		return this.$tip
	}, c.prototype.arrow = function() {
		return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow")
	}, c.prototype.enable = function() {
		this.enabled = !0
	}, c.prototype.disable = function() {
		this.enabled = !1
	}, c.prototype.toggleEnabled = function() {
		this.enabled = !this.enabled
	}, c.prototype.toggle = function(b) {
		var c = this;
		b && (c = a(b.currentTarget).data("bs." + this.type), c || (c = new this.constructor(
			b.currentTarget, this.getDelegateOptions()), a(b.currentTarget).data(
			"bs." + this.type, c))), b ? (c.inState.click = !c.inState.click, c.isInStateTrue() ?
			c.enter(c) : c.leave(c)) : c.tip().hasClass("in") ? c.leave(c) : c.enter(c)
	}, c.prototype.destroy = function() {
		var a = this;
		clearTimeout(this.timeout), this.hide(function() {
			a.$element.off("." + a.type).removeData("bs." + a.type), a.$tip && a.$tip
				.detach(), a.$tip = null, a.$arrow = null, a.$viewport = null
		})
	};
	var d = a.fn.tooltip;
	a.fn.tooltip = b, a.fn.tooltip.Constructor = c, a.fn.tooltip.noConflict =
		function() {
			return a.fn.tooltip = d, this
		}
}(jQuery), + function(a) {
	"use strict";

	function b(b) {
		return this.each(function() {
			var d = a(this),
				e = d.data("bs.popover"),
				f = "object" == typeof b && b;
			(e || !/destroy|hide/.test(b)) && (e || d.data("bs.popover", e = new c(
				this, f)), "string" == typeof b && e[b]())
		})
	}
	var c = function(a, b) {
		this.init("popover", a, b)
	};
	if (!a.fn.tooltip) throw new Error("Popover requires tooltip.js");
	c.VERSION = "3.3.6", c.DEFAULTS = a.extend({}, a.fn.tooltip.Constructor.DEFAULTS, {
			placement: "right",
			trigger: "click",
			content: "",
			template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
		}), c.prototype = a.extend({}, a.fn.tooltip.Constructor.prototype), c.prototype
		.constructor = c, c.prototype.getDefaults = function() {
			return c.DEFAULTS
		}, c.prototype.setContent = function() {
			var a = this.tip(),
				b = this.getTitle(),
				c = this.getContent();
			a.find(".popover-title")[this.options.html ? "html" : "text"](b), a.find(
				".popover-content").children().detach().end()[this.options.html ? "string" ==
				typeof c ? "html" : "append" : "text"](c), a.removeClass(
				"fade top bottom left right in"), a.find(".popover-title").html() || a.find(
				".popover-title").hide()
		}, c.prototype.hasContent = function() {
			return this.getTitle() || this.getContent()
		}, c.prototype.getContent = function() {
			var a = this.$element,
				b = this.options;
			return a.attr("data-content") || ("function" == typeof b.content ? b.content
				.call(a[0]) : b.content)
		}, c.prototype.arrow = function() {
			return this.$arrow = this.$arrow || this.tip().find(".arrow")
		};
	var d = a.fn.popover;
	a.fn.popover = b, a.fn.popover.Constructor = c, a.fn.popover.noConflict =
		function() {
			return a.fn.popover = d, this
		}
}(jQuery), + function(a) {
	"use strict";

	function b(c, d) {
		this.$body = a(document.body), this.$scrollElement = a(a(c).is(document.body) ?
				window : c), this.options = a.extend({}, b.DEFAULTS, d), this.selector = (
				this.options.target || "") + " .nav li > a", this.offsets = [], this.targets = [],
			this.activeTarget = null, this.scrollHeight = 0, this.$scrollElement.on(
				"scroll.bs.scrollspy", a.proxy(this.process, this)), this.refresh(), this.process()
	}

	function c(c) {
		return this.each(function() {
			var d = a(this),
				e = d.data("bs.scrollspy"),
				f = "object" == typeof c && c;
			e || d.data("bs.scrollspy", e = new b(this, f)), "string" == typeof c && e[
				c]()
		})
	}
	b.VERSION = "3.3.6", b.DEFAULTS = {
		offset: 10
	}, b.prototype.getScrollHeight = function() {
		return this.$scrollElement[0].scrollHeight || Math.max(this.$body[0].scrollHeight,
			document.documentElement.scrollHeight)
	}, b.prototype.refresh = function() {
		var b = this,
			c = "offset",
			d = 0;
		this.offsets = [], this.targets = [], this.scrollHeight = this.getScrollHeight(),
			a.isWindow(this.$scrollElement[0]) || (c = "position", d = this.$scrollElement
				.scrollTop()), this.$body.find(this.selector).map(function() {
				var b = a(this),
					e = b.data("target") || b.attr("href"),
					f = /^#./.test(e) && a(e);
				return f && f.length && f.is(":visible") && [
					[f[c]().top + d, e]
				] || null
			}).sort(function(a, b) {
				return a[0] - b[0]
			}).each(function() {
				b.offsets.push(this[0]), b.targets.push(this[1])
			})
	}, b.prototype.process = function() {
		var a, b = this.$scrollElement.scrollTop() + this.options.offset,
			c = this.getScrollHeight(),
			d = this.options.offset + c - this.$scrollElement.height(),
			e = this.offsets,
			f = this.targets,
			g = this.activeTarget;
		if (this.scrollHeight != c && this.refresh(), b >= d) return g != (a = f[f.length -
			1]) && this.activate(a);
		if (g && b < e[0]) return this.activeTarget = null, this.clear();
		for (a = e.length; a--;) g != f[a] && b >= e[a] && (void 0 === e[a + 1] || b <
			e[a + 1]) && this.activate(f[a])
	}, b.prototype.activate = function(b) {
		this.activeTarget = b, this.clear();
		var c = this.selector + '[data-target="' + b + '"],' + this.selector +
			'[href="' + b + '"]',
			d = a(c).parents("li").addClass("active");
		d.parent(".dropdown-menu").length && (d = d.closest("li.dropdown").addClass(
			"active")), d.trigger("activate.bs.scrollspy")
	}, b.prototype.clear = function() {
		a(this.selector).parentsUntil(this.options.target, ".active").removeClass(
			"active")
	};
	var d = a.fn.scrollspy;
	a.fn.scrollspy = c, a.fn.scrollspy.Constructor = b, a.fn.scrollspy.noConflict =
		function() {
			return a.fn.scrollspy = d, this
		}, a(window).on("load.bs.scrollspy.data-api", function() {
			a('[data-spy="scroll"]').each(function() {
				var b = a(this);
				c.call(b, b.data())
			})
		})
}(jQuery), + function(a) {
	"use strict";

	function b(b) {
		return this.each(function() {
			var d = a(this),
				e = d.data("bs.tab");
			e || d.data("bs.tab", e = new c(this)), "string" == typeof b && e[b]()
		})
	}
	var c = function(b) {
		this.element = a(b)
	};
	c.VERSION = "3.3.6", c.TRANSITION_DURATION = 150, c.prototype.show = function() {
		var b = this.element,
			c = b.closest("ul:not(.dropdown-menu)"),
			d = b.data("target");
		if (d || (d = b.attr("href"), d = d && d.replace(/.*(?=#[^\s]*$)/, "")), !b.parent(
				"li").hasClass("active")) {
			var e = c.find(".active:last a"),
				f = a.Event("hide.bs.tab", {
					relatedTarget: b[0]
				}),
				g = a.Event("show.bs.tab", {
					relatedTarget: e[0]
				});
			if (e.trigger(f), b.trigger(g), !g.isDefaultPrevented() && !f.isDefaultPrevented()) {
				var h = a(d);
				this.activate(b.closest("li"), c), this.activate(h, h.parent(), function() {
					e.trigger({
						type: "hidden.bs.tab",
						relatedTarget: b[0]
					}), b.trigger({
						type: "shown.bs.tab",
						relatedTarget: e[0]
					})
				})
			}
		}
	}, c.prototype.activate = function(b, d, e) {
		function f() {
			g.removeClass("active").find("> .dropdown-menu > .active").removeClass(
					"active").end().find('[data-toggle1="tab"]').attr("aria-expanded", !1), b
				.addClass(
					"active").find('[data-toggle1="tab"]').attr("aria-expanded", !0), h ? (b[
						0]
					.offsetWidth, b.addClass("in")) : b.removeClass("fade"), b.parent(
					".dropdown-menu").length && b.closest("li.dropdown").addClass("active").end()
				.find('[data-toggle1="tab"]').attr("aria-expanded", !0), e && e()
		}
		var g = d.find("> .active"),
			h = e && a.support.transition && (g.length && g.hasClass("fade") || !!d.find(
				"> .fade").length);
		g.length && h ? g.one("bsTransitionEnd", f).emulateTransitionEnd(c.TRANSITION_DURATION) :
			f(), g.removeClass("in")
	};
	var d = a.fn.tab;
	a.fn.tab = b, a.fn.tab.Constructor = c, a.fn.tab.noConflict = function() {
		return a.fn.tab = d, this
	};
	var e = function(c) {
		c.preventDefault(), b.call(a(this), "show")
	};
	a(document).on("click.bs.tab.data-api", '[data-toggle1="tab"]', e).on(
		"click.bs.tab.data-api", '[data-toggle1="pill"]', e)
}(jQuery), + function(a) {
	"use strict";

	function b(b) {
		return this.each(function() {
			var d = a(this),
				e = d.data("bs.affix"),
				f = "object" == typeof b && b;
			e || d.data("bs.affix", e = new c(this, f)), "string" == typeof b && e[b]()
		})
	}
	var c = function(b, d) {
		this.options = a.extend({}, c.DEFAULTS, d), this.$target = a(this.options.target)
			.on("scroll.bs.affix.data-api", a.proxy(this.checkPosition, this)).on(
				"click.bs.affix.data-api", a.proxy(this.checkPositionWithEventLoop, this)),
			this.$element = a(b), this.affixed = null, this.unpin = null, this.pinnedOffset =
			null, this.checkPosition()
	};
	c.VERSION = "3.3.6", c.RESET = "affix affix-top affix-bottom", c.DEFAULTS = {
		offset: 0,
		target: window
	}, c.prototype.getState = function(a, b, c, d) {
		var e = this.$target.scrollTop(),
			f = this.$element.offset(),
			g = this.$target.height();
		if (null != c && "top" == this.affixed) return c > e ? "top" : !1;
		if ("bottom" == this.affixed) return null != c ? e + this.unpin <= f.top ? !
			1 : "bottom" : a - d >= e + g ? !1 : "bottom";
		var h = null == this.affixed,
			i = h ? e : f.top,
			j = h ? g : b;
		return null != c && c >= e ? "top" : null != d && i + j >= a - d ? "bottom" :
			!1
	}, c.prototype.getPinnedOffset = function() {
		if (this.pinnedOffset) return this.pinnedOffset;
		this.$element.removeClass(c.RESET).addClass("affix");
		var a = this.$target.scrollTop(),
			b = this.$element.offset();
		return this.pinnedOffset = b.top - a
	}, c.prototype.checkPositionWithEventLoop = function() {
		setTimeout(a.proxy(this.checkPosition, this), 1)
	}, c.prototype.checkPosition = function() {
		if (this.$element.is(":visible")) {
			var b = this.$element.height(),
				d = this.options.offset,
				e = d.top,
				f = d.bottom,
				g = Math.max(a(document).height(), a(document.body).height());
			"object" != typeof d && (f = e = d), "function" == typeof e && (e = d.top(
				this.$element)), "function" == typeof f && (f = d.bottom(this.$element));
			var h = this.getState(g, b, e, f);
			if (this.affixed != h) {
				null != this.unpin && this.$element.css("top", "");
				var i = "affix" + (h ? "-" + h : ""),
					j = a.Event(i + ".bs.affix");
				if (this.$element.trigger(j), j.isDefaultPrevented()) return;
				this.affixed = h, this.unpin = "bottom" == h ? this.getPinnedOffset() :
					null, this.$element.removeClass(c.RESET).addClass(i).trigger(i.replace(
						"affix", "affixed") + ".bs.affix")
			}
			"bottom" == h && this.$element.offset({
				top: g - b - f
			})
		}
	};
	var d = a.fn.affix;
	a.fn.affix = b, a.fn.affix.Constructor = c, a.fn.affix.noConflict = function() {
		return a.fn.affix = d, this
	}, a(window).on("load", function() {
		a('[data-spy="affix"]').each(function() {
			var c = a(this),
				d = c.data();
			d.offset = d.offset || {}, null != d.offsetBottom && (d.offset.bottom =
					d.offsetBottom), null != d.offsetTop && (d.offset.top = d.offsetTop),
				b.call(c, d)
		})
	})
}(jQuery);
/* ========================================================================
 * bootstrap-switch - v3.3.2
 * http://www.bootstrap-switch.org
 * ========================================================================
 * Copyright 2012-2013 Mattia Larentis
 *
 * ========================================================================
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================================
 */

(function() {
	var t = [].slice;
	! function(e, i) {
		"use strict";
		var n;
		return n = function() {
			function t(t, i) {
				null == i && (i = {}), this.$element = e(t), this.options = e.extend({},
						e.fn.bootstrapSwitch.defaults, {
							state: this.$element.is(":checked"),
							size: this.$element.data("size"),
							animate: this.$element.data("animate"),
							disabled: this.$element.is(":disabled"),
							readonly: this.$element.is("[readonly]"),
							indeterminate: this.$element.data("indeterminate"),
							inverse: this.$element.data("inverse"),
							radioAllOff: this.$element.data("radio-all-off"),
							onColor: this.$element.data("on-color"),
							offColor: this.$element.data("off-color"),
							onText: this.$element.data("on-text"),
							offText: this.$element.data("off-text"),
							labelText: this.$element.data("label-text"),
							handleWidth: this.$element.data("handle-width"),
							labelWidth: this.$element.data("label-width"),
							baseClass: this.$element.data("base-class"),
							wrapperClass: this.$element.data("wrapper-class")
						}, i), this.$wrapper = e("<div>", {
						"class": function(t) {
							return function() {
								var e;
								return e = ["" + t.options.baseClass].concat(t._getClasses(t.options
										.wrapperClass)), e.push(t.options.state ? "" + t.options.baseClass +
										"-on" : "" + t.options.baseClass + "-off"), null != t.options.size &&
									e.push("" + t.options.baseClass + "-" + t.options.size), t.options
									.disabled && e.push("" + t.options.baseClass + "-disabled"), t.options
									.readonly && e.push("" + t.options.baseClass + "-readonly"), t.options
									.indeterminate && e.push("" + t.options.baseClass +
										"-indeterminate"), t.options.inverse && e.push("" + t.options.baseClass +
										"-inverse"), t.$element.attr("id") && e.push("" + t.options.baseClass +
										"-id-" + t.$element.attr("id")), e.join(" ")
							}
						}(this)()
					}), this.$container = e("<div>", {
						"class": "" + this.options.baseClass + "-container"
					}), this.$on = e("<span>", {
						html: this.options.onText,
						"class": "" + this.options.baseClass + "-handle-on " + this.options.baseClass +
							"-" + this.options.onColor
					}), this.$off = e("<span>", {
						html: this.options.offText,
						"class": "" + this.options.baseClass + "-handle-off " + this.options.baseClass +
							"-" + this.options.offColor
					}), this.$label = e("<span>", {
						html: this.options.labelText,
						"class": "" + this.options.baseClass + "-label"
					}), this.$element.on("init.bootstrapSwitch", function(e) {
						return function() {
							return e.options.onInit.apply(t, arguments)
						}
					}(this)), this.$element.on("switchChange.bootstrapSwitch", function(e) {
						return function() {
							return e.options.onSwitchChange.apply(t, arguments)
						}
					}(this)), this.$container = this.$element.wrap(this.$container).parent(),
					this.$wrapper = this.$container.wrap(this.$wrapper).parent(), this.$element
					.before(this.options.inverse ? this.$off : this.$on).before(this.$label)
					.before(this.options.inverse ? this.$on : this.$off), this.options.indeterminate &&
					this.$element.prop("indeterminate", !0), this._init(), this._elementHandlers(),
					this._handleHandlers(), this._labelHandlers(), this._formHandler(), this
					._externalLabelHandler(), this.$element.trigger("init.bootstrapSwitch")
			}
			return t.prototype._constructor = t, t.prototype.state = function(t, e) {
				return "undefined" == typeof t ? this.options.state : this.options.disabled ||
					this.options.readonly ? this.$element : this.options.state && !this.options
					.radioAllOff && this.$element.is(":radio") ? this.$element : (this.options
						.indeterminate && this.indeterminate(!1), t = !!t, this.$element.prop(
							"checked", t).trigger("change.bootstrapSwitch", e), this.$element)
			}, t.prototype.toggleState = function(t) {
				return this.options.disabled || this.options.readonly ? this.$element :
					this.options.indeterminate ? (this.indeterminate(!1), this.state(!0)) :
					this.$element.prop("checked", !this.options.state).trigger(
						"change.bootstrapSwitch", t)
			}, t.prototype.size = function(t) {
				return "undefined" == typeof t ? this.options.size : (null != this.options
					.size && this.$wrapper.removeClass("" + this.options.baseClass + "-" +
						this.options.size), t && this.$wrapper.addClass("" + this.options.baseClass +
						"-" + t), this._width(), this._containerPosition(), this.options.size =
					t, this.$element)
			}, t.prototype.animate = function(t) {
				return "undefined" == typeof t ? this.options.animate : (t = !!t, t ===
					this.options.animate ? this.$element : this.toggleAnimate())
			}, t.prototype.toggleAnimate = function() {
				return this.options.animate = !this.options.animate, this.$wrapper.toggleClass(
					"" + this.options.baseClass + "-animate"), this.$element
			}, t.prototype.disabled = function(t) {
				return "undefined" == typeof t ? this.options.disabled : (t = !!t, t ===
					this.options.disabled ? this.$element : this.toggleDisabled())
			}, t.prototype.toggleDisabled = function() {
				return this.options.disabled = !this.options.disabled, this.$element.prop(
					"disabled", this.options.disabled), this.$wrapper.toggleClass("" +
					this.options.baseClass + "-disabled"), this.$element
			}, t.prototype.readonly = function(t) {
				return "undefined" == typeof t ? this.options.readonly : (t = !!t, t ===
					this.options.readonly ? this.$element : this.toggleReadonly())
			}, t.prototype.toggleReadonly = function() {
				return this.options.readonly = !this.options.readonly, this.$element.prop(
					"readonly", this.options.readonly), this.$wrapper.toggleClass("" +
					this.options.baseClass + "-readonly"), this.$element
			}, t.prototype.indeterminate = function(t) {
				return "undefined" == typeof t ? this.options.indeterminate : (t = !!t,
					t === this.options.indeterminate ? this.$element : this.toggleIndeterminate()
				)
			}, t.prototype.toggleIndeterminate = function() {
				return this.options.indeterminate = !this.options.indeterminate, this.$element
					.prop("indeterminate", this.options.indeterminate), this.$wrapper.toggleClass(
						"" + this.options.baseClass + "-indeterminate"), this._containerPosition(),
					this.$element
			}, t.prototype.inverse = function(t) {
				return "undefined" == typeof t ? this.options.inverse : (t = !!t, t ===
					this.options.inverse ? this.$element : this.toggleInverse())
			}, t.prototype.toggleInverse = function() {
				var t, e;
				return this.$wrapper.toggleClass("" + this.options.baseClass +
						"-inverse"), e = this.$on.clone(!0), t = this.$off.clone(!0), this.$on
					.replaceWith(t), this.$off.replaceWith(e), this.$on = t, this.$off = e,
					this.options.inverse = !this.options.inverse, this.$element
			}, t.prototype.onColor = function(t) {
				var e;
				return e = this.options.onColor, "undefined" == typeof t ? e : (null !=
					e && this.$on.removeClass("" + this.options.baseClass + "-" + e), this
					.$on.addClass("" + this.options.baseClass + "-" + t), this.options.onColor =
					t, this.$element)
			}, t.prototype.offColor = function(t) {
				var e;
				return e = this.options.offColor, "undefined" == typeof t ? e : (null !=
					e && this.$off.removeClass("" + this.options.baseClass + "-" + e),
					this.$off.addClass("" + this.options.baseClass + "-" + t), this.options
					.offColor = t, this.$element)
			}, t.prototype.onText = function(t) {
				return "undefined" == typeof t ? this.options.onText : (this.$on.html(t),
					this._width(), this._containerPosition(), this.options.onText = t,
					this.$element)
			}, t.prototype.offText = function(t) {
				return "undefined" == typeof t ? this.options.offText : (this.$off.html(
						t), this._width(), this._containerPosition(), this.options.offText =
					t, this.$element)
			}, t.prototype.labelText = function(t) {
				return "undefined" == typeof t ? this.options.labelText : (this.$label.html(
					t), this._width(), this.options.labelText = t, this.$element)
			}, t.prototype.handleWidth = function(t) {
				return "undefined" == typeof t ? this.options.handleWidth : (this.options
					.handleWidth = t, this._width(), this._containerPosition(), this.$element
				)
			}, t.prototype.labelWidth = function(t) {
				return "undefined" == typeof t ? this.options.labelWidth : (this.options
					.labelWidth = t, this._width(), this._containerPosition(), this.$element
				)
			}, t.prototype.baseClass = function() {
				return this.options.baseClass
			}, t.prototype.wrapperClass = function(t) {
				return "undefined" == typeof t ? this.options.wrapperClass : (t || (t =
						e.fn.bootstrapSwitch.defaults.wrapperClass), this.$wrapper.removeClass(
						this._getClasses(this.options.wrapperClass).join(" ")), this.$wrapper
					.addClass(this._getClasses(t).join(" ")), this.options.wrapperClass =
					t, this.$element)
			}, t.prototype.radioAllOff = function(t) {
				return "undefined" == typeof t ? this.options.radioAllOff : (t = !!t, t ===
					this.options.radioAllOff ? this.$element : (this.options.radioAllOff =
						t, this.$element))
			}, t.prototype.onInit = function(t) {
				return "undefined" == typeof t ? this.options.onInit : (t || (t = e.fn.bootstrapSwitch
					.defaults.onInit), this.options.onInit = t, this.$element)
			}, t.prototype.onSwitchChange = function(t) {
				return "undefined" == typeof t ? this.options.onSwitchChange : (t || (t =
						e.fn.bootstrapSwitch.defaults.onSwitchChange), this.options.onSwitchChange =
					t, this.$element)
			}, t.prototype.destroy = function() {
				var t;
				return t = this.$element.closest("form"), t.length && t.off(
						"reset.bootstrapSwitch").removeData("bootstrap-switch"), this.$container
					.children().not(this.$element).remove(), this.$element.unwrap().unwrap()
					.off(".bootstrapSwitch").removeData("bootstrap-switch"), this.$element
			}, t.prototype._width = function() {
				var t, e;
				return t = this.$on.add(this.$off), t.add(this.$label).css("width", ""),
					e = "auto" === this.options.handleWidth ? Math.max(this.$on.width(),
						this.$off.width()) : this.options.handleWidth, t.width(e), this.$label
					.width(function(t) {
						return function(i, n) {
							return "auto" !== t.options.labelWidth ? t.options.labelWidth : e >
								n ? e : n
						}
					}(this)), this._handleWidth = this.$on.outerWidth(), this._labelWidth =
					this.$label.outerWidth(), this.$container.width(2 * this._handleWidth +
						this._labelWidth), this.$wrapper.width(this._handleWidth + this._labelWidth)
			}, t.prototype._containerPosition = function(t, e) {
				return null == t && (t = this.options.state), this.$container.css(
					"margin-left",
					function(e) {
						return function() {
							var i;
							return i = [0, "-" + e._handleWidth + "px"], e.options.indeterminate ?
								"-" + e._handleWidth / 2 + "px" : t ? e.options.inverse ? i[1] : i[
									0] : e.options.inverse ? i[0] : i[1]
						}
					}(this)), e ? setTimeout(function() {
					return e()
				}, 50) : void 0
			}, t.prototype._init = function() {
				var t, e;
				return t = function(t) {
					return function() {
						return t._width(), t._containerPosition(null, function() {
							return t.options.animate ? t.$wrapper.addClass("" + t.options.baseClass +
								"-animate") : void 0
						})
					}
				}(this), this.$wrapper.is(":visible") ? t() : e = i.setInterval(
					function(n) {
						return function() {
							return n.$wrapper.is(":visible") ? (t(), i.clearInterval(e)) : void 0
						}
					}(this), 50)
			}, t.prototype._elementHandlers = function() {
				return this.$element.on({
					"change.bootstrapSwitch": function(t) {
						return function(i, n) {
							var o;
							return i.preventDefault(), i.stopImmediatePropagation(), o = t.$element
								.is(":checked"), t._containerPosition(o), o !== t.options.state ?
								(t.options.state = o, t.$wrapper.toggleClass("" + t.options.baseClass +
										"-off").toggleClass("" + t.options.baseClass + "-on"), n ?
									void 0 : (t.$element.is(":radio") && e("[name='" + t.$element.attr(
										"name") + "']").not(t.$element).prop("checked", !1).trigger(
										"change.bootstrapSwitch", !0), t.$element.trigger(
										"switchChange.bootstrapSwitch", [o]))) : void 0
						}
					}(this),
					"focus.bootstrapSwitch": function(t) {
						return function(e) {
							return e.preventDefault(), t.$wrapper.addClass("" + t.options.baseClass +
								"-focused")
						}
					}(this),
					"blur.bootstrapSwitch": function(t) {
						return function(e) {
							return e.preventDefault(), t.$wrapper.removeClass("" + t.options.baseClass +
								"-focused")
						}
					}(this),
					"keydown.bootstrapSwitch": function(t) {
						return function(e) {
							if (e.which && !t.options.disabled && !t.options.readonly) switch (
								e.which) {
								case 37:
									return e.preventDefault(), e.stopImmediatePropagation(), t.state(!
										1);
								case 39:
									return e.preventDefault(), e.stopImmediatePropagation(), t.state(!
										0)
							}
						}
					}(this)
				})
			}, t.prototype._handleHandlers = function() {
				return this.$on.on("click.bootstrapSwitch", function(t) {
					return function(e) {
						return e.preventDefault(), e.stopPropagation(), t.state(!1), t.$element
							.trigger("focus.bootstrapSwitch")
					}
				}(this)), this.$off.on("click.bootstrapSwitch", function(t) {
					return function(e) {
						return e.preventDefault(), e.stopPropagation(), t.state(!0), t.$element
							.trigger("focus.bootstrapSwitch")
					}
				}(this))
			}, t.prototype._labelHandlers = function() {
				return this.$label.on({
					"mousedown.bootstrapSwitch touchstart.bootstrapSwitch": function(t) {
						return function(e) {
							return t._dragStart || t.options.disabled || t.options.readonly ?
								void 0 : (e.preventDefault(), e.stopPropagation(), t._dragStart =
									(e.pageX || e.originalEvent.touches[0].pageX) - parseInt(t.$container
										.css("margin-left"), 10), t.options.animate && t.$wrapper.removeClass(
										"" + t.options.baseClass + "-animate"), t.$element.trigger(
										"focus.bootstrapSwitch"))
						}
					}(this),
					"mousemove.bootstrapSwitch touchmove.bootstrapSwitch": function(t) {
						return function(e) {
							var i;
							if (null != t._dragStart && (e.preventDefault(), i = (e.pageX ||
									e.originalEvent.touches[0].pageX) - t._dragStart, !(i < -t._handleWidth ||
									i > 0))) return t._dragEnd = i, t.$container.css("margin-left",
								"" + t._dragEnd + "px")
						}
					}(this),
					"mouseup.bootstrapSwitch touchend.bootstrapSwitch": function(t) {
						return function(e) {
							var i;
							if (t._dragStart) return e.preventDefault(), t.options.animate &&
								t.$wrapper.addClass("" + t.options.baseClass + "-animate"), t._dragEnd ?
								(i = t._dragEnd > -(t._handleWidth / 2), t._dragEnd = !1, t.state(
									t.options.inverse ? !i : i)) : t.state(!t.options.state), t._dragStart = !
								1
						}
					}(this),
					"mouseleave.bootstrapSwitch": function(t) {
						return function() {
							return t.$label.trigger("mouseup.bootstrapSwitch")
						}
					}(this)
				})
			}, t.prototype._externalLabelHandler = function() {
				var t;
				return t = this.$element.closest("label"), t.on("click", function(e) {
					return function(i) {
						return i.preventDefault(), i.stopImmediatePropagation(), i.target ===
							t[0] ? e.toggleState() : void 0
					}
				}(this))
			}, t.prototype._formHandler = function() {
				var t;
				return t = this.$element.closest("form"), t.data("bootstrap-switch") ?
					void 0 : t.on("reset.bootstrapSwitch", function() {
						return i.setTimeout(function() {
							return t.find("input").filter(function() {
								return e(this).data("bootstrap-switch")
							}).each(function() {
								return e(this).bootstrapSwitch("state", this.checked)
							})
						}, 1)
					}).data("bootstrap-switch", !0)
			}, t.prototype._getClasses = function(t) {
				var i, n, o, s;
				if (!e.isArray(t)) return ["" + this.options.baseClass + "-" + t];
				for (n = [], o = 0, s = t.length; s > o; o++) i = t[o], n.push("" + this
					.options.baseClass + "-" + i);
				return n
			}, t
		}(), e.fn.bootstrapSwitch = function() {
			var i, o, s;
			return o = arguments[0], i = 2 <= arguments.length ? t.call(arguments, 1) : [],
				s = this, this.each(function() {
					var t, a;
					return t = e(this), a = t.data("bootstrap-switch"), a || t.data(
						"bootstrap-switch", a = new n(this, o)), "string" == typeof o ? s = a[
						o].apply(a, i) : void 0
				}), s
		}, e.fn.bootstrapSwitch.Constructor = n, e.fn.bootstrapSwitch.defaults = {
			state: !0,
			size: null,
			animate: !0,
			disabled: !1,
			readonly: !1,
			indeterminate: !1,
			inverse: !1,
			radioAllOff: !1,
			onColor: "primary",
			offColor: "default",
			onText: "ON",
			offText: "OFF",
			labelText: "&nbsp;",
			handleWidth: "auto",
			labelWidth: "auto",
			baseClass: "bootstrap-switch",
			wrapperClass: "wrapper",
			onInit: function() {},
			onSwitchChange: function() {}
		}
	}(window.jQuery, window)
}).call(this);
/**
 * circles - v0.0.6 - 2015-11-27
 *
 * Copyright (c) 2015 lugolabs
 * Licensed
 */
! function(a, b) {
	"object" == typeof exports ? module.exports = b() : "function" == typeof define &&
		define.amd ? define([], b) : a.Circles = b()
}(this, function() {
	"use strict";
	var a = window.requestAnimationFrame || window.webkitRequestAnimationFrame ||
		window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame ||
		function(a) {
			setTimeout(a, 1e3 / 60)
		},
		b = function(a) {
			var b = a.id;
			if (this._el = document.getElementById(b), null !== this._el) {
				this._radius = a.radius || 10, this._duration = void 0 === a.duration ?
					500 : a.duration, this._value = 0, this._maxValue = a.maxValue || 100,
					this._text = void 0 === a.text ? function(a) {
						return this.htmlifyNumber(a)
					} : a.text, this._strokeWidth = a.width || 10, this._colors = a.colors || [
						"#EEE", "#F00"
					], this._svg = null, this._movingPath = null, this._wrapContainer = null,
					this._textContainer = null, this._wrpClass = a.wrpClass || "circles-wrp",
					this._textClass = a.textClass || "circles-text", this._valClass = a.valueStrokeClass ||
					"circles-valueStroke", this._maxValClass = a.maxValueStrokeClass ||
					"circles-maxValueStroke", this._styleWrapper = a.styleWrapper === !1 ? !1 :
					!0, this._styleText = a.styleText === !1 ? !1 : !0;
				var c = Math.PI / 180 * 270;
				this._start = -Math.PI / 180 * 90, this._startPrecise = this._precise(this
					._start), this._circ = c - this._start, this._generate().update(a.value ||
					0)
			}
		};
	return b.prototype = {
		VERSION: "0.0.6",
		_generate: function() {
			return this._svgSize = 2 * this._radius, this._radiusAdjusted = this._radius -
				this._strokeWidth / 2, this._generateSvg()._generateText()._generateWrapper(),
				this._el.innerHTML = "", this._el.appendChild(this._wrapContainer), this
		},
		_setPercentage: function(a) {
			this._movingPath.setAttribute("d", this._calculatePath(a, !0)), this._textContainer
				.innerHTML = this._getText(this.getValueFromPercent(a))
		},
		_generateWrapper: function() {
			return this._wrapContainer = document.createElement("div"), this._wrapContainer
				.className = this._wrpClass, this._styleWrapper && (this._wrapContainer.style
					.position = "relative", this._wrapContainer.style.display =
					"inline-block"), this._wrapContainer.appendChild(this._svg), this._wrapContainer
				.appendChild(this._textContainer), this
		},
		_generateText: function() {
			if (this._textContainer = document.createElement("div"), this._textContainer
				.className = this._textClass, this._styleText) {
				var a = {
					position: "absolute",
					top: 0,
					left: 0,
					textAlign: "center",
					width: "100%",
					fontSize: .7 * this._radius + "px",
					height: this._svgSize + "px",
					lineHeight: this._svgSize + "px"
				};
				for (var b in a) this._textContainer.style[b] = a[b]
			}
			return this._textContainer.innerHTML = this._getText(0), this
		},
		_getText: function(a) {
			return this._text ? (void 0 === a && (a = this._value), a = parseFloat(a.toFixed(
					2)), "function" == typeof this._text ? this._text.call(this, a) : this
				._text) : ""
		},
		_generateSvg: function() {
			return this._svg = document.createElementNS("http://www.w3.org/2000/svg",
					"svg"), this._svg.setAttribute("xmlns", "http://www.w3.org/2000/svg"),
				this._svg.setAttribute("width", this._svgSize), this._svg.setAttribute(
					"height", this._svgSize), this._generatePath(100, !1, this._colors[0],
					this._maxValClass)._generatePath(1, !0, this._colors[1], this._valClass),
				this._movingPath = this._svg.getElementsByTagName("path")[1], this
		},
		_generatePath: function(a, b, c, d) {
			var e = document.createElementNS("http://www.w3.org/2000/svg", "path");
			return e.setAttribute("fill", "transparent"), e.setAttribute("stroke", c),
				e.setAttribute("stroke-width", this._strokeWidth), e.setAttribute("d",
					this._calculatePath(a, b)), e.setAttribute("class", d), this._svg.appendChild(
					e), this
		},
		_calculatePath: function(a, b) {
			var c = this._start + a / 100 * this._circ,
				d = this._precise(c);
			return this._arc(d, b)
		},
		_arc: function(a, b) {
			var c = a - .001,
				d = a - this._startPrecise < Math.PI ? 0 : 1;
			return ["M", this._radius + this._radiusAdjusted * Math.cos(this._startPrecise),
				this._radius + this._radiusAdjusted * Math.sin(this._startPrecise), "A",
				this._radiusAdjusted, this._radiusAdjusted, 0, d, 1, this._radius +
				this._radiusAdjusted * Math.cos(c), this._radius + this._radiusAdjusted *
				Math.sin(c), b ? "" : "Z"
			].join(" ")
		},
		_precise: function(a) {
			return Math.round(1e3 * a) / 1e3
		},
		htmlifyNumber: function(a, b, c) {
			b = b || "circles-integer", c = c || "circles-decimals";
			var d = (a + "").split("."),
				e = '<span class="' + b + '">' + d[0] + "</span>";
			return d.length > 1 && (e += '.<span class="' + c + '">' + d[1].substring(
				0, 2) + "</span>"), e
		},
		updateRadius: function(a) {
			return this._radius = a, this._generate().update(!0)
		},
		updateWidth: function(a) {
			return this._strokeWidth = a, this._generate().update(!0)
		},
		updateColors: function(a) {
			this._colors = a;
			var b = this._svg.getElementsByTagName("path");
			return b[0].setAttribute("stroke", a[0]), b[1].setAttribute("stroke", a[1]),
				this
		},
		getPercent: function() {
			return 100 * this._value / this._maxValue
		},
		getValueFromPercent: function(a) {
			return this._maxValue * a / 100
		},
		getValue: function() {
			return this._value
		},
		getMaxValue: function() {
			return this._maxValue
		},
		update: function(b, c) {
			if (b === !0) return this._setPercentage(this.getPercent()), this;
			if (this._value == b || isNaN(b)) return this;
			void 0 === c && (c = this._duration);
			var d, e, f, g, h = this,
				i = h.getPercent(),
				j = 1;
			return this._value = Math.min(this._maxValue, Math.max(0, b)), c ? (d = h
				.getPercent(), e = d > i, j += d % 1, f = Math.floor(Math.abs(d - i) /
					j), g = c / f,
				function k(b) {
					if (e ? i += j : i -= j, e && i >= d || !e && d >= i) return void a(
						function() {
							h._setPercentage(d)
						});
					a(function() {
						h._setPercentage(i)
					});
					var c = Date.now(),
						f = c - b;
					f >= g ? k(c) : setTimeout(function() {
						k(Date.now())
					}, g - f)
				}(Date.now()), this) : (this._setPercentage(this.getPercent()), this)
		}
	}, b.create = function(a) {
		return new b(a)
	}, b
});
/**!
 * MixItUp v2.1.11
 *
 * @copyright Copyright 2015 KunkaLabs Limited.
 * @author    KunkaLabs Limited.
 * @link      https://mixitup.kunkalabs.com
 *
 * @license   Commercial use requires a commercial license.
 *            https://mixitup.kunkalabs.com/licenses/
 *
 *            Non-commercial use permitted under terms of CC-BY-NC license.
 *            http://creativecommons.org/licenses/by-nc/3.0/
 */
! function(a, b) {
	"use strict";
	a.MixItUp = function() {
		var b = this;
		b._execAction("_constructor", 0), a.extend(b, {
			selectors: {
				target: ".mix",
				filter: ".filter",
				sort: ".sort"
			},
			animation: {
				enable: !0,
				effects: "fade scale",
				duration: 600,
				easing: "ease",
				perspectiveDistance: "3000",
				perspectiveOrigin: "50% 50%",
				queue: !0,
				queueLimit: 1,
				animateChangeLayout: !1,
				animateResizeContainer: !0,
				animateResizeTargets: !1,
				staggerSequence: !1,
				reverseOut: !1
			},
			callbacks: {
				onMixLoad: !1,
				onMixStart: !1,
				onMixBusy: !1,
				onMixEnd: !1,
				onMixFail: !1,
				_user: !1
			},
			controls: {
				enable: !0,
				live: !1,
				toggleFilterButtons: !1,
				toggleLogic: "or",
				activeClass: "active"
			},
			layout: {
				display: "inline-block",
				containerClass: "",
				containerClassFail: "fail"
			},
			load: {
				filter: "all",
				sort: !1
			},
			_$body: null,
			_$container: null,
			_$targets: null,
			_$parent: null,
			_$sortButtons: null,
			_$filterButtons: null,
			_suckMode: !1,
			_mixing: !1,
			_sorting: !1,
			_clicking: !1,
			_loading: !0,
			_changingLayout: !1,
			_changingClass: !1,
			_changingDisplay: !1,
			_origOrder: [],
			_startOrder: [],
			_newOrder: [],
			_activeFilter: null,
			_toggleArray: [],
			_toggleString: "",
			_activeSort: "default:asc",
			_newSort: null,
			_startHeight: null,
			_newHeight: null,
			_incPadding: !0,
			_newDisplay: null,
			_newClass: null,
			_targetsBound: 0,
			_targetsDone: 0,
			_queue: [],
			_$show: a(),
			_$hide: a()
		}), b._execAction("_constructor", 1)
	}, a.MixItUp.prototype = {
		constructor: a.MixItUp,
		_instances: {},
		_handled: {
			_filter: {},
			_sort: {}
		},
		_bound: {
			_filter: {},
			_sort: {}
		},
		_actions: {},
		_filters: {},
		extend: function(b) {
			for (var c in b) a.MixItUp.prototype[c] = b[c]
		},
		addAction: function(b, c, d, e) {
			a.MixItUp.prototype._addHook("_actions", b, c, d, e)
		},
		addFilter: function(b, c, d, e) {
			a.MixItUp.prototype._addHook("_filters", b, c, d, e)
		},
		_addHook: function(b, c, d, e, f) {
			var g = a.MixItUp.prototype[b],
				h = {};
			f = 1 === f || "post" === f ? "post" : "pre", h[c] = {}, h[c][f] = {}, h[c]
				[f][d] = e, a.extend(!0, g, h)
		},
		_init: function(b, c) {
			var d = this;
			if (d._execAction("_init", 0, arguments), c && a.extend(!0, d, c), d._$body =
				a("body"), d._domNode = b, d._$container = a(b), d._$container.addClass(d
					.layout.containerClass), d._id = b.id, d._platformDetect(), d._brake = d
				._getPrefixedCSS("transition", "none"), d._refresh(!0), d._$parent = d._$targets
				.parent().length ? d._$targets.parent() : d._$container, d.load.sort && (
					d._newSort = d._parseSort(d.load.sort), d._newSortString = d.load.sort,
					d._activeSort = d.load.sort, d._sort(), d._printSort()), d._activeFilter =
				"all" === d.load.filter ? d.selectors.target : "none" === d.load.filter ?
				"" : d.load.filter, d.controls.enable && d._bindHandlers(), d.controls.toggleFilterButtons
			) {
				d._buildToggleArray();
				for (var e = 0; e < d._toggleArray.length; e++) d._updateControls({
					filter: d._toggleArray[e],
					sort: d._activeSort
				}, !0)
			} else d.controls.enable && d._updateControls({
				filter: d._activeFilter,
				sort: d._activeSort
			});
			d._filter(), d._init = !0, d._$container.data("mixItUp", d), d._execAction(
				"_init", 1, arguments), d._buildState(), d._$targets.css(d._brake), d._goMix(
				d.animation.enable)
		},
		_platformDetect: function() {
			var a = this,
				c = ["Webkit", "Moz", "O", "ms"],
				d = ["webkit", "moz"],
				e = window.navigator.appVersion.match(/Chrome\/(\d+)\./) || !1,
				f = "undefined" != typeof InstallTrigger,
				g = function(a) {
					for (var b = 0; b < c.length; b++)
						if (c[b] + "Transition" in a.style) return {
							prefix: "-" + c[b].toLowerCase() + "-",
							vendor: c[b]
						};
					return "transition" in a.style ? "" : !1
				},
				h = g(a._domNode);
			a._execAction("_platformDetect", 0), a._chrome = e ? parseInt(e[1], 10) :
				!1, a._ff = f ? parseInt(window.navigator.userAgent.match(/rv:([^)]+)\)/)[
					1]) : !1, a._prefix = h.prefix, a._vendor = h.vendor, a._suckMode =
				window.atob && a._prefix ? !1 : !0, a._suckMode && (a.animation.enable = !
					1), a._ff && a._ff <= 4 && (a.animation.enable = !1);
			for (var i = 0; i < d.length && !window.requestAnimationFrame; i++) window
				.requestAnimationFrame = window[d[i] + "RequestAnimationFrame"];
			"function" != typeof Object.getPrototypeOf && ("object" == typeof "test".__proto__ ?
				Object.getPrototypeOf = function(a) {
					return a.__proto__
				} : Object.getPrototypeOf = function(a) {
					return a.constructor.prototype
				}), a._domNode.nextElementSibling === b && Object.defineProperty(Element
				.prototype, "nextElementSibling", {
					get: function() {
						for (var a = this.nextSibling; a;) {
							if (1 === a.nodeType) return a;
							a = a.nextSibling
						}
						return null
					}
				}), a._execAction("_platformDetect", 1)
		},
		_refresh: function(a, c) {
			var d = this;
			d._execAction("_refresh", 0, arguments), d._$targets = d._$container.find(
				d.selectors.target);
			for (var e = 0; e < d._$targets.length; e++) {
				var f = d._$targets[e];
				if (f.dataset === b || c) {
					f.dataset = {};
					for (var g = 0; g < f.attributes.length; g++) {
						var h = f.attributes[g],
							i = h.name,
							j = h.value;
						if (i.indexOf("data-") > -1) {
							var k = d._helpers._camelCase(i.substring(5, i.length));
							f.dataset[k] = j
						}
					}
				}
				f.mixParent === b && (f.mixParent = d._id)
			}
			if (d._$targets.length && a || !d._origOrder.length && d._$targets.length) {
				d._origOrder = [];
				for (var e = 0; e < d._$targets.length; e++) {
					var f = d._$targets[e];
					d._origOrder.push(f)
				}
			}
			d._execAction("_refresh", 1, arguments)
		},
		_bindHandlers: function() {
			var c = this,
				d = a.MixItUp.prototype._bound._filter,
				e = a.MixItUp.prototype._bound._sort;
			c._execAction("_bindHandlers", 0), c.controls.live ? c._$body.on(
				"click.mixItUp." + c._id, c.selectors.sort,
				function() {
					c._processClick(a(this), "sort")
				}).on("click.mixItUp." + c._id, c.selectors.filter, function() {
				c._processClick(a(this), "filter")
			}) : (c._$sortButtons = a(c.selectors.sort), c._$filterButtons = a(c.selectors
				.filter), c._$sortButtons.on("click.mixItUp." + c._id, function() {
				c._processClick(a(this), "sort")
			}), c._$filterButtons.on("click.mixItUp." + c._id, function() {
				c._processClick(a(this), "filter")
			})), d[c.selectors.filter] = d[c.selectors.filter] === b ? 1 : d[c.selectors
				.filter] + 1, e[c.selectors.sort] = e[c.selectors.sort] === b ? 1 : e[c.selectors
				.sort] + 1, c._execAction("_bindHandlers", 1)
		},
		_processClick: function(c, d) {
			var e = this,
				f = function(c, d, f) {
					var g = a.MixItUp.prototype;
					g._handled["_" + d][e.selectors[d]] = g._handled["_" + d][e.selectors[d]] ===
						b ? 1 : g._handled["_" + d][e.selectors[d]] + 1, g._handled["_" + d][e.selectors[
							d]] === g._bound["_" + d][e.selectors[d]] && (c[(f ? "remove" : "add") +
							"Class"](e.controls.activeClass), delete g._handled["_" + d][e.selectors[
							d]])
				};
			if (e._execAction("_processClick", 0, arguments), !e._mixing || e.animation
				.queue && e._queue.length < e.animation.queueLimit) {
				if (e._clicking = !0, "sort" === d) {
					var g = c.attr("data-sort");
					(!c.hasClass(e.controls.activeClass) || g.indexOf("random") > -1) && (a(
						e.selectors.sort).removeClass(e.controls.activeClass), f(c, d), e.sort(
						g))
				}
				if ("filter" === d) {
					var h, i = c.attr("data-filter"),
						j = "or" === e.controls.toggleLogic ? "," : "";
					e.controls.toggleFilterButtons ? (e._buildToggleArray(), c.hasClass(e.controls
							.activeClass) ? (f(c, d, !0), h = e._toggleArray.indexOf(i), e._toggleArray
							.splice(h, 1)) : (f(c, d), e._toggleArray.push(i)), e._toggleArray =
						a.grep(e._toggleArray, function(a) {
							return a
						}), e._toggleString = e._toggleArray.join(j), e.filter(e._toggleString)
					) : c.hasClass(e.controls.activeClass) || (a(e.selectors.filter).removeClass(
						e.controls.activeClass), f(c, d), e.filter(i))
				}
				e._execAction("_processClick", 1, arguments)
			} else "function" == typeof e.callbacks.onMixBusy && e.callbacks.onMixBusy
				.call(e._domNode, e._state, e), e._execAction("_processClickBusy", 1,
					arguments)
		},
		_buildToggleArray: function() {
			var a = this,
				b = a._activeFilter.replace(/\s/g, "");
			if (a._execAction("_buildToggleArray", 0, arguments), "or" === a.controls.toggleLogic)
				a._toggleArray = b.split(",");
			else {
				a._toggleArray = b.split("."), !a._toggleArray[0] && a._toggleArray.shift();
				for (var c, d = 0; c = a._toggleArray[d]; d++) a._toggleArray[d] = "." +
					c
			}
			a._execAction("_buildToggleArray", 1, arguments)
		},
		_updateControls: function(c, d) {
			var e = this,
				f = {
					filter: c.filter,
					sort: c.sort
				},
				g = function(a, b) {
					try {
						d && "filter" === h && "none" !== f.filter && "" !== f.filter ? a.filter(
								b).addClass(e.controls.activeClass) : a.removeClass(e.controls.activeClass)
							.filter(b).addClass(e.controls.activeClass)
					} catch (c) {}
				},
				h = "filter",
				i = null;
			e._execAction("_updateControls", 0, arguments), c.filter === b && (f.filter =
					e._activeFilter), c.sort === b && (f.sort = e._activeSort), f.filter ===
				e.selectors.target && (f.filter = "all");
			for (var j = 0; 2 > j; j++) i = e.controls.live ? a(e.selectors[h]) : e[
					"_$" + h + "Buttons"], i && g(i, "[data-" + h + '="' + f[h] + '"]'), h =
				"sort";
			e._execAction("_updateControls", 1, arguments)
		},
		_filter: function() {
			var b = this;
			b._execAction("_filter", 0);
			for (var c = 0; c < b._$targets.length; c++) {
				var d = a(b._$targets[c]);
				d.is(b._activeFilter) ? b._$show = b._$show.add(d) : b._$hide = b._$hide.add(
					d)
			}
			b._execAction("_filter", 1)
		},
		_sort: function() {
			var a = this,
				b = function(a) {
					for (var b = a.slice(), c = b.length, d = c; d--;) {
						var e = parseInt(Math.random() * c),
							f = b[d];
						b[d] = b[e], b[e] = f
					}
					return b
				};
			a._execAction("_sort", 0), a._startOrder = [];
			for (var c = 0; c < a._$targets.length; c++) {
				var d = a._$targets[c];
				a._startOrder.push(d)
			}
			switch (a._newSort[0].sortBy) {
				case "default":
					a._newOrder = a._origOrder;
					break;
				case "random":
					a._newOrder = b(a._startOrder);
					break;
				case "custom":
					a._newOrder = a._newSort[0].order;
					break;
				default:
					a._newOrder = a._startOrder.concat().sort(function(b, c) {
						return a._compare(b, c)
					})
			}
			a._execAction("_sort", 1)
		},
		_compare: function(a, b, c) {
			c = c ? c : 0;
			var d = this,
				e = d._newSort[c].order,
				f = function(a) {
					return a.dataset[d._newSort[c].sortBy] || 0
				},
				g = isNaN(1 * f(a)) ? f(a).toLowerCase() : 1 * f(a),
				h = isNaN(1 * f(b)) ? f(b).toLowerCase() : 1 * f(b);
			return h > g ? "asc" === e ? -1 : 1 : g > h ? "asc" === e ? 1 : -1 : g ===
				h && d._newSort.length > c + 1 ? d._compare(a, b, c + 1) : 0
		},
		_printSort: function(a) {
			var b = this,
				c = a ? b._startOrder : b._newOrder,
				d = b._$parent[0].querySelectorAll(b.selectors.target),
				e = d.length ? d[d.length - 1].nextElementSibling : null,
				f = document.createDocumentFragment();
			b._execAction("_printSort", 0, arguments);
			for (var g = 0; g < d.length; g++) {
				var h = d[g],
					i = h.nextSibling;
				"absolute" !== h.style.position && (i && "#text" === i.nodeName && b._$parent[
					0].removeChild(i), b._$parent[0].removeChild(h))
			}
			for (var g = 0; g < c.length; g++) {
				var j = c[g];
				if ("default" !== b._newSort[0].sortBy || "desc" !== b._newSort[0].order ||
					a) f.appendChild(j), f.appendChild(document.createTextNode(" "));
				else {
					var k = f.firstChild;
					f.insertBefore(j, k), f.insertBefore(document.createTextNode(" "), j)
				}
			}
			e ? b._$parent[0].insertBefore(f, e) : b._$parent[0].appendChild(f), b._execAction(
				"_printSort", 1, arguments)
		},
		_parseSort: function(a) {
			for (var b = this, c = "string" == typeof a ? a.split(" ") : [a], d = [],
					e = 0; e < c.length; e++) {
				var f = "string" == typeof a ? c[e].split(":") : ["custom", c[e]],
					g = {
						sortBy: b._helpers._camelCase(f[0]),
						order: f[1] || "asc"
					};
				if (d.push(g), "default" === g.sortBy || "random" === g.sortBy) break
			}
			return b._execFilter("_parseSort", d, arguments)
		},
		_parseEffects: function() {
			var a = this,
				b = {
					opacity: "",
					transformIn: "",
					transformOut: "",
					filter: ""
				},
				c = function(b, c, d) {
					if (a.animation.effects.indexOf(b) > -1) {
						if (c) {
							var e = a.animation.effects.indexOf(b + "(");
							if (e > -1) {
								var f = a.animation.effects.substring(e),
									g = /\(([^)]+)\)/.exec(f),
									h = g[1];
								return {
									val: h
								}
							}
						}
						return !0
					}
					return !1
				},
				d = function(a, b) {
					return b ? "-" === a.charAt(0) ? a.substr(1, a.length) : "-" + a : a
				},
				e = function(a, e) {
					for (var f = [
							["scale", ".01"],
							["translateX", "20px"],
							["translateY", "20px"],
							["translateZ", "20px"],
							["rotateX", "90deg"],
							["rotateY", "90deg"],
							["rotateZ", "180deg"]
						], g = 0; g < f.length; g++) {
						var h = f[g][0],
							i = f[g][1],
							j = e && "scale" !== h;
						b[a] += c(h) ? h + "(" + d(c(h, !0).val || i, j) + ") " : ""
					}
				};
			return b.opacity = c("fade") ? c("fade", !0).val || "0" : "1", e(
					"transformIn"), a.animation.reverseOut ? e("transformOut", !0) : b.transformOut =
				b.transformIn, b.transition = {}, b.transition = a._getPrefixedCSS(
					"transition", "all " + a.animation.duration + "ms " + a.animation.easing +
					", opacity " + a.animation.duration + "ms linear"), a.animation.stagger =
				c("stagger") ? !0 : !1, a.animation.staggerDuration = parseInt(c(
					"stagger") && c("stagger", !0).val ? c("stagger", !0).val : 100), a._execFilter(
					"_parseEffects", b)
		},
		_buildState: function(a) {
			var b = this,
				c = {};
			return b._execAction("_buildState", 0), c = {
				activeFilter: "" === b._activeFilter ? "none" : b._activeFilter,
				activeSort: a && b._newSortString ? b._newSortString : b._activeSort,
				fail: !b._$show.length && "" !== b._activeFilter,
				$targets: b._$targets,
				$show: b._$show,
				$hide: b._$hide,
				totalTargets: b._$targets.length,
				totalShow: b._$show.length,
				totalHide: b._$hide.length,
				display: a && b._newDisplay ? b._newDisplay : b.layout.display
			}, a ? b._execFilter("_buildState", c) : (b._state = c, void b._execAction(
				"_buildState", 1))
		},
		_goMix: function(a) {
			var b = this,
				c = function() {
					b._chrome && 31 === b._chrome && f(b._$parent[0]), b._setInter(), d()
				},
				d = function() {
					var a = window.pageYOffset,
						c = window.pageXOffset;
					document.documentElement.scrollHeight;
					b._getInterMixData(), b._setFinal(), b._getFinalMixData(), window.pageYOffset !==
						a && window.scrollTo(c, a), b._prepTargets(), window.requestAnimationFrame ?
						requestAnimationFrame(e) : setTimeout(function() {
							e()
						}, 20)
				},
				e = function() {
					b._animateTargets(), 0 === b._targetsBound && b._cleanUp()
				},
				f = function(a) {
					var b = a.parentElement,
						c = document.createElement("div"),
						d = document.createDocumentFragment();
					b.insertBefore(c, a), d.appendChild(a), b.replaceChild(a, c)
				},
				g = b._buildState(!0);
			b._execAction("_goMix", 0, arguments), !b.animation.duration && (a = !1),
				b._mixing = !0, b._$container.removeClass(b.layout.containerClassFail),
				"function" == typeof b.callbacks.onMixStart && b.callbacks.onMixStart.call(
					b._domNode, b._state, g, b), b._$container.trigger("mixStart", [b._state,
					g, b
				]), b._getOrigMixData(), a && !b._suckMode ? window.requestAnimationFrame ?
				requestAnimationFrame(c) : c() : b._cleanUp(), b._execAction("_goMix", 1,
					arguments)
		},
		_getTargetData: function(a, b) {
			var c, d = this;
			a.dataset[b + "PosX"] = a.offsetLeft, a.dataset[b + "PosY"] = a.offsetTop,
				d.animation.animateResizeTargets && (c = d._suckMode ? {
						marginBottom: "",
						marginRight: ""
					} : window.getComputedStyle(a), a.dataset[b + "MarginBottom"] = parseInt(
						c.marginBottom), a.dataset[b + "MarginRight"] = parseInt(c.marginRight),
					a.dataset[b + "Width"] = a.offsetWidth, a.dataset[b + "Height"] = a.offsetHeight
				)
		},
		_getOrigMixData: function() {
			var a = this,
				b = a._suckMode ? {
					boxSizing: ""
				} : window.getComputedStyle(a._$parent[0]),
				c = b.boxSizing || b[a._vendor + "BoxSizing"];
			a._incPadding = "border-box" === c, a._execAction("_getOrigMixData", 0), !
				a._suckMode && (a.effects = a._parseEffects()), a._$toHide = a._$hide.filter(
					":visible"), a._$toShow = a._$show.filter(":hidden"), a._$pre = a._$targets
				.filter(":visible"), a._startHeight = a._incPadding ? a._$parent.outerHeight() :
				a._$parent.height();
			for (var d = 0; d < a._$pre.length; d++) {
				var e = a._$pre[d];
				a._getTargetData(e, "orig")
			}
			a._execAction("_getOrigMixData", 1)
		},
		_setInter: function() {
			var a = this;
			a._execAction("_setInter", 0), a._changingLayout && a.animation.animateChangeLayout ?
				(a._$toShow.css("display", a._newDisplay), a._changingClass && a._$container
					.removeClass(a.layout.containerClass).addClass(a._newClass)) : a._$toShow
				.css("display", a.layout.display), a._execAction("_setInter", 1)
		},
		_getInterMixData: function() {
			var a = this;
			a._execAction("_getInterMixData", 0);
			for (var b = 0; b < a._$toShow.length; b++) {
				var c = a._$toShow[b];
				a._getTargetData(c, "inter")
			}
			for (var b = 0; b < a._$pre.length; b++) {
				var c = a._$pre[b];
				a._getTargetData(c, "inter")
			}
			a._execAction("_getInterMixData", 1)
		},
		_setFinal: function() {
			var a = this;
			a._execAction("_setFinal", 0), a._sorting && a._printSort(), a._$toHide.removeStyle(
					"display"), a._changingLayout && a.animation.animateChangeLayout && a._$pre
				.css("display", a._newDisplay), a._execAction("_setFinal", 1)
		},
		_getFinalMixData: function() {
			var a = this;
			a._execAction("_getFinalMixData", 0);
			for (var b = 0; b < a._$toShow.length; b++) {
				var c = a._$toShow[b];
				a._getTargetData(c, "final")
			}
			for (var b = 0; b < a._$pre.length; b++) {
				var c = a._$pre[b];
				a._getTargetData(c, "final")
			}
			a._newHeight = a._incPadding ? a._$parent.outerHeight() : a._$parent.height(),
				a._sorting && a._printSort(!0), a._$toShow.removeStyle("display"), a._$pre
				.css("display", a.layout.display), a._changingClass && a.animation.animateChangeLayout &&
				a._$container.removeClass(a._newClass).addClass(a.layout.containerClass),
				a._execAction("_getFinalMixData", 1)
		},
		_prepTargets: function() {
			var b = this,
				c = {
					_in: b._getPrefixedCSS("transform", b.effects.transformIn),
					_out: b._getPrefixedCSS("transform", b.effects.transformOut)
				};
			b._execAction("_prepTargets", 0), b.animation.animateResizeContainer && b._$parent
				.css("height", b._startHeight + "px");
			for (var d = 0; d < b._$toShow.length; d++) {
				var e = b._$toShow[d],
					f = a(e);
				e.style.opacity = b.effects.opacity, e.style.display = b._changingLayout &&
					b.animation.animateChangeLayout ? b._newDisplay : b.layout.display, f.css(
						c._in), b.animation.animateResizeTargets && (e.style.width = e.dataset.finalWidth +
						"px", e.style.height = e.dataset.finalHeight + "px", e.style.marginRight = -
						(e.dataset.finalWidth - e.dataset.interWidth) + 1 * e.dataset.finalMarginRight +
						"px", e.style.marginBottom = -(e.dataset.finalHeight - e.dataset.interHeight) +
						1 * e.dataset.finalMarginBottom + "px")
			}
			for (var d = 0; d < b._$pre.length; d++) {
				var e = b._$pre[d],
					f = a(e),
					g = {
						x: e.dataset.origPosX - e.dataset.interPosX,
						y: e.dataset.origPosY - e.dataset.interPosY
					},
					c = b._getPrefixedCSS("transform", "translate(" + g.x + "px," + g.y +
						"px)");
				f.css(c), b.animation.animateResizeTargets && (e.style.width = e.dataset.origWidth +
					"px", e.style.height = e.dataset.origHeight + "px", e.dataset.origWidth -
					e.dataset.finalWidth && (e.style.marginRight = -(e.dataset.origWidth -
						e.dataset.interWidth) + 1 * e.dataset.origMarginRight + "px"), e.dataset
					.origHeight - e.dataset.finalHeight && (e.style.marginBottom = -(e.dataset
							.origHeight - e.dataset.interHeight) + 1 * e.dataset.origMarginBottom +
						"px"))
			}
			b._execAction("_prepTargets", 1)
		},
		_animateTargets: function() {
			var b = this;
			b._execAction("_animateTargets", 0), b._targetsDone = 0, b._targetsBound =
				0, b._$parent.css(b._getPrefixedCSS("perspective", b.animation.perspectiveDistance +
					"px")).css(b._getPrefixedCSS("perspective-origin", b.animation.perspectiveOrigin)),
				b.animation.animateResizeContainer && b._$parent.css(b._getPrefixedCSS(
					"transition", "height " + b.animation.duration + "ms ease")).css(
					"height", b._newHeight + "px");
			for (var c = 0; c < b._$toShow.length; c++) {
				var d = b._$toShow[c],
					e = a(d),
					f = {
						x: d.dataset.finalPosX - d.dataset.interPosX,
						y: d.dataset.finalPosY - d.dataset.interPosY
					},
					g = b._getDelay(c),
					h = {};
				d.style.opacity = "";
				for (var i = 0; 2 > i; i++) {
					var j = 0 === i ? j = b._prefix : "";
					b._ff && b._ff <= 20 && (h[j + "transition-property"] = "all", h[j +
							"transition-timing-function"] = b.animation.easing + "ms", h[j +
							"transition-duration"] = b.animation.duration + "ms"), h[j +
							"transition-delay"] = g + "ms", h[j + "transform"] = "translate(" + f.x +
						"px," + f.y + "px)"
				}(b.effects.transform || b.effects.opacity) && b._bindTargetDone(e), b._ff &&
					b._ff <= 20 ? e.css(h) : e.css(b.effects.transition).css(h)
			}
			for (var c = 0; c < b._$pre.length; c++) {
				var d = b._$pre[c],
					e = a(d),
					f = {
						x: d.dataset.finalPosX - d.dataset.interPosX,
						y: d.dataset.finalPosY - d.dataset.interPosY
					},
					g = b._getDelay(c);
				(d.dataset.finalPosX !== d.dataset.origPosX || d.dataset.finalPosY !== d.dataset
					.origPosY) && b._bindTargetDone(e), e.css(b._getPrefixedCSS("transition",
					"all " + b.animation.duration + "ms " + b.animation.easing + " " + g +
					"ms")), e.css(b._getPrefixedCSS("transform", "translate(" + f.x + "px," +
					f.y + "px)")), b.animation.animateResizeTargets && (d.dataset.origWidth -
					d.dataset.finalWidth && 1 * d.dataset.finalWidth && (d.style.width = d.dataset
						.finalWidth + "px", d.style.marginRight = -(d.dataset.finalWidth - d.dataset
							.interWidth) + 1 * d.dataset.finalMarginRight + "px"), d.dataset.origHeight -
					d.dataset.finalHeight && 1 * d.dataset.finalHeight && (d.style.height =
						d.dataset.finalHeight + "px", d.style.marginBottom = -(d.dataset.finalHeight -
							d.dataset.interHeight) + 1 * d.dataset.finalMarginBottom + "px"))
			}
			b._changingClass && b._$container.removeClass(b.layout.containerClass).addClass(
				b._newClass);
			for (var c = 0; c < b._$toHide.length; c++) {
				for (var d = b._$toHide[c], e = a(d), g = b._getDelay(c), k = {}, i = 0; 2 >
					i; i++) {
					var j = 0 === i ? j = b._prefix : "";
					k[j + "transition-delay"] = g + "ms", k[j + "transform"] = b.effects.transformOut,
						k.opacity = b.effects.opacity
				}
				e.css(b.effects.transition).css(k), (b.effects.transform || b.effects.opacity) &&
					b._bindTargetDone(e)
			}
			b._execAction("_animateTargets", 1)
		},
		_bindTargetDone: function(b) {
			var c = this,
				d = b[0];
			c._execAction("_bindTargetDone", 0, arguments), d.dataset.bound || (d.dataset
				.bound = !0, c._targetsBound++, b.on(
					"webkitTransitionEnd.mixItUp transitionend.mixItUp",
					function(e) {
						(e.originalEvent.propertyName.indexOf("transform") > -1 || e.originalEvent
							.propertyName.indexOf("opacity") > -1) && a(e.originalEvent.target).is(
							c.selectors.target) && (b.off(".mixItUp"), d.dataset.bound = "", c._targetDone())
					})), c._execAction("_bindTargetDone", 1, arguments)
		},
		_targetDone: function() {
			var a = this;
			a._execAction("_targetDone", 0), a._targetsDone++, a._targetsDone === a._targetsBound &&
				a._cleanUp(), a._execAction("_targetDone", 1)
		},
		_cleanUp: function() {
			var b = this,
				c = b.animation.animateResizeTargets ?
				"transform opacity width height margin-bottom margin-right" :
				"transform opacity",
				d = function() {
					b._$targets.removeStyle("transition", b._prefix)
				};
			b._execAction("_cleanUp", 0), b._changingLayout ? b._$show.css("display",
					b._newDisplay) : b._$show.css("display", b.layout.display), b._$targets.css(
					b._brake), b._$targets.removeStyle(c, b._prefix).removeAttr(
					"data-inter-pos-x data-inter-pos-y data-final-pos-x data-final-pos-y data-orig-pos-x data-orig-pos-y data-orig-height data-orig-width data-final-height data-final-width data-inter-width data-inter-height data-orig-margin-right data-orig-margin-bottom data-inter-margin-right data-inter-margin-bottom data-final-margin-right data-final-margin-bottom"
				), b._$hide.removeStyle("display"), b._$parent.removeStyle(
					"height transition perspective-distance perspective perspective-origin-x perspective-origin-y perspective-origin perspectiveOrigin",
					b._prefix), b._sorting && (b._printSort(), b._activeSort = b._newSortString,
					b._sorting = !1), b._changingLayout && (b._changingDisplay && (b.layout.display =
					b._newDisplay, b._changingDisplay = !1), b._changingClass && (b._$parent
					.removeClass(b.layout.containerClass).addClass(b._newClass), b.layout.containerClass =
					b._newClass, b._changingClass = !1), b._changingLayout = !1), b._refresh(),
				b._buildState(), b._state.fail && b._$container.addClass(b.layout.containerClassFail),
				b._$show = a(), b._$hide = a(), window.requestAnimationFrame &&
				requestAnimationFrame(d), b._mixing = !1, "function" == typeof b.callbacks
				._user && b.callbacks._user.call(b._domNode, b._state, b), "function" ==
				typeof b.callbacks.onMixEnd && b.callbacks.onMixEnd.call(b._domNode, b._state,
					b), b._$container.trigger("mixEnd", [b._state, b]), b._state.fail && (
					"function" == typeof b.callbacks.onMixFail && b.callbacks.onMixFail.call(
						b._domNode, b._state, b), b._$container.trigger("mixFail", [b._state, b])
				), b._loading && ("function" == typeof b.callbacks.onMixLoad && b.callbacks
					.onMixLoad.call(b._domNode, b._state, b), b._$container.trigger(
						"mixLoad", [b._state, b])), b._queue.length && (b._execAction("_queue",
						0), b.multiMix(b._queue[0][0], b._queue[0][1], b._queue[0][2]), b._queue
					.splice(0, 1)), b._execAction("_cleanUp", 1), b._loading = !1
		},
		_getPrefixedCSS: function(a, b, c) {
			var d = this,
				e = {},
				f = "",
				g = -1;
			for (g = 0; 2 > g; g++) f = 0 === g ? d._prefix : "", c ? e[f + a] = f + b :
				e[f + a] = b;
			return d._execFilter("_getPrefixedCSS", e, arguments)
		},
		_getDelay: function(a) {
			var b = this,
				c = "function" == typeof b.animation.staggerSequence ? b.animation.staggerSequence
				.call(b._domNode, a, b._state) : a,
				d = b.animation.stagger ? c * b.animation.staggerDuration : 0;
			return b._execFilter("_getDelay", d, arguments)
		},
		_parseMultiMixArgs: function(a) {
			for (var b = this, c = {
					command: null,
					animate: b.animation.enable,
					callback: null
				}, d = 0; d < a.length; d++) {
				var e = a[d];
				null !== e && ("object" == typeof e || "string" == typeof e ? c.command =
					e : "boolean" == typeof e ? c.animate = e : "function" == typeof e && (
						c.callback = e))
			}
			return b._execFilter("_parseMultiMixArgs", c, arguments)
		},
		_parseInsertArgs: function(b) {
			for (var c = this, d = {
					index: 0,
					$object: a(),
					multiMix: {
						filter: c._state.activeFilter
					},
					callback: null
				}, e = 0; e < b.length; e++) {
				var f = b[e];
				"number" == typeof f ? d.index = f : "object" == typeof f && f instanceof a ?
					d.$object = f : "object" == typeof f && c._helpers._isElement(f) ? d.$object =
					a(f) : "object" == typeof f && null !== f ? d.multiMix = f : "boolean" !=
					typeof f || f ? "function" == typeof f && (d.callback = f) : d.multiMix = !
					1
			}
			return c._execFilter("_parseInsertArgs", d, arguments)
		},
		_execAction: function(a, b, c) {
			var d = this,
				e = b ? "post" : "pre";
			if (!d._actions.isEmptyObject && d._actions.hasOwnProperty(a))
				for (var f in d._actions[a][e]) d._actions[a][e][f].call(d, c)
		},
		_execFilter: function(a, b, c) {
			var d = this;
			if (d._filters.isEmptyObject || !d._filters.hasOwnProperty(a)) return b;
			for (var e in d._filters[a]) return d._filters[a][e].call(d, c)
		},
		_helpers: {
			_camelCase: function(a) {
				return a.replace(/-([a-z])/g, function(a) {
					return a[1].toUpperCase()
				})
			},
			_isElement: function(a) {
				return window.HTMLElement ? a instanceof HTMLElement : null !== a && 1 ===
					a.nodeType && "string" === a.nodeName
			}
		},
		isMixing: function() {
			var a = this;
			return a._execFilter("isMixing", a._mixing)
		},
		filter: function() {
			var a = this,
				b = a._parseMultiMixArgs(arguments);
			a._clicking && (a._toggleString = ""), a.multiMix({
				filter: b.command
			}, b.animate, b.callback)
		},
		sort: function() {
			var a = this,
				b = a._parseMultiMixArgs(arguments);
			a.multiMix({
				sort: b.command
			}, b.animate, b.callback)
		},
		changeLayout: function() {
			var a = this,
				b = a._parseMultiMixArgs(arguments);
			a.multiMix({
				changeLayout: b.command
			}, b.animate, b.callback)
		},
		multiMix: function() {
			var a = this,
				c = a._parseMultiMixArgs(arguments);
			if (a._execAction("multiMix", 0, arguments), a._mixing) a.animation.queue &&
				a._queue.length < a.animation.queueLimit ? (a._queue.push(arguments), a.controls
					.enable && !a._clicking && a._updateControls(c.command), a._execAction(
						"multiMixQueue", 1, arguments)) : ("function" == typeof a.callbacks.onMixBusy &&
					a.callbacks.onMixBusy.call(a._domNode, a._state, a), a._$container.trigger(
						"mixBusy", [a._state, a]), a._execAction("multiMixBusy", 1, arguments));
			else {
				a.controls.enable && !a._clicking && (a.controls.toggleFilterButtons && a
						._buildToggleArray(), a._updateControls(c.command, a.controls.toggleFilterButtons)
					), a._queue.length < 2 && (a._clicking = !1), delete a.callbacks._user,
					c.callback && (a.callbacks._user = c.callback);
				var d = c.command.sort,
					e = c.command.filter,
					f = c.command.changeLayout;
				a._refresh(), d && (a._newSort = a._parseSort(d), a._newSortString = d, a
						._sorting = !0, a._sort()), e !== b && (e = "all" === e ? a.selectors.target :
						e, a._activeFilter = e), a._filter(), f && (a._newDisplay = "string" ==
						typeof f ? f : f.display || a.layout.display, a._newClass = f.containerClass ||
						"", (a._newDisplay !== a.layout.display || a._newClass !== a.layout.containerClass) &&
						(a._changingLayout = !0, a._changingClass = a._newClass !== a.layout.containerClass,
							a._changingDisplay = a._newDisplay !== a.layout.display)), a._$targets
					.css(a._brake), a._goMix(c.animate ^ a.animation.enable ? c.animate : a.animation
						.enable), a._execAction("multiMix", 1, arguments)
			}
		},
		insert: function() {
			var a = this,
				b = a._parseInsertArgs(arguments),
				c = "function" == typeof b.callback ? b.callback : null,
				d = document.createDocumentFragment(),
				e = function() {
					return a._refresh(), a._$targets.length ? b.index < a._$targets.length ||
						!a._$targets.length ? a._$targets[b.index] : a._$targets[a._$targets.length -
							1].nextElementSibling : a._$parent[0].children[0]
				}();
			if (a._execAction("insert", 0, arguments), b.$object) {
				for (var f = 0; f < b.$object.length; f++) {
					var g = b.$object[f];
					d.appendChild(g), d.appendChild(document.createTextNode(" "))
				}
				a._$parent[0].insertBefore(d, e)
			}
			a._execAction("insert", 1, arguments), "object" == typeof b.multiMix && a.multiMix(
				b.multiMix, c)
		},
		prepend: function() {
			var a = this,
				b = a._parseInsertArgs(arguments);
			a.insert(0, b.$object, b.multiMix, b.callback)
		},
		append: function() {
			var a = this,
				b = a._parseInsertArgs(arguments);
			a.insert(a._state.totalTargets, b.$object, b.multiMix, b.callback)
		},
		getOption: function(a) {
			var c = this,
				d = function(a, c) {
					for (var d = c.split("."), e = d.pop(), f = d.length, g = 1, h = d[0] ||
							c;
						(a = a[h]) && f > g;) h = d[g], g++;
					return a !== b ? a[e] !== b ? a[e] : a : void 0
				};
			return a ? c._execFilter("getOption", d(c, a), arguments) : c
		},
		setOptions: function(b) {
			var c = this;
			c._execAction("setOptions", 0, arguments), "object" == typeof b && a.extend(!
				0, c, b), c._execAction("setOptions", 1, arguments)
		},
		getState: function() {
			var a = this;
			return a._execFilter("getState", a._state, a)
		},
		forceRefresh: function() {
			var a = this;
			a._refresh(!1, !0)
		},
		destroy: function(b) {
			var c = this,
				d = a.MixItUp.prototype._bound._filter,
				e = a.MixItUp.prototype._bound._sort;
			c._execAction("destroy", 0, arguments), c._$body.add(a(c.selectors.sort)).add(
				a(c.selectors.filter)).off(".mixItUp");
			for (var f = 0; f < c._$targets.length; f++) {
				var g = c._$targets[f];
				b && (g.style.display = ""), delete g.mixParent
			}
			c._execAction("destroy", 1, arguments), d[c.selectors.filter] && d[c.selectors
					.filter] > 1 ? d[c.selectors.filter]-- : 1 === d[c.selectors.filter] &&
				delete d[c.selectors.filter], e[c.selectors.sort] && e[c.selectors.sort] >
				1 ? e[c.selectors.sort]-- : 1 === e[c.selectors.sort] && delete e[c.selectors
					.sort], delete a.MixItUp.prototype._instances[c._id]
		}
	}, a.fn.mixItUp = function() {
		var c, d = arguments,
			e = [],
			f = function(b, c) {
				var d = new a.MixItUp,
					e = function() {
						return ("00000" + (16777216 * Math.random() << 0).toString(16)).substr(-
							6).toUpperCase()
					};
				d._execAction("_instantiate", 0, arguments), b.id = b.id ? b.id :
					"MixItUp" + e(), d._instances[b.id] || (d._instances[b.id] = d, d._init(b,
						c)), d._execAction("_instantiate", 1, arguments)
			};
		return c = this.each(function() {
			if (d && "string" == typeof d[0]) {
				var c = a.MixItUp.prototype._instances[this.id];
				if ("isLoaded" === d[0]) e.push(c ? !0 : !1);
				else {
					var g = c[d[0]](d[1], d[2], d[3]);
					g !== b && e.push(g)
				}
			} else f(this, d[0])
		}), e.length ? e.length > 1 ? e : e[0] : c
	}, a.fn.removeStyle = function(c, d) {
		return d = d ? d : "", this.each(function() {
			for (var e = this, f = c.split(" "), g = 0; g < f.length; g++)
				for (var h = 0; 4 > h; h++) {
					switch (h) {
						case 0:
							var i = f[g];
							break;
						case 1:
							var i = a.MixItUp.prototype._helpers._camelCase(i);
							break;
						case 2:
							var i = d + f[g];
							break;
						case 3:
							var i = a.MixItUp.prototype._helpers._camelCase(d + f[g])
					}
					if (e.style[i] !== b && "unknown" != typeof e.style[i] && e.style[i].length >
						0 && (e.style[i] = ""), !d && 1 === h) break
				}
			e.attributes && e.attributes.style && e.attributes.style !== b && "" ===
				e.attributes.style.value && e.attributes.removeNamedItem("style")
		})
	}
}(jQuery);
// Slidebars 0.10.3 (http://plugins.adchsm.me/slidebars/) written by Adam Smith (http://www.adchsm.me/) released under MIT License (http://plugins.adchsm.me/slidebars/license.txt)
! function(t) {
	t.slidebars = function(s) {
		function e() {
			!c.disableOver || "number" == typeof c.disableOver && c.disableOver >= k ?
				(w = !0, t("html").addClass("sb-init"), c.hideControlClasses && T.removeClass(
					"sb-hide"), i()) : "number" == typeof c.disableOver && c.disableOver < k &&
				(w = !1, t("html").removeClass("sb-init"), c.hideControlClasses && T.addClass(
					"sb-hide"), g.css("minHeight", ""), (p || y) && o())
		}

		function i() {
			g.css("minHeight", "");
			var s = parseInt(g.css("height"), 10),
				e = parseInt(t("html").css("height"), 10);
			e > s && g.css("minHeight", t("html").css("height")), m && m.hasClass(
					"sb-width-custom") && m.css("width", m.attr("data-sb-width")), C && C.hasClass(
					"sb-width-custom") && C.css("width", C.attr("data-sb-width")), m && (m.hasClass(
					"sb-style-push") || m.hasClass("sb-style-overlay")) && m.css("marginLeft",
					"-" + m.css("width")), C && (C.hasClass("sb-style-push") || C.hasClass(
					"sb-style-overlay")) && C.css("marginRight", "-" + C.css("width")), c.scrollLock &&
				t("html").addClass("sb-scroll-lock")
		}

		function n(t, s, e) {
			function n() {
				a.removeAttr("style"), i()
			}
			var a;
			if (a = t.hasClass("sb-style-push") ? g.add(t).add(O) : t.hasClass(
					"sb-style-overlay") ? t : g.add(O), "translate" === x) "0px" === s ? n() :
				a.css("transform", "translate( " + s + " )");
			else if ("side" === x) "0px" === s ? n() : ("-" === s[0] && (s = s.substr(1)),
				a.css(e, "0px"), setTimeout(function() {
					a.css(e, s)
				}, 1));
			else if ("jQuery" === x) {
				"-" === s[0] && (s = s.substr(1));
				var o = {};
				o[e] = s, a.stop().animate(o, 400)
			}
		}

		function a(s) {
			function e() {
				w && "left" === s && m ? (t("html").addClass("sb-active sb-active-left"),
					m.addClass("sb-active"), n(m, m.css("width"), "left"), setTimeout(
						function() {
							p = !0
						}, 400)) : w && "right" === s && C && (t("html").addClass(
					"sb-active sb-active-right"), C.addClass("sb-active"), n(C, "-" + C.css(
					"width"), "right"), setTimeout(function() {
					y = !0
				}, 400))
			}
			"left" === s && m && y || "right" === s && C && p ? (o(), setTimeout(e, 400)) :
				e()
		}

		function o(s, e) {
			(p || y) && (p && (n(m, "0px", "left"), p = !1), y && (n(C, "0px", "right"),
				y = !1), setTimeout(function() {
				t("html").removeClass("sb-active sb-active-left sb-active-right"), m &&
					m.removeClass("sb-active"), C && C.removeClass("sb-active"),
					"undefined" != typeof s && (void 0 === typeof e && (e = "_self"),
						window.open(s, e))
			}, 400))
		}

		function l(t) {
			"left" === t && m && (p ? o() : a("left")), "right" === t && C && (y ? o() :
				a("right"))
		}

		function r(t, s) {
			t.stopPropagation(), t.preventDefault(), "touchend" === t.type && s.off(
				"click")
		}
		var c = t.extend({
				siteClose: !0,
				scrollLock: !1,
				disableOver: !1,
				hideControlClasses: !1
			}, s),
			h = document.createElement("div").style,
			d = !1,
			f = !1;
		("" === h.MozTransition || "" === h.WebkitTransition || "" === h.OTransition ||
			"" === h.transition) && (d = !0), ("" === h.MozTransform || "" === h.WebkitTransform ||
			"" === h.OTransform || "" === h.transform) && (f = !0);
		var u = navigator.userAgent,
			b = !1,
			v = !1;
		/Android/.test(u) ? b = u.substr(u.indexOf("Android") + 8, 3) :
			/(iPhone|iPod|iPad)/.test(u) && (v = u.substr(u.indexOf("OS ") + 3, 3).replace(
				"_", ".")), (b && 3 > b || v && 5 > v) && t("html").addClass("sb-static");
		var g = t("#sb-site, .sb-site-container");
		if (t(".sb-left").length) var m = t(".sb-left"),
			p = !1;
		if (t(".sb-right").length) var C = t(".sb-right"),
			y = !1;
		var w = !1,
			k = t(window).width(),
			T = t(
				".sb-toggle-left, .sb-toggle-right, .sb-open-left, .sb-open-right, .sb-close"
			),
			O = t(".sb-slide");
		e(), t(window).resize(function() {
			var s = t(window).width();
			k !== s && (k = s, e(), p && a("left"), y && a("right"))
		});
		var x;
		d && f ? (x = "translate", b && 4.4 > b && (x = "side")) : x = "jQuery",
			this.slidebars = {
				open: a,
				close: o,
				toggle: l,
				init: function() {
					return w
				},
				active: function(t) {
					return "left" === t && m ? p : "right" === t && C ? y : void 0
				},
				destroy: function(t) {
					"left" === t && m && (p && o(), setTimeout(function() {
						m.remove(), m = !1
					}, 400)), "right" === t && C && (y && o(), setTimeout(function() {
						C.remove(), C = !1
					}, 400))
				}
			}, t(".sb-toggle-left").on("touchend click", function(s) {
				r(s, t(this)), l("left")
			}), t(".sb-toggle-right").on("touchend click", function(s) {
				r(s, t(this)), l("right")
			}), t(".sb-open-left").on("touchend click", function(s) {
				r(s, t(this)), a("left")
			}), t(".sb-open-right").on("touchend click", function(s) {
				r(s, t(this)), a("right")
			}), t(".sb-close").on("touchend click", function(s) {
				if (t(this).is("a") || t(this).children().is("a")) {
					if ("click" === s.type) {
						s.stopPropagation(), s.preventDefault();
						var e = t(this).is("a") ? t(this) : t(this).find("a"),
							i = e.attr("href"),
							n = e.attr("target") ? e.attr("target") : "_self";
						o(i, n)
					}
				} else r(s, t(this)), o()
			}), g.on("touchend click", function(s) {
				c.siteClose && (p || y) && (r(s, t(this)), o())
			})
	}
}(jQuery);
/*! @license
 *  Project: Buttons
 *  Description: A highly customizable CSS button library built with Sass and Compass
 *  Author: Alex Wolfe and Rob Levin
 *  License: Apache License v2.0
 */


// the semi-colon before function invocation is a safety net against concatenated
// scripts and/or other plugins which may not be closed properly.
;
(function($, window, document, undefined) {
	'use strict';

	// undefined is used here as the undefined global variable in ECMAScript 3 is
	// mutable (ie. it can be changed by someone else). undefined isn't really being
	// passed in so we can ensure the value of it is truly undefined. In ES5, undefined
	// can no longer be modified.

	// window and document are passed through as local variable rather than global
	// as this (slightly) quickens the resolution process and can be more efficiently
	// minified (especially when both are regularly referenced in your plugin).

	// Create the defaults once
	var pluginName = "menuButton";
	var menuClass = ".button-dropdown";
	var defaults = {
		propertyName: "value"
	};

	// The actual plugin constructor
	function Plugin(element, options) {

		//SET OPTIONS
		this.options = $.extend({}, defaults, options);
		this._defaults = defaults;
		this._name = pluginName;

		//REGISTER ELEMENT
		this.$element = $(element);

		//INITIALIZE
		this.init();
	}

	Plugin.prototype = {
		constructor: Plugin,

		init: function() {
			// WE DON'T STOP PROPGATION SO CLICKS WILL AUTOMATICALLY
			// TOGGLE AND REMOVE THE DROPDOWN
			this.toggle();
		},

		toggle: function(el, options) {
			if (this.$element.data('dropdown') === 'show') {
				this.hideMenu();
			} else {
				this.showMenu();
			}
		},

		showMenu: function() {
			this.$element.data('dropdown', 'show');
			this.$element.find('ul').show();
			this.$element.find('.button:first').addClass('is-active');
		},

		hideMenu: function() {
			this.$element.data('dropdown', 'hide');
			this.$element.find('ul').hide();
			this.$element.find('.button:first').removeClass('is-active');
		}
	};

	// A really lightweight plugin wrapper around the constructor,
	// preventing against multiple instantiations
	$.fn[pluginName] = function(options) {
		return this.each(function() {

			// TOGGLE BUTTON IF IT EXISTS
			if ($.data(this, "plugin_" + pluginName)) {
				$.data(this, "plugin_" + pluginName).toggle();
			}
			// OTHERWISE CREATE A NEW INSTANCE
			else {
				$.data(this, "plugin_" + pluginName, new Plugin(this, options));
			}
		});
	};

	//CLOSE OPEN DROPDOWN MENUS IF CLICKED SOMEWHERE ELSE
	$(document).on('click', function(e) {
		$.each($('[data-buttons=dropdown]'), function(i, value) {
			if ($(e.target.offsetParent)[0] != $(this)[0]) {
				if ($.data(this, "plugin_" + pluginName)) {
					$.data(this, "plugin_" + pluginName).hideMenu();
					$(this).find('ul').hide();
				}
			}
		});
	});

	//DELEGATE CLICK EVENT FOR DROPDOWN MENUS
	$(document).on('click', '[data-buttons=dropdown]', function(e) {
		var $dropdown = $(e.currentTarget);
		$dropdown.menuButton();
	});

	//IGNORE CLICK EVENTS FROM DISPLAY BUTTON IN DROPDOWN
	$(document).on('click', '[data-buttons=dropdown] > a', function(e) {
		e.preventDefault();
	});

})(jQuery, window, document);
/*! WOW - v1.1.2 - 2015-04-07
 * Copyright (c) 2015 Matthieu Aussaguel; Licensed MIT */
(function() {
	var a, b, c, d, e, f = function(a, b) {
			return function() {
				return a.apply(b, arguments)
			}
		},
		g = [].indexOf || function(a) {
			for (var b = 0, c = this.length; c > b; b++)
				if (b in this && this[b] === a) return b;
			return -1
		};
	b = function() {
			function a() {}
			return a.prototype.extend = function(a, b) {
				var c, d;
				for (c in b) d = b[c], null == a[c] && (a[c] = d);
				return a
			}, a.prototype.isMobile = function(a) {
				return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
					a)
			}, a.prototype.createEvent = function(a, b, c, d) {
				var e;
				return null == b && (b = !1), null == c && (c = !1), null == d && (d =
						null), null != document.createEvent ? (e = document.createEvent(
						"CustomEvent"), e.initCustomEvent(a, b, c, d)) : null != document.createEventObject ?
					(e = document.createEventObject(), e.eventType = a) : e.eventName = a, e
			}, a.prototype.emitEvent = function(a, b) {
				return null != a.dispatchEvent ? a.dispatchEvent(b) : b in (null != a) ?
					a[b]() : "on" + b in (null != a) ? a["on" + b]() : void 0
			}, a.prototype.addEvent = function(a, b, c) {
				return null != a.addEventListener ? a.addEventListener(b, c, !1) : null !=
					a.attachEvent ? a.attachEvent("on" + b, c) : a[b] = c
			}, a.prototype.removeEvent = function(a, b, c) {
				return null != a.removeEventListener ? a.removeEventListener(b, c, !1) :
					null != a.detachEvent ? a.detachEvent("on" + b, c) : delete a[b]
			}, a.prototype.innerHeight = function() {
				return "innerHeight" in window ? window.innerHeight : document.documentElement
					.clientHeight
			}, a
		}(), c = this.WeakMap || this.MozWeakMap || (c = function() {
			function a() {
				this.keys = [], this.values = []
			}
			return a.prototype.get = function(a) {
				var b, c, d, e, f;
				for (f = this.keys, b = d = 0, e = f.length; e > d; b = ++d)
					if (c = f[b], c === a) return this.values[b]
			}, a.prototype.set = function(a, b) {
				var c, d, e, f, g;
				for (g = this.keys, c = e = 0, f = g.length; f > e; c = ++e)
					if (d = g[c], d === a) return void(this.values[c] = b);
				return this.keys.push(a), this.values.push(b)
			}, a
		}()), a = this.MutationObserver || this.WebkitMutationObserver || this.MozMutationObserver ||
		(a = function() {
			function a() {
				"undefined" != typeof console && null !== console && console.warn(
						"MutationObserver is not supported by your browser."), "undefined" !=
					typeof console && null !== console && console.warn(
						"WOW.js cannot detect dom mutations, please call .sync() after loading new content."
					)
			}
			return a.notSupported = !0, a.prototype.observe = function() {}, a
		}()), d = this.getComputedStyle || function(a) {
			return this.getPropertyValue = function(b) {
				var c;
				return "float" === b && (b = "styleFloat"), e.test(b) && b.replace(e,
					function(a, b) {
						return b.toUpperCase()
					}), (null != (c = a.currentStyle) ? c[b] : void 0) || null
			}, this
		}, e = /(\-([a-z]){1})/g, this.WOW = function() {
			function e(a) {
				null == a && (a = {}), this.scrollCallback = f(this.scrollCallback, this),
					this.scrollHandler = f(this.scrollHandler, this), this.resetAnimation = f(
						this.resetAnimation, this), this.start = f(this.start, this), this.scrolled = !
					0, this.config = this.util().extend(a, this.defaults), this.animationNameCache =
					new c, this.wowEvent = this.util().createEvent(this.config.boxClass)
			}
			return e.prototype.defaults = {
					boxClass: "wow",
					animateClass: "animated",
					offset: 0,
					mobile: !0,
					live: !0,
					callback: null
				}, e.prototype.init = function() {
					var a;
					return this.element = window.document.documentElement, "interactive" ===
						(a = document.readyState) || "complete" === a ? this.start() : this.util()
						.addEvent(document, "DOMContentLoaded", this.start), this.finished = []
				}, e.prototype.start = function() {
					var b, c, d, e;
					if (this.stopped = !1, this.boxes = function() {
							var a, c, d, e;
							for (d = this.element.querySelectorAll("." + this.config.boxClass), e = [],
								a = 0, c = d.length; c > a; a++) b = d[a], e.push(b);
							return e
						}.call(this), this.all = function() {
							var a, c, d, e;
							for (d = this.boxes, e = [], a = 0, c = d.length; c > a; a++) b = d[a],
								e.push(b);
							return e
						}.call(this), this.boxes.length)
						if (this.disabled()) this.resetStyle();
						else
							for (e = this.boxes, c = 0, d = e.length; d > c; c++) b = e[c], this.applyStyle(
								b, !0);
					return this.disabled() || (this.util().addEvent(window, "scroll", this.scrollHandler),
						this.util().addEvent(window, "resize", this.scrollHandler), this.interval =
						setInterval(this.scrollCallback, 50)), this.config.live ? new a(
						function(a) {
							return function(b) {
								var c, d, e, f, g;
								for (g = [], c = 0, d = b.length; d > c; c++) f = b[c], g.push(
									function() {
										var a, b, c, d;
										for (c = f.addedNodes || [], d = [], a = 0, b = c.length; b > a; a++)
											e = c[a], d.push(this.doSync(e));
										return d
									}.call(a));
								return g
							}
						}(this)).observe(document.body, {
						childList: !0,
						subtree: !0
					}) : void 0
				}, e.prototype.stop = function() {
					return this.stopped = !0, this.util().removeEvent(window, "scroll", this.scrollHandler),
						this.util().removeEvent(window, "resize", this.scrollHandler), null !=
						this.interval ? clearInterval(this.interval) : void 0
				}, e.prototype.sync = function() {
					return a.notSupported ? this.doSync(this.element) : void 0
				}, e.prototype.doSync = function(a) {
					var b, c, d, e, f;
					if (null == a && (a = this.element), 1 === a.nodeType) {
						for (a = a.parentNode || a, e = a.querySelectorAll("." + this.config.boxClass),
							f = [], c = 0, d = e.length; d > c; c++) b = e[c], g.call(this.all, b) <
							0 ? (this.boxes.push(b), this.all.push(b), this.stopped || this.disabled() ?
								this.resetStyle() : this.applyStyle(b, !0), f.push(this.scrolled = !0)
							) : f.push(void 0);
						return f
					}
				}, e.prototype.show = function(a) {
					return this.applyStyle(a), a.className = a.className + " " + this.config.animateClass,
						null != this.config.callback && this.config.callback(a), this.util().emitEvent(
							a, this.wowEvent), this.util().addEvent(a, "animationend", this.resetAnimation),
						this.util().addEvent(a, "oanimationend", this.resetAnimation), this.util()
						.addEvent(a, "webkitAnimationEnd", this.resetAnimation), this.util().addEvent(
							a, "MSAnimationEnd", this.resetAnimation), a
				}, e.prototype.applyStyle = function(a, b) {
					var c, d, e;
					return d = a.getAttribute("data-wow-duration"), c = a.getAttribute(
						"data-wow-delay"), e = a.getAttribute("data-wow-iteration"), this.animate(
						function(f) {
							return function() {
								return f.customStyle(a, b, d, c, e)
							}
						}(this))
				}, e.prototype.animate = function() {
					return "requestAnimationFrame" in window ? function(a) {
						return window.requestAnimationFrame(a)
					} : function(a) {
						return a()
					}
				}(), e.prototype.resetStyle = function() {
					var a, b, c, d, e;
					for (d = this.boxes, e = [], b = 0, c = d.length; c > b; b++) a = d[b], e
						.push(a.style.visibility = "visible");
					return e
				}, e.prototype.resetAnimation = function(a) {
					var b;
					return a.type.toLowerCase().indexOf("animationend") >= 0 ? (b = a.target ||
						a.srcElement, b.className = b.className.replace(this.config.animateClass,
							"").trim()) : void 0
				}, e.prototype.customStyle = function(a, b, c, d, e) {
					return b && this.cacheAnimationName(a), a.style.visibility = b ? "hidden" :
						"visible", c && this.vendorSet(a.style, {
							animationDuration: c
						}), d && this.vendorSet(a.style, {
							animationDelay: d
						}), e && this.vendorSet(a.style, {
							animationIterationCount: e
						}), this.vendorSet(a.style, {
							animationName: b ? "none" : this.cachedAnimationName(a)
						}), a
				}, e.prototype.vendors = ["moz", "webkit"], e.prototype.vendorSet =
				function(a, b) {
					var c, d, e, f;
					d = [];
					for (c in b) e = b[c], a["" + c] = e, d.push(function() {
						var b, d, g, h;
						for (g = this.vendors, h = [], b = 0, d = g.length; d > b; b++) f = g[
							b], h.push(a["" + f + c.charAt(0).toUpperCase() + c.substr(1)] = e);
						return h
					}.call(this));
					return d
				}, e.prototype.vendorCSS = function(a, b) {
					var c, e, f, g, h, i;
					for (h = d(a), g = h.getPropertyCSSValue(b), f = this.vendors, c = 0, e =
						f.length; e > c; c++) i = f[c], g = g || h.getPropertyCSSValue("-" + i +
						"-" + b);
					return g
				}, e.prototype.animationName = function(a) {
					var b;
					try {
						b = this.vendorCSS(a, "animation-name").cssText
					} catch (c) {
						b = d(a).getPropertyValue("animation-name")
					}
					return "none" === b ? "" : b
				}, e.prototype.cacheAnimationName = function(a) {
					return this.animationNameCache.set(a, this.animationName(a))
				}, e.prototype.cachedAnimationName = function(a) {
					return this.animationNameCache.get(a)
				}, e.prototype.scrollHandler = function() {
					return this.scrolled = !0
				}, e.prototype.scrollCallback = function() {
					var a;
					return !this.scrolled || (this.scrolled = !1, this.boxes = function() {
						var b, c, d, e;
						for (d = this.boxes, e = [], b = 0, c = d.length; c > b; b++) a = d[b],
							a && (this.isVisible(a) ? this.show(a) : e.push(a));
						return e
					}.call(this), this.boxes.length || this.config.live) ? void 0 : this.stop()
				}, e.prototype.offsetTop = function(a) {
					for (var b; void 0 === a.offsetTop;) a = a.parentNode;
					for (b = a.offsetTop; a = a.offsetParent;) b += a.offsetTop;
					return b
				}, e.prototype.isVisible = function(a) {
					var b, c, d, e, f;
					return c = a.getAttribute("data-wow-offset") || this.config.offset, f =
						window.pageYOffset, e = f + Math.min(this.element.clientHeight, this.util()
							.innerHeight()) - c, d = this.offsetTop(a), b = d + a.clientHeight, e >=
						d && b >= f
				}, e.prototype.util = function() {
					return null != this._util ? this._util : this._util = new b
				}, e.prototype.disabled = function() {
					return !this.config.mobile && this.util().isMobile(navigator.userAgent)
				}, e
		}()
}).call(this);
/*!
 * Masonry PACKAGED v4.0.0
 * Cascading grid layout library
 * http://masonry.desandro.com
 * MIT License
 * by David DeSandro
 */

! function(t, e) {
	"use strict";
	"function" == typeof define && define.amd ? define(
		"jquery-bridget/jquery-bridget", ["jquery"],
		function(i) {
			e(t, i)
		}) : "object" == typeof module && module.exports ? module.exports = e(t,
		require("jquery")) : t.jQueryBridget = e(t, t.jQuery)
}(window, function(t, e) {
	"use strict";

	function i(i, r, a) {
		function h(t, e, n) {
			var o, r = "$()." + i + '("' + e + '")';
			return t.each(function(t, h) {
				var u = a.data(h, i);
				if (!u) return void s(i + " not initialized. Cannot call methods, i.e. " +
					r);
				var d = u[e];
				if (!d || "_" == e.charAt(0)) return void s(r + " is not a valid method");
				var c = d.apply(u, n);
				o = void 0 === o ? c : o
			}), void 0 !== o ? o : t
		}

		function u(t, e) {
			t.each(function(t, n) {
				var o = a.data(n, i);
				o ? (o.option(e), o._init()) : (o = new r(n, e), a.data(n, i, o))
			})
		}
		a = a || e || t.jQuery, a && (r.prototype.option || (r.prototype.option =
			function(t) {
				a.isPlainObject(t) && (this.options = a.extend(!0, this.options, t))
			}), a.fn[i] = function(t) {
			if ("string" == typeof t) {
				var e = o.call(arguments, 1);
				return h(this, t, e)
			}
			return u(this, t), this
		}, n(a))
	}

	function n(t) {
		!t || t && t.bridget || (t.bridget = i)
	}
	var o = Array.prototype.slice,
		r = t.console,
		s = "undefined" == typeof r ? function() {} : function(t) {
			r.error(t)
		};
	return n(e || t.jQuery), i
}),
function(t, e) {
	"function" == typeof define && define.amd ? define("ev-emitter/ev-emitter", e) :
		"object" == typeof module && module.exports ? module.exports = e() : t.EvEmitter =
		e()
}(this, function() {
	function t() {}
	var e = t.prototype;
	return e.on = function(t, e) {
		if (t && e) {
			var i = this._events = this._events || {},
				n = i[t] = i[t] || [];
			return -1 == n.indexOf(e) && n.push(e), this
		}
	}, e.once = function(t, e) {
		if (t && e) {
			this.on(t, e);
			var i = this._onceEvents = this._onceEvents || {},
				n = i[t] = i[t] || [];
			return n[e] = !0, this
		}
	}, e.off = function(t, e) {
		var i = this._events && this._events[t];
		if (i && i.length) {
			var n = i.indexOf(e);
			return -1 != n && i.splice(n, 1), this
		}
	}, e.emitEvent = function(t, e) {
		var i = this._events && this._events[t];
		if (i && i.length) {
			var n = 0,
				o = i[n];
			e = e || [];
			for (var r = this._onceEvents && this._onceEvents[t]; o;) {
				var s = r && r[o];
				s && (this.off(t, o), delete r[o]), o.apply(this, e), n += s ? 0 : 1, o =
					i[n]
			}
			return this
		}
	}, t
}),
function(t, e) {
	"use strict";
	"function" == typeof define && define.amd ? define("get-size/get-size", [],
			function() {
				return e()
			}) : "object" == typeof module && module.exports ? module.exports = e() : t.getSize =
		e()
}(window, function() {
	"use strict";

	function t(t) {
		var e = parseFloat(t),
			i = -1 == t.indexOf("%") && !isNaN(e);
		return i && e
	}

	function e() {}

	function i() {
		for (var t = {
				width: 0,
				height: 0,
				innerWidth: 0,
				innerHeight: 0,
				outerWidth: 0,
				outerHeight: 0
			}, e = 0; u > e; e++) {
			var i = h[e];
			t[i] = 0
		}
		return t
	}

	function n(t) {
		var e = getComputedStyle(t);
		return e || a("Style returned " + e +
			". Are you running this code in a hidden iframe on Firefox? See http://bit.ly/getsizebug1"
		), e
	}

	function o() {
		if (!d) {
			d = !0;
			var e = document.createElement("div");
			e.style.width = "200px", e.style.padding = "1px 2px 3px 4px", e.style.borderStyle =
				"solid", e.style.borderWidth = "1px 2px 3px 4px", e.style.boxSizing =
				"border-box";
			var i = document.body || document.documentElement;
			i.appendChild(e);
			var o = n(e);
			r.isBoxSizeOuter = s = 200 == t(o.width), i.removeChild(e)
		}
	}

	function r(e) {
		if (o(), "string" == typeof e && (e = document.querySelector(e)), e &&
			"object" == typeof e && e.nodeType) {
			var r = n(e);
			if ("none" == r.display) return i();
			var a = {};
			a.width = e.offsetWidth, a.height = e.offsetHeight;
			for (var d = a.isBorderBox = "border-box" == r.boxSizing, c = 0; u > c; c++) {
				var l = h[c],
					f = r[l],
					m = parseFloat(f);
				a[l] = isNaN(m) ? 0 : m
			}
			var p = a.paddingLeft + a.paddingRight,
				g = a.paddingTop + a.paddingBottom,
				y = a.marginLeft + a.marginRight,
				v = a.marginTop + a.marginBottom,
				_ = a.borderLeftWidth + a.borderRightWidth,
				E = a.borderTopWidth + a.borderBottomWidth,
				z = d && s,
				b = t(r.width);
			b !== !1 && (a.width = b + (z ? 0 : p + _));
			var x = t(r.height);
			return x !== !1 && (a.height = x + (z ? 0 : g + E)), a.innerWidth = a.width -
				(p + _), a.innerHeight = a.height - (g + E), a.outerWidth = a.width + y, a
				.outerHeight = a.height + v, a
		}
	}
	var s, a = "undefined" == typeof console ? e : function(t) {
			console.error(t)
		},
		h = ["paddingLeft", "paddingRight", "paddingTop", "paddingBottom",
			"marginLeft", "marginRight", "marginTop", "marginBottom", "borderLeftWidth",
			"borderRightWidth", "borderTopWidth", "borderBottomWidth"
		],
		u = h.length,
		d = !1;
	return r
}),
function(t, e) {
	"use strict";
	"function" == typeof define && define.amd ? define(
			"matches-selector/matches-selector", e) : "object" == typeof module &&
		module.exports ? module.exports = e() : t.matchesSelector = e()
}(window, function() {
	"use strict";
	var t = function() {
		var t = Element.prototype;
		if (t.matches) return "matches";
		if (t.matchesSelector) return "matchesSelector";
		for (var e = ["webkit", "moz", "ms", "o"], i = 0; i < e.length; i++) {
			var n = e[i],
				o = n + "MatchesSelector";
			if (t[o]) return o
		}
	}();
	return function(e, i) {
		return e[t](i)
	}
}),
function(t, e) {
	"use strict";
	"function" == typeof define && define.amd ? define("fizzy-ui-utils/utils", [
		"matches-selector/matches-selector"
	], function(i) {
		return e(t, i)
	}) : "object" == typeof module && module.exports ? module.exports = e(t,
		require("desandro-matches-selector")) : t.fizzyUIUtils = e(t, t.matchesSelector)
}(window, function(t, e) {
	var i = {};
	i.extend = function(t, e) {
		for (var i in e) t[i] = e[i];
		return t
	}, i.modulo = function(t, e) {
		return (t % e + e) % e
	}, i.makeArray = function(t) {
		var e = [];
		if (Array.isArray(t)) e = t;
		else if (t && "number" == typeof t.length)
			for (var i = 0; i < t.length; i++) e.push(t[i]);
		else e.push(t);
		return e
	}, i.removeFrom = function(t, e) {
		var i = t.indexOf(e); - 1 != i && t.splice(i, 1)
	}, i.getParent = function(t, i) {
		for (; t != document.body;)
			if (t = t.parentNode, e(t, i)) return t
	}, i.getQueryElement = function(t) {
		return "string" == typeof t ? document.querySelector(t) : t
	}, i.handleEvent = function(t) {
		var e = "on" + t.type;
		this[e] && this[e](t)
	}, i.filterFindElements = function(t, n) {
		t = i.makeArray(t);
		var o = [];
		return t.forEach(function(t) {
			if (t instanceof HTMLElement) {
				if (!n) return void o.push(t);
				e(t, n) && o.push(t);
				for (var i = t.querySelectorAll(n), r = 0; r < i.length; r++) o.push(i[
					r])
			}
		}), o
	}, i.debounceMethod = function(t, e, i) {
		var n = t.prototype[e],
			o = e + "Timeout";
		t.prototype[e] = function() {
			var t = this[o];
			t && clearTimeout(t);
			var e = arguments,
				r = this;
			this[o] = setTimeout(function() {
				n.apply(r, e), delete r[o]
			}, i || 100)
		}
	}, i.docReady = function(t) {
		"complete" == document.readyState ? t() : document.addEventListener(
			"DOMContentLoaded", t)
	}, i.toDashed = function(t) {
		return t.replace(/(.)([A-Z])/g, function(t, e, i) {
			return e + "-" + i
		}).toLowerCase()
	};
	var n = t.console;
	return i.htmlInit = function(e, o) {
		i.docReady(function() {
			var r = i.toDashed(o),
				s = "data-" + r,
				a = document.querySelectorAll("[" + s + "]"),
				h = document.querySelectorAll(".js-" + r),
				u = i.makeArray(a).concat(i.makeArray(h)),
				d = s + "-options",
				c = t.jQuery;
			u.forEach(function(t) {
				var i, r = t.getAttribute(s) || t.getAttribute(d);
				try {
					i = r && JSON.parse(r)
				} catch (a) {
					return void(n && n.error("Error parsing " + s + " on " + t.className +
						": " + a))
				}
				var h = new e(t, i);
				c && c.data(t, o, h)
			})
		})
	}, i
}),
function(t, e) {
	"function" == typeof define && define.amd ? define("outlayer/item", [
		"ev-emitter/ev-emitter", "get-size/get-size"
	], function(i, n) {
		return e(t, i, n)
	}) : "object" == typeof module && module.exports ? module.exports = e(t,
		require("ev-emitter"), require("get-size")) : (t.Outlayer = {}, t.Outlayer.Item =
		e(t, t.EvEmitter, t.getSize))
}(window, function(t, e, i) {
	"use strict";

	function n(t) {
		for (var e in t) return !1;
		return e = null, !0
	}

	function o(t, e) {
		t && (this.element = t, this.layout = e, this.position = {
			x: 0,
			y: 0
		}, this._create())
	}

	function r(t) {
		return t.replace(/([A-Z])/g, function(t) {
			return "-" + t.toLowerCase()
		})
	}
	var s = document.documentElement.style,
		a = "string" == typeof s.transition ? "transition" : "WebkitTransition",
		h = "string" == typeof s.transform ? "transform" : "WebkitTransform",
		u = {
			WebkitTransition: "webkitTransitionEnd",
			transition: "transitionend"
		}[a],
		d = [h, a, a + "Duration", a + "Property"],
		c = o.prototype = Object.create(e.prototype);
	c.constructor = o, c._create = function() {
		this._transn = {
			ingProperties: {},
			clean: {},
			onEnd: {}
		}, this.css({
			position: "absolute"
		})
	}, c.handleEvent = function(t) {
		var e = "on" + t.type;
		this[e] && this[e](t)
	}, c.getSize = function() {
		this.size = i(this.element)
	}, c.css = function(t) {
		var e = this.element.style;
		for (var i in t) {
			var n = d[i] || i;
			e[n] = t[i]
		}
	}, c.getPosition = function() {
		var t = getComputedStyle(this.element),
			e = this.layout._getOption("originLeft"),
			i = this.layout._getOption("originTop"),
			n = t[e ? "left" : "right"],
			o = t[i ? "top" : "bottom"],
			r = this.layout.size,
			s = -1 != n.indexOf("%") ? parseFloat(n) / 100 * r.width : parseInt(n, 10),
			a = -1 != o.indexOf("%") ? parseFloat(o) / 100 * r.height : parseInt(o, 10);
		s = isNaN(s) ? 0 : s, a = isNaN(a) ? 0 : a, s -= e ? r.paddingLeft : r.paddingRight,
			a -= i ? r.paddingTop : r.paddingBottom, this.position.x = s, this.position
			.y = a
	}, c.layoutPosition = function() {
		var t = this.layout.size,
			e = {},
			i = this.layout._getOption("originLeft"),
			n = this.layout._getOption("originTop"),
			o = i ? "paddingLeft" : "paddingRight",
			r = i ? "left" : "right",
			s = i ? "right" : "left",
			a = this.position.x + t[o];
		e[r] = this.getXValue(a), e[s] = "";
		var h = n ? "paddingTop" : "paddingBottom",
			u = n ? "top" : "bottom",
			d = n ? "bottom" : "top",
			c = this.position.y + t[h];
		e[u] = this.getYValue(c), e[d] = "", this.css(e), this.emitEvent("layout", [
			this
		])
	}, c.getXValue = function(t) {
		var e = this.layout._getOption("horizontal");
		return this.layout.options.percentPosition && !e ? t / this.layout.size.width *
			100 + "%" : t + "px"
	}, c.getYValue = function(t) {
		var e = this.layout._getOption("horizontal");
		return this.layout.options.percentPosition && e ? t / this.layout.size.height *
			100 + "%" : t + "px"
	}, c._transitionTo = function(t, e) {
		this.getPosition();
		var i = this.position.x,
			n = this.position.y,
			o = parseInt(t, 10),
			r = parseInt(e, 10),
			s = o === this.position.x && r === this.position.y;
		if (this.setPosition(t, e), s && !this.isTransitioning) return void this.layoutPosition();
		var a = t - i,
			h = e - n,
			u = {};
		u.transform = this.getTranslate(a, h), this.transition({
			to: u,
			onTransitionEnd: {
				transform: this.layoutPosition
			},
			isCleaning: !0
		})
	}, c.getTranslate = function(t, e) {
		var i = this.layout._getOption("originLeft"),
			n = this.layout._getOption("originTop");
		return t = i ? t : -t, e = n ? e : -e, "translate3d(" + t + "px, " + e +
			"px, 0)"
	}, c.goTo = function(t, e) {
		this.setPosition(t, e), this.layoutPosition()
	}, c.moveTo = c._transitionTo, c.setPosition = function(t, e) {
		this.position.x = parseInt(t, 10), this.position.y = parseInt(e, 10)
	}, c._nonTransition = function(t) {
		this.css(t.to), t.isCleaning && this._removeStyles(t.to);
		for (var e in t.onTransitionEnd) t.onTransitionEnd[e].call(this)
	}, c._transition = function(t) {
		if (!parseFloat(this.layout.options.transitionDuration)) return void this._nonTransition(
			t);
		var e = this._transn;
		for (var i in t.onTransitionEnd) e.onEnd[i] = t.onTransitionEnd[i];
		for (i in t.to) e.ingProperties[i] = !0, t.isCleaning && (e.clean[i] = !0);
		if (t.from) {
			this.css(t.from);
			var n = this.element.offsetHeight;
			n = null
		}
		this.enableTransition(t.to), this.css(t.to), this.isTransitioning = !0
	};
	var l = "opacity," + r(d.transform || "transform");
	c.enableTransition = function() {
			this.isTransitioning || (this.css({
				transitionProperty: l,
				transitionDuration: this.layout.options.transitionDuration
			}), this.element.addEventListener(u, this, !1))
		}, c.transition = o.prototype[a ? "_transition" : "_nonTransition"], c.onwebkitTransitionEnd =
		function(t) {
			this.ontransitionend(t)
		}, c.onotransitionend = function(t) {
			this.ontransitionend(t)
		};
	var f = {
		"-webkit-transform": "transform"
	};
	c.ontransitionend = function(t) {
		if (t.target === this.element) {
			var e = this._transn,
				i = f[t.propertyName] || t.propertyName;
			if (delete e.ingProperties[i], n(e.ingProperties) && this.disableTransition(),
				i in e.clean && (this.element.style[t.propertyName] = "", delete e.clean[
					i]), i in e.onEnd) {
				var o = e.onEnd[i];
				o.call(this), delete e.onEnd[i]
			}
			this.emitEvent("transitionEnd", [this])
		}
	}, c.disableTransition = function() {
		this.removeTransitionStyles(), this.element.removeEventListener(u, this, !1),
			this.isTransitioning = !1
	}, c._removeStyles = function(t) {
		var e = {};
		for (var i in t) e[i] = "";
		this.css(e)
	};
	var m = {
		transitionProperty: "",
		transitionDuration: ""
	};
	return c.removeTransitionStyles = function() {
		this.css(m)
	}, c.removeElem = function() {
		this.element.parentNode.removeChild(this.element), this.css({
			display: ""
		}), this.emitEvent("remove", [this])
	}, c.remove = function() {
		return a && parseFloat(this.layout.options.transitionDuration) ? (this.once(
			"transitionEnd",
			function() {
				this.removeElem()
			}), void this.hide()) : void this.removeElem()
	}, c.reveal = function() {
		delete this.isHidden, this.css({
			display: ""
		});
		var t = this.layout.options,
			e = {},
			i = this.getHideRevealTransitionEndProperty("visibleStyle");
		e[i] = this.onRevealTransitionEnd, this.transition({
			from: t.hiddenStyle,
			to: t.visibleStyle,
			isCleaning: !0,
			onTransitionEnd: e
		})
	}, c.onRevealTransitionEnd = function() {
		this.isHidden || this.emitEvent("reveal")
	}, c.getHideRevealTransitionEndProperty = function(t) {
		var e = this.layout.options[t];
		if (e.opacity) return "opacity";
		for (var i in e) return i
	}, c.hide = function() {
		this.isHidden = !0, this.css({
			display: ""
		});
		var t = this.layout.options,
			e = {},
			i = this.getHideRevealTransitionEndProperty("hiddenStyle");
		e[i] = this.onHideTransitionEnd, this.transition({
			from: t.visibleStyle,
			to: t.hiddenStyle,
			isCleaning: !0,
			onTransitionEnd: e
		})
	}, c.onHideTransitionEnd = function() {
		this.isHidden && (this.css({
			display: "none"
		}), this.emitEvent("hide"))
	}, c.destroy = function() {
		this.css({
			position: "",
			left: "",
			right: "",
			top: "",
			bottom: "",
			transition: "",
			transform: ""
		})
	}, o
}),
function(t, e) {
	"use strict";
	"function" == typeof define && define.amd ? define("outlayer/outlayer", [
		"ev-emitter/ev-emitter", "get-size/get-size", "fizzy-ui-utils/utils",
		"./item"
	], function(i, n, o, r) {
		return e(t, i, n, o, r)
	}) : "object" == typeof module && module.exports ? module.exports = e(t,
		require("ev-emitter"), require("get-size"), require("fizzy-ui-utils"),
		require("./item")) : t.Outlayer = e(t, t.EvEmitter, t.getSize, t.fizzyUIUtils,
		t.Outlayer.Item)
}(window, function(t, e, i, n, o) {
	"use strict";

	function r(t, e) {
		var i = n.getQueryElement(t);
		if (!i) return void(a && a.error("Bad element for " + this.constructor.namespace +
			": " + (i || t)));
		this.element = i, h && (this.$element = h(this.element)), this.options = n.extend({},
			this.constructor.defaults), this.option(e);
		var o = ++d;
		this.element.outlayerGUID = o, c[o] = this, this._create();
		var r = this._getOption("initLayout");
		r && this.layout()
	}

	function s(t) {
		function e() {
			t.apply(this, arguments)
		}
		return e.prototype = Object.create(t.prototype), e.prototype.constructor = e,
			e
	}
	var a = t.console,
		h = t.jQuery,
		u = function() {},
		d = 0,
		c = {};
	r.namespace = "outlayer", r.Item = o, r.defaults = {
		containerStyle: {
			position: "relative"
		},
		initLayout: !0,
		originLeft: !0,
		originTop: !0,
		resize: !0,
		resizeContainer: !0,
		transitionDuration: "0.4s",
		hiddenStyle: {
			opacity: 0,
			transform: "scale(0.001)"
		},
		visibleStyle: {
			opacity: 1,
			transform: "scale(1)"
		}
	};
	var l = r.prototype;
	return n.extend(l, e.prototype), l.option = function(t) {
		n.extend(this.options, t)
	}, l._getOption = function(t) {
		var e = this.constructor.compatOptions[t];
		return e && void 0 !== this.options[e] ? this.options[e] : this.options[t]
	}, r.compatOptions = {
		initLayout: "isInitLayout",
		horizontal: "isHorizontal",
		layoutInstant: "isLayoutInstant",
		originLeft: "isOriginLeft",
		originTop: "isOriginTop",
		resize: "isResizeBound",
		resizeContainer: "isResizingContainer"
	}, l._create = function() {
		this.reloadItems(), this.stamps = [], this.stamp(this.options.stamp), n.extend(
			this.element.style, this.options.containerStyle);
		var t = this._getOption("resize");
		t && this.bindResize()
	}, l.reloadItems = function() {
		this.items = this._itemize(this.element.children)
	}, l._itemize = function(t) {
		for (var e = this._filterFindItemElements(t), i = this.constructor.Item, n = [],
				o = 0; o < e.length; o++) {
			var r = e[o],
				s = new i(r, this);
			n.push(s)
		}
		return n
	}, l._filterFindItemElements = function(t) {
		return n.filterFindElements(t, this.options.itemSelector)
	}, l.getItemElements = function() {
		return this.items.map(function(t) {
			return t.element
		})
	}, l.layout = function() {
		this._resetLayout(), this._manageStamps();
		var t = this._getOption("layoutInstant"),
			e = void 0 !== t ? t : !this._isLayoutInited;
		this.layoutItems(this.items, e), this._isLayoutInited = !0
	}, l._init = l.layout, l._resetLayout = function() {
		this.getSize()
	}, l.getSize = function() {
		this.size = i(this.element)
	}, l._getMeasurement = function(t, e) {
		var n, o = this.options[t];
		o ? ("string" == typeof o ? n = this.element.querySelector(o) : o instanceof HTMLElement &&
			(n = o), this[t] = n ? i(n)[e] : o) : this[t] = 0
	}, l.layoutItems = function(t, e) {
		t = this._getItemsForLayout(t), this._layoutItems(t, e), this._postLayout()
	}, l._getItemsForLayout = function(t) {
		return t.filter(function(t) {
			return !t.isIgnored
		})
	}, l._layoutItems = function(t, e) {
		if (this._emitCompleteOnItems("layout", t), t && t.length) {
			var i = [];
			t.forEach(function(t) {
				var n = this._getItemLayoutPosition(t);
				n.item = t, n.isInstant = e || t.isLayoutInstant, i.push(n)
			}, this), this._processLayoutQueue(i)
		}
	}, l._getItemLayoutPosition = function() {
		return {
			x: 0,
			y: 0
		}
	}, l._processLayoutQueue = function(t) {
		t.forEach(function(t) {
			this._positionItem(t.item, t.x, t.y, t.isInstant)
		}, this)
	}, l._positionItem = function(t, e, i, n) {
		n ? t.goTo(e, i) : t.moveTo(e, i)
	}, l._postLayout = function() {
		this.resizeContainer()
	}, l.resizeContainer = function() {
		var t = this._getOption("resizeContainer");
		if (t) {
			var e = this._getContainerSize();
			e && (this._setContainerMeasure(e.width, !0), this._setContainerMeasure(e.height, !
				1))
		}
	}, l._getContainerSize = u, l._setContainerMeasure = function(t, e) {
		if (void 0 !== t) {
			var i = this.size;
			i.isBorderBox && (t += e ? i.paddingLeft + i.paddingRight + i.borderLeftWidth +
				i.borderRightWidth : i.paddingBottom + i.paddingTop + i.borderTopWidth +
				i.borderBottomWidth), t = Math.max(t, 0), this.element.style[e ? "width" :
				"height"] = t + "px"
		}
	}, l._emitCompleteOnItems = function(t, e) {
		function i() {
			o.dispatchEvent(t + "Complete", null, [e])
		}

		function n() {
			s++, s == r && i()
		}
		var o = this,
			r = e.length;
		if (!e || !r) return void i();
		var s = 0;
		e.forEach(function(e) {
			e.once(t, n)
		})
	}, l.dispatchEvent = function(t, e, i) {
		var n = e ? [e].concat(i) : i;
		if (this.emitEvent(t, n), h)
			if (this.$element = this.$element || h(this.element), e) {
				var o = h.Event(e);
				o.type = t, this.$element.trigger(o, i)
			} else this.$element.trigger(t, i)
	}, l.ignore = function(t) {
		var e = this.getItem(t);
		e && (e.isIgnored = !0)
	}, l.unignore = function(t) {
		var e = this.getItem(t);
		e && delete e.isIgnored
	}, l.stamp = function(t) {
		t = this._find(t), t && (this.stamps = this.stamps.concat(t), t.forEach(
			this.ignore, this))
	}, l.unstamp = function(t) {
		t = this._find(t), t && t.forEach(function(t) {
			n.removeFrom(this.stamps, t), this.unignore(t)
		}, this)
	}, l._find = function(t) {
		return t ? ("string" == typeof t && (t = this.element.querySelectorAll(t)),
			t = n.makeArray(t)) : void 0
	}, l._manageStamps = function() {
		this.stamps && this.stamps.length && (this._getBoundingRect(), this.stamps.forEach(
			this._manageStamp, this))
	}, l._getBoundingRect = function() {
		var t = this.element.getBoundingClientRect(),
			e = this.size;
		this._boundingRect = {
			left: t.left + e.paddingLeft + e.borderLeftWidth,
			top: t.top + e.paddingTop + e.borderTopWidth,
			right: t.right - (e.paddingRight + e.borderRightWidth),
			bottom: t.bottom - (e.paddingBottom + e.borderBottomWidth)
		}
	}, l._manageStamp = u, l._getElementOffset = function(t) {
		var e = t.getBoundingClientRect(),
			n = this._boundingRect,
			o = i(t),
			r = {
				left: e.left - n.left - o.marginLeft,
				top: e.top - n.top - o.marginTop,
				right: n.right - e.right - o.marginRight,
				bottom: n.bottom - e.bottom - o.marginBottom
			};
		return r
	}, l.handleEvent = n.handleEvent, l.bindResize = function() {
		t.addEventListener("resize", this), this.isResizeBound = !0
	}, l.unbindResize = function() {
		t.removeEventListener("resize", this), this.isResizeBound = !1
	}, l.onresize = function() {
		this.resize()
	}, n.debounceMethod(r, "onresize", 100), l.resize = function() {
		this.isResizeBound && this.needsResizeLayout() && this.layout()
	}, l.needsResizeLayout = function() {
		var t = i(this.element),
			e = this.size && t;
		return e && t.innerWidth !== this.size.innerWidth
	}, l.addItems = function(t) {
		var e = this._itemize(t);
		return e.length && (this.items = this.items.concat(e)), e
	}, l.appended = function(t) {
		var e = this.addItems(t);
		e.length && (this.layoutItems(e, !0), this.reveal(e))
	}, l.prepended = function(t) {
		var e = this._itemize(t);
		if (e.length) {
			var i = this.items.slice(0);
			this.items = e.concat(i), this._resetLayout(), this._manageStamps(), this.layoutItems(
				e, !0), this.reveal(e), this.layoutItems(i)
		}
	}, l.reveal = function(t) {
		this._emitCompleteOnItems("reveal", t), t && t.length && t.forEach(function(
			t) {
			t.reveal()
		})
	}, l.hide = function(t) {
		this._emitCompleteOnItems("hide", t), t && t.length && t.forEach(function(t) {
			t.hide()
		})
	}, l.revealItemElements = function(t) {
		var e = this.getItems(t);
		this.reveal(e)
	}, l.hideItemElements = function(t) {
		var e = this.getItems(t);
		this.hide(e)
	}, l.getItem = function(t) {
		for (var e = 0; e < this.items.length; e++) {
			var i = this.items[e];
			if (i.element == t) return i
		}
	}, l.getItems = function(t) {
		t = n.makeArray(t);
		var e = [];
		return t.forEach(function(t) {
			var i = this.getItem(t);
			i && e.push(i)
		}, this), e
	}, l.remove = function(t) {
		var e = this.getItems(t);
		this._emitCompleteOnItems("remove", e), e && e.length && e.forEach(function(
			t) {
			t.remove(), n.removeFrom(this.items, t)
		}, this)
	}, l.destroy = function() {
		var t = this.element.style;
		t.height = "", t.position = "", t.width = "", this.items.forEach(function(t) {
			t.destroy()
		}), this.unbindResize();
		var e = this.element.outlayerGUID;
		delete c[e], delete this.element.outlayerGUID, h && h.removeData(this.element,
			this.constructor.namespace)
	}, r.data = function(t) {
		t = n.getQueryElement(t);
		var e = t && t.outlayerGUID;
		return e && c[e]
	}, r.create = function(t, e) {
		var i = s(r);
		return i.defaults = n.extend({}, r.defaults), n.extend(i.defaults, e), i.compatOptions =
			n.extend({}, r.compatOptions), i.namespace = t, i.data = r.data, i.Item =
			s(o), n.htmlInit(i, t), h && h.bridget && h.bridget(t, i), i
	}, r.Item = o, r
}),

function(t, e) {
	"function" == typeof define && define.amd ? define(["outlayer/outlayer",
		"get-size/get-size"
	], e) : "object" == typeof module && module.exports ? module.exports = e(
		require("outlayer"), require("get-size")) : t.Masonry = e(t.Outlayer, t.getSize)
}(window, function(t, e) {
	var i = t.create("masonry");
	return i.compatOptions.fitWidth = "isFitWidth", i.prototype._resetLayout =
		function() {
			this.getSize(), this._getMeasurement("columnWidth", "outerWidth"), this._getMeasurement(
				"gutter", "outerWidth"), this.measureColumns(), this.colYs = [];
			for (var t = 0; t < this.cols; t++) this.colYs.push(0);
			this.maxY = 0
		}, i.prototype.measureColumns = function() {
			if (this.getContainerWidth(), !this.columnWidth) {
				var t = this.items[0],
					i = t && t.element;
				this.columnWidth = i && e(i).outerWidth || this.containerWidth
			}
			var n = this.columnWidth += this.gutter,
				o = this.containerWidth + this.gutter,
				r = o / n,
				s = n - o % n,
				a = s && 1 > s ? "round" : "floor";
			r = Math[a](r), this.cols = Math.max(r, 1)
		}, i.prototype.getContainerWidth = function() {
			var t = this._getOption("fitWidth"),
				i = t ? this.element.parentNode : this.element,
				n = e(i);
			this.containerWidth = n && n.innerWidth
		}, i.prototype._getItemLayoutPosition = function(t) {
			t.getSize();
			var e = t.size.outerWidth % this.columnWidth,
				i = e && 1 > e ? "round" : "ceil",
				n = Math[i](t.size.outerWidth / this.columnWidth);
			n = Math.min(n, this.cols);
			for (var o = this._getColGroup(n), r = Math.min.apply(Math, o), s = o.indexOf(
					r), a = {
					x: this.columnWidth * s,
					y: r
				}, h = r + t.size.outerHeight, u = this.cols + 1 - o.length, d = 0; u > d; d++)
				this.colYs[s + d] = h;
			return a
		}, i.prototype._getColGroup = function(t) {
			if (2 > t) return this.colYs;
			for (var e = [], i = this.cols + 1 - t, n = 0; i > n; n++) {
				var o = this.colYs.slice(n, n + t);
				e[n] = Math.max.apply(Math, o)
			}
			return e
		}, i.prototype._manageStamp = function(t) {
			var i = e(t),
				n = this._getElementOffset(t),
				o = this._getOption("originLeft"),
				r = o ? n.left : n.right,
				s = r + i.outerWidth,
				a = Math.floor(r / this.columnWidth);
			a = Math.max(0, a);
			var h = Math.floor(s / this.columnWidth);
			h -= s % this.columnWidth ? 0 : 1, h = Math.min(this.cols - 1, h);
			for (var u = this._getOption("originTop"), d = (u ? n.top : n.bottom) + i.outerHeight,
					c = a; h >= c; c++) this.colYs[c] = Math.max(d, this.colYs[c])
		}, i.prototype._getContainerSize = function() {
			this.maxY = Math.max.apply(Math, this.colYs);
			var t = {
				height: this.maxY
			};
			return this._getOption("fitWidth") && (t.width = this._getContainerFitWidth()),
				t
		}, i.prototype._getContainerFitWidth = function() {
			for (var t = 0, e = this.cols; --e && 0 === this.colYs[e];) t++;
			return (this.cols - t) * this.columnWidth - this.gutter
		}, i.prototype.needsResizeLayout = function() {
			var t = this.containerWidth;
			return this.getContainerWidth(), t != this.containerWidth
		}, i
});
/*!
 * imagesLoaded PACKAGED v4.1.0
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */

! function(t, e) {
	"function" == typeof define && define.amd ? define("ev-emitter/ev-emitter", e) :
		"object" == typeof module && module.exports ? module.exports = e() : t.EvEmitter =
		e()
}(this, function() {
	function t() {}
	var e = t.prototype;
	return e.on = function(t, e) {
		if (t && e) {
			var i = this._events = this._events || {},
				n = i[t] = i[t] || [];
			return -1 == n.indexOf(e) && n.push(e), this
		}
	}, e.once = function(t, e) {
		if (t && e) {
			this.on(t, e);
			var i = this._onceEvents = this._onceEvents || {},
				n = i[t] = i[t] || [];
			return n[e] = !0, this
		}
	}, e.off = function(t, e) {
		var i = this._events && this._events[t];
		if (i && i.length) {
			var n = i.indexOf(e);
			return -1 != n && i.splice(n, 1), this
		}
	}, e.emitEvent = function(t, e) {
		var i = this._events && this._events[t];
		if (i && i.length) {
			var n = 0,
				o = i[n];
			e = e || [];
			for (var r = this._onceEvents && this._onceEvents[t]; o;) {
				var s = r && r[o];
				s && (this.off(t, o), delete r[o]), o.apply(this, e), n += s ? 0 : 1, o =
					i[n]
			}
			return this
		}
	}, t
}),
function(t, e) {
	"use strict";
	"function" == typeof define && define.amd ? define(["ev-emitter/ev-emitter"],
		function(i) {
			return e(t, i)
		}) : "object" == typeof module && module.exports ? module.exports = e(t,
		require("ev-emitter")) : t.imagesLoaded = e(t, t.EvEmitter)
}(window, function(t, e) {
	function i(t, e) {
		for (var i in e) t[i] = e[i];
		return t
	}

	function n(t) {
		var e = [];
		if (Array.isArray(t)) e = t;
		else if ("number" == typeof t.length)
			for (var i = 0; i < t.length; i++) e.push(t[i]);
		else e.push(t);
		return e
	}

	function o(t, e, r) {
		return this instanceof o ? ("string" == typeof t && (t = document.querySelectorAll(
				t)), this.elements = n(t), this.options = i({}, this.options), "function" ==
			typeof e ? r = e : i(this.options, e), r && this.on("always", r), this.getImages(),
			h && (this.jqDeferred = new h.Deferred), void setTimeout(function() {
				this.check()
			}.bind(this))) : new o(t, e, r)
	}

	function r(t) {
		this.img = t
	}

	function s(t, e) {
		this.url = t, this.element = e, this.img = new Image
	}
	var h = t.jQuery,
		a = t.console;
	o.prototype = Object.create(e.prototype), o.prototype.options = {}, o.prototype
		.getImages = function() {
			this.images = [], this.elements.forEach(this.addElementImages, this)
		}, o.prototype.addElementImages = function(t) {
			"IMG" == t.nodeName && this.addImage(t), this.options.background === !0 &&
				this.addElementBackgroundImages(t);
			var e = t.nodeType;
			if (e && d[e]) {
				for (var i = t.querySelectorAll("img"), n = 0; n < i.length; n++) {
					var o = i[n];
					this.addImage(o)
				}
				if ("string" == typeof this.options.background) {
					var r = t.querySelectorAll(this.options.background);
					for (n = 0; n < r.length; n++) {
						var s = r[n];
						this.addElementBackgroundImages(s)
					}
				}
			}
		};
	var d = {
		1: !0,
		9: !0,
		11: !0
	};
	return o.prototype.addElementBackgroundImages = function(t) {
		var e = getComputedStyle(t);
		if (e)
			for (var i = /url\((['"])?(.*?)\1\)/gi, n = i.exec(e.backgroundImage); null !==
				n;) {
				var o = n && n[2];
				o && this.addBackground(o, t), n = i.exec(e.backgroundImage)
			}
	}, o.prototype.addImage = function(t) {
		var e = new r(t);
		this.images.push(e)
	}, o.prototype.addBackground = function(t, e) {
		var i = new s(t, e);
		this.images.push(i)
	}, o.prototype.check = function() {
		function t(t, i, n) {
			setTimeout(function() {
				e.progress(t, i, n)
			})
		}
		var e = this;
		return this.progressedCount = 0, this.hasAnyBroken = !1, this.images.length ?
			void this.images.forEach(function(e) {
				e.once("progress", t), e.check()
			}) : void this.complete()
	}, o.prototype.progress = function(t, e, i) {
		this.progressedCount++, this.hasAnyBroken = this.hasAnyBroken || !t.isLoaded,
			this.emitEvent("progress", [this, t, e]), this.jqDeferred && this.jqDeferred
			.notify && this.jqDeferred.notify(this, t), this.progressedCount == this.images
			.length && this.complete(), this.options.debug && a && a.log("progress: " +
				i, t, e)
	}, o.prototype.complete = function() {
		var t = this.hasAnyBroken ? "fail" : "done";
		if (this.isComplete = !0, this.emitEvent(t, [this]), this.emitEvent(
				"always", [this]), this.jqDeferred) {
			var e = this.hasAnyBroken ? "reject" : "resolve";
			this.jqDeferred[e](this)
		}
	}, r.prototype = Object.create(e.prototype), r.prototype.check = function() {
		var t = this.getIsImageComplete();
		return t ? void this.confirm(0 !== this.img.naturalWidth, "naturalWidth") :
			(this.proxyImage = new Image, this.proxyImage.addEventListener("load",
				this), this.proxyImage.addEventListener("error", this), this.img.addEventListener(
				"load", this), this.img.addEventListener("error", this), void(this.proxyImage
				.src = this.img.src))
	}, r.prototype.getIsImageComplete = function() {
		return this.img.complete && void 0 !== this.img.naturalWidth
	}, r.prototype.confirm = function(t, e) {
		this.isLoaded = t, this.emitEvent("progress", [this, this.img, e])
	}, r.prototype.handleEvent = function(t) {
		var e = "on" + t.type;
		this[e] && this[e](t)
	}, r.prototype.onload = function() {
		this.confirm(!0, "onload"), this.unbindEvents()
	}, r.prototype.onerror = function() {
		this.confirm(!1, "onerror"), this.unbindEvents()
	}, r.prototype.unbindEvents = function() {
		this.proxyImage.removeEventListener("load", this), this.proxyImage.removeEventListener(
			"error", this), this.img.removeEventListener("load", this), this.img.removeEventListener(
			"error", this)
	}, s.prototype = Object.create(r.prototype), s.prototype.check = function() {
		this.img.addEventListener("load", this), this.img.addEventListener("error",
			this), this.img.src = this.url;
		var t = this.getIsImageComplete();
		t && (this.confirm(0 !== this.img.naturalWidth, "naturalWidth"), this.unbindEvents())
	}, s.prototype.unbindEvents = function() {
		this.img.removeEventListener("load", this), this.img.removeEventListener(
			"error", this)
	}, s.prototype.confirm = function(t, e) {
		this.isLoaded = t, this.emitEvent("progress", [this, this.element, e])
	}, o.makeJQueryPlugin = function(e) {
		e = e || t.jQuery, e && (h = e, h.fn.imagesLoaded = function(t, e) {
			var i = new o(this, t, e);
			return i.jqDeferred.promise(h(this))
		})
	}, o.makeJQueryPlugin(), o
});
/*
 * jquery-match-height master by @liabru
 * http://brm.io/jquery-match-height/
 * License MIT
 */
! function(t) {
	"use strict";
	"function" == typeof define && define.amd ? define(["jquery"], t) :
		"undefined" != typeof module && module.exports ? module.exports = t(require(
			"jquery")) : t(jQuery)
}(function(t) {
	var e = -1,
		o = -1,
		a = function(t) {
			return parseFloat(t) || 0
		},
		i = function(e) {
			var o = 1,
				i = t(e),
				n = null,
				r = [];
			return i.each(function() {
				var e = t(this),
					i = e.offset().top - a(e.css("margin-top")),
					s = r.length > 0 ? r[r.length - 1] : null;
				null === s ? r.push(e) : Math.floor(Math.abs(n - i)) <= o ? r[r.length -
					1] = s.add(e) : r.push(e), n = i
			}), r
		},
		n = function(e) {
			var o = {
				byRow: !0,
				property: "height",
				target: null,
				remove: !1
			};
			return "object" == typeof e ? t.extend(o, e) : ("boolean" == typeof e ? o.byRow =
				e : "remove" === e && (o.remove = !0), o)
		},
		r = t.fn.matchHeight = function(e) {
			var o = n(e);
			if (o.remove) {
				var a = this;
				return this.css(o.property, ""), t.each(r._groups, function(t, e) {
					e.elements = e.elements.not(a)
				}), this
			}
			return this.length <= 1 && !o.target ? this : (r._groups.push({
				elements: this,
				options: o
			}), r._apply(this, o), this)
		};
	r.version = "master", r._groups = [], r._throttle = 80, r._maintainScroll = !
		1, r._beforeUpdate = null,
		r._afterUpdate = null, r._rows = i, r._parse = a, r._parseOptions = n, r._apply =
		function(e, o) {
			var s = n(o),
				h = t(e),
				l = [h],
				c = t(window).scrollTop(),
				p = t("html").outerHeight(!0),
				d = h.parents().filter(":hidden");
			return d.each(function() {
					var e = t(this);
					e.data("style-cache", e.attr("style"))
				}), d.css("display", "block"), s.byRow && !s.target && (h.each(function() {
					var e = t(this),
						o = e.css("display");
					"inline-block" !== o && "flex" !== o && "inline-flex" !== o && (o =
						"block"), e.data("style-cache", e.attr("style")), e.css({
						display: o,
						"padding-top": "0",
						"padding-bottom": "0",
						"margin-top": "0",
						"margin-bottom": "0",
						"border-top-width": "0",
						"border-bottom-width": "0",
						height: "100px",
						overflow: "hidden"
					})
				}), l = i(h), h.each(function() {
					var e = t(this);
					e.attr("style", e.data("style-cache") || "")
				})), t.each(l, function(e, o) {
					var i = t(o),
						n = 0;
					if (s.target) n = s.target.outerHeight(!1);
					else {
						if (s.byRow && i.length <= 1) return void i.css(s.property, "");
						i.each(function() {
							var e = t(this),
								o = e.attr("style"),
								a = e.css("display");
							"inline-block" !== a && "flex" !== a && "inline-flex" !== a && (a =
								"block");
							var i = {
								display: a
							};
							i[s.property] = "", e.css(i), e.outerHeight(!1) > n && (n = e.outerHeight(!
								1)), o ? e.attr("style", o) : e.css("display", "")
						})
					}
					i.each(function() {
						var e = t(this),
							o = 0;
						s.target && e.is(s.target) || ("border-box" !== e.css("box-sizing") &&
							(o += a(e.css("border-top-width")) + a(e.css("border-bottom-width")),
								o += a(e.css("padding-top")) + a(e.css("padding-bottom"))), e.css(
								s.property, n - o + "px"))
					})
				}), d.each(function() {
					var e = t(this);
					e.attr("style", e.data("style-cache") || null)
				}), r._maintainScroll && t(window).scrollTop(c / p * t("html").outerHeight(!
					0)),
				this
		}, r._applyDataApi = function() {
			var e = {};
			t("[data-match-height], [data-mh]").each(function() {
				var o = t(this),
					a = o.attr("data-mh") || o.attr("data-match-height");
				a in e ? e[a] = e[a].add(o) : e[a] = o
			}), t.each(e, function() {
				this.matchHeight(!0)
			})
		};
	var s = function(e) {
		r._beforeUpdate && r._beforeUpdate(e, r._groups), t.each(r._groups,
			function() {
				r._apply(this.elements, this.options)
			}), r._afterUpdate && r._afterUpdate(e, r._groups)
	};
	r._update = function(a, i) {
		if (i && "resize" === i.type) {
			var n = t(window).width();
			if (n === e) return;
			e = n;
		}
		a ? -1 === o && (o = setTimeout(function() {
			s(i), o = -1
		}, r._throttle)) : s(i)
	}, t(r._applyDataApi), t(window).bind("load", function(t) {
		r._update(!1, t)
	}), t(window).bind("resize orientationchange", function(t) {
		r._update(!0, t)
	})
});
! function(a, b, c, d) {
	function e(b, c) {
		this.settings = null, this.options = a.extend({}, e.Defaults, c), this.$element =
			a(b), this._handlers = {}, this._plugins = {}, this._supress = {}, this._current =
			null, this._speed = null, this._coordinates = [], this._breakpoint = null,
			this._width = null, this._items = [], this._clones = [], this._mergers = [],
			this._widths = [], this._invalidated = {}, this._pipe = [], this._drag = {
				time: null,
				target: null,
				pointer: null,
				stage: {
					start: null,
					current: null
				},
				direction: null
			}, this._states = {
				current: {},
				tags: {
					initializing: ["busy"],
					animating: ["busy"],
					dragging: ["interacting"]
				}
			}, a.each(["onResize", "onThrottledResize"], a.proxy(function(b, c) {
				this._handlers[c] = a.proxy(this[c], this)
			}, this)), a.each(e.Plugins, a.proxy(function(a, b) {
				this._plugins[a.charAt(0).toLowerCase() + a.slice(1)] = new b(this)
			}, this)), a.each(e.Workers, a.proxy(function(b, c) {
				this._pipe.push({
					filter: c.filter,
					run: a.proxy(c.run, this)
				})
			}, this)), this.setup(), this.initialize()
	}
	e.Defaults = {
		items: 3,
		loop: !1,
		center: !1,
		rewind: !1,
		mouseDrag: !0,
		touchDrag: !0,
		pullDrag: !0,
		freeDrag: !1,
		margin: 0,
		stagePadding: 0,
		merge: !1,
		mergeFit: !0,
		autoWidth: !1,
		startPosition: 0,
		rtl: !1,
		smartSpeed: 250,
		fluidSpeed: !1,
		dragEndSpeed: !1,
		responsive: {},
		responsiveRefreshRate: 200,
		responsiveBaseElement: b,
		fallbackEasing: "swing",
		info: !1,
		nestedItemSelector: !1,
		itemElement: "div",
		stageElement: "div",
		refreshClass: "owl-refresh",
		loadedClass: "owl-loaded",
		loadingClass: "owl-loading",
		rtlClass: "owl-rtl",
		responsiveClass: "owl-responsive",
		dragClass: "owl-drag",
		itemClass: "owl-item",
		stageClass: "owl-stage",
		stageOuterClass: "owl-stage-outer",
		grabClass: "owl-grab"
	}, e.Width = {
		Default: "default",
		Inner: "inner",
		Outer: "outer"
	}, e.Type = {
		Event: "event",
		State: "state"
	}, e.Plugins = {}, e.Workers = [{
		filter: ["width", "settings"],
		run: function() {
			this._width = this.$element.width()
		}
	}, {
		filter: ["width", "items", "settings"],
		run: function(a) {
			a.current = this._items && this._items[this.relative(this._current)]
		}
	}, {
		filter: ["items", "settings"],
		run: function() {
			this.$stage.children(".cloned").remove()
		}
	}, {
		filter: ["width", "items", "settings"],
		run: function(a) {
			var b = this.settings.margin || "",
				c = !this.settings.autoWidth,
				d = this.settings.rtl,
				e = {
					width: "auto",
					"margin-left": d ? b : "",
					"margin-right": d ? "" : b
				};
			!c && this.$stage.children().css(e), a.css = e
		}
	}, {
		filter: ["width", "items", "settings"],
		run: function(a) {
			var b = (this.width() / this.settings.items).toFixed(3) - this.settings.margin,
				c = null,
				d = this._items.length,
				e = !this.settings.autoWidth,
				f = [];
			for (a.items = {
					merge: !1,
					width: b
				}; d--;) c = this._mergers[d], c = this.settings.mergeFit && Math.min(c,
					this.settings.items) || c, a.items.merge = c > 1 || a.items.merge, f[d] =
				e ? b * c : this._items[d].width();
			this._widths = f
		}
	}, {
		filter: ["items", "settings"],
		run: function() {
			var b = [],
				c = this._items,
				d = this.settings,
				e = Math.max(2 * d.items, 4),
				f = 2 * Math.ceil(c.length / 2),
				g = d.loop && c.length ? d.rewind ? e : Math.max(e, f) : 0,
				h = "",
				i = "";
			for (g /= 2; g--;) b.push(this.normalize(b.length / 2, !0)), h += c[b[b.length -
				1]][0].outerHTML, b.push(this.normalize(c.length - 1 - (b.length - 1) /
				2, !0)), i = c[b[b.length - 1]][0].outerHTML + i;
			this._clones = b, a(h).addClass("cloned").appendTo(this.$stage), a(i).addClass(
				"cloned").prependTo(this.$stage)
		}
	}, {
		filter: ["width", "items", "settings"],
		run: function() {
			for (var a = this.settings.rtl ? 1 : -1, b = this._clones.length + this._items
					.length, c = -1, d = 0, e = 0, f = []; ++c < b;) d = f[c - 1] || 0, e =
				this._widths[this.relative(c)] + this.settings.margin, f.push(d + e * a);
			this._coordinates = f
		}
	}, {
		filter: ["width", "items", "settings"],
		run: function() {
			var a = this.settings.stagePadding,
				b = this._coordinates,
				c = {
					width: Math.ceil(Math.abs(b[b.length - 1])) + 2 * a,
					"padding-left": a || "",
					"padding-right": a || ""
				};
			this.$stage.css(c)
		}
	}, {
		filter: ["width", "items", "settings"],
		run: function(a) {
			var b = this._coordinates.length,
				c = !this.settings.autoWidth,
				d = this.$stage.children();
			if (c && a.items.merge)
				for (; b--;) a.css.width = this._widths[this.relative(b)], d.eq(b).css(a
					.css);
			else c && (a.css.width = a.items.width, d.css(a.css))
		}
	}, {
		filter: ["items"],
		run: function() {
			this._coordinates.length < 1 && this.$stage.removeAttr("style")
		}
	}, {
		filter: ["width", "items", "settings"],
		run: function(a) {
			a.current = a.current ? this.$stage.children().index(a.current) : 0, a.current =
				Math.max(this.minimum(), Math.min(this.maximum(), a.current)), this.reset(
					a.current)
		}
	}, {
		filter: ["position"],
		run: function() {
			this.animate(this.coordinates(this._current))
		}
	}, {
		filter: ["width", "position", "items", "settings"],
		run: function() {
			var a, b, c, d, e = this.settings.rtl ? 1 : -1,
				f = 2 * this.settings.stagePadding,
				g = this.coordinates(this.current()) + f,
				h = g + this.width() * e,
				i = [];
			for (c = 0, d = this._coordinates.length; d > c; c++) a = this._coordinates[
				c - 1] || 0, b = Math.abs(this._coordinates[c]) + f * e, (this.op(a,
				"<=", g) && this.op(a, ">", h) || this.op(b, "<", g) && this.op(b, ">",
				h)) && i.push(c);
			this.$stage.children(".active").removeClass("active"), this.$stage.children(
					":eq(" + i.join("), :eq(") + ")").addClass("active"), this.settings.center &&
				(this.$stage.children(".center").removeClass("center"), this.$stage.children()
					.eq(this.current()).addClass("center"))
		}
	}], e.prototype.initialize = function() {
		if (this.enter("initializing"), this.trigger("initialize"), this.$element.toggleClass(
				this.settings.rtlClass, this.settings.rtl), this.settings.autoWidth && !
			this.is("pre-loading")) {
			var b, c, e;
			b = this.$element.find("img"), c = this.settings.nestedItemSelector ? "." +
				this.settings.nestedItemSelector : d, e = this.$element.children(c).width(),
				b.length && 0 >= e && this.preloadAutoWidthImages(b)
		}
		this.$element.addClass(this.options.loadingClass), this.$stage = a("<" +
				this.settings.stageElement + ' class="' + this.settings.stageClass + '"/>'
			).wrap('<div class="' + this.settings.stageOuterClass + '"/>'), this.$element
			.append(this.$stage.parent()), this.replace(this.$element.children().not(
				this.$stage.parent())), this.$element.is(":visible") ? this.refresh() :
			this.invalidate("width"), this.$element.removeClass(this.options.loadingClass)
			.addClass(this.options.loadedClass), this.registerEventHandlers(), this.leave(
				"initializing"), this.trigger("initialized")
	}, e.prototype.setup = function() {
		var b = this.viewport(),
			c = this.options.responsive,
			d = -1,
			e = null;
		c ? (a.each(c, function(a) {
					b >= a && a > d && (d = Number(a))
				}), e = a.extend({}, this.options, c[d]), delete e.responsive, e.responsiveClass &&
				this.$element.attr("class", this.$element.attr("class").replace(new RegExp(
					"(" + this.options.responsiveClass + "-)\\S+\\s", "g"), "$1" + d))) : e =
			a.extend({}, this.options), (null === this.settings || this._breakpoint !==
				d) && (this.trigger("change", {
					property: {
						name: "settings",
						value: e
					}
				}), this._breakpoint = d, this.settings = e, this.invalidate("settings"),
				this.trigger("changed", {
					property: {
						name: "settings",
						value: this.settings
					}
				}))
	}, e.prototype.optionsLogic = function() {
		this.settings.autoWidth && (this.settings.stagePadding = !1, this.settings.merge = !
			1)
	}, e.prototype.prepare = function(b) {
		var c = this.trigger("prepare", {
			content: b
		});
		return c.data || (c.data = a("<" + this.settings.itemElement + "/>").addClass(
			this.options.itemClass).append(b)), this.trigger("prepared", {
			content: c.data
		}), c.data
	}, e.prototype.update = function() {
		for (var b = 0, c = this._pipe.length, d = a.proxy(function(a) {
				return this[a]
			}, this._invalidated), e = {}; c > b;)(this._invalidated.all || a.grep(this
			._pipe[b].filter, d).length > 0) && this._pipe[b].run(e), b++;
		this._invalidated = {}, !this.is("valid") && this.enter("valid")
	}, e.prototype.width = function(a) {
		switch (a = a || e.Width.Default) {
			case e.Width.Inner:
			case e.Width.Outer:
				return this._width;
			default:
				return this._width - 2 * this.settings.stagePadding + this.settings.margin
		}
	}, e.prototype.refresh = function() {
		this.enter("refreshing"), this.trigger("refresh"), this.setup(), this.optionsLogic(),
			this.$element.addClass(this.options.refreshClass), this.update(), this.$element
			.removeClass(this.options.refreshClass), this.leave("refreshing"), this.trigger(
				"refreshed")
	}, e.prototype.onThrottledResize = function() {
		b.clearTimeout(this.resizeTimer), this.resizeTimer = b.setTimeout(this._handlers
			.onResize, this.settings.responsiveRefreshRate)
	}, e.prototype.onResize = function() {
		return this._items.length ? this._width === this.$element.width() ? !1 :
			this.$element.is(":visible") ? (this.enter("resizing"), this.trigger(
				"resize").isDefaultPrevented() ? (this.leave("resizing"), !1) : (this.invalidate(
				"width"), this.refresh(), this.leave("resizing"), void this.trigger(
				"resized"))) : !1 : !1
	}, e.prototype.registerEventHandlers = function() {
		a.support.transition && this.$stage.on(a.support.transition.end +
				".owl.core", a.proxy(this.onTransitionEnd, this)), this.settings.responsive !==
			!1 && this.on(b, "resize", this._handlers.onThrottledResize), this.settings
			.mouseDrag && (this.$element.addClass(this.options.dragClass), this.$stage.on(
				"mousedown.owl.core", a.proxy(this.onDragStart, this)), this.$stage.on(
				"dragstart.owl.core selectstart.owl.core",
				function() {
					return !1
				})), this.settings.touchDrag && (this.$stage.on("touchstart.owl.core", a.proxy(
				this.onDragStart, this)), this.$stage.on("touchcancel.owl.core", a.proxy(
				this.onDragEnd, this)))
	}, e.prototype.onDragStart = function(b) {
		var d = null;
		3 !== b.which && (a.support.transform ? (d = this.$stage.css("transform").replace(
				/.*\(|\)| /g, "").split(","), d = {
				x: d[16 === d.length ? 12 : 4],
				y: d[16 === d.length ? 13 : 5]
			}) : (d = this.$stage.position(), d = {
				x: this.settings.rtl ? d.left + this.$stage.width() - this.width() +
					this.settings.margin : d.left,
				y: d.top
			}), this.is("animating") && (a.support.transform ? this.animate(d.x) :
				this.$stage.stop(), this.invalidate("position")), this.$element.toggleClass(
				this.options.grabClass, "mousedown" === b.type), this.speed(0), this._drag
			.time = (new Date).getTime(), this._drag.target = a(b.target), this._drag.stage
			.start = d, this._drag.stage.current = d, this._drag.pointer = this.pointer(
				b), a(c).on("mouseup.owl.core touchend.owl.core", a.proxy(this.onDragEnd,
				this)), a(c).one("mousemove.owl.core touchmove.owl.core", a.proxy(
				function(b) {
					var d = this.difference(this._drag.pointer, this.pointer(b));
					a(c).on("mousemove.owl.core touchmove.owl.core", a.proxy(this.onDragMove,
						this)), Math.abs(d.x) < Math.abs(d.y) && this.is("valid") || (b.preventDefault(),
						this.enter("dragging"), this.trigger("drag"))
				}, this)))
	}, e.prototype.onDragMove = function(a) {
		var b = null,
			c = null,
			d = null,
			e = this.difference(this._drag.pointer, this.pointer(a)),
			f = this.difference(this._drag.stage.start, e);
		this.is("dragging") && (a.preventDefault(), this.settings.loop ? (b = this.coordinates(
				this.minimum()), c = this.coordinates(this.maximum() + 1) - b, f.x = ((f
				.x - b) % c + c) % c + b) : (b = this.coordinates(this.settings.rtl ?
					this.maximum() : this.minimum()), c = this.coordinates(this.settings.rtl ?
					this.minimum() : this.maximum()), d = this.settings.pullDrag ? -1 * e.x /
				5 : 0, f.x = Math.max(Math.min(f.x, b + d), c + d)), this._drag.stage.current =
			f, this.animate(f.x))
	}, e.prototype.onDragEnd = function(b) {
		var d = this.difference(this._drag.pointer, this.pointer(b)),
			e = this._drag.stage.current,
			f = d.x > 0 ^ this.settings.rtl ? "left" : "right";
		a(c).off(".owl.core"), this.$element.removeClass(this.options.grabClass), (0 !==
			d.x && this.is("dragging") || !this.is("valid")) && (this.speed(this.settings
				.dragEndSpeed || this.settings.smartSpeed), this.current(this.closest(e.x,
				0 !== d.x ? f : this._drag.direction)), this.invalidate("position"), this
			.update(), this._drag.direction = f, (Math.abs(d.x) > 3 || (new Date).getTime() -
				this._drag.time > 300) && this._drag.target.one("click.owl.core",
				function() {
					return !1
				})), this.is("dragging") && (this.leave("dragging"), this.trigger(
			"dragged"))
	}, e.prototype.closest = function(b, c) {
		var d = -1,
			e = 30,
			f = this.width(),
			g = this.coordinates();
		return this.settings.freeDrag || a.each(g, a.proxy(function(a, h) {
			return b > h - e && h + e > b ? d = a : this.op(b, "<", h) && this.op(b,
				">", g[a + 1] || h - f) && (d = "left" === c ? a + 1 : a), -1 === d
		}, this)), this.settings.loop || (this.op(b, ">", g[this.minimum()]) ? d =
			b = this.minimum() : this.op(b, "<", g[this.maximum()]) && (d = b = this.maximum())
		), d
	}, e.prototype.animate = function(b) {
		var c = this.speed() > 0;
		this.is("animating") && this.onTransitionEnd(), c && (this.enter("animating"),
				this.trigger("translate")), a.support.transform3d && a.support.transition ?
			this.$stage.css({
				transform: "translate3d(" + b + "px,0px,0px)",
				transition: this.speed() / 1e3 + "s"
			}) : c ? this.$stage.animate({
				left: b + "px"
			}, this.speed(), this.settings.fallbackEasing, a.proxy(this.onTransitionEnd,
				this)) : this.$stage.css({
				left: b + "px"
			})
	}, e.prototype.is = function(a) {
		return this._states.current[a] && this._states.current[a] > 0
	}, e.prototype.current = function(a) {
		if (a === d) return this._current;
		if (0 === this._items.length) return d;
		if (a = this.normalize(a), this._current !== a) {
			var b = this.trigger("change", {
				property: {
					name: "position",
					value: a
				}
			});
			b.data !== d && (a = this.normalize(b.data)), this._current = a, this.invalidate(
				"position"), this.trigger("changed", {
				property: {
					name: "position",
					value: this._current
				}
			})
		}
		return this._current
	}, e.prototype.invalidate = function(b) {
		return "string" === a.type(b) && (this._invalidated[b] = !0, this.is("valid") &&
			this.leave("valid")), a.map(this._invalidated, function(a, b) {
			return b
		})
	}, e.prototype.reset = function(a) {
		a = this.normalize(a), a !== d && (this._speed = 0, this._current = a, this.suppress(
			["translate", "translated"]), this.animate(this.coordinates(a)), this.release(
			["translate", "translated"]))
	}, e.prototype.normalize = function(b, c) {
		var e = this._items.length,
			f = c ? 0 : this._clones.length;
		return !a.isNumeric(b) || 1 > e ? b = d : (0 > b || b >= e + f) && (b = ((b -
			f / 2) % e + e) % e + f / 2), b
	}, e.prototype.relative = function(a) {
		return a -= this._clones.length / 2, this.normalize(a, !0)
	}, e.prototype.maximum = function(a) {
		var b, c = this.settings,
			d = this._coordinates.length,
			e = Math.abs(this._coordinates[d - 1]) - this._width,
			f = -1;
		if (c.loop) d = this._clones.length / 2 + this._items.length - 1;
		else if (c.autoWidth || c.merge)
			for (; d - f > 1;) Math.abs(this._coordinates[b = d + f >> 1]) < e ? f = b :
				d = b;
		else d = c.center ? this._items.length - 1 : this._items.length - c.items;
		return a && (d -= this._clones.length / 2), Math.max(d, 0)
	}, e.prototype.minimum = function(a) {
		return a ? 0 : this._clones.length / 2
	}, e.prototype.items = function(a) {
		return a === d ? this._items.slice() : (a = this.normalize(a, !0), this._items[
			a])
	}, e.prototype.mergers = function(a) {
		return a === d ? this._mergers.slice() : (a = this.normalize(a, !0), this._mergers[
			a])
	}, e.prototype.clones = function(b) {
		var c = this._clones.length / 2,
			e = c + this._items.length,
			f = function(a) {
				return a % 2 === 0 ? e + a / 2 : c - (a + 1) / 2
			};
		return b === d ? a.map(this._clones, function(a, b) {
			return f(b)
		}) : a.map(this._clones, function(a, c) {
			return a === b ? f(c) : null
		})
	}, e.prototype.speed = function(a) {
		return a !== d && (this._speed = a), this._speed
	}, e.prototype.coordinates = function(b) {
		var c = null;
		return b === d ? a.map(this._coordinates, a.proxy(function(a, b) {
			return this.coordinates(b)
		}, this)) : (this.settings.center ? (c = this._coordinates[b], c += (this.width() -
				c + (this._coordinates[b - 1] || 0)) / 2 * (this.settings.rtl ? -1 : 1)) :
			c = this._coordinates[b - 1] || 0, c)
	}, e.prototype.duration = function(a, b, c) {
		return Math.min(Math.max(Math.abs(b - a), 1), 6) * Math.abs(c || this.settings
			.smartSpeed)
	}, e.prototype.to = function(a, b) {
		var c = this.current(),
			d = null,
			e = a - this.relative(c),
			f = (e > 0) - (0 > e),
			g = this._items.length,
			h = this.minimum(),
			i = this.maximum();
		this.settings.loop ? (!this.settings.rewind && Math.abs(e) > g / 2 && (e +=
					-1 * f * g), a = c + e, d = ((a - h) % g + g) % g + h, d !== a && i >= d -
				e && d - e > 0 && (c = d - e, a = d, this.reset(c))) : this.settings.rewind ?
			(i += 1, a = (a % i + i) % i) : a = Math.max(h, Math.min(i, a)), this.speed(
				this.duration(c, a, b)), this.current(a), this.$element.is(":visible") &&
			this.update()
	}, e.prototype.next = function(a) {
		a = a || !1, this.to(this.relative(this.current()) + 1, a)
	}, e.prototype.prev = function(a) {
		a = a || !1, this.to(this.relative(this.current()) - 1, a)
	}, e.prototype.onTransitionEnd = function(a) {
		return a !== d && (a.stopPropagation(), (a.target || a.srcElement || a.originalTarget) !==
			this.$stage.get(0)) ? !1 : (this.leave("animating"), void this.trigger(
			"translated"))
	}, e.prototype.viewport = function() {
		var d;
		if (this.options.responsiveBaseElement !== b) d = a(this.options.responsiveBaseElement)
			.width();
		else if (b.innerWidth) d = b.innerWidth;
		else {
			if (!c.documentElement || !c.documentElement.clientWidth) throw "Can not detect viewport width.";
			d = c.documentElement.clientWidth
		}
		return d
	}, e.prototype.replace = function(b) {
		this.$stage.empty(), this._items = [], b && (b = b instanceof jQuery ? b : a(
				b)), this.settings.nestedItemSelector && (b = b.find("." + this.settings.nestedItemSelector)),
			b.filter(function() {
				return 1 === this.nodeType
			}).each(a.proxy(function(a, b) {
				b = this.prepare(b), this.$stage.append(b), this._items.push(b), this._mergers
					.push(1 * b.find("[data-merge]").andSelf("[data-merge]").attr(
						"data-merge") || 1)
			}, this)), this.reset(a.isNumeric(this.settings.startPosition) ? this.settings
				.startPosition : 0), this.invalidate("items")
	}, e.prototype.add = function(b, c) {
		var e = this.relative(this._current);
		c = c === d ? this._items.length : this.normalize(c, !0), b = b instanceof jQuery ?
			b : a(b), this.trigger("add", {
				content: b,
				position: c
			}), b = this.prepare(b), 0 === this._items.length || c === this._items.length ?
			(0 === this._items.length && this.$stage.append(b), 0 !== this._items.length &&
				this._items[c - 1].after(b), this._items.push(b), this._mergers.push(1 * b
					.find("[data-merge]").andSelf("[data-merge]").attr("data-merge") || 1)) :
			(this._items[c].before(b), this._items.splice(c, 0, b), this._mergers.splice(
				c, 0, 1 * b.find("[data-merge]").andSelf("[data-merge]").attr(
					"data-merge") || 1)), this._items[e] && this.reset(this._items[e].index()),
			this.invalidate("items"), this.trigger("added", {
				content: b,
				position: c
			})
	}, e.prototype.remove = function(a) {
		a = this.normalize(a, !0), a !== d && (this.trigger("remove", {
			content: this._items[a],
			position: a
		}), this._items[a].remove(), this._items.splice(a, 1), this._mergers.splice(
			a, 1), this.invalidate("items"), this.trigger("removed", {
			content: null,
			position: a
		}))
	}, e.prototype.preloadAutoWidthImages = function(b) {
		b.each(a.proxy(function(b, c) {
			this.enter("pre-loading"), c = a(c), a(new Image).one("load", a.proxy(
				function(a) {
					c.attr("src", a.target.src), c.css("opacity", 1), this.leave(
							"pre-loading"), !this.is("pre-loading") && !this.is("initializing") &&
						this.refresh()
				}, this)).attr("src", c.attr("src") || c.attr("data-src") || c.attr(
				"data-src-retina"))
		}, this))
	}, e.prototype.destroy = function() {
		this.$element.off(".owl.core"), this.$stage.off(".owl.core"), a(c).off(
			".owl.core"), this.settings.responsive !== !1 && (b.clearTimeout(this.resizeTimer),
			this.off(b, "resize", this._handlers.onThrottledResize));
		for (var d in this._plugins) this._plugins[d].destroy();
		this.$stage.children(".cloned").remove(), this.$stage.unwrap(), this.$stage.children()
			.contents().unwrap(), this.$stage.children().unwrap(), this.$element.removeClass(
				this.options.refreshClass).removeClass(this.options.loadingClass).removeClass(
				this.options.loadedClass).removeClass(this.options.rtlClass).removeClass(
				this.options.dragClass).removeClass(this.options.grabClass).attr("class",
				this.$element.attr("class").replace(new RegExp(this.options.responsiveClass +
					"-\\S+\\s", "g"), "")).removeData("owl.carousel")
	}, e.prototype.op = function(a, b, c) {
		var d = this.settings.rtl;
		switch (b) {
			case "<":
				return d ? a > c : c > a;
			case ">":
				return d ? c > a : a > c;
			case ">=":
				return d ? c >= a : a >= c;
			case "<=":
				return d ? a >= c : c >= a
		}
	}, e.prototype.on = function(a, b, c, d) {
		a.addEventListener ? a.addEventListener(b, c, d) : a.attachEvent && a.attachEvent(
			"on" + b, c)
	}, e.prototype.off = function(a, b, c, d) {
		a.removeEventListener ? a.removeEventListener(b, c, d) : a.detachEvent && a.detachEvent(
			"on" + b, c)
	}, e.prototype.trigger = function(b, c, d, f, g) {
		var h = {
				item: {
					count: this._items.length,
					index: this.current()
				}
			},
			i = a.camelCase(a.grep(["on", b, d], function(a) {
				return a
			}).join("-").toLowerCase()),
			j = a.Event([b, "owl", d || "carousel"].join(".").toLowerCase(), a.extend({
				relatedTarget: this
			}, h, c));
		return this._supress[b] || (a.each(this._plugins, function(a, b) {
			b.onTrigger && b.onTrigger(j)
		}), this.register({
			type: e.Type.Event,
			name: b
		}), this.$element.trigger(j), this.settings && "function" == typeof this.settings[
			i] && this.settings[i].call(this, j)), j
	}, e.prototype.enter = function(b) {
		a.each([b].concat(this._states.tags[b] || []), a.proxy(function(a, b) {
			this._states.current[b] === d && (this._states.current[b] = 0), this._states
				.current[b]++
		}, this))
	}, e.prototype.leave = function(b) {
		a.each([b].concat(this._states.tags[b] || []), a.proxy(function(a, b) {
			this._states.current[b]--
		}, this))
	}, e.prototype.register = function(b) {
		if (b.type === e.Type.Event) {
			if (a.event.special[b.name] || (a.event.special[b.name] = {}), !a.event.special[
					b.name].owl) {
				var c = a.event.special[b.name]._default;
				a.event.special[b.name]._default = function(a) {
					return !c || !c.apply || a.namespace && -1 !== a.namespace.indexOf("owl") ?
						a.namespace && a.namespace.indexOf("owl") > -1 : c.apply(this,
							arguments)
				}, a.event.special[b.name].owl = !0
			}
		} else b.type === e.Type.State && (this._states.tags[b.name] ? this._states.tags[
				b.name] = this._states.tags[b.name].concat(b.tags) : this._states.tags[b.name] =
			b.tags, this._states.tags[b.name] = a.grep(this._states.tags[b.name], a.proxy(
				function(c, d) {
					return a.inArray(c, this._states.tags[b.name]) === d
				}, this)))
	}, e.prototype.suppress = function(b) {
		a.each(b, a.proxy(function(a, b) {
			this._supress[b] = !0
		}, this))
	}, e.prototype.release = function(b) {
		a.each(b, a.proxy(function(a, b) {
			delete this._supress[b]
		}, this))
	}, e.prototype.pointer = function(a) {
		var c = {
			x: null,
			y: null
		};
		return a = a.originalEvent || a || b.event, a = a.touches && a.touches.length ?
			a.touches[0] : a.changedTouches && a.changedTouches.length ? a.changedTouches[
				0] : a, a.pageX ? (c.x = a.pageX, c.y = a.pageY) : (c.x = a.clientX, c.y =
				a.clientY), c
	}, e.prototype.difference = function(a, b) {
		return {
			x: a.x - b.x,
			y: a.y - b.y
		}
	}, a.fn.owlCarousel = function(b) {
		var c = Array.prototype.slice.call(arguments, 1);
		return this.each(function() {
			var d = a(this),
				f = d.data("owl.carousel");
			f || (f = new e(this, "object" == typeof b && b), d.data("owl.carousel",
				f), a.each(["next", "prev", "to", "destroy", "refresh", "replace",
				"add", "remove"
			], function(b, c) {
				f.register({
					type: e.Type.Event,
					name: c
				}), f.$element.on(c + ".owl.carousel.core", a.proxy(function(a) {
					a.namespace && a.relatedTarget !== this && (this.suppress([c]), f[
						c].apply(this, [].slice.call(arguments, 1)), this.release([c]))
				}, f))
			})), "string" == typeof b && "_" !== b.charAt(0) && f[b].apply(f, c)
		})
	}, a.fn.owlCarousel.Constructor = e
}(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) {
	var e = function(b) {
		this._core = b, this._interval = null, this._visible = null, this._handlers = {
				"initialized.owl.carousel": a.proxy(function(a) {
					a.namespace && this._core.settings.autoRefresh && this.watch()
				}, this)
			}, this._core.options = a.extend({}, e.Defaults, this._core.options), this._core
			.$element.on(this._handlers)
	};
	e.Defaults = {
		autoRefresh: !0,
		autoRefreshInterval: 500
	}, e.prototype.watch = function() {
		this._interval || (this._visible = this._core.$element.is(":visible"), this._interval =
			b.setInterval(a.proxy(this.refresh, this), this._core.settings.autoRefreshInterval)
		)
	}, e.prototype.refresh = function() {
		this._core.$element.is(":visible") !== this._visible && (this._visible = !
			this._visible, this._core.$element.toggleClass("owl-hidden", !this._visible),
			this._visible && this._core.invalidate("width") && this._core.refresh())
	}, e.prototype.destroy = function() {
		var a, c;
		b.clearInterval(this._interval);
		for (a in this._handlers) this._core.$element.off(a, this._handlers[a]);
		for (c in Object.getOwnPropertyNames(this)) "function" != typeof this[c] &&
			(this[c] = null)
	}, a.fn.owlCarousel.Constructor.Plugins.AutoRefresh = e
}(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) {
	var e = function(b) {
		this._core = b, this._loaded = [], this._handlers = {
				"initialized.owl.carousel change.owl.carousel": a.proxy(function(b) {
					if (b.namespace && this._core.settings && this._core.settings.lazyLoad &&
						(b.property && "position" == b.property.name || "initialized" == b.type)
					)
						for (var c = this._core.settings, d = c.center && Math.ceil(c.items /
									2) || c.items, e = c.center && -1 * d || 0, f = (b.property && b.property
									.value || this._core.current()) + e, g = this._core.clones().length,
								h = a.proxy(function(a, b) {
									this.load(b)
								}, this); e++ < d;) this.load(g / 2 + this._core.relative(f)), g &&
							a.each(this._core.clones(this._core.relative(f)), h), f++
				}, this)
			}, this._core.options = a.extend({}, e.Defaults, this._core.options), this._core
			.$element.on(this._handlers)
	};
	e.Defaults = {
		lazyLoad: !1
	}, e.prototype.load = function(c) {
		var d = this._core.$stage.children().eq(c),
			e = d && d.find(".owl-lazy");
		!e || a.inArray(d.get(0), this._loaded) > -1 || (e.each(a.proxy(function(c,
			d) {
			var e, f = a(d),
				g = b.devicePixelRatio > 1 && f.attr("data-src-retina") || f.attr(
					"data-src");
			this._core.trigger("load", {
				element: f,
				url: g
			}, "lazy"), f.is("img") ? f.one("load.owl.lazy", a.proxy(function() {
				f.css("opacity", 1), this._core.trigger("loaded", {
					element: f,
					url: g
				}, "lazy")
			}, this)).attr("src", g) : (e = new Image, e.onload = a.proxy(function() {
				f.css({
					"background-image": "url(" + g + ")",
					opacity: "1"
				}), this._core.trigger("loaded", {
					element: f,
					url: g
				}, "lazy")
			}, this), e.src = g)
		}, this)), this._loaded.push(d.get(0)))
	}, e.prototype.destroy = function() {
		var a, b;
		for (a in this.handlers) this._core.$element.off(a, this.handlers[a]);
		for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] &&
			(this[b] = null)
	}, a.fn.owlCarousel.Constructor.Plugins.Lazy = e
}(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) {
	var e = function(b) {
		this._core = b, this._handlers = {
				"initialized.owl.carousel refreshed.owl.carousel": a.proxy(function(a) {
					a.namespace && this._core.settings.autoHeight && this.update()
				}, this),
				"changed.owl.carousel": a.proxy(function(a) {
					a.namespace && this._core.settings.autoHeight && "position" == a.property
						.name && this.update()
				}, this),
				"loaded.owl.lazy": a.proxy(function(a) {
					a.namespace && this._core.settings.autoHeight && a.element.closest("." +
							this._core.settings.itemClass).index() === this._core.current() &&
						this.update()
				}, this)
			}, this._core.options = a.extend({}, e.Defaults, this._core.options), this._core
			.$element.on(this._handlers)
	};
	e.Defaults = {
		autoHeight: !1,
		autoHeightClass: "owl-height"
	}, e.prototype.update = function() {
		var b = this._core._current,
			c = b + this._core.settings.items,
			d = this._core.$stage.children().toArray().slice(b, c);
		heights = [], maxheight = 0, a.each(d, function(b, c) {
			heights.push(a(c).height())
		}), maxheight = Math.max.apply(null, heights), this._core.$stage.parent().height(
			maxheight).addClass(this._core.settings.autoHeightClass)
	}, e.prototype.destroy = function() {
		var a, b;
		for (a in this._handlers) this._core.$element.off(a, this._handlers[a]);
		for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] &&
			(this[b] = null)
	}, a.fn.owlCarousel.Constructor.Plugins.AutoHeight = e
}(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) {
	var e = function(b) {
		this._core = b, this._videos = {}, this._playing = null, this._handlers = {
				"initialized.owl.carousel": a.proxy(function(a) {
					a.namespace && this._core.register({
						type: "state",
						name: "playing",
						tags: ["interacting"]
					})
				}, this),
				"resize.owl.carousel": a.proxy(function(a) {
					a.namespace && this._core.settings.video && this.isInFullScreen() && a.preventDefault()
				}, this),
				"refreshed.owl.carousel": a.proxy(function(a) {
					a.namespace && this._core.is("resizing") && this._core.$stage.find(
						".cloned .owl-video-frame").remove()
				}, this),
				"changed.owl.carousel": a.proxy(function(a) {
					a.namespace && "position" === a.property.name && this._playing && this.stop()
				}, this),
				"prepared.owl.carousel": a.proxy(function(b) {
					if (b.namespace) {
						var c = a(b.content).find(".owl-video");
						c.length && (c.css("display", "none"), this.fetch(c, a(b.content)))
					}
				}, this)
			}, this._core.options = a.extend({}, e.Defaults, this._core.options), this._core
			.$element.on(this._handlers), this._core.$element.on("click.owl.video",
				".owl-video-play-icon", a.proxy(function(a) {
					this.play(a)
				}, this))
	};
	e.Defaults = {
		video: !1,
		videoHeight: !1,
		videoWidth: !1
	}, e.prototype.fetch = function(a, b) {
		var c = a.attr("data-vimeo-id") ? "vimeo" : "youtube",
			d = a.attr("data-vimeo-id") || a.attr("data-youtube-id"),
			e = a.attr("data-width") || this._core.settings.videoWidth,
			f = a.attr("data-height") || this._core.settings.videoHeight,
			g = a.attr("href");
		if (!g) throw new Error("Missing video URL.");
		if (d = g.match(
				/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/
			), d[3].indexOf("youtu") > -1) c = "youtube";
		else {
			if (!(d[3].indexOf("vimeo") > -1)) throw new Error(
				"Video URL not supported.");
			c = "vimeo"
		}
		d = d[6], this._videos[g] = {
			type: c,
			id: d,
			width: e,
			height: f
		}, b.attr("data-video", g), this.thumbnail(a, this._videos[g])
	}, e.prototype.thumbnail = function(b, c) {
		var d, e, f, g = c.width && c.height ? 'style="width:' + c.width +
			"px;height:" + c.height + 'px;"' : "",
			h = b.find("img"),
			i = "src",
			j = "",
			k = this._core.settings,
			l = function(a) {
				e = '<div class="owl-video-play-icon"></div>', d = k.lazyLoad ?
					'<div class="owl-video-tn ' + j + '" ' + i + '="' + a + '"></div>' :
					'<div class="owl-video-tn" style="opacity:1;background-image:url(' + a +
					')"></div>', b.after(d), b.after(e)
			};
		return b.wrap('<div class="owl-video-wrapper"' + g + "></div>"), this._core.settings
			.lazyLoad && (i = "data-src", j = "owl-lazy"), h.length ? (l(h.attr(i)), h.remove(), !
				1) : void("youtube" === c.type ? (f = "http://img.youtube.com/vi/" + c.id +
				"/hqdefault.jpg", l(f)) : "vimeo" === c.type && a.ajax({
				type: "GET",
				url: "http://vimeo.com/api/v2/video/" + c.id + ".json",
				jsonp: "callback",
				dataType: "jsonp",
				success: function(a) {
					f = a[0].thumbnail_large, l(f)
				}
			}))
	}, e.prototype.stop = function() {
		this._core.trigger("stop", null, "video"), this._playing.find(
				".owl-video-frame").remove(), this._playing.removeClass(
				"owl-video-playing"), this._playing = null, this._core.leave("playing"),
			this._core.trigger("stopped", null, "video")
	}, e.prototype.play = function(b) {
		var c, d = a(b.target),
			e = d.closest("." + this._core.settings.itemClass),
			f = this._videos[e.attr("data-video")],
			g = f.width || "100%",
			h = f.height || this._core.$stage.height();
		this._playing || (this._core.enter("playing"), this._core.trigger("play",
				null, "video"), e = this._core.items(this._core.relative(e.index())),
			this._core.reset(e.index()), "youtube" === f.type ? c = '<iframe width="' +
			g + '" height="' + h + '" src="http://www.youtube.com/embed/' + f.id +
			"?autoplay=1&v=" + f.id + '" frameborder="0" allowfullscreen></iframe>' :
			"vimeo" === f.type && (c = '<iframe src="http://player.vimeo.com/video/' +
				f.id + '?autoplay=1" width="' + g + '" height="' + h +
				'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>'
			), a('<div class="owl-video-frame">' + c + "</div>").insertAfter(e.find(
				".owl-video")), this._playing = e.addClass("owl-video-playing"))
	}, e.prototype.isInFullScreen = function() {
		var b = c.fullscreenElement || c.mozFullScreenElement || c.webkitFullscreenElement;
		return b && a(b).parent().hasClass("owl-video-frame")
	}, e.prototype.destroy = function() {
		var a, b;
		this._core.$element.off("click.owl.video");
		for (a in this._handlers) this._core.$element.off(a, this._handlers[a]);
		for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] &&
			(this[b] = null)
	}, a.fn.owlCarousel.Constructor.Plugins.Video = e
}(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) {
	var e = function(b) {
		this.core = b, this.core.options = a.extend({}, e.Defaults, this.core.options),
			this.swapping = !0, this.previous = d, this.next = d, this.handlers = {
				"change.owl.carousel": a.proxy(function(a) {
					a.namespace && "position" == a.property.name && (this.previous = this.core
						.current(), this.next = a.property.value)
				}, this),
				"drag.owl.carousel dragged.owl.carousel translated.owl.carousel": a.proxy(
					function(a) {
						a.namespace && (this.swapping = "translated" == a.type)
					}, this),
				"translate.owl.carousel": a.proxy(function(a) {
					a.namespace && this.swapping && (this.core.options.animateOut || this.core
						.options.animateIn) && this.swap()
				}, this)
			}, this.core.$element.on(this.handlers)
	};
	e.Defaults = {
		animateOut: !1,
		animateIn: !1
	}, e.prototype.swap = function() {
		if (1 === this.core.settings.items && a.support.animation && a.support.transition) {
			this.core.speed(0);
			var b, c = a.proxy(this.clear, this),
				d = this.core.$stage.children().eq(this.previous),
				e = this.core.$stage.children().eq(this.next),
				f = this.core.settings.animateIn,
				g = this.core.settings.animateOut;
			this.core.current() !== this.previous && (g && (b = this.core.coordinates(
				this.previous) - this.core.coordinates(this.next), d.one(a.support.animation
				.end, c).css({
				left: b + "px"
			}).addClass("animated owl-animated-out").addClass(g)), f && e.one(a.support
				.animation.end, c).addClass("animated owl-animated-in").addClass(f))
		}
	}, e.prototype.clear = function(b) {
		a(b.target).css({
				left: ""
			}).removeClass("animated owl-animated-out owl-animated-in").removeClass(
				this.core.settings.animateIn).removeClass(this.core.settings.animateOut),
			this.core.onTransitionEnd()
	}, e.prototype.destroy = function() {
		var a, b;
		for (a in this.handlers) this.core.$element.off(a, this.handlers[a]);
		for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] &&
			(this[b] = null)
	}, a.fn.owlCarousel.Constructor.Plugins.Animate = e
}(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) {
	var e = function(b) {
		this._core = b, this._interval = null, this._paused = !1, this._handlers = {
			"changed.owl.carousel": a.proxy(function(a) {
				a.namespace && "settings" === a.property.name && (this._core.settings.autoplay ?
					this.play() : this.stop())
			}, this),
			"initialized.owl.carousel": a.proxy(function(a) {
				a.namespace && this._core.settings.autoplay && this.play()
			}, this),
			"play.owl.autoplay": a.proxy(function(a, b, c) {
				a.namespace && this.play(b, c)
			}, this),
			"stop.owl.autoplay": a.proxy(function(a) {
				a.namespace && this.stop()
			}, this),
			"mouseover.owl.autoplay": a.proxy(function() {
				this._core.settings.autoplayHoverPause && this._core.is("rotating") &&
					this.pause()
			}, this),
			"mouseleave.owl.autoplay": a.proxy(function() {
				this._core.settings.autoplayHoverPause && this._core.is("rotating") &&
					this.play()
			}, this)
		}, this._core.$element.on(this._handlers), this._core.options = a.extend({},
			e.Defaults, this._core.options)
	};
	e.Defaults = {
		autoplay: !1,
		autoplayTimeout: 5e3,
		autoplayHoverPause: !1,
		autoplaySpeed: !1
	}, e.prototype.play = function(d, e) {
		this._paused = !1, this._core.is("rotating") || (this._core.enter("rotating"),
			this._interval = b.setInterval(a.proxy(function() {
				this._paused || this._core.is("busy") || this._core.is("interacting") ||
					c.hidden || this._core.next(e || this._core.settings.autoplaySpeed)
			}, this), d || this._core.settings.autoplayTimeout))
	}, e.prototype.stop = function() {
		this._core.is("rotating") && (b.clearInterval(this._interval), this._core.leave(
			"rotating"))
	}, e.prototype.pause = function() {
		this._core.is("rotating") && (this._paused = !0)
	}, e.prototype.destroy = function() {
		var a, b;
		this.stop();
		for (a in this._handlers) this._core.$element.off(a, this._handlers[a]);
		for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] &&
			(this[b] = null)
	}, a.fn.owlCarousel.Constructor.Plugins.autoplay = e
}(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) {
	"use strict";
	var e = function(b) {
		this._core = b, this._initialized = !1, this._pages = [], this._controls = {},
			this._templates = [], this.$element = this._core.$element, this._overrides = {
				next: this._core.next,
				prev: this._core.prev,
				to: this._core.to
			}, this._handlers = {
				"prepared.owl.carousel": a.proxy(function(b) {
					b.namespace && this._core.settings.dotsData && this._templates.push(
						'<div class="' + this._core.settings.dotClass + '">' + a(b.content).find(
							"[data-dot]").andSelf("[data-dot]").attr("data-dot") + "</div>")
				}, this),
				"added.owl.carousel": a.proxy(function(a) {
					a.namespace && this._core.settings.dotsData && this._templates.splice(a
						.position, 0, this._templates.pop())
				}, this),
				"remove.owl.carousel": a.proxy(function(a) {
					a.namespace && this._core.settings.dotsData && this._templates.splice(a
						.position, 1)
				}, this),
				"changed.owl.carousel": a.proxy(function(a) {
					a.namespace && "position" == a.property.name && this.draw()
				}, this),
				"initialized.owl.carousel": a.proxy(function(a) {
					a.namespace && !this._initialized && (this._core.trigger("initialize",
							null, "navigation"), this.initialize(), this.update(), this.draw(),
						this._initialized = !0, this._core.trigger("initialized", null,
							"navigation"))
				}, this),
				"refreshed.owl.carousel": a.proxy(function(a) {
					a.namespace && this._initialized && (this._core.trigger("refresh", null,
						"navigation"), this.update(), this.draw(), this._core.trigger(
						"refreshed", null, "navigation"))
				}, this)
			}, this._core.options = a.extend({}, e.Defaults, this._core.options), this.$element
			.on(this._handlers)
	};
	e.Defaults = {
		nav: !1,
		navText: ["prev", "next"],
		navSpeed: !1,
		navElement: "div",
		navContainer: !1,
		navContainerClass: "owl-nav",
		navClass: ["owl-prev", "owl-next"],
		slideBy: 1,
		dotClass: "owl-dot",
		dotsClass: "owl-dots",
		dots: !0,
		dotsEach: !1,
		dotsData: !1,
		dotsSpeed: !1,
		dotsContainer: !1
	}, e.prototype.initialize = function() {
		var b, c = this._core.settings;
		this._controls.$relative = (c.navContainer ? a(c.navContainer) : a("<div>").addClass(
				c.navContainerClass).appendTo(this.$element)).addClass("disabled"), this._controls
			.$previous = a("<" + c.navElement + ">").addClass(c.navClass[0]).html(c.navText[
				0]).prependTo(this._controls.$relative).on("click", a.proxy(function(a) {
				this.prev(c.navSpeed)
			}, this)), this._controls.$next = a("<" + c.navElement + ">").addClass(c.navClass[
				1]).html(c.navText[1]).appendTo(this._controls.$relative).on("click", a.proxy(
				function(a) {
					this.next(c.navSpeed)
				}, this)), c.dotsData || (this._templates = [a("<div>").addClass(c.dotClass)
				.append(a("<span>")).prop("outerHTML")
			]), this._controls.$absolute = (c.dotsContainer ? a(c.dotsContainer) : a(
				"<div>").addClass(c.dotsClass).appendTo(this.$element)).addClass(
				"disabled"), this._controls.$absolute.on("click", "div", a.proxy(function(
				b) {
				var d = a(b.target).parent().is(this._controls.$absolute) ? a(b.target).index() :
					a(b.target).parent().index();
				b.preventDefault(), this.to(d, c.dotsSpeed)
			}, this));
		for (b in this._overrides) this._core[b] = a.proxy(this[b], this)
	}, e.prototype.destroy = function() {
		var a, b, c, d;
		for (a in this._handlers) this.$element.off(a, this._handlers[a]);
		for (b in this._controls) this._controls[b].remove();
		for (d in this.overides) this._core[d] = this._overrides[d];
		for (c in Object.getOwnPropertyNames(this)) "function" != typeof this[c] &&
			(this[c] = null)
	}, e.prototype.update = function() {
		var a, b, c, d = this._core.clones().length / 2,
			e = d + this._core.items().length,
			f = this._core.maximum(!0),
			g = this._core.settings,
			h = g.center || g.autoWidth || g.dotsData ? 1 : g.dotsEach || g.items;
		if ("page" !== g.slideBy && (g.slideBy = Math.min(g.slideBy, g.items)), g.dots ||
			"page" == g.slideBy)
			for (this._pages = [], a = d, b = 0, c = 0; e > a; a++) {
				if (b >= h || 0 === b) {
					if (this._pages.push({
							start: Math.min(f, a - d),
							end: a - d + h - 1
						}), Math.min(f, a - d) === f) break;
					b = 0, ++c
				}
				b += this._core.mergers(this._core.relative(a))
			}
	}, e.prototype.draw = function() {
		var b, c = this._core.settings,
			d = this._core.items().length <= c.items,
			e = this._core.relative(this._core.current()),
			f = c.loop || c.rewind;
		this._controls.$relative.toggleClass("disabled", !c.nav || d), c.nav && (
				this._controls.$previous.toggleClass("disabled", !f && e <= this._core.minimum(!
					0)), this._controls.$next.toggleClass("disabled", !f && e >= this._core.maximum(!
					0))), this._controls.$absolute.toggleClass("disabled", !c.dots || d), c.dots &&
			(b = this._pages.length - this._controls.$absolute.children().length, c.dotsData &&
				0 !== b ? this._controls.$absolute.html(this._templates.join("")) : b > 0 ?
				this._controls.$absolute.append(new Array(b + 1).join(this._templates[0])) :
				0 > b && this._controls.$absolute.children().slice(b).remove(), this._controls
				.$absolute.find(".active").removeClass("active"), this._controls.$absolute
				.children().eq(a.inArray(this.current(), this._pages)).addClass("active"))
	}, e.prototype.onTrigger = function(b) {
		var c = this._core.settings;
		b.page = {
			index: a.inArray(this.current(), this._pages),
			count: this._pages.length,
			size: c && (c.center || c.autoWidth || c.dotsData ? 1 : c.dotsEach || c.items)
		}
	}, e.prototype.current = function() {
		var b = this._core.relative(this._core.current());
		return a.grep(this._pages, a.proxy(function(a, c) {
			return a.start <= b && a.end >= b
		}, this)).pop()
	}, e.prototype.getPosition = function(b) {
		var c, d, e = this._core.settings;
		return "page" == e.slideBy ? (c = a.inArray(this.current(), this._pages), d =
				this._pages.length, b ? ++c : --c, c = this._pages[(c % d + d) % d].start) :
			(c = this._core.relative(this._core.current()), d = this._core.items().length,
				b ? c += e.slideBy : c -= e.slideBy), c
	}, e.prototype.next = function(b) {
		a.proxy(this._overrides.to, this._core)(this.getPosition(!0), b)
	}, e.prototype.prev = function(b) {
		a.proxy(this._overrides.to, this._core)(this.getPosition(!1), b)
	}, e.prototype.to = function(b, c, d) {
		var e;
		d ? a.proxy(this._overrides.to, this._core)(b, c) : (e = this._pages.length,
			a.proxy(this._overrides.to, this._core)(this._pages[(b % e + e) % e].start,
				c))
	}, a.fn.owlCarousel.Constructor.Plugins.Navigation = e
}(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) {
	"use strict";
	var e = function(c) {
		this._core = c, this._hashes = {}, this.$element = this._core.$element, this
			._handlers = {
				"initialized.owl.carousel": a.proxy(function(c) {
					c.namespace && "URLHash" === this._core.settings.startPosition && a(b).trigger(
						"hashchange.owl.navigation")
				}, this),
				"prepared.owl.carousel": a.proxy(function(b) {
					if (b.namespace) {
						var c = a(b.content).find("[data-hash]").andSelf("[data-hash]").attr(
							"data-hash");
						if (!c) return;
						this._hashes[c] = b.content
					}
				}, this),
				"changed.owl.carousel": a.proxy(function(c) {
					if (c.namespace && "position" === c.property.name) {
						var d = this._core.items(this._core.relative(this._core.current())),
							e = a.map(this._hashes, function(a, b) {
								return a === d ? b : null
							}).join();
						if (!e || b.location.hash.slice(1) === e) return;
						b.location.hash = e
					}
				}, this)
			}, this._core.options = a.extend({}, e.Defaults, this._core.options), this.$element
			.on(this._handlers), a(b).on("hashchange.owl.navigation", a.proxy(function(
				a) {
				var c = b.location.hash.substring(1),
					e = this._core.$stage.children(),
					f = this._hashes[c] && e.index(this._hashes[c]);
				f !== d && f !== this._core.current() && this._core.to(this._core.relative(
					f), !1, !0)
			}, this))
	};
	e.Defaults = {
		URLhashListener: !1
	}, e.prototype.destroy = function() {
		var c, d;
		a(b).off("hashchange.owl.navigation");
		for (c in this._handlers) this._core.$element.off(c, this._handlers[c]);
		for (d in Object.getOwnPropertyNames(this)) "function" != typeof this[d] &&
			(this[d] = null)
	}, a.fn.owlCarousel.Constructor.Plugins.Hash = e
}(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) {
	function e(b, c) {
		var e = !1,
			f = b.charAt(0).toUpperCase() + b.slice(1);
		return a.each((b + " " + h.join(f + " ") + f).split(" "), function(a, b) {
			return g[b] !== d ? (e = c ? b : !0, !1) : void 0
		}), e
	}

	function f(a) {
		return e(a, !0)
	}
	var g = a("<support>").get(0).style,
		h = "Webkit Moz O ms".split(" "),
		i = {
			transition: {
				end: {
					WebkitTransition: "webkitTransitionEnd",
					MozTransition: "transitionend",
					OTransition: "oTransitionEnd",
					transition: "transitionend"
				}
			},
			animation: {
				end: {
					WebkitAnimation: "webkitAnimationEnd",
					MozAnimation: "animationend",
					OAnimation: "oAnimationEnd",
					animation: "animationend"
				}
			}
		},
		j = {
			csstransforms: function() {
				return !!e("transform")
			},
			csstransforms3d: function() {
				return !!e("perspective")
			},
			csstransitions: function() {
				return !!e("transition")
			},
			cssanimations: function() {
				return !!e("animation")
			}
		};
	j.csstransitions() && (a.support.transition = new String(f("transition")), a.support
			.transition.end = i.transition.end[a.support.transition]), j.cssanimations() &&
		(a.support.animation = new String(f("animation")), a.support.animation.end =
			i.animation.end[a.support.animation]), j.csstransforms() && (a.support.transform =
			new String(f("transform")), a.support.transform3d = j.csstransforms3d())
}(window.Zepto || window.jQuery, window, document);
