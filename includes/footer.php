<?php
global $sitename, $sitename_brief, $current_year, $authors;
require_once('info.php');
?>

<footer class="text-center mt-auto shadow p-3 rounded" id="footer">
    <div>
        <span class="align-middle h6">
            <?php echo $sitename . ' (' . $sitename_brief . ')' . ' © ' . $current_year . ' - Authors: ' . implode(', ', $authors) ?>
        </span>
    </div>
</footer>
