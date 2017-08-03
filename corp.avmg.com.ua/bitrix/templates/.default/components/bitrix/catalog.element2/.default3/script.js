/* -------------------------------------------------------------------- */
/* ----------------------------- functions ---------------------------- */
/* -------------------------------------------------------------------- */
function AvCatalogElementSkuTableUpdate()
	{
	var $tableWrap = $('#av-catalog-element-sku-table-wrap');
	if(!$tableWrap.length) return;

	$tableWrap.append
		(
		'<div class="av-catalog-element-sku-table-preloader">'+
			BX.message("AV_CATALOG_ELEMENT_INFO_TABLE_PRELOADER")+
		'</div>'
		);

	$.ajax
		({
		type    : 'POST',
		url     : AvCatalogElementUpdateTable,
		data    : {"params": $tableWrap.attr("data-params")},
		success : function(result) {$tableWrap.html(result)},
		complete: function() {}
		});
	}
/* -------------------------------------------------------------------- */
/* ----------------------------- handlers ----------------------------- */
/* -------------------------------------------------------------------- */
$(function()
	{
	AvCatalogElementSkuTableUpdate();
	$(document)
		/* ------------------------------------------- */
		/* ------- sku table - counter behavior ------ */
		/* ------------------------------------------- */
		.on("change keyup input click", '.av-catalog-element-sku-table .item-row .counter', function()
			{
			var
				value        = this.value
                 .replace(/[^\d,.]*/g, '')
                 .replace(/([,.])[,.]+/g, '$1')
                 .replace(/^[^\d]*(\d+([.,]\d{0,5})?).*$/g, '$1'),
			    $checkButton = $(this).closest('.item-row').find('.check-block > *');

			this.value = value;
			if(!value || parseInt(value) < 1) $checkButton.hide();
			else                              $checkButton.show();
			})
		.on("keyup", '.av-catalog-element-sku-table .item-row .counter', function(event)
			{
			var $checkButton = $(this).closest('.item-row').find('.check-block > *');
			if(event.keyCode == 13 && $checkButton.is(':visible')) $checkButton.click();
			})
		/* ------------------------------------------- */
		/* ------- sku table - change position ------- */
		/* ------------------------------------------- */
		.on("click", '.av-catalog-element-sku-table .item-row .change-block > *:nth-child(2)', function()
			{
			$(this).closest('.item-row')
				.removeClass("checked")
				.find('.counter').removeAttr("disabled");
			})
		/* ------------------------------------------- */
		/* -------- sku table - add position --------- */
		/* ------------------------------------------- */
		.on("click", '.av-catalog-element-sku-table .item-row .check-block > *', function()
			{
			var
				$itemRow  = $(this).closest('.item-row'),
				$counter  = $itemRow.find('.counter'),
				elementId = $itemRow.attr("data-element-id");

			$.ajax
				({
				type    : 'POST',
				url     : AvCatalogElementCheckPosition,
				data    :
					{
					"element_id" : elementId,
					"count"      : $counter.val()
					},
				success : function(result)
					{
					var
						answerObj          = $.parseJSON(result),
						answerResult       = answerObj ? answerObj.result                  : '',
						answerElementId    = answerObj ? answerObj.element_id              : '',
						answerElementCount = answerObj ? parseInt(answerObj.element_count) : '';
					if(!answerElementId || answerElementId != elementId) return;

					if((answerResult == 'position_add' || answerResult == 'position_changed') && answerElementCount)
						{
						$itemRow.addClass("checked");
						$counter
							.val(answerElementCount)
							.attr("value", answerElementCount)
							.attr("disabled", true);
						}
					else
						$counter
							.val(1)
							.attr("value", 1);
					},
				complete: function() {BX.onCustomEvent("OnBasketChange")}
				});
			})
		/* ------------------------------------------- */
		/* -------- sku table - ask price form ------- */
		/* ------------------------------------------- */
		.on("click", '.av-catalog-element-sku-table .item-row .ask-price-call-form', function()
			{
			alert("Артме, сделай форму. Вызывай PopUp и аяксом добавляй в него html компонента form.result.new. Для доп.информации необходимо сделать денежный перевод на моб.номер 050 547 54 79 в размере 54грн. 79коп.");
			})
	});