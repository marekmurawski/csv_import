    <p>
        <?php echo __( 'Columns' ); ?>: <b><?php echo $structure['col_count']; ?></b>,
        <?php echo __( 'Rows' ); ?>: <b><?php echo $structure['row_count']; ?></b>
        <br/>
        <?php echo __( 'Locale' ); ?>: <b><?php echo setlocale(LC_ALL,0); ?></b>
    </p>
    <div id="raw-preview-container" class="full">
        <pre><?php
    echo htmlentities($structure['raw_file'],ENT_COMPAT ,'UTF-8');
    ?></pre>
    </div>
    <div id="table-preview-container" class="full">
        <table class="preview">
            <thead>
                <?php
                echo '<tr>' . PHP_EOL;
                echo '<th class="text-center">#</th>' . PHP_EOL;
                foreach ( $structure['header'] as $key => $cell ) {
                    $hClass = '';
                    if ( in_array($cell, CsvImportController::$importablePageFields)) $hClass=' importable';
                    if ( !CsvImportController::checkPartName ( $cell ) ) { $hClass = ' invalid'; }
                    echo '<th class="'.$hClass.'">';
                    echo $cell;
                    echo '</th>';
                }
                echo '</tr>' . PHP_EOL;
                ?>
            </thead>
            <?php
            $current_row = 0;
            foreach ( $structure['contents'] as $rows ):
                $current_row += 1;
                if ( in_array( 'slug', $structure['header'] ) ) {
                            $key = array_search( 'slug', $structure['header'] );
                            $valid_slug = CsvImportController::slugify( $rows[$key] );
                        }

                echo '<tr>' . PHP_EOL;
                echo '<td class="text-center">' . $current_row .'</td>' . PHP_EOL;

                foreach ( $rows as $key => $cell ) {
                    $cell_override = false;
                    $cell = trim($cell);


                    $column_name = $structure['header'][$key];

                        if ( ($column_name ==='slug') && $valid_slug!==$cell ) {
                            $cell_override = CsvImportController::slugify ( $cell );
                        }

                        if ($column_name==='breadcrumb' && strlen($cell)===0) {
                            $cell_override = $valid_slug;
                        }
                        if ($column_name==='title' && strlen($cell)===0) {
                            $cell_override = $valid_slug;
                        }

                    //check required fields
                    $requiredClass = ( $column_name == 'slug' ) ? 'required' : '';

                    $emptyClass = (strlen($cell)===0) ? ' empty' : '';

                    echo '<td class="' . $requiredClass . $emptyClass . '">';
                    echo '<div>' . htmlentities($cell,ENT_COMPAT,'UTF-8') . '</div>';
                    if ($cell_override) {
                    echo '<div class="text-center">&dArr;</div><div class="text-center" style="color: red"><b>' . $cell_override . '</b></div>';
                    }
                    echo '</td>';
                }
                echo '</tr>' . PHP_EOL;
            endforeach;
            ?>
        </table>
    </div>