<?php
$layouts = Layout::findAll();
?>

<h1><?php echo __( 'CSV Importer' ) ?></h1>
<form action="<?php echo get_url( 'plugin/csv_import' ); ?>" method="POST">
    <table class="settings full">
        <tr>
            <td class="three-quarters">
                <table class="full">
                    <tbody>
                        <tr>
                            <td colspan="4">
                                <h4><?php echo __( 'Input file parsing options' ); ?></h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="quarter">
                                <label><?php echo __( 'Directory' ); ?></label>
                            </td>
                            <td class="quarter">
                                <b><?php echo '[CMS_ROOT]' . $directory ?></b>
                            </td>
                            <td class="quarter">
                                <label for="options-delimeter"><?php echo __( 'Column delimeter character' ); ?></label>
                            </td>
                            <td class="quarter">
                                <select name="options[delimeter]" id="options-delimeter" class="full">
                                    <option value="semicolon"<?php echo ('semicolon'===$options['delimeter']) ? ' selected="selected"' : '';?>><?php echo ('Semicolon') . ' - ;'; ?></option>
                                    <option value="comma"<?php echo ('comma'===$options['delimeter']) ? ' selected="selected"' : '';?>><?php echo ('Comma') . ' - ,'; ?></option>
                                    <option value="pipe<?php echo ('pipe'===$options['delimeter']) ? ' selected="selected"' : '';?>"><?php echo ('Pipe') . ' - |'; ?></option>
                                    <option value="tab"<?php echo ('tab'===$options['delimeter']) ? ' selected="selected"' : '';?>><?php echo ('Tabulator'); ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="quarter">
                                <label for="filename"><?php echo __( 'Choose file to import' ); ?></label>
                            </td>
                            <td class="quarter">

                                <select name="filename" id="filename" class="full">
                                    <?php foreach ( $files as $name ): ?>
                                        <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td class="quarter">
                                <label for="options-enclosure"><?php echo __( 'Enclosure character' ); ?></label>
                            </td>
                            <td class="quarter">
                                <select name="options[enclosure]" id="options-enclosure" class="full">
                                    <option value='doublequote' <?php echo ('doublequote'===$options['enclosure']) ? ' selected="selected"' : '';?>><?php echo ('Double quote') . ' - "'; ?></option>
                                    <option value='singlequote' <?php echo ('singlequote'===$options['enclosure']) ? ' selected="selected"' : '';?>><?php echo ('Single quote') . " - '"; ?></option>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td class="quarter">

                            </td>
                            <td class="quarter">

                            </td>
                            <td class="quarter">
                                <label for="options-escape"><?php echo __( 'Escape character ' ); ?></label>
                            </td>
                            <td class="quarter">
                                <select name="options[escape]" id="options-escape" class="full">
                                    <option value='doublequote'  <?php echo ('doublequote'===$options['escape']) ? ' selected="selected"' : '';?>><?php echo ('Double quote') . ' - "'; ?></option>
                                    <option value='singlequote' <?php echo ('singlequote'===$options['escape']) ? ' selected="selected"' : '';?>><?php echo ('Single quote') . " - '"; ?></option>
                                    <option value='backslash' <?php echo ('backslash'===$options['escape']) ? ' selected="selected"' : '';?>><?php echo ('Backslash') . ' - \\'; ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="quarter">

                            </td>
                            <td class="quarter">

                            </td>
                            <td class="quarter">
                                <label for="options-encoding"><?php echo __( 'File character encoding' ); ?></label>
                            </td>
                            <td class="quarter">
                                <select name="options[encoding]" id="options-encoding" class="full">
                                    <?php foreach ( CsvImportController::$encodings as $name => $description ): ?>
                                        <option value="<?php echo $name; ?>" <?php echo ($name===$options['encoding']) ? ' selected="selected"' : '';?>><?php echo $description; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="quarter">

                            </td>
                            <td class="quarter">

                            </td>
                            <td class="quarter">
                                <label for="options-file_locale"><?php echo __( 'File language' ); ?></label>
                            </td>
                            <td class="quarter">
                                <select class="full"  onchange="javascript:$('#options-file_locale').val( $(this).val() + '.UTF-8' )">

                                    <?php foreach ( CsvImportController::$locales as $name => $description ): ?>
                                    <option value="<?php echo $description; ?>" <?php echo (substr($description,0,5)===substr($options['file_locale'],0,5)) ? ' selected="selected"' : '';?>><?php echo $description; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <br/>
                                <input name="options[file_locale]" id="options-file_locale" class="full" value="<?php echo $options['file_locale']?>"/>
                            </td>
                        </tr>




                        <tr>
                            <td colspan="4">
                                <h4><?php echo __( 'Page creation options' ); ?></h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label><?php echo __( 'Parent page' ) ?></label>
                            </td>
                            <td colspan="3">
                                <select name="parent_page_id" id="csv_import-pageslist" class="full">
                                    <option disabled="disabled"><?php echo __( 'Root page' ); ?></option>
                                    <?php foreach ( $pagesList as $k ): ?>
                                        <option value="<?php echo $k['id'] ?>"<?php echo ($k['id'] == $_POST['parent_page_id']) ? ' selected="selected"' : ''; ?>><?php echo $k['label'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="quarter">
                                <label for="options-layout_id"><?php echo __( 'Layout' ); ?></label>
                            </td>
                            <td class="quarter">
					<select name="options[layout_id]" id="options-layout_id" class="full" >
						<option value="0">&#8212; <?php echo __('inherit'); ?> &#8212;</option>
					<?php foreach ($layouts as $layout): ?>
						<option value="<?php echo $layout->id; ?>"<?php echo $options['layout_id'] == $layout->id ? ' selected="selected"': ''; ?>><?php echo $layout->name; ?></option>
					<?php endforeach; ?>
					</select>
                            </td>
                            <td class="quarter">
                                <label for="options-status_id"><?php echo __( 'Status' ); ?></label>
                            </td>
                            <td class="quarter">
					<select name="options[status_id]" class="full">
						<option value="<?php echo Page::STATUS_DRAFT; ?>"<?php echo $options['status_id'] == Page::STATUS_DRAFT ? ' selected="selected"': ''; ?>><?php echo __('Draft'); ?></option>
						<option value="<?php echo Page::STATUS_PREVIEW; ?>"<?php echo $options['status_id'] == Page::STATUS_PREVIEW ? ' selected="selected"': ''; ?>><?php echo __('Preview'); ?></option>
						<option value="<?php echo Page::STATUS_PUBLISHED; ?>"<?php echo $options['status_id'] == Page::STATUS_PUBLISHED ? ' selected="selected"': ''; ?>><?php echo __('Published'); ?></option>
						<option value="<?php echo Page::STATUS_HIDDEN; ?>"<?php echo $options['status_id'] == Page::STATUS_HIDDEN ? ' selected="selected"': ''; ?>><?php echo __('Hidden'); ?></option>
						<option value="<?php echo Page::STATUS_ARCHIVED; ?>"<?php echo $options['status_id'] == Page::STATUS_ARCHIVED ? ' selected="selected"': ''; ?>><?php echo __('Archived'); ?></option>
					</select>

                            </td>
                        </tr>
                        <tr>
                            <td class="quarter">
                                <label for="options-needs_login"><?php echo __( 'Login' ); ?></label>
                            </td>
                            <td class="quarter">
                                    <select name="options[needs_login]" title="" class="full">
                                        <option value="2"<?php echo $options['needs_login'] == '2' ? ' selected="selected"': ''; ?>>&#8212; <?php echo __( 'inherit' ); ?> &#8212;</option>
                                        <option value="0"<?php echo $options['needs_login'] == '0' ? ' selected="selected"': ''; ?>><?php echo __( 'Required' ); ?></option>
                                        <option value="1"<?php echo $options['needs_login'] == '1' ? ' selected="selected"': ''; ?>><?php echo __( 'Not required' ); ?></option>
                                    </select>
                            </td>
                            <td class="quarter">
                                <label for="options-is_protected"><?php echo __( 'Protected' ); ?></label>
                            </td>
                            <td class="quarter">
                                    <select name="options[is_protected]" title="" class="full">
                                        <option value="0"<?php echo $options['is_protected'] == '0' ? ' selected="selected"': ''; ?>><?php echo __( 'No' ); ?></option>
                                        <option value="1"<?php echo $options['is_protected'] == '1' ? ' selected="selected"': ''; ?>><?php echo __( 'Yes' ); ?></option>
                                    </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="quarter">
                                <label for="options-create_empty_parts"><?php echo __( 'Empty cells treatment' ); ?></label>
                            </td>
                            <td class="quarter">
                                    <select name="options[create_empty_parts]" title="" class="full">
                                        <option value="1"<?php echo $options['create_empty_parts'] == '1' ? ' selected="selected"': ''; ?>><?php echo __( 'Create empty page parts' ); ?></option>
                                        <option value="0"<?php echo $options['create_empty_parts'] == '0' ? ' selected="selected"': ''; ?>><?php echo __( 'Don\'t create page parts' ); ?></option>
                                    </select>
                            </td>
                            <td class="quarter">

                            </td>
                            <td class="quarter">

                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td class="quarter">
                <ul>
                    <?php foreach ( CsvImportController::$importablePageFields as $field ): ?>
                        <li><?php echo $field; ?></li>
                    <?php endforeach; ?>
                </ul>
            </td>
        </tr>
        <tr>
            <td class="three-quarters">
                <input type="submit" value="Preview" name="preview" />
                <input type="submit" value="Import" name="import" />
                <input type="submit" value="Save default settings" name="save_settings" />
            </td>
            <td class="quarter">
            </td>
        </tr>
    </table>


</form>
<?php
if ( $structure !== NULL ):
        $preview = new View(CsvImportController::VIEW_FOLDER.'preview', array(
            'structure' => $structure,
            ));
        $preview->display();


endif;
?>