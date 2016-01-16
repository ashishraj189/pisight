<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#trans_submit").click(function () {
            var type_of_account = $('#type_of_account').val();
            var institution_name = $('#institution_name').val();
            var category = $('#category').val();
            var catamt = $('#catamt').val();
            var date = $('#date').val();
            var bank_id = $('#bankId').val();
            var bank_pwd = $('#bank_pwd').val();
            /*if(type_of_account == "" && institution_name == "" && category == "" && catamt == "" && date=="")
             {
             alert("Please fill all details");
             return false;
             }*/
            addtransaction_vals(type_of_account, institution_name, category, catamt, date, bank_id, bank_pwd);
        });
    });
    function addtransaction_vals(type_of_account, institution_name, category, catamt, date, bank_id, bank_pwd)
    {
        var str = "type_of_account=" + type_of_account + "&institution_name=" + institution_name + "&category=" + category + "&catamt=" + catamt + "&date=" + date
                + "&bank_id=" + bank_id + "&bank_pwd=" + bank_pwd;
        $.ajax
                ({
                    type: "POST",
                    url: "<?php echo base_url() . "account/addTransaction" ?>",
                    data: str,
                    cache: false,
                    success: function (html)
                    {
                        $("#text").html(html);
                        alert(html);
                        //$('#type_of_account').val("");
                        //$('#institution_name').val("");
                        //$('#category').val("");
                        //$('#catamt').val("");
                        //$('#date').val("");
                    }
                });
    }
</script>

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
                    <?php echo form_open('account/addTransaction') ?>
                    <?php if ($this->session->flashdata('message')) : ?>
                        <p><?php echo $this->session->flashdata('message') ?></p>
                    <?php endif; ?>
                    <div class="form-group">
                        <?php
                        echo form_dropdown('type_of_account', $type, '', 'class="form-control" id="type_of_account"');
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        echo form_dropdown('institution_name', $ins, '', 'class="form-control" id="institution_name"');
                        ?>
                    </div>  
                    <div class="form-group">
                        <?php
                        $options = array(
                            '' => 'Please select category',
                            'gas' => 'Gas &amp; Fuel',
                            'shop' => 'Shopping',
                            'groc' => 'Grocery'
                        );
                        echo form_dropdown('category', $options, '', 'class="form-control" id="category"');
                        ?>
                    </div>    

                    <div class="form-group">
                        <?php
                        $loginid = array(
                            'type' => 'text',
                            'name' => 'bank_id',
                            'id' => 'bankId',
                            'class' => 'form-control',
                            'placeholder' => 'Login Id',
                            'required' => 'required'
                        );
                        echo form_error('bank_id')
                        ?>
                        <?php echo form_input($loginid) ?>			 				
                    </div> 						 
                    <div class="form-group">
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
                    </div> 	


                    <div class="form-group">
                        <?php
                        $catinfo = array(
                            'type' => 'text',
                            'name' => 'cat_amount',
                            'id' => 'catamt',
                            'class' => 'form-control',
                            'placeholder' => 'Amount',
                            'required' => 'required'
                        );
                        echo form_error('cat_amount')
                        ?>
                        <?php echo form_input($catinfo) ?>			 				
                    </div> 						 
                    <div class="form-group">
                        <?php
                        $date = array(
                            'type' => 'text',
                            'name' => 'date',
                            'id' => 'date',
                            'class' => 'form-control',
                            'placeholder' => 'Date',
                            'required' => 'required'
                        );
                        echo form_error('date')
                        ?>
                        <?php echo form_input($date) ?>			 				
                    </div> 	
                    <button type="button" name="trans_submit" id="trans_submit" value="Submit" class="btn btn-info pull-right" style="padding-right: 30px; padding-left: 30px;">Submit</button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">                            
        </div>

    </div><!-- Row -->
</div><!-- Main Wrapper -->