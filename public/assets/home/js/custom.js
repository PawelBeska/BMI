$(document).on('click', 'a', function (e) {
    let container = !!$(this).data('container');
    if ($(this).data('redirect')) {
        e.preventDefault();
        NProgress.start();
        if ($(this).data('clear-menu')) {
            $('a.nav-link').not('.collapsed').addClass('collapsed');
            $('.collapse.show').removeClass('show');
        }
        if (!$(this).data('api-call')) changeUrl($(this).attr('href'), container);
        if ($(this).data('api-call')) {
            let element = $(this);
            $.ajax({
                url: $(this).attr('href'),
                type: 'GET',
                cache: false,
                success: function (data) {
                    errors(data, $('#form-errors'))
                    if (element.data('datatable-reload')) window.datatable.ajax.reload();

                }
            });
            NProgress.done();
        }
        if ($(this).data('reload')) {
            document.location.reload(true);
        }
    }
});
refreshMenu();

jQuery(document).ready(function ($) {

    if (window.history && window.history.pushState) {

        // window.history.pushState('forward', null, '/partner');
        window.onpopstate = function (e) {
            $('div#content').html(e.state.content);
            refreshMenu();
        };

    }
});

function refreshMenu() {
    $('.nav-item').removeClass('active');
    $('a.nav-link').each(function () {
        if ($(this).attr('href') === window.location.href) {
            $(this).parent().addClass('active');
        }
    });
}


$(document).on({
    ajaxStart: function (e) {
        NProgress.start();
    },

    ajaxStop: function () {
        NProgress.done();
    }
});


function changeUrl(url, container) {
    $.ajax({
        url: url,
        type: 'GET',
        data: null,
        cache: false,
        success: function (data) {
            if (container) {
                $('body').html(data);

            } else {
                $('div#content').html(data);
            }

            // window.history.pushState({"prevUrl": location.href,'url':url}, "", url);

            // if (typeof (history.pushState) != "undefined") {
            //     let obj = {Page: window.location.pathname, Url: url};
            //     history.pushState(obj, obj.Page, obj.Url);
            // } else {
            //     window.location.href = url;
            // }
            if ("undefined" !== typeof history.pushState) {
                history.pushState({page: window.location.pathname, url: location.href, content: data}, '', url);
            } else {
                window.location.assign(url);
            }
            NProgress.done();
            refreshMenu();
        }
    });
}


$(document).on('submit', 'form#ajax', function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    let form = $(this);

    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        global: false,
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData(form[0]),
        success: function (data) {
            if (form.attr('data-login')) {
                if (data.access_token) {
                    localStorage.setItem("access_token", data.access_token);


                }
                location.reload();
            } else {

                if (form.attr('datatable-reload')) {
                    window.datatable.ajax.reload();
                }

                if (form.data('success')) errors({'success': form.data('success')}, $("#" + form.data('alert')))
                else errors(data, $("#" + form.data('alert')));
                if (form.data('disable')) $("input[type='submit']").attr("disabled", true);

                if (!form.attr('data-left-data')) {
                    $(':input', form)
                        .not(':button, :submit, :reset, :hidden')
                        .val('')
                        .prop('checked', false)
                        .prop('selected', false);


                }
                form.parents('.update').hide();
            }
        },
        error: function (data) {
            form.data('error') ? errors({'error': form.data('error')}, $("#" + form.data('alert'))) : errors(data, $("#" + form.data('alert')));
        }
    });
});


$(document).on('click', 'a.view', function (e) {
    e.preventDefault();
    changeUrl(location.origin + $(this).attr('href'), false);
});

function errors(data, selector) {
    selector.empty();
    selector.show();
    $('.invalid-feedback').remove();
    $('.form-error').removeClass('form-error');
    const error = ({alert, message}) => `                   <div class="alert ${alert}" role="alert">
 ${message}
</div>`;


    if (data.code === 200) {
        console.log(1)
        selector.prepend(error({'alert': 'alert-success', 'message': data.data}));
    }
    if (data.responseJSON.error !== undefined) {
        console.log(data.responseJSON.error);
        selector.prepend(error({'alert': 'alert-danger', 'message': data.responseJSON.error}));
        toastr.error(data.responseJSON.error)
    } else if (data.responseJSON['success']) {
        selector.prepend(error({'alert': 'alert-success', 'message': data['success']}));
        toastr.success(data.responseJSON['success'])
    } else {
        var l = JSON.parse(data.responseText);
        var i = 0;
        console.log(l);
        //if (l['message']) selector.prepend(error({'alert': 'alert-danger', 'message': l['message']}));
        $.each(l['errors'], function (heading, text) {
            i++;
            //selector.prepend(error({'alert': 'alert-danger', 'message': text}));

            $('#' + heading).addClass('form-error');
            $('#' + heading).parent().append(`<span class="invalid-feedback" style="display: block" role="alert"><strong> ${text}  </strong> </span>`);
        });
    }
}

$(document).on('click', '.btn-close', function () {
    $(this).parents('.update').hide();
});


$(document).on('click', '.btn-show', function () {
    $('.' + $(this).data('show')).show();
    $('.' + $(this).data('hide')).hide();
});
$(document).on('click', '.btn-hide', function () {
    $('.' + $(this).data('show')).show();
    $('.' + $(this).data('hide')).hide();
});
$(document).on('click', 'button.btn-edit', function () {
    $('div.update').show();
});
$(document).on('click', 'a.remove', function (e) {
    e.preventDefault();
    $.ajax({
        url: location.origin + $(this).attr('href'),
        type: 'DELETE',
        data: {'_token': $('meta[name="csrf-token"]').attr('content')},
        success: function (data) {
            errors(data, $('#form-errors'));
            window.datatable.ajax.reload();
        },
        error: function (data) {
            errors(data, $('#form-errors'));
        }
    });
});

$(document).on('submit', 'form.show-update', function (e) {
    e.preventDefault();
    $.ajax({
        url: $(this).attr('action'),
        type: 'PUT',
        global: false,
        cache: false,
        data: $(this).serialize(),
        success: function (data) {
            errors(data, $('#form-errors'));
            $("form.update select option").each(function ($ez) {
                $(this).removeAttr('selected')
            });
        },
        error: function (data) {
            errors(data, $('#form-errors'));
        }
    });
});
