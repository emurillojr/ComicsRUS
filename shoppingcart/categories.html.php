<?php
// Ernesto Murillo Final Assignment - categories 

if (isset($allCategories)) :   //if there are any.  start of  isset if
    ?>     
    <ul> 
        <li><a href="?">All</a> </li>     <?php // "?" = no category_id selected so it means all of them   ?>
        <?php
        foreach ($allCategories as $category):   //for each category name -create links of rest of category names
            ?>  
            <li>  
                <?php // attach category_id to category name link ?>
                <a href="?category_id=<?php echo $category['category_id']; ?>">
                    <?php echo $category['category'];    //echo category name as link?>  
                </a>
            </li>    
        <?php endforeach;   // end foreach?>  
    </ul>
<?php endif;  //end if?>  
