require('slick');

global.jQuery = require('jquery');
global.$ = require('jquery');

(function () {
    wow = new WOW(
        {
            boxClass: 'wow',      // default
            animateClass: 'animated', // default
            offset: 150,          // default
            mobile: true,       // default
            live: true        // default
        }
    )
    wow.init();
})();