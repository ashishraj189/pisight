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
                <div class="panel-heading clearfix">                                    

                </div>
                <div class="panel-body">
                    <?php echo form_open('user/forgot_password_vals') ?>
                    <?php if ($this->session->flashdata('message')) : ?>
                        <p><?php echo $this->session->flashdata('message') ?></p>
                    <?php endif; ?>
                    <div class="form-group" style="margin-top: 30px;"> 
                        <?php
                        $email_property = array(
                            'type' => 'email',
                            'name' => 'user_email',
                            'id' => 'txtemail',
                            'value' => set_value('user_email'),
                            'class' => 'form-control',
                            'placeholder' => 'Email ID',
                            'required' => 'required'
                        );
                        echo form_error('user_email')
                        ?>
                        <?php echo form_input($email_property) ?>
                        <!--<input type="password" class="form-control" id="txtpassword" placeholder="Password">-->
                    </div>
                    <?php
                    $submit_property = array(
                        'type' => 'submit',
                        'name' => 'forgot',
                        'value' => 'Submit',
                        'class' => 'btn btn-info pull-right',
                        'style' => "padding-right: 30px; padding-left: 30px;"
                    );
                    ?>
                    <?php echo form_submit($submit_property); ?>
                    <!--<button type="submit" class="btn btn-info pull-right" style="padding-right: 30px; padding-left: 30px;">Submit</button>-->

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">                            
        </div>

    </div><!-- Row -->
</div><!-- Main Wrapper -->