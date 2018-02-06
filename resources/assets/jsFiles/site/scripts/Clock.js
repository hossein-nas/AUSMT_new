$(document).ready(function () {
    (function(){
        var box = $('.time-and-date ');
        var timeout;
        function time_updater() {
            var sep = box.find('.time .separator');
            sep.toggleClass('active')
            if( sep.hasClass('active') )
                sep.css('opacity',1)
            else
                sep.css('opacity',0);  
        }

        setInterval(time_updater,1000);
        setTime();
        function setTime(){
            var data = new FormData();
            data.append('min', box.find('.min').html());
            data.append('hour', box.find('.hour').html());
            data.append('weekday', box.find('.weekday').html());
            data.append('day', box.find('.day').html());
            data.append('month', box.find('.month').html());
            data.append('year', box.find('.year').html());
            console.log(box.find('.min').html() );

            $.ajax({
                url: '/getLocalTime',
                type: 'POST',
                timeout:60000,
                data:data,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    clearTimeout(timeout);
                    timeout = setTimeout(setTime,30000);
                },
                error:function (data) {
                    console.log(data);
                }
            }).done(function (a) {
                writeDate(box,a);
            });
            // timeout = setTimeout(setTime,60000);
        }

        function writeDate(box,obj){
            console.log(obj);
            box.find('.min').html( obj.min);
            box.find('.hour').html( obj.hour);
            box.find('.weekday').html( obj.weekdayName);
            box.find('.day').html( obj.day);
            box.find('.year').html( obj.year);
            box.find('.month').html( obj.month);
        }
    })();
});

