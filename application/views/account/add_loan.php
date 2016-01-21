<!--Add Loan HTML Start Here-->
<!-- Modal -->
<div class="modal fade" id="add_loan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                <div class="col-md-12"><h1 style="padding-bottom:20px;">Add Loan</h1></div>
                                <form id="loan_form">
                                    <div class="col-md-6">
                                        <div class="form-group">  
                                            <label>Add loan account</label>
                                            <?php
                                            if (!isset($institution_name_list)) {
                                                $institution_name_list = array("" => "Please select account");
                                            }
                                            echo form_dropdown('loan_account', $institution_name_list, '', 'class="form-control" id="loan_account"');
                                            ?>
                                        </div>

                                        <div class="form-group" style="margin-top: 30px; "> 
                                            <label>Loan outstanding amount</label><br>

                                            <?php
                                            echo form_dropdown('loan_currency', $currency, '144', 'class="form-control" id="loan_currency" style="width:40%;display: inline-block !important;"');
                                            ?>
                                            <?php
                                            $loan_outstnd_amt = array(
                                                'type' => 'text',
                                                'name' => 'loan_outamt',
                                                'id' => 'loan_outamt',
                                                'class' => 'form-control',
                                                'placeholder' => 'amount...',
                                                'required' => 'required',
                                                'style' => 'width:58%;display: inline-block !important;'
                                            );
                                            echo form_error('loan_outamt')
                                            ?>
                                            <?php echo form_input($loan_outstnd_amt) ?>	

                                        </div> 
                                        <div class="form-group" style="margin-top: 30px;">                                            
                                            <label>Loan end date</label>
                                            <?php
                                            $lastdate = array(
                                                'type' => 'text',
                                                'name' => 'end_date',
                                                'id' => 'end_date',
                                                'class' => 'form-control',
                                                'placeholder' => 'DD-MM-YYYY',
                                                'required' => 'required'
                                            );
                                            echo form_error('end_date')
                                            ?>
                                            <?php echo form_input($lastdate) ?>	

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">   
                                            <label>Loan account number</label>
                                            <?php
                                            $login_number = array(
                                                'type' => 'text',
                                                'name' => 'loan_acnumber',
                                                'id' => 'loan_acnumber',
                                                'class' => 'form-control',
                                                'placeholder' => 'Loan Account Number',
                                                'required' => 'required'
                                            );
                                            echo form_error('loan_acnumber')
                                            ?>
                                            <?php echo form_input($login_number) ?>		


                                        </div>
                                        <div class="form-group" style="margin-top: 30px;">                                            
                                            <label>Loan start date</label>
                                            <?php
                                            $loan_startdate = array(
                                                'type' => 'text',
                                                'name' => 'start_date',
                                                'id' => 'start_date',
                                                'class' => 'form-control',
                                                'placeholder' => 'DD-MM-YYYY',
                                                'required' => 'required'
                                            );
                                            echo form_error('start_date')
                                            ?>
                                            <?php echo form_input($loan_startdate) ?>	

                                        </div> 
                                        <div class="form-group" style="margin-top: 30px;">                                            
                                            <button type="submit" class="btn btn-info pull-right" style="padding-right: 30px; padding-left: 30px;">Submit</button>
                                        </div>
                                    </div>                                                                                            
                                </form>
                                <p style="float:left;" id="loan_id"></p>
                            </div>
                        </div>                                 
                    </div>                            
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Here-->