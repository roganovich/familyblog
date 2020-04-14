try {
    window.$ = window.jQuery = require('jquery');

    $(document).ready(function(){
        console.log('Success!');

        $('.carousel').carousel({
            interval: 2000
        })
    });


} catch (e) {}

