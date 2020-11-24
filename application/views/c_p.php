
<!--  Main Page Starts  -->
<div class="container" id="main">
    <!--  Upper Remark  -->
    <div class="row">

        <div class="col-md-8 offset-2" id="main-right">
            <div class="card products" style="border-radius: 10px; background: white; ">
                <h4 class="card-header products-header">
                    <span class="fa fa-question-circle"></span> <?php echo $page->name; ?>
                </h4>
                <div class="card-body" style="background: white; padding: 10px">
                   <?php echo $page->content; ?>
                </div>
            </div>
            
        </div>
    </div>
</div>
