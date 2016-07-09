"function" != typeof Object.create && (Object.create = function (a) {
    function b() {}

    return b.prototype = a, new b
}), function (a) {
    var b = {
        init           : function (b) {return this.options = a.extend({}, a.noty.defaults, b), this.options.layout = this.options.custom ? a.noty.layouts.inline : a.noty.layouts[this.options.layout], this.options.theme = a.noty.themes[this.options.theme], delete b.layout, delete b.theme, this.options = a.extend({}, this.options, this.options.layout.options), this.options.id = "noty_" + (new Date).getTime() * Math.floor(1e6 * Math.random()), this.options = a.extend({}, this.options, b), this._build(), this},
        _build         : function () {
            var b = a('<div class="noty_bar"></div>').attr("id", this.options.id);
            if (b.append(this.options.template).find(".noty_text").html(this.options.text), this.$bar = null !== this.options.layout.parent.object ? a(this.options.layout.parent.object).css(this.options.layout.parent.css).append(b) : b, this.options.buttons) {
                this.options.closeWith = [], this.options.timeout = !1;
                var c = a("<div/>").addClass("noty_buttons");
                null !== this.options.layout.parent.object ? this.$bar.find(".noty_bar").append(c) : this.$bar.append(c);
                var d = this;
                a.each(this.options.buttons, function (b, c) {var e = a("<button/>").addClass(c.addClass ? c.addClass : "gray").html(c.text).appendTo(d.$bar.find(".noty_buttons")).bind("click", function () {a.isFunction(c.onClick) && c.onClick.call(e, d)})})
            }
            this.$message = this.$bar.find(".noty_message"), this.$closeButton = this.$bar.find(".noty_close"), this.$buttons = this.$bar.find(".noty_buttons"), a.noty.store[this.options.id] = this
        },
        show           : function () {
            var b = this;
            return a(b.options.layout.container.selector).append(b.$bar), b.options.theme.style.apply(b), "function" === a.type(b.options.layout.css) ? this.options.layout.css.apply(b.$bar) : b.$bar.css(this.options.layout.css || {}), b.$bar.addClass(b.options.layout.addClass), b.options.layout.container.style.apply(a(b.options.layout.container.selector)), b.options.theme.callback.onShow.apply(this), a.inArray("click", b.options.closeWith) > -1 && b.$bar.css("cursor", "pointer").one("click", function (a) {b.stopPropagation(a), b.options.callback.onCloseClick && b.options.callback.onCloseClick.apply(b), b.close()}), a.inArray("hover", b.options.closeWith) > -1 && b.$bar.one("mouseenter", function () {b.close()}), a.inArray("button", b.options.closeWith) > -1 && b.$closeButton.one("click", function (a) {b.stopPropagation(a), b.close()}), -1 == a.inArray("button", b.options.closeWith) && b.$closeButton.remove(), b.options.callback.onShow && b.options.callback.onShow.apply(b), b.$bar.animate(b.options.animation.open, b.options.animation.speed, b.options.animation.easing, function () {b.options.callback.afterShow && b.options.callback.afterShow.apply(b), b.shown = !0}), b.options.timeout && b.$bar.delay(b.options.timeout).promise().done(function () {b.close()}), this
        },
        close          : function () {
            if (!(this.closed || this.$bar && this.$bar.hasClass("i-am-closing-now"))) {
                var b = this;
                if (!this.shown) {
                    var c = [];
                    return a.each(a.noty.queue, function (a, d) {d.options.id != b.options.id && c.push(d)}), void(a.noty.queue = c)
                }
                b.$bar.addClass("i-am-closing-now"), b.options.callback.onClose && b.options.callback.onClose.apply(b), b.$bar.clearQueue().stop().animate(b.options.animation.close, b.options.animation.speed, b.options.animation.easing, function () {b.options.callback.afterClose && b.options.callback.afterClose.apply(b)}).promise().done(function () {b.options.modal && (a.notyRenderer.setModalCount(-1), 0 == a.notyRenderer.getModalCount() && a(".noty_modal").fadeOut("fast", function () {a(this).remove()})), a.notyRenderer.setLayoutCountFor(b, -1), 0 == a.notyRenderer.getLayoutCountFor(b) && a(b.options.layout.container.selector).remove(), "undefined" != typeof b.$bar && null !== b.$bar && (b.$bar.remove(), b.$bar = null, b.closed = !0), delete a.noty.store[b.options.id], b.options.theme.callback.onClose.apply(b), b.options.dismissQueue || (a.noty.ontap = !0, a.notyRenderer.render()), b.options.maxVisible > 0 && b.options.dismissQueue && a.notyRenderer.render()})
            }
        },
        setText        : function (a) {return this.closed || (this.options.text = a, this.$bar.find(".noty_text").html(a)), this},
        setType        : function (a) {return this.closed || (this.options.type = a, this.options.theme.style.apply(this), this.options.theme.callback.onShow.apply(this)), this},
        setTimeout     : function (a) {
            if (!this.closed) {
                var b = this;
                this.options.timeout = a, b.$bar.delay(b.options.timeout).promise().done(function () {b.close()})
            }
            return this
        },
        stopPropagation: function (a) {a = a || window.event, "undefined" != typeof a.stopPropagation ? a.stopPropagation() : a.cancelBubble = !0},
        closed         : !1,
        shown          : !1
    };
    a.notyRenderer = {}, a.notyRenderer.init = function (c) {
        var d = Object.create(b).init(c);
        return d.options.force ? a.noty.queue.unshift(d) : a.noty.queue.push(d), a.notyRenderer.render(), "object" == a.noty.returns ? d : d.options.id
    }, a.notyRenderer.render = function () {
        var b = a.noty.queue[0];
        "object" === a.type(b) ? b.options.dismissQueue ? b.options.maxVisible > 0 ? a(b.options.layout.container.selector + " li").length < b.options.maxVisible && a.notyRenderer.show(a.noty.queue.shift()) : a.notyRenderer.show(a.noty.queue.shift()) : a.noty.ontap && (a.notyRenderer.show(a.noty.queue.shift()), a.noty.ontap = !1) : a.noty.ontap = !0
    }, a.notyRenderer.show = function (b) {b.options.modal && (a.notyRenderer.createModalFor(b), a.notyRenderer.setModalCount(1)), 0 == a(b.options.layout.container.selector).length ? b.options.custom ? b.options.custom.append(a(b.options.layout.container.object).addClass("i-am-new")) : a("body").append(a(b.options.layout.container.object).addClass("i-am-new")) : a(b.options.layout.container.selector).removeClass("i-am-new"), a.notyRenderer.setLayoutCountFor(b, 1), b.show()}, a.notyRenderer.createModalFor = function (b) {0 == a(".noty_modal").length && a("<div/>").addClass("noty_modal").data("noty_modal_count", 0).css(b.options.theme.modal.css).prependTo(a("body")).fadeIn("fast")}, a.notyRenderer.getLayoutCountFor = function (b) {return a(b.options.layout.container.selector).data("noty_layout_count") || 0}, a.notyRenderer.setLayoutCountFor = function (b, c) {return a(b.options.layout.container.selector).data("noty_layout_count", a.notyRenderer.getLayoutCountFor(b) + c)}, a.notyRenderer.getModalCount = function () {return a(".noty_modal").data("noty_modal_count") || 0}, a.notyRenderer.setModalCount = function (b) {return a(".noty_modal").data("noty_modal_count", a.notyRenderer.getModalCount() + b)}, a.fn.noty = function (b) {return b.custom = a(this), a.notyRenderer.init(b)}, a.noty = {}, a.noty.queue = [], a.noty.ontap = !0, a.noty.layouts = {}, a.noty.themes = {}, a.noty.returns = "object", a.noty.store = {}, a.noty.get = function (b) {return a.noty.store.hasOwnProperty(b) ? a.noty.store[b] : !1}, a.noty.close = function (b) {return a.noty.get(b) ? a.noty.get(b).close() : !1}, a.noty.setText = function (b, c) {return a.noty.get(b) ? a.noty.get(b).setText(c) : !1}, a.noty.setType = function (b, c) {return a.noty.get(b) ? a.noty.get(b).setType(c) : !1}, a.noty.clearQueue = function () {a.noty.queue = []}, a.noty.closeAll = function () {a.noty.clearQueue(), a.each(a.noty.store, function (a, b) {b.close()})};
    var c = window.alert;
    a.noty.consumeAlert = function (b) {window.alert = function (c) {b ? b.text = c : b = {text: c}, a.notyRenderer.init(b)}}, a.noty.stopConsumeAlert = function () {window.alert = c}, a.noty.defaults = {
        layout      : "top",
        theme       : "agileUI",
        type        : "alert",
        text        : "",
        dismissQueue: !0,
        template    : '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
        animation   : {
            open  : {height: "toggle"},
            close : {height: "toggle"},
            easing: "swing",
            speed : 500
        },
        timeout     : !1,
        force       : !1,
        modal       : !1,
        maxVisible  : 5,
        closeWith   : ["click"],
        callback    : {
            onShow      : function () {},
            afterShow   : function () {},
            onClose     : function () {},
            afterClose  : function () {},
            onCloseClick: function () {}
        },
        buttons     : !1
    }, a(window).resize(function () {a.each(a.noty.layouts, function (b, c) {c.container.style.apply(a(c.container.selector))})})
}(jQuery), window.noty = function (a) {
    var b = 0, c = {
        animateOpen : "animation.open",
        animateClose: "animation.close",
        easing      : "animation.easing",
        speed       : "animation.speed",
        onShow      : "callback.onShow",
        onShown     : "callback.afterShow",
        onClose     : "callback.onClose",
        onCloseClick: "callback.onCloseClick",
        onClosed    : "callback.afterClose"
    };
    return jQuery.each(a, function (d, e) {
        if (c[d]) {
            b++;
            var f = c[d].split(".");
            a[f[0]] || (a[f[0]] = {}), a[f[0]][f[1]] = e ? e : function () {}, delete a[d]
        }
    }), a.closeWith || (a.closeWith = jQuery.noty.defaults.closeWith), a.hasOwnProperty("closeButton") && (b++, a.closeButton && a.closeWith.push("button"), delete a.closeButton), a.hasOwnProperty("closeOnSelfClick") && (b++, a.closeOnSelfClick && a.closeWith.push("click"), delete a.closeOnSelfClick), a.hasOwnProperty("closeOnSelfOver") && (b++, a.closeOnSelfOver && a.closeWith.push("hover"), delete a.closeOnSelfOver), a.hasOwnProperty("custom") && (b++, "null" != a.custom.container && (a.custom = a.custom.container)), a.hasOwnProperty("cssPrefix") && (b++, delete a.cssPrefix), "noty_theme_default" == a.theme && (b++, a.theme = "agileUI"), a.hasOwnProperty("dismissQueue") || (a.dismissQueue = jQuery.noty.defaults.dismissQueue), a.hasOwnProperty("maxVisible") || (a.maxVisible = jQuery.noty.defaults.maxVisible), a.buttons && jQuery.each(a.buttons, function (a, c) {c.click && (b++, c.onClick = c.click, delete c.click), c.type && (b++, c.addClass = c.type, delete c.type)}), b && "undefined" != typeof console && console.warn && console.warn("You are using noty v2 with v1.x.x options. @deprecated until v2.2.0 - Please update your options."), jQuery.notyRenderer.init(a)
}, function (a) {
    a.noty.themes.agileUI = {
        name    : "agileUI",
        helpers : {
            borderFix: function () {
                if (this.options.dismissQueue) {
                    this.options.layout.container.selector + " " + this.options.layout.parent.selector
                }
            }
        },
        modal   : {
            css: {
                position       : "fixed",
                width          : "100%",
                height         : "100%",
                backgroundColor: "#000",
                zIndex         : 1e4,
                opacity        : .7,
                display        : "none",
                left           : 0,
                top            : 0
            }
        },
        style   : function () {
            switch (this.$bar.bind({
                mouseenter: function () {a(this).find(".noty_close").stop().fadeTo("normal", 1)},
                mouseleave: function () {a(this).find(".noty_close").stop().fadeTo("normal", 0)}
            }), this.options.type) {
                case"alert":
                    this.$bar.addClass("bg-orange");
                    break;
                case"notification":
                    this.$bar.addClass("bg-blue");
                    break;
                case"warning":
                    this.$bar.addClass("bg-orange");
                    break;
                case"error":
                    this.$bar.addClass("bg-red");
                    break;
                case"information":
                    this.$bar.addClass("bg-gray");
                    break;
                case"success":
                    this.$bar.addClass("bg-green");
                    break;
                default:
                    this.$bar.addClass("bg-black")
            }
        },
        callback: {
            onShow : function () {a.noty.themes.agileUI.helpers.borderFix.apply(this)},
            onClose: function () {a.noty.themes.agileUI.helpers.borderFix.apply(this)}
        }
    }
}(jQuery), function (a) {
    a.noty.layouts.bottom = {
        name     : "bottom",
        options  : {},
        container: {
            object  : '<ul class="noty-wrapper" id="noty_bottom" />',
            selector: "ul#noty_bottom",
            style   : function () {a(this).css({})}
        },
        parent   : {object: "<li />", selector: "li", css: {}},
        css      : {display: "none"},
        addClass : ""
    }
}(jQuery), function (a) {
    a.noty.layouts.top = {
        name     : "top",
        options  : {},
        container: {
            object  : '<ul class="noty-wrapper" id="noty_top" />',
            selector: "ul#noty_top",
            style   : function () {}
        },
        parent   : {object: "<li />", selector: "li", css: {}},
        css      : {display: "none"},
        addClass : ""
    }
}(jQuery), function (a) {
    a.noty.layouts.center = {
        name     : "center",
        options  : {modal: !0},
        container: {
            object  : '<ul class="noty-wrapper" id="noty_center" />',
            selector: "ul#noty_center",
            style   : function () {
                a("li", this).addClass("radius-all-4 modal-dialog"), a(this).css({
                    width : "300px",
                    height: "auto"
                });
                var b = a(this).clone().css({
                    visibility: "hidden",
                    display   : "block",
                    position  : "absolute",
                    top       : 0,
                    left      : 0
                }).attr("id", "dupe");
                a("body").append(b), b.find(".i-am-closing-now").remove(), b.find("li").css("display", "block");
                var c = b.height();
                b.remove(), a(this).hasClass("i-am-new") ? a(this).css({
                    left: (a(window).width() - a(this).outerWidth(!1)) / 2 + "px",
                    top : (a(window).height() - c) / 2 + "px"
                }) : a(this).animate({
                    left: (a(window).width() - a(this).outerWidth(!1)) / 2 + "px",
                    top : (a(window).height() - c) / 2 + "px"
                }, 500)
            }
        },
        parent   : {object: "<li />", selector: "li", css: {}},
        css      : {display: "none", width: "310px"},
        addClass : ""
    }
}(jQuery);