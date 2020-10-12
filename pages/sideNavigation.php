    <?php
        // session_start();
        require_once("GlobalClass.php");
        $GlobalConnection = new GlobalConnection();

        $stmts = $GlobalConnection->runQuery("SELECT COUNT(work_status) AS Total FROM `apollo_project_assigned_scopes` WHERE work_status='Pending To Close'");
        $stmts->execute();
        $row = $stmts->fetch();
        $st = $row['Total'];
        // $gt = $st * 2;

        // for total printing list
        $totalprinting = $GlobalConnection->runQuery("SELECT COUNT(billing_status) AS printingcount FROM `apollo_masterlistofbillings` WHERE billing_status=1");
        $totalprinting->execute();
        $rowsprinting = $totalprinting->fetch();
        $printingTotal = $rowsprinting['printingcount'];

        // for total confirmation
        $countapproval = $GlobalConnection->runQuery("SELECT COUNT(billing_status) AS BillTotal FROM `apollo_firstapprover` WHERE billing_status='For Approval'");
        $countapproval->execute();
        $rowApproval = $countapproval->fetch();
        $FinalApprovalCount = $rowApproval['BillTotal'];

        $countrejected = $GlobalConnection->runQuery("SELECT COUNT(billing_status) AS RejectTotal FROM `apollo_firstapprover` WHERE billing_status='Rejected'");
        $countrejected->execute();
        $rowrejected = $countrejected->fetch();
        $FinalReject = $rowrejected['RejectTotal'];
        $sumOF =  $FinalApprovalCount + $st + $FinalReject;

        // for second and third approver history having remarks
        $secondHistory = $GlobalConnection->runQuery("SELECT COUNT(billing_type) AS second FROM `apollo_secondapprover` WHERE billing_status IN('Approved','Rejected')");
        $secondHistory->execute();
        $rowsSecondHistory = $secondHistory->fetch();
        $SecondHistory = $rowsSecondHistory['second'];

        $thirdHistory = $GlobalConnection->runQuery("SELECT COUNT(billing_type) AS third FROM `apollo_thirdapprover` WHERE billing_status IN('Approved','Rejected')");
        $thirdHistory->execute();
        $rowsThirdHistory = $thirdHistory->fetch();
        $ThirdHistory = $rowsThirdHistory['third'];

        // notif
        $current_date = date('Y-m-d');
        $notif = $GlobalConnection->runQuery("SELECT capex_number, COUNT(subscopes)AS Notif FROM `apollo_project_assigned_scopes`
        WHERE  work_status='Pending To Start'");
        $notif->execute();
        $rownotif = $notif->fetch();
        $notif = $rownotif['Notif'];	

        // for contractAmount Approval
        $CaApproval = $GlobalConnection->runQuery("SELECT COUNT(capex_number) AS CaCountApproval FROM `apollo_contractamount_approval` WHERE approval_status='For Approval'");
        $CaApproval->execute();
        $RowApproval = $CaApproval->fetch();
        $CaCountApproval = $RowApproval['CaCountApproval'];

        $CaApproved = $GlobalConnection->runQuery("SELECT COUNT(capex_number) AS CaCountApproval FROM `apollo_contractamount_approval` WHERE approval_status in('Approved','Hold')");
        $CaApproved->execute();
        $RowApproved = $CaApproved->fetch();
        $CaCountApproved = $RowApproved['CaCountApproval'];

        $CountToCloseProject = $GlobalConnection->runQuery("SELECT COUNT(capex_number) AS CountToCloseProject FROM `apollo_masterlistofbillings`
        WHERE progress='100'");
        $CountToCloseProject->execute();
        $RowCountToCloseProject = $CountToCloseProject->fetch();
        $FinalCountToCloseProject = $RowCountToCloseProject['CountToCloseProject'];

        // this is for the rejected viewing per user
        $Position = $_SESSION['position'];
        if($Position = 'Eo'){
            $fullname=$_SESSION['fullname'];
            $CountReject = $GlobalConnection->runQuery("SELECT COUNT(capex_number) AS CR FROM `apollo_rejectedapproval_history` WHERE engineer= '$fullname'");
            $CountReject->execute();
            $RowCountReject = $CountReject->fetch();
            $Creject = $RowCountReject['CR'];
        }
        else{
            $CountReject = $GlobalConnection->runQuery("SELECT COUNT(capex_number) AS CR FROM `apollo_rejectedapproval_history`");
            $CountReject->execute();
            $RowCountReject = $CountReject->fetch();
            $Creject = $RowCountReject['CR'];
            
        }
   
?>
    <!-- sidebar menu area start -->
    <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.html"><img src="../assets/images/logo1.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">

                            <?php
                                $UserId = $_SESSION['id'];
                                $Navigations = $GlobalConnection->runQuery("SELECT * From apollo_useraccounts WHERE id = '$UserId'");
                                $Navigations->execute();
                                $nav = $Navigations->fetch();
                                    $NavPosition = $nav['position'];
                                    if($NavPosition=='Admin'){
                                    
                                        ?>
                                    
                                        <li ><a href="index.php" id="navDashboard"><i class="ti-dashboard"></i> <span>Dashboard</span></a></li>
                                        <li>
                                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Masterlist</span></a>                                    
                                            <ul class="collapse">
                                                <li ><a href="inputprojectlist.php"><i class="ti-list"></i> <span>Project Name List</span></a></li>
                                                <li ><a href="contractorList.php"><i class="ti-list"></i> <span>Contractor List</span></a></li>
                                                <!-- <li ><a href="EngineerList.php"><i class="ti-list"></i> <span>Engineer List</span></a></li> -->
                                                <li ><a href="projectMasterlist.php"><i class="ti-list"></i> <span>Enroll Capex</span></a></li>
                                                <li ><a href="enrollScopes.php" ><i class="fa fa-plus"></i> <span>Enroll Scopes</span></a></li>
                                            </ul>                                
                                        </li>
                          
                                        <li>
                                            <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-bell"></i><span>Confirmation<span class="badge badge-danger"><?php echo $sumOF ?></span></span></a>                                    
                                            <ul class="collapse">
                                                <li ><a href="ConfirmClosingOfWorks.php"><i class="fa fa-close"></i> <span>Closing of Works<span class="badge badge-danger"><?php echo $row['Total'];?></span></span></a></li>
                                                <!-- <li ><a href="ClosingOfProject.php"><i class="fa fa-close"></i> <span>Closing of Project<span class="badge badge-danger"></span><?php $cf ?></span></a></li> -->
                                                <li ><a href="ApprovalOfBilling.php"><i class="fa fa-close"></i> <span>Billing Approval<span class="badge badge-danger"><?php echo  $FinalApprovalCount?></span></span></a></li>
                                                <li ><a href="ApprovalOfRejectedBilling.php"><i class="fa fa-close"></i> <span>Rejected Billing<span class="badge badge-danger"><?php echo $FinalReject?></span></span></a></li>
                                                <li ><a href="ApprovalOfBillingHistory.php"><i class="fa fa-list"></i> <span>Billing History</span></a></li>
                                                <li ><a href="ContractAmountApproval.php"><i class="fa fa-list"></i> <span>CA Approval<span class="badge badge-danger"><?php echo $CaCountApproval?></span></span></a></li>
                                            </ul>                                
                                        </li>

                                        <li>
                                            <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user"></i><span>Manage User</span></a>                                    
                                            <ul class="collapse">
                                                
                                                <li ><a href="AddNewUser.php"><i class="fa fa-key"></i> <span>Add Account</span></a></li>                                    
                                            </ul>                                
                                        </li>

                                        <li ><a href="enrollProject.php" ><i class="ti-control-forward"></i> <span>Enroll Project</span></a></li>
                                    
                                        <li ><a href="assignedworks.php" ><i class="ti-list"></i> <span>Assign Works</span></a></li>
                                        <li ><a href="AssignedWorksList.php" ><i class="ti-list"></i> <span>View Work List</span></a></li>
                                        
                                        <li>
                                            <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-eye"></i><span>Monitoring Of Works</span><span class="badge badge-danger"><?php echo $notif?></span></a>                                    
                                            <ul class="collapse">
                                                <li ><a href="PendingToStartWorks.php"><i class="ti-list"></i> <span>Pending Works</span><span class="badge badge-danger"><?php echo $notif?></span></a></li>
                                                <li ><a href="ProjectMonitoring.php"><i class="ti-list"></i> <span>Updating Works</span></a></li>
                                                <li ><a href="OnGoingWorks.php"><i class="ti-list"></i> <span>On-Going Works</span></a></li>
                                                <li ><a href="FinishedWorks.php"><i class="ti-list"></i> <span>Finished Works</span></a></li>
                                            </ul>                                
                                        </li>
                                        <li><a href="ClosingOfProject.php"> <i class="fa fa-close"></i> <span>Closing of Project</span></a></li>
                                        <li><a href="ProjectSummary.php"><i class="fa fa-file"></i> <span>Project Overview<span class="badge badge-danger"></span><?php $cf ?></span></a></li>
                                        <li ><a href="#exampleModal" data-toggle="modal" class=""><i class="fa fa-money"></i> <span>Project Cost And Billing </span></a></li>                               
                                        <!-- additional cost -->
                                        <li>
                                            <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-plus"></i><span>Manage Additional Cost</span></a>                                    
                                            <ul class="collapse">
                                                <li ><a href="AdditionalCost.php"><i class="fa fa-plus"></i> <span>Additional Cost</span></a></li>
                                                <li ><a href='AdditionalCostBillings.php'><i class="fa fa-list"></i> <span>Billing List</span></a></li>
                                            </ul>                                
                                        </li>
                                 <?php 

                                }else if ($NavPosition=='Head'){                                
                                 ?>
                                    <li ><a href="index.php" id="navDashboard"><i class="ti-dashboard"></i> <span>Dashboard</span></a></li>
                                    <li>
                                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-bell"></i><span>Confirmation<span class="badge badge-danger"><?php echo $sumOF ;?></span></span></a>                                    
                                        <ul class="collapse">
                                            <li ><a href="ConfirmClosingOfWorks.php"><i class="fa fa-close"></i> <span>Closing of Works<span class="badge badge-danger"><?php echo $row['Total'];?></span></span></a></li>
                                            <li ><a href="ApprovalOfBilling.php"><i class="fa fa-close"></i> <span>Billing Approval<span class="badge badge-danger"><?php echo $FinalApprovalCount?></span></span></a></li>
                                            <li ><a href="ApprovalOfRejectedBilling.php"><i class="fa fa-close"></i> <span>Rejected Billing<span class="badge badge-danger"><?php echo $FinalReject?></span></span></a></li>
                                            <li ><a href="ApprovalOfBillingHistory.php"><i class="fa fa-list"></i> <span>Billing History</span></a></li>
                                        </ul>                                
                                    </li>

                                    <!-- <li ><a href="enrollProject.php" ><i class="ti-control-forward"></i> <span>Enroll Project</span></a></li>
                                
                                    <li ><a href="assignedworks.php" ><i class="ti-list"></i> <span>Assign Works</span></a></li> -->
                                    <!-- <li ><a href="AssignedWorksList.php" ><i class="ti-list"></i> <span>View Work List</span></a></li> -->
                                    
                                    <li>
                                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-eye"></i><span>Monitoring Of Works</span><span class="badge badge-danger"><?php echo $notif?></span></a>                                    
                                        <ul class="collapse">
                                            <li ><a href="PendingToStartWorks.php"><i class="ti-list"></i> <span>Pending Works</span><span class="badge badge-danger"><?php echo $notif?></span></a></li>
                                            <!-- <li ><a href="ProjectMonitoring.php"><i class="ti-list"></i> <span>Updating Works</span></a></li> -->
                                            <li ><a href="OnGoingWorks.php"><i class="ti-list"></i> <span>On-Going Works</span></a></li>
                                            <li ><a href="FinishedWorks.php"><i class="ti-list"></i> <span>Finished Works</span></a></li>
                                        </ul>                                
                                    </li>
                                    <li><a href="ClosingOfProject.php"><i class="fa fa-close"></i> <span>Closing of Project</span></a></li>
                                    <li><a href="ProjectSummary.php"><i class="fa fa-file"></i> <span>Project Overview<span class="badge badge-danger"></span><?php $cf ?></span></a></li>
                                    <li><a href="#exampleModal" data-toggle="modal" class=""><i class="fa fa-money"></i> <span>Project Cost And Billing </span></a></li> 
                                    <li>
                                            <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-plus"></i><span>Manage Additional Cost</span></a>                                    
                                            <ul class="collapse">
                                                <li ><a href="AdditionalCost.php"><i class="fa fa-plus"></i> <span>Additional Cost</span></a></li>
                                                <li ><a href='AdditionalCostBillings.php'><i class="fa fa-list"></i> <span>Billing List</span></a></li>
                                            </ul>                                
                                        </li>    
                                 <?php    

                                }else if ($NavPosition=='Planner'){                                
                                    ?>
                                    <li ><a href="enrollProject.php" ><i class="ti-control-forward"></i> <span>Enroll Project</span></a></li>
                                
                                    <li ><a href="assignedworks.php" ><i class="ti-list"></i> <span>Assign Works</span></a></li>
                                    <li ><a href="AssignedWorksList.php" ><i class="ti-list"></i> <span>View Work List</span></a></li>
                                    <li ><a href="ContractAmountApproval.php"><i class="fa fa-list"></i> <span>CA Approval<span class="badge badge-success"><?php echo $CaCountApproved?></span></span></a></li>
                                    <?php    
                                    
                                }else if ($NavPosition=='Eo'){                               
                                    ?>
                                     <li ><a href="index.php" id="navDashboard"><i class="ti-dashboard"></i> <span>Dashboard</span></a></li>
                                     <li>
                                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-eye"></i><span>Monitoring Of Works</span></a>                                    
                                        <ul class="collapse">
                                            <!-- <li ><a href="PendingToStartWorks.php"><i class="ti-list"></i> <span>Pending Works</span></a></li> -->
                                            <li ><a href="ProjectMonitoring.php"><i class="ti-list"></i> <span>Updating Works</span></a></li>
                                            <li ><a href="OnGoingWorks.php"><i class="ti-list"></i> <span>On-Going Works</span></a></li>
                                            <li ><a href="FinishedWorks.php"><i class="ti-list"></i> <span>Finished Works</span></a></li>
                                        </ul>                                
                                    </li>
                                    <li><a href="ProjectSummary.php"><i class="fa fa-file"></i> <span>Project Overview<span class="badge badge-danger"></span><?php $cf ?></span></a></li>
                                    <li ><a href="RejectedBillings.php"><i class="fa fa-close"></i> <span>Rejected Billing<span class="badge badge-danger"><?php echo $Creject?></span></span></a></li>
                                    <li ><a href="#exampleModal" data-toggle="modal" class=""><i class="fa fa-money"></i> <span>Project Cost And Billing </span></a></li>
                                    <li>
                                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-plus"></i><span>Manage Additional Cost</span></a>                                    
                                        <ul class="collapse">
                                            <li ><a href="AdditionalCost.php"><i class="fa fa-plus"></i> <span>Additional Cost</span></a></li>
                                            <li ><a href='AdditionalCostBillings.php'><i class="fa fa-list"></i> <span>Billing List</span></a></li>
                                        </ul>                                
                                    </li>
                                    <?php
                                }else if ($NavPosition=='Proponent'){                                
                                    ?>
                                    <li ><a href="SecondApprovalOfBilling.php" ><i class="ti-list"></i> <span>For Approval</span></a></li>
                                    <li ><a href="SecondApproverHistory.php" ><i class="ti-list"></i> <span>History</span><span class="badge badge-danger"><?php echo $SecondHistory?></span></a></li>
                                    <li ><a href="ContractAmountApproval.php"><i class="fa fa-list"></i> <span>CA Approval<span class="badge badge-danger"><?php echo $CaCountApproval?></span></span></a></li>
                                    <?php    
                                    
                                }else if ($NavPosition=='Approver-2'){                                
                                    ?>
                                    <li ><a href="ThirdApprovalOfBilling.php" ><i class="ti-list"></i> <span>For Approval</span></a></li>
                                    <li ><a href="ThirdApproverHistory.php" ><i class="ti-list"></i> <span>History</span><span class="badge badge-danger"><?php echo $ThirdHistory?></span></a></li>
                                    <?php    
                                    
                                }else if ($NavPosition=='Final-Approver'){                                
                                    ?>
                                    <li ><a href="FinalApprovalOfBilling.php" ><i class="ti-list"></i> <span>For Approval</span></a></li>
                                    <li ><a href="FinalApprovalHistory.php" ><i class="ti-list"></i> <span>History</span></a></li>
                                    <?php    
                                    
                                }else if ($NavPosition=='Amg'){                                
                                    ?>
                                     <li>
                                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-plus"></i><span>Printing OF Billings</span></a>                                    
                                        <ul class="collapse">
                                            <li ><a href="PrintingOfBillings.php" ><i class="ti-list"></i> <span>Regular Billings<span class="badge badge-danger"><?php echo $printingTotal;?></span></span></a></li>
                                            <li ><a href='AdditionalCostBillings.php'><i class="fa fa-list"></i> <span>Additional Cost</span></a></li>                                       
                                        </ul>                                
                                    </li>
                                    <li ><a href="ApprovalHistory.php" ><i class="ti-list"></i> <span>Approval History</span></a></li>
                                    <?php

                                }else if ($NavPosition=='Finance-FA'){                                
                                    ?>
                                    <li ><a href="projectMasterlist.php" ><i class="ti-list"></i> <span>Enroll Capex</span></a></li>
                                    <li>
                                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-calendar"></i><span>Project Cost Details</span></a>                                    
                                        <ul class="collapse">
                                            <li ><a href="BudgetedVsApplied.php" ><i class="ti-list"></i> <span>Budgeted vs Applied</span></a></li>
                                            <li ><a href="ProjectCostDetails.php" ><i class="ti-list"></i> <span>Project Cost Details</span></a></li>                                    
                                        </ul>                                
                                    </li>
                                  
                                    <?php
                                }else if ($NavPosition=='Finance-Tagging'){                                
                                    ?>
                                        <li ><a href="BudgetedVsApplied.php" ><i class="ti-list"></i> <span>Budgeted vs Applied</span></a></li>
                                        <li ><a href="ProjectCostDetails.php" ><i class="ti-list"></i> <span>Project Cost Details</span></a></li> 
                                    <?php
                                }else if ($NavPosition=='Internal-Audit'){                                
                                    ?>
                                        <!-- <li ><a href="BudgetedVsApplied.php" ><i class="ti-list"></i> <span>Budgeted vs Applied</span></a></li> -->
                                        <li ><a href="ProjectCostDetailsAudit.php" ><i class="ti-list"></i> <span>Project Cost Details</span></a></li> 
                                    <?php
                                }                                              

                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
     
        <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select Capex Number</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="ManageProjectCost.php" method="POST" encytype="multipart/form">
                    <div class="modal-body">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustomUsername">Select Here</label>
                                <div class="input-group">      
                                   <select name="TriggerCapex" id="TriggerCapex" class="custom-select" required>
                                    <option value=""></option>
                                    <?php   
                                     if(isset($_SESSION['position'])){
                                        $fullname=$_SESSION['fullname'];
                                            $Position = $_SESSION['position'];
                                            if($Position == 'Eo'){
                                                $view = $GlobalConnection->runQuery("SELECT * FROM apollo_enrolledproject WHERE project_status ='Open' AND engineer='$fullname'");
                                                $view->execute();
                                            }
                                            else{
                                                $view = $GlobalConnection->runQuery("SELECT * FROM apollo_enrolledproject WHERE project_status ='Open'");
                                                $view->execute();
                                            }
                                        }
                                        while($row = $view->fetch(PDO::FETCH_ASSOC))
                                        {
                                            ?>
                                             <option value="<?php echo $row['capex_number']; ?>"><?php echo $row['capex_number']; ?> - <?php echo $row['project_name']; ?></option>    
                                            <?php
                                         }
                                    ?>               
                                   </select>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">                    
                    <button type="submit" class="btn btn-info"><i class="fa fa-arrow-right"></i> Proceed</button>
                </div>
                </form>
                </div>
            </div>
            </div>
            
          
    
      

  