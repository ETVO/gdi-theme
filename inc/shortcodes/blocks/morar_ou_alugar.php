<?php

function morar_ou_alugar($attrs) {
    $attrs = shortcode_atts( array(
    ), $attrs );

    ob_start(); // Start HTML buffering

    $title1 = "Pronto para";
    $title2 = "Morar ou Alugar";
    $text = 'Em parceria com o Studio Mooka® entregamos unidades totalmente mobiliadas segundo os melhores padrões para moradia ou locação de alta ou curta temporada (Airbnb).<br>
    Seu apartamento montado com requinte e sofisticação, prontinho para morar, ou rentabilizar nas melhores plataformas de aluguel!';

    $moa_image = get_theme_mod('gdi_moa_img');
    $mooka_logo = get_theme_mod('gdi_mooka_logo');
    
    ?>

    <section class="morar_ou_alugar">
        <div class="container col-12 col-lg-10 col-xl-9 mx-auto">
            <div class="row">
                <div class="image col-12 col-md-6">
                    <img class="w-100" src="<?php echo $moa_image; ?>" alt="">
                </div>
                <div class="content col-12 p-4 col-md-6 d-flex">
                    <div class="my-auto">
                        <div class="title">
                            <h2 class="first">
                                <?php echo $title1; ?>
                            </h2>
                            <h2 class="second">
                                <?php echo $title2; ?>
                            </h2>
                        </div>
                        <div class="text mt-3">
                            <p>
                                <?php echo $text; ?>
                            </p>
                        </div>
                        <div class="logo">
                            <img class="" src="<?php echo $mooka_logo; ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <?php

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}