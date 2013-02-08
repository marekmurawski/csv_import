<?php
/*
 * CSV Import Plugin for Wolf CMS
 * Import .csv, .tsv and .txt spreadsheet files into Wolf CMS pages and page parts.
 *
 * @package Plugins
 * @subpackage multiedit
 *
 * @author Marek Murawski <http://marekmurawski.pl>
 * @copyright Marek Murawski, 2013
 * @license http://www.gnu.org/licenses/gpl.html GPLv3 license
 */

/* Security measure */
if ( !defined( 'IN_CMS' ) ) {
    exit();
}
?>
<h1><?php echo __( 'Settings' ); ?></h1>
<p>
    <?php echo __( 'Display settings page here!' ); ?>
</p>

<script type="text/javascript">
    // <![CDATA[
    function setConfirmUnload(on, msg) {
        window.onbeforeunload = (on) ? unloadMessage : null;
        return true;
    }

    function unloadMessage() {
        return '<?php echo __( 'You have modified this page.  If you navigate away from this page without first saving your data, the changes will be lost.' ); ?>';
    }

    $(document).ready(function() {
        // Prevent accidentally navigating away
        $(':input').bind('change', function() { setConfirmUnload(true); });
        $('form').submit(function() { setConfirmUnload(false); return true; });
    });
    // ]]>
</script>