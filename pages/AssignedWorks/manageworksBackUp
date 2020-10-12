  <!-- Large modal start -->
<div class="col-lg-6 mt-2">
    <div class="card">
        <div class="card-body">
            <!-- Large modal -->
            <!-- <button type="button" class="btn btn-primary btn-flat btn-lg" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal
            </button> -->
            <div class="modal fade bd-example-modal-lg ">
                <div class="modal-dialog modal-lg ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">work Description</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                        <form method="post" id="update_form">
                            <div align="left">
                                <input type="submit" name="multiple_update" id="multiple_update" class="btn btn-info" value="Update Works" />
                            </div><br>
                        <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th width="10%"></th>
                                <th width="20%">Scope</th>
                                <th width="30%">Work Description</th>
                                <th width="20%">Percent</th>
                                <th width="20%">Status</th>                                
                                
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    </form>
                        </div>
                        <div class="modal-footer"><br>
                            <button type="" class="" data-dismiss="modal"></button>
                            <button type="" class=""></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Large modal modal end -->
<script>
    $(document).ready(function(){  
    
        function fetch_data()
        {
            $.ajax({
                url:"AssignedWorks/Selectworks.php",
                method:"POST",
                dataType:"json",
                success:function(data)
                {
                    var html = '';
                    for(var count = 0; count < data.length; count++)
                    {
                        html += '<tr>';
                        html += '<td><input type="checkbox" id="'+data[count].parent_id+'" data-scope="'+data[count].scope+'" data-work="'+data[count].work+'" data-percent="'+data[count].percent+'" data-status="'+data[count].status+'" data-start="'+data[count].actual_start+'" data-end="'+data[count].actual_end+'" class="check_box"  /></td>';
                        html += '<td>'+data[count].scope+'</td>';
                        html += '<td>'+data[count].work+'</td>';
                        html += '<td>'+data[count].percent+'</td>';
                        html += '<td>'+data[count].status+'</td>';
                   
                    }
                    $('tbody').html(html);
                }
            });
        }

        fetch_data();

        $(document).on('click', '.check_box', function(){
            var html = '';
            if(this.checked)
            {
                html = '<td><input type="checkbox" id="'+$(this).attr('parent_id')+'" data-scope="'+$(this).data('scope')+'" data-work="'+$(this).data('work')+'" data-percent="'+$(this).data('percent')+'" data-status="'+$(this).data('status')+'"  class="check_box" checked /></td>';
                html += '<td><input type="text" name="scope[]" class="form-control" value="'+$(this).data("scope")+'" /></td>';
                html += '<td><input type="text" name="work[]" class="form-control" value="'+$(this).data("work")+'" /></td>';
                html += '<td><input type="text" name="percent[]" class="form-control" value="'+$(this).data("percent")+'" /></td>';
                html += '<td><input type="text" name="hidden_id[]" value="'+$(this).attr('parent_id')+'" /></td>';
                html += '<td><select name="status[]" id="stat'+$(this).attr('parent_id')+'" class="custom-select"><option value="Open">Open</option><option value="Closed">Closed</option></select></td>';
            }
            else
            {
                html = '<td><input type="checkbox" id="'+$(this).attr('parent_id')+'" data-scope="'+$(this).data('scope')+'" data-work="'+$(this).data('work')+'" data-percent="'+$(this).data('percent')+'" data-status="'+$(this).data('status')+'" class="check_box"  /></td>';
                html += '<td>'+$(this).data('scope')+'</td>';
                html += '<td>'+$(this).data('work')+'</td>';
                html += '<td>'+$(this).data('percent')+'</td>';
                html += '<td>'+$(this).data('status')+'</td>';
                         
            }
            $(this).closest('tr').html(html);
            $('#stat'+$(this).attr('id')+'').val($(this).data('status'));
        });

        $('#update_form').on('submit', function(event){
            event.preventDefault();
            if($('.check_box:checked').length > 0)
            {
                $.ajax({
                    url:"AssignedWorks/updateworks.php",
                    method:"POST",
                    data:$(this).serialize(),
                    success:function(response)
                    {
                        // alert('Data Updated');
                        // fetch_data();
                        console.log(response);
                    }
                })
            }
        });

});  

</script>