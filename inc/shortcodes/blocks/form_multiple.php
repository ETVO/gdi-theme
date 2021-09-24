<?php

function form_multiple($attrs)
{
    $attrs = shortcode_atts(array(
        'show_title' => 1
    ), $attrs);

    $shortcode = get_theme_mod('gdi_form');

    ob_start(); // Start HTML buffering

    $input_name = 'departamentos';

    $options = array(
        'Vendas',
        'Recursos Humanos',
        'Pós-vendas',
        'Fornecedores',
        'Marketing'
    )

?>

    <section class="form_multiple form_simple py-4">
        <div class="container col-12 col-lg-10 col-xl-8 pt-5 mx-auto">
            <div class="row w-100">
                <div class="col-12 col-lg-4">
                    <ul class="departamentos-options nav flex-column pb-4 pb-lg-0" role="tablist" aria-orientation="vertical">
                        <?php 
                        for($i = 0; $i < count($options); $i++) {
                            $option = $options[$i];

                            $target = strtolower(str_replace(' ', '-', $option));
                            $id = 'nav-' . strtolower(str_replace(' ', '-', $option));

                            if($i == 0) {
                                ?>
                                <li class="nav-item">
                                    <button class="nav-link active" id="<?php echo $id; ?>" 
                                    data-bs-toggle="tab" 
                                    data-bs-target="#<?php echo $target; ?>" 
                                    aria-controls="#<?php echo $target; ?>" aria-selected="true"
                                    type="button" role="tab">
                                        <?php echo $option; ?>
                                    </button>
                                </li>
                                <?php
                            }
                            else {
                                ?>
                                <li class="nav-item">
                                    <button class="nav-link" id="<?php echo $id; ?>" 
                                    data-bs-toggle="tab" 
                                    data-bs-target="#<?php echo $target; ?>" 
                                    aria-controls="<?php echo $target; ?>" aria-selected="false"
                                    type="button" role="tab">
                                        <?php echo $option; ?>
                                    </button>
                                </li>
                                <?php
                            }
                        } ?>
                    </ul>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="content px-3 m-auto">
                        <div class="tab-content">
                            <?php 
                            for($i = 0; $i < count($options); $i++) {
                                $option = $options[$i];

                                $target = 'nav-' . strtolower(str_replace(' ', '-', $option));
                                $id = strtolower(str_replace(' ', '-', $option));

                                if($i == 0) {
                                    ?>
                                    <div class="thin-title tab-pane fade show active" id="<?php echo $id; ?>" role="tabpanel" 
                                    aria-labelledby="<?php echo $target; ?>">
                                        <h2><?php echo $option; ?></h2>
                                    </div>
                                    <?php
                                }
                                else {
                                    ?>
                                    <div class="thin-title tab-pane fade" id="<?php echo $id; ?>" role="tabpanel" 
                                    aria-labelledby="<?php echo $target; ?>">
                                        <h2><?php echo $option; ?></h2>
                                    </div>
                                    <?php
                                }
                            } ?>
                        </div>
                        <div class="form text-start d-flex">
                            <?php
                            echo do_shortcode($shortcode);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script>
        var inputWrap = document.getElementById('departamentos');
        inputWrap.innerHTML = '';
        
        var newInput = '<input type="hidden" name="departamentos"/>';
        inputWrap.innerHTML = newInput;
    </script>

<?php

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}
