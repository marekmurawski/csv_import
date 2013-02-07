<?php

/* Security measure */
if (!defined('IN_CMS')) { exit(); }


Plugin::setInfos(array(
    'id'          => 'csv_import',
    'title'       => __('CSV Spreadsheet Import'),
    'description' => __('Import .csv, .tsv and .txt spreadsheet files into Wolf CMS pages and parts'),
    'version'     => '0.0.1',
   	'license'     => 'GPL',
	'author'      => 'Marek Murawski',
    'website'     => 'http://marekmurawski.pl/',
    'update_url'  => 'http://marekmurawski.pl/static/wolfplugins/plugin-versions.xml',
    'require_wolf_version' => '0.7.3'
));

Plugin::addController('csv_import', __('CSV Import'), 'admin_edit', true);