<?php

include "../classes/Category.php";


Category::update($_POST['category_id'] , $_POST['name_en'] , $_POST['name_ar']);

die(json_encode(['success'=>true , 'message'=>'category data updated successfully']));

