(function($) {
    "use strict"; // Start of use strict

    // Toggle the side navigation
    $("#sidebarToggle").on('click', function(e) {
        e.preventDefault();
        // alert("hello where are you going")
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
    });

    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
        if ($(window).width() > 768) {
            var e0 = e.originalEvent,
                delta = e0.wheelDelta || -e0.detail;
            this.scrollTop += (delta < 0 ? 1 : -1) * 30;
            e.preventDefault();
        }
    });

    // Scroll to top button appear
    $(document).on('scroll', function() {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
            $('.scroll-to-top').fadeIn();
        } else {
            $('.scroll-to-top').fadeOut();
        }
    });

    // Smooth scrolling using jQuery easing
    $(document).on('click', 'a.scroll-to-top', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top)
        }, 1000, 'easeInOutExpo');
        event.preventDefault();
    });

    $('.back-btn').click(function(e) {
        e.preventDefault();
        window.history.back();
    });

    // alert("I am here from admin js");
    $('.delete_btn').click(function(e) {
        e.preventDefault();
        var msg = '';
        if ($(this).attr('msg')) {
            msg = $(this).attr('msg');
        } else {
            msg = "Do you want to delete?";
        } 
        Swal.fire({
            title: 'Are you sure?',
            text: msg,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Proceed!'
        }).then((result) => {
            if (result.value) {
                // Notifier.error('Action In Progress', 'Message');
                Swal.fire({
                    type: 'info',
                    title: 'Action In Progress',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 10000
                });
                $.get($(this).attr('href'), (res) => {
                    console.log(res);
                    var data = JSON.parse(res);
                    if (data.status == 1) {
                        Swal.fire({
                            title: 'Message',
                            text: data.msg,
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                if (data.redirect && data.redirect == 'reload') {
                                    window.location.reload();
                                } else if (data.redirect && data.redirect == 'noreload') {
                                    
                                } else if (!data.redirect) {
                                    window.location.reload();
                                } else {
                                    window.location.assign(data.redirect);
                                }
                            } else {
                                return false;
                            }
                        });
                    } else {
                        console.log(data);
                        Swal.fire(
                            'Message',
                            data.msg,
                            'error',
                        )
                    }
                });
            } else {
                return false;
            }
        })
    });


    $('.slink').click(function(e) {
        e.preventDefault();
        var msg = $(this).attr('msg');
        Swal.fire({
            title: 'Are you sure?',
            text: msg,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Proceed!'
        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    type: 'info',
                    title: 'Action In Progress',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 10000
                });
                $.get($(this).attr('href'), (res) => {
                    console.log(res);
                    var data = JSON.parse(res);
                    if (data.status == 1) {
                        Swal.fire({
                            title: 'Message',
                            text: data.msg,
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            console.log(data);
                            if (result.value) {
                                if (data.redirect && data.redirect == 'reload') {
                                    window.location.reload();
                                } else if (data.redirect && data.redirect == 'noreload') {
                                    
                                } else if (!data.redirect) {
                                    window.location.reload();
                                } else {
                                    window.location.assign(data.redirect);
                                }
                            } else {
                                return false;
                            }
                        });
                    } else {
                        // Notifier.error(data.msg, 'Message');
                        Swal.fire(
                            'Message',
                            data.msg,
                            'error'
                        )
                    }
                    console.log(data);
                });
            } else {
                return false;
            }
        });
    });


})(jQuery); // End of use strict
