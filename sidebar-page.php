<?php
/**
 * Az oldalakon megjelenő oldalsáv sablon.
 *
 * @package SPFood
 */

if ( ! is_active_sidebar( 'sidebar-page' ) ) {
    return;
}
?>

<div class="page-sidebar">
    <?php dynamic_sidebar( 'sidebar-page' ); ?>
</div>