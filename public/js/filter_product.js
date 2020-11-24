$(document).ready(function () {
    $("#filter_form").submit(function (e) {
		
        var id = $(this).attr('id');

        if (id == 'filter_form') {
            e.preventDefault();
            var type = $(this).attr('method');
            var url = $(this).attr('action');
            var cat_id =  $('#filter_cat_id').val();
             //alert(url);
            var filterData = $(this).serializeArray();
            // var data = new FormData(this);
            // console.log(data);
            // $.get(url, {filterData: data}, (rdata) => {
            //     console.log(rdata);
            // });

            $.ajax({
                url : url,
                type: type,
                //data: filterData,
				
                cache : false,
				dataType: "json",
                processData: false,
                success: (data) => {
                    console.log(data);
                },
                error: (error) => {
                    console.log(error);
                }
            });

             //filterData.price = $('#amount').val();
             //filterData.category_id = $('#filter_cat_id').val();
			//filterData.brand = $('input[name=brand]').val();

            // console.log(data);
        }
    });
});