var datetime = null,
    date = null;

var update = function () {
    date = moment(new Date());
    datetime.html(date.format('HH:mm'));
};


$( document ).ready(function() {

    datetime = $('h1.time ');
    update();
    setInterval(update, 1000);

});
