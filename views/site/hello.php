
<?php

echo '<div class="row">';
foreach($cats as $cat) {
    echo '<div class="col-lg-3" text-align="center"><img src="';
    echo $cat->img;
    echo '" width="200px" /><h2>';
    echo $cat->price;
    echo ' р.</h2>';

       echo '<p>';
       echo $cat->name;
           echo '</p></div>';
}
echo '</div>';
?>