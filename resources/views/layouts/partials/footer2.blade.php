<footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg d-lg-flex align-items-center">
          <ul class="nav justify-content-center justify-content-lg-start text-3">
            <li class="nav-item"> <a class="nav-link active" href="#">About Us</a></li>
            <li class="nav-item"> <a class="nav-link" href="#">Support</a></li>
            <li class="nav-item"> <a class="nav-link" href="#">Help</a></li>
            <li class="nav-item"> <a class="nav-link" href="#">Careers</a></li>
            <li class="nav-item"> <a class="nav-link" href="#">Affiliate</a></li>
            <li class="nav-item"> <a class="nav-link" href="#">Fees</a></li>
          </ul>
          
        </div>

        <div class="col-lg d-lg-flex justify-content-lg-end mt-3 mt-lg-0">
          <ul class="social-icons justify-content-center">
            <li class="social-icons-facebook"><a data-bs-toggle="tooltip" href="#" target="_blank" title="" data-bs-original-title="Facebook" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a></li>
            <li class="social-icons-twitter"><a data-bs-toggle="tooltip" href="#" target="_blank" title="" data-bs-original-title="Twitter" aria-label="Twitter"><i class="fab fa-twitter"></i></a></li>
            <li class="social-icons-google"><a data-bs-toggle="tooltip" href="#" target="_blank" title="" data-bs-original-title="Google" aria-label="Google"><i class="fab fa-google"></i></a></li>
            <li class="social-icons-youtube"><a data-bs-toggle="tooltip" href="#" target="_blank" title="" data-bs-original-title="Youtube" aria-label="Youtube"><i class="fab fa-youtube"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="footer-copyright pt-3 pt-lg-2 mt-2">
        <div class="row">
          <div class="col-lg">
            <p class="text-center text-lg-start mb-2 mb-lg-0">Copyright © 2022 <a href="http://airpaygiving.com/">Airpaygiving</a>. All Rights Reserved.</p>
          </div>
<div class="col-lg d-lg-flex align-items-center justify-content-lg-end">
            <ul class="nav justify-content-center">
              <li class="nav-item"> <a class="nav-link active" href="#">Security</a></li>
              <li class="nav-item"> <a class="nav-link" href="#">Terms</a></li>
              <li class="nav-item"> <a class="nav-link" href="#">Privacy</a></li>
            </ul>
            <img style="margin-left:45px" src="http://airpaygiving.com/img/3dsecure.png" width="100px">
        <img src="http://airpaygiving.com/img/verified_by_visa.png" width="100px">
          </div>
        </div>
      </div>
    </div>
  </footer>
    
</div>
<!-- Document Wrapper end --> 

<!-- Back to Top
============================================= --> 
<a id="back-to-top" data-bs-toggle="tooltip" title="" href="javascript:void(0)" data-bs-original-title="Back to Top" aria-label="Back to Top" style="display: none;"><i class="fa fa-chevron-up"></i></a> 

<!-- Styles Switcher -->
<!--
<div id="styles-switcher" class="left">
  <h2 class="text-3">Color Switcher</h2>
  <hr>
  <ul>
    <li class="blue" data-bs-toggle="tooltip" title="" data-path="css/color-blue.css" data-bs-original-title="Blue" aria-label="Blue"></li>
	<li class="indigo" data-bs-toggle="tooltip" title="" data-path="css/color-indigo.css" data-bs-original-title="Indigo" aria-label="Indigo"></li>
    <li class="purple" data-bs-toggle="tooltip" title="" data-path="css/color-purple.css" data-bs-original-title="Purple" aria-label="Purple"></li>
	<li class="pink" data-bs-toggle="tooltip" title="" data-path="css/color-pink.css" data-bs-original-title="Pink" aria-label="Pink"></li>
	<li class="red" data-bs-toggle="tooltip" title="" data-path="css/color-red.css" data-bs-original-title="Red" aria-label="Red"></li>
    <li class="orange" data-bs-toggle="tooltip" title="" data-path="css/color-orange.css" data-bs-original-title="Orange" aria-label="Orange"></li>
	<li class="yellow" data-bs-toggle="tooltip" title="" data-path="css/color-yellow.css" data-bs-original-title="Yellow" aria-label="Yellow"></li>
	<li class="teal" data-bs-toggle="tooltip" title="" data-path="css/color-teal.css" data-bs-original-title="Teal" aria-label="Teal"></li>
    <li class="cyan" data-bs-toggle="tooltip" title="" data-path="css/color-cyan.css" data-bs-original-title="Cyan" aria-label="Cyan"></li>
    <li class="brown" data-bs-toggle="tooltip" title="" data-path="css/color-brown.css" data-bs-original-title="Brown" aria-label="Brown"></li>
  </ul>
  <button class="btn btn-dark btn-sm border-0 fw-400 rounded-0 shadow-none" data-bs-toggle="tooltip" title="" id="reset-color" data-bs-original-title="Green">Reset Default</button>
  <button class="btn switcher-toggle"><i class="fas fa-cog"></i></button>
</div>
-->
<!-- Styles Switcher End --> 

<!-- Script --> 
<script src="<?php echo base_url(); ?>/app-assets/jquery.js"></script> 
<script src="<?php echo base_url(); ?>/app-assets/bootstrap.js"></script> 
<script src="<?php echo base_url(); ?>/app-assets/moment.js"></script> 
<script src="<?php echo base_url(); ?>/app-assets/daterangepicker.js"></script> 

<script>

$(document).ready(function(){
    /*
    if($('#tithe_amount_cb').prop("checked") == true){
        $('#tithe_amount').show();
    }
    else if($('#tithe_amount_cb').prop("checked") == false){
        $('#tithe_amount').hide();
    }
    */
    $('#tithe_amount').hide();
    $('#offering_amount').show();
    $('#offering_amount').val(100);
    $('#donations_amount').hide();
    $('#gift_amount').hide();
});

function setTwoNumberDecimal(event) {
    this.value = parseFloat(this.value).toFixed(2);
}

$(function() {
 'use strict';
 
 // Date Range Picker
 $(function() {
    var start = moment().subtract(29, 'days');
    var end = moment();
    function cb(start, end) {
        $('#dateRange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }
    $('#dateRange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);
    cb(start, end);
});
});
</script> 

<!-- Style Switcher --> 
<script src="<?php echo base_url(); ?>/app-assets/switcher.js"></script> 
<script src="<?php echo base_url(); ?>/app-assets/theme.js"></script>

</body></html>