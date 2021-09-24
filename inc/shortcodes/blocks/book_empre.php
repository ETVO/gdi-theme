<?php

function book_empre($attrs) {
    $attrs = shortcode_atts( array(), $attrs );

    $image = get_theme_mod('gdi_form'); 
    if(have_rows('book')) { 
        the_row();
        
        $file_url = get_sub_field('file');
        $image = get_sub_field('img');
        $image = get_image_props_id($image);
    }

    ob_start(); // Start HTML buffering
    
    ?>

    <section class="book_empre pt-4">
        <div class="container col-lg-10 col-xl-9 px-3 m-auto">
            <div class="row">
                <div class="image col-lg-6">
                    <img class="w-100" src="<?php echo $image['url']; ?>" alt="<?php echo $image['url']; ?>">
                </div>
                <div class="content col-lg-6 py-3 py-lg-0 m-auto">
                    <div class="thin-title mb-5 text-left">
                        <h2>Book do<br>Empreendimento</h2>
                    </div>

                    <div class="button mt-4">
                        <a href="<?php echo $file_url; ?>" class="action" download="<?php echo get_the_title(); ?>">
                            <span class="text">baixar book em PDF</span>
                            <span class="bi bi-download ms-4"></span>
                        </a>
                    </div>
                    <div class="link mt-3">
                        <a href="<?php echo $file_url; ?>" target="_blank">
                            <span class="text">Acesse aqui</span>
                            <span class="bi bi-box-arrow-up-right ms-1"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script>
        document.getElementsByClassName('departamentos')[0].style = 'display:none';
        var input = document.getElementsByName('departamentos')[0];

        input.setAttribute('type', 'hidden');
        input.value = 'Geral';
    </script>

    <?php

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}