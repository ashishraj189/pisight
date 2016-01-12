<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-4">                            
        </div>
        <div class="col-md-4">
            <div class="panel panel-white" style="border:none !important;box-shadow: none; ">
                <img class="img-responsive blue-logo" src="assets/images/blue-logo.png">
                <div class="panel-heading clearfix">                                    
                    <h4 style="text-align:center;">Sign in to start your session</h4>
                </div>
                <div class="panel-body">
                    <form>
                        <div class="form-group"> 
                            <?php echo form_error('user_email'); ?>
                            <?php
                            $email_property = array(
                                'type' => 'email',
                                'name' => 'user_email',
                                'id' => 'exampleInputEmail1',
                                'value' => set_value('user_email'),
                                'class' => 'form-control',
                                'placeholder' => 'Email'
                            );
                            echo form_input($email_property);
                            ?>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                        </div>
                        <div class="form-group" style="margin-top: 30px;">                                            
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="checkbox">                                            
                            <input type="checkbox"> Remember Me                                            
                        </div>
                        <button type="submit" class="btn btn-info pull-right" style="padding-right: 30px; padding-left: 30px;">Submit</button>
                        <div class="form-group">                                            
                            <a href="#">Register a new account</a><br>
                            <a href="#">I forgot my password</a> 
                        </div>                                         

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">                            
        </div>

    </div><!-- Row -->
</div><!-- Main Wrapper -->

<?php if ($this->session->flashdata('message')) : ?>
    <p><?= $this->session->flashdata('message') ?></p>
<?php endif; ?>

<?php echo form_open('user/loginVals/') ?>
    <?php echo form_fieldset('Login Form') ?>

<div class="textfield">
    <?php echo form_label('Email', 'user_email'); ?>
<?php echo form_error('user_email'); ?>
<?php echo form_input('user_email', set_value('user_email')); ?>
</div>

<div class="textfield">
    <?php echo form_label('password', 'user_pass') ?>
<?php echo form_error('user_pass') ?>
<?php echo form_password('user_pass') ?>
</div>

<div class="buttons">
<?php echo form_submit('login', 'Login'); ?>
</div>

<?php echo form_fieldset_close() ?>
<?php echo form_close(); ?>