
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
            var trans_desc = $('#trans_desc').val(); 
            //var bank_id = $('#bankId').val();
            //var bank_pwd = $('#bank_pwd').val();
            /*if(type_of_account == "" && institution_name == "" && category == "" && catamt == "" && date=="")
             {
             alert("Please fill all details");
             return false;
             }*/
            addtransaction_vals(type_of_account, institution_id, category, catamt, date, trans_desc);
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

    function addtransaction_vals(type_of_account, institution_id, category, catamt, date, trans_desc)
    {
        var str = "type_of_account=" + type_of_account + "&institution_id=" + institution_id + "&category=" + category + "&catamt=" + catamt 
                + "&date=" + date + "&trans_desc =" + trans_desc;
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
                        $('#trans_desc').val("");
                    }
                });
    }

</script>