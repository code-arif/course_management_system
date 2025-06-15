    window.successToast = function (msg) {
        Toastify({
            gravity: "top",
            position: "right",
            text: msg,
            className: "mb-5",
            style: {
                background: "green",
            }
        }).showToast();
    };

    window.errorToast = function (msg) {
        Toastify({
            gravity: "top",
            position: "right",
            text: msg,
            className: "mb-5",
            style: {
                background: "red",
            }
        }).showToast();
    };
