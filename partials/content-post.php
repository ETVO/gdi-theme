<?php
/**
 * Partial for single post content rendering
 * 
 * @package WordPress
 * @subpackage GDI-Theme
 */
 
// Initialize meta data array
$meta = array(
    "date" => array(
        "name" => __("Data"), 
        "value" => "", 
        "show" => true, 
    ),
    "category" => array(
        "name" => __("Categoria"), 
        "value" => "", 
        "show" => true, 
    ),
);

// Get theme mod for meta separator 
$separator = "&bull;";

// Get the blog information 
$blog_url = get_post_type_archive_link( 'post' );

// Get the post information
$post = get_post();
                    
$permalink = esc_url(get_the_permalink());

$show_image = get_post_meta($post->ID, 'et_post_show_image', true) == 'yes';

$has_image = has_post_thumbnail();
if($has_image)
    $image = get_image_props_id(get_post_thumbnail_id( $post->ID ));

$title = get_the_title();
$excerpt = get_the_excerpt();

$date = get_the_date();
$categories = get_the_category();

$category = "";

for($i = 0; $i < count($categories); $i++) {
    if($i > 0) $category .= ", ";
    $category_link = $blog_url . "?category=" . $categories[$i]->slug;
    $category .= "<a class=\"onhover\" href=\"$category_link\">";
    $category .= $categories[$i]->name;
    $category .= "</a>";
}

// Set meta properties to meta array
$meta["date"]["value"] = $date;
$meta["category"]["value"] = $category;

// Generate meta HTML
$meta_html = "";
$i = 0;
$show_separator = false;
foreach($meta as $property) {

    if($property["show"]) {
        if($i > 0 && $show_separator) $meta_html .= "&nbsp;$separator&nbsp;";
        if($property["value"] != "") {
            $meta_html .= "<small aria-label=\"{$property["name"]}\">";
            $meta_html .= $property["value"];
            $meta_html .= "</small>";
        }
        $show_separator = true;
    }

    $i++;
}

?>

<div class="post-wrap py-5">
    <div class="single col-12 col-sm-11 col-md-9 col-lg-7 m-auto px-4 px-md-0">
        <div class="heading mb-2">
            <div class="action">    
                <a href="<?php echo $blog_url; ?>" class="d-flex">
                    <span class="bi bi-chevron-left">
                        voltar ao Blog
                    </span>
                </a>
            </div>
            <h2 class="title mt-2">
                <?php echo $title; ?>
            </h2>
            <div class="meta pb-2">
                <?php echo $meta_html; ?>
            </div>
        </div>
        <div class="excerpt mb-3"> 
            <p>
                <?php echo $excerpt; ?>
            </p>
        </div>
        <?php if($has_image): ?>
            <div class="image mb-3">
                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="img-fluid">
            </div>
        <?php endif; ?>
        <div class="content">
            <?php the_content(); ?>
        </div>
        <div class="after-content pt-3 blog_feed no-bg item-border">
            <h5>Posts relacionados</h5>
        <?php

            $related = get_posts( array( 
                'category__in' => wp_get_post_categories($post->ID), 
                'numberposts' => 3, 
                'post__not_in' => array($post->ID) 
            ));

            if($related): 

                ?>
                <div class="items row g-3 py-3 justify-content-center">
                <?php
                
                foreach($related as $post):
                    setup_postdata($post); 
                            
                    $post = get_post();
                    
                    $permalink = esc_url(get_the_permalink());
                    
                    $image_url = get_the_post_thumbnail_url($post->ID, 'thumbnail');
                    $image_alt = get_the_post_thumbnail_caption();
                    
                    $post_title = get_the_title();
                    $excerpt = get_the_excerpt();
                    $date = get_the_date();

                    // Get the first tag name
                    $tag = get_the_tags()[0];

                    ?>
                        <div class="item col-12 col-sm-6 col-lg-4">
                            <div class="image clink" href="<?php echo $permalink; ?>">
                                <img class="w-100" src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>">
                                <?php if($tag->name): ?>
                                <div class="tag-overlay">
                                    <span>
                                        <?php echo $tag->name; ?>
                                    </span>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="info text-start">
                                <div class="upper-part">
                                    <h6 class="post_title">
                                        <a class="text-dark" href="<?php echo $permalink; ?>">
                                            <?php echo $post_title; ?>
                                        </a>
                                    </h6>
                                    <p class="excerpt">
                                        <?php echo $excerpt; ?>
                                    </p>
                                </div>
                                <small class="date">
                                    <?php echo $date; ?>
                                </small>
                                <a href="<?php echo $permalink; ?>" class="action d-flex">
                                    <div class="ms-auto">
                                        ver mais
                                        <span class="bi bi-chevron-right"></span>
                                    </div>
                                </a>
                            </div>
                        </div>   
                    <?php 
                endforeach;
                
                ?>
                </div>
                <?php

            endif;
            wp_reset_postdata(); 
        ?>
        </div>
    </div>
</div>