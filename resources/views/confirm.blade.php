@extends('layouts.partials.header2')
<div id="content" class="py-4">
    <div class="container"> 
      
      <!-- Steps Progress bar -->
      <div class="row mt-4 mb-5">
        <div class="col-lg-11 mx-auto">
          <div class="row widget-steps">
            <div class="col-4 step complete">
              <div class="step-name">Details</div>
              <div class="progress">
                <div class="progress-bar"></div>
              </div>
              <a href="send-money.html" class="step-dot"></a> </div>
            <div class="col-4 step active">
              <div class="step-name">Confirm</div>
              <div class="progress">
                <div class="progress-bar"></div>
              </div>
              <a href="#" class="step-dot"></a> </div>
            <div class="col-4 step disabled">
              <div class="step-name">Success</div>
              <div class="progress">
                <div class="progress-bar"></div>
              </div>
              <a href="#" class="step-dot"></a> </div>
          </div>
        </div>
      </div>
      <h2 class="fw-400 text-center mt-3">Send Money</h2>
      <p class="lead text-center mb-4">Confirm your order details below</p>
      <p class="lead text-center mb-4"> <span class="fw-500"><?=$sub_account_title;?></span><br/>
      <!--<span class="fw-500"><?=$sub_account_email;?></span><br/>-->
      <span class="fw-500"><?=$sub_account_address;?></span></p>
      <div class="row">
        <div class="col-md-9 col-lg-7 col-xl-6 mx-auto">
          <div class="bg-white shadow-sm rounded p-3 pt-sm-4 pb-sm-5 px-sm-5 mb-4">
            <h3 class="text-5 fw-400 mb-3 mb-sm-4">Payment Description</h3>
            <hr class="mx-n3 mx-sm-n5 mb-4">
            <div style="width:100%;" class="col-md-6"> 

              <?php
                $ct = json_decode($description, true);
                

              ?>
            <!-- Bordered Table
            ============================================= -->
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody>
                    <?php if(!empty($ct['tithe'])):?>
                  <tr>
                    <th scope="row">1</th>
                    <td>Tithe</td>
                    <td><?=$ct['tithe'];?></td>
                  </tr>
                  <?php endif;?>
                  <?php if(!empty($ct['offering'])):?>
                  <tr>
                    <th scope="row">2</th>
                    <td>Offering</td>
                    <td><?=$ct['offering'];?></td>
                  </tr>
                  <?php endif;?>
                  <?php if(!empty($ct['donations'])):?>
                  <tr>
                    <th scope="row">3</th>
                    <td>Donation</td>
                    <td><?=$ct['donations'];?></td>
                  </tr>
                  <?php endif;?>
                  <?php if(!empty($ct['gift'])):?>
                  <tr>
                    <th scope="row">4</th>
                    <td>Gift</td>
                    <td><?=$ct['gift'];?></td>
                  </tr>
                  <?php endif;?>
                </tbody>
              </table>
            </div>
            <!-- Send Money Confirm
            ============================================= -->
            <form id="form-send-money" method="post">
              <!--
              <div class="mb-4 mb-sm-5">
                <label for="description" class="form-label">Description (Optional)</label>
                <textarea name="payment_description" class="form-control" rows="4" id="description" placeholder="Payment Description"></textarea>
              </div>
              -->
              <hr class="mx-n3 mx-sm-n5 mb-3 mb-sm-4">
              <h3 class="text-5 fw-400 mb-3 mb-sm-4">Confirm Details</h3>
              <hr class="mx-n3 mx-sm-n5 mb-4">
              <p class="mb-1">Send Amount <span class="text-3 float-end">NAD <?=$amount;?> </span></p>
              <!--<p class="mb-1">Total fees <span class="text-3 float-end"><?=$amount;?> <?=$currency;?></span></p>-->
              <hr>
              <p class="text-4 fw-500">Total<span class="float-end">NAD <?=$amount;?> </span></p>
              <div class="d-grid"><a href="<?=$authorization_url;?>" class="btn btn-primary">Send Money</a><div style="text-align:center;"><br><img style="margin-left:45px" src="http://airpaygiving.com/img/3dsecure.png" width="50px">
    <img src="http://airpaygiving.com/img/verified_by_visa.png" width="80px"></div></div>
            </form>
            <!-- Send Money Confirm end --> 
          </div>
        </div>
      </div>
    </div>
  </div>
  @extends('layouts.partials.footer2')