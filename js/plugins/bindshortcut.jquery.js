(function($, c) {
    $.fn.bindShortcut = function(buttons, keydown, keyup, object) {
        var pressed = {};
        if(!$.isArray(buttons)) buttons=[buttons];
        object = object || this;
        for (var i = 0, j = buttons.length; i < j; i++) {
            pressed[buttons[i]] = false;
        }
        var active = false;
        $(this).keydown(function(e) {
            if (buttons.indexOf(e.which) !== -1) {
                pressed[e.which] = true;
      
                for (var i = 0, j = buttons.length; i < j; i++) {

                    if (pressed[buttons[i]] === false) {
                        return false;
                    }
                }
                if (!active)
                    keydown.call(object, e);
                active = true;
            }
        }).keyup(function(e) {
            if (pressed[e.which]) {
                pressed[e.which] = false;
                if (active) {
                    active = false;
                    if(typeof keyup !== 'undefined')
                        keyup.call(object, e);
                    
                }
            }
        });
        return this;
    }
})(jQuery);
