<!-- page start-->
<div class="col-sm-12">
    <section class="panel">
        <div class="chat-room-head">
            <h3><i class="fa fa-angle-right"></i> Gérer les Pegis</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-advance table-hover">
                <thead>
                    <tr class="tableau-entete">
                        <th><i class="fa fa-bullhorn"></i> Identifiant</th>
                        <th><i class="fa fa-bookmark"></i> Age</th>
                        <th><i class="fa fa-bookmark"></i> Description</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- formulaire pour ajouter un nouveau Pegi-->
                    <tr>
                        <form action="index.php?uc=gererPegis" method="post">
                            <td>Nouveau</td>
                            <td>
                                <input type="number" id="txtAgePegi" name="txtAgePegi" size="24" required minlength="1" maxlength="2" placeholder="Age" title="2 Caractères maximum" />
                            </td>
                            <td>
                                <input type="text" id="txtDescriptionPegi" name="txtDescriptionPegi" size="24" required minlength="4" maxlength="24" placeholder="Description" title="De 4 à 24 caractères" />
                            </td>
                            <td>
                                <button class="btn btn-primary btn-xs" type="submit" name="cmdAction" value="ajouterNouveauPegi" title="Enregistrer nouveau Pegi"><i class="fa fa-save"></i></button>
                                <button class="btn btn-info btn-xs" type="reset" title="Effacer la saisie"><i class="fa fa-eraser"></i></button>
                            </td>
                        </form>
                    </tr>

                    <?php
                    foreach ($tbPegis as $Pegi) {
                    ?>
                        <tr>

                            <!-- formulaire pour modifier et supprimer les Pegis-->
                            <form action="index.php?uc=gererPegis" method="post">
                                <td><?php echo $Pegi->identifiant; ?><input type="hidden" name="txtIdPegi" value="<?php echo $Pegi->identifiant; ?>" /></td>
                                <?php
                                if ($Pegi->identifiant != $idPegiModif) {
                                    echo "<td>" . $Pegi->age . "</td>";
                                    echo "<td>" . $Pegi->description . "</td>";
                                ?>
                                    <td>
                                        <?php if ($notification != 'rien' && $Pegi->identifiant == $idPegiNotif) {
                                            echo '<button class="btn btn-success btn-xs"><i class="fa fa-check"></i>' . $notification . '</button>';
                                        } ?>
                                        <button class="btn btn-primary btn-xs" type="submit" name="cmdAction" value="demanderModifierPegi" title="Modifier"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-danger btn-xs" type="submit" name="cmdAction" value="supprimerPegi" title="Supprimer" onclick="return confirm('Voulez-vous vraiment supprimer ce Pegi?');"><i class="fa fa-trash-o "></i></button>
                                    </td>
                                <?php
                                } else {
                                ?>
                                    <td>
                                        <input type="number" id="txtAgePegi" name="txtAgePegi" size="24" required minlength="4" maxlength="24" value="<?php echo $Pegi->age; ?>" />
                                    </td>
                                    <td>
                                        <input type="text" id="txtDescriptionPegi" name="txtDescriptionPegi" size="24" required minlength="4" maxlength="24" value="<?php echo $Pegi->description; ?>" />
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-xs" type="submit" name="cmdAction" value="validerModifierPegi" title="Enregistrer"><i class="fa fa-save"></i></button>
                                        <button class="btn btn-info btn-xs" type="reset" title="Effacer la saisie"><i class="fa fa-eraser"></i></button>
                                        <button class="btn btn-warning btn-xs" type="submit" name="cmdAction" value="annulerModifierPegi" title="Annuler"><i class="fa fa-undo"></i></button>
                                    </td>
                                <?php
                                }
                                ?>
                            </form>

                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

        </div><!-- fin div panel-body-->
    </section><!-- fin section Pegis-->
</div><!--fin div col-sm-6-->