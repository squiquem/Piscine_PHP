<?php

    /**
     * Find an category from a given name.
     *
     * @param string The name of the category.
     * @return array|FALSE The category or FALSE on error.
     */
    function core_categ_find_by_name($name) {
        // FIXME: Stub

        return [
            'name' => 'Clothing',
            'desc' => 'Some clothing',
        ];
    }

    /**
     * Get all categories from the category database.
     *
     * @return array|FALSE An array of categories or FALSE on error.
     */
    function core_categ_get_all() {
        // FIXME: Stub

        return [
            0 => [
                'name' => 'Clothing',
                 'desc' => 'Some clothing',
            ],
            1 => [
                'name' => 'D.I.Y',
                 'desc' => 'For the house',
            ]
        ];
    }

    /**
     * Add an category to the category database.
     *
     * @param string The name of the category.
     * @param string The description of the category.
     * @return bool TRUE or FALSE on error.
     */
    function core_categ_add($name, $desc) {
        $db = core_db_open(CORE_DB_FILE, 'csv');
        if ($db === FALSE) {
            return FALSE;
        }

        $row = [
                 'name' => $name,
                 'desc' => $desc,
        ];

        if (core_db_insert_row($db, 'categs', $row)) {
            return core_db_commit($db);
        }
        else {
            return FALSE;
        }
    }

?>
