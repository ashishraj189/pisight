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
                    <?php echo form_open('user/signupVals') ?>

                    <?php if ($this->session->flashdata('message')) : ?>
                        <p><?php echo $this->session->flashdata('message') ?></p>
                    <?php endif; ?>
                    <div class="form-group">
                        <?php
                        $user_name_property = array(
                            'type' => 'text',
                            'name' => 'user_name',
                            'id' => 'txtuserid',
                            'value' => set_value('user_name'),
                            'class' => 'form-control',
                            'placeholder' => 'User ID',
                            'required' => 'required'
                        );
                        echo form_error('user_name');
                        ?>
                        <?php echo form_input($user_name_property); ?>

                    </div>
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
                    </div>
                    <div class="form-group" style="margin-top: 30px;">                                            
                        <?php
                        $password_property = array(
                            'type' => 'password',
                            'name' => 'user_password',
                            'id' => 'txtpassword',
                            //'value' => set_value('user_email'),
                            'class' => 'form-control',
                            'placeholder' => 'Password',
                            'required' => 'required'
                        );
                        echo form_error('user_password')
                        ?>
                        <?php echo form_password($password_property) ?>
<!--                            <input type="password" class="form-control" id="txtpassword" placeholder="Password">-->
                    </div>
                    <div class="form-group" style="margin-top: 30px;"> 
                        <?php
                        $conf_password_property = array(
                            'type' => 'password',
                            'name' => 'user_cnpassword',
                            'id' => 'txtcpassword',
                            //'value' => set_value('user_email'),
                            'class' => 'form-control',
                            'placeholder' => 'Re-enter Password',
                            'required' => 'required'
                        );
                        echo form_error('user_cnpassword')
                        ?>
                        <?php echo form_password($conf_password_property) ?>
                        <!--<input type="password" class="form-control" id="txtcpassword" placeholder="Re-enter Password">-->
                    </div>
                    <div class="checkbox">
                        <?php echo form_checkbox('aceepterms', '1', '', 'required=required'); ?>
                        <span style="font-size: 12px;">I have read accept the Terms of use and Privacy policy </span>                                          
                    </div>
                        <?php 
                        $submit_property = array(
                            'type' => 'submit',
                            'name' => 'register',
                            'value' => 'Submit',
                            'class' => 'btn btn-info pull-right',
                            'style' => "padding-right: 30px; padding-left: 30px;"
                        );
                        echo form_submit($submit_property); ?>
                    <!--<input type="submit" class="btn btn-info pull-right" name='register' value='Submit' style="padding-right: 30px; padding-left: 30px;">-->
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">                            
        </div>

    </div><!-- Row -->
</div><!-- Main Wrapper -->

<?php //echo form_error('user_firstname')   ?>
<?php //echo form_input('user_firstname', "")    ?>

<?php //echo form_error('user_lastname')   ?>
<?php //echo form_input('user_lastname', "")   ?>
