var timeoutID; 
var user_id;
var email_flag = true; // for email unique validation
$(document).ready(function(){
   
    $('#file_trriger').click(function(){
        $('#image_change').trigger('click');
    }); 
    if($(".fancybox").length > 0)
    {
        $(".fancybox").fancybox();     
    }
    //new date time picker js code 
    if (jQuery().datetimepicker) {
        $(".form_datetime").datetimepicker({
            autoclose: true,
            isRTL: Metronic.isRTL(),
            format: "dd MM yyyy - HH:ii P",
            pickerPosition: (Metronic.isRTL() ? "bottom-right" : "bottom-left"),
            lazyInit:true,
            endDate:new Date()
        });
    }
	/*
    <!-- old date time picker js code -->
    if (jQuery().datetimepicker) {
        $(".form_meridian_datetime").datetimepicker({
            isRTL: Metronic.isRTL(),
            format: "dd MM yyyy - HH:ii P",
            showMeridian: true,
            autoclose: true,
            lang:'en',
            pickerPosition: (Metronic.isRTL() ? "bottom-right" : "bottom-left"),
            todayBtn: true,
            endDate:new Date(),
            todayButton:true,
            defaultSelect:true,
            timepickerScrollbar:true,
            formatTimeScroller:'g:i a',
            scrollMonth:true,
            scrollTime:true,
            maxDate:0, // now 
            maxTime:0, // now 
        });
        //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
    }*/
 

    if($('#date').length > 0){
        window.setTimeout( function(){            
            $('#date').datepicker({format: 'mm/dd/yyyy'});
        },1000);
    }

    if($('.date_picker').length > 0){
        window.setTimeout( function(){            
            $('.date_picker').datepicker({format: 'dd-mm-yyyy',startDate:new Date()});
        },200);
    }

    if($('.time_picker').length > 0)
    {
        window.setTimeout( function()
        {            
            $('.time_picker').timepicker({defaultTime:'',format: 'HH:ii P'});
        },200);
    }

    if($('.date_picker_all_date').length > 0){
        window.setTimeout( function(){            
            $('.date_picker_all_date').datepicker({format: 'dd-mm-yyyy'});
        },1000);
    }
   
	$("#v_coupon_code").keyup(function(event) {
        $(this).val( $(this).val().toUpperCase().replace(/[^a-zA-Z0-9]/g,"") );
    });
   
   $(document).on("change",".parent_service",function () {
        var color_code = $(".parent_service option:selected").attr('color-code');
        if($(this).val() == '0')
        {
            $("#color_picker").show(); 
            $("#service_color").val(color_code);
            $("#service_color").addClass('required');
        } else {
            $("#service_color").val(color_code);
            $("#color_picker").hide();
            $("#service_color").removeClass('required');
        }
    });
    
    $(document).on("click","#delete_record",function () {
        var url = $(this).attr('delete-url');
        var arrId = $(this).attr('rel');
        var el = $(this);
        if(arrId != '') {
            bootbox.confirm('Are you sure you want to delete this record?', function (confirmed) {
            if(confirmed){                                  
                $.get(url, function (data){
                    if($.trim(data) == "TRUE") {
                        $('.alert-success:first').show();
                        $('.alert-success:visible .message').html('Record deleted successfully.');
                        
                        el.closest('tr').fadeOut(1500, function() {
                            $(this).closest('tr').remove();
                            if($("#datatable_ajax tbody > tr").length <= 1) {
                                $(".filter-submit").trigger( "click" );
                            }
                        });    
                        
                        setTimeout(function(){ $('.alert-success').fadeOut(4000); },3000);                        
                    }
                });
            }
            }); 
        }      
    });



    $(document).on("click","#restore_record",function () {
        var url = $(this).attr('restore-url');
        var arrId = $(this).attr('rel');
        var el = $(this);
        if(arrId != '') 
        {
            bootbox.confirm('Are you sure you want to restore this record?', function (confirmed) {
            if(confirmed){                                  
                $.get(url, function (data){
                    if($.trim(data) == "TRUE") {
                        $('.alert-success:first').show();
                        $('.alert-success:visible .message').html('Record restore successfully.');
                        
                        el.closest('tr').fadeOut(1500, function() {
                            $(this).closest('tr').remove();
                            if($("#datatable_ajax tbody > tr").length <= 1) {
                                $(".filter-submit").trigger( "click" );
                            }
                        });    
                        
                        setTimeout(function(){ $('.alert-success').fadeOut(4000); },3000);                        
                    }
                });
            }
            }); 
        }      
    });

    $(document).on("click","#change_status",function () {
        var url = $(this).attr('status-url');
        var arrId = $(this).attr('rel');
        var status = $(this).attr('status');
        var el = $(this);

        if(arrId != '') {
            bootbox.confirm('Are you sure you want to '+status+' this plan?', function (confirmed) {
            if(confirmed){ 
                $.get(url, function (data){
                    if($.trim(data) == "TRUE") {
                        $('.alert-success:first').show();
                        $('.alert-success:visible .message').html('Record  '+status+' successfully.');
                        
                        if(status != "Give Refund")
                        {
                            el.closest('tr').fadeOut(1500, function() {
                                $(this).closest('tr').remove();
                                if($("#datatable_ajax tbody > tr").length <= 1) {
                                    $(".filter-submit").trigger( "click" );
                                }
                            });    
                        }
                        else
                        {
                            window.location.href = window.location.href; 
                        }
                        setTimeout(function(){ $('.alert-success').fadeOut(4000); },3000);                        
                    }
                });
            }
            }); 
        }      
    });

    
    $(".image_upload").change(function(){
          read_image(this);
    });

    /*$(".pdf_upload").change(function(){
          read_pdf(this);
    });*/

    
    $(".file_upload").click(function(){
          $('.image_upload').trigger('click');
    });

    $(".pdf_file_upload").click(function(){
          $('.pdf_upload').trigger('click');
    });

    /*** End Image upload without crop ***/
    
    // In service_price_plan change type of
    $('#e_type').change(function(event) {
       if($(this).val()=='Normal'){
         
          $('.v_includes_div').removeClass('display-none');
    
          $('#i_service_id').addClass('required');
          $('.i_service_id_div').show();

          $('#e_content_display').val('Center');
          $('#e_content_display').attr("disabled", true); 
        
       }
       else
       {
          $('.v_includes_div input').val('');
          $('.v_includes_div').addClass('display-none');
          $('#v_selection').removeClass('required');
          $('#i_service_id').removeClass('required');
          $('.i_service_id_div').hide();
           

       }

	   if($(this).val()=="SubPlan")
       {
           $('#i_selection_number').closest('.form-group').show();
           $('#i_selection_number').addClass('required');
		   
		   $('#f_price').closest('.form-group').hide();
           $('#f_price').removeClass('required');
		   $('#f_price').val('');
           $('#e_content_display').removeClass('required');
           $('#e_content_display_div').hide();
           $('#e_content_display').val('Center');
           $('#e_content_display').attr("disabled", true); 
           $('#v_selection_div').removeClass('display-none');
           $('#v_selection').addClass('required');
          
       }
       else {

           $('#i_selection_number').closest('.form-group').hide();
           $('#i_selection_number').removeClass('required');
           $('#i_selection_number').val('');
		   
		   $('#f_price').closest('.form-group').show();
           $('#f_price').addClass('required');
           if($(this).val() != "Normal")
           {
            $('#v_selection_div').addClass('display-none');
            $('#v_selection').removeClass('required');
            $('#e_content_display').attr("disabled", false); 
            $('#e_content_display').val('');
           }
           else
           {

             $('#e_content_display').val('Center');
             $('#e_content_display').attr("disabled", true); 
           }
       }	 
       
    });
    
    // on change discount type change icon
    $('#e_discount_type').change(function(event) {
       var discount_type = $("#e_discount_type option:selected").attr('rel');
       $('.discount').find('span').addClass('display-none');
       if (discount_type == 'Percentage') {
          $('.discount').find('.percentage').removeClass('display-none');
		  $('.discount_amount').addClass('input_percentage');
          $('#f_maximum_discount').removeAttr('readonly');		  
       }else {
          $('.discount').find('.amount').removeClass('display-none');
		  $('.discount_amount').removeClass('input_percentage');
          $('#f_maximum_discount').attr('readonly','readonly');
       }
	   $('#f_discount').val('');
    });

    $('#f_discount').blur(function(event) {
        var discount_type = $("#e_discount_type option:selected").attr('rel');
        if(discount_type=='Amount')
        {
            $('#f_maximum_discount').val($(this).val());
        }
    });
    
	$("#v_user_ids").click(function(event) {
        if ($("#v_user_ids").is(':checked')) {
            $(".v_user_ids").each(function () {
               $(this).attr("checked", true);
               $(this).removeClass('disabled');
            });
        } else {
            $(".v_user_ids").each(function () {
               $(this).attr("checked", false);
               $(this).removeClass('disabled');
            });
        }
        jQuery.uniform.update(".v_user_ids");
    });
    $("#admin_act_select_all").click(function(event) {
        if ($("#admin_act_select_all").is(':checked')) {
            $("#admin_act_select_all_label").text('Unchecked All');
            $(".user_chk").each(function () {
               $(this).attr("checked", true);
            });
        } else {
            $("#admin_act_select_all_label").text('Select All');
            $(".user_chk").each(function () {
               $(this).attr("checked", false);
            });
        }
        jQuery.uniform.update(".user_chk");
    });
    
   // In service_price_plan change Selection type
    $('#v_selection').change(function(event) {
       var selValue = $(this).val();
       var sel = $('#v_selection option:selected').attr('rel');
       $('.v_selection_value').html(sel);


       if($('#e_type').val()=='SubPlan')
       {    
           var endCount = 0;
            var addOption = '';
            switch (selValue) {
                case 'Quarterly': addOption += '<option value="3">3</option><option value="6">6</option><option value="9">9</option><option value="12">12</option>';
                    break;
                case 'Half Yearly': addOption += '<option value="6">6</option><option value="12">12</option>';
                    break;
				case 'Yearly': addOption += '<option value="12">12</option>';
                    break;
                default: switch (selValue) {                            
                            case 'Montly': endCount=12; break;
                            case 'One-Off': endCount=1; break;
                            case 'Weekly': endCount=52; break;
                            case 'Days': endCount=31; break;
                            default:
                        }
                        for (var i = 1; i <= endCount; i++) {
                            addOption+='<option value="'+i+'">'+i+'</option>';
                        }

            }
            $('#i_selection_number').html(addOption);
			if(selValue=='Yearly' || selValue=='One-Off')
			{				
				$('#i_selection_number').attr('readonly', 'readonly');
			} else {
				$('#i_selection_number').removeAttr('readonly');
			}
            $('#e_content_display').attr("disabled", true); 
            $('#e_content_display').val('Center');
           
       }

    });
    
    $(document).on('click',"#add_row, #add_row1", function()
    {
        $intCounter = $("#v_counter").val();
        $intCounter++;
        if($(this).attr('id') == 'add_row1')
        {
            $("#add_another").append('<div id="row_'+$intCounter+'"  class="form-group"><input type="text" id="v_includes_'+$intCounter+'" maxlength="50" name="v_includes[]" class="form-control" placeholder="Plan include(s)" /><div class="add-row cf"><a class="remove" id1="row_'+$intCounter+'" href="javascript:void(0);"></a></div>');
        }
        else
        {
            $("#add_another").append('<div id="row_'+$intCounter+'" class="form-group"><label class="control-label col-md-3" for="inputWarning"></label><div class="col-md-4"><input id="v_includes_'+$intCounter+'" type="text" name="v_includes[]" maxlength="50" class="form-control" placeholder="Plan include(s)" /></div><div class="add-row cf"><a class="remove" id1="row_'+$intCounter+'" href="javascript:void(0);"></a></div>');
        }
        $("#v_counter").val($intCounter);
    });
    $(document).on('click',".remove", function()
    {
        del_id = $(this).attr('id1');
        $("#"+del_id).remove();
    });
    
});

function hadleAddFormForPdf()
{
    $(".frmAddBtn,.frmAddNewBtn").click(function() {
        $("#buttonClick").val(this.id);
        $('.duplicate_error').hide();
        $(".alert").hide();
        var button_pressed = $(document.activeElement).attr('id');
        if($('.ckeditor').length > 0)
        {
            for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
            }
        }
        if($('#image_val img').prop('src') != undefined && $('#image_val img').prop('src') != '')
        {
            $('#v_image_val').val($('#image_val img').prop('src'));
        }
        $("#frmAdd .alert-danger").hide();
        var $valid = form_valid("#frmAdd");
        if($valid) 
        {
            $('#v_selection').prop('disabled',false);
            var button_pressed_html = $('#'+button_pressed).html();
            $('button[type="submit"]').prop('disabled',true);
            $('#'+button_pressed).html('Please wait...');
            $("#frmAdd").submit();   
        } 
        else 
        {
            $("#frmAdd .alert-danger").show();
            return false;
        }
    });   
}

function hadleAddFormForExcel()
{
    $(".frmAddBtn,.frmAddNewBtn").click(function() {
        $("#buttonClick").val(this.id);
        $('.duplicate_error').hide();
        $(".alert").hide();
        var button_pressed = $(document.activeElement).attr('id');
        
        
        $("#frmAdd .alert-danger").hide();
        var $valid = form_valid("#frmAdd");
        if($valid) 
        {
            $('#v_selection').prop('disabled',false);
            var button_pressed_html = $('#'+button_pressed).html();
            $('button[type="submit"]').prop('disabled',true);
            $('#'+button_pressed).html('Please wait...');
            $("#frmAdd").submit();   
        } 
        else 
        {
            $("#frmAdd .alert-danger").show();
            return false;
        }
    });   
}

function hadleAddForm()
{
    $("#frmAdd").submit(function() {
        $('.duplicate_error').hide();
        $(".alert").hide();
        /*if($('#CkEditor').length > 0 ){ CKEDITOR.instances.CkEditor.updateElement(); }
        if($('#vCkEditor').length > 0){ CKEDITOR.instances.vCkEditor.updateElement(); }
        if($('#CkEditor2').length > 0){ CKEDITOR.instances.CkEditor2.updateElement(); }*/
        var button_pressed = $(document.activeElement).attr('id');
        if($('.ckeditor').length > 0)
        {
            for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
            }
        }
        if($('#image_val img').prop('src') != undefined && $('#image_val img').prop('src') != '')
        {
            $('#v_image_val').val($('#image_val img').prop('src'));
        }
        $("#frmAdd .alert-danger").hide();
        var $valid = form_valid("#frmAdd");
        if($valid) 
        {
            $('#v_selection').prop('disabled',false);
            var button_pressed_html = $('#'+button_pressed).html();
            $('button[type="submit"]').prop('disabled',true);
            $('#'+button_pressed).html('Please wait...');
            $.post($("#frmAdd").attr("action"), $("#frmAdd").serialize(), function(data) {
                if($.trim(data) == 'TRUE'){
                    if(button_pressed == 'New'){
                        window.location.href = window.location.href; 
                    } else {
                        window.location.href = (window.location.href).replace('/add','');
                    }
                } else {
                    $.each(data, function (key,val) {
                        $("#"+key+'_duplicate_error').show();
                        console.log("#"+key+'_duplicate_error');
                    });
                    $('#'+button_pressed).html(button_pressed_html);
                    $('button[type="submit"]').prop('disabled',false);
                }
            });
        } else {
            $("#frmAdd .alert-danger").show();
            return false;
        }
    });
}


// remove uploaded file from page
$(document).on('click',".remove_file_pdf", function()
{
    bootbox.confirm('Are you sure you want to delete this pdf file?', function (confirmed) 
    {
        if(confirmed)
        {                                  
            row_id = $(this).attr('id1');
            $("#v_pdf_file").addClass("required");
            $("#file_"+row_id).remove(); // remove row
            $(".pdfile_uploaded").remove(); // remove row
            if(row_id != '' || row_id != null)
            {
                $.post($('#remove_url_pdf').val(),{},function(responce){
                });
            }
        }
    });
});


function hadleEditFormForPdf()
{
    $(".frmEditBtn").click(function() 
    {
        $("#frmEdit .duplicate-error").hide();
        $("#frmEdit .alert-danger").hide();
        if($('#CkEditor').length > 0 ){ CKEDITOR.instances.CkEditor.updateElement(); }
        if($('#vCkEditor').length > 0){ CKEDITOR.instances.vCkEditor.updateElement(); }
        if($('#CkEditor2').length > 0){ CKEDITOR.instances.CkEditor2.updateElement(); }
        var $valid = form_valid("#frmEdit");
        for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }
        
        if($('#image_val img').prop('src') != undefined && $('#image_val img').prop('src') != '' && $('#image_val img').prop('src').indexOf("base64") > -1)
        {
            $('#v_image_val').val($('#image_val img').prop('src'));
        }
        if($valid){
            var button_pressed_html = $('#Submit').html();
            $('button[type="submit"]').prop('disabled',true).html('Please wait...');
            $("#frmEdit").submit();  
        }
        return false;
    });
}

function hadleEditForm()
{
    $("#frmEdit").submit(function() {
        $("#frmEdit .duplicate-error").hide();
        $("#frmEdit .alert-danger").hide();
        if($('#CkEditor').length > 0 ){ CKEDITOR.instances.CkEditor.updateElement(); }
        if($('#vCkEditor').length > 0){ CKEDITOR.instances.vCkEditor.updateElement(); }
        if($('#CkEditor2').length > 0){ CKEDITOR.instances.CkEditor2.updateElement(); }
        var $valid = form_valid("#frmEdit");
        for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }
        
        if($('#image_val img').prop('src') != undefined && $('#image_val img').prop('src') != '' && $('#image_val img').prop('src').indexOf("base64") > -1)
        {
            $('#v_image_val').val($('#image_val img').prop('src'));
        }
        if($valid){
            var button_pressed_html = $('#Submit').html();
            $('button[type="submit"]').prop('disabled',true).html('Please wait...');
            var send_data = $("#frmEdit").serialize()
            $.post($("#frmEdit").attr("action"), send_data, function(data)
            {
                if($.trim(data) == 'TRUE'){
                    window.location.href = $("#frmEdit").attr('redirect');
                } else {
                    $.each(data, function (key,val) {
                        $("#"+key+'_duplicate_error').show();
                        console.log("#"+key+'_duplicate_error');
                    });
                    $('button[type="submit"]').prop('disabled',false).html(button_pressed_html);
                }
            });
        }
        return false;
    });
}

function handleProfileForm() {
   $("#myprofileform").submit(function() {
        $('.duplicate_error').hide();
        $(".alert").hide();
        $("#myprofileform .alert-danger").hide();
        var $valid = form_valid("#myprofileform");
        //var $valid = $("#myprofileform").valid();
        if($valid) 
        {
            $.post($("#myprofileform").attr("action"), $("#myprofileform").serialize(), function(data) {
                if($.trim(data) == 'TRUE'){
                    window.location.href = window.location.href;
                } else {
                    console.log(data);
                    $.each(data, function (key,val) {
                        $("#"+key+'_duplicate_error').show();
                        $("#"+key+'_duplicate_error').html(val);
                        console.log("#"+key+'_duplicate_error');
                    });
                }
            });
        } else {
            $("#myprofileform .alert-danger").show();
            return false;
        }
    });    
}
function handleAppSettingsForm() {
   $("#appsettingsform").submit(function() {
        $('.duplicate_error').hide();
        $(".alert").hide();
        $("#appsettingsform .alert-danger").hide();
        var $valid = form_valid("#appsettingsform");
        //var $valid = $("#myprofileform").valid();
        if($valid) 
        {
            $.get($("#appsettingsform").attr("action"), $("#appsettingsform").serialize(), function(data) {
                if($.trim(data) == 'TRUE'){
                    window.location.href = window.location.href;
                } else {
                    console.log(data);
                    $.each(data, function (key,val) {
                        $("#"+key+'_duplicate_error').show();
                        $("#"+key+'_duplicate_error').html(val);
                        console.log("#"+key+'_duplicate_error');
                    });
                }
            });
        } else {
            $("#appsettingsform .alert-danger").show();
            return false;
        }
    });    
}
function handleForgetPassword()
{
    $("#forget-form").submit(function() {
        $("#forget-form .alert-danger").hide();
        var $valid = $("#forget-form").valid();
        if($valid) 
        {
            $("#btn-forgot").attr("disabled", true);
            $.post($("#forget-form").attr("action"), $("#forget-form").serialize(), function(data){
                if(data == "TRUE")
        		{
        			$('.login-form').show();
        			$('.forget-form').hide();
        			$(".login-form .forgot-success").show();
                    $("#btn-forgot").attr("disabled", false);
        		}
        		else
        		{
        		  $("#forget-form .alert-danger").show();
                  $("#btn-forgot").attr("disabled", false);	
        		}
    		});
        } else {
            $("#btn-forgot").attr("disabled", false);
            $("#forget-form .alert-danger").show();    
            return false;
        }
    });
}

function handleResetPassword(){
    $("#reset-form").submit(function() {
        $(".alert").hide();
        $("#reset-form .alert-danger").hide();
        var $valid = $("#reset-form").valid();
        if($valid) 
        {
            $("#btn-reset").attr("disabled", true);
            $.post($("#reset-form").attr("action"), $("#reset-form").serialize(), function(data){
                if(data == "TRUE" || data != '')
        		{
        		  window.location.href = $('#returnRedirect').val();    	
        		}
        		else
        		{
        			$('.login-form').show();
        			$('.reset-form').hide();
        			$(".login-form .alert-success").show();
                    $("#btn-reset").attr("disabled", false);
        		}
    		});
        } else {
            $("#btn-reset").attr("disabled", false);
            $("#reset-form .alert-danger").show();    
            return false;
        }
    });
}

function handleApiResetPassword(){
    $("#reset-form-api_submit_button").click(function() {
       //alert('11'); return false;
        $(".alert").hide();
        $("#reset-form-api .alert-danger").hide();
        var $valid = $("#reset-form-api").valid();
        if($valid) 
        { 

            $("#btn-reset").attr("disabled", true);
            document.getElementById("reset-form-api").submit();
            $("#reset-form-api").submit();
            return true;
            
        } else {
            $("#btn-reset").attr("disabled", false);
            $("#reset-form-api .alert-danger").show();    
            return false;
        }
    });
}

function hadleReplyForm()
{
    $("#submit_btn").on('click',function(e) {
        if($('#CkEditor').length > 0 ){ CKEDITOR.instances.CkEditor.updateElement(); }
        $("#frmSendMail .alert-danger").hide();
        var btnText = $(this).html();
        var $valid = form_valid("#frmSendMail");
        if($valid) 
        {
            $("#submit_btn").prop('disabled',true); 
            $("#submit_btn").html('Please wait...');           
            $.post($("#frmSendMail").attr("action"), $("#frmSendMail").serialize(), function(data) {
                if($.trim(data) == 'TRUE'){
                    $('#myModal').modal('toggle'); 
                    $('.alert-success').show();
                    $("#submit_btn").prop('disabled',false);
                    $("#submit_btn").html(btnText);
                    $('.alert-success .message').html('Feeback email sent successfully.');
                    setTimeout(function(){ $('.alert-success').fadeOut(4000); },3000);    
                    window.location.href = window.location.href; 
                }
            });
        } else {
            $("#submit_btn").prop('disabled',false);
            $("#submit_btn").html(btnText);            
            $("#frmSendMail .alert-danger").show();
            return false;
        }
    });
}

function hadleRescheduleForm()
{
    $(document).on("click", ".reschedule_btn", function () {
		 $("#frmReschedule #reschedule_date").val('');
		 var id = $(this).data('id');
         var user_name = $(this).data('username');
         var parent_name = $(this).data('parent-name');
         var plan_name = $(this).data('plan');
         var schedule_date = $(this).data('schedule-date');
         var reschedule_by = $(this).data('reschedule-by');
         var reschedule_date = $(this).data('reschedule-date');
         var time_session = $(this).data('time-session');
         $("#frmReschedule #id").val(id);
         $("#frmReschedule #user_name").val(user_name);
         $("#frmReschedule #parent_name").val(parent_name);
         $("#frmReschedule #plan_name").val(plan_name);
         $("#frmReschedule #schedule_date").val(schedule_date);
         if(reschedule_by != ''){
            $("#frmReschedule #reschedule_by_sec label").html('Reschedule By '+reschedule_by);  
            $("#frmReschedule #reschedule_date").val(reschedule_date);
         } else {
            $("#frmReschedule #reschedule_by_sec").hide();  
         }
         $("#frmReschedule #e_reschedule_created_by").val(reschedule_by);
         if(time_session != ''){
            $("#frmReschedule #e_day").val(time_session);   
         }
         
    });
    
    $(document).on("click", "#submit_btn", function (e) {
        $("#frmReschedule .alert-danger").hide();
        var $valid = form_valid("#frmReschedule");
        var btnText = $("#submit_btn").html();
        if($valid) 
        {
            $("#submit_btn").prop('disabled',true); 
            $("#submit_btn").html('Please wait...');           
            $.post($("#frmReschedule").attr("action"), $("#frmReschedule").serialize(), function(data) {
                if($.trim(data) == 'TRUE'){
                    $('#myModal').modal('toggle'); 
                    $('.alert-success').show();
                    $("#submit_btn").prop('disabled',false);
                    $("#submit_btn").html(btnText);
                    $(".filter-submit").trigger( "click");
                    $('.alert-success .message').html('Appointment reschedule successfully.');
                    setTimeout(function(){ $('.alert-success').fadeOut(4000); },3000);     
                    window.location.href = window.location.href; 
                }
            });
        } else {
            $("#submit_btn").prop('disabled',false); 
            $("#submit_btn").html(btnText);           
            $("#frmReschedule .alert-danger").show();
            return false;
        }
    });
}

function hadleAssignEmployeeForm()
{
    $(document).on("click", ".assign_employee_btn", function () {
         var id = $(this).data('id');
         var user_name = $(this).data('username');
         var parent_name = $(this).data('parent-name');
         var plan_name = $(this).data('plan');
         var employee_id = $(this).data('employee-id');
         $("#frmAssignEmployee #appointment_id").val(id);
         $("#frmAssignEmployee #user").val(user_name);
         $("#frmAssignEmployee #parent").val(parent_name);
         $("#frmAssignEmployee #service").val(plan_name);
         $("#frmAssignEmployee #employee_id").val(employee_id);
         
    });
    
    $(document).on("click", "#submit_btn2", function (e) {
        $("#frmAssignEmployee .alert-danger").hide();
        var $valid = form_valid("#frmAssignEmployee");
        if($valid) 
        {
            var btnText = $("#submit_btn2").html();
            $("#submit_btn2").html('Please wait...');
            $("#submit_btn2").attr('disabled',true);
            $.post($("#frmAssignEmployee").attr("action"), $("#frmAssignEmployee").serialize(), function(data) {
                if($.trim(data) == 'TRUE'){
                    $('#myModal2').modal('toggle'); 
                    $('.alert-success').show();
                    $("#submit_btn2").html(btnText);
                    $("#submit_btn2").prop('disabled',false);
                    $(".filter-submit").trigger( "click");
                    $('.alert-success .message').html('Employee Assign successfully.');
                    setTimeout(function(){ $('.alert-success').fadeOut(4000); },3000);     

                    //change status 

                    $("#frmUpdateStatus #status option[value='Complete']").remove();
                    $('#frmUpdateStatus #status').append($("<option></option>").attr("value",'Complete').text('Complete'));  
                    window.location.href = window.location.href; 

                }
            });
        } else {
            $("#submit_btn2").prop('disabled',false); 
            $("#submit_btn2").html(btnText);           
            $("#frmAssignEmployee .alert-danger").show();
            return false;
        }
    });
}
function hadleRefundForm()
{
    $(document).on("click", ".refund_btn", function () {
         var id = $(this).data('id');
         var user_name = $(this).data('username');
         var plan_name = $(this).data('planname');
         var plan_price = $(this).data('planprice');
         var total_price = $(this).data('totalprice');
         var amount_sign = $(this).data('amountsign');
         $("#frmUserRefund #labAmount").text('Amount(In '+amount_sign+')');
         $("#frmUserRefund #refund_id").val(id);
         $("#frmUserRefund #user").val(user_name);
         $("#frmUserRefund #planname").val(plan_name);
         $("#frmUserRefund #totalprice").val(total_price);
         $("#frmUserRefund #planprice").val(plan_price);
         $("#frmUserRefund #refundamount").attr('min','0');
         $("#frmUserRefund #refundamount").attr('max',total_price.replace(amount_sign,''));
         
    });
    
    $(document).on("click", "#submit_btn2", function (e) {
        $("#frmUserRefund .alert-danger").hide();
        var $valid = form_valid("#frmUserRefund");
        if($valid) 
        {
            var btnText = $("#submit_btn2").html();
            $("#submit_btn2").html('Please wait...');
            $("#submit_btn2").attr('disabled',true);
            $.post($("#frmUserRefund").attr("action"), $("#frmUserRefund").serialize(), function(data) {
                if($.trim(data) == 'TRUE'){
                    $('#myModal2').modal('toggle'); 
                    $('.alert-success').show();
                    $("#submit_btn2").html(btnText);
                    $("#submit_btn2").prop('disabled',false);
                    $(".filter-submit").trigger( "click");
                    $('.alert-success .message').html('Refund Amount Submit Sucessfully.');
                    setTimeout(function(){ $('.alert-success').fadeOut(4000); },3000);     
                    window.location.href = window.location.href; 

                }
            });
        } else {
            $("#submit_btn2").prop('disabled',false); 
            $("#submit_btn2").html(btnText);           
            $("#frmUserRefund .alert-danger").show();
            return false;
        }
    });
}

function handleDeleteCustomerForm()
{
    $(document).on("click", ".deletecustomermodel_btn", function () 
    {
        var id = $(this).data('id');
        $("#frmCustomerDelete #deleteuser_id").val(id);
        $("#frmCustomerDelete #customer_full_name").html('<b>'+$(this).data('name')+'</b>');
        $("#frmCustomerDelete #customer_mobile_number").html('<b>'+$(this).data('mobilenumber')+'</b>');
        $("#t_address").val('');

    });
    
    $(document).on("click", "#submit_btn2", function (e) 
    {
        $("#frmCustomerDelete .alert-danger").hide();
        var $valid = form_valid("#frmCustomerDelete");
        if($valid) 
        {
            var btnText = $("#submit_btn2").html();
            $("#submit_btn2").html('Please wait...');
            $("#submit_btn2").attr('disabled',true);
            $.post($("#frmCustomerDelete").attr("action"), $("#frmCustomerDelete").serialize(), function(data) 
            {
                if($.trim(data) == 'TRUE')
                {
                    $('#myModal2').modal('toggle'); 
                    $('.alert-success').show();
                    $("#submit_btn2").html(btnText);
                    $("#submit_btn2").prop('disabled',false);
                    $(".filter-submit").trigger( "click");
                    $('.alert-success .message').html('Customer Deleted Sucessfully.');
                    setTimeout(function(){ $('.alert-success').fadeOut(4000); },3000);     
                        
                    if($("#is_redirect_to_another").val() == 'Yes')
                    {
                        window.location.href = $("#redirect_back_url").val(); 
                    }
                    else
                    {
                        window.location.href = window.location.href;
                    }
                }
            });
        } else {
            $("#submit_btn2").prop('disabled',false); 
            $("#submit_btn2").html(btnText);           
            $("#frmCustomerDelete .alert-danger").show();
            return false;
        }
    });
}

function hadlePaymentUpdateStatusForm()
{
    $(document).on("click", ".update_status_btn", function () {     
         var id = $(this).data('id');
         var user_name = $(this).data('username');
         var plan_name = $(this).data('plan');
         var service_name = $(this).data('service');
         var status = $(this).data('status');
         var total_price = $(this).data('totalprice');
         $("#frmUpdateStatus #id").val(id);
         $("#frmUpdateStatus #user_name").val(user_name);
         $("#frmUpdateStatus #service_name").val(service_name);
         $("#frmUpdateStatus #plan_name").val(plan_name);
         $("#frmUpdateStatus #status").val(status);   
         $("#frmUpdateStatus #total_price").val('Rs '+total_price);    
    });
    
    $(document).on("click", "#submit_btn3", function (e) {
        $("#frmUpdateStatus .alert-danger").hide();
        var $valid = form_valid("#frmUpdateStatus");
        if($valid) 
        {
            var btnText = $("#submit_btn3").html();
            console.log($("#submit_btn3"));
            $("#submit_btn3").prop('disabled',true); 
            $("#submit_btn3").html('Please wait...');  
            $.post($("#frmUpdateStatus").attr("action"), $("#frmUpdateStatus").serialize(), function(data) {
                if($.trim(data) == 'TRUE'){
                    $('#myModal3').modal('toggle'); 
                    $('.alert-success').show();
                    $(".filter-submit").trigger( "click");
                    $("#submit_btn3").prop('disabled',false);
                    $("#submit_btn3").html(btnText);
                    $('.alert-success .message').html('Status updated successfully.');
                    setTimeout(function(){ $('.alert-success').fadeOut(4000); },3000);     
                }
            });
        } else {
            $("#submit_btn3").prop('disabled',false); 
            $("#submit_btn3").html(btnText);           
            $("#frmUpdateStatus .alert-danger").show();
            return false;
        }
    });
}


function hadleUpdateStatusForm()
{
    $(document).on("click", ".update_status_btn", function () {		
         var id = $(this).data('id');
         var user_name = $(this).data('username');
         var parent_name = $(this).data('parent-name');
         var plan_name = $(this).data('plan');
         var schedule_date = $(this).data('schedule-date');
         var reschedule_by = $(this).data('reschedule-by');
         var reschedule_date = $(this).data('reschedule-date');
         var employee_name = $(this).data('employee-name');
         var plantype = $(this).data('plantype');
         var status = $(this).data('status');
         $("#frmUpdateStatus #id").val(id);
         $("#frmUpdateStatus #user_name").val(user_name);
         $("#frmUpdateStatus #parent_name").val(parent_name);
         $("#frmUpdateStatus #plantype").val(plantype);
         $("#frmUpdateStatus #plan_name").val(plan_name);
         $("#frmUpdateStatus #schedule_date").val(schedule_date);
         if(reschedule_by != ''){
            $("#frmUpdateStatus #reschedule_by_sec label").html('Reschedule By '+reschedule_by);  
            $("#frmUpdateStatus #reschedule_date").val(reschedule_date);
         } else {
            $("#frmUpdateStatus #reschedule_by_sec").hide();  
         }
         $("#frmUpdateStatus #e_reschedule_created_by").val(reschedule_by);
         $("#frmUpdateStatus #employee_name").val(employee_name);
         if(status != '' && status !='Pending' && status != 'Approve'){
            $("#frmUpdateStatus #status").val(status);   
         }
         if(status != 'Approve')
         {
            $("#frmUpdateStatus #status option[value='Complete']").remove();
         }
    });
    
    $(document).on("click", "#submit_btn3", function (e) {
        $("#frmUpdateStatus .alert-danger").hide();
        var $valid = form_valid("#frmUpdateStatus");
        if($valid) 
        {
            var btnText = $("#submit_btn3").html();
            console.log($("#submit_btn3"));
            $("#submit_btn3").prop('disabled',true); 
            $("#submit_btn3").html('Please wait...');  
            $.post($("#frmUpdateStatus").attr("action"), $("#frmUpdateStatus").serialize(), function(data) {
                if($.trim(data) == 'TRUE'){
                    $('#myModal3').modal('toggle'); 
                    $('.alert-success').show();
                    $(".filter-submit").trigger( "click");
                    $("#submit_btn3").prop('disabled',false);
                    $("#submit_btn3").html(btnText);
                    $('.alert-success .message').html('Status updated successfully.');
                    setTimeout(function(){ $('.alert-success').fadeOut(4000); },3000);   
                    window.location.href = window.location.href;   
                }
            });
        } else {
            $("#submit_btn3").prop('disabled',false); 
            $("#submit_btn3").html(btnText);           
            $("#frmUpdateStatus .alert-danger").show();
            return false;
        }
    });
}

function handleParentChildSelect()
{
    $(document).on("change","#i_user_id",function () {
        var rel = $(this).val();
        $("#i_parent_id option").show();
        $("#i_parent_id").val('');
        if(rel>0)
        {
            $('#i_parent_id option[rel!='+rel+']').hide();
        }  
    });
	var rel = $("#i_user_id").val();
		if(rel>0)
        {
            $('#i_parent_id option[rel!='+rel+']').hide();
        }        
}

function hadleSendToUsersForm()
{
    $(document).on("click", ".send_to_users_btn", function () {
         var user_arr = [];
         var id = $(this).data('id');
         $("#frmSendToUsers #coupon_id").val(id);
         var coupon_code = $(this).data('coupon-code');
         var user_ids = $(this).data('user-ids');
         if (user_ids.toString().indexOf(',') == -1) {
             $("input[type=checkbox]").each(function () {
                if($(this).val() == user_ids)
                {
                    $(this).prop("checked", true);
                    $(this).prop("disabled", true);
                }
                else
                {
                    $(this).prop("checked", false);
                    $(this).prop("disabled", false)
                }

               // user_ids.indexOf($(this).val())!=-1?$(this).prop("checked", true):$(this).prop("checked", false);
               // user_ids.indexOf($(this).val())!=-1?$(this).prop("disabled", true):$(this).prop("disabled", false);
             });
         }
         else
         {
            var user_arr = $(this).data('user-ids').split(',');
            $("input[type=checkbox]").each(function () {
                if($.inArray($(this).val(),user_arr) != -1)
                {
                    $(this).prop("checked", true);
                    $(this).prop("disabled", true);
                }
                else
                {
                    $(this).prop("checked", false);
                    $(this).prop("disabled", false)
                }

               // user_ids.indexOf($(this).val())!=-1?$(this).prop("checked", true):$(this).prop("checked", false);
               // user_ids.indexOf($(this).val())!=-1?$(this).prop("disabled", true):$(this).prop("disabled", false);
             });
         }
         console.log(user_arr);
         //var user_arr = user_ids.split('|');
         $("#frmSendToUsers #coupon_code").html(coupon_code);
         jQuery.uniform.update(".v_user_ids");
    });


    $(document).on("click", "#submit_btn", function (e) {
        $("#frmSendToUsers .alert-danger").hide();
        var $valid = form_valid("#frmSendToUsers");
        if($valid)
        {
            var btnText = $("#submit_btn").html();
            $("#submit_btn").html('Please wait...');
            $("#submit_btn").attr('disabled',true);
            $.post($("#frmSendToUsers").attr("action"), $("#frmSendToUsers").serialize(), function(data) {
                if($.trim(data) == 'TRUE'){
                    $('#myModal').modal('toggle');
                    $('.alert-success').show();
                    $("#submit_btn").html(btnText);
                    $("#submit_btn").prop('disabled',false);
                    $(".filter-submit").trigger( "click");
                    $('.alert-success .message').html('Coupon code send to user(s) successfully');
                    setTimeout(function(){ $('.alert-success').fadeOut(4000); },3000);
                    window.location.href = window.location.href;
                }
            });
        } else {
            $("#submit_btn").prop('disabled',false);
            $("#submit_btn").html(btnText);
            $("#frmSendToUsers .alert-danger").show();
            return false;
        }
    });
}

function export_to_excel(ModelName) {
    exportAction = ($("#frmSearchForm").attr('action')).replace("list-ajax","export");
    window.location.href = exportAction+'?'+$("#frmSearchForm").serialize();
    return false;
}

function show_markers(first_latitude, first_longitude,allMarkers)
{
    setTimeout(function(){
        var map = new GMaps({
            div: '#gmap_basic',
            lat: first_latitude,
            lng: first_longitude
        });
        var markerCount = 0;
        $.each(allMarkers, function(index, item) {
            map.addMarker({
                lat: item.latitude,
                lng: item.longitude,
                icon: SITE_URL+"img/marker.png",
                infoWindow: {
                    content: '<span style="color:#000">'+item.title+'<br>'+item.link+'</span>'
                }
            });
            markerCount++ ;
            console.log(item.longitude);
        });
        if(markerCount == 0)
        {
            map.setZoom(2);    
        } else {
            map.setZoom(14);
        }
    },1000);
}
/*** Image upload without crop ***/
function read_image(input) {
      
      if (input.files && input.files[0])
      {
         var file=input.files[0];

         var reader = new FileReader();
         $('.file_upload').html('Please wait...');
         $('button[type="submit"]').prop('disabled',true);
         reader.onload = function (e)
         {
            if((file.type == 'image/jpeg' || file.type == 'image/png' || file.type == 'image/gif') )
            {
               $("#show_image").attr("src", e.target.result);
               $("#show_image").show();
               $("#imgbase64").attr("value", e.target.result);
            } else
            {
                bootbox.alert("Please upload image only.", function(answer) {
                  $('.image_upload').val('');
                });
            }
            $('button[type="submit"]').prop('disabled',false);
            $('.file_upload').html('Select Image');
         };

         reader.readAsDataURL(input.files[0]);

      }
}

function read_pdf(input) {
      
      if (input.files && input.files[0])
      {
         var file=input.files[0];
         var reader = new FileReader();
         $('.pdf_file_upload').html('Please wait...');
         $('button[type="submit"]').prop('disabled',true);
         console.log(reader.readAsDataURL(file));
               
         reader.onload = function (e)
         {
            if((file.type == 'application/pdf'))
            {
               $("#show_image").attr("src", $("#pdf_img_path").val());
               $("#show_image").show();
               $("#imgbase64").attr("value", e.target.result);
            } 
            else
            {
                bootbox.alert("Please upload pdf only.", function(answer) {
                  $('.pdf_upload').val('');
                });
            }
            $('button[type="submit"]').prop('disabled',false);
            $('.pdf_file_upload').html('Select Pdf');
         };

         reader.readAsDataURL(input.files[0]);

      }
}

//my new code for validation of image with demensional
/*** Image upload without crop ***/
/*
function read_image(input,rwidth,rheight) {
    if (input.files && input.files[0])
    {
        var rwidth = $('#require_width').val();
        var rheight = $('#require_height').val();
        $('.file_upload').html('Please wait...');
        $('button[type="submit"]').prop('disabled',true);
         
        var file = input.files[0];
    /*    if((file.type != 'image/jpeg' || file.type != 'image/png' || file.type != 'image/gif'))
        {
            bootbox.alert("Please upload image only.", function(answer) {
              $('.image_upload').val('');
            });
            
            $('button[type="submit"]').prop('disabled',false);
            $('.file_upload').html('Select Image');
            return false;
        } 
    */    
/*        var reader = new FileReader();
        reader.onload = function (e)
        {
            var width = 0;
            var newImg = new Image();   
            newImg.onload = function() {
                width = newImg.width;
                height = newImg.height;
                
                if(width > rwidth && height > rheight)
                {
                    bootbox.alert("Please upload image only size."+width+' * '+height, function(answer) {
                    $('.image_upload').val('');
                    });
                    
                    $('button[type="submit"]').prop('disabled',false);
                    $('.file_upload').html('Select Image');
                    return false;
                }
                $("#show_image").attr("src", e.target.result);
                $("#show_image").show();
                $("#imgbase64").attr("value", e.target.result);
               
                $('button[type="submit"]').prop('disabled',false);
                $('.file_upload').html('Select Image');
            }
            newImg.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
} 
*/