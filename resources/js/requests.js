function ajaxRequest(method, headers, url, data, success, error)
{
    $.ajax({
        type   : method,
        headers: headers,
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
