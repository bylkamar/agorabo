<!-- page start-->
<div class="col-sm-12">
    <section class="panel">
        <div class="chat-room-head">
            <h3><i class="fa fa-angle-right"></i> Gérer les Jeux</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-advance table-hover">
                <thead>
                    <tr class="tableau-entete">
                        <th><i class="fa fa-bullhorn"></i> Identifiant</th>
                        <th><i class="fa fa-bookmark"></i> Plateforme</th>
                        <th><i class="fa fa-bookmark"></i> Pegi</th>
                        <th><i class="fa fa-bookmark"></i> Genre</th>
                        <th><i class="fa fa-bookmark"></i> Marque</th>
                        <th><i class="fa fa-bookmark"></i> Nom</th>
                        <th><i class="fa fa-bookmark"></i> Prix</th>
                        <th><i class="fa fa-bookmark"></i> Date Sortie</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- formulaire pour ajouter un nouveau Jeu-->
                    <tr>
                        <form action="index.php?uc=gererJeux" method="post">
                            <td>
                                <input type="text" id="txtRefJeu" name="txtRefJeu" size="24" required minlength="1" placeholder="refJeu" title="2 Caractères maximum" />
                            </td>
                            <td>
                                <!-- <input type="number" id="txtIdPlateformeJeu" name="txtIdPlateformeJeu" size="5" required minlength="1" maxlength="2" placeholder="Id" title="Saisir un identifiant valide" /> -->
                                <select name='txtIdPlateformeJeu' id='txtIdPlateformeJeu'>

                                    <?php
                                    foreach ($tbJeux[1] as $option) {
                                        echo "<option value='" . $option->identifiant . "'>" . $option->libelle . "</option>";
                                        # code...
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select id='txtIdPegiJeu' name='txtIdPegiJeu'>
                                    <?php
                                    foreach ($tbJeux[2] as $option) {
                                        echo "<option  value='" . $option->identifiant . "'>" . $option->identifiant . "</option>";
                                        # code...
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select id='txtIdGenreJeu' name='txtIdGenreJeu'>

                                    <?php
                                    foreach ($tbJeux[3] as $option) {
                                        echo "<option value='" . $option->identifiant . "'>" . $option->libelle . "</option>";
                                        # code...
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select id='txtIdMarqueJeu' name='txtIdMarqueJeu'>

                                    <?php
                                    foreach ($tbJeux[4] as $option) {
                                        echo "<option  value='" . $option->identifiant . "'>" . $option->libelle . "</option>";
                                        # code...
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" id="txtNomJeu" name="txtNomJeu" size="20" required minlength="1" maxlength="100" placeholder="Nom" title="Saisir un identifiant valide" />
                            </td>
                            <td>
                                <input type="number" id="prixJeu" name="prixJeu" size="5" step="any" required maxlength="100" placeholder="Prix " title="Saisir un montant valide" />
                            </td>
                            <td>
                                <input type="date" id="txtDateParutionJeu" name="txtDateParutionJeu" size="5" required minlength="1" maxlength="10" placeholder="Date" title="Saisir une date valide" />
                            </td>
                            <td>
                                <button class="btn btn-primary btn-xs" type="submit" name="cmdAction" value="ajouterNouveauJeu" title="Enregistrer nouveau Jeu"><i class="fa fa-save"></i></button>
                                <button class="btn btn-info btn-xs" type="reset" title="Effacer la saisie"><i class="fa fa-eraser"></i></button>
                            </td>
                        </form>
                    </tr>

                    <?php
                    foreach ($tbJeux[0] as $Jeu) {
                    ?>
                        <tr>

                            <!-- formulaire pour modifier et supprimer les Jeux-->
                            <form action="index.php?uc=gererJeux" method="post">
                                <td><?php echo $Jeu->identifiant; ?><input type="hidden" name="txtRefJeu" value="<?php echo $Jeu->identifiant; ?>" /></td>
                                <?php
                                if ($Jeu->identifiant != $idJeuModif) {
                                    echo "<td>" . $Jeu->libPlateforme . "</td>";
                                    echo "<td>" . $Jeu->idPegi . "</td>";
                                    echo "<td>" . $Jeu->libGenre . "</td>";
                                    echo "<td>" . $Jeu->nomMarque . "</td>";
                                    echo "<td>" . $Jeu->libelle . "</td>";
                                    echo "<td>" . $Jeu->prix . "</td>";
                                    echo "<td>" . $Jeu->dateParution . "</td>";
                                ?>
                                    <td>
                                        <?php if ($notification != 'rien' && $Jeu->identifiant == $idJeuNotif) {
                                            echo '<button class="btn btn-success btn-xs"><i class="fa fa-check"></i>' . $notification . '</button>';
                                        } ?>
                                        <button class="btn btn-primary btn-xs" type="submit" name="cmdAction" value="demanderModifierJeu" title="Modifier"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-danger btn-xs" type="submit" name="cmdAction" value="supprimerJeu" title="Supprimer" onclick="return confirm('Voulez-vous vraiment supprimer ce Jeu?');"><i class="fa fa-trash-o "></i></button>
                                    </td>
                                <?php
                                } else {
                                ?>
                                    <!-- <td>
                                        <input type="number" id="txtIdPlateformeJeu" name="txtIdPlateformeJeu" size="5" required minlength="1" maxlength="1" placeholder="Id" title="Saisir un identifiant valide" value="<?php echo $Jeu->idPlateforme; ?>" />
                                    </td>
                                    <td>
                                        <input type="number" id="txtIdPegiJeu" name="txtIdPegiJeu" size="5" required minlength="1" maxlength="1" placeholder="Id" title="Saisir un identifiant valide" value="<?php echo $Jeu->idPegi; ?>" />
                                    </td>
                                    <td>
                                        <input type="number" id="txtIdGenreJeu" name="txtIdGenreJeu" size="5" required minlength="1" maxlength="1" placeholder="Id" title="Saisir un identifiant valide" value="<?php echo $Jeu->idGenre; ?>" />
                                    </td>
                                    <td>
                                        <input type="number" id="txtIdMarqueJeu" name="txtIdMarqueJeu" size="5" required minlength="1" maxlength="1" placeholder="Id" title="Saisir un identifiant valide" value="<?php echo $Jeu->idMarque; ?>" />
                                    </td>
 -->
                                    <td>
                                        <!-- <input type="number" id="txtIdPlateformeJeu" name="txtIdPlateformeJeu" size="5" required minlength="1" maxlength="2" placeholder="Id" title="Saisir un identifiant valide" /> -->
                                        <select name='txtIdPlateformeJeu' id='txtIdPlateformeJeu'>
                                            <?php
                                            foreach ($tbJeux[1] as $option) {
                                                if ($option->identifiant ==  $Jeu->idPlateforme) {
                                                    echo "<option value='" . $option->identifiant . "' selected>" . $option->libelle . "</option>";
                                                } else {
                                                    echo "<option value='" . $option->identifiant . "'>" . $option->libelle . "</option>";
                                                } # code...
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select id='txtIdPegiJeu' name='txtIdPegiJeu'>
                                            <?php
                                            foreach ($tbJeux[2] as $option) {
                                                if ($option->identifiant ==  $Jeu->idPegi) {
                                                    echo "<option value='" . $option->identifiant . "' selected>" . $option->age . "</option>";
                                                } else {
                                                    echo "<option value='" . $option->identifiant . "'>" . $option->age . "</option>";
                                                } # code...
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select id='txtIdGenreJeu' name='txtIdGenreJeu'>
                                            <?php
                                            foreach ($tbJeux[3] as $option) {
                                                if ($option->identifiant ==  $Jeu->idGenre) {
                                                    echo "<option value='" . $option->identifiant . "' selected>" . $option->libelle . "</option>";
                                                } else {
                                                    echo "<option value='" . $option->identifiant . "'>" . $option->libelle . "</option>";
                                                } # code...
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select id='txtIdMarqueJeu' name='txtIdMarqueJeu'>
                                            <?php
                                            foreach ($tbJeux[4] as $option) {
                                                echo "<option value='" . $option->identifiant . "'";
                                                if ($option->identifiant ==  $Jeu->idMarque) {
                                                    echo "selected";
                                                }
                                                echo ">" . $option->libelle . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" id="txtNomJeu" name="txtNomJeu" size="20" required minlength="0" maxlength="200" placeholder="Nom" title="Saisir un identifiant valide" value="<?php echo $Jeu->libelle; ?>" />
                                    </td>
                                    <td>
                                        <input type="number" id="prixJeu" name="prixJeu" size="5" max="100" step="any" required placeholder="Prix" title="Saisir un montant valide" value="<?php echo $Jeu->prix; ?>" />
                                    </td>
                                    <td>
                                        <input type="date" id="txtDateParutionJeu" name="txtDateParutionJeu" size="5" required minlength="1" maxlength="1" placeholder="Date" title="Saisir une date valide" value="<?php echo $Jeu->dateParution; ?>" />
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-xs" type="submit" name="cmdAction" value="validerModifierJeu" title="Enregistrer"><i class="fa fa-save"></i></button>
                                        <button class="btn btn-info btn-xs" type="reset" title="Effacer la saisie"><i class="fa fa-eraser"></i></button>
                                        <button class="btn btn-warning btn-xs" type="submit" name="cmdAction" value="annulerModifierJeu" title="Annuler"><i class="fa fa-undo"></i></button>
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
    </section><!-- fin section Jeux-->
</div><!--fin div col-sm-6-->