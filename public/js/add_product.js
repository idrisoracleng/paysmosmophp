$(document).ready(function() {
    $('label').addClass('text-info');

    $("#image_preview").click(function() {
        $("#imagetoupload").trigger('click');
    });

    $("#discount_price").keyup(function() {
        if ($("#discount_price").val() === '') {
            $("#total_price").val($("#price").val());
        } else {
            $("#total_price").val($(this).val());
        }
    });

    $("#price").keyup(function() {
        if ($("#discount_price").val() === '') {
            $("#total_price").val($(this).val());
        }
	});
	
	
/*	$('.category').on('change', function() {
		if ($(this).attr('id') == 'main_cat') {
			$('.category_tile_cloneable').hide();
			$(this).parent().show();
		}
		var id = $(this).val();
		// alert(id);
		var category_tile = $("#category_tile");
		var category_tile_clone = $("#category_tile_cloneable").clone(true);
		$.get("/api/getSubCategory/"+id, {}, function(data) {
			// alert(data);
			category_tile_clone.html(data);
			category_tile_clone.attr('id', '');
			console.log(category_tile_clone);
			category_tile.append(category_tile_clone);
		});
		// alert(id);
	});*/

    $("#vat").change(function() {
        var total_price = parseInt($("#total_price").val());
        var discount_price = parseInt($("#discount_price").val());
        var price = parseInt($("#price").val());
        var vat = $(this).val();
        // alert(`${total_price} => ${price}`);
        if (discount_price != '') {
            if (vat == 'no' && (total_price != discount_price)) {
                var new_price = total_price - ((5 / 100) * price);
                $("#total_price").val(new_price);
            }

            if (vat == 'yes' && (total_price == discount_price)) {
                var new_price = (total_price + ((5 / discount_price) * 100));
                $("#total_price").val(new_price);
            }
        }

        if (price != '' && discount_price == '') {
            if (vat == 'no' && (total_price != price)) {
                var new_price = total_price - ((5 / 100) * price);
                $("#total_price").val(new_price);
            }

            if (vat == 'yes' && (total_price == price)) {
                var new_price = (total_price + ((5 / price) * 100));
                $("#total_price").val(new_price);
            }
        }
    });

    $("input").change(function(e) {
        if ($(this).attr('name') == 'warranty' && $(this).val() == 'yes') {
            $("#warranty_period").attr('disabled', false);
            $("#warranty_detail").attr('disabled', false);
            $("#more_warranty_detail").show();
        }
        if ($(this).attr('name') == 'warranty' && $(this).val() == 'no') {
            $("#warranty_period").attr('disabled', true);
            $("#warranty_detail").attr('disabled', true);
            // $("#more_warranty_detail").hide();
        }
    });

    $(".save_product").click(function() {
        $("#product_form").trigger('submit');
    });

    $("#add_product_variant").click(function(e) {
        e.preventDefault();
        // alert("Clinked");
        var product_variants = document.getElementById('product_variants');
        // var variant_container = document.createElement('div');

        var price_container = document.createElement('div');
        var size_container = document.createElement('div');
        var discount_container = document.createElement('div');
        var qty_container = document.createElement('div');

        var size_input = document.createElement('input');
        var price_input = document.createElement('input');
        var discount_price_input = document.createElement('input');
        var qty_input = document.createElement('input');
        var variant_id = document.createElement('input');

        var size_label = document.createElement('label');
        var price_label = document.createElement('label');
        var qty_label = document.createElement('label');
        var discount_price_label = document.createElement('label');

        size_label.innerText = 'Size';
        price_label.innerText = 'Price';
        qty_label.innerText = 'Quantity';
        discount_price_label.innerText = 'Discount Price';

        price_input.setAttribute('placeholder', 'Input variant price');
        price_input.setAttribute('class', 'form-control');
        price_input.setAttribute('name', 'variant_price[]');
        price_input.setAttribute('type', 'number');

        qty_input.setAttribute('placeholder', 'Input product quantity');
        qty_input.setAttribute('class', 'form-control');
        qty_input.setAttribute('name', 'variant_qty[]');
        qty_input.setAttribute('type', 'number');

        discount_price_input.setAttribute('placeholder', 'Input variant discount price');
        discount_price_input.setAttribute('class', 'form-control');
        discount_price_input.setAttribute('name', 'variant_discount_price[]');
        discount_price_input.setAttribute('type', 'number');

        variant_id.setAttribute('name', 'variant_id[]');
        variant_id.setAttribute('type', 'hidden');
        variant_id.setAttribute('value', 'null');

        size_input.setAttribute('placeholder', 'Input variant size');
        size_input.setAttribute('class', 'form-control');
        size_input.setAttribute('name', 'variant_size[]');

        size_container.setAttribute('class', 'form-group col-md-3');
        price_container.setAttribute('class', 'form-group col-md-3');
        discount_container.setAttribute('class', 'form-group col-md-3');
        qty_container.setAttribute('class', 'form-group col-md-3');

        size_container.append(size_label);
        size_container.append(size_input);

        discount_container.append(discount_price_label);
        discount_container.append(discount_price_input);

        qty_container.append(qty_label);
        qty_container.append(qty_input);

        price_container.append(price_label);
        price_container.append(price_input);
        price_container.append(variant_id);

        product_variants.append(size_container);
        product_variants.append(price_container);
        product_variants.append(discount_container);
        product_variants.append(qty_container);


    });

});


function getCategories() {
	console.log(e.target);
}
