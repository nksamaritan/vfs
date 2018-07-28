/**
 * Created by Mobio Solutions on 18-01-2017.
 */

app.user = {

    events: {
        switch: function () {
            $(document).on('click', ".change_status", function () {
                var status = '1';
                if ($(this).closest("div.switch-button").children("input:checked").length > '0') {
                    status = '0';
                }

                var id = $(this).closest("div.switch-button").children("input").attr('rel');
                var spath = $(this).closest("div.switch-button").children("input").attr('formaction');
                var url = app.config.SITE_PATH + spath +'/change_status';
                app.changeStatus(id, url, status);
            });
        },

        delete: function () {
            $(document).on('click', ".deleteRecord", function () {
                var dpath = $(this).attr('formaction');
                var result = confirm("Are you sure you want to delete this "+dpath.toUpperCase()+"?");
                if (result) {
                    var id = $(this).attr('rel');
                    var url = app.config.SITE_PATH + dpath +'/delete';
                    app.deleteRecord(id, url);
                }
            });
        },

        init: function () {
            app.user.events.switch();
            app.user.events.delete();
            app.dataTable.search();
            app.dataTable.reset();

        },

    },

    action: {
        event:{
            common:function () {
                jQuery.validator.addMethod("checkParentValid", function (value, element) {
                    if(!checkParentValid()){
                        if($("#parent_id").val() > '0'){
                            return true;
                        }
                        return false;
                    }
                }, "This field is required");

                $("#role_id").change(function () {
                    checkParentValid();
                });
            },

            custome_validations:function () {
                var validations = {
                    rules:{
                        mobile_number:{
                            minlength : '10',
                            maxlength : '10',
                        }
                    },
                    messages:{
                        mobile_number:{
                            minlength : 'Mobile Number should be atleast 10 Digit long',
                            maxlength : 'Mobile Number should not be greater 10 Digit',
                        },
                    },
                    errorPlacement: function (error, element) {
                        element.after(error);
                    }
                };
                return validations;
            }
        }
    },

    init: function () {
        app.user.events.init();
        app.dataTable.custom({"url":'user/datatable'});
        app.dataTable.eventFire();
    }
}

function checkParentValid() {
    var role = $("#role_id").children("option:selected").text().toLowerCase();
    if(role == "admin" || role == "coo"){
        $("#parent_id").val('0');
        $("#parent_id").closest("div.form-group").hide();
        return true;
    }else{
        $("#parent_id").closest("div.form-group").show();
        return false;
    }
}