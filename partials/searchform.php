<?php
/**
 * Partial for the 404 error component
 * 
 * @package WordPress
 * @subpackage GDI-Theme
 */

$search_validity = __('Por favor insira um termo de pesquisa');
$search_label = __('Pesquisar');

?>

<form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="searchform d-flex">

    <div class="row g-2">
        <div class="col-9 ms-auto">
            
            <input type="search" class="input form-control" name="s" id="search" 
                value="<?php the_search_query(); ?>" 
                oninvalid="this.setCustomValidity('<?php echo $search_validity; ?>')"   
                placeholder="<?php echo $search_label; ?>" required>
        </div>

        <div class="col-2">
            <button type="submit" class="submit" title="<?php echo $search_label; ?>">
                <span class="bi bi-search"></span>
            </button>
        </div>
    </div>

    <input type="hidden" name="post_type" value="post" required>
</form>