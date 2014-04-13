! function (d) {
    function f() {
        return new Date(Date.UTC.apply(Date, arguments))
    }
    function b() {
        var g = new Date();
        return f(g.getUTCFullYear(), g.getUTCMonth(), g.getUTCDate())
    }
    var a = function (h, g) {
        var i = this;
        this.element = d(h);
        this.language = g.language || this.element.data("date-language") || "en";
        this.language = this.language in e ? this.language : "en";
        this.isRTL = e[this.language].rtl || false;
        this.format = c.parseFormat(g.format || this.element.data("date-format") || "mm/dd/yyyy");
        this.isInline = false;
        this.isInput = this.element.is("input");
        this.component = this.element.is(".date") ? this.element.find(".add-on") : false;
        this.hasInput = this.component && this.element.find("input").length;
        if (this.component && this.component.length === 0) {
            this.component = false
        }
        this._attachEvents();
        this.forceParse = true;
        if ("forceParse" in g) {
            this.forceParse = g.forceParse
        } else {
            if ("dateForceParse" in this.element.data()) {
                this.forceParse = this.element.data("date-force-parse")
            }
        }
        this.picker = d(c.template).appendTo(this.isInline ? this.element : "body").on({
            click: d.proxy(this.click, this),
            mousedown: d.proxy(this.mousedown, this)
        });
        if (this.isInline) {
            this.picker.addClass("datepicker-inline")
        } else {
            this.picker.addClass("datepicker-dropdown dropdown-menu")
        } if (this.isRTL) {
            this.picker.addClass("datepicker-rtl");
            this.picker.find(".prev i, .next i").toggleClass("icon-arrow-left icon-arrow-right")
        }
        d(document).on("mousedown", function (j) {
            if (d(j.target).closest(".datepicker").length === 0) {
                i.hide()
            }
        });
        this.autoclose = false;
        if ("autoclose" in g) {
            this.autoclose = g.autoclose
        } else {
            if ("dateAutoclose" in this.element.data()) {
                this.autoclose = this.element.data("date-autoclose")
            }
        }
        this.keyboardNavigation = true;
        if ("keyboardNavigation" in g) {
            this.keyboardNavigation = g.keyboardNavigation
        } else {
            if ("dateKeyboardNavigation" in this.element.data()) {
                this.keyboardNavigation = this.element.data("date-keyboard-navigation")
            }
        }
        this.viewMode = this.startViewMode = 0;
        switch (g.startView || this.element.data("date-start-view")) {
        case 2:
        case "decade":
            this.viewMode = this.startViewMode = 2;
            break;
        case 1:
        case "year":
            this.viewMode = this.startViewMode = 1;
            break
        }
        this.todayBtn = (g.todayBtn || this.element.data("date-today-btn") || false);
        this.todayHighlight = (g.todayHighlight || this.element.data("date-today-highlight") || false);
        this.weekStart = ((g.weekStart || this.element.data("date-weekstart") || e[this.language].weekStart || 0) % 7);
        this.weekEnd = ((this.weekStart + 6) % 7);
        this.startDate = -Infinity;
        this.endDate = Infinity;
        this.daysOfWeekDisabled = [];
        this.beforeShowDay = g.beforeShowDay;
        this.setStartDate(g.startDate || this.element.data("date-startdate"));
        this.setEndDate(g.endDate || this.element.data("date-enddate"));
        this.setDaysOfWeekDisabled(g.daysOfWeekDisabled || this.element.data("date-days-of-week-disabled"));
        this.fillDow();
        this.fillMonths();
        this.update();
        this.showMode();
        if (this.isInline) {
            this.show()
        }
    };
    a.prototype = {
        constructor: a,
        _events: [],
        _attachEvents: function () {
            this._detachEvents();
            if (this.isInput) {
                this._events = [
                    [this.element, {
                            focus: d.proxy(this.show, this),
                            keyup: d.proxy(this.update, this),
                            keydown: d.proxy(this.keydown, this)
                        }
                    ]
                ]
            } else {
                if (this.component && this.hasInput) {
                    this._events = [
                        [this.element.find("input"), {
                                focus: d.proxy(this.show, this),
                                keyup: d.proxy(this.update, this),
                                keydown: d.proxy(this.keydown, this)
                            }
                        ],
                        [this.component, {
                                click: d.proxy(this.show, this)
                            }
                        ]
                    ]
                } else {
                    if (this.element.is("div")) {
                        this.isInline = true
                    } else {
                        this._events = [
                            [this.element, {
                                    click: d.proxy(this.show, this)
                                }
                            ]
                        ]
                    }
                }
            }
            for (var g = 0, h, j; g < this._events.length; g++) {
                h = this._events[g][0];
                j = this._events[g][1];
                h.on(j)
            }
        },
        _detachEvents: function () {
            for (var g = 0, h, j; g < this._events.length; g++) {
                h = this._events[g][0];
                j = this._events[g][1];
                h.off(j)
            }
            this._events = []
        },
        show: function (g) {
            this.picker.show();
            this.height = this.component ? this.component.outerHeight() : this.element.outerHeight();
            this.update();
            this.place();
            d(window).on("resize", d.proxy(this.place, this));
            if (g) {
                g.stopPropagation();
                g.preventDefault()
            }
            this.element.trigger({
                type: "show",
                date: this.date
            })
        },
        hide: function (g) {
            if (this.isInline) {
                return
            }
            this.picker.hide();
            d(window).off("resize", this.place);
            this.viewMode = this.startViewMode;
            this.showMode();
            if (!this.isInput) {
                d(document).off("mousedown", this.hide)
            }
            if (this.forceParse && (this.isInput && this.element.val() || this.hasInput && this.element.find("input").val())) {
                this.setValue()
            }
            this.element.trigger({
                type: "hide",
                date: this.date
            })
        },
        remove: function () {
            this._detachEvents();
            this.picker.remove();
            delete this.element.data().datepicker
        },
        getDate: function () {
            var g = this.getUTCDate();
            return new Date(g.getTime() + (g.getTimezoneOffset() * 60000))
        },
        getUTCDate: function () {
            return this.date
        },
        setDate: function (g) {
            this.setUTCDate(new Date(g.getTime() - (g.getTimezoneOffset() * 60000)))
        },
        setUTCDate: function (g) {
            this.date = g;
            this.setValue()
        },
        setValue: function () {
            var g = this.getFormattedDate();
            if (!this.isInput) {
                if (this.component) {
                    this.element.find("input").val(g)
                }
                this.element.data("date", g)
            } else {
                this.element.val(g)
            }
        },
        getFormattedDate: function (g) {
            if (g === undefined) {
                g = this.format
            }
            return c.formatDate(this.date, g, this.language)
        },
        setStartDate: function (g) {
            this.startDate = g || -Infinity;
            if (this.startDate !== -Infinity) {
                this.startDate = c.parseDate(this.startDate, this.format, this.language)
            }
            this.update();
            this.updateNavArrows()
        },
        setEndDate: function (g) {
            this.endDate = g || Infinity;
            if (this.endDate !== Infinity) {
                this.endDate = c.parseDate(this.endDate, this.format, this.language)
            }
            this.update();
            this.updateNavArrows()
        },
        setDaysOfWeekDisabled: function (g) {
            this.daysOfWeekDisabled = g || [];
            if (!d.isArray(this.daysOfWeekDisabled)) {
                this.daysOfWeekDisabled = this.daysOfWeekDisabled.split(/,\s*/)
            }
            this.daysOfWeekDisabled = d.map(this.daysOfWeekDisabled, function (h) {
                return parseInt(h, 10)
            });
            this.update();
            this.updateNavArrows()
        },
        place: function () {
            if (this.isInline) {
                return
            }
            var i = parseInt(this.element.parents().filter(function () {
                return d(this).css("z-index") != "auto"
            }).first().css("z-index")) + 10;
            var h = this.component ? this.component.offset() : this.element.offset();
            var g = this.component ? this.component.outerHeight(true) : this.element.outerHeight(true);
            this.picker.css({
                top: h.top + g,
                left: h.left,
                zIndex: i
            })
        },
        update: function () {
            var h, i = false;
            if (arguments && arguments.length && (typeof arguments[0] === "string" || arguments[0] instanceof Date)) {
                h = arguments[0];
                i = true
            } else {
                h = this.isInput ? this.element.val() : this.element.data("date") || this.element.find("input").val()
            }
            this.date = c.parseDate(h, this.format, this.language);
            if (i) {
                this.setValue()
            }
            var g = this.viewDate;
            if (this.date < this.startDate) {
                this.viewDate = new Date(this.startDate)
            } else {
                if (this.date > this.endDate) {
                    this.viewDate = new Date(this.endDate)
                } else {
                    this.viewDate = new Date(this.date)
                }
            } if (g && g.getTime() != this.viewDate.getTime()) {
                this.element.trigger({
                    type: "changeDate",
                    date: this.viewDate
                })
            }
            this.fill()
        },
        fillDow: function () {
            var g = this.weekStart,
                h = "<tr>";
            while (g < this.weekStart + 7) {
                h += '<th class="dow">' + e[this.language].daysMin[(g++) % 7] + "</th>"
            }
            h += "</tr>";
            this.picker.find(".datepicker-days thead").append(h)
        },
        fillMonths: function () {
            var h = "",
                g = 0;
            while (g < 12) {
                h += '<span class="month">' + e[this.language].monthsShort[g++] + "</span>"
            }
            this.picker.find(".datepicker-months td").html(h)
        },
        fill: function () {
            var v = new Date(this.viewDate),
                n = v.getUTCFullYear(),
                w = v.getUTCMonth(),
                p = this.startDate !== -Infinity ? this.startDate.getUTCFullYear() : -Infinity,
                t = this.startDate !== -Infinity ? this.startDate.getUTCMonth() : -Infinity,
                k = this.endDate !== Infinity ? this.endDate.getUTCFullYear() : Infinity,
                q = this.endDate !== Infinity ? this.endDate.getUTCMonth() : Infinity,
                l = this.date && this.date.valueOf(),
                u = new Date();
            this.picker.find(".datepicker-days thead th:eq(1)").text(e[this.language].months[w] + " " + n);
            this.picker.find("tfoot th.today").text(e[this.language].today).toggle(this.todayBtn !== false);
            this.updateNavArrows();
            this.fillMonths();
            var y = f(n, w - 1, 28, 0, 0, 0, 0),
                s = c.getDaysInMonth(y.getUTCFullYear(), y.getUTCMonth());
            y.setUTCDate(s);
            y.setUTCDate(s - (y.getUTCDay() - this.weekStart + 7) % 7);
            var g = new Date(y);
            g.setUTCDate(g.getUTCDate() + 42);
            g = g.valueOf();
            var m = [];
            var o;
            while (y.valueOf() < g) {
                if (y.getUTCDay() == this.weekStart) {
                    m.push("<tr>")
                }
                o = "";
                if (y.getUTCFullYear() < n || (y.getUTCFullYear() == n && y.getUTCMonth() < w)) {
                    o += " old"
                } else {
                    if (y.getUTCFullYear() > n || (y.getUTCFullYear() == n && y.getUTCMonth() > w)) {
                        o += " new"
                    }
                } if (this.todayHighlight && y.getUTCFullYear() == u.getFullYear() && y.getUTCMonth() == u.getMonth() && y.getUTCDate() == u.getDate()) {
                    o += " today"
                }
                if (l && y.valueOf() == l) {
                    o += " active"
                }
                if (y.valueOf() < this.startDate || y.valueOf() > this.endDate || d.inArray(y.getUTCDay(), this.daysOfWeekDisabled) !== -1) {
                    o += " disabled"
                }
                if ( !! this.beforeShowDay) {
                    var h = this.beforeShowDay(y);
                    if ( !! h) {
                        if (!h[0]) {
                            o += " disabled"
                        }
                        if ( !! h[1] && h[1] != "") {
                            o += " " + h[1]
                        }
                    }
                }
                m.push('<td class="day' + o + '">' + y.getUTCDate() + "</td>");
                if (y.getUTCDay() == this.weekEnd) {
                    m.push("</tr>")
                }
                y.setUTCDate(y.getUTCDate() + 1)
            }
            this.picker.find(".datepicker-days tbody").empty().append(m.join(""));
            var z = this.date && this.date.getUTCFullYear();
            var j = this.picker.find(".datepicker-months").find("th:eq(1)").text(n).end().find("span").removeClass("active");
            if (z && z == n) {
                j.eq(this.date.getUTCMonth()).addClass("active")
            }
            if (n < p || n > k) {
                j.addClass("disabled")
            }
            if (n == p) {
                j.slice(0, t).addClass("disabled")
            }
            if (n == k) {
                j.slice(q + 1).addClass("disabled")
            }
            m = "";
            n = parseInt(n / 10, 10) * 10;
            var x = this.picker.find(".datepicker-years").find("th:eq(1)").text(n + "-" + (n + 9)).end().find("td");
            n -= 1;
            for (var r = -1; r < 11; r++) {
                m += '<span class="year' + (r == -1 || r == 10 ? " old" : "") + (z == n ? " active" : "") + (n < p || n > k ? " disabled" : "") + '">' + n + "</span>";
                n += 1
            }
            x.html(m)
        },
        updateNavArrows: function () {
            var i = new Date(this.viewDate),
                g = i.getUTCFullYear(),
                h = i.getUTCMonth();
            switch (this.viewMode) {
            case 0:
                if (this.startDate !== -Infinity && g <= this.startDate.getUTCFullYear() && h <= this.startDate.getUTCMonth()) {
                    this.picker.find(".prev").css({
                        visibility: "hidden"
                    })
                } else {
                    this.picker.find(".prev").css({
                        visibility: "visible"
                    })
                } if (this.endDate !== Infinity && g >= this.endDate.getUTCFullYear() && h >= this.endDate.getUTCMonth()) {
                    this.picker.find(".next").css({
                        visibility: "hidden"
                    })
                } else {
                    this.picker.find(".next").css({
                        visibility: "visible"
                    })
                }
                break;
            case 1:
            case 2:
                if (this.startDate !== -Infinity && g <= this.startDate.getUTCFullYear()) {
                    this.picker.find(".prev").css({
                        visibility: "hidden"
                    })
                } else {
                    this.picker.find(".prev").css({
                        visibility: "visible"
                    })
                } if (this.endDate !== Infinity && g >= this.endDate.getUTCFullYear()) {
                    this.picker.find(".next").css({
                        visibility: "hidden"
                    })
                } else {
                    this.picker.find(".next").css({
                        visibility: "visible"
                    })
                }
                break
            }
        },
        click: function (m) {
            m.stopPropagation();
            m.preventDefault();
            var l = d(m.target).closest("span, td, th");
            if (l.length == 1) {
                switch (l[0].nodeName.toLowerCase()) {
                case "th":
                    switch (l[0].className) {
                    case "switch":
                        this.showMode(1);
                        break;
                    case "prev":
                    case "next":
                        var i = c.modes[this.viewMode].navStep * (l[0].className == "prev" ? -1 : 1);
                        switch (this.viewMode) {
                        case 0:
                            this.viewDate = this.moveMonth(this.viewDate, i);
                            break;
                        case 1:
                        case 2:
                            this.viewDate = this.moveYear(this.viewDate, i);
                            break
                        }
                        this.fill();
                        break;
                    case "today":
                        var h = new Date();
                        h = f(h.getFullYear(), h.getMonth(), h.getDate(), 0, 0, 0);
                        this.showMode(-2);
                        var n = this.todayBtn == "linked" ? null : "view";
                        this._setDate(h, n);
                        break
                    }
                    break;
                case "span":
                    if (!l.is(".disabled")) {
                        this.viewDate.setUTCDate(1);
                        if (l.is(".month")) {
                            var k = l.parent().find("span").index(l);
                            this.viewDate.setUTCMonth(k);
                            this.element.trigger({
                                type: "changeMonth",
                                date: this.viewDate
                            })
                        } else {
                            var j = parseInt(l.text(), 10) || 0;
                            this.viewDate.setUTCFullYear(j);
                            this.element.trigger({
                                type: "changeYear",
                                date: this.viewDate
                            })
                        }
                        this.showMode(-1);
                        this.fill()
                    }
                    break;
                case "td":
                    if (l.is(".day") && !l.is(".disabled")) {
                        var g = parseInt(l.text(), 10) || 1;
                        var j = this.viewDate.getUTCFullYear(),
                            k = this.viewDate.getUTCMonth();
                        if (l.is(".old")) {
                            if (k === 0) {
                                k = 11;
                                j -= 1
                            } else {
                                k -= 1
                            }
                        } else {
                            if (l.is(".new")) {
                                if (k == 11) {
                                    k = 0;
                                    j += 1
                                } else {
                                    k += 1
                                }
                            }
                        }
                        this._setDate(f(j, k, g, 0, 0, 0, 0))
                    }
                    break
                }
            }
        },
        _setDate: function (g, i) {
            if (!i || i == "date") {
                this.date = g
            }
            if (!i || i == "view") {
                this.viewDate = g
            }
            this.fill();
            this.setValue();
            this.element.trigger({
                type: "changeDate",
                date: this.date
            });
            var h;
            if (this.isInput) {
                h = this.element
            } else {
                if (this.component) {
                    h = this.element.find("input")
                }
            } if (h) {
                h.change();
                if (this.autoclose && (!i || i == "date")) {
                    this.hide()
                }
            }
        },
        moveMonth: function (g, h) {
            if (!h) {
                return g
            }
            var l = new Date(g.valueOf()),
                p = l.getUTCDate(),
                m = l.getUTCMonth(),
                k = Math.abs(h),
                o, n;
            h = h > 0 ? 1 : -1;
            if (k == 1) {
                n = h == -1 ? function () {
                    return l.getUTCMonth() == m
                } : function () {
                    return l.getUTCMonth() != o
                };
                o = m + h;
                l.setUTCMonth(o);
                if (o < 0 || o > 11) {
                    o = (o + 12) % 12
                }
            } else {
                for (var j = 0; j < k; j++) {
                    l = this.moveMonth(l, h)
                }
                o = l.getUTCMonth();
                l.setUTCDate(p);
                n = function () {
                    return o != l.getUTCMonth()
                }
            }
            while (n()) {
                l.setUTCDate(--p);
                l.setUTCMonth(o)
            }
            return l
        },
        moveYear: function (h, g) {
            return this.moveMonth(h, g * 12)
        },
        dateWithinRange: function (g) {
            return g >= this.startDate && g <= this.endDate
        },
        keydown: function (n) {
            if (this.picker.is(":not(:visible)")) {
                if (n.keyCode == 27) {
                    this.show()
                }
                return
            }
            var j = false,
                i, h, m, g, l;
            switch (n.keyCode) {
            case 27:
                this.hide();
                n.preventDefault();
                break;
            case 37:
            case 39:
                if (!this.keyboardNavigation) {
                    break
                }
                i = n.keyCode == 37 ? -1 : 1;
                if (n.ctrlKey) {
                    g = this.moveYear(this.date, i);
                    l = this.moveYear(this.viewDate, i)
                } else {
                    if (n.shiftKey) {
                        g = this.moveMonth(this.date, i);
                        l = this.moveMonth(this.viewDate, i)
                    } else {
                        g = new Date(this.date);
                        g.setUTCDate(this.date.getUTCDate() + i);
                        l = new Date(this.viewDate);
                        l.setUTCDate(this.viewDate.getUTCDate() + i)
                    }
                } if (this.dateWithinRange(g)) {
                    this.date = g;
                    this.viewDate = l;
                    this.setValue();
                    this.update();
                    n.preventDefault();
                    j = true
                }
                break;
            case 38:
            case 40:
                if (!this.keyboardNavigation) {
                    break
                }
                i = n.keyCode == 38 ? -1 : 1;
                if (n.ctrlKey) {
                    g = this.moveYear(this.date, i);
                    l = this.moveYear(this.viewDate, i)
                } else {
                    if (n.shiftKey) {
                        g = this.moveMonth(this.date, i);
                        l = this.moveMonth(this.viewDate, i)
                    } else {
                        g = new Date(this.date);
                        g.setUTCDate(this.date.getUTCDate() + i * 7);
                        l = new Date(this.viewDate);
                        l.setUTCDate(this.viewDate.getUTCDate() + i * 7)
                    }
                } if (this.dateWithinRange(g)) {
                    this.date = g;
                    this.viewDate = l;
                    this.setValue();
                    this.update();
                    n.preventDefault();
                    j = true
                }
                break;
            case 13:
                this.hide();
                n.preventDefault();
                break;
            case 9:
                this.hide();
                break
            }
            if (j) {
                this.element.trigger({
                    type: "changeDate",
                    date: this.date
                });
                var k;
                if (this.isInput) {
                    k = this.element
                } else {
                    if (this.component) {
                        k = this.element.find("input")
                    }
                } if (k) {
                    k.change()
                }
            }
        },
        showMode: function (g) {
            if (g) {
                this.viewMode = Math.max(0, Math.min(2, this.viewMode + g))
            }
            this.picker.find(">div").hide().filter(".datepicker-" + c.modes[this.viewMode].clsName).css("display", "block");
            this.updateNavArrows()
        }
    };
    d.fn.datepicker = function (h) {
        var g = Array.apply(null, arguments);
        g.shift();
        return this.each(function () {
            var k = d(this),
                j = k.data("datepicker"),
                i = typeof h == "object" && h;
            if (!j) {
                k.data("datepicker", (j = new a(this, d.extend({}, d.fn.datepicker.defaults, i))))
            }
            if (typeof h == "string" && typeof j[h] == "function") {
                j[h].apply(j, g)
            }
        })
    };
    d.fn.datepicker.defaults = {};
    d.fn.datepicker.Constructor = a;
    var e = d.fn.datepicker.dates = {
        en: {
            days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
            daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
            daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"],
            months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            today: "Today"
        }
    };
    var c = {
        modes: [{
                clsName: "days",
                navFnc: "Month",
                navStep: 1
            }, {
                clsName: "months",
                navFnc: "FullYear",
                navStep: 1
            }, {
                clsName: "years",
                navFnc: "FullYear",
                navStep: 10
            }
        ],
        isLeapYear: function (g) {
            return (((g % 4 === 0) && (g % 100 !== 0)) || (g % 400 === 0))
        },
        getDaysInMonth: function (g, h) {
            return [31, (c.isLeapYear(g) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][h]
        },
        validParts: /dd?|DD?|mm?|MM?|yy(?:yy)?/g,
        nonpunctuation: /[^ -\/:-@\[\u3400-\u9fff-`{-~\t\n\r]+/g,
        parseFormat: function (i) {
            var g = i.replace(this.validParts, "\0").split("\0"),
                h = i.match(this.validParts);
            if (!g || !g.length || !h || h.length === 0) {
                throw new Error("Invalid date format.")
            }
            return {
                separators: g,
                parts: h
            }
        },
        parseDate: function (k, u, n) {
            if (k instanceof Date) {
                return k
            }
            if (/^[\-+]\d+[dmwy]([\s,]+[\-+]\d+[dmwy])*$/.test(k)) {
                var w = /([\-+]\d+)([dmwy])/,
                    m = k.match(/([\-+]\d+)([dmwy])/g),
                    g, l;
                k = new Date();
                for (var o = 0; o < m.length; o++) {
                    g = w.exec(m[o]);
                    l = parseInt(g[1]);
                    switch (g[2]) {
                    case "d":
                        k.setUTCDate(k.getUTCDate() + l);
                        break;
                    case "m":
                        k = a.prototype.moveMonth.call(a.prototype, k, l);
                        break;
                    case "w":
                        k.setUTCDate(k.getUTCDate() + l * 7);
                        break;
                    case "y":
                        k = a.prototype.moveYear.call(a.prototype, k, l);
                        break
                    }
                }
                return f(k.getUTCFullYear(), k.getUTCMonth(), k.getUTCDate(), 0, 0, 0)
            }
            var m = k && k.match(this.nonpunctuation) || [],
                k = new Date(),
                r = {}, t = ["yyyy", "yy", "M", "MM", "m", "mm", "d", "dd"],
                v = {
                    yyyy: function (s, i) {
                        return s.setUTCFullYear(i)
                    },
                    yy: function (s, i) {
                        return s.setUTCFullYear(2000 + i)
                    },
                    m: function (s, i) {
                        i -= 1;
                        while (i < 0) {
                            i += 12
                        }
                        i %= 12;
                        s.setUTCMonth(i);
                        while (s.getUTCMonth() != i) {
                            s.setUTCDate(s.getUTCDate() - 1)
                        }
                        return s
                    },
                    d: function (s, i) {
                        return s.setUTCDate(i)
                    }
                }, j, p, g;
            v.M = v.MM = v.mm = v.m;
            v.dd = v.d;
            k = f(k.getFullYear(), k.getMonth(), k.getDate(), 0, 0, 0);
            var q = u.parts.slice();
            if (m.length != q.length) {
                q = d(q).filter(function (s, y) {
                    return d.inArray(y, t) !== -1
                }).toArray()
            }
            if (m.length == q.length) {
                for (var o = 0, h = q.length; o < h; o++) {
                    j = parseInt(m[o], 10);
                    g = q[o];
                    if (isNaN(j)) {
                        switch (g) {
                        case "MM":
                            p = d(e[n].months).filter(function () {
                                var i = this.slice(0, m[o].length),
                                    s = m[o].slice(0, i.length);
                                return i == s
                            });
                            j = d.inArray(p[0], e[n].months) + 1;
                            break;
                        case "M":
                            p = d(e[n].monthsShort).filter(function () {
                                var i = this.slice(0, m[o].length),
                                    s = m[o].slice(0, i.length);
                                return i == s
                            });
                            j = d.inArray(p[0], e[n].monthsShort) + 1;
                            break
                        }
                    }
                    r[g] = j
                }
                for (var o = 0, x; o < t.length; o++) {
                    x = t[o];
                    if (x in r && !isNaN(r[x])) {
                        v[x](k, r[x])
                    }
                }
            }
            return k
        },
        formatDate: function (g, l, n) {
            var m = {
                d: g.getUTCDate(),
                D: e[n].daysShort[g.getUTCDay()],
                DD: e[n].days[g.getUTCDay()],
                m: g.getUTCMonth() + 1,
                M: e[n].monthsShort[g.getUTCMonth()],
                MM: e[n].months[g.getUTCMonth()],
                yy: g.getUTCFullYear().toString().substring(2),
                yyyy: g.getUTCFullYear()
            };
            m.dd = (m.d < 10 ? "0" : "") + m.d;
            m.mm = (m.m < 10 ? "0" : "") + m.m;
            var g = [],
                k = d.extend([], l.separators);
            for (var j = 0, h = l.parts.length; j < h; j++) {
                if (k.length) {
                    g.push(k.shift())
                }
                g.push(m[l.parts[j]])
            }
            return g.join("")
        },
        headTemplate: '<thead><tr><th class="prev"><i class="icon-arrow-left"/></th><th colspan="5" class="switch"></th><th class="next"><i class="icon-arrow-right"/></th></tr></thead>',
        contTemplate: '<tbody><tr><td colspan="7"></td></tr></tbody>',
        footTemplate: '<tfoot><tr><th colspan="7" class="today"></th></tr></tfoot>'
    };
    c.template = '<div class="datepicker"><div class="datepicker-days"><table class=" table-condensed">' + c.headTemplate + "<tbody></tbody>" + c.footTemplate + '</table></div><div class="datepicker-months"><table class="table-condensed">' + c.headTemplate + c.contTemplate + c.footTemplate + '</table></div><div class="datepicker-years"><table class="table-condensed">' + c.headTemplate + c.contTemplate + c.footTemplate + "</table></div></div>";
    d.fn.datepicker.DPGlobal = c
}(window.jQuery);
(function (a) {
    typeof define == "function" && define.amd ? define(["jquery"], a) : a(jQuery)
})(function (G) {
    function y(M) {
        var c = M.data("timepicker-settings"),
            m = M.data("timepicker-list");
        m && m.length && (m.remove(), M.data("timepicker-list", !1)), m = G("<ul />", {
            tabindex: -1,
            "class": "ui-timepicker-list"
        }), c.className && m.addClass(c.className), m.css({
            display: "none",
            position: "absolute"
        }), (c.minTime !== null || c.durationTime !== null) && c.showDuration && m.addClass("ui-timepicker-with-duration");
        var N = c.durationTime !== null ? c.durationTime : c.minTime,
            e = c.minTime !== null ? c.minTime : 0,
            L = c.maxTime !== null ? c.maxTime : e + z - 1;
        L <= e && (L += z);
        for (var K = e; K <= L; K += c.step * 60) {
            var v = K % z,
                g = G("<li />");
            g.data("time", v), g.text(A(v, c.timeFormat));
            if ((c.minTime !== null || c.durationTime !== null) && c.showDuration) {
                var n = G("<span />");
                n.addClass("ui-timepicker-duration"), n.text(" (" + b(K - N) + ")"), g.append(n)
            }
            m.append(g)
        }
        m.data("timepicker-input", M), M.data("timepicker-list", m);
        var d = c.appendTo;
        typeof d == "string" ? d = G(d) : typeof d == "function" && (d = d(M)), d.append(m), I(M, m), m.on("click", "li", function (a) {
            M.addClass("ui-timepicker-hideme"), M[0].focus(), m.find("li").removeClass("ui-timepicker-selected"), G(this).addClass("ui-timepicker-selected"), H(M), m.hide()
        })
    }
    function j() {
        var c = new Date,
            a = c.getTimezoneOffset() * 60000;
        c.setHours(0), c.setMinutes(0), c.setSeconds(0);
        var d = c.getTimezoneOffset() * 60000;
        return new Date(c.valueOf() - d + a)
    }
    function J() {
        "ontouchstart" in document ? G("body").on("touchstart.ui-timepicker", F) : (G("body").on("mousedown.ui-timepicker", F), G(window).on("scroll.ui-timepicker", F))
    }
    function F(a) {
        var d = G(a.target),
            c = d.closest(".ui-timepicker-input");
        c.length === 0 && d.closest(".ui-timepicker-list").length === 0 && (q.hide(), G("body").unbind(".ui-timepicker"), G(window).unbind(".ui-timepicker"))
    }
    function B(c, g, e) {
        if (!e && e !== 0) {
            return !1
        }
        var a = c.data("timepicker-settings"),
            d = !1,
            f = a.step * 30;
        return g.find("li").each(function (m, o) {
            var l = G(o),
                h = l.data("time") - e;
            if (Math.abs(h) < f || h == f) {
                return d = l, !1
            }
        }), d
    }
    function I(d, a) {
        var f = E(d.val()),
            c = B(d, a, f);
        c && c.addClass("ui-timepicker-selected")
    }
    function D() {
        if (this.value === "") {
            return
        }
        var c = G(this),
            f = E(this.value);
        if (f === null) {
            c.trigger("timeFormatError");
            return
        }
        var e = c.data("timepicker-settings");
        if (e.forceRoundTime) {
            var a = f % (e.step * 60);
            a >= e.step * 30 ? f += e.step * 60 - a : f -= a
        }
        var d = A(f, e.timeFormat);
        c.val(d)
    }
    function x(c) {
        var e = G(this),
            d = e.data("timepicker-list");
        if (!d.is(":visible")) {
            if (c.keyCode != 40) {
                return !0
            }
            e.focus()
        }
        switch (c.keyCode) {
        case 13:
            return H(e), q.hide.apply(this), c.preventDefault(), !1;
        case 38:
            var a = d.find(".ui-timepicker-selected");
            a.length ? a.is(":first-child") || (a.removeClass("ui-timepicker-selected"), a.prev().addClass("ui-timepicker-selected"), a.prev().position().top < a.outerHeight() && d.scrollTop(d.scrollTop() - a.outerHeight())) : (d.children().each(function (f, g) {
                if (G(g).position().top > 0) {
                    return a = G(g), !1
                }
            }), a.addClass("ui-timepicker-selected"));
            break;
        case 40:
            a = d.find(".ui-timepicker-selected"), a.length === 0 ? (d.children().each(function (f, g) {
                if (G(g).position().top > 0) {
                    return a = G(g), !1
                }
            }), a.addClass("ui-timepicker-selected")) : a.is(":last-child") || (a.removeClass("ui-timepicker-selected"), a.next().addClass("ui-timepicker-selected"), a.next().position().top + 2 * a.outerHeight() > d.outerHeight() && d.scrollTop(d.scrollTop() + a.outerHeight()));
            break;
        case 27:
            d.find("li").removeClass("ui-timepicker-selected"), d.hide();
            break;
        case 9:
            q.hide();
            break;
        case 16:
        case 17:
        case 18:
        case 19:
        case 20:
        case 33:
        case 34:
        case 35:
        case 36:
        case 37:
        case 39:
        case 45:
            return;
        default:
            d.find("li").removeClass("ui-timepicker-selected");
            return
        }
    }
    function H(g) {
        var c = g.data("timepicker-settings"),
            h = g.data("timepicker-list"),
            f = null,
            a = h.find(".ui-timepicker-selected");
        a.length ? f = a.data("time") : g.val() && (f = E(g.val()), I(g, h));
        if (f !== null) {
            var d = A(f, c.timeFormat);
            g.val(d)
        }
        g.trigger("change").trigger("changeTime")
    }
    function b(d) {
        var a = Math.round(d / 60),
            f;
        if (Math.abs(a) < 60) {
            f = [a, C.mins]
        } else {
            if (a == 60) {
                f = ["1", C.hr]
            } else {
                var c = (a / 60).toFixed(1);
                C.decimal != "." && (c = c.replace(".", C.decimal)), f = [c, C.hrs]
            }
        }
        return f.join(" ")
    }
    function A(l, p) {
        if (l === null) {
            return
        }
        var h = new Date(k.valueOf() + l * 1000),
            f = "",
            g, m;
        for (var d = 0; d < p.length; d++) {
            m = p.charAt(d);
            switch (m) {
            case "a":
                f += h.getHours() > 11 ? "pm" : "am";
                break;
            case "A":
                f += h.getHours() > 11 ? "PM" : "AM";
                break;
            case "g":
                g = h.getHours() % 12, f += g === 0 ? "12" : g;
                break;
            case "G":
                f += h.getHours();
                break;
            case "h":
                g = h.getHours() % 12, g !== 0 && g < 10 && (g = "0" + g), f += g === 0 ? "12" : g;
                break;
            case "H":
                g = h.getHours(), f += g > 9 ? g : "0" + g;
                break;
            case "i":
                var c = h.getMinutes();
                f += c > 9 ? c : "0" + c;
                break;
            case "s":
                l = h.getSeconds(), f += l > 9 ? l : "0" + l;
                break;
            default:
                f += m
            }
        }
        return f
    }
    function E(h) {
        if (h === "") {
            return null
        }
        if (h + 0 == h) {
            return h
        }
        typeof h == "object" && (h = h.getHours() + ":" + h.getMinutes() + ":" + h.getSeconds());
        var d = new Date(0),
            m;
        h.indexOf(":") !== -1 ? m = /(\d{1,2})(?::(\d{1,2}))?(?::(\d{2}))?\s*([pa]?)/ : m = /^([0-2][0-9]):?([0-5][0-9])?:?([0-5][0-9])?\s*([pa]?)$/;
        var g = h.toLowerCase().match(m);
        if (!g) {
            return null
        }
        var c = parseInt(g[1] * 1, 10),
            f;
        g[4] ? c == 12 ? f = g[4] == "p" ? 12 : 0 : f = c + (g[4] == "p" ? 12 : 0) : f = c;
        var l = g[2] * 1 || 0,
            a = g[3] * 1 || 0;
        return f * 3600 + l * 60 + a
    }
    var k = j(),
        z = 86400,
        w = {
            className: null,
            minTime: null,
            maxTime: null,
            durationTime: null,
            step: 30,
            showDuration: !1,
            timeFormat: "g:ia",
            scrollDefaultNow: !1,
            scrollDefaultTime: !1,
            selectOnBlur: !1,
            disableTouchKeyboard: !0,
            forceRoundTime: !1,
            appendTo: "body"
        }, C = {
            decimal: ".",
            mins: "mins",
            hr: "hr",
            hrs: "hrs"
        }, q = {
            init: function (a) {
                return this.each(function () {
                    var i = G(this);
                    if (i[0].tagName == "SELECT") {
                        var h = {
                            type: "text",
                            value: i.val()
                        }, e = i[0].attributes;
                        for (var d = 0; d < e.length; d++) {
                            h[e[d].nodeName] = e[d].nodeValue
                        }
                        var g = G("<input />", h);
                        i.replaceWith(g), i = g
                    }
                    var c = G.extend({}, w);
                    a && (c = G.extend(c, a)), c.minTime && (c.minTime = E(c.minTime)), c.maxTime && (c.maxTime = E(c.maxTime)), c.durationTime && (c.durationTime = E(c.durationTime)), c.lang && (C = G.extend(C, c.lang)), i.data("timepicker-settings", c), i.prop("autocomplete", "off"), i.on("click.timepicker focus.timepicker", q.show), i.on("blur.timepicker", D), i.on("keydown.timepicker", x), i.addClass("ui-timepicker-input"), D.call(i.get(0))
                })
            },
            show: function (d) {
                var h = G(this),
                    e = h.data("timepicker-settings");
                "ontouchstart" in document && e.disableTouchKeyboard && h.blur();
                var c = h.data("timepicker-list");
                if (h.prop("readonly")) {
                    return
                }
                if (!c || c.length === 0) {
                    y(h), c = h.data("timepicker-list")
                }
                if (h.hasClass("ui-timepicker-hideme")) {
                    h.removeClass("ui-timepicker-hideme"), c.hide();
                    return
                }
                if (c.is(":visible")) {
                    return
                }
                q.hide(), h.offset().top + h.outerHeight(!0) + c.outerHeight() > G(window).height() + G(window).scrollTop() ? c.css({
                    left: h.offset().left,
                    top: h.offset().top - c.outerHeight()
                }) : c.css({
                    left: h.offset().left,
                    top: h.offset().top + h.outerHeight()
                }), c.show();
                var a = c.find(".ui-timepicker-selected");
                a.length || (h.val() ? a = B(h, c, E(h.val())) : e.scrollDefaultNow ? a = B(h, c, E(new Date)) : e.scrollDefaultTime !== !1 && (a = B(h, c, E(e.scrollDefaultTime))));
                if (a && a.length) {
                    var g = c.scrollTop() + a.position().top - a.outerHeight();
                    c.scrollTop(g)
                } else {
                    c.scrollTop(0)
                }
                J(), h.trigger("showTimepicker")
            },
            hide: function (a) {
                G(".ui-timepicker-list:visible").each(function () {
                    var c = G(this),
                        e = c.data("timepicker-input"),
                        d = e.data("timepicker-settings");
                    d && d.selectOnBlur && H(e), c.hide(), e.trigger("hideTimepicker")
                })
            },
            option: function (c, f) {
                var e = G(this),
                    a = e.data("timepicker-settings"),
                    d = e.data("timepicker-list");
                if (typeof c == "object") {
                    a = G.extend(a, c)
                } else {
                    if (typeof c == "string" && typeof f != "undefined") {
                        a[c] = f
                    } else {
                        if (typeof c == "string") {
                            return a[c]
                        }
                    }
                }
                a.minTime && (a.minTime = E(a.minTime)), a.maxTime && (a.maxTime = E(a.maxTime)), a.durationTime && (a.durationTime = E(a.durationTime)), e.data("timepicker-settings", a), d && (d.remove(), e.data("timepicker-list", !1))
            },
            getSecondsFromMidnight: function () {
                return E(G(this).val())
            },
            getTime: function () {
                return new Date(k.valueOf() + E(G(this).val()) * 1000)
            },
            setTime: function (a) {
                var d = G(this),
                    c = A(E(a), d.data("timepicker-settings").timeFormat);
                d.val(c)
            },
            remove: function () {
                var a = G(this);
                if (!a.hasClass("ui-timepicker-input")) {
                    return
                }
                a.removeAttr("autocomplete", "off"), a.removeClass("ui-timepicker-input"), a.removeData("timepicker-settings"), a.off(".timepicker"), a.data("timepicker-list") && a.data("timepicker-list").remove(), a.removeData("timepicker-list")
            }
        };
    G.fn.timepicker = function (a) {
        if (q[a]) {
            return q[a].apply(this, Array.prototype.slice.call(arguments, 1))
        }
        if (typeof a == "object" || !a) {
            return q.init.apply(this, arguments)
        }
        G.error("Method " + a + " does not exist on jQuery.timepicker")
    }
});
var Vaya = Vaya || {};
Vaya.DateTime = (function () {
    var b = "MM/dd/yyyy";
    var d = "h:mm tt";
    var h = "mm/dd/yyyy";
    var k = "h:i A";
    var g = function (l) {
        return (l < 10 ? "0" : "") + l
    };
    var e = {
        s: function (l) {
            return l.getSeconds()
        },
        ss: function (l) {
            return g(l.getSeconds())
        },
        m: function (l) {
            return l.getMinutes()
        },
        mm: function (l) {
            return g(l.getMinutes())
        },
        h: function (l) {
            return l.getHours() % 12 || 12
        },
        hh: function (l) {
            return g(l.getHours() % 12 || 12)
        },
        H: function (l) {
            return l.getHours()
        },
        HH: function (l) {
            return g(l.getHours())
        },
        d: function (l) {
            return l.getDate()
        },
        dd: function (l) {
            return g(l.getDate())
        },
        ddd: function (m, l) {
            return l.dayNamesShort[m.getDay()]
        },
        dddd: function (m, l) {
            return l.dayNames[m.getDay()]
        },
        M: function (l) {
            return l.getMonth() + 1
        },
        MM: function (l) {
            return g(l.getMonth() + 1)
        },
        MMM: function (m, l) {
            return l.monthNamesShort[m.getMonth()]
        },
        MMMM: function (m, l) {
            return l.monthNames[m.getMonth()]
        },
        yy: function (l) {
            return (l.getFullYear() + "").substring(2)
        },
        yyyy: function (l) {
            return l.getFullYear()
        },
        t: function (l) {
            return l.getHours() < 12 ? "a" : "p"
        },
        tt: function (l) {
            return l.getHours() < 12 ? "am" : "pm"
        },
        T: function (l) {
            return l.getHours() < 12 ? "A" : "P"
        },
        TT: function (l) {
            return l.getHours() < 12 ? "AM" : "PM"
        },
        u: function (l) {
            return Vaya.DateTime.formatDate(l, "yyyy-MM-dd'T'HH:mm:ss'Z'")
        },
        S: function (m) {
            var l = m.getDate();
            if (l > 10 && l < 20) {
                return "th"
            }
            return ["st", "nd", "rd"][l % 10 - 1] || "th"
        }
    };
    var f = {
        monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        dayNames: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        dayNamesShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
    };
    var j = /^([0-9]{4})(-([0-9]{2})(-([0-9]{2})([T ]([0-9]{2}):([0-9]{2})(:([0-9]{2})(\.([0-9]+))?)?(Z|(([-+])([0-9]{2})(:?([0-9]{2}))?))?)?)?)?$/;
    var i = function (x, w, v, y) {
        y = y || {};
        var m = x,
            o = w,
            p, q = v.length,
            s, n, u, r = "";
        for (p = 0; p < q; p++) {
            s = v.charAt(p);
            if (s == "'") {
                for (n = p + 1; n < q; n++) {
                    if (v.charAt(n) == "'") {
                        if (m) {
                            if (n == p + 1) {
                                r += "'"
                            } else {
                                r += v.substring(p + 1, n)
                            }
                            p = n
                        }
                        break
                    }
                }
            } else {
                if (s == "(") {
                    for (n = p + 1; n < q; n++) {
                        if (v.charAt(n) == ")") {
                            var l = formatDate(m, v.substring(p + 1, n), y);
                            if (parseInt(l.replace(/\D/, ""), 10)) {
                                r += l
                            }
                            p = n;
                            break
                        }
                    }
                } else {
                    if (s == "[") {
                        for (n = p + 1; n < q; n++) {
                            if (v.charAt(n) == "]") {
                                var t = v.substring(p + 1, n);
                                var l = formatDate(m, t, y);
                                if (l != formatDate(o, t, y)) {
                                    r += l
                                }
                                p = n;
                                break
                            }
                        }
                    } else {
                        if (s == "{") {
                            m = w;
                            o = x
                        } else {
                            if (s == "}") {
                                m = x;
                                o = w
                            } else {
                                for (n = q; n > p; n--) {
                                    if (u = e[v.substring(p, n)]) {
                                        if (m) {
                                            r += u(m, y)
                                        }
                                        p = n - 1;
                                        break
                                    }
                                }
                                if (n == p) {
                                    if (m) {
                                        r += s
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return r
    };
    var c = function (n) {
        var m = n.match(/[.\/\-\s].*?/),
            l = n.split(/\W+/);
        if (!m || !l || l.length === 0) {
            throw new Error("Invalid date format.")
        }
        return {
            separator: m,
            parts: l
        }
    };
    var a = function (n, t) {
        var o = n.split(t.separator),
            n = new Date(),
            m;
        n.setHours(0);
        n.setMinutes(0);
        n.setSeconds(0);
        n.setMilliseconds(0);
        if (o.length === t.parts.length) {
            var r = n.getFullYear(),
                s = n.getDate(),
                q = n.getMonth();
            for (var p = 0, l = t.parts.length; p < l; p++) {
                m = parseInt(o[p], 10) || 1;
                switch (t.parts[p]) {
                case "dd":
                case "d":
                    s = m;
                    n.setDate(m);
                    break;
                case "mm":
                case "m":
                    q = m - 1;
                    n.setMonth(m - 1);
                    break;
                case "yy":
                    r = 2000 + m;
                    n.setFullYear(2000 + m);
                    break;
                case "yyyy":
                    r = m;
                    n.setFullYear(m);
                    break
                }
            }
            n = new Date(r, q, s, 0, 0, 0)
        }
        return n
    };
    return {
        isDate: function (l) {
            return Object.prototype.toString.call(l) === "[object Date]"
        },
        isTime: function (l) {
            return Object.prototype.toString.call(l) === "[object Date]"
        },
        formatDate: function (l, m) {
            m = m || b;
            return i(l, null, m, f)
        },
        formatTime: function (m, l) {
            l = l || d;
            return Vaya.DateTime.formatDate(m, l)
        },
        formatISO8601DayOnly: function (l) {
            function m(o) {
                return o < 10 ? "0" + o : o
            }
            return l.getUTCFullYear() + "-" + m(l.getUTCMonth() + 1) + "-" + m(l.getUTCDate())
        },
        toLocalZone: function (l) {
            return new Date(l.getTime() + l.getTimezoneOffset() * 60000)
        },
        getUTCDate: function (l) {
            return new Date(Date.UTC(l.getUTCFullYear(), l.getUTCMonth(), l.getUTCDate()))
        },
        getUTCToday: function () {
            var l = new Date();
            return Vaya.DateTime.getUTCDate(l)
        },
        getYesterday: function () {
            var l = new Date();
            return new Date(l.getFullYear(), l.getMonth(), l.getDay() - 1)
        },
        getUTCYesterday: function () {
            var l = Vaya.DateTime.getYesterday();
            return Vaya.DateTime.getUTCDate(l)
        },
        getMinutesSinceMidnight: function (n) {
            var m = new Date(n);
            var l = n - m.setHours(0, 0, 0, 0);
            return Math.floor(l / (1000 * 60))
        },
        formatDateFromISO8601: function (m, n) {
            var l = Vaya.DateTime.parseISO8601(m, true);
            return Vaya.DateTime.formatDate(l, n)
        },
        formatTimeFromISO8601: function (m, n) {
            var l = Vaya.DateTime.parseISO8601(m, true);
            return Vaya.DateTime.formatTime(l, n)
        },
        parseDate: function (o, p, n) {
            if (!p) {
                if (o.indexOf("-") == 4) {
                    p = "yyyy-mm-dd"
                } else {
                    p = "mm/dd/yyyy"
                }
            }
            var m = c(p);
            var l = a(o, m);
            if ( !! n) {
                l = Vaya.DateTime.getUTCDate(l)
            }
            return l
        },
        parseTime: function (o) {
            var p = o.toLowerCase().match(/(\d{1,2})(?::(\d{1,2}))?(?::(\d{2}))?\s*([pa]?)/);
            var m = parseInt(p[1] * 1, 10);
            var l;
            if (p[4]) {
                if (m == 12) {
                    l = (p[4] == "p") ? 12 : 0
                } else {
                    l = (m + (p[4] == "p" ? 12 : 0))
                }
            } else {
                l = m
            }
            var n = (p[2] * 1 || 0);
            var q = new Date();
            q.setHours(l);
            q.setMinutes(n);
            q.setSeconds(0);
            return q
        },
        datesOnSameDay: function (m, l) {
            if (!m || !l) {
                return false
            }
            return (m.getFullYear() === l.getFullYear() && m.getMonth() === l.getMonth() && m.getDate() === l.getDate())
        },
        beforeUTCToday: function (l) {
            var m = Vaya.DateTime.getUTCToday();
            return (l.getTime() < m.getTime())
        },
        addUTC: function (m, n, l, p) {
            var o = new Date(m.valueOf());
            o.setUTCFullYear(o.getUTCFullYear() + n);
            o.setUTCMonth(o.getUTCMonth() + l);
            o.setUTCDate(o.getUTCDate() + p);
            return o
        },
        parseISO8601: function (p, o) {
            if (!p) {
                return null
            }
            var l = p.match(j);
            if (!l) {
                return null
            }
            var n = new Date(l[1], 0, 1);
            if (o) {
                n.setFullYear(l[1], l[3] ? l[3] - 1 : 0, l[5] || 1);
                n.setHours(l[7] || 0, l[8] || 0, l[10] || 0, l[12] ? Number("0." + l[12]) * 1000 : 0)
            } else {
                n.setUTCFullYear(l[1], l[3] ? l[3] - 1 : 0, l[5] || 1);
                n.setUTCHours(l[7] || 0, l[8] || 0, l[10] || 0, l[12] ? Number("0." + l[12]) * 1000 : 0);
                if (l[14]) {
                    var q = Number(l[16]) * 60 + (l[18] ? Number(l[18]) : 0);
                    q *= l[15] == "-" ? 1 : -1;
                    n = new Date(+n + (q * 60 * 1000))
                }
            }
            return n
        }
    }
})();
var Vaya = Vaya || {};
Vaya.DateTimePicker = (function () {
    var b = "mm/dd/yyyy";
    var a = "h:i A";
    return {
        pickerDateFormat: b,
        pickerTimeFormat: a,
        setDateForPicker: function (e, c) {
            var d = Vaya.DateTime.formatDate(c);
            e.val(d);
            e.datepicker("update")
        },
        registerStartEndTimePicker: function (g, i, d, f, j, c) {
            g.datepicker({
                format: b,
                autoclose: true
            });
            if ( !! i) {
                i.datepicker({
                    format: b,
                    autoclose: true
                })
            }
            d.timepicker({
                timeFormat: a
            });
            f.timepicker({
                showDuration: (j > 0),
                timeFormat: a,
                scrollDefaultNow: true
            });
            var e = function () {
                if (j > 0) {
                    f.timepicker("option", "minTime", d.val());
                    var k = d.timepicker("getTime");
                    if ( !! k) {
                        k = new Date(k.getTime() + (60 * 1000 * j));
                        f.timepicker("setTime", k)
                    }
                }
            };
            var h = function () {
                var k = g.data("datepicker").getDate();
                if (c > 0) {
                    k = new Date(k.getTime() + (60 * 60 * 1000 * 24 * c))
                }
                Vaya.DateTimePicker.setDateForPicker(i, k);
                i.datepicker("setStartDate", g.val())
            };
            d.change(e);
            d.on("changeTime", e);
            e();
            g.change(h);
            g.on("changeDate", h);
            h()
        },
    }
})();
var Vaya = Vaya || {};
Vaya.Scheduler = (function () {
    var b = (function () {
        var e = function (f) {
            return typeof f === "string" ? f : Vaya.DateTime.formatISO8601DayOnly(f)
        };
        var d = function (g) {
            var f = g;
            this.raw = function () {
                return f
            };
            this.busyAllDay = function (h) {
                if (!f.busy) {
                    return false
                }
                var i = f.busy[e(h)];
                return !!(i && i[0] == null && i[1] == null)
            };
            this.busyForPartOfDay = function (h) {
                if (!f.busy) {
                    return false
                }
                var i = f.busy[e(h)];
                return !!(i && (i[0] != null || i[1] != null))
            };
            this.getBusyTimesForDate = function (h) {
                if (!f.busy) {
                    return {
                        start: null,
                        end: null
                    }
                }
                var i = f.busy[e(h)];
                return {
                    start: i[0] ? Vaya.DateTime.parseISO8601(i[0], true) : null,
                    end: i[1] ? Vaya.DateTime.parseISO8601(i[1], true) : null
                }
            };
            this.hasEventsOnDate = function (h) {
                return this.getEventsForDate(h).length > 0
            };
            this.getEventsForDate = function (h) {
                var i = f.events && f.events[e(h)];
                return (i && i.events) || []
            }
        };
        return d
    })();
    var a = function (e, g) {
        var f = true;
        var d = null;
        if (!g) {
            f = false;
            g = function (h) {
                d = h
            }
        }
        $.ajax({
            url: e,
            async: f,
            cache: false,
            global: false,
            success: function (i, h, j) {
                g({
                    success: true,
                    status: h,
                    response: new b(i),
                    xhr: j
                })
            },
            error: function (j, h, i) {
                g({
                    success: false,
                    status: h,
                    xhr: j,
                    response: i
                })
            }
        });
        if (!f) {
            return d
        }
        return null
    };
    var c = function (e) {
        return (typeof e === "string") ? e : Vaya.DateTime.formatDate(e, "u")
    };
    return {
        eventDates: function (e, d, g, h) {
            var f = Vaya.Util.encodeURLParameters({
                start_time: c(e),
                end_time: c(d),
                trip_id: g
            });
            result = a("/scheduler/trip_dates?" + f, h);
            return result || true
        }
    }
})();
(function (b) {
    var c = function (d, l) {
        var k = this;
        var f = b(d);
        var i = l.html5 || false;
        var j = l;
        this.element = function () {
            return f
        };
        this.isNative = function () {
            return i
        };
        this.options = function () {
            return b.extend(true, {}, j)
        };
        this.format = function () {
            if (i) {
                return "yyyy-mm-dd"
            }
            return j.format
        };
        var e = function () {
            if (!f.is("input")) {
                b.error("target element for xpDatePicker must be an <input>")
            } else {
                if (f.attr("type") != "date") {
                    var m = f.clone(true).attr("type", "date");
                    f.replaceWith(m);
                    f = m
                }
            }
            f.on("change", b.proxy(h, this))
        };
        var h = function (m) {
            var n = f.val();
            f.trigger("changeDate", {
                date: new Date(n),
                value: n
            })
        };
        var g = function (m, n) {
            if (n === undefined || n === null) {
                m.stopImmediatePropagation();
                f.trigger("changeDate", {
                    date: Vaya.DateTime.toLocalZone(m.date),
                    value: f.val()
                })
            }
        };
        if (!i) {
            f.datepicker(l);
            f.on("changeDate", b.proxy(g, this))
        } else {
            e()
        }
        f.data("xp-datepicker", this)
    };
    var a = function (f, g, e) {
        if (typeof f === "string") {
            return Vaya.DateTime.parseDate(f, g, !! e)
        } else {
            if (Vaya.DateTime.isDate(f)) {
                var h = new Date(f.getTime());
                h.setHours(0);
                h.setMinutes(0);
                h.setSeconds(0);
                h.setMilliseconds(0);
                return h
            }
        }
        return null
    };
    c.prototype = {
        getDate: function (e) {
            var f = this.element().val();
            if (typeof f === "string" && f !== "") {
                f = Vaya.DateTime.parseDate(f, this.format())
            } else {
                if (!Vaya.DateTime.isDate(f)) {
                    return null
                }
            } if (Vaya.DateTime.isDate(e)) {
                f.setHours(e.getHours());
                f.setMinutes(e.getMinutes());
                f.setSeconds(e.getSeconds())
            }
            return f
        },
        setDate: function (g, h, f) {
            var i = a(g, h || this.format(), f);
            if (this.isNative()) {
                var e = "";
                if (i !== null && i !== undefined) {
                    e = Vaya.DateTime.formatISO8601DayOnly(i)
                }
                this.element().val(e);
                this.element().trigger("changeDate", {
                    date: i,
                    value: this.element().val()
                })
            } else {
                if (i === null || i === undefined) {
                    this.element().val("")
                } else {
                    if (f) {
                        this.element().datepicker("setUTCDate", i)
                    } else {
                        this.element().datepicker("setDate", i)
                    }
                }
                this.element().trigger("changeDate", {
                    date: i,
                    value: this.element().val()
                })
            }
        },
        minDate: function (g, h, e) {
            var j = a(g, h || this.format(), e);
            if (this.isNative()) {
                if (j !== null && j !== undefined) {
                    j = Vaya.DateTime.formatISO8601DayOnly(j);
                    this.element().attr("min", j)
                } else {
                    this.element().removeAttr("min")
                }
            } else {
                if (j !== null && j !== undefined) {
                    var f = new Date(j.getTime() - 86400000);
                    this.element().datepicker("setStartDate", f)
                } else {
                    this.element().datepicker("setStartDate")
                }
            }
            var i = this.getDate();
            if (i !== null && i < j) {
                this.setDate()
            }
        },
        maxDate: function (f, g, e) {
            var i = a(f, g || this.format(), e);
            if (this.isNative()) {
                if (i !== null && i !== undefined) {
                    i = Vaya.DateTime.formatISO8601DayOnly(i);
                    this.element().attr("max", i)
                } else {
                    this.element().removeAttr("max")
                }
            } else {
                if (i !== null && i !== undefined) {
                    this.element().datepicker("setEndDate", i)
                } else {
                    this.element().datepicker("setEndDate")
                }
            }
            var h = this.getDate();
            if (h !== null && h > i) {
                this.setDate()
            }
        },
        resetDateRestrictions: function () {
            this.minDate();
            this.maxDate()
        }
    };
    b.fn.xpDatePicker = function (g) {
        var f = Array.apply(null, arguments);
        var e = typeof g == "object" && g;
        var d = undefined;
        f.shift();
        this.each(function () {
            var i = b(this);
            var h = i.data("xp-datepicker");
            if (!h) {
                h = new c(i, b.extend({}, b.fn.xpDatePicker.defaults, e));
                i.data("xp-datepicker", h)
            }
            if (typeof g === "string" && typeof h[g] === "function") {
                d = h[g].apply(h, f);
                if (d !== undefined) {
                    return false
                }
            } else {
                if (typeof g === "string") {
                    b.error("Method '" + g + "' does not exist on jQuery.xpDatePicker.")
                }
            }
        });
        return (d === undefined ? this : d)
    };
    b.fn.xpDatePicker.defaults = {
        format: "mm/dd/yyyy",
        weekStart: 0,
        viewMode: "days",
        minViewMode: "days",
        language: "en",
        autoclose: true,
        html5: false
    }
})(window.jQuery);
(function (c) {
    var d = function (j, i) {
        var f = c(j);
        var g = f.children("option");
        var e = i;
        this.element = function () {
            return f
        };
        this.selectOptions = function () {
            return g
        };
        this.options = function () {
            return c.extend(true, {}, e)
        };
        this.format = function () {
            return e.format
        };
        this.firstRealOption = function () {
            return f.children("option[value!='']").first()
        };
        var h = function (k) {
            f.trigger("changeTime", {
                date: this.getTime(),
                value: f.val(),
            })
        };
        f.on("change", c.proxy(h, this))
    };
    var b = function (e, f) {
        return Vaya.DateTime.isDate(e) ? e : Vaya.DateTime.parseTime(e, f)
    };
    var a = function (g, j, e, i) {
        var f = e ? "toobig" : "toosmall";
        if (g !== null && g !== undefined) {
            var h = Vaya.DateTime.getMinutesSinceMidnight(b(g, i));
            j.each(function (l, m) {
                var k = c(m);
                var n = k.data("minute");
                if ((e && n > h) || (!e && n < h)) {
                    k.prop("disabled", true).prop("selected", false).addClass(f)
                } else {
                    if (k.hasClass(f)) {
                        k.removeClass(f);
                        if (!k.hasClass("toobig") && !k.hasClass("toosmall") && !k.hasClass("blackout")) {
                            k.prop("disabled", false)
                        }
                    }
                }
            })
        } else {
            j.filter("." + f).each(function (k, l) {
                c(l).prop("disabled", false).removeClass(f)
            })
        }
    };
    d.prototype = {
        getTime: function () {
            if (this.element().val() !== "") {
                return Vaya.DateTime.parseTime(this.element().val(), this.format())
            } else {
                return null
            }
        },
        getMinutesSinceMidnight: function () {
            return Vaya.DateTime.getMinutesSinceMidnight(this.getTime())
        },
        setTime: function (e) {
            if (Vaya.DateTime.isDate(e)) {
                this.element().val(Vaya.DateTime.formatTime(e, this.format())).trigger("change")
            } else {
                this.element().val(e)
            }
        },
        minTime: function (e, f) {
            var g = this.element().val();
            a(e, this.selectOptions(), false, f || this.format());
            this.resetOptionOrdering();
            if (e) {
                this.selectOptions().each(function () {
                    var h = c(this);
                    if (h.prop("disabled")) {
                        h.appendTo(h.parent()).addClass("shuffled")
                    } else {
                        if (h.val() != "") {
                            return false
                        }
                    }
                })
            }
            if (g !== this.element().val()) {
                this.element().trigger("change")
            }
        },
        maxTime: function (e, f) {
            var g = this.element().val();
            a(e, this.selectOptions(), true, f || this.format());
            if (g !== this.element().val()) {
                this.element().trigger("change")
            }
        },
        blackoutTimeRange: function (i, f, j) {
            var e = j || this.format();
            var k = this.element().val();
            if (i && f) {
                var g = Vaya.DateTime.getMinutesSinceMidnight(b(i, e));
                var h = Vaya.DateTime.getMinutesSinceMidnight(b(f, e));
                this.selectOptions().each(function (m, n) {
                    var l = c(n);
                    var o = l.data("minute");
                    if (o <= h && o >= g) {
                        l.prop("disabled", true).prop("selected", false).addClass("blackout")
                    }
                })
            } else {
                this.selectOptions.filter(".blackout").each(function (m, n) {
                    var l = c(n).removeClass("blackout");
                    if (!l.hasClass("toobig") && !l.hasClass("toosmall")) {
                        l.prop("disabled", false)
                    }
                })
            } if (k !== this.element().val()) {
                this.element().trigger("change")
            }
        },
        resetTimeRestrictions: function () {
            this.selectOptions().each(function (f, g) {
                c(g).prop("disabled", false).removeClass("blackout").removeClass("toobig").removeClass("toosmall")
            });
            this.resetOptionOrdering()
        },
        resetOptionOrdering: function () {
            var e = this.firstRealOption();
            this.selectOptions().filter(".shuffled").each(function (g, f) {
                c(f).insertBefore(e).removeClass("shuffled")
            })
        }
    };
    c.fn.xpTimePicker = function (h) {
        var g = Array.apply(null, arguments);
        var f = typeof h == "object" && h;
        var e = undefined;
        g.shift();
        this.each(function () {
            var j = c(this);
            var i = j.data("xp-timepicker");
            if (!i) {
                i = new d(j, c.extend({}, c.fn.xpTimePicker.defaults, f));
                j.data("xp-timepicker", i)
            }
            if (typeof h === "string" && typeof i[h] === "function") {
                e = i[h].apply(i, g);
                if (e !== undefined) {
                    return false
                }
            } else {
                if (typeof h === "string") {
                    c.error("Method '" + h + "' does not exist on jQuery.xpTimePicker.")
                }
            }
        });
        return (e === undefined ? this : e)
    };
    c.fn.xpTimePicker.defaults = {
        format: "HH:mm"
    }
})(window.jQuery);
(function (a) {
    var b = function (i, h) {
        var d = a(i);
        var c = h;
        var j = h.html5 || false;
        var g = a(d.find(h.dateInput));
        var e = a(d.find(h.timeInput));
        this.options = function () {
            return a.extend(true, {}, c)
        };
        this.isNative = function () {
            return j
        };
        this.timePickerOptions = function () {
            return a.extend(true, {
                html5: j
            }, c.timePickerOptions)
        };
        this.datePickerOptions = function () {
            return a.extend(true, {
                html5: j
            }, c.datePickerOptions)
        };
        this.datePickerCall = function () {
            var k = g.xpDatePicker.apply(g, arguments);
            return (k === undefined ? this : k)
        };
        this.timePickerCall = function () {
            var k = e.xpTimePicker.apply(e, arguments);
            return (k === undefined ? this : k)
        };
        this.dateValue = function () {
            return g.val()
        };
        this.timeValue = function () {
            return e.val()
        };
        var f = function (l, m, k) {
            d.trigger("changeDateTime", {
                field: l,
                date: this.getDateTime(),
                timeValue: e.val(),
                dateValue: g.val()
            })
        };
        g.xpDatePicker(this.datePickerOptions());
        e.xpTimePicker(this.timePickerOptions());
        g = a(d.find(h.dateInput));
        g.on("changeDate", a.proxy(f, this, "date"));
        e.on("changeTime", a.proxy(f, this, "time"))
    };
    b.prototype = {
        getDateTime: function () {
            var c = this.timePickerCall("getTime");
            var e = this.datePickerCall("getDate", c);
            return e
        },
        setDateTime: function (g, f) {
            var c = g;
            if (!Vaya.DateTime.isDate(c)) {
                var e = f === false ? false : true;
                c = Vaya.DateTime.parseISO8601(g, e)
            }
            if (!c) {
                this.datePickerCall("setDate");
                this.timePickerCall("setTime")
            } else {
                this.datePickerCall("setDate", c);
                this.timePickerCall("setTime", c)
            }
        },
        minTime: function (c, d) {
            this.timePickerCall("minTime", c, d)
        },
        maxTime: function (c, d) {
            this.timePickerCall("maxTime", c, d)
        },
        blackoutTimeRange: function (d, c, e) {
            this.timePickerCall("blackoutTimeRange", d, c, e)
        },
        resetTimeRestrictions: function () {
            this.timePickerCall("resetTimeRestrictions")
        },
        minDate: function (f, e, c) {
            this.datePickerCall("minDate", f, e, c);
            if (this.datePickerCall("getDate") === null) {
                this.timePickerCall("setTime")
            }
        },
        maxDate: function (f, e, c) {
            this.datePickerCall("maxDate", f, e, c);
            if (this.datePickerCall("getDate") === null) {
                this.timePickerCall("setTime")
            }
        },
        resetDateRestrictions: function () {
            this.datePickerCall("resetDateRestrictions")
        },
        resetRestrictions: function () {
            this.resetDateRestrictions();
            this.resetTimeRestrictions()
        }
    };
    a.fn.xpDateTimePicker = function (f) {
        var e = Array.apply(null, arguments);
        var d = typeof f == "object" && f;
        var c = undefined;
        e.shift();
        this.each(function () {
            var h = a(this);
            var g = h.data("xp-datetime-picker");
            if (!g) {
                g = new b(h, a.extend({}, a.fn.xpDateTimePicker.defaults, d));
                h.data("xp-datetime-picker", g)
            }
            if (typeof f === "string" && typeof g[f] === "function") {
                c = g[f].apply(g, e);
                if (c !== undefined) {
                    return false
                }
            } else {
                if (typeof f === "string") {
                    a.error("Method '" + f + "' does not exist on jQuery.xpDateTimePicker.")
                }
            }
        });
        return (c === undefined ? this : c)
    };
    a.fn.xpDateTimePicker.defaults = {
        dateInput: "input.date",
        timeInput: "select.time",
        html5: false,
        datePickerOptions: {},
        timePickerOptions: {}
    }
})(window.jQuery);
(function (b) {
    var a = function (d, p) {
        var o = this;
        var h = b(d);
        var n = p;
        var m = p.html5 || false;
        var j = b(h.find(p.startTimePicker));
        var e = b(h.find(p.endTimePicker));
        var i = n.durationMinutes;
        this.options = function () {
            return b.extend(true, {}, n)
        };
        this.isNative = function () {
            return m
        };
        this.startTimePickerOptions = function () {
            return b.extend(true, {
                html5: m
            }, n.pickerOptions, n.startTimePickerOptions)
        };
        this.endTimePickerOptions = function () {
            return b.extend(true, {
                html5: m
            }, n.pickerOptions, n.endTimePickerOptions)
        };
        this.setDurationMinutes = function (q) {
            if (i = q) {
                f(j.xpDateTimePicker("getDateTime"), j.xpDateTimePicker("dateValue"), j.xpDateTimePicker("timeValue"))
            }
        };
        this.durationMinutes = function () {
            return i || 0
        };
        this.startTimePickerCall = function () {
            var q = j.xpDateTimePicker.apply(j, arguments);
            return (q === undefined ? this : q)
        };
        this.endTimePickerCall = function () {
            var q = e.xpDateTimePicker.apply(e, arguments);
            return (q === undefined ? this : q)
        };
        var k = function () {
            if (n.endTimeDisableMethod === "hide") {
                e.hide()
            } else {
                if (n.endTimeDisableMethod === "disable") {
                    e.children().prop("disabled", true)
                }
            }
        };
        var c = function () {
            e.show().children().prop("disabled", false)
        };
        var f = function (r, v, u) {
            var t = o.duration();
            if (r && v !== "") {
                var s = new Date(r.getTime() + t);
                e.xpDateTimePicker("minDate", s);
                var q = e.xpDateTimePicker("getDateTime");
                if (u !== "" && q && Vaya.DateTime.datesOnSameDay(q, s)) {
                    e.xpDateTimePicker("minTime", s)
                } else {
                    e.xpDateTimePicker("minTime")
                }
                c()
            } else {
                k();
                e.xpDateTimePicker("minDate");
                e.xpDateTimePicker("minTime");
                e.xpDateTimePicker("setDateTime")
            }
        };
        var l = function (q, r) {
            f(r.date, r.dateValue, r.timeValue);
            h.trigger("timeRangeChange", {
                startDate: j.xpDateTimePicker("getDateTime"),
                endDate: e.xpDateTimePicker("getDateTime"),
                field: "start " + r.field,
                dateValue: r.dateValue,
                timeValue: r.timeValue
            })
        };
        var g = function (q, s) {
            var u = o.duration();
            var r = j.xpDateTimePicker("getDateTime");
            if (s.date && r) {
                var t = new Date(r.getTime() + u);
                if (Vaya.DateTime.datesOnSameDay(s.date, t)) {
                    e.xpDateTimePicker("minTime", t)
                }
            } else {
                e.xpDateTimePicker("minTime")
            }
            h.trigger("timeRangeChange", {
                startDate: j.xpDateTimePicker("getDateTime"),
                endDate: e.xpDateTimePicker("getDateTime"),
                field: "end " + s.field,
                dateValue: s.dateValue,
                timeValue: s.timeValue
            })
        };
        j.xpDateTimePicker(this.startTimePickerOptions());
        e.xpDateTimePicker(this.endTimePickerOptions());
        j.on("changeDateTime", b.proxy(l, this));
        e.on("changeDateTime", b.proxy(g, this));
        if (!e.xpDateTimePicker("getDateTime")) {
            k()
        }
    };
    a.prototype = {
        durationDays: function () {
            this.durationMinutes() / 1440
        },
        duration: function () {
            return this.durationMinutes() * 60000
        },
        setStartTime: function (c, d) {
            this.startTimePickerCall("setDateTime", c, d)
        },
        setEndTime: function (c, d) {
            this.endTimePickerCall("setDateTime", c, d)
        },
        minDate: function (e, c, f) {
            this.startTimePickerCall("minDate", e, c, f);
            this.endTimePickerCall("minDate", e, c, f)
        },
        maxDate: function (e, c, f) {
            this.startTimePickerCall("maxDate", e, c, f);
            this.endTimePickerCall("maxDate", e, c, f)
        },
        minTime: function (c, d) {
            this.startTimePickerCall("minTime", c, d);
            this.endTimePickerCall("minTime", c, d)
        },
        maxTime: function (c, d) {
            this.startTimePickerCall("maxTime", c, d);
            this.endTimePickerCall("maxTime", c, d)
        },
        resetRestrictions: function () {
            this.startTimePickerCall("resetRestrictions");
            this.endTimePickerCall("resetRestrictions")
        }
    };
    b.fn.xpTimeRangePicker = function (f) {
        var e = Array.apply(null, arguments);
        var d = typeof f == "object" && f;
        var c = undefined;
        e.shift();
        this.each(function () {
            var h = b(this);
            var g = h.data("xp-timerange-picker");
            if (!g) {
                g = new a(h, b.extend({}, b.fn.xpTimeRangePicker.defaults, d));
                h.data("xp-timerange-picker", g)
            }
            if (typeof f === "string" && typeof g[f] === "function") {
                c = g[f].apply(g, e);
                if (c !== undefined) {
                    return false
                }
            } else {
                if (typeof f === "string") {
                    b.error("Method '" + f + "' does not exist on jQuery.xpTimeRangePicker.")
                }
            }
        });
        return (c === undefined ? this : c)
    };
    b.fn.xpTimeRangePicker.defaults = {
        startTimePicker: "#start-time",
        endTimePicker: "#end-time",
        html5: false,
        endTimeDisableMethod: "disable",
        durationMinutes: 0,
        pickerOptions: {}
    }
})(window.jQuery);