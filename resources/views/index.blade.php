@extends('layouts.master')
@section('pageContent')
 {{ url()->current() }}
<form  role="form" >
	@csrf
		Type Url<input type="text" name="url"></br>
		<button type="submit" id="save">Submit</button>
	</form>
	<p id="message-succ"></p>
	<p></p>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script>
	$(document).ready(function() {
		$('#save').click(function (event) {
			event.preventDefault();
			$.ajax({
				type : 'POST',
				url  : 'url_create',
				data : $('form').serialize(),
				success: function (result) {
					if(result.success==true){
						$("#message-succ").html("<strong>Success! </strong> Url added successfully.");
					}
				}
			});
		});
	});
	</script>
	
	@endsection