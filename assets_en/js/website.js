    $(function () {

        "use strict";

        $('.navbar-light .navbar-nav .nav-item').on('click', function () {

            $(this).addClass('active').siblings().removeClass('active');
        });




        $('.list_donations .table i.icon-bin2.point.main_link_1.h5.transition-me').on('click', function () {

            var index = $('.list_donations .table tr').index(this);

            $('.list_donations .table tr').eq(index).fadeOut(500);

        });



//        strat common question

        $('.common i.plus').on('click', function () {

            var index = $('.common i.plus').index(this);

            $(this).toggleClass('icon-minus', 'icon-plus');
            $('.inside').eq(index).slideToggle(500);

        });

    });

