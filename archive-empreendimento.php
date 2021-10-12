<?php
/**
 * Archive for Empre template
 * 
 * @package WordPress
 * @subpackage GDI-Theme
 */


$empre_link = get_theme_mod('gdi_empre_link');
// Redirect to the defined page for Empreendimentos
header("Location: $empre_link");
