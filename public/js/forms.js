$(document).ready(function(){
    // alert('i from forms.js');
    
    $('form').submit(function(e){
        
        var id = $(this).attr('class');
		console.log(id);
        if (id == 'search_form') {
            console.log(id);
        }else if (id == 'add_to_cart') {

            e.preventDefault();
        } else if (id == 'filter_form') {
            e.preventDefault();
            $("#filter_modal").modal('hide');
            var swal = Swal.fire(
                {
                    title: 'Applying filter to search...',
                    showConfirmButton: false,
                    toast: true,
                    position: 'center',
                    showCancelButton: true,
                }
            );
            var filter_result_view = $("#filter_result_view"); 
            let datar = $(this).serialize();
            var url = $(this).attr('action');
            $.get(url, datar, (data) => {
                swal.close();
                filter_result_view.html(data);
            }).fail((error) => {
                swal.close();
                console.log(error);
            })
		} else if (id == 'my-search') {
            e.preventDefault();
			window.location.href = $(this).attr('action') + '/' + $('input[name="search-mobile"]').val();	
        } else {
            e.preventDefault();
            var msg = $(this).attr('msg');
            Swal.fire({
                title: msg,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
            });

            let url = $(this).attr('action');
            let type = $(this).attr('method');

            $.ajax({
                timeout: 0,
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
                    Swal.fire({
                        title: 'Message',
                        text: res.msg,
                        icon: (res.status == 0) ? 'error' : 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        if (result.value) {
                            if (res.redirect == 'reload') {
                                window.location.reload();
                            } else if (res.redirect == 'noreload') {
                                
                            } else {
                                window.location.assign(res.redirect);
                            }
                        } else {
                            return false;
                        }
                    });
                },
                error: (xhr, error) => {
                    console.log(xhr);
                    Swal.fire(
                        'Message',
                        (xhr.status == 500) ? 'Internal Server Error' : (xhr == 404) ? 'Resources not found' : (xhr.status == 0) ? 'Internet Connection Is Lost' : xhr.statusText,
                        'error'
                    )
                    console.log(JSON.stringify(xhr));
                }
            });
        }
    });

    $("#imagetoupload").change(function() {
        console.log("File have been changed");
        // $("#message").empty(); // To remove the previous error message
        var file = this.files[0];
        var imagefile = file.type;
        var match= ["image/jpeg","image/png","image/jpg"];
        if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
            $('#previewing').attr('src','noimage.png');
            // $("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
            return false;
        }else{
            // console.log(this.files[0]);
            $('#image_preview').empty();
            $.each(this.files, (index, value)=>{
                var imgtag = document.createElement('img');
                var id = document.createAttribute('id');
                var style = document.createAttribute('style');
                id.value = 'prev'+index;
                style.value = 'height: 150px; width: 200px; margin: 5px; border: 5px solid red;';
                imgtag.setAttributeNode(id);
                imgtag.setAttributeNode(style);
                $('#image_preview').append(imgtag);
                console.log(imgtag);
                var reader = new FileReader();
                reader.onload = (e) => {
                    console.log(e);
                    $('#image_preview').css("display", "block");
                    $('#prev'+index).attr('src', e.target.result);
                };
                reader.readAsDataURL(this.files[index]);
            });
        }
    });

    $(".order_options").change(function(){
        // alert($(this).val());
        // $.notify('Changing Order Status', 'info', {autoHide: hide, clickToHide: true,});
        Notifier.info('Changing Order Status', 'Message');
        let url = $(this).attr('url');
        var data = {
            'status': $(this).val(),
        }
        $.post(url, data, function(data){
            console.log(data);
            res = JSON.parse(data);
            // console.log(res);
            if(res.status == 1){
                // $.notify(res.msg, 'success');
                Notifier.success(res.msg, 'Message');
                if(res.redirect){
                    if(res.redirect == 'reload'){
                        window.location.reload();
                    }else
                    if(res.redirect == 'noreload'){
                        
                    }else{
                        setTimeout(()=>{
                            window.location.assign(res.redirect);
                        }, 3000);
                    }
                }
            }else{
                // $.notify(res.msg, 'error');
                Notifier.error(res.msg, 'Message');
            }
        });
    });
});

