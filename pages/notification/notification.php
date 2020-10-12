<?php
    require_once("./GlobalClass.php");
    $GlobalConnection = new GlobalConnection();

    $current_date = date('Y-m-d');
    $notif = $GlobalConnection->runQuery("SELECT capex_number, COUNT(subscopes)AS Notif FROM `apollo_project_assigned_scopes`
    WHERE work_status='Pending To Start'");
    $notif->execute();
    $row = $notif->fetch();
    $notif = $row['Notif'];	

    if(isset($_SESSION['position'])){
        $fullname=$_SESSION['fullname'];
        $Position = $_SESSION['position'];
        if($Position == 'Head'){
            $NotificationForWorksNeedToStart = $GlobalConnection->runQuery("SELECT capex_number, COUNT(subscopes)AS Notif FROM `apollo_project_assigned_scopes`
            WHERE  work_status='Pending To Start'");
            $NotificationForWorksNeedToStart->execute();
            ?>            
                <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                            <li class="dropdown">
                                <i class="ti-bell dropdown-toggle" id="bell" data-toggle="dropdown">
                                <?php
                                while($RowNotification  = $NotificationForWorksNeedToStart->fetch(PDO::FETCH_ASSOC))
                                    {
                                    ?>
                                        <span><?php echo $RowNotification['Notif'] ?></span>
                                    <?php
                                  
                                ?>
                                </i>
                                <div class="dropdown-menu bell-notify-box notify-box">
                                    <span class="notify-title">Hello <?php echo $fullname?>! You have new notifications!<a href="#"></a></span>
                                    <div class="nofity-list">
                                        <a href="./PendingToStartWorks.php" class="notify-item">
                                            <div class="notify-thumb"><i class="ti-comments-smiley btn-info"></i></div>
                                            <div class="notify-text">
                                                <p>New Work/s Need To Start! <br> Capex: <?php echo $RowNotification['capex_number']?></p>
                                                <span>Date: <?php echo  $current_date?></span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        
                <!-- this is for sound notification -->
                        <?php
                           
                                ?>
                                    <audio id="audiotag1" src="newnotif.mp3" preload="auto"></audio>
                                    <input type="hidden" id="notif" value="<?php echo  $notif ?>"/>     
                                   
                                <?php
                                
                            ?>
                                    
                                                                  
                <!-- this is for sound notification -->            
                        </ul>
                    </div>
                <?php
            }
        }
        elseif($Position == 'Admin'){
            $NotificationForWorksNeedToStart = $GlobalConnection->runQuery("SELECT capex_number, COUNT(subscopes)AS Notif FROM `apollo_project_assigned_scopes`
            WHERE work_status='Pending To Start'");
            $NotificationForWorksNeedToStart->execute();
            ?>
           
            <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                            <li class="dropdown">
                                <i class="ti-bell dropdown-toggle" id="bell" data-toggle="dropdown">
                                <?php
                                while($RowNotification  = $NotificationForWorksNeedToStart->fetch(PDO::FETCH_ASSOC))
                                    {
                                    ?>
                                        <span><?php echo $RowNotification['Notif'] ?></span>
                                    <?php
                                  
                                ?>
                                </i>
                                <div class="dropdown-menu bell-notify-box notify-box">
                                    <span class="notify-title">Hello <?php echo $fullname?>! You have new notifications!<a href="#"></a></span>
                                    <div class="nofity-list">
                                        <a href="./PendingToStartWorks.php" class="notify-item">
                                            <div class="notify-thumb"><i class="ti-comments-smiley btn-info"></i></div>
                                            <div class="notify-text">
                                                <p>New Work/s Need To Start! <br> Capex: <?php echo $RowNotification['capex_number']?></p>
                                                <span>Date: <?php echo  $current_date?></span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        
                <!-- this is for sound notification -->
                        <?php
                           
                                ?>
                                    <audio id="audiotag1" src="newnotif.mp3" preload="auto"></audio>
                                    <input type="hidden" id="notif" value="<?php echo  $notif ?>"/>     
                                   
                                <?php
                                
                            ?>
                                    
                                                                  
                <!-- this is for sound notification -->            
                        </ul>
                    </div>
                <?php
                  }
        }
    // para sa planner at eo this condition
        else{
            ?>
                <div class="col-md-6 col-sm-4 clearfix">
                <ul class="notification-area pull-right">
                <li id="full-view"><i class="ti-fullscreen"></i></li>
                <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                <li class="dropdown">
                    <i class="ti-bell dropdown-toggle" data-toggle="dropdown">                    
                        <span>0</span>                    
                    </i>
                </li>                
                </ul>
                </div>
            <?php
        }   
    }  
?>

<script type="text/javascript" language="javascript">
    $(document).ready(function(){  
        
        $('#notif').each(function(){
            if($(this).val()!=0){
                document.getElementById('audiotag1').play(); 
                $('#bell').click();
                }
            });

    });
</script>

