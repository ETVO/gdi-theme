<?php
/**
 * Partial for blog page rendering
 * 
 * @package WordPress
 * @subpackage GDI-Theme
 */

$code = '404';
$message = 'Nenhuma página foi encontrada';

?>

<div class="error-404 d-flex py-5 my-4">
    <div class="m-auto text-center px-auto">
        <div class="title">
            <h1>
                <?php echo $code; ?>
            </h1>
        </div>
        <div class="message pt-2 pb-4">
            <?php echo $message; ?>
        </div>
        <div class="search">
            <?php get_search_form(); ?>
        </div>
    </div>
</div>