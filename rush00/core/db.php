<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    /**
     * Open an instance of a database, which
     * will be created if it does not exist.
     *
     * @param string path The path to the file.
     * @param string type The type (csv).
     * @return array|FALSE Resource or error code on error.
     */
    function core_db_open($path, $type) {
        switch ($type) {
            case 'csv':
                if (!file_exists($path)) {
                    touch($path);
                }

                $text = file_get_contents($path);
                if ($text === FALSE) {
                    return FALSE;
                }

                if (!empty($text)) {
                    $ctx = unserialize($text);
                    if ($ctx === FALSE) {
                        return FALSE;
                    }
                }
                else {
                    $ctx = [];
                }

                return [
                       'ctx' => $ctx,
                      'path' => $path,
                      'type' => $type
                ];

                break ;

            default :
                break ;
        }

        return FALSE;
    }

    /**
     * Close an instance of a database.
     *
     * @param array The resource handle.
     * @return bool TRUE or FALSE on error.
     */
    function core_db_close($res) {
        switch ($res['type']) {
            case 'csv':
                return TRUE;
                break ;

            default :
                break ;
        }

        return FALSE;
    }

    /**
     * Flush the changes made to the database.
     *
     * @param array The resource handle.
     * @return bool TRUE or FALSE on error.
     */
    function core_db_commit($res) {
        switch ($res['type']) {
            case 'csv':
                if (file_put_contents($res['path'], serialize($res['ctx']))) {
                    return TRUE;
                }
                break ;

            default :
                break ;
        }

        return FALSE;
    }

    /**
     * Create a table in a given database.
     *
     * @param array The resource handle.
     * @param string The name of the table.
     * @return bool TRUE or FALSE on error.
     */
    function core_db_create_table(&$res, $name) {
        switch ($res['type']) {
            case 'csv':
                if (!array_key_exists($name, $res['ctx'])) {
                    $res['ctx'][$name] = [];
                    return TRUE;
                }
                break ;

            default :
                break ;
        }

        return FALSE;
    }

    /**
     * Insert a row into a table in a given database.
     *
     * @param array The resource handle.
     * @param string The name of the table.
     * @param array The row to insert.
     * @return bool TRUE or FALSE on error.
     */
    function core_db_insert_row(&$res, $table, $row) {
        switch ($res['type']) {
            case 'csv':
                if (array_key_exists($table, $res['ctx'])) {
                    $res['ctx'][$table][] = $row;
                    return TRUE;
                }
                break ;

            default :
                break ;
        }

        return FALSE;
    }

    /**
     * Return all the rows in a database's given table.
     *
     * @param array The resource handle.
     * @param string the name of the table.
     * @return bool TRUE or FALSE on error.
     */
    function core_db_select_rows($res, $table) {
        switch ($res['type']) {
            case 'csv':
                if (array_key_exists($table, $res['ctx'])) {
                    return $res['ctx'][$table];
                }
                break ;

            default :
                break ;
        }

        return FALSE;
    }

?>
