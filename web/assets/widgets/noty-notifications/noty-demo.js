$(function () {
    var a = [];
    a[""] = '<i class="glyph-icon icon-cog mrg5R"></i>This is a default notification message.', a.alert = '<i class="glyph-icon icon-cog mrg5R"></i>This is an alert notification message.', a.error = '<i class="glyph-icon icon-cog mrg5R"></i>This is an error notification message.', a.success = '<i class="glyph-icon icon-cog mrg5R"></i>You successfully read this important message.', a.information = '<i class="glyph-icon icon-cog mrg5R"></i>This is an information notification message!', a.notification = '<i class="glyph-icon icon-cog mrg5R"></i>This alert needs your attention, but it\'s for demonstration purposes only.', a.warning = '<i class="glyph-icon icon-cog mrg5R"></i>This is a warning for demonstration purposes.',
    $(".noty").click(function () {
        var b = $(this);
        return noty({
            text        : a[b.data("type")],
            type        : b.data("type"),
            dismissQueue: !0,
            theme       : "agileUI",
            layout      : b.data("layout")
        }), !1
    })
});