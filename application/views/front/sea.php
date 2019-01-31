<?php

$search = $_POST["name"];


/* $query=mysql_query("select * from projects where project_name LIKE '%{$search}%' or project_type LIKE '%{$search}%'");
 
    while($row=mysql_fetch_assoc($query))
    {
	
		*/?>
      <div style="">
	  <li onclick="f1('<?php echo "jinal"; //$row['project_name'] ?>')">
	  <?php echo "jinni";//$row['project_name']." , ". $row['project_type']."<br>"; ?>
	  </li>
	  </div>
	  <?php
    }
	
?>
<script>
function f1(th){
	
	document.getElementById("search-text-input").value = th;
	
	
}
</script>