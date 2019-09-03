<script>
$(document).ready( function()
{
    $('.sign_in').on('submit', function (event)
    {
        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();
        var $form = $(this);
        var form_data = new FormData($(this)[0]);
        swal({
            title: "Verifying",
            text: "Please Wait",
            type: "info",
            showConfirmButton: false
        });
        $.ajax({
            url: $form.attr('action'), // point to server-side PHP script
            dataType: 'json',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(response)
            {
                if(response.result == 1) {
                    window.location.replace(response.location);
                } else {
                    swal("Error", response.data, "error");
                }
            },
            error: function()
            {
                swal("Error", "Error! Try Again", "error");
            }
        });
    });

    $('.change_password').on('submit', function (event)
    {
        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();
        var $form = $(this);
        var form_data = new FormData($(this)[0]);
        swal({
            title: "Updating",
            text: "Please Wait",
            type: "info",
            showConfirmButton: false
        });
        $.ajax({
            url: $form.attr('action'), // point to server-side PHP script
            dataType: 'json',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(response)
            {
                if(response.result == 1) {
                    swal(
                    {
                        title: "Password Changed Successfully",
                        html: true,
                        type: "success",
                        confirmButtonText: "Close",
                        closeOnConfirm: true
                    }, function()
                    {
                        window.location.replace(response.location);
                    });
                } else {
                    swal("Error", response.data, "error");
                }
            },
            error: function()
            {
                swal("Error", "Error! Try Again", "error");
            }
        });
    });

    // Print Details

    $('#name').on('focusout', function()
    {
        var box1 = $(this);
        var box2 = $('#attention_to');
        box2.val(box1.val());
    });

    $('.print_details_form').on('submit', function(event)
    {
        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();
        var $form = $(this);
        var form_data = new FormData($(this)[0]);
        swal({
            title: "Saving Details",
            text: "Please Wait",
            type: "info",
            showConfirmButton: false
        });
        $.ajax({
            url: $form.attr('action'), // point to server-side PHP script
            dataType: 'json',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(response)
            {
                if(response.result == 1) {
                    window.location.replace(response.location);
                } else {
                    swal("Error", response.data, "error");
                }
            },
            error: function()
            {
                swal("Error", "Your file was not uploaded!. Try Again", "error");
            }
        });
    });

    $("#entity").change(function()
    {
        var entity = $(this).val();
        var division = $('#division');
        var sel = '';

        if(entity === ''){
            sel = '<option value="">Select Entity First </option>';
            division.empty();
            division.append(sel);
            division.prop('disabled', true);

            return true;
        }

        if(entity === "KHEA" || entity === "KHEI"){
            sel = '<option value="Murdoch">Murdoch</option>'
                +'<option value="Murdoch Bridging">Murdoch Bridging</option>'
                +'<option value="Foundation School">Foundation School</option>'
                +'<option value="Diploma School">Diploma School</option>'
                +'<option value="O Level School">O Level School</option>'
                +'<option value="3rd Party">3rd Party</option>';
            division.empty();
            division.prop('disabled', false);
            division.append(sel);

            return true;
        }

        if(entity === "KLI"){
            sel = '<option value="KAPLAN Financial">KAPLAN Financial</option>'
                +'<option value="KAPLAN Professional">KAPLAN Professional</option>';
            division.empty();
            division.prop('disabled', false);
            division.append(sel);

            return true;
        }
    });

    dateTime();
    function dateTime() {
        var datepicker = $('.form_datetime');
        datepicker.datetimepicker({
            format: 'dd MM yyyy - HH p',
            weekStart: 0,
            todayBtn:  0,
            autoclose: 1,
            todayHighlight: 0,
            startView: 2,
            minView: 1,
            forceParse: 0,
            showMeridian: 1
        });

        datepicker.datetimepicker('setDaysOfWeekDisabled', [0,6]);
        datepicker.datetimepicker('setStartDate', '<?=date("Y-m-d H:i:s", mktime(10,00,0, date('n'), date('j')+1, date('Y')));?>');
    }

    $('.file_upload_form').on('submit', function(event)
    {
        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();
        var $form = $(this);
        var form_data = new FormData($(this)[0]);
        swal({
            title: "Uploading",
            text: "Please Wait",
            type: "info",
            showConfirmButton: false
        });
        $.ajax({
            url: $form.attr('action'), // point to server-side PHP script
            dataType: 'json',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(response)
            {
                if(response.result == 1) {
                    swal({
                        title: "Uploaded Successfully",
                        text: response.data,
                        html: true,
                        type: "success",
                        confirmButtonText: "Close",
                        closeOnConfirm: true
                    },
                    function(){
                        location.reload(true);
                    });
                } else {
                    swal("Error", response.data, "error");
                }
            },
            error: function()
            {
                swal("Error", "Your file was not uploaded!. Try Again", "error");
            }
        });
    });

    $('.submit_order').on('click', function(event)
    {
        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();
        var url = $(this).attr('href');

        swal({
            title: "Submitting",
            text: "Please Wait",
            type: "info",
            showConfirmButton: false
        });
        $.ajax({
            url: url, // point to server-side PHP script
            dataType: 'json',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: 'text/plain',
            processData: false,
            type: 'get',
            success: function(response)
            {
                if(response.result == 1) {
                    swal({
                        title: "Order Submitted Successfully",
                        text: "You will receive an email confirmation shortly.",
                        html: true,
                        type: "success",
                        confirmButtonText: "Close",
                        closeOnConfirm: true
                    },
                    function(){
                        window.location.replace("<?=base_url('home/logout/')?>");
                    });
                } else {
                    swal("Error", response.data, "error");
                }
            },
            error: function()
            {
                swal("Error", "Your order was not submitted!. Try Again", "error");
            }
        });
    });

    // Delete Job
    $('.delete-job').on('click', function (event)
    {
        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();
        var url = $(this).attr('href');
        swal({
            title: "Are you sure?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function()
        {
            $.ajax({
                url: url, // point to server-side PHP script
                dataType: 'json',  // what to expect back from the PHP script, if anything
                cache: true,
                contentType: 'text/plain',
                processData: false,
                type: 'get',
                success: function(response)
                {
                    if(response.result == 1) {
                        swal({
                            title: "Job Deleted Successfully",
                            html: true,
                            type: "warning",
                            confirmButtonText: "Close",
                            closeOnConfirm: true
                        },
                        function(){
                            window.location.replace("<?=base_url('prints/files/')?>");
                        });
                    } else {
                        swal("Error", response.data, "error");
                    }
                },
                error: function()
                {
                    swal("Error", "Job was not deleted!. Try Again", "error");
                }
            });
        });
    });


    // Duplicate Job
    $('.order-duplicate').on('click', function (event)
    {
        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();
        var url = $(this).attr('href');
        swal({
            title: "Are you sure?",
            text: "You want reorder this Job!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Please!",
            closeOnConfirm: false
        },
        function(){
            $.ajax({
                url: url, // point to server-side PHP script
                dataType: 'json',  // what to expect back from the PHP script, if anything
                cache: true,
                contentType: 'text/plain',
                processData: false,
                type: 'get',
                success: function(response)
                {
                    if(response.result == 1) {
                        swal({
                            title: "Success",
                            text: "You can edit the details Now",
                            html: true,
                            type: "success",
                            confirmButtonText: "Go",
                            closeOnConfirm: true
                        },
                        function(){
                            window.location.replace("<?=base_url('prints/')?>");
                        });
                    } else {
                        swal("Error", response.data, "error");
                    }
                },
                error: function()
                {
                    swal("Error", "There was some issue. Try Again", "error");
                }
            });
        });
    });

    // Toggle Panel Hide/Show
    $('.click-able').on("click", function (event) {
        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();
        var $span = $(this).find('span');
        if ($span.hasClass('panel-collapsed')) {
            // expand the panel
            $span.parents('.panel').find('.panel-body').slideDown();
            $span.removeClass('panel-collapsed');
            $span.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
        }
        else {
            // collapse the panel
            $span.parents('.panel').find('.panel-body').slideUp();
            $span.addClass('panel-collapsed');
            $span.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
        }
    });

    // Show Cover
    $(".cover_included").on("change", function (event) {
        event.preventDefault();
        event.stopPropagation();
        if(this.checked) {
            $(".cover_div").addClass("hidden");
        } else {
            $(".cover_div").removeClass("hidden");
        }
    });

    $("#report_entity").change(function()
    {
        var entity = $(this).val();
        var division = $('#division');
        var sel = '';

        if(entity === ''){
            sel = '<option value="">Select Entity First </option>';
            division.empty();
            division.append(sel);
            division.prop('disabled', true);

            return true;
        }

        if(entity === "KHEA" || entity === "KHEI"){
            sel = '<option value="Murdoch">Murdoch</option>'
                +'<option value="Murdoch Bridging">Murdoch Bridging</option>'
                +'<option value="Foundation School">Foundation School</option>'
                +'<option value="Diploma School">Diploma School</option>'
                +'<option value="O Level School">O Level School</option>'
                +'<option value="3rd Party">3rd Party</option>'
                +'<option value="All">All</option>';
            division.empty();
            division.prop('disabled', false);
            division.append(sel);

            return true;
        }

        if(entity === "KLI"){
            sel = '<option value="KAPLAN Financial">KAPLAN Financial</option>'
                +'<option value="KAPLAN Professional">KAPLAN Professional</option>'
                +'<option value="All">All</option>';
            division.empty();
            division.prop('disabled', false);
            division.append(sel);

            return true;
        }

        if(entity === "All"){
            sel = '<option value="All">All</option>';
            division.empty();
            division.prop('disabled', false);
            division.append(sel);

            return true;
        }
    });

    $('.generate_report').on('submit', function(event) {
        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();

        if (!$('#report_entity').val()) {
            swal({
                title: "Select Entity",
                type: "error",
                showConfirmButton: true
            });
            return false;
        }

        if (!$('#month').val()) {
            swal({
                title: "Select Month",
                type: "error",
                showConfirmButton: true
            });
            return false;
        }

        if (!$('#year').val()) {
            swal({
                title: "Select Year",
                type: "error",
                showConfirmButton: true
            });
            return false;
        }

        $(this)[0].submit();
        return true;
    });

});
</script>
