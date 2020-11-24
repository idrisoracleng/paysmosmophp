<div id="live_search" class="row">
    <div class="col-md-8">
        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group mr-2" role="group" aria-label="First group">
            <button type="button" class="btn btn-sm btn-info btn-disabled">Search Params</button>
            </div>
            <div class="btn-group mr-2" role="group" aria-label="Second group">
              <?php foreach ($search_params as $key => $value) { ?>
                <button type="button" class="btn btn-sm btn-secondary key" key="<?php echo $value ?>"><?php echo ucfirst($value); ?></button>
                <!-- <button type="button" class="btn btn-sm btn-secondary key" key="category">Category</button>
                <button type="button" class="btn btn-sm btn-secondary key" key="brand">Brand</button>
                <button type="button" class="btn btn-sm btn-secondary key" key="price">Price</button> -->
              <?php } ?>
            </div>
            <div class="btn-group" role="group" aria-label="Third group">
            <button type="button" class="btn btn-sm btn-primary" id="selectedKey"><?php echo $search_params[0]; ?></button>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <input id="live_search_input" value="" class="form-control" url="<?php echo $url; ?>" placeholder="Search here..."/>
        <input id="key" value="name" type="hidden"/>
        <input id="page" value="<?php echo isset($page) ? $page : 'all_product'; ?>" type="hidden"/>
        <i id="indicator"></i>
    </div>
</div>

<script>
    $(document).ready(function () {
      var req;
      var value;
      var key;
      var page = $("#page").val();;

      $(".key").click(function () {
        key = $(this).attr('key');
        $('#key').val(key);
        $('.key').removeClass('bg-danger');
        $(this).addClass('bg-danger');
        $("#selectedKey").text(key.toUpperCase());
      });
      $("#live_search_input").keyup(function () {
        (req) ? req.abort() : null;
        var url = $(this).attr('url');
        value = $(this).val();
        key = $("#key").val();
        if (value.length > 1) {
          $("#indicator").attr('class', '').addClass('text-info').text('waiting...');
          setTimeout (() => {
            $("#indicator").attr('class', '').addClass('text-primary').text('Searching...');
            console.log(value);
            req = $.get(url, {key: key, value: value, page: page}, (data) => {
              // console.log('data fetched');
              $("#live_search_result").html(data);
              $("#indicator").attr('class', '').addClass('text-success').text('Result Fetched...');
            });
          }, 1000);
        }
      });
    });
  </script>