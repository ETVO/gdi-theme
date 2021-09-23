<?php

function form_simple($attrs) {
    $attrs = shortcode_atts( array(
    ), $attrs );

    $shortcode = get_theme_mod('gdi_form'); 

    ob_start(); // Start HTML buffering
    
    ?>

    <section class="form_simple py-3">
        <div class="content px-3 py-5 m-auto text-center">
            <div class="thin-title mb-3">
                <h2>Contato</h2>
            </div>
            <div class="form text-start d-flex">
                <?php 
                    echo do_shortcode($shortcode);
                ?>     
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