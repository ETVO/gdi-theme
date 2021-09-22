<?php
/**
 * Header component
 * 
 * @package WordPress
 * @subpackage GDI-Theme
 */

$whatsapp = get_theme_mod('gdi_whatsapp');

$whatsapp_no = get_theme_mod('gdi_whatsapp_number');
$whatsapp_no = preg_replace('/[^0-9]/', '', $whatsapp_no);

$whatsapp_link = "https://wa.me/$whatsapp_no";
?>

<header class="navbar navbar-expand-md text-light" id="header">
    <div class="container my-2">
        <div class="navbar-brand me-auto p-0">
            <?php the_custom_logo(); ?>
        </div>
        
        <button class="navbar-toggler p-0" type="button" 
		data-bs-toggle="collapse" data-bs-target="#mainMenuDropdown" 
		aria-controls="mainMenuDropdown" aria-expanded="false" aria-label="<?php echo __("Ativar Menu") ?>">
            <span class="icon bi bi-list"></span>
		</button>

        <div class="collapse navbar-collapse" id="mainMenuDropdown">
            <?php 
                wp_nav_menu(
                    array( 
                        'theme_location'    => 'main_menu',
                        'depth'             => 2,
                        'container_class'   => 'ms-auto',
                        'menu_class'        => 'navbar-nav',
                        'walker'            => new BS_Menu_Walker()
                    )
                ); 
            ?>

        </div>

        <?php if($whatsapp): ?>
            <div class="action collapse navbar-collapse ms-md-3 text-primary text-center" id="mainMenuDropdown">
                <a href="<?php echo $whatsapp_link; ?>" target="_blank" alt="WhatsApp <?php echo $whatsapp_no; ?>">
                    <span class="bi bi-whatsapp"></span> <?php echo $whatsapp; ?>
                </a>
            </div>
        <?php endif; ?>

        
    </div>
</header>