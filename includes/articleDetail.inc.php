<?php

if (isset($_GET['id_article'])) {
    $id_article= $_GET['id_article'];
    $resultatArticle = new Article();
    echo $resultatArticle->affichArticle($id_article);}

