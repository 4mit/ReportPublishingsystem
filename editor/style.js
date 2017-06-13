$(document).ready(function(){		

		$('.table').css({"width": "500px !important", "overflow-x": "scroll !important"});
		$('body').css({"background-color":"black"});
		$('.upload_file_info').hide();
		$('.pan-btn a').css({
			"display":"block",
			"text-decoration":"none",
			"font-size":"24px",
			"transition":".51s all linear"

		});

		$('.pan-btn > a').hover(function() 
		{
			$(this).next().next().slideDown();
	      	$(this).css({
	      		"margin-bottom":"2px",    
	      		"margin-top":"-1px",
	      		"border-bottom":"2px solid red",
	      		"box-shadow":"inset 500px 0px 0px rgba(254, 167, 66, 0.4);",
	      		"background-color": "rgba(139, 139, 147, 0.6)"

	      	});
			},function(){
				$('.upload_file_info').slideUp();
				$(this).css({
					"box-shadow":"none",
					"margin-top":"1px",
					"background-color": "transparent",
					"border-bottom":"none"
			});
		});
		
		$('#verify_pop').tooltip({
				"animation":true,
				"content":"Hello Popover im here to see you",
				"delay":"1s",
				"placement":"top",
				"title":"Upload your file here be sure file constraint "
		});

		$('#reject_pop').tooltip({
				"animation":true,
				"content":"Hello Popover im here to see you",
				"delay":"1s",
				"placement":"top",
				"title":"click to see List of all rejected records here "
		});
	});