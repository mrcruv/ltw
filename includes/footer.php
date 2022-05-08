<?php
    require_once('info.php');
    global $sitename, $current_year, $authors;
?>

<footer class="text-center mt-auto shadow p-3 rounded" id="footer">
    <div>
        <span class="align-middle h6"><?php echo $sitename . ' © ' . $current_year . ' - Authors: ' . implode(', ',$authors) ?></span>
    </div>
</footer>
