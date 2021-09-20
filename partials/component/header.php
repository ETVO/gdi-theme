<?php
/**
 * Header component
 * 
 * @package WordPress
 * @subpackage GDI-Theme
 */
?>

<header class="navbar navbar-expand-lg" id="header">
    <div class="container-fluid">
        <div class="navbar-brand me-auto p-0">
            <?php the_custom_logo(); ?>
        </div>
        
        <button class="navbar-toggler p-0" type="button" 
		data-bs-toggle="collapse" data-bs-target="#mainMenuDropdown" 
		aria-controls="mainMenuDropdown" aria-expanded="false" aria-label="<?php echo __("Ativar Menu", "emertech") ?>">
            <span class="icon bi bi-list"></span>
		</button>

        
    </div>
</header>