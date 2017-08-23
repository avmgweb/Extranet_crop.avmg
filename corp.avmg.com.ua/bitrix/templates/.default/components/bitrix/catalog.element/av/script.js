/* -------------------------------------------------------------------- */
/* ---------------------------- funcstions ---------------------------- */
/* -------------------------------------------------------------------- */
function AvCatalogElementViewTableBehavior()
	{
	var
		$infoTableWraper = $('.av-catalog-element .info-table-wraper'),
		$infoTable       = $infoTableWraper.find('.info-table');

	$infoTableWraper.css("height", $infoTable.height());
	if($infoTableWraper.width() == $infoTable.width()) $infoTable.css({cursor: 'default', left: 0});
	else                                               $infoTable.css({cursor: 'move'});
	}
/* -------------------------------------------------------------------- */
/* ----------------------------- handlers ----------------------------- */
/* -------------------------------------------------------------------- */
$(function()
	{
	SetFormElementsCurrentLibrary("av_site");
	/* ------------------------------------------- */
	/* -------------- images block --------------- */
	/* ------------------------------------------- */
	$('.av-catalog-element .images-block')
       .on("vclick", '.main-image-wraper img:not(.default)', function()
			{
			var $content = $('<div class="image-detail-view"></div>');
			if($(this).closest('.images-block').find('.slider .slider-image').length) $content.addClass("slider");

			$content
				.append('<img src="'+$(this).attr("src")+'">')
				.css
					({
					"align-items"    : 'center',
					"display"        : 'flex',
					"justify-content": 'center'
					})
				.find('img').css
					({
					"max-width" : '700px',
					"max-height": '700px'
					});

			CreateAvAlertPopup($content.wrap('<div></div>').parent().html())
				.css
					({
					"max-width" : '800px',
					"max-height": '800px'
					})
				.positionCenter(1000, 'Y', 'Y')
				.hideOnClickout("remove");
			})
       .find('.slider')
	       .slick
				({
				infinite      : true,
				slidesToShow  : 3,
				slidesToScroll: 3
				})
	       .on("vclick", '.slider-image', function()
				{
				$(this).closest('.images-block')
					.find('.main-image-wraper img:not(.default)')
					.attr("src", $(this).attr("src"));
				});
	/* ------------------------------------------- */
	/* --------------- table info ---------------- */
	/* ------------------------------------------- */
	AvCatalogElementViewTableBehavior();
	$(window).resize(function() {AvCatalogElementViewTableBehavior()});

	$('.av-catalog-element .info-table-wraper')
		/* ---------------------------- */
		/* ----- draging behavior ----- */
		/* ---------------------------- */
		.on("vmousedown", function(event)
			{
			$(this).data
				(
				'dragingPositionStart',
					{
					position: event.pageX,
					time    : Date.now()
					}
				);
			})
		.on("vmouseup", function(event)
			{
			var positionStart = $(this).data('dragingPositionStart');
			if(positionStart && positionStart.animate)
				{
				var
					$infoTable            = $(this).find('.info-table'),
					tableMaxRightPosition = ($infoTable.width() - $(this).width()) * -1;

				$infoTable.animate({left: positionStart.animate == 'right' ? tableMaxRightPosition : 0}, 400);
				}

			$(this).data
				(
				'dragingPositionStart',
					{
					position: 0,
					time    : 0,
					animate : 0
					}
				);
			})
		.on("vmousemove", function(event)
			{
			var positionStart = $(this).data('dragingPositionStart');
			if(!positionStart || !positionStart.position) return;

			var
				$infoTable            = $(this).find('.info-table'),
				timeDifference        = Date.now()  - positionStart.time,
				positionDifference    = event.pageX - positionStart.position,
				dragingDirection      = event.pageX > positionStart.position ? 'left' : 'right',
				tableNeedPosition     = positionDifference + parseInt($infoTable.css("left")),
				tableMaxRightPosition = ($infoTable.width() - $(this).width()) * -1;

			     if(tableNeedPosition > 0)                     tableNeedPosition = 0;
			else if(tableNeedPosition < tableMaxRightPosition) tableNeedPosition = tableMaxRightPosition;

			$infoTable.css("left", tableNeedPosition);

			$(this).data
		       (
		       'dragingPositionStart',
			       {
			       position: event.pageX,
			       time    : Date.now(),
			       animate : timeDifference < 30 && Math.abs(positionDifference) > 15 ? dragingDirection : false
			       }
		       );
			})
		/* ---------------------------- */
		/* ----- counter behavior ----- */
		/* ---------------------------- */
		.on("change keyup input click", '.item-row .counter input', function()
			{
			var
				$checkerBack = $(this).parent().find('.checker.back'),
				$checkButton = $(this).closest('.item-row').find('.check-block > *'),
				value        = this.value
					.replace(/[^\d,.]*/g, '')
					.replace(/([,.])[,.]+/g, '$1')
					.replace(/^[^\d]*(\d+([.,]\d{0,5})?).*$/g, '$1')
					.replace(',', '.');

			this.value = value;
			value = parseFloat(value);

			if(!value || value < 0) $checkButton.hide();
			else                    $checkButton.show();
			if(value > 1)           $checkerBack.removeClass("disabled");
			else                    $checkerBack.addClass("disabled");
			})
		.on("keyup", '.item-row .counter input', function(event)
			{
			var $checkButton = $(this).closest('.item-row').find('.check-block > *');
			if(event.keyCode == 13 && $checkButton.is(':visible')) $checkButton.click();
			})
		.on("vclick", '.item-row .counter .checker', function()
			{
			var
				$input = $(this).parent().find('input'),
			    value  = parseInt($input.val());

			     if($(this).hasClass("back"))    value--;
			else if($(this).hasClass("forward")) value++;
			if(!value || value < 1)              value = 1;

			$input
				.attr("value", value)
				.val(value)
				.trigger("change");
			})
		/* ---------------------------- */
		/* ------ change position ----- */
		/* ---------------------------- */
		.on("click", '.change-block > *:nth-child(2)', function()
			{
			$(this).closest('.item-row')
		       .removeClass("checked")
		       .find('.counter')
		           .removeClass("disabled")
		           .find('input').removeAttr("disabled");
			})
		/* ---------------------------- */
		/* ------- add position ------- */
		/* ---------------------------- */
		.on("click", '.check-block > *', function()
			{
			var
				$infoTable = $(this).closest('.info-table'),
				$itemRow   = $(this).closest('.item-row'),
				$counter   = $itemRow.find('.counter'),
				elementId  = $itemRow.attr("data-element-id");

			AvWaitingScreen("on");
			$.ajax
				({
				type    : 'POST',
				url     : AvCatalogElementCheckPosition,
				data    :
					{
					"element_id": elementId,
					"count"     : $counter.find('input').val(),
					"price_type": $infoTable.attr("data-price-type"),
					"site_id"   : $infoTable.attr("data-site-id")
					},
				success : function(result)
					{
					var
						answerObj          = $.parseJSON(result),
						answerResult       = answerObj ? answerObj.result                    : 'error',
						answerElementId    = answerObj ? answerObj.element_id                : 0,
						answerElementCount = answerObj ? parseFloat(answerObj.element_count) : 0;
						if(!answerElementId || answerElementId != elementId) return;

					if(answerResult == 'position_add' && answerElementCount)
						{
						$itemRow.addClass("checked");
						$counter
							.addClass("disabled")
							.find('input')
								.val(answerElementCount)
								.attr("value", answerElementCount)
								.attr("disabled", true);
						}
					else
						$counter
							.addClass("disabled")
							.find('input')
								.val(1)
								.attr("value", 1);

					AvCatalogElementViewTableBehavior();
					},
				complete: function()
					{
					BX.onCustomEvent("OnBasketChange");
					AvWaitingScreen("off");
					}
				});
			})
		/* ---------------------------- */
		/* --------- ask form --------- */
		/* ---------------------------- */
		.on("click", '.ask-price-call-form', function()
			{
			var
				$askFormBlock    = $('.av-catalog-element-ask-form'),
				$itemRow         = $(this).closest('.item-row'),
			    positionQuantity = $itemRow.find('.counter input').val();
			if(!$askFormBlock.length) return;

			AvBlurScreen("on", 1000);
			CreateAvAlertPopup
				(
				$('<div class="av-catalog-element-ask-form-wraper"></div>')
					.html($askFormBlock.html())
					.wrap('<div></div>').parent()
					.html()
				)
				.positionCenter(1100, 'Y', 'Y', 'Y')
				.hideOnClickout("remove")
				.on("remove", function()
					{
					AvBlurScreen("off");
					})
			    .find('.av-catalog-element-ask-form-wraper')
					.each(function()
						{
						$(this)
							.width($(this).width())
							.height($(this).height() + 13);
						})
					.find('.form-name')
						.text($itemRow.attr("data-element-name"))
						.closest('.av-catalog-element-ask-form-wraper')
					.getFormElememt({name: $askFormBlock.attr("data-link-field-id")})
						.setFormElememtParam
							(
							"value",
							$askFormBlock.attr("data-element-link-template")
								.replace("#IBLOCK_ID#",  $itemRow.attr("data-iblock-id"))
								.replace("#ELEMENT_ID#", $itemRow.attr("data-element-id"))
							)
						.hide()
						.closest('.av-catalog-element-ask-form-wraper')
					.getFormElememt({name: $askFormBlock.attr("data-count-field-id")})
						.setFormElememtParam
							(
							"value",
							positionQuantity
								? positionQuantity+' '+$itemRow.find('.measure').text()
								: ''
							);
			});
	});