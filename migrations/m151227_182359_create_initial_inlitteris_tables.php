<?php
/*
 * This file is part of the inlitteris project.
 *
 * (c) Jo Brunner <http://github.com/jobrunner/yii2-inlitteris>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use yii\db\Migration;

/**
 * Class m151227_182359_create_initial_inlitteris_tables
 */
class m151227_182359_create_initial_inlitteris_tables extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%reference}}', [
            'id'                => $this->string(48)->notNull()->unique(),
            'referenceTypeId'   => $this->smallInteger(5)->notNull(),
            'authors'           => $this->text()->notNull()->defaultValue(''),
            'title'             => $this->text()->notNull()->defaultValue(''),
            'secondaryTitle'    => $this->text()->notNull()->defaultValue(''),
            'secondaryAuthors'  => $this->text()->notNull()->defaultValue(''),
            'tertiaryTitle'     => $this->text()->notNull()->defaultValue(''),
            'tertiaryAuthors'   => $this->text()->notNull()->defaultValue(''),
            'year'              => $this->text()->notNull()->defaultValue(''),
            'volume'            => $this->text()->notNull()->defaultValue(''),
            'number'            => $this->text()->notNull()->defaultValue(''),
            'pages'             => $this->text()->notNull()->defaultValue(''),
            'section'           => $this->text()->notNull()->defaultValue(''),
            'edition'           => $this->text()->notNull()->defaultValue(''),
            'place'             => $this->text()->notNull()->defaultValue(''),
            'publisher'         => $this->text()->notNull()->defaultValue(''),
            'isbn'              => $this->text()->notNull()->defaultValue('')
        ]);

        $this->createIndex('pk', '{{%reference}}', 'id', true);

        $this->createTable('{{%reference_type}}', [
            'id'                => $this->smallInteger()->notNull()->unique(),
            'typeName'          => $this->string(40)->notNull(),
            'visible'           => $this->boolean(),
        ]);

        $this->createIndex('pk', '{{%reference_type}}', 'id', true);

        $this->batchInsert('{{%reference_type}}', [
            'id', 'typeName', 'visible'
        ],
        [
            [0, 'Journal article', true],
            [1, 'Book',            true],
            [7, 'Book section',    true],
            [9, 'Edited book',     true]
        ]);

        $this->createTable('{{%reference_setting}}', [
            'referenceTypeId'   => $this->smallInteger()->notNull(),
            'genericName'       => $this->string(40)->notNull(),
            'contextualName'    => $this->string(40)->notNull(),
            'position'          => $this->smallInteger()->notNull()->defaultValue(0),
            'visible'           => $this->boolean()->defaultValue(true),
        ]);
        $this->createIndex('pk', '{{%reference_setting}}', ['referenceTypeId', 'genericName'], true);

        $this->batchInsert('{{%reference_setting}}', [
            'referenceTypeId', 'genericName', 'contextualName', 'position', 'visible'
        ],
        [
            // Journal Articles
            [ 0, 'authors',          'Author',             0, true],
            [ 0, 'year',             'Year',               1, true],
            [ 0, 'title',            'Title',              2, true],
            [ 0, 'secondaryTitle',   'Journal',            3, true],
            [ 0, 'place',            'Place/City',         4, true],
            [ 0, 'publisher',        'Publisher',          5, true],
            [ 0, 'volume',           'Volume',             6, true],
            [ 0, 'number',           'Issue',              7, true],
            [ 0, 'pages',            'Pages',              8, true],
            [ 0, 'section',          'Start Page',         9, false],
            [ 0, 'isbn',             'ISSN',              10, true],

            // Books
            [ 1, 'authors',          'Author',             0, true],
            [ 1, 'year',             'Year',               1, true],
            [ 1, 'title',            'Title',              2, true],
            [ 1, 'secondaryAuthors', 'Series Editor',      3, true],
            [ 1, 'secondaryTitle',   'Series Title',       4, true],
            [ 1, 'place',            'Place/City',         4, true],
            [ 1, 'publisher',        'Publisher',          5, true],
            [ 1, 'volume',           'Volume',             6, true],
            [ 1, 'number',           'Series Volume',      7, true],
            [ 1, 'pages',            'Number of Pages',    8, true],
            [ 1, 'section',          'Pages',              9, false],
            [ 1, 'tertiaryAuthors',  'Editor',            10, false],
            [ 1, 'edition',          'Edition',           11, true],
            [ 1, 'isbn',             'ISBN',              12, true],

            // Book section
            [ 7, 'authors',          'Author',            0, true],
            [ 7, 'year',             'Year',              1, true],
            [ 7, 'title',            'Title',             2, true],
            [ 7, 'secondaryAuthors', 'Editor',            3, true],
            [ 7, 'secondaryTitle',   'Book Title',        4, true],
            [ 7, 'place',            'Place/City',        5, true],
            [ 7, 'publisher',        'Publisher',         6, true],
            [ 7, 'volume',           'Volume',            7, true],
            [ 7, 'number',           'Series Volume',     8, true],
            [ 7, 'pages',            'Number of Pages',   9, true],
            [ 7, 'section',          'Chapter/Pages',    10, true],
            [ 7, 'tertiaryAuthors',  'Series Editor',    11, true],
            [ 7, 'tertiaryTitle',    'Series Title',     12, true],
            [ 7, 'edition',          'Edition',          13, true],
            [ 7, 'isbn',             'ISBN',             14, true],

            // Edited book
            [ 9, 'authors',          'Editor',             0, true],
            [ 9, 'year',             'Year',               1, true],
            [ 9, 'title',            'Book Title',         2, true],
            [ 9, 'secondaryTitle',   'Series Book Editor', 3, true],
            [ 9, 'secondaryAuthors', 'Series Book Title',  4, true],
            [ 9, 'place',            'Place/City',         5, true],
            [ 9, 'publisher',        'Publisher',          6, true],
            [ 9, 'volume',           'Volume',             7, true],
            [ 9, 'number',           'Series Volume',      8, true],
            [ 9, 'pages',            'Pages',              9, true],
            [ 9, 'edition',          'Edition',           10, true],
            [ 9, 'isbn',             'ISBN',              11, true],
        ]);
    }
    
    public function safeDown()
    {
        $this->dropTable('{{%reference_setting}}');
        $this->dropTable('{{%reference_type}}');
        $this->dropTable('{{%reference}}');
    }
}
