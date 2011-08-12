<?php

function corvart_declarer_tables_interfaces($interface){
    // -- Boucle -- //
	$interface['table_des_tables']['auteurs_liens'] = 'auteurs_liens';

	// -- Liaisons -- //
	$interface['tables_jointures']['spip_auteurs'][]= 'auteurs_liens';
	$interface['tables_jointures']['spip_articles'][]= 'articles';

    // -- Alias --- //
    $interface['exceptions_des_tables']['articles']['lecture'] = array('spip_auteurs_liens', 'lecture');
	return $interface;
}

function corvart_declarer_tables_auxiliaires($tables_auxiliaires){
    //Gérer une table de jointure entre les auteurs et les articles
    //-- Table auteurs_liens -------------------------------------
    $auteurs_liens = array(
        "id_auteur" => "BIGINT(21) NOT NULL",
        "id_objet"   	=> "BIGINT(21) NOT NULL",
        "objet"     	=> "VARCHAR(25) NOT NULL",
        "lecture"     	=> "VARCHAR(255) NOT NULL",
    );
    $auteurs_liens_key = array(
        "PRIMARY KEY"    => "id_auteur, id_objet, objet,lecture",
		"KEY id_auteur" => "id_auteur"
    );

	$tables_auxiliaires['spip_auteurs_liens'] =
		array('field' => &$auteurs_liens, 'key' => &$auteurs_liens_key);

    return $tables_auxiliaires;
}

?>
