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
                foreach ( $structure['header'] as $key => $cell ) {
                    echo (in_array($cell, CsvImportController::$importablePageFields)) ? '<th class="importable">' : '<th>';
                        if ( ($cell == 'slug') && CsvImportController::checkPartName ( $cell )!==$cell ) {
//                                $this->failure(__('Invalid characters in page part name. Only english letters and + - . _ are allowed'));
                                  //Flash::setNow('csv_warning')
                        }
                    echo $cell . '</th>';
                }
                echo '</tr>' . PHP_EOL;
                ?>
            </thead>
            <?php
            foreach ( $structure['contents'] as $rows ):
                echo '<tr>' . PHP_EOL;
                foreach ( $rows as $key => $cell ) {
                    $cell = trim($cell);
                    $column_name = $structure['header'][$key];

                    //check required fields
                    $requiredClass = ( $column_name == 'slug' ) ? 'required' : '';

                    $emptyClass = (strlen($cell)===0) ? ' empty' : '';

                    echo '<td class="' . $requiredClass . $emptyClass . '">';
                    echo '<div class="text-center">' . htmlentities($cell,ENT_COMPAT,'UTF-8') . '</div>';
                        if ( ($column_name == 'slug') && CsvImportController::slugify ( $cell )!==$cell ) {
                            echo '<div class="text-center">&dArr;</div><div class="text-center" style="color: red"><b>' . CsvImportController::slugify ( $cell ) . '</b></div>';
                        }
                    echo '</td>';
                }
                echo '</tr>' . PHP_EOL;
            endforeach;
            ?>
        </table>
    </div>