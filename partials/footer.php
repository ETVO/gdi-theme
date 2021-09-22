<?php

/**
 * Footer component
 * 
 * @package WordPress
 * @subpackage GDI-Theme
 */

$logo = get_theme_mod('gdi_footer_logo');

// Phone
$phone = get_theme_mod('gdi_phone');

$phone_no = get_theme_mod('gdi_phone_number');
$phone_no = preg_replace('/[^0-9]/', '', $phone_no);

$phone_link = "tel:$phone_no";

// WhatsApp
$whatsapp = get_theme_mod('gdi_whatsapp');

$whatsapp_no = get_theme_mod('gdi_whatsapp_number');
$whatsapp_no = preg_replace('/[^0-9]/', '', $whatsapp_no);

$whatsapp_link = "https://wa.me/$whatsapp_no";

$contacts = array(
    array(
        'show' => $phone,
        'number' => $phone_no,
        'link' => $phone_link,
        'icon' => 'telephone-fill',
    ),
    array(
        'show' => $whatsapp,
        'number' => $whatsapp_no,
        'link' => $whatsapp_link,
        'icon' => 'whatsapp',
    )
);

// Address
$address = get_theme_mod('gdi_address');


$icons = get_theme_mod('gdi_social_icons');


?>

<footer>
    <div class="content col-11 col-sm-8 col-md-9 col-lg-7 col-xl-6 px-2 py-4 m-auto">
        <div class="row">
            <div class="col-12 col-md-8 m-auto m-md-0 row">
                <?php if ($logo) : ?>
                    <div class="col-12 col-sm-4 logo d-flex d-sm-block">
                        <img src="<?php echo $logo; ?>" alt="GDI Empreendimentos">
                    </div>
                <?php endif; ?>
                <div class="col-12 col-sm-8 info m-auto text-center text-sm-start">
                    <div class="contact">
                        <div class="list">
                            <?php foreach ($contacts as $contact) : ?>


                                <div class="list-item my-2 d-flex d-sm-block">
                                    <div class="d-flex mx-auto">
                                        <a class="icon me-2 text-primary" href="<?php echo $contact['link'] ?>" target="_blank" alt="<?php echo $contact['number']; ?>">
                                            <span class="bi bi-<?php echo $contact['icon'] ?>"></span>
                                        </a>
                                        <a class="text" href="<?php echo $contact['link'] ?>" target="_blank" alt="<?php echo $contact['number']; ?>">
                                            <span><?php echo $contact['show']; ?></span>
                                        </a>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="address mt-3 mt-sm-4">
                        <small>
                            <?php echo $address; ?>
                        </small>

                    </div>
                </div>
            </div>
            
            <div class="social col-12 col-md-4 mx-auto mx-md-0 d-flex">
                <div class="align m-auto">
                    <p class="title mb-2 text-center text-sm-start">
                        Acompanhe nossas<br>redes sociais
                    </p>
                    <div class="icons">
                        <?php foreach($icons as $icon): ?>
                            <a href="<?php echo $icon['url']; ?>">
                                <span class="bi bi-<?php echo $icon['icon']; ?>"></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>