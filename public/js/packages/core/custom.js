
var datetime = null,
    date = null;

var update = function () {
    date = moment(new Date());
    datetime.html(date.format('HH:mm'));
    datetime2.html(date.locale('pl'));
    datetime2.html(date.format('LL'));
};


$( document ).ready(function() {

    $('.trumbowyg').trumbowyg({
        btns: [
            ['viewHTML'],
            ['undo', 'redo'], // Only supported in Blink browsers
            ['formatting'],
            ['strong', 'em', 'del'],
            ['superscript', 'subscript'],
            ['link']
            ['insertImage'],
            ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
            ['unorderedList', 'orderedList'],
            ['horizontalRule'],
            ['removeformat'],
            ['fullscreen']
        ],
        svgPath: '/js/packages/core/plugins/trumbwyg/ui/icons.svg',
        semantic:false,
        removeformatPasted: true
    });


    datetime = $('h1.time');
    datetime2 = $('p.date');
    update();
    setInterval(update, 1000);




});
