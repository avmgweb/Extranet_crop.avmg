BX.namespace("BX.Bitrix24.SystemAuthForm");

BX.Bitrix24.SystemAuthForm =
{
	licenseHandler : function(params)
	{
		if (typeof params !== "object")
			return;

		var url = params.COUNTER_URL || "",
			licensePath = params.LICENSE_PATH || "",
			host = params.HOST || "";

		BX.ajax.post(
			url,
			{
				action: "upgradeButton",
				host: host
			},
			BX.proxy(function(){
				document.location.href = licensePath;
			}, this)
		);
	}
};