$(document).ready(function () {
    const createCompanyForm = $('#companyFrom');
    const editCompanyForm   = $('#companyFromEdit');
    const csrf              = $('meta[name="csrf-token"]').attr('content');
    const alertsClose       = $('.close');

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

    editCompanyForm.on('submit', function (event) {
        event.preventDefault();
        const METHOD = 'PUT';
        const URL    = $(this).attr('action');

        let headers = {
            'X-CSRF-TOKEN': csrf,
        };
        let data    = $(this).serializeArray().reduce(function (obj, item) {
            obj[item.name] = item.value;
            return obj;
        }, {});

        ajaxRequest(METHOD, headers, URL, data, editCompanySuccess, createCompanyError);
    });

    function createCompanySuccess(response) {
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

    function editCompanySuccess(response) {
        location.href = location.href;
    }

    alertsClose.on('click', function () {
        $(this).parent().toggleClass('hidden');
    });
});

