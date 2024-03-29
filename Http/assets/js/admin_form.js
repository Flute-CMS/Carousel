function serializeFormCarousel($form) {

    let formData = new FormData($form[0]);
    let additionalParams = {};

    // Append additional parameters to FormData
    for (let key in additionalParams) {
        if (additionalParams.hasOwnProperty(key)) {
            formData.append(key, additionalParams[key]);
        }
    }

    return formData;
}

function sendCarouselRequest(data, path = null, method = 'POST') {
    let result = null;

    $.ajax({
        url: u(path),
        type: method,
        data: data,
        processData: false,
        async: false,
        success: function (response) {
            toast({
                message: response?.success || translate('def.success'),
                type: 'success',
            });

            result = response;

            Modals.clear();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('error request', jqXHR, textStatus, errorThrown);
            toast({
                message:
                    jqXHR.responseJSON?.error ?? translate('def.unknown_error'),
                type: 'error',
            });

            result = jqXHR.responseJSON;
        },
    });

    return result;
}

$(document).on('submit', '[data-carouselform]', (ev) => {
    let $form = $(ev.currentTarget);

    ev.preventDefault();

    let path = $form.data('carouselform'),
        form = serializeFormCarousel($form),
        page = $form.data('page'),
        id = $form.data('id');

    let url = `admin/api/${page}/${path}`,
        method = 'POST';

    if (path === 'edit') {
        url = `admin/api/${page}/${id}`;
    }

    if (ev.target.checkValidity()) {
        sendCarouselRequest(form, url, method);
    }
});
