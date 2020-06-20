$(document).ready(function(){
	
	textePara = $('.textQuiRight > div')
	photo = $('.textQuiRight > .pictNicolas')

	$('.menu-icon').click(function(e){
		e.preventDefault
		$this = $(this);
		if ($this.hasClass('isOpened'))
		{
			$this.addClass('isClosed').removeClass('isOpened')
			textePara.addClass('paraOpa').removeClass('paraOpa1')
			photo.removeClass('fonduPict')
		}
		else
		{
			$this.removeClass('isClosed').addClass('isOpened')
			textePara.removeClass('paraOpa').addClass('paraOpa1')
			photo.addClass('fonduPict')
		}

	})

});