$(document).ready(function(){
     
    
    $('form').submit(function(e){
		
        e.preventDefault();
		//alert('i from forms.js');
		//alert($(this).attr('action'));
		//alert($(this).attr('search-mobile'));
		//let data = $(this).serializeArray();
            
          //alert(JSON.stringify(data));
		//window.location.href = $(this).attr('action');
		
        var id = $(this).attr('class');
		//alert (id);
        if (id == 'add_to_cart') {
            
        } else if (id == 'filter_form') {
			
			 let datar = $(this).serializeArray();
            
             alert(JSON.stringify(datar));
		} else if (id == 'my-search') {
			
			//alert(data);
			//alert($('input[name="search-mobile"]').val());
			//alert($(this).attr('action') + '/' + data);
			window.location.href = $(this).attr('action') + '/' + $('input[name="search-mobile"]').val();			
			
        } else {
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
            let datar = $(this).serializeArray();
            
            // alert(JSON.stringify(data));
            // console.log(new FormData(this));

            $.ajax({
                url: url, // Url to which the request is send
                type: type,             // Type of request to be send, called as method
                //data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
               data: datar,
			   contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData:false,        // To send DOMDocument or non processed data file it is set to false
                success: (data) => {
                    console.log(data);
                    res = JSON.parse(data);
                    console.log(res);
                    if (res.status == 1) {
                        Swal.fire({
                            title: 'Message',
                            text: res.msg,
                            icon: 'success',
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
