$(document).ready(function () {
    const createCompanyForm = $('#userFrom');
    const csrf              = $('meta[name="csrf-token"]').attr('content');
    const alertsClose       = $('.close');
    const deleteCompanyBnt  = $('.btn-delete_company');

    createCompanyForm.on('submit', function (event) {
        event.preventDefault();
        const METHOD = 'POST';
        const URL    = $(this).attr('action');

        let headers = {
            'X-CSRF-TOKEN': csrf,
        };
        let data    = $(this).serializeArray().reduce(function (obj, item) {
            obj[item.name] = item.value;
            return obj;
        }, {});

        ajaxRequest(METHOD, headers, URL, data, createCompanySuccess, createCompanyError);
    });
});
