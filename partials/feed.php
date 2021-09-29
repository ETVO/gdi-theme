<?php
/**
 * Partial for posts feed rendering
 * 
 * @package WordPress
 * @subpackage GDI-Theme
 */


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

$no_posts_found = "Nenhum post foi encontrado...";

?>

<div class="feed">
    <div class="posts-wrap">
        <div class="posts">
        <?php
        if(have_posts()){
            while(have_posts()):
                the_post();
                $post = get_post();

                $permalink = esc_url(get_the_permalink());

                $has_image = has_post_thumbnail();
                if($has_image)
                    $image = get_image_props_id(get_post_thumbnail_id( $post->ID ));

                $date = get_the_date();

                $categories = get_the_category();
                
                $category = "";
                    
                for($i = 0; $i < count($categories); $i++) {
                    if($i > 0) $category .= ", ";
                    $category .= $categories[$i]->name;
                }
                
                $meta["date"]["value"] = $date;
                $meta["category"]["value"] = $category;
                $meta_html = "";
                
                $i = 0;
                $show_separator = true;
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
                
                $title = get_the_title();
                $excerpt = get_the_excerpt();

                ?>

                <div class="post row my-3">
                    <div class="image col-4">
                        <img class="w-100 clink" href="<?php echo $permalink; ?>" src="<?php echo $image['url']; ?>" alt="<?php echo $image['caption']; ?>">
                    </div>
                    <div class="content col-8">
                        <div class="title">
                            <h5>
                                <a class="text-dark" href="<?php echo $permalink; ?>">
                                    <?php echo $title; ?>
                                </a>
                            </h5>
                        </div>
                        <div class="meta mb-2">
                            <?php echo $meta_html; ?>
                        </div>
                        <div class="excerpt">
                            <?php echo $excerpt; ?>
                        </div>
                        <div class="action-wrap">    
                            <a href="<?php echo $permalink; ?>" class="action d-flex">
                                <div class="ms-auto">
                                    ver mais
                                    <span class="bi bi-chevron-right"></span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <?php

            endwhile;
        }
        else {
            ?>
            <h5 class="mt-4 no-posts"><?php echo $no_posts_found; ?></h5>
            <?php if(!is_home()): ?>
            <div class="action">    
                <a href="<?php echo get_post_type_archive_link( 'post' ); ?>" class="d-flex">
                    <span class="bi bi-chevron-left">
                        voltar ao Blog
                    </span>
                </a>
            </div>
            <?php endif; ?>
            <?php
        }
        ?>
        </div>
    </div>

    <div class="pt-3">
        <?php
            get_template_part("partials/pagination");
        ?>
    </div>
</div>