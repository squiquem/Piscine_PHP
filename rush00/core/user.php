<?php

    /**
     * Find and return an existing user from a given login.
     *
     * @param string The login of the user to find.
     * @return array|FALSE The user or FALSE on error.
     */
    function core_user_find_by_login($login) {
        foreach (core_user_get_all() as $user) {
            if ($user['login'] === $login) {
                return $user;
            }
        }

        return FALSE;
    }

    /**
     * Get all users from the database.
     *
     * @return array|FALSE An array of users or FALSE on error.
     */
    function core_user_get_all() {
        $db = core_db_open(CORE_DB_FILE, 'csv');
        if ($db === FALSE) {
            return FALSE;
        }

        $rows = core_db_select_rows($db, 'users');
        if ($rows === FALSE) {
            return FALSE;
        }
        else {
            return $rows;
        }
    }

    /**
     * Add an user to the database.
     *
     * @param string The login of the user.
     * @param string The password of the user.
     * @param string The e-mail address of the user.
     * @param bool Whether or not the user is an admin.
     * @return bool TRUE or FALSE on error.
     */
    function core_user_add($login, $pass, $email, $is_admin) {
        $db = core_db_open(CORE_DB_FILE, 'csv');
        if ($db === FALSE) {
            return FALSE;
        }

        $row = [
               'login' => $login,
                'pass' => hash('sha256', $login . $pass),
               'email' => $email,
            'is_admin' => $is_admin
        ];

        if (core_db_insert_row($db, 'users', $row)) {
            return core_db_commit($db);
        }
        else {
            return FALSE;
        }
    }

?>
