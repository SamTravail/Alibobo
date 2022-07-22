<div>
    <label for="categorie">Catégorie :</label>
    <input type="text" id="categorie" name="categorie" value="<?=$categorie?>" />
</div>
<div>
    <label for="reference">Référence :</label>
    <input type="text" id="reference" name="reference" value="<?=$reference?>" />
</div>
<div>
    <label for="designation">Désignation :</label>
    <input type="text" id="designation" name="designation" />
</div>
<div>
    <label for="puht">Prix unitaire HT :</label>
    <input type="text" id="puht" name="puht" />
</div>
<div>
    <label for="puht">Taux de TVA :</label>
    <input type="select" id="puht" name="puht" />
</div>
<div>
    <label for="puht">Masse :</label>
    <input type="text" id="puht" name="puht" />
</div>
<div>
    <label for="puht">Quantité en stock :</label>
    <input type="text" id="puht" name="puht" />
</div>
<div>
    <label for="puht">Stock de sécurité :</label>
    <input type="text" id="puht" name="puht" />
</div>
<div>
    <input type="checkbox" name="cgu" id="cgu" value="1"<?=isset($_POST['cgu'])?"checked":'';?> /><label for="cgu" >J'accepte les <a href="index.php?page=cgu" target="_blank">Conditions Générales d'Utilisation</a></label>
</div>
<div>
    <input type="reset" value="Effacer" />
    <input type="submit" value="Envoyer" />
</div>
<input type="hidden" name="frmInscription" />
</form>