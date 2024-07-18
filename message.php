<?php

if (isset($_SESSION['message'])) {
    $mes = $_SESSION['message'];
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $mes ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
    
}

?>