<div id="main-wrapper">
    <div class="row">
        <div class="col-md-4">                            
        </div>
        <div class="col-md-4">
            <div class="panel panel-white" style="border:none !important;box-shadow: none; ">
                <img class="img-responsive blue-logo" src="<?php echo base_url(); ?>assets/images/blue-logo.png">
                <div class="panel-heading clearfix">                                    
<!--                    <h1>Thanks For Registration</h1>-->
                </div>
                <div class="panel-body">
                    <div class="form-group" style="margin-top: 30px;">
                    <?php
                    //$attributes = array('class' => 'email', 'id' => 'myform');
                    echo form_open();
                    $options = array(
                        'Credit' => 'Credit',
                        'med' => 'Medium Shirt',
                        'large' => 'Large Shirt',
                        'xlarge' => 'Extra Large Shirt',
                    );

                    echo form_dropdown('type_of_account', $options, 'large');

                    echo form_close();
                    ?>

                </div>
            </div>
        </div>

        <div class="col-md-4">                            
        </div>

    </div><!-- Row -->
</div><!-- Main Wrapper -->