<html>
    <head>

    </head>
    <body>

        <button type="button"  onclick="Printing(this.value)"  value="<?php echo $rows['billingNumber']; ?>"></button>

        <div id="PrintDetails" style="display:none;"></div>

    </body>
</html>

<script>
     function Printing(BillingIdt){
        var r = confirm("Are You sure? You want to Print this??");
        if (r == true) {
            $('#PrintDetails').load('Printing.php?id='+BillingId, function(){
                var printContent = document.getElementById('PrintDetails');
                var WinPrint = window.open('', '', 'width=900,height=650');
                WinPrint.document.write(printContent.innerHTML);
                WinPrint.document.close();
                WinPrint.focus();
                WinPrint.print();
                WinPrint.close();
                
            });
            
        }
        else{
            
        }
    }
</script>