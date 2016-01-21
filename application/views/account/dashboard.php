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


<?php echo $this->load->view('account/add_transaction');?>
<?php echo $this->load->view('account/add_deposit');?>
<?php echo $this->load->view('account/add_property');?>
<?php echo $this->load->view('account/add_loan');?>
<?php echo $this->load->view('common/dashboard_script');?>
