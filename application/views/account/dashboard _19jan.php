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
                <img src="<?php echo base_url(); ?>assets/images/addnew.png" alt=""> <a href="#" style="text-decoration: none;" data-toggle="modal" data-target="#myModal"><span style="margin-left:10px; ">Add Account</span></a>

            </div>
        </div>
    </div>
    <div class="row">   
        <?php $this->load->view('common/left_accordian'); ?>
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
                                <form>
                                    <div class="col-md-6">
                                        <div class="form-group">  
                                            <label>Add Loan amount</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="">
                                        </div>
                                        <div class="form-group" style="margin-top: 30px; "> 
                                            <label>Value of the property</label><br>
                                            <input type="text" style="width:40%;display: inline-block !important;" class="form-control" id="exampleInputPassword1" placeholder="currency...">
                                            <input type="text" style="width:58%;display: inline-block !important;" class="form-control" id="exampleInputPassword1" placeholder="amount...">
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">   
                                            <label>Address of the property</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder=""> 
                                        </div>
                                        <div class="form-group" style="margin-top: 30px;">                                            
                                            <label>Date of purchase</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="DD/MM/YYYY">
                                        </div> 
                                        <div class="form-group" style="margin-top: 30px;">                                            
                                            <button type="submit" class="btn btn-info pull-right" style="padding-right: 30px; padding-left: 30px;">Submit</button>
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
                                <form>
                                    <div class="col-md-6">
                                        <div class="form-group">  
                                            <label>Name of the property</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="">
                                        </div>
                                        <div class="form-group" style="margin-top: 30px; "> 
                                            <label>Value of the property</label><br>
                                            <input type="text" style="width:40%;display: inline-block !important;" class="form-control" id="exampleInputPassword1" placeholder="currency...">
                                            <input type="text" style="width:58%;display: inline-block !important;" class="form-control" id="exampleInputPassword1" placeholder="amount...">
                                        </div> 
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">   
                                            <label>Address of the property</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder=""> 
                                        </div>
                                        <div class="form-group" style="margin-top: 30px;">                                            
                                            <label>Date of purchase</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="DD/MM/YYYY">
                                        </div> 
                                        <div class="form-group" style="margin-top: 30px;">                                            
                                            <button type="submit" class="btn btn-info pull-right" style="padding-right: 30px; padding-left: 30px;">Submit</button>
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
                                <form>
                                    <div class="col-md-6">
                                        <div class="form-group">  
                                            <label>Add Loan amount</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="">
                                        </div>
                                        <div class="form-group" style="margin-top: 30px; "> 
                                            <label>Value of the property</label><br>
                                            <input type="text" style="width:40%;display: inline-block !important;" class="form-control" id="exampleInputPassword1" placeholder="currency...">
                                            <input type="text" style="width:58%;display: inline-block !important;" class="form-control" id="exampleInputPassword1" placeholder="amount...">
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">   
                                            <label>Address of the property</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder=""> 
                                        </div>
                                        <div class="form-group" style="margin-top: 30px;">                                            
                                            <label>Date of purchase</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="DD/MM/YYYY">
                                        </div> 
                                        <div class="form-group" style="margin-top: 30px;">                                            
                                            <button type="submit" class="btn btn-info pull-right" style="padding-right: 30px; padding-left: 30px;">Submit</button>
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
<!--End Here-->

<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>-->
<script type="text/javascript">
    $(document).ready(function () {

        $('form#add_account').removeAttr('action');
        $('form#user_trans').removeAttr('action');
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


        // $('#datetimepicker_tran').datetimepicker();
    });
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