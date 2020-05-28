<?php

$this->extend('default_page'); ?>
<?= $this->section('content') ?>

<?php
    if(count($results) == 0) {
        echo "Il n'y a aucun utilisateur à promouvoir";
    }
    else {
        echo "<table class=\"table table-striped table-bordered\">
                  <thead>
                    <tr>
                      <th scope=\"col\">Id</th>
                      <th scope=\"col\">Utilisateur</th>
                      <th scope=\"col\">Actions</th>
                    </tr>
                  </thead>";

        echo "<tbody>";

        foreach($results as $ligne){
            $className = "form" . $ligne['id'];
            $urlValidation = base_url('Adherents/validateAdherents');
            echo
                "<tr>
                      <th scope='row'>$ligne[id]</th>
                      <td>$ligne[identifiant]</td>
                      <td>
                        <form method=\"post\" action=$urlValidation class=\"form-inline\" class=$className>
                          <div class=\"form-group mb-2\">
                            <label for=\"staticEmail2\" class=\"sr-only\">Address ?</label>
                            <input type=\"text\" readonly class=\"form-control-plaintext\" id=\"staticEmail2\" value=\"Address ?\">
                          </div>
                          <div class=\"form-group mx-sm-3 mb-2\">
                            <label for=\"inputAdress\" class=\"sr-only\">Adress</label>
                            <input type=\"text\" class=\"form-control\" id=\"inputAdress\" placeholder=\"Adress\">
                          </div>
                          <button type=\"submit\" class=\"btn btn-primary mb-2\">Confirm Adherent</button>
                        </form>
                      </td>
                </tr>";

        }

        echo "</tbody>";
        echo "</table>";
    }
?>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?= $this->endSection() ?>