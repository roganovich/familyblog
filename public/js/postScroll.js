$('ul.pagination').hide();
$(function() {
    $('.infinite-scroll').jscroll({
        autoTrigger: true,
        debug: true,
        loadingHtml: '<img class="center-block" src="/images/loading.gif" alt="Loading..." />',
        padding: 0,
        nextSelector: '.pagination li.active + li a',
        contentSelector: '.infinite-scroll',
        callback: function() {
            $('ul.pagination').remove();
        }
    });
});