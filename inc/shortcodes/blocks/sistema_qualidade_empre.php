<?php

function sistema_qualidade_empre($attrs)
{
    $attrs = shortcode_atts(array(
        'link' => home_url()
    ), $attrs);

    $items = array(
        array(
            'title' => 'Sistema LR2SI:',
            'description' => 'Liquidez, Rentabilidade, Solidez, Sustentabilidade e Inovação.',
        ),
        array(
            'title' => 'Foco na Gestão:',
            'description' => 'planejamento inteligente com otimização e severo rigor no controle de custos.',
        ),
        array(
            'title' => 'Foco no Mercado:',
            'description' => 'requinte, inovação, estética e qualidade em todos os empreendimentos.',
        ),
        array(
            'title' => 'Foco na Qualidade:',
            'description' => 'somente fornecedores, materiais e acabamentos consagrados.',
        ),
        array(
            'title' => 'Foco na Estética:',
            'description' => 'design de interiores, acabamentos e padrões estéticos desenvolvidos pelas maiores empresas de design da américa latina.',
        ),
    );

    ob_start(); // Start HTML buffering

    if (count($items) > 0):
?>

    <section class="sistema_qualidade_empre text-light py-5">
        <div class="container col-12 col-lg-10 col-xl-9 mx-auto my-3">
            <div class="thin-title mb-3 text-sm-center">
                <h2>SISTEMA DE QUALIDADE GDI</h2>
            </div>
            <div class="list py-2">
                <?php foreach ($items as $item) :
                    ?>
                    <div class="list-item mt-3 mt-md-2 d-flex">
                        <span class="icon me-3">
                            <?php echo do_shortcode("[icon_gdi]"); ?>
                        </span>
                        <small class="text">
                            <b><?php echo $item['title']; ?></b>
                            <?php echo $item['description']; ?>
                        </small>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="action-wrap my-4">
            <div class="action text-center">
                <a class="bot-but dark wider" href="<?php echo $attrs['link'] ?>">
                    ver todos
                </a>
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

    endif;

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}
