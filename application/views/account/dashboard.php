<div id="main-wrapper">
    <div class="row"> 
        <div class="col-md-12">
            <div class="panel panel-white" style="padding:0px !important; border: none !important;">
                <div class="panels-body">
                    <div class="row">                                        
                        <div class="col-md-4">                                            
                            <!-- model moved to bottom-->
                        </div>

                    </div>
                </div>
            </div>
            <div class="sc" style="max-width:305px; text-align: left; background-color: #fff; height: 57px; padding-top: 13px;">  
                <img src="<?php echo base_url(); ?>assets/images/addnew.png" alt=""> 
                <a href="#" style="text-decoration: none;" data-toggle="modal" data-target="#myModal">
                    <span style="margin-left:10px; ">Add Account</span>
                </a>
            </div>
        </div>
    </div>
    <div class="row">   
        <?php
        $val = array();
        $val["loan_dis_val"] = $loan_display;
        $val["deposit_display"] = $deposit_display;
        $this->load->view('common/left_accordian', $val);
        ?>
        <div class="col-md-9">
            <h1>TREND</h1>
            <div class="panel panel-white">                                
                <div class="panel-body">  
                    <div class="row" >                                        
                        <div class="col-md-12"> 
                            <h1><span style="color:#5d5d5d;">You haven't added any account.</span> You should get started now.</h1>
                        </div>                                       
                    </div>                                   
                    <div class="row">
                        <div class="col-md-12"style="padding-top:20px;">
                            <input type="submit" class="btn btn-info btn-rounded pull-right" name="aa" value="+Add Trends">                                               
                        </div>
                    </div>
                </div>
            </div>
            <h2>BUDGET NOV 15</h2>
            <div class="panel panel-white">                                
                <div class="panel-body">  
                    <div class="row" >                                        
                        <div class="col-md-12"> 
                            <h1><span style="color:#5d5d5d;">You haven't added any account.</span> You should get started now.</h1>
                        </div>                                       
                    </div>                                   
                    <div class="row">
                        <div class="col-md-12"style="padding-top:20px;">
                            <input type="submit" class="btn btn-info btn-rounded pull-right" name="aa" value="+Add Budgets">                                               
                        </div>
                    </div>

                </div>
            </div>
            <h1>GOALS</h1>
            <div class="panel panel-white">                                
                <div class="panel-body">  
                    <div class="row" >                                        
                        <div class="col-md-12"> 
                            <h1><span style="color:#5d5d5d;">You haven't added any account.</span> You should get started now.</h1>
                        </div>                                       
                    </div>                                   
                    <div class="row">
                        <div class="col-md-12"style="padding-top:20px;">
                            <input type="submit" class="btn btn-info btn-rounded pull-right" name="aa" value="+Add Goals">                                               
                        </div>
                    </div>

                </div>
            </div>
        </div>                                               
    </div><!-- Row -->
</div><!-- Main Wrapper -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color:transparent; margin-top: 140px;">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:12px; margin-right: -14px;opacity:1;">
                    <img src="<?php echo base_url(); ?>assets/images/close.png"></button>                                                            
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white">

                            <div class="panel-body">
                                <?php if ($this->session->flashdata('message')) : ?>
                                    <p><?php echo $this->session->flashdata('message') ?></p>
                                <?php endif; ?>
                                <div role="tabpanel">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#tab1" role="tab" data-toggle="tab">Add Accounts</a></li>
                                        <li role="presentation"><a href="#tab2" role="tab" data-toggle="tab">Upload Statements</a></li>
                                        <li role="presentation"><a href="#tab3" id="auto_refresh" role="tab" data-toggle="tab">Add Transaction</a></li>

                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content" style="min-height: 230px;">
                                        <div role="tabpanel" class="tab-pane active" id="tab1">
                                            <div class="col-md-12">
                                                <p style="float:left;" id="ac_id"></p>
                                            </div>
                                            <form id="add_account" method="POST" action=''>
                                                <div class="col-md-6">
                                                    <div class="form-group"> 
                                                        <?php
                                                        $options = array(
                                                            '' => 'Please select account type',
                                                            'Credit' => 'Credit',
                                                            'Saving' => 'Saving',
                                                            'Current' => 'Current',
                                                        );
                                                        //echo form_dropdown('type_of_account', $options, '', 'class="form-control"','id=type_of_account');
                                                        echo form_dropdown('type_of_account', $options, '', 'class="form-control" id="type_of_account"');
                                                        ?>
                                                        <!--<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Type of Account">-->
                                                    </div>                                                                                                
                                                    <div class="form-group" style="margin-top: 30px;"> 
                                                        <?php
                                                        $loginid = array(
                                                            'type' => 'text',
                                                            'name' => 'bank_id',
                                                            'id' => 'bankId',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Login ID',
                                                            'required' => 'required'
                                                        );
                                                        echo form_error('bank_id')
                                                        ?>
                                                        <?php echo form_input($loginid) ?>			 		
                                                        <!--<input type="text" class="form-control" id="exampleInputPassword1" placeholder="Login ID">-->
                                                    </div>                                                                                                
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"> 
                                                        <?php
                                                        echo form_dropdown('institution_name', $all_institution_list, '', 'class="form-control" id="institution_name"');
                                                        ?>
                                                        <!--<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name Of Institution">-->
                                                    </div>
                                                    <div class="form-group" style="margin-top: 30px;">  
                                                        <?php
                                                        $login_pwd = array(
                                                            'type' => 'password',
                                                            'name' => 'bank_password',
                                                            'id' => 'bank_pwd',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Password',
                                                            'required' => 'required'
                                                        );
                                                        echo form_error('bank_password')
                                                        ?>
                                                        <?php echo form_input($login_pwd) ?>			 				
                                                        <!--<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">-->
                                                    </div>  
                                                    <div class="form-group" style="margin-top: 30px;">                                            
                                                        <input type="submit" name="account_submit" class="btn btn-info pull-right" style="padding-right: 30px; padding-left: 30px;" value="Add Account">                                              
                                                    </div> 

                                                </div>                                                                                            
                                            </form>


                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="tab2">
                                            <form id="upload_csv">
                                                <div class="col-md-6">
                                                    <div class="form-group">                                           
                                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Type of Account">
                                                    </div>
                                                    <div class="checkbox" style="padding-top:30px;">                                            
                                                        <input type="checkbox"> PDF   <input type="checkbox"> CSV                                          
                                                    </div>
                                                    <div class="checkbox">                                            
                                                        <span style="position:absolute; margin-top:3px;">Browse File</span>  <input type="file" style="margin-left:91px; margin-top: 40px;height: 34px;" >
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">                                           
                                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name Of Institution">
                                                    </div>

                                                    <div class="form-group">                                           
                                                        <button type="submit" class="btn btn-info pull-right" style="padding-right: 30px; padding-left: 30px; margin-top:100px;">Upload</button>
                                                    </div>

                                                </div>

                                            </form>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="tab3">
                                            <div class="col-md-12">
                                                <p style="float:left;" id="tran_id"></p>
                                            </div>
                                            <form id="user_trans" method="POST" action="">

                                                <div class="col-md-6">
                                                    <div class="form-group" id="transaction_type_select"> 
                                                        <?php
                                                        if (!isset($type)) {
                                                            $type = array("" => "No Type Selected");
                                                        }
                                                        echo form_dropdown('tran_type', $type, '', 'class="form-control tran_type" id="tran_type"');
                                                        ?>
                                                        <!--<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Type of Account">-->
                                                    </div>
                                                    <div class="form-group" style="margin-top: 30px;"> 
                                                        <?php
                                                        echo form_dropdown('tran_category', $category_list, '', 'class="form-control" id="tran_category"');
                                                        ?>
                                                        <!--<input type="text" class="form-control" id="exampleInputPassword1" placeholder="Login ID">-->
                                                    </div>  
                                                    <div class="form-group" style="margin-top: 30px;">  
                                                        <?php
                                                        $date = array(
                                                            'type' => 'text',
                                                            'name' => 'date',
                                                            'id' => 'datetimepicker_tran',
                                                            'value' => '',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Date',
                                                            'required' => 'required'
                                                        );
                                                        echo form_error('date')
                                                        ?>
                                                        <?php echo form_input($date) ?>
                                                        <!--<input type="text" class="form-control" id="exampleInputPassword1" placeholder="Login ID">-->
                                                    </div> 
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="trans_account_select">
                                                        <?php
                                                        if (!isset($ins)) {
                                                            $ins = array("" => "Select Institution Name");
                                                        }
                                                        echo form_dropdown('trans_account', $ins, '', 'class="form-control" id="trans_account"');
                                                        ?>
                                                        <!--<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name Of Institution">-->
                                                    </div>
                                                    <div class="form-group" style="margin-top: 30px;">  
                                                        <?php
                                                        $account_amount = array(
                                                            'type' => 'text',
                                                            'name' => 'cat_amount',
                                                            'id' => 'catamt',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Amount',
                                                            'required' => 'required',
                                                            'value' => ''
                                                        );
                                                        echo form_error('cat_amount')
                                                        ?>
                                                        <?php echo form_input($account_amount) ?>
                                                        <!--<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">-->
                                                    </div> 

                                                    <div class="form-group" style="margin-top: 30px;">                                            
                                                        <input type="submit" id="trans_submit" value="Add Transaction" class="btn btn-info pull-right" style="padding-right: 30px; padding-left: 30px;">
                                                    </div>

                                                </div>                                                                                            
                                            </form>
                                            <script type="text/javascript">
                                                $(function () {

                                                    $(document.body).delegate('.tran_type', 'change', function () {
                                                        //alert('The option with value ' + $(this).val());
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "<?php echo site_url() . "/account/name_institution_for_add_transaction" ?>",
                                                            data: {account_type: $(this).val()},
                                                            cache: false,
                                                            success: function (html)
                                                            {
                                                                //alert(html);
                                                                $("#trans_account_select").html(html);
                                                            }
                                                        });
                                                    });
                                                });
                                            </script>
                                        </div>                                                
                                    </div>
                                </div>
                            </div>
                        </div>                                 
                    </div>                            
                </div>
            </div>

        </div>
    </div>
</div>

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
                                <div class="col-md-12"><h1 style="padding-bottom:20px;">Add Deposit</h1></div>
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
                                <p style="float:left;" id="dep_msg"></p>
                            </div>
                        </div>                                 
                    </div>                            
                </div>
            </div>
        </div>
    </div>
</div>
<!--End of add deposit model html-->


<!--Add Property HTML Start Here-->
<!-- Modal -->
<div class="modal fade" id="add_property" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                <div class="col-md-12"><h1 style="padding-bottom:20px;">Add Property</h1></div>
                                <form id="poperty_frm">
                                    <div class="col-md-6">
                                        <div class="form-group">  
                                            <label>Name of the property</label>
                                            <?php
                                            $propery_name = array(
                                                'type' => 'text',
                                                'name' => 'propery_name',
                                                'id' => 'propery_name',
                                                'class' => 'form-control',
                                                'placeholder' => '',
                                                'required' => 'required'
                                            );
                                            echo form_error('propery_name')
                                            ?>
                                            <?php echo form_input($propery_name) ?>	

                                        </div>
                                        <div class="form-group" style="margin-top: 30px; "> 
                                            <label>Value of the property</label><br>
                                            <?php
                                            echo form_dropdown('property_currency', $currency, '144', 'class="form-control" id="property_currency" style="width:40%;display: inline-block !important;"');
                                            ?>
                                            <?php
                                            $propery_amount = array(
                                                'type' => 'text',
                                                'name' => 'propery_amount',
                                                'id' => 'propery_amount',
                                                'class' => 'form-control',
                                                'placeholder' => 'amount...',
                                                'style' => 'width:58%;display: inline-block !important;',
                                                'required' => 'required'
                                            );
                                            echo form_error('propery_amount')
                                            ?>
                                            <?php echo form_input($propery_amount); ?>	
                                        </div> 
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">   
                                            <label>Address of the property</label>
                                            <?php
                                            $propery_address = array(
                                                'type' => 'text',
                                                'name' => 'propery_address',
                                                'id' => 'propery_address',
                                                'class' => 'form-control',
                                                'placeholder' => '',
                                                'required' => 'required'
                                            );
                                            echo form_error('propery_address')
                                            ?>
                                            <?php echo form_input($propery_address); ?>      

                                        </div>

                                        <div class="form-group" style="margin-top: 30px;">                                            
                                            <label>Date of purchase</label>
                                            <?php
                                            $propery_pur_date = array(
                                                'type' => 'text',
                                                'name' => 'propery_pur_date',
                                                'id' => 'propery_pur_date',
                                                'class' => 'form-control',
                                                'placeholder' => 'DD-MM-YYYY',
                                                'required' => 'required'
                                            );
                                            echo form_error('propery_pur_date')
                                            ?>
                                            <?php echo form_input($propery_pur_date); ?> 
                                        </div> 

                                        <div class="form-group" style="margin-top: 30px;">                                            
                                            <button type="submit" name="property_submit" class="btn btn-info pull-right" style="padding-right: 30px; padding-left: 30px;">Submit</button>
                                        </div>
                                    </div>                                                                                            
                                </form>
                                <p style="float:left;" id="prp_msg"></p>
                            </div>
                        </div>                                 
                    </div>                            
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Here-->

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


<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>-->
<script type="text/javascript">
    $(document).ready(function () {

        $('form#add_account').removeAttr('action');
        $('form#user_trans').removeAttr('action');
        $('form#loan_form').removeAttr('action');
        $("form#add_account").submit(function (e) {
            //alert('jjj');

            e.preventDefault();
            var type_of_account = $('#type_of_account').val();
            var institution_name = $('#institution_name').val();
            var bank_id = $('#bankId').val();
            var bank_password = $('#bank_pwd').val();
            if (type_of_account == "" && institution_name == "" && bank_id == "" && bank_password == "")
            {
                alert("Please fill all details");
                return false;
            }
            add_account_vals(type_of_account, institution_name, bank_id, bank_password);
        });

        $("form#user_trans").submit(function (e) {
            e.preventDefault();
            var type_of_account = $('#tran_type').val();
            var institution_id = $('#trans_account').val();
            var category = $('#tran_category').val();
            var catamt = $('#catamt').val();
            var date = $('#date').val();
            //var bank_id = $('#bankId').val();
            //var bank_pwd = $('#bank_pwd').val();
            /*if(type_of_account == "" && institution_name == "" && category == "" && catamt == "" && date=="")
             {
             alert("Please fill all details");
             return false;
             }*/
            addtransaction_vals(type_of_account, institution_id, category, catamt, date);
        });

        $('#auto_refresh').click(function () {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url() . "/account/acount_types_for_add_transaction" ?>",
                data: '',
                cache: false,
                success: function (html)
                {
                    $("#transaction_type_select").html(html);
                }
            });
        });
        $("form#loan_form").submit(function (e) {
            e.preventDefault();
            var loan_account = $('#loan_account').val();
            var loan_currency = $('#loan_currency').val();
            var loan_outamt = $('#loan_outamt').val();
            var end_date = $('#end_date').val();
            var loan_acnumber = $('#loan_acnumber').val();
            var start_date = $('#start_date').val();
            loan_vals(loan_account, loan_currency, loan_outamt, end_date, loan_acnumber, start_date);
        });
        $("form#poperty_frm").submit(function (e) {
            e.preventDefault();
            var propery_name = $('#propery_name').val();
            var property_currency = $('#property_currency').val();
            var propery_amount = $('#propery_amount').val();
            var propery_address = $('#propery_address').val();
            var propery_pur_date = $('#propery_pur_date').val();
            property_vals(propery_name, property_currency, propery_amount, propery_address, propery_pur_date);
        });

        $("form#deposit_form").submit(function (e) {
            e.preventDefault();
            var deposit_account = $('#deposit_account').val();
            var deposit_currency = $('#deposit_currency').val();
            var deposit_amount = $('#deposit_amount').val();
            var deposit_endate = $('#deposit_endate').val();
            var deposit_acnumber = $('#deposit_acnumber').val();
            var deposit_stdate = $('#deposit_stdate').val();
            deposit_vals(deposit_account, deposit_currency, deposit_amount, deposit_endate, deposit_acnumber, deposit_stdate);
        });

        // $('#datetimepicker_tran').datetimepicker();
    });

    function deposit_vals(deposit_account, deposit_currency, deposit_amount, deposit_endate, deposit_acnumber, deposit_stdate)
    {
        var str = "deposit_account=" + deposit_account + "&deposit_currency=" + deposit_currency + "&deposit_amount=" + deposit_amount + "&deposit_endate=" + deposit_endate + "&deposit_acnumber=" + deposit_acnumber + "&deposit_stdate=" + deposit_stdate;
        $.ajax
                ({
                    type: "POST",
                    url: "<?php echo base_url() . "account/deposit_vals" ?>",
                    data: str,
                    cache: false,
                    success: function (html)
                    {
                        $("#dep_msg").html(html);
                        $("#deposit_amount").val("");
                        $('#deposit_endate').val("");
                        $('#deposit_acnumber').val("");
                        $('#deposit_stdate').val("");
                    }
                });
    }

    function property_vals(propery_name, property_currency, propery_amount, propery_address, propery_pur_date)
    {
        var str = "propery_name=" + propery_name + "&property_currency=" + property_currency + "&propery_amount=" + propery_amount + "&propery_amount=" + propery_amount + "&propery_address=" + propery_address + "&propery_pur_date=" + propery_pur_date;
        $.ajax
                ({
                    type: "POST",
                    url: "<?php echo base_url() . "account/property_vals" ?>",
                    data: str,
                    cache: false,
                    success: function (html)
                    {
                        $("#prp_msg").html(html);
                        $("#propery_name").val("");
                        $('#propery_amount').val("");
                        $('#propery_address').val("");
                        $('#propery_pur_date').val("");
                    }
                });
    }


    function loan_vals(loan_account, loan_currency, loan_outamt, end_date, loan_acnumber, start_date)
    {
        var str = "loan_account=" + loan_account + "&loan_currency=" + loan_currency + "&loan_outamt=" + loan_outamt + "&end_date=" + end_date + "&loan_acnumber=" + loan_acnumber + "&start_date=" + start_date;
        $.ajax
                ({
                    type: "POST",
                    url: "<?php echo base_url() . "account/addLoan" ?>",
                    data: str,
                    cache: false,
                    success: function (html)
                    {
                        $("#loan_id").html(html);
                        $('#loan_account').val("");
                        //$('#loan_currency').val("");
                        $('#loan_outamt').val("");
                        $('#end_date').val("");
                        $('#loan_acnumber').val("");
                        $('#start_date').val("");
                    }
                });
    }



    function add_account_vals(type_of_account, institution_name, bank_id, bank_password)
    {
        var str = "type_of_account=" + type_of_account + "&institution_name=" + institution_name + "&bank_id=" + bank_id + "&bank_password=" + bank_password
        $.ajax({
            type: "POST",
            url: "<?php echo site_url() . "/account/addAccount" ?>",
            data: str,
            cache: false,
            success: function (html)
            {
                $("#ac_id").html(html);
                $('#type_of_account').val("");
                $('#institution_name').val("");
                $('#bankId').val("");
                $('#bank_pwd').val("");
            }
        });
    }

    function addtransaction_vals(type_of_account, institution_id, category, catamt, date)
    {
        var str = "type_of_account=" + type_of_account + "&institution_id=" + institution_id + "&category=" + category + "&catamt=" + catamt + "&date=" + date;
        $.ajax
                ({
                    type: "POST",
                    url: "<?php echo site_url() . "/account/addTransaction" ?>",
                    data: str,
                    cache: false,
                    success: function (html)
                    {
                        $("#tran_id").html(html);

                        $('#tran_type').val("");
                        $('#trans_account').val("");
                        $('#tran_category').val("");
                        $('#catamt').val("");
                        $('#datetimepicker_tran').val("");
                    }
                });
    }

</script>