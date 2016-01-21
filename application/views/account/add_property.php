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
                                <div class="col-md-12">
                                        <p style="float:left;" id="prp_msg"></p>
                                        </div>
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
                                
                            </div>
                        </div>                                 
                    </div>                            
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Here-->