window.vc_iframe = {
    scripts_to_wait: 0,
    time_to_call: !1,
    ajax: !1,
    activities_list: [],
    scripts_to_load: !1,
    loaded_script: {},
    loaded_styles: {},
    inline_scripts: [],
    inline_scripts_body: []
}, (p => {
    window.vc_iframe.showNoContent = function(e) {
        var t = p("#vc_no-content-helper");
        !1 === e ? (t.addClass("vc_not-empty"), p("#vc_navbar").addClass("vc_not-empty")) : (t.removeClass("vc_not-empty"), p("#vc_navbar").removeClass("vc_not-empty"))
    }, window.vc_iframe.scrollTo = function(e) {
        var t, a, o = p(window).height(),
            i = p(window).scrollTop();
        if (e && (e = p("[data-model-id=" + e + "]"))) {
            if (!1 === (a = !!(a = e.offset()) && a.top)) return !1;
            t = e.height(), (i + o < a || a + t < i) && p.scrollTo(e, 500, {
                offset: -50
            })
        }
    }, window.vc_iframe.startSorting = function() {
        p("body").addClass("vc_sorting")
    }, window.vc_iframe.stopSorting = function() {
        p("body").removeClass("vc_sorting")
        // START UNCODE EDIT	
        if (typeof event !== 'undefined' && typeof ui !== 'undefined') {	
            p(window).trigger("stopSorting", ui);	
        }	
        p('.vc_element[style*="display:"]').each(function() {	
            p(this)[0].style.display = null;	
        });	
        // END UNCODE EDIT	
    }, window.vc_iframe.initDroppable = function() {
        p("body").addClass("vc_dragging"), p(".vc_container-block").on("mouseenter.vcDraggable", function() {
            p(this).addClass("vc_catcher")
        }).on("mouseout.vcDraggable", function() {
            p(this).removeClass("vc_catcher")
        })
    }, window.vc_iframe.killDroppable = function() {
        p("body").removeClass("vc_dragging"), p(".vc_container-block").off("mouseover.vcDraggable mouseleave.vcDraggable")
    }, window.vc_iframe.addActivity = function(e) {
        this.activities_list.push(e)
    }, window.vc_iframe.renderPlaceholder = function(e, t) {
        var t = p(t).data("tag"),
            a = parent.vc.map[t] === Object(parent.vc.map[t]) && ((!0 === parent.vc.map[t].is_container || !1 === parent.vc.map[t].is_container || "[object Boolean]" === toString.call(parent.vc.map[t].is_container)) && !0 === parent.vc.map[t].is_container || null != parent.vc.map[t].as_parent && "[object Array]" === Object.prototype.toString.call(parent.vc.map[t].as_parent) && 0 != parent.vc.map[t].as_parent);
        return p('<div class="vc_helper vc_helper-' + t + '"><i class="vc_general vc_element-icon' + (parent.vc.map[t].icon ? " " + parent.vc.map[t].icon : "") + '"' + (a ? ' data-is-container="true"' : "") + "></i> " + parent.vc.map[t].name + "</div>").prependTo("body")
    }, window.vc_iframe.setSortable = function(e) {
        var c, s, d, a, o, i, l = window.vc_iframe,
            _ = (parent.vc.$page.addClass("vc-main-sortable-container"), p(parent.vc.$page));
        _.sortable({
            forcePlaceholderSize: !1,
            connectWith: !1,
            items: " > .wpb-content-wrapper > [data-tag=vc_row], > .wpb-content-wrapper > [data-tag=vc_section]",
            // START UNCODE EDIT	
            // handle: " > .vc_row .vc_move-vc_row, > .vc_controls .vc_element-move",	
            handle: ".vc_row .vc_move-vc_row, .vc_controls .vc_element-move",	
            appendTo: document.body,	
            // END UNCODE EDIT	
            cursor: "move",
            cursorAt: {
                top: 20,
                left: 16
            },
            placeholder: "vc_placeholder-row",
            cancel: ".vc-non-draggable-row",
            helper: l.renderPlaceholder,
            start: function(e, t) {
                window.vc_iframe.startSorting(), t.placeholder.height(30), "vc_section" === t.item.data("tag") ? (i && i.sortable("destroy"), a && a.sortable("destroy"), o && o.sortable("destroy"), _.sortable("option", "connectWith", !1)) : _.sortable("option", "connectWith", ['[data-tag="vc_section"] > .vc_element-container']), _.sortable("refresh")
            },
            stop: function(e, t) {
                var a, o, i, n, r;
                l.stopSorting(), "vc_section" === (a = t.item.data("tag")) && (c(), s(), d()), _.sortable("option", "connectWith", !1), _.sortable("refresh"), o = window.parent.vc.map || !1, n = !0, (i = t.item.parents("[data-tag]:first").data("tag")) && (r = o[i].allowed_container_element || !0, window.parent.vc.checkRelevance(i, a) || (t.placeholder.removeClass("vc_hidden-placeholder"), p(this).sortable("cancel"), n = !1), o[a] === Object(o[a])) && ((!0 === o[a].is_container || !1 === o[a].is_container || "[object Boolean]" === toString.call(o[a].is_container)) && !0 === o[a].is_container || null != o[a].as_parent && "[object Array]" === Object.prototype.toString.call(o[a].as_parent) && 0 != o[a].as_parent) && !0 !== r && r !== a.replace(/_inner$/, "") && (t.placeholder.removeClass("vc_hidden-placeholder"), p(this).sortable("cancel"), n = !1), n && parent.vc.shortcodes.get(t.item.data("modelId")).view.parentChanged()
            },
            tolerance: "pointer",
            update: function(e, t) {
                parent.vc.app.saveRowOrder(e, t)
            }
        }), d = function() {
            o = p(".vc_element-container:not(.vc_section)").sortable({
                forcePlaceholderSize: !0,
                helper: l.renderPlaceholder,
                distance: 3,
                scroll: !0,
                scrollSensitivity: 70,
                cursor: "move",
                cursorAt: {
                    top: 20,
                    left: 16
                },
                connectWith: ".vc_element-container:not(.vc_section)",
                items: "> [data-model-id]",
                cancel: ".vc-non-draggable",
                handle: ".vc_element-move",
                // START UNCODE EDIT	
                appendTo: document.body,	
                // END UNCODE EDIT	
                start: function(event, ui) {	
                    l.startSorting	
                    // START UNCODE EDIT	
                    if (!p(this).find('> .vc_element:visible').length) {	
                        p(this).closest('.vc_element').addClass('vc_empty').find('> *').addClass('vc_empty-element');	
                    }	
                    // END UNCODE EDIT	
                },
                start: l.startSorting,
                update: e.saveElementOrder,
                change: function(e, t) {
                    t.placeholder.height(30), t.placeholder.width(t.placeholder.parent().width())
                },
                placeholder: "vc_placeholder",
                tolerance: "pointer",
                over: function(e, t) {
                    // START UNCODE EDIT	
                    p(".vc_row[data-parent]").removeClass('uncode_vc_move_over');	
                    t.placeholder.closest(".vc_row[data-parent]").addClass('uncode_vc_move_over');	
                    // END UNCODE EDIT	
                    var a = t.item.data("tag"),
                        o = window.parent.vc.map || !1,
                        i = t.placeholder.closest("[data-tag]").data("tag"),
                        n = void 0 === o[i].allowed_container_element || o[i].allowed_container_element;
                    t.placeholder.removeClass("vc_hidden-placeholder"), t.placeholder.css({
                        maxWidth: t.placeholder.parent().width()
                    }), a && o && (window.parent.vc.checkRelevance(i, a) || t.placeholder.addClass("vc_hidden-placeholder"), t.sender && (i = t.sender.closest(".vc_element").removeClass("vc_sorting-over")).find(".vc_element").length < 1 && i.addClass("vc_empty"), t.placeholder.closest(".vc_element").addClass("vc_sorting-over"), o[a] === Object(o[a])) && ((!0 === o[a].is_container || !1 === o[a].is_container || "[object Boolean]" === toString.call(o[a].is_container)) && !0 === o[a].is_container || null != o[a].as_parent && "[object Array]" === Object.prototype.toString.call(o[a].as_parent) && 0 != o[a].as_parent) && !0 !== n && n !== a.replace(/_inner$/, "") && t.placeholder.addClass("vc_hidden-placeholder")
                },
                out: function(e, t) {
                    t.placeholder.removeClass("vc_hidden-placeholder"), t.placeholder.closest(".vc_element").removeClass("vc_sorting-over")
                },
                stop: function(e, t) {
                    // START UNCODE EDIT	
                    p(".vc_row[data-parent]").removeClass('uncode_vc_move_over');	
                    if (p(this).find('> .vc_element:visible').length) {	
                        p(this).closest('.vc_element').removeClass('vc_empty').find('> *').removeClass('vc_empty-element');	
                    }	
                    // END UNCODE EDIT	
                    var a = t.item.data("tag"),
                        o = window.parent.vc.map || !1,
                        i = t.item.parents("[data-tag]:first").data("tag"),
                        // START UNCODE EDIT	
                        n = void 0 === o[i].allowed_container_element || o[i].allowed_container_element,	
                        // n = o[i].allowed_container_element || !0,
                        // END UNCODE EDIT	
                        r = !0;
                    window.parent.vc.checkRelevance(i, a) || (t.placeholder.removeClass("vc_hidden-placeholder"), p(this).sortable("cancel"), r = !1), o[a] === Object(o[a]) && ((!0 === o[a].is_container || !1 === o[a].is_container || "[object Boolean]" === toString.call(o[a].is_container)) && !0 === o[a].is_container || null != o[a].as_parent && "[object Array]" === Object.prototype.toString.call(o[a].as_parent) && 0 != o[a].as_parent) && !0 !== n && n !== a.replace(/_inner$/, "") && (t.placeholder.removeClass("vc_hidden-placeholder"), p(this).sortable("cancel"), r = !1), r && parent.vc.shortcodes.get(t.item.data("modelId")).view.parentChanged(), window.vc_iframe.stopSorting()
                }
            })
        }, s = function() {
            a = p(".wpb_row").sortable({
                forcePlaceholderSize: !0,
                tolerance: "pointer",
                items: "> [data-tag=vc_column], > [data-tag=vc_column_inner]",
                handle: "> .vc_controls .vc_move-vc_column",
                // START UNCODE EDIT	
                appendTo: document.body,	
                // END UNCODE EDIT	
                start: function(e, t) {
                    window.vc_iframe.startSorting();
                    // START UNCODE EDIT	
                    var a = t.item.data("modelId"),
                    // var a = t.item.data("modelId"),
                            // a = parent.vc.shortcodes.get(a),
                            // a = a.view.convertSize(a.getParam("width"));
                        model = parent.vc.shortcodes.get(a),	
                        css_class = '',	
                        prev_class = model.view.$el.attr('class'),	
                        rx_class_widths = /(?:^|\s)((col-lg-|col-md-|col-sm-)[0-9]\w*)/gi,	
                        rx_class_widths_results = prev_class.match(rx_class_widths),	
                        i_rx;	
                    for (i_rx = 0; i_rx < rx_class_widths_results.length; i_rx++) {	
                        css_class += ' ' + rx_class_widths_results[i_rx];	
                    }	
                    // END UNCODE EDIT
                    t.item.appendTo(t.item.parent().parent()), t.placeholder.addClass(a), t.placeholder.width(t.placeholder.width() - 4)
                },
                cursor: "move",
                cursorAt: {
                    top: 20,
                    left: 16
                },
                stop: function(e, t) {
                    window.vc_iframe.stopSorting(e, t)
                },
                update: e.saveColumnOrder,
                placeholder: "vc_placeholder-column",
                helper: l.renderPlaceholder
            })
        }, (c = function() {
            i = p('[data-tag="vc_section"] > .vc_element-container').sortable({
                forcePlaceholderSize: !1,
                connectWith: [".vc-main-sortable-container", '[data-tag="vc_section"] > .vc_element-container'],
                items: '[data-tag="vc_row"]',
                handle: "> .vc_row .vc_move-vc_row",
                cursor: "move",
                cursorAt: {
                    top: 20,
                    left: 16
                },
                placeholder: "vc_placeholder-row",
                cancel: ".vc-non-draggable-row",
                // START UNCODE EDIT	
                appendTo: document.body,	
                // END UNCODE EDIT	
                helper: l.renderPlaceholder,
                start: function(e, t) {
                    window.vc_iframe.startSorting(), t.placeholder.height(30)
                },
                stop: function(e, t) {
                    var a, o = t.item.data("tag"),
                        i = window.parent.vc.map || !1,
                        n = t.item.parents("[data-tag]:first").data("tag"),
                        r = !0;
                    n && (a = i[n].allowed_container_element || !0, window.parent.vc.checkRelevance(n, o) || (t.placeholder.removeClass("vc_hidden-placeholder"), p(this).sortable("cancel"), r = !1), i[o] === Object(i[o])) && ((!0 === i[o].is_container || !1 === i[o].is_container || "[object Boolean]" === toString.call(i[o].is_container)) && !0 === i[o].is_container || null != i[o].as_parent && "[object Array]" === Object.prototype.toString.call(i[o].as_parent) && 0 != i[o].as_parent) && !0 !== a && a !== o.replace(/_inner$/, "") && (t.placeholder.removeClass("vc_hidden-placeholder"), p(this).sortable("cancel"), r = !1), r && parent.vc.shortcodes.get(t.item.data("modelId")).view.parentChanged(), l.stopSorting()
                },
                tolerance: "pointer",
                update: function(e, t) {
                    parent.vc.app.saveRowOrder(e, t)
                },
                over: function(e, t) {
                    var a = t.item.data("tag"),
                        o = window.parent.vc.map || !1,
                        i = t.placeholder.closest("[data-tag]").data("tag"),
                        n = void 0 === o[i].allowed_container_element || o[i].allowed_container_element;
                    t.placeholder.removeClass("vc_hidden-placeholder"), t.placeholder.css({
                        maxWidth: t.placeholder.parent().width()
                    }), a && o && (window.parent.vc.checkRelevance(i, a) || t.placeholder.addClass("vc_hidden-placeholder"), t.sender && (i = t.sender.closest(".vc_element").removeClass("vc_sorting-over")).find(".vc_element").length < 1 && i.addClass("vc_empty"), t.placeholder.closest(".vc_element").addClass("vc_sorting-over"), o[a] === Object(o[a])) && ((!0 === o[a].is_container || !1 === o[a].is_container || "[object Boolean]" === toString.call(o[a].is_container)) && !0 === o[a].is_container || null != o[a].as_parent && "[object Array]" === Object.prototype.toString.call(o[a].as_parent) && 0 != o[a].as_parent) && !0 !== n && n !== a.replace(/_inner$/, "") && t.placeholder.addClass("vc_hidden-placeholder")
                },
                out: function(e, t) {
                    t.placeholder.removeClass("vc_hidden-placeholder"), t.placeholder.closest(".vc_element").removeClass("vc_sorting-over")
                }
            })
        })(), d(), s(), _.disableSelection(), _.on("mouseenter", "select", function() {
            _.enableSelection()
        }), _.on("mouseleave", "select", function() {
            _.disableSelection()
        }), _.on("focus", 'input[type="text"],textarea', function() {
            _.enableSelection()
        }), _.on("blur", 'input[type="text"],textarea', function() {
            _.disableSelection()
        }), e.setFrameSize(), p("#vc_load-new-js-block").appendTo("body")
    }, window.vc_iframe.loadCustomCss = function(e) {
        vc_iframe.$custom_style || (p("[data-type=vc_custom-css]").remove(), window.vc_iframe.$custom_style = p('<style class="vc_post_custom_css_style"></style>').appendTo("body")), window.vc_iframe.$custom_style.html(e.replace(/(<([^>]+)>)/gi, ""))
    }, window.vc_iframe.loadCustomJsHeader = function(e) {
        var t = p("[data-type=vc_custom-js-header]");
        t.length && e ? (t.empty(), t.html(e)) : e ? window.vc_iframe.$custom_js_footer = p('<script data-type="vc_custom-js-header">' + e + "<\/script>").appendTo("head") : t.remove()
    }, window.vc_iframe.loadCustomJsFooter = function(e) {
        var t = p("[data-type=vc_custom-js-footer]");
        t.length ? (t.empty(), t.html(e)) : e ? window.vc_iframe.$custom_js_footer = p('<script data-type="vc_custom-js-footer">' + e + "<\/script>").appendTo("body") : t.remove()
    }, window.vc_iframe.setCustomShortcodeCss = function(e) {
        this.$shortcodes_custom_css = p("body > [data-type=vc_shortcodes-custom-css]"), this.$shortcodes_custom_css.length || (this.$shortcodes_custom_css = p('<style data-type="vc_shortcodes-custom-css"></style>').prependTo("body")), this.$shortcodes_custom_css.append(e)
    }, window.vc_iframe.setDefaultShortcodeCss = function(e, t) {
        this.$shortcodes_custom_css = p("head > [data-type=vc_shortcodes-default-css]"), this.$shortcodes_custom_css.length || (this.$shortcodes_custom_css = p('<style data-type="vc_shortcodes-default-css"></style>').prependTo("head"));
        var a = this.$shortcodes_custom_css[0].innerHTML;
        a && -1 !== a.indexOf(t) || this.$shortcodes_custom_css.append(e)
    }, window.vc_iframe.addInlineScript = function(e) {
        return this.inline_scripts.push(e) - 1
    }, window.vc_iframe.addInlineScriptBody = function(e) {
        return this.inline_scripts_body.push(e) - 1
    }, window.vc_iframe.loadInlineScripts = function() {
        for (var e = 0; this.inline_scripts[e];) p(this.inline_scripts[e]).insertAfter(".js_placeholder_" + e), p(".js_placeholder_" + e).remove(), e++;
        this.inline_scripts = []
    }, window.vc_iframe.loadInlineScriptsBody = function() {
        for (var e = 0; this.inline_scripts_body[e];) p(this.inline_scripts_body[e]).insertAfter(".js_placeholder_inline_" + e), p(".js_placeholder_inline_" + e).remove(), e++;
        this.inline_scripts_body = []
    }, window.vc_iframe.allowedLoadScript = function(e) {
        var t, a, o, i = [],
            n = [];
        if (e.match(/load\-scripts\.php/)) {
            for (t in i = (a = e.match(/load%5B%5D=([^&]+)/)[1]) ? a.split(",") : i) o = "load-script:" + i[t], vc_iframe.loaded_script[window.parent.vc_globalHashCode(o)] || (window.vc_iframe.loaded_script[window.parent.vc_globalHashCode(o)] = o, n.push(i[t]));
            return !!n.length && e.replace(/load%5B%5D=[^&]+/, "load%5B%5D=" + n.join(","))
        }
        return !vc_iframe.loaded_script[window.parent.vc_globalHashCode(e)] && (window.vc_iframe.loaded_script[window.parent.vc_globalHashCode(e)] = e)
    }, window.vc_iframe.collectScriptsData = function() {
        p("script[src]").each(function() {
            var e = p(this).attr("src");
            window.vc_iframe.loaded_script[window.parent.vc_globalHashCode(e)] = e
        }), p("link[href]").each(function() {
            var e = p(this).attr("href");
            window.vc_iframe.loaded_styles[window.parent.vc_globalHashCode(e)] = e
        })
    }, p("body").removeClass("admin-bar"), p(document).ready(function() {
        p("#wpadminbar").hide(), p(".edit-link").hide(), window.parent.vc && !window.parent.vc.loaded && window.parent.vc.build && window.parent.vc.build()
    }), window.vc_iframe.reload = function() {
        for (var e in window.vc_iframe.reload_safety_call = !1, p("a:not(.control-btn),form").each(function() {
                p(this).attr("target", "_blank")
            }), this.collectScriptsData(), this.loadInlineScripts(), this.loadInlineScriptsBody(), this.activities_list) this.activities_list[e].call(window);
        return this.activities_list = [], window.setTimeout(function() {
            window.vc_teaserGrid(), window.vc_carouselBehaviour(), window.vc_prettyPhoto(), window.vc_googleplus(), window.vc_pinterest(), window.vc_progress_bar(), window.vc_rowBehaviour(), window.vc_waypoints(), window.vc_gridBehaviour(), window.vc_googleMapsPointer(), p(window).trigger("vc_reload"), p(window).trigger("resize")
        }, 10), !0
    }, window.vc_iframe.addScripts = function(e) {
        window.vc_iframe.scripts_to_wait = e.length, window.vc_iframe.scripts_to_load = e
    }, window.vc_iframe.addStyles = function(e) {
        window.jQuery("body").append(e)
    }, window.vc_iframe.loadScripts = function() {
        vc_iframe.scripts_to_wait && vc_iframe.scripts_to_load ? (window.vc_iframe.scripts_to_load.each(function() {
            var e = p(this);
            if (window.vc_iframe.reload_safety_call = !0, e.is("script")) {
                var t = e.attr("src");
                if (t)(t = vc_iframe.allowedLoadScript(t)) ? p.getScript(t, function() {
                    --window.vc_iframe.scripts_to_wait, vc_iframe.scripts_to_wait < 1 && window.vc_iframe.reload()
                }) : (--window.vc_iframe.scripts_to_wait, vc_iframe.scripts_to_wait < 1 && window.vc_iframe.reload());
                else {
                    try {
                        window.jQuery("body").append(e)
                    } catch (e) {
                        window.console && window.console.warn && window.console.warn("loadScripts error", e)
                    }--window.vc_iframe.scripts_to_wait, vc_iframe.scripts_to_wait < 1 && vc_iframe.reload()
                }
            } else {
                t = e.attr("href");
                t && !vc_iframe.loaded_styles[window.parent.vc_globalHashCode(t)] && window.jQuery("body").append(e), --window.vc_iframe.scripts_to_wait, vc_iframe.scripts_to_wait < 1 && window.vc_iframe.reload()
            }
        }), window.vc_iframe.scripts_to_load = !1, p(document).ajaxComplete(function(e) {
            p(e.currentTarget).off("ajaxComplete"), window.vc_iframe.scripts_to_wait || vc_iframe.reload()
        }), window.setTimeout(function() {
            !0 === vc_iframe.reload_safety_call && vc_iframe.reload()
        }, 14e3)) : window.vc_iframe.reload()
    }, window.vc_iframe.destroyTabs = function(e) {
        e.each(function() {
            p(this).find(".wpb_tour_tabs_wrapper").tabs("destroy")
        })
    }, window.vc_iframe.buildTabs = function(e, o) {
        var t = p.ui.version.split("."),
            i = 1 === parseInt(t[0], 10) && parseInt(t[1], 10) < 9;
        return e.each(function() {
            p(this).attr("data-interval");
            var a, e = [],
                t = p(this).find(".wpb_tour_tabs_wrapper");
            t.hasClass("ui-widget") ? (o = !1 !== o ? o : t.tabs("option", "active"), a = t.tabs("refresh"), t.tabs("option", "active", o)) : a = p(this).find(".wpb_tour_tabs_wrapper").tabs({
                active: 0,
                show: function(e, t) {
                    wpb_prepare_tab_content(e, t)
                },
                activate: function(e, t) {
                    wpb_prepare_tab_content(e, t)
                }
            }), p(this).find(".vc_element").each(function() {
                e.push(this.id)
            }), p(this).find(".wpb_prev_slide a, .wpb_next_slide a").off("click").on("click", function(e) {
                var t;
                e && e.preventDefault && e.preventDefault(), i ? (t = a.tabs("option", "selected"), p(this).parent().hasClass("wpb_next_slide") ? t++ : t--, t < 0 ? t = a.tabs("length") - 1 : t >= a.tabs("length") && (t = 0), a.tabs("select", t)) : (t = a.tabs("option", "active"), e = a.find(".wpb_tab").length, t = p(this).parent().hasClass("wpb_next_slide") ? e <= t + 1 ? 0 : t + 1 : t - 1 < 0 ? e - 1 : t - 1, a.tabs("option", "active", t))
            })
        }), !0
    }, window.vc_iframe.setActiveTab = function(e, t) {
        // START UNCODE EDIT	
        var $active_tab = $(e.context).find("[data-tab-id]:eq(" + t + ")").addClass('active'),	
            active_id = $active_tab.attr('data-tab-id'),	
            $active_panel = $(e.context).find("#" + active_id).addClass('active').addClass('in');	
        // END UNCODE EDIT	
        e.each(function() {
            p(this).find(".wpb_tour_tabs_wrapper").tabs("refresh"), p(this).find(".wpb_tour_tabs_wrapper").tabs("option", "active", t)
        })
    }, window.vc_iframe.setTabsSorting = function(e) {
        var t = p(e.tabsControls().get(0));
        // START UNCODE EDIT	
        var params = e.model.get("params")	
        // END UNCODE EDIT	
        t.hasClass("ui-sortable") && t.sortable("destroy"), t.sortable({
            // START UNCODE EDIT	
            appendTo: document.body,	
            axis: "yes" === params.vertical ? "y" : "x",	
            // END UNCODE EDIT	
            update: e.stopSorting,
            items: "> li:not(.add_tab_block)"
        // START UNCODE EDIT	
        //}), navigator.userAgent.toLowerCase().match(/firefox/) && (t.bind("sortstart", function(e, t) {
        }), "yes" === params.vertical && (t.bind("sortstart", function(event, ui) {	
        // END UNCODE EDIT	
            t.helper.css("margin-top", p(window).scrollTop())
        }), t.bind("sortbeforestop", function(e, t) {
            t.helper.css("margin-top", 0)
        }))
    }, window.vc_iframe.buildAccordion = function(e, i) {
        e.each(function() {
            var e = p(this),
                t = e.find(".wpb_accordion_wrapper"),
                a = (e.attr("data-interval"), !isNaN(e.data("active-tab")) && 0 < parseInt(e.data("active-tab"), 10) && parseInt(e.data("active-tab"), 10) - 1),
                o = !1 === a || "yes" === e.data("collapsible");
            t.hasClass("ui-widget") ? (!1 === i && (i = t.accordion("option", "active")), t.accordion("refresh"), t.accordion("option", "active", i)) : e.find(".wpb_accordion_wrapper").accordion({
                create: function(e, t) {
                    t.panel.parent().parent().addClass("vc_active-accordion-tab")
                },
                header: "> .vc_element > div > h3",
                autoHeight: !1,
                heightStyle: "content",
                active: a,
                collapsible: o,
                navigation: !0,
                activate: function(e, t) {
                    vc_accordionActivate(e, t), t.oldPanel.parent().parent().removeClass("vc_active-accordion-tab"), t.newPanel.parent().parent().addClass("vc_active-accordion-tab")
                },
                change: function(e, t) {
                    void 0 !== p.fn.isotope && t.newContent.find(".isotope").isotope("layout"), window.vc_carouselBehaviour()
                }
            })
        })
    }, window.vc_iframe.setAccordionSorting = function(e) {
        p(e.$accordion.find("> .wpb_accordion_wrapper").get(0)).sortable({
            handle: ".vc_move-vc_accordion_tab",
            update: e.stopSorting
        })
    }, window.vc_iframe.vc_imageCarousel = function(e) {
        var t = p("[data-model-id=" + e + "]"),
            t = (t.find("img").length, t.find('[data-ride="vc_carousel"]'));
        !t.find("img:first").length || t.find("img:first").prop("complete") ? t.carousel(t.data()) : window.setTimeout(function() {
            window.vc_iframe.vc_imageCarousel(e)
        }, 500)
    }, window.vc_iframe.vc_gallery = function(e) {
        var t = p("[data-model-id=" + e + "]").find(".wpb_gallery_slides");
        t.find("img:first").prop("complete") ? this.gallerySlider(t) : window.setTimeout(function() {
            window.vc_iframe.vc_gallery(e)
        }, 500)
    }, window.vc_iframe.vc_postsSlider = function(e) {
        e = p("[data-model-id=" + e + "]").find(".wpb_gallery_slides");
        this.gallerySlider(e)
    }, window.vc_iframe.gallerySlider = function(e) {
        var t, a, o, i;
        e.hasClass("wpb_flexslider") ? (t = 1e3 * parseInt(e.attr("data-interval"), 10), a = e.attr("data-flex_fx"), o = !0, e.flexslider({
            animation: a,
            slideshow: o = 0 === t ? !1 : o,
            slideshowSpeed: t,
            sliderSpeed: 800,
            smoothHeight: !0
        }), e.addClass("loaded")) : e.hasClass("wpb_slider_nivo") ? (0 === (t = 1e3 * e.attr("data-interval")) && (t = 9999999999), e.find(".nivoSlider").nivoSlider({
            effect: "boxRainGrow,boxRain,boxRainReverse,boxRainGrowReverse",
            slices: 15,
            boxCols: 8,
            boxRows: 4,
            animSpeed: 800,
            pauseTime: t,
            startSlide: 0,
            directionNav: !0,
            directionNavHide: !0,
            controlNav: !0,
            keyboardNav: !1,
            pauseOnHover: !0,
            manualAdvance: !1,
            prevText: "Prev",
            nextText: "Next"
        })) : e.hasClass("wpb_image_grid") && (p.fn.imagesLoaded ? i = e.find(".wpb_image_grid_ul").imagesLoaded(function() {
            i.isotope({
                itemSelector: ".isotope-item",
                layoutMode: "fitRows"
            })
        }) : e.find(".wpb_image_grid_ul").isotope({
            itemSelector: ".isotope-item",
            layoutMode: "fitRows"
        }))
    }, window.vc_iframe.vc_toggle = function(e) {
        e = p("[data-model-id=" + e + "]");
        window.vc_toggleBehaviour(e)
    }, window.vc_iframe.vc_tta_toggle = function(e) {
        e = p("[data-model-id=" + e + "]");
        window.vc_ttaToggleBehaviour(e)
    }, window.vc_iframe.gridInit = function(e) {
        var t, e = p("[data-model-id=" + e + "] [data-vc-grid-settings]");
        e.find(".vc_grid-loading:visible").length || ((t = e.data("vcGrid")) ? (e.empty(), t.init()) : e.vcGrid())
    }, window.vc_iframe.updateChildGrids = function(e) {
        p("[data-model-id=" + e + "] [data-vc-grid-settings]").each(function() {
            var e = p(this),
                t = p(this).data("vcGrid");
            !e.find(".vc_grid-loading:visible").length && t && (e.empty(), t.init())
        })
    }, window.vc_iframe.buildTTA = function() {
        p("[data-vc-accordion]:not(.vc_is-ready-fe)").on("show.vc.accordion", function(e) {
            var t = {};
            t.newPanel = p(this).data("vc.accordion").getTarget(), window.wpb_prepare_tab_content(e, t)
        }).addClass("vc_is-ready-fe")
    }, window.vc_iframe.vc_pieChart = function() {
        window.vc_pieChart(), window.setTimeout(function() {
            p(window).off("resize.vcPieChartEditable").on("resize.vcPieChartEditable", function() {
                p(".vc_pie_chart.vc_ready").vcChat()
            })
        }, 500)
    }, p(document).ready(function() {
        parent && parent.vc && !parent.vc.loaded && window.setTimeout(function() {
            parent.vc.build()
        }, 10)
    })
})(window.jQuery);
(o => {
    var t = function(t, n, i) {
        this.target = t, this.$pointer = null, this.texts = i, this.pointerOptions = n, this.init()
    };
    t.prototype = {
        init: function() {
            _.bindAll(this, "openedEvent", "reposition")
        },
        show: function() {
            this.$pointer = o(this.target), this.$pointer.data("vcPointerMessage", this), this.pointerOptions.opened = this.openedEvent, this.$pointer.addClass("vc-with-vc-pointer").pointer(this.pointerOptions).pointer("open"), o(window).on("resize.vcPointer", this.reposition)
        },
        domButtonsWrapper: function() {
            return o('<div class="vc_wp-pointer-controls" />')
        },
        domCloseBtn: function() {
            return o('<a class="vc_pointer-close close">' + this.texts.finish + "</a>")
        },
        domNextBtn: function() {
            return o('<button class="button button-primary button-large vc_wp-pointers-next">' + this.texts.next + '<i class="vc_pointer-icon"></i></button>')
        },
        domPrevBtn: function() {
            return o('<button class="button button-primary button-large vc_wp-pointers-prev"><i class="vc_pointer-icon"></i>' + this.texts.prev + "</button> ")
        },
        openedEvent: function(t, n) {
            var i = n.pointer.offset();
            n.pointer.css("z-index", 1e5), i && i.top && o("body").scrollTop(80 < i.top ? i.top - 80 : 0)
        },
        reposition: function() {
            this.$pointer.pointer("reposition")
        },
        close: function() {
            this.$pointer && this.$pointer.removeClass("vc-with-vc-pointer").pointer("close"), o(window).off("resize.vcPointer")
        }
    }, window.vcPointerMessage = t
})(window.jQuery);