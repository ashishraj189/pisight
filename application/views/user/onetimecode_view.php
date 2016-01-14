<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="main-wrapper">
    <div class="row">
        <div class="row">
        <div class="col-md-4">                            
        </div>
        <div class="col-md-4">
            <div class="panel panel-white" style="border:none !important;box-shadow: none; ">
                <img class="img-responsive blue-logo" src="<?php echo base_url(); ?>assets/images/blue-logo.png">
                <div class="panel-heading clearfix">                                    
                        <h4 style="text-align:left;">Please Insert OTP Code Send TO Mail Id</h4>                                    
                </div>
                <div class="panel-body">
                        <?php echo form_open('user/loginVals/') ?>                                
                    <div class="form-group" style="margin-top: 30px;">  
                        <?php echo form_error('user_validcode'); ?>
                        <?php 
                        $email_property = array(
                            'type' => 'text',
                            'name' => 'user_validcode',
                            'id' => 'user_validcode',
                            'value' => set_value('user_validcode'),
                            'class' => 'form-control',
                            'placeholder' => 'One Time Password',
                            'required' => 'required'
                        );
                        echo form_error('user_email')
                        ?>
                        <?php echo form_input($email_property) ?>
                    </div>
                        <button type="submit" name="submit_code" value="submit" class="btn btn-info pull-right" style="padding-right: 30px; padding-left: 30px;">Submit</button>

                        </form>
                    </div>
                </div>
            </div>

        <div class="col-md-4">                            
        </div>
    </div><!-- Row -->
    </div><!-- Row -->
</div><!-- Main Wrapper -->