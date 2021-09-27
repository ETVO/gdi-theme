<?php

function concepcao($attrs) {
    $attrs = shortcode_atts( array(
    ), $attrs );

    ob_start(); // Start HTML buffering

    $title = "CONCEPÇÃO";
    
    $fields = array(
        array(
            'name' => 'Projeto Arquitetônico',
            'attr' => 'projeto_arquitetonico'
        ),
        array(
            'name' => 'Projeto de Interiores',
            'attr' => 'projeto_de_interiores'
        ),
        array(
            'name' => 'Paisagismo',
            'attr' => 'paisagismo'
        ),
        array(
            'name' => 'Jurídico',
            'attr' => 'juridico'
        ),
    );
    ?>

    <section class="concepcao py-5">
        <div class="container col-12 col-lg-10 col-xl-9 py-3 mx-auto">
            <div class="thin-title mb-3 text-center">
                <h2><?php echo $title; ?></h2>
            </div>
            <div class="fields row pt-4">
                <?php 
                if(have_rows('concepcao')) { the_row();
                foreach($fields as $field): 
                    $value = get_sub_field($field['attr']);

                    ?>
                    <div class="field col-12 col-md-6 col-lg-3 text-center px-2">
                        <small class="name">
                            <?php echo $field['name']; ?>
                        </small>
                        <h5 class="value">
                            <?php echo $value; ?>
                        </h5>
                    </div>
                <?php endforeach; }?>
            </div>
        </div>

    </section>

    <?php

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}