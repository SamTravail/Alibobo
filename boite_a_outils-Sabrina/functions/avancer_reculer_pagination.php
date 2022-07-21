
<?php 
function pagination($page,$itemPerpage,$count)
{
    // on crée un liste en html
    $html = '';
    $html .= '<ul class="paginate">';
    // pour revenir sur les pages précedentes
    if($page > 1) {
        $paged = $page - 1;
        $html .= '<li><a href="index.php?page='.$paged.'">Précédent</a></li>';
    }
    // pour avancer dans les pages
    if($page * $itemPerpage < $count) {
        $paged = $page + 1;
        $html .= '<li><a href="index.php?page='.$paged.'">Suivant</a></li>';
    }
    $html .= '</ul>';
    return $html;
}