<?php

function gdi_empreendimentos($attrs) {
    $attrs = shortcode_atts( array(
        'max' => 0,
        'show_all' => 0,
        'show_title' => 1,
        'title' => 'Empreendimentos',
        'show_caracters' => 1,
        'cols' => 3,
    ), $attrs );

    $show_title = $attrs['show_title'];
    $show_caracters = $attrs['show_caracters'];
    $title = $attrs['title'];
    $cols = $attrs['cols'];

    $item_col_class = 'col-lg-' . round(12 / $cols); 
    if($cols == 4)
        $item_col_class = 'col-md-4 ' . $item_col_class;
    
    $post_type = 'empre';
    $orderby = 'title';
    $order = 'ASC';
    $nopaging = true;
    
    // Posts Per Page (-1 means it shows all)
    $ppp = -1; 
    $show_all = true;
    if(!$attrs['show_all']) { 
        $show_all = false;
        
        if($attrs['max'] > 0) {
            $ppp = $attrs['max'];
        } 
        else {
            $ppp = 3;
        }
    }
    else {
        $ppp = -1;
    }

    // WP_Query arguments
    $args = array(
        'post_type'              => $post_type,
        'post_status'            => array('publish'),
        'has_password'           => false,
        'nopaging'               => $nopaging,
        'posts_per_page'         => $ppp,
        
        // Order ASC first by 'menu_order', only after by 'title' or 'date'
        'orderby'                => array( 'menu_order' => 'ASC' , $orderby => $order ), 
    );

    $empre_link = get_theme_mod('gdi_empre_link');

    // The Query
    $query = new WP_Query($args);
    
    ob_start(); // Start HTML buffering

    if($query->have_posts()) {
        ?>

        <section class="gdi_empreendimentos py-3 show-all-<?php echo $show_all; ?>">
            <div class="container col-12 col-xl-10 pt-5 mx-auto">
                <?php if($show_title): ?>
                <div class="thin-title text-center">
                    <h2>
                        <?php echo $title; ?>
                    </h2>
                </div>
                <?php endif; ?>
                
                <div class="items row g-3 py-3">
                <?php
                    while ($query->have_posts()) :
                        $query->the_post();
                        
                        $post = get_post();
                        
                        $permalink = esc_url(get_the_permalink());
                        
                        $image_url = get_the_post_thumbnail_url($post->ID, 'thumbnail');
                        $image_alt = get_the_post_thumbnail_caption();
                        
                        $nome = get_the_title();
                        $endereco = get_field('endereco');

                        $caracters = array(
                            'medidas',
                            'habitacoes',
                        )

                        ?>
                        <div class="item col-12 <?php echo $item_col_class; ?>">
                            <div class="image">
                                <img class="w-100" src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>">
                            </div>
                            <div class="info text-start">
                                <h5 class="nome">
                                    <?php echo $nome; ?>
                                </h5>
                                <small class="endereco">
                                    <?php echo $endereco; ?>
                                </small>
                                <?php if($show_caracters): ?>
                                    <div class="list mt-2">

                                        <?php 
                                        if(have_rows('caracters')) { the_row();
                                            foreach($caracters as $caracter): 

                                                $value = get_sub_field($caracter);
                                        ?>
                                                <div class="list-item mt-2 d-flex">
                                                    <span class="icon me-2">
                                                        <?php echo do_shortcode("[icon_$caracter]"); ?>
                                                    </span>
                                                    <small class="text">
                                                        <?php echo $value; ?>
                                                    </small>
                                                </div>
                                        <?php endforeach; } ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="action">
                                <a href="<?php echo $permalink; ?>" class="d-flex">
                                    <div class="me-auto">
                                        mais detalhes
                                    </div>
                                    <div class="ms-auto">
                                        <span class="bi bi-chevron-right"></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php
                    
                    endwhile;
                ?>
                </div>

                <?php if(!$show_all): ?>
                    <div class="action-wrap mt-4 mb-5">
                        <div class="action text-center">
                            <a href="<?php echo $empre_link; ?>" class="bot-but">
                                ver todos <span class="ms-3 bi bi-chevron-right"></span>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        
        <?php
    }

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}