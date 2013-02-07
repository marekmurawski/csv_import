CSV Import for Wolf CMS
======================

Plugin for importing **.csv**, **.tsv** and **.txt** spreadsheet exported files into Wolf CMS pages and parts.

This plugin provides a convenient way to import **Excel** / **Open Office Calc** table into Wolf CMS. All you need to do is export the spreadsheet to one of supported **.csv**, **.tsv** or **.txt** formats, upload the file to **[CMS_ROOT]/public"** folder and tweak some import settings like:

- column **delimeter** character _(usually a comma, semicolon or tabulator)_
- cell contents **enclosure** character _(usually double- or single-quote)_
- **escape character** _(usually backslash but Excel seems to use double quote)_
- **character encoding** _(like WINDOWS-1252, ISO-8859-2, etc.)_
- imported file **locale** _(like pl_PL, en_US, de_AT, etc.)_

If the first row of your table contains one of the following fields:

- slug - **required** _(and only rows with unique slugs will be imported)_
- title
- breadcrumb
- keywords
- description
- created_on
- published_on
- valid_until
- tags

The Page properties will be set accordingly to those fields. Any other properly named _(english letters + digits)_ columns will be added as **Page Parts**.

Adjusting those settings will most likely lead to valid table interpretation. If everything is OK you can import new pages and page parts.

Installation
------------

CSV Import Plugin can be installed into your WolfCMS by uploading it to ***CMS_ROOT/wolf/plugins/csv_import/*** and enabling it in administration panel.

Changelog
---------

0.0.1

- first release

License
-------

* GPLv3 license

Disclaimer
----------

While I make every effort to deliver quality plugins for Wolf CMS, I do not guarantee that they are free from defects. They are provided “as is," and you use it at your own risk. I'll be happy if you notice me of any errors.

I'm not really programmer nor web developer, however I like programming PHP and JavaScript. In fact I'm an [architekt](http://marekmurawski.pl).