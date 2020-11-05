<?php

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\models\Location;

/* @var $this yii\web\View */

$this->title = 'Work Flow & Map';

$markers = Location::find()->innerJoinWith('listing')->asArray()->all();
?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmnULnIcTW4J_9NxGeHhLSVLme6Ba36AE&callback=initMap&libraries=&v=weekly" defer></script>

<div id="homemap"></div>

<div class="btn-group-fab" role="group" aria-label="FAB Menu">
  <div>
    <button type="button" class="btn btn-main btn-primary has-tooltip" data-placement="left" title="Menu"> <i class="fa fa-bars"></i> </button>
    <button type="button" class="btn btn-sub btn-info has-tooltip" data-placement="left" title="Fullscreen"> <i class="fa fa-arrows-alt"></i> </button>
    <button type="button" class="btn btn-sub btn-danger has-tooltip" data-placement="left" title="Save"> <i class="fa fa-floppy-o"></i> </button>
    <?= Html::a('<i class="fa fa-plus"></i>', ['listing/create'], ['class' => 'btn btn-sub btn-success has-tooltip','title'=>'Add Listing']) ?>
  </div>
</div>
<script type="text/javascript">
      // Initialize and add the map
      function initMap() {
        // The location of Nairobi
        const nairobi = { lat: -1.286389, lng: 36.817223 };
        // The map, centered at Uluru
        const map = new google.maps.Map(document.getElementById("homemap"), {
          zoom: 7,
          center: nairobi,
        });
        
        
        
        // Put a marker foreach listing
        var markers = <?php echo json_encode($markers)?>;
        markers.forEach(putMarkers);
       
        function putMarkers(item) {
        
            const contentString =
                '<div id="content">' +
                '<div id="siteNotice">' +
                "</div>" +
                '<h1 id="firstHeading" class="firstHeading">'+item.listing.listingName+'</h1>' +
                '<div id="bodyContent">' +
                "<p>"+item.listing.listingDesc+"</p>" +
                '<p>If you want to lern more About: '+item.listing.listingName+' visit, <a href="'+item.listing.videoUrl+'">' +
                ""+item.listing.listingName+"</a> " +
                "(Date Posted: "+item.listing.createdAt+").</p>" +
                "</div>" +
                "</div>";
            
              const infowindow = new google.maps.InfoWindow({
                content: contentString,
              });
        
        
        
        
        console.log(item);
             var  lat = parseFloat(item.lattitude);
             var  lng = parseFloat(item.longitude);
            const marker = new google.maps.Marker({
              position: { lat: lat, lng: lng },
              map: map,
              title: item.listing.listingName+" ("+item.city+")",
            });
            
          marker.addListener("click", () => {
            infowindow.open(map, marker);
          });
        }


      }

</script>