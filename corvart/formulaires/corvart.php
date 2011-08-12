<?php

// Sécurité
if (!defined('_ECRIRE_INC_VERSION')) return;


function formulaires_corvart_charger($objet, $id_objet,$id_auteur=null){
	include_spip('inc/session');
	
	$valeurs = array();

	return $valeurs;
}

function formulaires_corvart_verifier($objet, $id_objet,$id_auteur=null){
	$erreurs = array();

    //Le formulaire est il validé ?
	$lu = _request('valider_lecture');

    //Définir le compte connecté ou forcé
    if (is_null($id_auteur))
        $id_auteur = intval(session_get('id_auteur'));
    

    if ($lu != "true") {
        $erreur['valider_lecture'] = "Vous n'avez pas valider ce formulaire";
    }	

    if (!$id_auteur) {
        $erreur['id_auteur'] = "Nous n'avons pas réussi à vous identifier, veuillez vous reconnecter";
    }	

    if (count($erreurs)) {
		$erreurs['message_erreur'] = "Vous devez valider la lecture pour sauver ce formualaire";    
    }
	
	return $erreurs;
}

function formulaires_corvart_traiter($objet, $id_objet,$id_auteur=null){
	$retours = array();

    //Définir le compte connecté ou forcé
    if (is_null($id_auteur))
        $id_auteur = intval(session_get('id_auteur'));

    $lu = _request('valider_lecture');

    $res = sql_insertq(
        'spip_auteurs_liens',
        array(
            'id_auteur' => $id_auteur,
            'objet' => $objet,
            'id_objet' => $id_objet,
            'lecture' => $lu
        )
    );

    if ($res ===false) {
        $retours['message_erreur'] = "Désolé nous n'avons pu prendre en compte votre validation ou vous avez déja validé votre lecture";
    } else {
		$retours['message_ok'] = "Nous avons bien pris en compte votre lecture";
    }
    	
	return $retours;
}

?>
