$(document).ready(function () {
    const createUserForm = $('#userFrom');
    const csrf           = $('meta[name="csrf-token"]').attr('content');
    const editUserForm   = $('#userFromEdit');

    createUserForm.on('submit', function (event) {
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

    editUserForm.on('submit', function (event) {
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
});
