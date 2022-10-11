$(document).ready(function () {
    const createCompanyForm = $('#companyFrom');
    const editCompanyForm   = $('#companyFromEdit');
    const csrf              = $('meta[name="csrf-token"]').attr('content');
    const alertsClose       = $('.close');
    const deleteBnt         = $('.btn-delete');

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

        ajaxRequest(METHOD, headers, URL, data, createSuccess, createError);
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

        ajaxRequest(METHOD, headers, URL, data, createSuccess, createError);
    });

    function createSuccess(response) {
        if (response.success) {
            const successAlert = $('#successAlert');
            if (successAlert) {
                successAlert.toggleClass('hidden');
            }
        } else {
            createError(response);
        }
    }

    function createError(response) {
        const errorAlert = $('#errorAlert');
        if (errorAlert) {
            errorAlert.toggleClass('hidden');
        }
    }


    alertsClose.on('click', function () {
        $(this).parent().toggleClass('hidden');
    });

    deleteBnt.on('click', function () {
        const METHOD = 'DELETE';
        const URL    = $(this).attr('data-action');
        let data     = {};
        let headers  = {
            'X-CSRF-TOKEN': csrf,
        };

        ajaxRequest(
            METHOD,
            headers,
            URL,
            data,
            function (response) {
                if (response.success) {
                    location.href = location.href
                } else {
                    somethingWentWrong(response)
                }
            },
            somethingWentWrong
        )
    })

    function somethingWentWrong(response) {
        alert('something went wrong -_-');

    }
});

