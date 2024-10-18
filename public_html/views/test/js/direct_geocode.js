ymaps.ready(init);
var myMap;
function changeMap(adress, name, shop_id){
        $(".bolded").removeClass("bolded");
        $("#"+shop_id).addClass("bolded");
        $('.panel-heading').html('<strong>' + name + '</strong> - ' + adress);

        if (myMap){
                myMap.destroy();// Деструктор карты
                myMap = null;
        }
         myMap = new ymaps.Map('map', {
        center: [48.492204, 135.099509],
        zoom: 9
    });

ymaps.geocode('г. Хабаровск, ул. Промышленная 11', {
        results: 1
    }).then(function (res) {
            var firstGeoObject = res.geoObjects.get(0),
                coords = firstGeoObject.geometry.getCoordinates(),
                bounds = firstGeoObject.properties.get('boundedBy');
//myMap.geoObjects.add(firstGeoObject);
            myMap.setBounds(bounds, {
                checkZoomRange: true
            });


             var myPlacemark = new ymaps.Placemark(coords, {
             iconContent: name,
             balloonContent: adress
             }, {
             preset: 'islands#violetStretchyIcon'
             });

             myMap.geoObjects.add(myPlacemark);
        });
}

function init() {
                myMap = new ymaps.Map('map', {
        center: [48.492204, 135.099509],
        zoom: 9
    });

    ymaps.geocode('г. Хабаровск, ул. Промышленная 11', {
        results: 1
    }).then(function (res) {
            var firstGeoObject = res.geoObjects.get(0),
                coords = firstGeoObject.geometry.getCoordinates(),
                bounds = firstGeoObject.properties.get('boundedBy');
//myMap.geoObjects.add(firstGeoObject);
            myMap.setBounds(bounds, {
                checkZoomRange: true
            });


             var myPlacemark = new ymaps.Placemark(coords, {
             iconContent: 'ООО МИРС',
             balloonContent: 'г. Хабаровск, ул. Промышленная 11'
             }, {
             preset: 'islands#violetStretchyIcon'
             });

             myMap.geoObjects.add(myPlacemark);
        });
}

