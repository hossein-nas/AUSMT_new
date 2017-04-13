$(document).ready(function () {
    function time_updater() {
        var time = $('.time-box .time .seperator');
        if(time.css('opacity')==1)
            time.css({'opacity':0});
        else
            time.css({'opacity':1});
    }
    setInterval(time_updater,1000);
    setTime();
    function setTime(){
        var data = new FormData();
        data.append('day', $('.time-box .date span').html());
        data.append('weekDayName',$('.time-box .day').html());
        data.append('hour',$('.time-box .time .hour').html());
        data.append('min',$('.time-box .time .min').html());
        $.ajax({
            url: '/getLocalTime/',
            type: 'POST',
            timeout:60000,
            data:data,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
            },
            error:function () {
                console.log("time_updater fail.");
            }
        }).done(function (a) {
            var hour =$.parseJSON(a).hour;
            var min =$.parseJSON(a).min;
            var weekDayName =$.parseJSON(a).weekDayName;
            var day =$.parseJSON(a).day;
            $('.time-box .date span').html(day);
            $('.time-box .day').html(weekDayName);
            $('.time-box .time .hour').html(hour);
            $('.time-box .time .min').html(min);
        });
        setTimeout(setTime,60000);
    }
});

