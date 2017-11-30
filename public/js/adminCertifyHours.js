// Get the filtered social services using ajax and append them to the html
$(document).ready(function(){
    $(document).on('change', '.partner', function(){

        var partner_id = $(this).val();
        var div = $(this).parent().parent();
        var op = " ";
        div.find('.student').html("");
        div.find('.student').append(op);
        $.ajax({
            type: 'get',
            url: 'filter-social-services',
            data: {'id':partner_id},
            success:function (data) {
                if(data.length <= 0) {
                    op += '<option value="">No Services Registered</option>'
                }else{
                    op += '<option value ="" selected disabled>- Select Service -</option>';
                    for(var i=0; i < data.length; i++){
                        op += '<option value="' + data[i].id+'">'+data[i].name + ' - ' + data[i].id+'</option>'
                    }
                }
                div.find('.service').html("");
                div.find('.service').append(op);
            },
            error:function () {

            }
        });
    });

    // Get the filtered students using ajax and append them to the html
    $(document).on('change', '.service', function() {
        var service_id = $(this).val();
        var div = $(this).parent().parent();
        var op = " ";
        console.log(service_id);
        $.ajax({
            type: 'get',
            url: 'filter-students',
            data: {'id':service_id},
            success:function (data) {
                console.log('success');
                console.log(data);
                console.log(data.length)
                if(data.length <= 0) {
                    op += '<option value="none">No Students Registered</option>'
                }else{
                    op += '<option value ="select" selected disabled>- Select Student -</option>';
                    for(var i=0; i < data.length; i++){
                        op += '<option value="' + data[i].id+'">' + data[i].studentName + ' - ' + data[i].user_id+'</option>'
                    }
                }
                div.find('.student').html("");
                div.find('.student').append(op);
            },
            error:function () {

            }
        });
    });
});
