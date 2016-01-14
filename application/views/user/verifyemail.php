<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-4">                            
        </div>
        <div class="col-md-4">
            <div class="panel panel-white" style="border:none !important;box-shadow: none; ">
                <img class="img-responsive blue-logo" src="<?php echo base_url(); ?>assets/images/blue-logo.png">
                <div class="panel-heading clearfix" style="height: 70px;">                                    
                    <?php
                    if (isset($msg) && !empty($msg)) {
                        echo '<h4 style="text-align:left;">"' . $msg . '"</h4>';
                    } else {
                        echo '<h4 style="text-align:left;">Thanks For Registration. Please verify your email id to complete registration process.</h4>';
                    }
                    ?>
                </div>
                <div class="panel-body" style="min-height: 200px">

                </div>
            </div>
        </div>

        <div class="col-md-4">                            
        </div>

    </div><!-- Row -->
</div><!-- Main Wrapper -->
