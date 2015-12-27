<?php

use yii\db\Migration;


class m151227_182359_create_initial_inlitteris_tables extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%reference}}', [
            'id'                => $this->string(48)->notNull()->unique(),
            'referenceTypeId'   => $this->smallInteger()->notNull(),
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



        $this->createTable('{{%reference_type}}', [
            'id'                => $this->smallInteger()->notNull()->unique(),
            'typeName'          => $this->string(40)->notNull(),
            'visible'           => $this->boolean(),
        ]);


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

        $this->batchInsert('{{%reference_setting}}', [
            'referenceTypeId', 'genericName', 'contextualName', 'position', 'visible'
        ],
        [
            // Journal Articles
            [ 0, 'authors',          'authors',           0, true],
            [ 0, 'title',            'title',             1, true],
            [ 0, 'secondaryTitle',   'secondaryTitle',    2, true],
            [ 0, 'secondaryAuthors', 'secondaryAuthors',  3, true],
            [ 0, 'tertiaryTitle',    'tertiaryTitle',     4, true],
            [ 0, 'tertiaryAuthors',  'tertiaryAuthors',   5, true],
            [ 0, 'year',             'year',              8, true],
            [ 0, 'volume',           'volume',            9, true],
            [ 0, 'number',           'number',           10, true],
            [ 0, 'pages',            'pages',            12, true],
            [ 0, 'section',          'section',          13, true],
            [ 0, 'edition',          'edition',          14, true],
            [ 0, 'place',            'place',            15, true],
            [ 0, 'publisher',        'publisher',        16, true],
            [ 0, 'isbn',             'isbn',             18, true],

            // Books
            [ 1, 'authors',          'authors',           0, true],
            [ 1, 'title',            'title',             1, true],
            [ 1, 'secondaryTitle',   'secondaryTitle',    2, true],
            [ 1, 'secondaryAuthors', 'secondaryAuthors',  3, true],
            [ 1, 'tertiaryTitle',    'tertiaryTitle',     4, true],
            [ 1, 'tertiaryAuthors',  'tertiaryAuthors',   5, true],
            [ 1, 'year',             'year',              8, true],
            [ 1, 'volume',           'volume',            9, true],
            [ 1, 'number',           'number',           10, true],
            [ 1, 'pages',            'pages',            12, true],
            [ 1, 'section',          'section',          13, true],
            [ 1, 'edition',          'edition',          14, true],
            [ 1, 'place',            'place',            15, true],
            [ 1, 'publisher',        'publisher',        16, true],
            [ 1, 'isbn',             'isbn',             18, true],

            // Book sections
            [ 7, 'authors',          'authors',           0, true],
            [ 7, 'title',            'title',             1, true],
            [ 7, 'secondaryTitle',   'secondaryTitle',    2, true],
            [ 7, 'secondaryAuthors', 'secondaryAuthors',  3, true],
            [ 7, 'tertiaryTitle',    'tertiaryTitle',     4, true],
            [ 7, 'tertiaryAuthors',  'tertiaryAuthors',   5, true],
            [ 7, 'year',             'year',              8, true],
            [ 7, 'volume',           'volume',            9, true],
            [ 7, 'number',           'number',           10, true],
            [ 7, 'pages',            'pages',            12, true],
            [ 7, 'section',          'section',          13, true],
            [ 7, 'edition',          'edition',          14, true],
            [ 7, 'place',            'place',            15, true],
            [ 7, 'publisher',        'publisher',        16, true],
            [ 7, 'isbn',             'isbn',             18, true],

            // Edited books
            [ 9, 'authors',          'authors',           0, true],
            [ 9, 'title',            'title',             1, true],
            [ 9, 'secondaryTitle',   'secondaryTitle',    2, true],
            [ 9, 'secondaryAuthors', 'secondaryAuthors',  3, true],
            [ 9, 'tertiaryTitle',    'tertiaryTitle',     4, true],
            [ 9, 'tertiaryAuthors',  'tertiaryAuthors',   5, true],
            [ 9, 'year',             'year',              8, true],
            [ 9, 'volume',           'volume',            9, true],
            [ 9, 'number',           'number',           10, true],
            [ 9, 'pages',            'pages',            12, true],
            [ 9, 'section',          'section',          13, true],
            [ 9, 'edition',          'edition',          14, true],
            [ 9, 'place',            'place',            15, true],
            [ 9, 'publisher',        'publisher',        16, true],
            [ 9, 'isbn',             'isbn',             18, true],
        ]);
    }
    
    public function safeDown()
    {
        $this->dropTable('{{%reference_setting}}');
        $this->dropTable('{{%reference_type}}');
        $this->dropTable('{{%reference}}');
    }
}
