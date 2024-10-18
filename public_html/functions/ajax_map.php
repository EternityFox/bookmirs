<?php
$params = array(
    'geocode' => $_REQUEST['address'], 
    'format'  => 'json',        
    'results' => 1,    
);
$response = json_decode(file_get_contents('http://geocode-maps.yandex.ru/1.x/?apikey=03aff5e6-f16f-40b9-a7d9-feba98b36d83&' . http_build_query($params, '', '&')));
$coord = implode(',', explode(' ', $response->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos));
print 'https://static-maps.yandex.ru/1.x/?ll='.$coord.'&l=map&z=15&pt='.$coord.',pm2blm&size=650,350';
