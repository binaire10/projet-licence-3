$(document).ready(function () {
    let form = $('#signup_form')

    let failCase = function () {
        $('body').html('<h1>Problem de connexion re tenter plus tard. Ou version non à jour du site.</h1>');
    };

    let submitForm = function () {
        let current = $(this);
        $.ajax({
            url: current.attr('action'),
            method: current.attr('method'),
            data: current.serialize()
        }).done(function (data) {
            if(data) {
                let modal = $('<div class="modal" tabindex="-1" role="dialog"/>');
                modal.append(
                    $('<div class="modal-dialog" role="document"/>').append(
                        $('<div class="modal-content"/>').append(
                            $('<div class="modal-header"/>').append(
                                $('<h5 class="modal-title">Success</h5>'),
                                $('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>')
                            ),
                            $('<div class="modal-body"/>').append(
                                $('<p>Verify your mail to validate your account</p>')
                            )
                        )
                    )
                );
                modal.on('hide.bs.modal', function () {
                    document.location = '/';
                });
                form.append(modal);
                modal.modal('show')
            }
        }).fail(failCase);
        return false;
    };

    form.submit(submitForm)
});
