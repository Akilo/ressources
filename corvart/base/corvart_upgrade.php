<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/meta');
include_spip('base/create');

function corvart_upgrade($nom_meta_base_version,$version_cible){
	$current_version = "0.0.0";
	if (isset($GLOBALS['meta'][$nom_meta_base_version]))
		$current_version = $GLOBALS['meta'][$nom_meta_base_version];
		
	if ($current_version=="0.0.0") {
		include_spip('base/corvart');
		creer_base();
		ecrire_meta($nom_meta_base_version,$current_version=$version_cible);
	}

	ecrire_metas();
}

function corvart_vider_tables($nom_meta_base_version) {
	sql_drop_table("spip_auteurs_liens");
	effacer_meta($nom_meta_base_version);
	ecrire_metas();
}

?>
