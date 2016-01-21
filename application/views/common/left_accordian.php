<div class="col-md-3">

    <div class="panel-heading clearfix">
        <h3 class="panel-title">Accordion</h3>
    </div>
    <div class="panel-body">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <img src="<?php echo base_url(); ?>assets/images/bank.png" alt=""> <span style="margin-left:40px;">Bank</span>
                        </a>
                    </h4>
                </div>
                <div style="height: 0px;" aria-expanded="false" id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <?php
                        echo $accounts_list_bank;
                        ?>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingtwo">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsetwo" aria-expanded="false" aria-controls="collapsetwo">
                            <img src="<?php echo base_url(); ?>assets/images/creditcards.png" alt=""> <span style="margin-left:40px;">Credit Cards</span>
                        </a>
                    </h4>
                </div>
                <div style="height: 0px;" aria-expanded="false" id="collapsetwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingtwo">
                    <div class="panel-body">
                        <?php echo $accounts_list_credit; ?>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <img src="<?php echo base_url(); ?>assets/images/Loans.png" alt=""> 
                            <span style="margin-left:40px;">Loan</span>
                            <?php
                            $cur_sum = 0;
                            if (sizeof($loan_dis_val) > 0) {
                                foreach ($loan_dis_val as $loan_key => $loan_dis) {
                                    $cur_sum += $loan_dis->loan_amount;
                                    $currency = $loan_dis->currency_type;
                                }
                                echo '<span>' . $currency . ' ' . $cur_sum . '</span>';
                            }
                            ?>
                        </a>
                        <a href="#" class="pull-right glink" data-toggle="modal" data-target="#add_loan">Add</a>
                    </h4>
                </div>
                <div style="height: 0px;" aria-expanded="false" id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
<?php
if (sizeof($loan_dis_val) > 0) {
    foreach ($loan_dis_val as $loan_key => $loan_dis) {
        echo '<div class="sc">' . $loan_dis->account_name . ' ' . $loan_dis->currency_type . ' ' . $loan_dis->loan_amount . '</div>';
    }
}
?>  
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingfour">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="false" aria-controls="collapseOne">
                            <img src="<?php echo base_url(); ?>assets/images/investment.png" alt=""> <span style="margin-left:40px;">Investment</span>
                        </a>
                    </h4>
                </div>
                <div style="height: 0px;" aria-expanded="false" id="collapsefour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <div class="sc">HSBC $455.44</div>
                        <div class="sc">HSBC $455.44</div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingfive">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsefive" aria-expanded="false" aria-controls="collapseOne">
                            <img src="<?php echo base_url(); ?>assets/images/property.png" alt=""> <span style="margin-left:40px;">Property <span>$907.91</span></span></a>

                        <a href="#" class="pull-right glink" data-toggle="modal" data-target="#add_property">Add</a>

                    </h4>
                </div>
                <div style="height: 0px;" aria-expanded="false" id="collapsefive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <div class="sc">HSBC $455.44</div>
                        <div class="sc">HSBC $455.44</div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingsix">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsesix" aria-expanded="false" aria-controls="collapseOne">
                            <img src="<?php echo base_url(); ?>assets/images/deposit.png" alt=""> <span style="margin-left:40px;">Deposit</span>
<?php
$dep_sum = 0;
if (sizeof($deposit_display) > 0) {
    foreach ($deposit_display as $dep_key => $dep_dis) {
        $dep_sum += $dep_dis->deposit_amount;
        $dep_currency = $dep_dis->currency_type;
    }
    echo '<span>' . $dep_currency . ' ' . $dep_sum . '</span>';
}
?>
                        </a>

                        <a href="#" class="pull-right glink" data-toggle="modal" data-target="#add_deposit">Add</a>
                    </h4>
                </div>
                <div style="height: 0px;" aria-expanded="false" id="collapsesix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
<?php
if (sizeof($deposit_display) > 0) {
    foreach ($deposit_display as $dep_key => $dep_dis) {
        echo '<div class="sc">' . $dep_dis->account_name . ' ' . $dep_dis->currency_type . ' ' . $dep_dis->deposit_amount . '</div>';
    }
}
?>  
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>