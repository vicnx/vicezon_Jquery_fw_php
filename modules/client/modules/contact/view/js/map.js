function initMap() {
      var ontinyent = {lat: 38.8220593, lng: -0.6063927};
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: ontinyent
      });
      var contentString = '<div id="content">'+
          '<div id="siteNotice">'+
          '</div>'+
          '<h1 id="firstHeading" class="firstHeading">Vicezon Shop</h1>'+
          '<div id="bodyContent">'+
          '<p>We are a technology products company with the most competitive prices</p>'+
          '<p>Attribution:<b> Vicezon</b>, <a href="http://localhost/vicezon</a> '+
          '</p>'+
          '</div>'+
          '</div>';
          var infowindow = new google.maps.InfoWindow({
              content: contentString
            });
    
            var marker = new google.maps.Marker({
              position: ontinyent,
              map: map,
              title: 'ViceZon'
            });
            marker.addListener('click', function() {
              infowindow.open(map, marker);
            });
          }
  