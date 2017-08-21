BX.addCustomEvent(window, 'OnBasketChange', function()
	{
	var
		$basket  = $('.av-basket-line'),
		$counter = $basket.find(".counter");

	$.ajax
		({
		type   : 'POST',
		url    : AvBasketLineUpdate,
		data   :
			{
			"site_id" : $basket.attr("data-site-id")
			},
		success: function(result)
			{
			var basketCount = parseInt(result) ? parseInt(result) : 0;
			$counter.html(basketCount);
			if(basketCount > 0) $counter.removeClass("empty");
			else                $counter.addClass("empty");
			}
		});
	});