
    function Printing(BillingId, Equivweight){
        $('#PrintDetails').load('PrintingOfBilling.php?id='+BillingId, 'equiv='+Equivweight,function(){
            var printContent = document.getElementById('PrintDetails');
            var WinPrint = window.open('', '', 'width=900,height=650');
            WinPrint.document.write(printContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
        });
        // alert(BillingId);
    }

