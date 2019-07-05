define([
    'uiComponent',
],function(uiComponent) {
    'use strict';

    return uiComponent.extend({
        customMethod: function () {
            return "Custom message " + this.message;
        }
    });
});