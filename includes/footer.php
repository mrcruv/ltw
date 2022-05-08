<?php
    require_once('info.php');
    global $sitename, $current_year, $authors;
?>

<footer class="text-center mt-auto" id="footer">
    <div>
        <?php echo('<p>' . $sitename . ' © ' . $current_year . ' - Authors: ' . implode(', ',$authors) . '</p>'); ?>
    </div>
</footer>
