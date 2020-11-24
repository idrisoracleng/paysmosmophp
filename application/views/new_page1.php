<div class="container mt-5 mb-5">
  <div class="row">
    <div class="col-lg-9">

      <div id="faq" role="tablist" aria-multiselectable="true">

      <div class="card">

        <div class="card-header bg-white" role="tab" id="questionOne">
          <h5 class="card-title font-weight-bold">
            <a data-toggle="collapse" data-parent="#faq" href="#answerOne" aria-expanded="true" aria-controls="answerOne">
            Step 1. ADDRESS DETAILS
            </a>
          </h5>
        </div>

        <div id="answerOne" class="collapse show" role="tabcard" aria-labelledby="questionOne">
          <div class="card-body">
            <!-- form here -->
            <form action="<?php echo base_url();?>" method="post">

              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="">First Name <span class="text-red">*</span></label>
                    <input type="text" name="" value="" class="form-control input-sm">
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="">Last Name <span class="text-red">*</span></label>
                    <input type="text" name="" value="" class="form-control input-sm">
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="">Mobile Phone No. <span class="text-red">*</span></label>
                    <input type="text" name="" value="+234" class="form-control input-sm" readonly>
                  </div>
                </div>

                <div class="col-lg-9">
                  <div class="form-group">
                    <label for="">&nbsp</label>
                    <input type="text" name="" value="" class="form-control input-sm">
                  </div>
                </div>
              </div>



              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="">Address <span class="text-red">*</span></label>
                    <textarea name="name" rows="4" class="form-control" placeholder="Street Name / Building / Apartment No."></textarea>
                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="">State / Region <span class="text-red">*</span></label>
                    <select class="form-control" name="">
                      <option value="">Please select...</option>
                    </select>
                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="">City <span class="text-red">*</span></label>
                    <select class="form-control" name="">
                      <option value="">Please select...</option>
                    </select>
                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for=""> <span class="text-red">*</span> Required</label>

                  </div>
                </div>

              </div>

              <button type="submit" name="submit" class="btn btn-warning btn-block"><b>SAVE AND CONTINUE</b></button>



            </form>
            <!-- form here -->
          </div>
        </div>

      </div>

      <div class="card">
        <div class="card-header bg-white" role="tab" id="questionTwo">
          <h5 class="card-title font-weight-bold">
            <a class="collapsed" data-toggle="collapse" data-parent="#faq" href="#answerTwo" aria-expanded="false" aria-controls="answerTwo">
            Step 2. DELIVERY METHOD
            </a>
          </h5>
        </div>

        <div id="answerTwo" class="collapse" role="tabcard" aria-labelledby="questionTwo">
          <div class="card-body">

            <form class="" action="" method="post">
              <span class="text-dark font-weight-bold">How do you want your order delivered?</span><br>
              <input type="radio" name="delivery_method" value="" checked>&nbsp <b>Door Delivery</b><br>
              <span>Delivered between <b>Wednesday 18 Dec</b> and <b>Monday 23 Dec</b> for ₦ 600</span>
              <hr>
              <label for="" class="font-weight-bold">ADDRESS</label>
              <textarea name="name" rows="2" class="form-control"></textarea>
              <hr>
              
            </form>

          </div>
        </div>

      </div>

      <div class="card">
        <div class="card-header bg-white" role="tab" id="questionThree">
          <h5 class="card-title font-weight-bold">
            <a class="collapsed" data-toggle="collapse" data-parent="#faq" href="#answerThree" aria-expanded="true" aria-controls="answerThree">
            Step 3. PAYMENT METHOD
            </a>
          </h5>
        </div>

        <div id="answerThree" class="collapse in" role="tabcard" aria-labelledby="questionThree">
          <div class="card-body">
          Keep your boots dry.
          </div>
        </div>
      </div>







      <!-- here -->
      <div class="bg-white">
          <div class="panel">
              <div class="panel-heading" style="padding:10px;">
                <h5>
                    <a href="#" data-toggle="collapse" data-target="#improvementsPanel" aria-expanded="true" class=""><b >&nbsp&nbsp&nbsp&nbspStep 4. CONFIRM ORDER</b></a>
                </h5>

              </div>
              <div id="improvementsPanel" class="panel-collapse collapse in" aria-expanded="true">
                <table class="table table-bordered">
                  <thead>
                      <tr>
                          <th>PRODUCT</th>
                          <th>PRODUCT NAME</th>
                          <th>QUANTITY</th>
                          <th>UNIT PRICE</th>
                          <th>TOTAL</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td class="text-center">
                            <img src="<?php echo base_url();?>resources/images/job17.jpg"/>
                          </td>
                          <td class="text-center">
                            <b>Men's SMART - 02 Sneakers MAROON</b>
                          </td>
                          <td class="text-center"><b>1</b></td>
                          <td class="text-center"><b>₦3,600</b></td>
                          <td class="text-center"><b>₦3,600</b></td>
                      </tr>

                      <tr>
                          <td class="text-right font-weight-bold" colspan="4">Sub-Total:</td>
                          <td class="text-center font-weight-bold"><b>₦3,600</b></td>
                      </tr>
                      <tr>
                          <td class="text-right font-weight-bold" colspan="4">Shipping Amount:</td>
                          <td class="text-center font-weight-bold"><b>₦3,600</b></td>
                      </tr>

                  </tbody>
                  <tfoot>
                      <tr>
                          <th class="text-right" colspan="4" style="color:black;font-weight:bold;">Total</th>
                          <th class="text-center" style="color:black;font-weight:bold;"><b>₦3,600</b></th>
                      </tr>
                  </tfoot>
              </table>
              <span class="pull-right">
                <button type="button" name="button" class="btn btn-warning"><b>CONFIRM ORDER</b></button>
              </span>

            </div>
          </div>
      </div>

      <!-- here -->





      </div>

    </div>
    <!-- end first column -->


    <div class="col-lg-3">
      <div class="card">
        <div class="card-header bg-white">
          <span class="text-dark font-weight-bold">YOUR ORDER(1 item)</span>
        </div>
        <div class="card-body">
          <ul class="font-weight-bold">
            <li>

              <div class="row">
                <div class="col-lg-6">
                  <img src="<?php echo base_url();?>resources/images/job17.jpg"/>
                </div>
                <div class="col-lg-6">
                  <span style="font-size:12px;">Men's SMART - 02 Sneakers MAROON</span><br>
                  <span style="color:gray;">Qty: 1</span><br>

                </div>
              </div>

            </li><hr>
            <li>Subtotal  <span class="pull-right">₦3,600</span></li><hr>
            <li>Total  <span class="pull-right text-warning">₦3,600</span></li>
          </ul>
        </div>
      </div>
    </div>





  </div>
</div>
