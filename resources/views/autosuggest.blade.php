<?php
	if(isset($properties)) 
	{
        ?>
            <ul id="suggestions">

        <?php
            foreach($properties as $property) 
            {
            	// dd($property->type)
            	if ($property->type) {
            	?>
                    <li onClick="selectProperty('<?php echo $property->type; ?>');"><hr/><?php echo $property->type; ?></li>
                <?php
            	}elseif ($property->location) {
            	?>
                    <li onClick="selectProperty('<?php echo $property->location; ?>');"><hr/><?php echo $property->location; ?></li>
                <?php 
            	}elseif ($property->price) {
            	?>
                    <li onClick="selectProperty('<?php echo $property->price; ?>');"><hr/><?php echo $property->price; ?></li>
                <?php 
            	}
                  
            } 
        ?>
            </ul>
        <?php 
    }
    // else{
        ?>
            <!-- <ul id="material-list">
                <li>No results Found</li>
            </ul> -->
        <?php

    // }
?>