$(document).ready(function(){
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
                        op += '<option value="' + data[i].id+'">'+data[i].studentName + ' - ' + data[i].id+'</option>'
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
