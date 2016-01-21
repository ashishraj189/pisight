
<!--Add Deposit Model Start Here-->
<!-- Modal -->
<div class="modal fade" id="add_deposit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 100%; max-width: 620px; min-width: 300px;">
        <div class="modal-content" style="background-color:transparent; margin-top: 140px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:12px; margin-right: -14px;opacity:1;">
                    <img src="<?php echo base_url(); ?>assets/images/close.png"></button>                                                            
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white" style="padding-top:15px; padding-bottom: 60px;">
                            <div class="panel-body">
                                <div class="col-md-12"><h1 style="padding-bottom:20px;">Add Deposit</h1>
                                <p style="float:left;" id="dep_msg"></p></div>
                                <form id="deposit_form">
                                    <div class="col-md-6">
                                        <div class="form-group">  
                                            <label>Add Deposit</label>     
                                            <?php
                                            if (!isset($institution_name_list)) {
                                                $institution_name_list = array("" => "Please select account");
                                            }
                                            echo form_dropdown('deposit_account', $institution_name_list, '', 'class="form-control" id="deposit_account"');
                                            ?>
                                        </div>
                                        <div class="form-group" style="margin-top: 30px; "> 
                                            <label>Deposit Amount</label><br>
                                            <?php
                                            echo form_dropdown('deposit_currency', $currency, '144', 'class="form-control" id="deposit_currency" style="width:40%;display: inline-block !important;"');
                                            ?>
                                            <?php
                                            $deposit_amount = array(
                                                'type' => 'text',
                                                'name' => 'deposit_amount',
                                                'id' => 'deposit_amount',
                                                'class' => 'form-control',
                                                'placeholder' => 'amount...',
                                                'style' => 'width:58%;display: inline-block !important;',
                                                'required' => 'required'
                                            );
                                            echo form_error('deposit_amount')
                                            ?>
                                            <?php echo form_input($deposit_amount); ?>
                                        </div> 
                                        <div class="form-group">  
                                            <label>Deposit End Date</label>     
                                            <?php
                                            $deposit_endate = array(
                                                'type' => 'text',
                                                'name' => 'deposit_endate',
                                                'id' => 'deposit_endate',
                                                'class' => 'form-control',
                                                'placeholder' => 'DD-MM-YYYY',
                                                'required' => 'required'
                                            );
                                            echo form_error('deposit_endate')
                                            ?>
                                            <?php echo form_input($deposit_endate) ?>	
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">   
                                            <label>Deposit Account Number</label>
                                            <?php
                                            $deposit_acnumber = array(
                                                'type' => 'text',
                                                'name' => 'deposit_acnumber',
                                                'id' => 'deposit_acnumber',
                                                'class' => 'form-control',
                                                'placeholder' => '',
                                                'required' => 'required'
                                            );
                                            echo form_error('deposit_acnumber')
                                            ?>
                                            <?php echo form_input($deposit_acnumber) ?>

                                        </div>
                                        <div class="form-group" style="margin-top: 30px;">                                            
                                            <label>Deposit Start Date</label>
                                            <?php
                                            $deposit_stdate = array(
                                                'type' => 'text',
                                                'name' => 'deposit_stdate',
                                                'id' => 'deposit_stdate',
                                                'class' => 'form-control',
                                                'placeholder' => 'DD-MM-YYYY',
                                                'required' => 'required'
                                            );
                                            echo form_error('deposit_stdate')
                                            ?>
                                            <?php echo form_input($deposit_stdate) ?>	

                                        </div> 
                                        <div class="form-group" style="margin-top: 30px;">                                            
                                            <button type="submit" name="deposit_submit" class="btn btn-info pull-right" style="padding-right: 30px; padding-left: 30px;">Submit</button>
                                        </div>
                                    </div>                                                                                            
                                </form>
                                
                            </div>
                        </div>                                 
                    </div>                            
                </div>
            </div>
        </div>
    </div>
</div>
<!--End of add deposit model html-->