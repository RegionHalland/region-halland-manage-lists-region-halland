<?php

	/**
	 * @package Region Halland Manage Lists Region Halland
	 */
	/*
	Plugin Name: Region Halland Manage Lists Region Halland
	Description: Back-end-plugin som hanterar värden i listor
	Version: 1.0.0
	Author: Roland Hydén
	License: MIT
	Text Domain: regionhalland
	*/

  // Wordpress egna filter för kolumnhantering
  add_filter ('manage_blurbs_posts_columns', 'add_region_halland_manage_lists_region_halland_blurbs_acf_columns' );
  
  // Lägg till kolumner som ska hämtas ut
  function add_region_halland_manage_lists_region_halland_blurbs_acf_columns($columns) {
      return array_merge ($columns, array ( 
        'myBlurbsImageMeta' => __ ( 'Vikt i kb (under 100 kb = ok)' ),
        'myBlurbsImage' => __ ( 'Bild' )
        ) 
    );
  }

  // Wordpress egna filter för innehåll i kolumnhantering
  add_action ('manage_blurbs_posts_custom_column', 'region_halland_manage_lists_region_halland_blurbs_custom_column', 10, 2 );

  // Lägg till innehåll i kolumner som ska hämtas ut
  function region_halland_manage_lists_region_halland_blurbs_custom_column($column, $post_id) {
      
      // Förbered bilddata    
      $imageUrl = get_the_post_thumbnail_url($post_id);
      $imageID = get_post_thumbnail_id($post_id);
      $imagePath = get_attached_file($imageID); 
      $imageFileSize = ceil(filesize($imagePath)/1000);
      if ($imageFileSize < 100) {
        $imageType = 1;
        $imageText = "<div style='background-color:#00b300;height:40px;color:white;font-size:22px;padding-top:15px;text-align:center;'>".$imageFileSize."</div>";
      } elseif ($imageFileSize > 100 && $imageFileSize < 200) {
        $imageType = 2;
        $imageText = "<div style='background-color:#ff6600;height:40px;color:white;font-size:22px;padding-top:15px;text-align:center;'>".$imageFileSize."</div>";
      } else {
        $imageType = 3;
        $imageText = "<div style='background-color:#ff1a1a;height:40px;color:white;font-size:22px;padding-top:15px;text-align:center;'>".$imageFileSize."</div>";
      }

      // Switcha beroende på kolumn
      switch ($column) {
        case 'myBlurbsImageMeta':
            echo $imageText;
            break;
        case 'myBlurbsImage':
            echo "<img src=".$imageUrl." width=120>";
            break;
      }
  }

	// Metod som anropas när pluginen aktiveras
	function region_halland_manage_lists_region_halland_activate() {
		// Nothing at the moment
	}

	// Metod som anropas när pluginen avaktiveras
	function region_halland_manage_lists_region_halland_deactivate() {
		// Nothing at the moment
	}
	
	// Vilken metod som ska anropas när pluginen aktiveras
	register_activation_hook( __FILE__, 'region_halland_manage_lists_region_halland_activate');

	// Vilken metod som ska anropas när pluginen avaktiveras
	register_deactivation_hook( __FILE__, 'region_halland_manage_lists_region_halland_deactivate');

?>