
<?php 


    require_once("class.php");
    $AssignedWorks = new AssignedWorks();

    $query = "SELECT apollo_genscopes.Scope_id AS id, 'not set' AS projectname, apollo_genscopes.GenScopes AS genscope,'' AS amount, 0 AS percent, 'Open' AS scope_status, '' AS plannedstart, '' AS plannedend FROM apollo_genscopes";
    $statement = $AssignedWorks->runQuery($query);

    if($statement->execute())
    {
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
    $data[] = $row;
    }

    echo json_encode($data);
    }

    
?>
