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
                    <h4 style="text-align:center;">Sign in to start your session</h4>
                </div>
                <div class="panel-body">
                    <?php echo form_open('user/loginVals/') ?>
                    <?php if ($this->session->flashdata('message')) : ?>
                        <p><?php echo $this->session->flashdata('message') ?></p>
                    <?php endif; ?>
                    <div class="form-group"> 
                        <?php echo form_error('user_email'); ?>
                        <?php
                        $email_property = array(
                            'type' => 'email',
                            'name' => 'user_email',
                            'id' => 'exampleInputEmail1',
                            'value' => set_value('user_email'),
                            'class' => 'form-control',
                            'placeholder' => 'Email',
                            'required' => 'required'
                        );
                        echo form_input($email_property);
                        ?>

                    </div>
                    <div class="form-group" style="margin-top: 30px;">
                        <?php echo form_error('user_pass') ?>
                        <?php
                        $password_property = array(
                            'type' => 'password',
                            'name' => 'user_pass',
                            'id' => 'exampleInputPassword1',
                            // 'value' => set_value('user_pass'),
                            'class' => 'form-control',
                            'placeholder' => 'Password',
                            'required' => 'required'
                        );
                        echo form_password($password_property)
                        ?>
                       
                    </div>
                    <div class="checkbox">                                            
                        <input type="checkbox"> Remember Me                                            
                    </div>
                    <input type="submit" class="btn btn-info pull-right" value='Submit' name="login" style="padding-right: 30px; padding-left: 30px;">  
                    <div class="form-group">                                            
                        <a href="<?php echo site_url('user/signup');?>">Register a new account</a><br>
                        <a href="<?php echo site_url('user/forgot_password');?>">I forgot my password</a> 
                    </div>                                         

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">                            
        </div>

    </div><!-- Row -->
</div><!-- Main Wrapper -->