function generateWordCards()
{	
	var htmlString = '<div class="wordCard" id="wordCard">'+			
						'<p class="contentParagraph" style="width: #cardWidth#px">#ShadyName#</p>'+				
							'<div class="postScript">'+
								'<p>#postScript#</p>'+
							'</div>'+			
					 '</div>';
			
	var inputString = $('#wordInput').val();
	var cardWidth = $('#cardWidth').val();
	var words = inputString.split(',');
	var postScript = $('#postScript').val();
	$('.cardContainer').html('');	
	
	words.forEach(
		function(word){
			$('.cardContainer').append(htmlString.replace('#ShadyName#', word).replace('#cardWidth#', cardWidth).replace('#postScript#', postScript));
		}
	)		
	
	$('.contentParagraph').css({
		"color" : $('#fontColor').val()
	});
	
	$('.wordCard').css({
		"border-color" : $('#borderColor').val()
	});
	
	$('.contentParagraph').css({		
		"font-size" : $('#fontSize').val() + 'px',
		"font-family" : $('input[name=fontFamily]:checked').val()
	});	

	if($('.contentParagraph').css("font-family") == 'Trace'){				
		$('.contentParagraph').css({	
			"font-weight" : 300
		});	
	}	
	if($('.contentParagraph').css("font-family") === '"Century Gothic"'){		
		$('.contentParagraph').css({		
			"top" : '-40px'
		});	
	}
	
		
}
