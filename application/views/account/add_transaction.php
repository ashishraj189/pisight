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
                                                        <?php
                                                        $trans_desc = array(
                                                            'type' => 'text',
                                                            'name' => 'trans_desc',
                                                            'id' => 'trans_desc',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Description',
                                                            'required' => 'required',
                                                            'value' => '',
                                                            'maxlenght' => 50,
                                                        );
                                                        echo form_error('trans_desc')
                                                        ?>
                                                        <?php echo form_input($trans_desc) ?>
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
                                                        //alert($(this).val());
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