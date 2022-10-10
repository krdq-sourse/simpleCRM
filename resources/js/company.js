$(document).ready(function () {
    const createCompanyForm = $('#companyFrom');
    const csrf              = $('meta[name="csrf-token"]').attr('content');
    const alertsClose       = $('.close');

    createCompanyForm.on('submit', function (event) {
        event.preventDefault();
        const METHOD = 'POST';
        const URL    = createCompanyForm.getAttribute('action');

        let headers = {
            'X-CSRF-TOKEN': csrf,
        };
        let data    = createCompanyForm.serializeFormJSON();

        ajaxRequest(METHOD, headers, URL, data, createCompanySuccess, createCompanyError);
    });

    function createCompanySuccess(response) {
        createCompanyForm[0].reset();
        const successAlert = $('#successAlert');
        if (successAlert) {
            successAlert.toggleClass('hidden');
        }
    }

    function createCompanyError(response) {
        const errorAlert = $('#errorAlert');
        if (errorAlert) {
            errorAlert.toggleClass('hidden');
        }
    }

    alertsClose.on('click', function () {
        this.toggleClass('hidden');
    });
});

