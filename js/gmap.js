var mapLocation=new google.maps.LatLng(21.146849,72.759691);
var marker;
var map;
function initialize(){var mapOptions={zoom:16,center:mapLocation,scrollwheel:false,styles:[{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#616161"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#f5f5f5"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"on"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#c9b2a6"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#dfd2ae"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#dfd2ae"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#dadada"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#1f2835"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#fdfcf8"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#fdfcf8"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#2f3948"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#b1b1b1"},{"lightness":17}]}]};
map=new google.maps.Map(document.getElementById('map'),mapOptions);
var contentString='<div class="map-info">'
+'<div class="map-title">'
+'<h3><span class="text-primary">Anupam Design Studio</span></h3></div>'
+'<div class="map-address-row"><i class="fa fa-map-marker"></i><span class="text-primary"><h5>1103, Luxuria Business Hub,<br> Dumas Road, Surat.</h5></span></div><div class="map-address-row"><i class="fa fa-phone"></i><span class="text-primary"><h5>(+91) 9909005401</h5></span></div><div class="map-address-row"><span class="map-email"><i class="fa fa-envelope"></i><span class="text-primary"><h5>info@anupamds.com</h5></span></span>'
+'</div>';
var infowindow=new google.maps.InfoWindow({content:contentString,});
marker=new google.maps.Marker({map:map,draggable:true,title:'Anupam Design Studio',animation:google.maps.Animation.DROP,position:mapLocation});
infowindow.open(map,marker);
}
if($('#map').length){google.maps.event.addDomListener(window,'load',initialize);
}