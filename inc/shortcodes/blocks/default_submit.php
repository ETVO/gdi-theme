<?php

function default_submit($attrs) {

    ob_start(); // Start HTML buffering

    ?>
        <div class="d-flex">
            <button class="default_submit ms-auto" type="submit">
                enviar 
                <span class="bi bi-chevron-right"></span>
            </button>
        </div>
    <?php
    
    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}