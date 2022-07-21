// SECURITE

// fonction pour évité les injection sql
function clearxxs ($key){
    return trim(strip_tags($_POST[$key]));
}