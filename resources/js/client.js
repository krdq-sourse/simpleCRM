$(document).ready(function () {
    const createUserForm   = $('#userFrom');
    const csrf             = $('meta[name="csrf-token"]').attr('content');
    const alertsClose      = $('.close');

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

    function createSuccess(response) {
        const successAlert = $('#successAlert');
        if (successAlert) {
            successAlert.toggleClass('hidden');
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
});
