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
        sendRequestFormData(form, url, method);
    }
});
