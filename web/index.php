<?php

date_default_timezone_set('Asia/Bangkok');

$route['page'] = 
[
    ''=>'admin/index.php',
    'admin/'=>'admin/index.php',
    'admin/basic/config/'=>'admin/basic/config.php',
    'admin/basic/room/'=>'admin/basic/room.php',
    'admin/cost/save/'=>'admin/cost/save.php',
    'admin/cost/list/'=>'admin/cost/list.php',
];

$route['api'] = [
    'api/test'=>'test.php',
];

$uri = array_values(array_slice(explode('/',$_SERVER['REQUEST_URI']),1));
$page = implode('/',$uri);

if(!empty($route['page'][$page])){
    require ('./page/'.$route['page'][$page]);
}elseif(!empty($route['api'][$page])){
    require ('./api/'.$route['api'][$page]);
}
else{
    http_response_code(404);
}

?>