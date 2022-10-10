function postRequest(data, csrf, url, success, error)
{
    $.ajax({
        type   : "POST",
        headers: {
            'X-CSRF-TOKEN': csrf,
        },
        url    : url,
        data   : data,
        success: function (response) {
            success(response);
        },
        error  : function (response) {
            error(response);
        }
    });
}
