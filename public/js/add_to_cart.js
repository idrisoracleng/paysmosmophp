$(document).ready(function() {
    $('#add_to_cart').submit(function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        var cart_page = $(this).attr('cart_page');
        if (id == 'add_to_cart') {
            var msg = $(this).attr('msg');
            Swal.fire({
                type: 'info',
                title: msg,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 10000
            });
            // Notifier.info($(this).attr('msg'), 'Message');

            let url = $(this).attr('action');
            let type = $(this).attr('method');
            // let data = $(this).serializeArray();
            
            // alert(JSON.stringify(data));

            $.ajax({
                url: url, // Url to which the request is send
                type: type,             // Type of request to be send, called as method
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData:false,        // To send DOMDocument or non processed data file it is set to false
                success: (data) => {
                    console.log(data);
                    res = JSON.parse(data);
                    console.log(res);
                    if (res.status == 1) {
                        $("#cart_item_count").text(res.cart_item_count);
                        $("#cart_item_list").text(res.cart_item_list);
                        $("#add_to_cart_btn").addClass('disabled');
                        Swal.fire({
                            title: 'Message',
                            text: res.msg,
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'View Cart',
                            cancelButtonText: 'Continue Shopping'
                        }).then((result) => {
                            if (result.value) {
                                $('body').load(cart_page, {}, () => {
                                    window.history.pushState({}, 'PaySmoSmo | Buyer | My Cart', cart_page);
                                });
                            } else {
                                // if (res.redirect == 'reload') {
                                //     // window.location.reload();
                                //     $('body').load(window.location.href);
                                // } else if (res.redirect == 'noreload') {
                                    
                                // } else {
                                //     $('body').load(res.redirect);
                                //     // window.location.assign(res.redirect);
                                // }
                                // $('body').load(res)
                                return false;
                            }
                        });
                    }else{
                        // $.notify(res.msg, 'error');
                        Swal.fire(
                            'Message',
                            res.msg,
                            'error'
                        )
                        // Notifier.error(res.msg, 'Message');
                    }
                },
                error: (error) => {
                    Swal.fire(
                        'Message',
                        'Internal Server Error! Contact your engineer for solution',
                        'error'
                    )
                    console.log(JSON.stringify(error));
                }
            });
        }
    });
});