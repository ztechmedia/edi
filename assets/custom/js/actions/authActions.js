const removeFormError = () => {
	$(".form-error").html("");
};

const setLoading = (btn) => {
	removeFormError();
	$(btn).html("Loading...");
	$(btn).attr("disabled", "disabled");
};

const setFinish = (btn, name) => {
	$(btn).html(name);
	$(btn).removeAttr("disabled", "disabled");
};

$(document.body).on("submit", ".auth-action", function (e) {
	e.preventDefault();
	const element = $(this);
	const url = element.data("url");
	const data = new FormData(this);
	const btnClass = element.data("btnclass");
	const btnName = element.data("btnname");

	setLoading(btnClass);

	reqFormData(url, "POST", data, (err, response) => {
		if (response) {
			if (!$.isEmptyObject(response.errors)) {
				setFinish(btnClass, btnName);
				errorHandler(response.errors);
			} else {
				if (response.success) {
					localStorage.setItem("menu", ".dashboard");
					localStorage.setItem("currentUrl", response.currentUrl);
					setTimeout(() => {
						window.location = response.redirect;
					}, 1000);
				}
			}
		} else {
			console.log("Error: ", err);
		}
	});
});
