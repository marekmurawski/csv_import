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
?>
<p>
    <?php echo __( 'Columns' ); ?>: <b><?php echo $structure['col_count']; ?></b>,
    <?php echo __( 'Rows' ); ?>: <b><?php echo $structure['row_count']; ?></b>
    <br/>
    <?php echo __( 'Locale' ); ?>: <b><?php echo setlocale( LC_ALL, 0 ); ?></b>
</p>

<div id="table-preview-container" class="full">
    <table class="preview">
        <thead>
            <?php
            echo '<tr>' . PHP_EOL;
            echo '<th class="text-center">#</th>' . PHP_EOL;
            foreach ( $structure['header'] as $key => $cell ) {
                $hClass = '';
                if ( in_array( $cell, CsvImportController::$importablePageFields ) )
                    $hClass = ' importable';
                if ( !CsvImportController::checkPartName( $cell ) ) {
                    $hClass       = ' invalid';
                }
                echo '<th class="' . $hClass . '">';
                echo $cell;
                echo '</th>';
            }
            echo '</tr>' . PHP_EOL;
            ?>
        </thead>
        <?php
        $now_datetime = '<span style="white-space:nowrap">' . date( 'Y-m-d H:i:s' ) . '</span>';
        $current_row  = 0;
        foreach ( $structure['contents'] as $rows ):
            $current_row += 1;
            if ( in_array( 'slug', $structure['header'] ) ) {
                $key        = array_search( 'slug', $structure['header'] );
                $valid_slug = CsvImportController::slugify( $rows[$key] );
            }

            echo '<tr>' . PHP_EOL;
            echo '<td class="text-center">' . $current_row . '</td>' . PHP_EOL;

            foreach ( $rows as $key => $cell ) {
                $cell_override = false;
                $cell          = trim( $cell );


                $column_name = $structure['header'][$key];

                if ( ($column_name === 'slug') && $valid_slug !== $cell ) {
                    $cell_override = CsvImportController::slugify( $cell );
                }
                if ( $column_name === 'breadcrumb' && strlen( $cell ) === 0 ) {
                    $cell_override = $valid_slug;
                }
                if ( $column_name === 'title' && strlen( $cell ) === 0 ) {
                    $cell_override = $valid_slug;
                }

                if ( ($column_name === 'created_on' || $column_name === 'published_on' ) ) {
                    if ( !CsvImportController::checkDateTime( $cell ) )
                        $cell_override = $now_datetime;
                }
                if ( ($column_name === 'valid_until' ) ) {
                    if ( strlen( $cell ) !== 0 && !CsvImportController::checkDateTime( $cell ) ) {
                        $cell_override = $now_datetime;
                    }
                }
                //check required fields
                $requiredClass = ( $column_name == 'slug' ) ? 'required' : '';

                $emptyClass = ((strlen( $cell ) === 0) && (strlen( $cell_override ) === 0)) ? ' empty' : '';

                echo '<td class="' . $requiredClass . $emptyClass . '">';
                if ( $cell_override ) {
                    $delO = '<del>';
                    $delC = '</del>';
                } else {
                    $delO = '';
                    $delC = '';
                }
                echo '<div>' . $delO . htmlentities( $cell, ENT_COMPAT, 'UTF-8' ) . $delC . '</div>';
                if ( $cell_override ) {
                    echo '<div style="color: red">&rArr;<b>' . $cell_override . '</b></div>';
                }
                echo '</td>';
            }
            echo '</tr>' . PHP_EOL;
        endforeach;
        ?>
    </table>
</div>
<h3>Raw file preview: <?php echo $filename; ?></h3>
<div id="raw-preview-container" class="full">
    <pre><?php
        echo htmlentities( $structure['raw_file'], ENT_COMPAT, 'UTF-8' );
        ?></pre>
</div>