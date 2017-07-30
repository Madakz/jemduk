<?php
	use App\Property;

	$column = $_POST["categoey"];
	if(!empty($_POST["categoey"])) 
	{
		$properties = DB::table('properties')->select($column)->get();
		if(!empty($properties)) 
		{
?>
			<ul id="material-list">

	<?php
		foreach($properties as $property) 
			{
	?>
				<!-- <li onClick="selectProperty('<?php echo $property["designation_name"]; ?>');"><?php echo $property["designation_name"]; ?></li> -->
	<?php   
			} 
	?>
			</ul>
	<?php 
		}else{
			?>
			<ul id="material-list">
				<li>No results Found</li>
			</ul>
			<?php

		}
 	} 
 	?>
