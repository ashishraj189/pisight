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
                    <h4 style="text-align:left;">Please confirm security questions</h4>                                    
                </div>

                <div class="panel-body">
                    <?php echo form_open('user/verify_security_question/') ?>                      
                    <?php if ($this->session->flashdata('message')) : ?>
                        <p><?php echo $this->session->flashdata('message') ?></p>
                    <?php endif; ?>                                        
                    <div class="form-group" style="margin-top: 30px;">  
                        <label><?php echo $secqus;?></label>
                        <?php
                        $user_ans_property = array(
                            'type' => 'text',
                            'name' => 'user_answer',
                            'id' => 'txtanswer',
                            'value' => set_value('user_answer'),
                            'class' => 'form-control',
                            'placeholder' => '',
                            'required' => 'required'
                        );
                        echo form_error('user_answer');
                        ?>
                        <?php echo form_hidden('sec_ques_id', $secqus_id); ?>
                        <?php echo form_input($user_ans_property); ?>
                        <!--<input type="text" class="form-control" id="txtanswer" placeholder="">-->
                    </div>   
                    <?php
                    $submit_ans = array(
                        'type' => 'submit',
                        'name' => 'submit_ques',
                        'value' => 'Submit',
                        'class' => 'btn btn-info pull-right',
                        'style' => "padding-right: 30px; padding-left: 30px;",
                    );
                    echo form_submit($submit_ans);
                    ?>
                    <!--<input type="submit" class="btn btn-info pull-right" style="padding-right: 30px; padding-left: 30px;">Submit</button>-->

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">                            
        </div>

    </div><!-- Row -->
</div><!-- Main Wrapper -->