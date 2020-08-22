@extends('layouts.master')
@section('pageContent')
 
<form  role="form" >
	@csrf
		Type Url<input type="text" name="url"></br>
		<button type="submit" id="save">Submit</button>
	</form>
	<input type="hidden" value="{{ url()->current() }}" id="path">
	<p id="message-succ"></p>
	<p></p>
	<b>Total number of visitors</b>
	<table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>longurl</th>
                      <th>Number person searched</th>
                    </tr>
                  </thead>
                  <tbody id='url_list'>
       

                                   
                  </tbody>
                </table>
                <b>Number of visitors in last hour</b>
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>longurl</th>
                      <th>Number person searched</th>
                    </tr>
                  </thead>
                  <tbody id='url_list1'>
       

                                   
                  </tbody>
                </table>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script>
	$(document).ready(function() {
		loaddata();
		loadurl();
		var pathname = $('#path').val();
	   
	// to show it in an alert window
    		$('#save').click(function (event) {
			event.preventDefault();
			$.ajax({
				type : 'POST',
				url  : 'url_create',
				data : $('form').serialize(),
				success: function (result) {
					console.log(result);
                    
					if(result.success==true){
						$("#message-succ").html("<strong>Success! </strong> Url added successfully.");
					var url=result.data;
					$.each(url, function(key, value){
                       //alert(value.shorturl);
                        $("#message-succ").append('</br><a href="'+value.shorturl+'" target="_blank">'+pathname+"/"+value.shorturl+'</a>');
                      });
				}
				}
			});
		});
	});
	function loaddata()
	{
		var pathname = $('#path').val();
		$.ajax({
      type : 'GET',
      url  : 'get_url',
      data : {},
      success: function (result) {
        if(result.success==true){
          var i=0;
          var table_data=''
          result.urls.forEach(function(url) {
          table_data+='<tr><td>'+ ++i+'</td><td>'+url.longurl+'</td><td>'+url.count+'</td></tr>'
          });
         // console.log(table_data);
        $('#url_list').html(table_data);
        }
      }
    });
	}
	function loadurl()
	{
		var pathname = $('#path').val();
		$.ajax({
      type : 'GET',
      url  : 'get_url1',
      data : {},
      success: function (result) {
        if(result.success==true){
          var i=0;
          var table_data=''
          result.urls.forEach(function(url) {
          table_data+='<tr><td>'+ ++i+'</td><td>'+url.longurl+'</td><td>'+url.count+'</td></tr>'
          });
         // console.log(table_data);
        $('#url_list1').html(table_data);
        }
      }
    });
	}
	</script>
	
	@endsection