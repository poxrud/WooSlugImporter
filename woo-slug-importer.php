<?php
  /*
  Plugin Name: WooCommerce Add Slug to Product Importer
  Description: Adds a "Slug" field to the WooCommerce Product Importer. Make sure that in your CSV file you also have a "Slug" Column.
  Version: 1.0.0
  Author: Phil Oxurd
  Author URI: https://www.twitter.com/poxrud
  License: GPL2

  WooCommerce Add Slug to Product Importer is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 2 of the License, or
  any later version.
   
  Business Schema JSON-LD is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  GNU General Public License for more details.
  */
 
function add_column_to_importer($options) {
  $options['slug'] = 'Slug';
  return $options;
}
add_filter( 'woocommerce_csv_product_import_mapping_options', 'add_column_to_importer' );


function add_column_to_mapping_screen( $columns ) {
  $columns['Slug'] = 'slug';
  return $columns;
}
add_filter( 'woocommerce_csv_product_import_mapping_default_columns', 'add_column_to_mapping_screen' );


function process_import( $object, $data ) {
  if ( !empty( $data['slug'] ) ) {
    $object->set_slug($data['slug']);
  }

  return $object;
}
add_filter( 'woocommerce_product_import_pre_insert_product_object', 'process_import', 10, 2 );

?>