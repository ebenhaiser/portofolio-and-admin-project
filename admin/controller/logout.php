<?php
    session_start();
    session_destroy();

    // Hapus semua variabel yang ada di lingkungan global
    foreach (array_keys(get_defined_vars()) as $var) {
        unset($$var);
    }

    header('location: ../login.php');
?>