@extends('front.master')
@section('page_title', "Create an Ad")

<?php

	$world_countries = ['EG'=>'Egypt', 'IR'=>'Iran', 'BR'=>'Brazil'];

?>

@section('content')

	@include('front.realty.add-ons.style')
	@include('front.realty.add-ons.jumbotron')

	<style>
      #map {
        height: 400px;
        width: auto;
        margin: 0 auto;
        border-radius: 5px;
        box-shadow: 1px 1px 1px rgba(45,45,45,.3);
      }

      #pac-input {
        background-color: #fff;
        border-radius: 2px;
        border: 1px solid transparent;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        box-sizing: border-box;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        height: 29px;
        margin-left: 17px;
        margin-top: 10px;
        outline: none;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }
  	</style>

  	<div class="container">
    	<h4>Please choose your ad place</h4>
      	<input id="pac-input" class="form-controls" type="text" placeholder="Enter a location">
		<div id="map"></div>
    </div>  

    <br>
	
	<div class="container">
		<div class="col-md-8 col-md-offset-2">
			<table class="table table-hover">
				@if(count($errors)>0)
					<tr>
						<td colspan="2">
							<div class="alert alert-danger">
								<ul>	
									@foreach($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>	
							</div>
						</td>
					</tr>
				@endif
				<tr class="info">
					<th colspan="2"><h3><b>Creating a new realty</b></h3></th>
				</tr>
				<tr class="active">
					<td><h3>Upload image/(s) for your realty</h3></td>
					<td>
						<h5><b>All images must be with extension jpg</b></h5><br>
						{!! Form::open(["url"=>"/realty" ,"id"=>"createRealty" , "enctype"=>"multipart/form-data"]) !!}
						<input type="file" name="images[]" multiple="multiple" class="form-control">
					</td>
				</tr>
				<tr class="active">
					<td><h3>Address</h3></td>
					<td>
						<div class="form-group">
							<select name="country" class="form-control">
								<option value="0" selected>Please choose country...</option>
								@foreach($world_countries as $symbol=>$country_name)
									<option value="{{$symbol}}">{{$country_name}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">	
							<select name="city" class="form-control" disabled>
								<option value="0" selected>Please choose city...</option>
							</select>
						</div>
						{!! Form::text('region','',["class"=>"form-control","placeholder"=>"region"]) !!}
						{!! Form::text('street','',["class"=>"form-control","placeholder"=>"street"]) !!}
						{!! Form::text('house_no','',["class"=>"form-control","placeholder"=>"house number"]) !!}
						{!! Form::text('apartment_no','',["class"=>"form-control","placeholder"=>"apartment number"]) !!}
					</td>
				</tr>
				<tr class="active">
					<td><h3>For:</h3></td>
					<td>
						{!! Form::radio('type','rent',["class"=>"form-control"]) !!} Rent
						{!! Form::radio('type','sell',["class"=>"form-control"]) !!}  Sell
					</td>
				</tr> 
				<tr class="active">
					<td><h3>Area:</h3></td>
					<td>
						{!! Form::text('area','',["class"=>"form-control","placeholder"=>"in meter square"]) !!}
					</td>
				</tr>
				<tr class="active">
					<td><h3>price</h3></td>
					<td>
						{!! Form::text('price','',["class"=>"form-control","placeholder"=>""]) !!} -$
					</td>
				</tr>
				<tr class="active">
					<td><h3>Description:</h3></td>
					<td>
						{!! Form::textarea('description','',["class"=>"form-control","placeholder"=>"Descripe your department"]) !!}
					</td>
				</tr>
				<tr class="active">
					<td><h3>Telephone:</h3></td>
					<td>
						{!! Form::text('telephone','01',["class"=>"form-control"]) !!}
					</td>
				</tr>
				<tr class="active">
					<td colspan="2">
						{!! Form::submit('Add',["class"=>"btn btn-info btn-block"]) !!}
						{!! Form::close() !!}
					</td>
				</tr>
			</table>
		</div>
	</div>

	<script>

      // global "map" variable
      var map;
      var marker = false;

      function initMap() {
        var infowindow = new google.maps.InfoWindow({ 
          size: new google.maps.Size(150,50)
        });

        // A function to create the marker and set up the event window function 
        function createMarker(latlng, name, html) {
            var contentString = html;
            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                zIndex: Math.round(latlng.lat()*-100000)<<5
            });

            google.maps.event.addListener(marker, 'click', function() {
                infowindow.setContent(contentString); 
                infowindow.open(map,marker);
            });
            google.maps.event.trigger(marker, 'click');    
            return marker;
        }

        /*function geocodeAddress(geocoder, resultsMap, address) {
	        geocoder.geocode({'address': address}, function(results, status) {
	          if (status === 'OK') {
	            resultsMap.setCenter(results[0].geometry.location);
	            /*var marker = new google.maps.Marker({
	              map: resultsMap,
	              position: results[0].geometry.location
	            });
	            //console.log(results[0].geometry.location);
	            return results[0].geometry.location;
	          } else {
	            alert('Geocode was not successful for the following reason: ' + status);
	          }
	        });
	        
		}*/

        // create the map
        var myOptions = {
          zoom: 5,
          center: new google.maps.LatLng(28, 32),
          mapTypeControl: true,
          mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
          navigationControl: true,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        map = new google.maps.Map(document.getElementById("map"), myOptions);
        var geocoder = new google.maps.Geocoder();

        var input = document.getElementById('pac-input');

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var marker = new google.maps.Marker({
          map: map
        });

        marker.addListener('click', function() {
          infowindow.open(map, marker);
        });

        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            return;
          }

          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
          }

          // Set the position of the marker using the place ID and location.
          marker.setPlace({
            placeId: place.place_id,
            location: place.geometry.location
          });
          marker.setVisible(true);

          /*infowindow.setContent('<div><strong>' + place.name + '</strong><br>' +
              'Place ID: ' + place.place_id + '<br>' +
              place.formatted_address);*/
          
          //console.log($.trim(formatted_address.pop()));
          infowindow.setContent(place.formatted_address);
          infowindow.open(map, marker);

          var country_short_name = place.address_components.pop().short_name;
          $('select[name="country"] option').each(function(){
            	$('select[name="country"] option').removeAttr('selected');
            	if($(this).val() == country_short_name){
            		$(this).prop('selected', 'selected');
            		return false;
            	} else {
            		$(this).parent().find('option:first-child').prop('selected', 'selected');
            	}
            })
        });

        google.maps.event.addListener(map, 'click', function(event) {
          infowindow.close();

          //call function to create marker
          if (marker) {
            marker.setMap(null);
            marker = null;
          }

          geocoder.geocode({
            'latLng': event.latLng
          }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
              if (results[0]) {
                var country_short_name = results[0].address_components.pop().short_name;
                marker = createMarker(event.latLng, "name", results[0].formatted_address);
                //console.log(country_short_name);
              
                $('select[name="country"] option').each(function(){
                	$('select[name="country"] option').removeAttr('selected');
                	if($(this).val() == country_short_name){
                		$(this).prop('selected', 'selected');
                		return false;
                	} else {
                		$(this).parent().find('option:first-child').prop('selected', 'selected');
                	}
                })
              }
            }
          });
        });

		$('select[name="country"]').change(function(){
          var country_symbol = $(this).val();

          if (marker) {
            marker.setMap(null);
            marker = null;
          }

          geocoder.geocode({'address': country_symbol}, function(results, status) {
	          if (status === 'OK') {
	            map.setCenter(results[0].geometry.location);
	            map.setZoom(5);
	            marker = createMarker(results[0].geometry.location, "name", results[0].formatted_address);
	          } else {
	            alert('Geocode was not successful for the following reason: ' + status);
	          }
	      });
        });
      }
    </script> 
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBo1G-3ZluUbXJQqY6HGiqFOixHx2m-kSk&libraries=places&callback=initMap" async defer></script>
@stop