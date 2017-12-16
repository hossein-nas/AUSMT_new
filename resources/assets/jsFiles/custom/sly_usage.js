jQuery(function($){
    'use strict';
    var elem = $('section.slider').get().length;
    if (!elem)
        return ;
    // -------------------------------------------------------------
    //   Slider
    // -------------------------------------------------------------
    (function () {
        var $frame = $('section.slider');
        var $slidee = $frame.find('.slidee');
        var $next = $frame.find('.arrow .next')
        var $prev = $frame.find('.arrow .prev')
        var $pages = $frame.find('.pages')
        var $options = {
            slidee: $slidee,
            horizontal: 1,
            cycleBy: 'pages',
            cycleInterval: 7000,
            pauseOnHover: 1,
            keyboardNavBy: 'item',
            itemNav: 'basic',
            smart: 1,
            mouseDragging: 1,
            touchDragging: 1,
            releaseSwing: 1,
            speed: 1010,
            elasticBounds: 1,
            easing: 'easeInOutCubic',
            dragHandle: 1,
            dynamicHandle: 1,
            next: $next,
            prev: $prev,
            //pages
            pagesBar: $pages,
            pageBuilder: function (index) {
                return '<li>' + (index + 1) + '</li>';
            },
            activatePageOn: 'click',
        }
        var sly = new Sly($frame,$options);
        set_items_h_w($slidee)
        sly.init();
        $(window).on('resize',function () {
            set_items_h_w($slidee);
            sly.reload();
        })
     }());

    function set_items_h_w($slidee){
        var win_width = $(window).width();
        if(win_width<1200){
            var width = win_width+'px';
            var height = (win_width/1.6)+'px';
            $slidee.find('>.items').css({'width':width,'height':height})
            $slidee.parents('.slider').css({'width':width,'height':height})
        }
    }

    // -------------------------------------------------------------
    //   Fast Menu
    // -------------------------------------------------------------
    (function () {
        var $frame = $('section.fast-menu .frame');
        var $slidee = $frame.find('.slidee');
        var $next1 = $frame.parent().find('section.arrow-forward i')
        var $prev1 = $frame.parent().find('section.arrow-backward i')
        var $options = {
            cycleBy: 'pages',
            cycleInterval: 5000,
            pauseOnHover: 1,
            // keyboardNavBy: 'item',
            // itemNav: 'centered',
            smart: 1,
            mouseDragging: 1,
            touchDragging: 1,
            releaseSwing: 1,
            speed: 1010,
            elasticBounds: 1,
            easing: 'easeInOutCubic',
            dragHandle: 1,
            dynamicHandle: 1,
            nextPage: $next1,
            prevPage: $prev1,
        }
        if($(window).width()>768){
            $options.horizontal=1;
            $options.keyboardNavBy='item';
            $options.itemNav='centered';
        }
        var sly = new Sly($frame,$options);
        console.log(sly);
        sly.init();

        $(window).on('resize',function () {
            sly.reload();
        })
    }());


    // -------------------------------------------------------------
    //   Time Line
    // -------------------------------------------------------------
    (function () {
        var $frame = $('.timeline>.body');
        var $slidee = $frame.find('.slidee');
        var $scrollbar = $frame.find('.scrollbar');
        var $options = {
            cycleBy: 'pages',
            cycleInterval: 5000,
            slidee:$slidee,
            pauseOnHover: 1,
            smart: 1,
            // mouseDragging: 1,
            touchDragging: 1,
            releaseSwing: 1,
            speed: 500,
            elasticBounds: 1,
            easing: 'easeInOutCubic',
            dragHandle: 1,
            dynamicHandle: 1,
            scrollBar: $scrollbar,
            clickBar:  1,
            syncSpeed: 0.5
        }

        var sly = new Sly($frame,$options);
        sly.init();
        $(window).on('resize',function () {
            sly.reload();
        })
    }());


    // -------------------------------------------------------------
    //   Slideshow
    // -------------------------------------------------------------
    (function () {
        var $frame = $('.panel>.body.panel-horizontal-slideshow');
        var $slidee = $frame.find('.slidee');
        var $pages = $frame.find('.pages');
        var $options = {
            slidee: $slidee,
            horizontal: 1,
            cycleBy: 'pages',
            cycleInterval: 4000,
            pauseOnHover: 1,
            itemNav: 'basic',
            smart: 1,
            mouseDragging: 1,
            touchDragging: 1,
            releaseSwing: 1,
            speed: 777,
            elasticBounds: 1,
            easing: 'easeInOutBack',
            dragHandle: 1,
            dynamicHandle: 1,
            //pages
            pagesBar: $pages,
            pageBuilder: function (index) {
                return '<li class="item"></li>';
            },
            activatePageOn: 'click'
        }
        var sly = new Sly($frame,$options);
        sly.init();
        $(window).on('resize',function () {
            sly.reload();
        })
    }());




    // -------------------------------------------------------------
    //   Publications...
    // -------------------------------------------------------------
    (function () {
        var $frame = $('.publications>.body');
        var $wrapper = $frame.find('.wrapper');
        var $slidee = $frame.find('.slidee');
        var $scrollbar = $frame.find('.scrollbar');
        var $options = {
            slidee:$slidee,
            smart: 1,
            // mouseDragging: 1,
            touchDragging: 1,
            releaseSwing: 1,
            speed: 500,
            elasticBounds: 1,
            easing: 'easeInOutCubic',
            dragHandle: 1,
            dynamicHandle: 1,
            scrollBar: $scrollbar,
            clickBar:  1,
            syncSpeed: 0.5
        }

        var sly = new Sly($wrapper,$options);
        sly.init();
        $(window).on('resize',function () {
            sly.reload();
        })
    }());

});