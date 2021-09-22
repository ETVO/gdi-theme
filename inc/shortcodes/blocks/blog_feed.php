<?php

function blog_feed($attrs) {
    $attrs = shortcode_atts( array(
        'category' => '',
        'not' => '',
    ), $attrs );

    
    $cat_slug = $attrs['category'];
    $category = false;
    if($cat_slug != '' && $cat = get_category_by_slug($cat_slug)) {
        $title = $cat->name;
        $category = true;
    }
    else {
        $title = 'Blog GDI';
    }

    $not_slug = $attrs['not'];
    if($not = get_category_by_slug($not_slug)) {
        $not_category = true;
    }

    $nopaging = true;
    $ppp = 4;
    $orderby = "title";
    $order = "ASC";

    // WP_Query arguments
    $args = array(
        'post_type'              => 'post',
        'post_status'            => array('publish'),
        'has_password'           => false,
        'nopaging'               => $nopaging,
        'posts_per_page'         => $ppp,
        
        
        // Order ASC first by 'menu_order', only after by 'title' or 'date'
        'orderby'                => array( 'menu_order' => 'ASC' , $orderby => $order ), 
    );

    $blog_link = get_permalink(get_option('page_for_posts'));

    if($category) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $cat_slug,
            ),
        );

        $blog_link .= "?=category_name=" . $cat_slug;
    }

    if($not_category) {
        if($category) {
            $args['tax_query']['relation'] = 'AND';
            
            $args['tax_query'][] = array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $not_slug,
                'operator' => 'NOT IN',
            );
        }
        else {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'category',
                    'field'    => 'slug',
                    'terms'    => $not_slug,
                    'operator' => 'NOT IN',
                ),
            );
        }
    }

    // The Query
    $query = new WP_Query($args);

    ob_start(); // Start HTML buffering

    if($query->have_posts()) {
        ?>

        <section class="blog_feed py-3 <?php if(!$category) echo "blog-block"; ?>">
            <div class="container col-lg-10 col-xl-8 py-5 mx-auto">
                <div class="thin-title text-center text-uppercase">
                    <h2>
                        <?php echo $title; ?>
                    </h2>
                </div>
                
                <div class="items row g-3 py-3 justify-content-center">
                <?php
                    while ($query->have_posts()) :
                        $query->the_post();
                        
                        $post = get_post();
                        
                        $permalink = esc_url(get_the_permalink());
                        
                        $image_url = get_the_post_thumbnail_url($post->ID, 'thumbnail');
                        $image_alt = get_the_post_thumbnail_caption();
                        
                        $post_title = get_the_title();
                        $excerpt = get_the_excerpt();
                        $date = get_the_date();

                        // Get the first tag name
                        $tag_name = get_the_tags()[0];

                        ?>
                        <div class="item col-12 col-md-3">
                            <div class="image clink" href="<?php echo $permalink; ?>">
                                <img class="w-100" src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>">
                                <div class="tag-overlay">
                                    <span>
                                        <?php echo $tag_name; ?>
                                    </span>
                                </div>
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
                                <a href="<?php $permalink; ?>" class="action d-flex">
                                    <div class="ms-auto">
                                        ver mais
                                        <span class="bi bi-chevron-right"></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php
                    
                    endwhile;
                ?>
                </div>

                <div class="action-wrap mt-4">
                    <div class="action text-center">
                        <a href="<?php echo $blog_link; ?>" class="bot-but <?php if(!$category) echo 'dark'; ?>">
                            ver todos <span class="ms-3 bi bi-chevron-right"></span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        
        <?php
    }

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}