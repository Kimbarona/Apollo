<?php
//index.php
// require_once("class.php");
// $AssignedWorks = new AssignedWorks();

$connect = new PDO("mysql:host=localhost;dbname=db_engineering", "root", "");
function fill_unit_select_box($connect)
{ 
 $output = '';
 $query = "SELECT * FROM apollo_genscopes";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["GenScopes"].'">'.$row["GenScopes"].'</option>';
 }
 return $output;
}

?>

<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="row">
        <div class="col-12">
            <div class="card mt-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Assigned Works</h4>
                        <form method="post" id="insert_form">
                            <div class="table-repsonsive">
                            <span id="error"></span>
                            <table class="table table-bordered" id="item_table">
                            <tr>
                            <th with="45%">Scope</th>
                            <th with="10%">Amount</th>
                            <th with="15%">Planned Start</th>
                            <th with="15%">Planned End</th>
                            <!-- <th with="10%">Percent</th> -->
                            <th with="5%"><button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button></th>
                            </tr>
                            </table>
                            <div align="center">
                            <input type="submit" name="submit" class="btn btn-info" value="Insert" />
                            </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
 
 <script>
    $(document).ready(function(){ 
        $(document).on('click', '.add', function(){
        var html = '';
        html += '<tr>';
        html += '<td><select name="scope[]" class="custom-select scope"><option value="">Select Scope</option><?php echo fill_unit_select_box($connect); ?></select></td>';
        html += '<td><input type="text" name="amount[]" class="form-control amount" /></td>';
        html += '<td><input type="date" name="planned_start[]" class="form-control planned_start" /></td>';
        html += '<td><input type="date" name="planned_end[]" class="form-control planned_end" /></td>';
        // html += '<td><input type="text" name="percent[]" class="form-control percent" /></td>';
        html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
        $('#item_table').append(html);
        });

        $(document).on('click', '.remove', function(){
        $(this).closest('tr').remove();
        });

        $('#insert_form').on('submit', function(event){
        event.preventDefault();
        var error = '';
        $('.scope').each(function(){
        var count = 1;
        if($(this).val() == '')
        {
            error += "<p>Select Scope at "+count+" Row</p>";
            return false;
        }
        count = count + 1;
        });
        
        $('.amount').each(function(){
        var count = 1;
        if($(this).val() == '')
        {
            error += "<p>Enter amount at "+count+" Row</p>";
            return false;
        }
        count = count + 1;
        });
        
        $('.planned_start').each(function(){
        var count = 1;
        if($(this).val() == '')
        {
            error += "<p>Enter planned start date at "+count+" Row</p>";
            return false;
        }
        count = count + 1;
        });
        $('.planned_end').each(function(){
        var count = 1;
        if($(this).val() == '')
        {
            error += "<p>Enter planned end date "+count+" Row</p>";
            return false;
        }
        count = count + 1;
        });

        var form_data = $(this).serialize();
        if(error == '')
        {
        $.ajax({            
            method:"POST",
            url:"insert.php",
            data:form_data,
            success:function(data)
            {
            if(data == 'ok')
            {
            $('#item_table').find("tr:gt(0)").remove();
            $('#error').html('<div class="alert alert-success">Succesfully Saved!</div>');
            }
            }
        });
        }
            else
            {
            $('#error').html('<div class="alert alert-danger">'+error+'</div>');
            }
            });        

    });
 </script>

