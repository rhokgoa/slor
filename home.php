<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>SLOR</title>
    <style type="text/css">
      html, body, #map-canvas { height: 100%; margin: 0; padding: 0;}
    </style>
    <script src="js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJnJCVhKRd_CuBlyxJ6nR0CpZw21tcIuo">
    </script>
    <script type="text/javascript">
      var data;
      var cityCircle;

      $.get('data.json', function(dat) {
        //console.log(dat)
        var temp = dat.substring(1,dat.length-1);
        data = $.parseJSON(dat);
        //console.table(data);
        console.log("Data Parsed");
      });
      function initialize() {
        var mapOptions = {
          center: { lat: 15.422361 , lng: 74.000151},
          zoom: 12
          //mapTypeId: google.maps.MapTypeId.TERRAIN
        };
        var map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);

        var max = Math.max.apply(Math,data.map(function(o){return o.count;}));
        //console.log(data);
        for (var place of data) {
          //console.log(place);
            var populationOptions = {
              strokeColor: '#FF0000',
              strokeOpacity: 0.8,
              strokeWeight: 2,
              fillColor: '#FF0000',
              fillOpacity: place.count/max,
              map: map,
              center: new google.maps.LatLng(place.lat, place.lng),
              radius: 300
            };
            // Add the circle for this city to the map.
            cityCircle = new google.maps.Circle(populationOptions);
          }
      }
      
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- siimple style -->
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">SLOR</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="home.php">Hotspots (Density)<span class="sr-only">(current)</span></a></li>
            <li><a href="hotspots.php">Hotspots (Count)</a></li>
            <li><a href="deploy.php">Deployments</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    
    <div class="embed-responsive embed-responsive-16by9">
      <div class="embed-responsive-item" id="map-canvas"></div>
    </div> 
    
    <!--script type="text/javascript">
      $.get('data.json', function(data) {
        var obj = $.parseJSON(data);
        for (var i in obj){
        
        }
        alert( obj.length);
      });
    </script>-->
  </body>
</html>