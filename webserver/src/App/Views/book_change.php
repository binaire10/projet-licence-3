<?php
$this->extend('default_page'); ?>
<?= $this->section('content') ?>
<div class="jumbotron">
    <form enctype="multipart/form-data" method="post" action="<?= base_url('/Book/change/'.$book['id']);?>" id="new_book_form">
        <input type="hidden" name="change" value="yes">
        <div class="card mt-2">
            <div class="card-header">
                <h5>Change book</h5>
            </div>
            <div class="card-body">
                <?php if(isset($message)) {
                    ?>
                    <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($message);?>
                    </div><?
                } ?>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-book"></i></div>
                    </div>
                    <input type="text" name="book_title" class="form-control" placeholder="Titre" <?php if(isset($book['titre'])) echo 'value="', htmlspecialchars($book['titre']), '" ';?>/>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-portrait"></i></div>
                    </div>
                    <div class="form-control">
                        <input type="file" accept="image/png, image/jpeg, image/jpg" name="book_image" class="preview" placeholder="Jacket" />
                        <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
                    </div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Cote</div>
                    </div>
                    <input type="text" name="book_cote" class="form-control" placeholder="Cote" <?php if(isset($book['cote'])) echo 'value="', htmlspecialchars($book['cote']), '" ';?>/>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Summarize</div>
                    </div>
                    <input type="text" name="book_summarize" class="form-control" placeholder="Résumer" <?php if(isset($book['resumer'])) echo 'value="', htmlspecialchars($book['resumer']), '" ';?>/>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Format</div>
                    </div>
                    <input type="text" name="book_format" class="form-control" placeholder="Format" <?php if(isset($book['format'])) echo 'value="', htmlspecialchars($book['format']), '" ';?>/>
                </div>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-header">
                <h5>Auteur</h5>
            </div>
            <div class="card-body mt-2">
                <button id="addAuthors" type="button" class="btn btn-primary">Ajouter un Auteur</button>
                <div class="mt-2" id="authors">
                    <?php
                    if(isset($authors)) {
                        foreach ($authors as $author) {
                            ?>
                            <div class="input-group mb-2">
                                <input type="hidden" name="authors[]" value="<?= htmlspecialchars($author['id']) ?>"/>
                                <input type="text" disabled="disabled" class="form-control" value="<?= htmlspecialchars($author['nom']) ?>">
                                <div class="input-group-append">
                                    <button class="close btn btn-light form-control">&times;</button>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-header">
                <h5>Exemplaire</h5>
            </div>
            <div class="card-body mt-2">
                <button class="btn btn-primary" id="addExemplaire" href="#">Ajouter un Exemplaire</button>
                <div class="mt-2" id="exemplaire">

                    <?php
                    if(isset($exemplaires)) {
                        foreach ($exemplaires as $exemplaire) {
                            ?>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="form-control">id</span>
                                </div>
                                <input type="number" disabled="disabled" value="<?= htmlspecialchars($exemplaire['id']) ?>"/>
                                <div class="input-group-prepend ml-2">
                                    <span class="form-control">date achat</span>
                                </div>
                                <input type="date" disabled="disabled" class="form-control" value="<?= htmlspecialchars($exemplaire['date_achat']) ?>">
                                <div class="input-group-append">
                                    <button class="close btn btn-light form-control">&times;</button>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <input type="submit"/>
    </form>
</div>
<div id="authors_form" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter Auteur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="exemplaire_form" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Author</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script type="text/javascript">
    $(document).ready(function () {
        let failCase = function () {
            $('body').html('<h1>Problem de connexion re tenter plus tard. Ou version non à jour du site.</h1>');
        };

        $("input.preview[type='file']").each(function () {
            let self = $(this);
            let img;
            self.parent().append(
                img = $('<div><img  class="thumbnail" style="width: 200px; height: 200px;"/></div>')
            );
            img = img.find('img');

            let selectImage = function(e) {
                img.attr('src', e.target.result);
            };

            self.change(function () {
                var file = this.files[0];
                var match = ["image/jpeg", "image/png", "image/jpg"];

                if ((file.type === match[0]) || (file.type === match[1]) || (file.type === match[2])) {
                    var reader = new FileReader();
                    reader.onload = selectImage;
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });

        let removeAuthor = function (e) {
            e.preventDefault();
            $(this).parent().parent().remove();
            return false;
        };

        $('#exemplaire').find('button').click(function (e) {
            e.preventDefault();
            let self = $(this);
            self.parent().parent().find('input[type="number"]').attr('name', 'remove[]').appendTo($('#exemplaire')).attr('type', 'hidden').removeAttr('disable');
            self.parent().parent().remove();
        })

        $('#authors').find('button.close').click(removeAuthor);

        let modalAuthors = $('#authors_form');
        let modalExemplaire = $('#exemplaire_form');

        $('#addAuthors').click(function (e) {
            e.preventDefault();
            let body = modalAuthors.find('div.modal-body');
            $.ajax({
                url: '<?= base_url('Author/get') ?>/0/10',
                headers: {'X-Requested-With': 'XMLHttpRequest'}
            }).done(function (reponse) {
                if(!reponse || !reponse.ok) {
                    body.html('<pre>'+reponse.message+'</pre>');
                }
                else {
                    const item_on_page = 10;
                    body.html('');
                    let result = $('<div/>');
                    let fillItem = function(items) {
                        result.html('');
                        for (let value in items){
                            let hitem = $('<input type="hidden" name="authors[]" value="'+items[value].id+'"/>')
                            let item = $('<input disabled="disabled" class="form-control" value="'+items[value].nom+'"/>')
                            let action = $('<button class="btn btn-light form-control">&check;</button>')
                            let group = $('<div class="input-group mb-2"/>');
                            result.append(group.append(hitem, item, $('<div class="input-group-append"/>').append(action)));
                            let authors = $('#authors');
                            action.click(function (e) {
                                e.preventDefault();
                                if(authors.find('input[type="hidden"][name="authors[]"][value="'+items[value].id+'"]').length !== 0)
                                    return;
                                action.unbind('click');
                                action.click(removeAuthor);
                                action.html('&times;');
                                action.addClass('close');
                                group.appendTo(authors);
                            });
                        }
                    };

                    let setPage = function(e) {
                        e.preventDefault();
                        let self = $(this);
                        $.ajax({
                            url: self.attr('href'),
                            headers: {'X-Requested-With': 'XMLHttpRequest'}
                        }).done(function (ask) {
                            fillItem(ask.result);
                        }).fail(failCase);
                    };
                    let pagination = $('<ul class="pagination"/>');
                    let pageCount = Math.ceil(Math.min(reponse.count / item_on_page, 5));
                    fillItem(reponse.result);
                    for (let i = 0; i < pageCount; ++i) {
                        let item = $('<li class="page-item"/>');
                        let link = $('<a href="<?= base_url('Author/get') ?>/' + i*item_on_page + '/10"  class="page-link">'+i+'</a>');
                        link.click(setPage);
                        item.append(link);
                        pagination.append(item);
                    }
                    body.append(result);
                    body.append($('<nav aria-label="navigation authors page"/>').append(pagination));
                }
                modalAuthors.modal('show');
            }).fail(failCase);
        });

        $('#addExemplaire').click(function (e) {
            e.preventDefault();
            let body = modalExemplaire.find('div.modal-body');
            body.html('');
            let idInput = $('<div class="input-group mb-2">' +
                '<div class="input-group-prepend"><span class="form-control">id</span></div>' +
                '<input type="number" name="exemplaires_id[]" class="form-control"/>' +
                '<div class="input-group-prepend ml-2"><span class="form-control">date achat</span></div>' +
                '<input type="date" name="exemplaires_date_achat[]" class="form-control"/>' +
                '<div class="input-group-append">' +
                '<button class="btn btn-light form-control">&check;</button>' +
                '</div>' +
                '</div>');
            body.append(idInput);
            modalExemplaire.modal('show');
            let button = idInput.find('button');
            button.click(function (e) {
                e.preventDefault();
                idInput.appendTo($('#exemplaire'));
                button.addClass('close');
                button.unbind('click');
                button.html('&times;')
                modalExemplaire.modal('hide');
                button.click(function () {
                    idInput.remove();
                });
            });
        });
    });
</script>
<?= $this->endSection() ?>
