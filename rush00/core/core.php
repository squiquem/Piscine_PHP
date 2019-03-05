<?php

    // TODO: Implement configuration file to get rid of this line
    define('CORE_DB_FILE', $_SERVER['DOCUMENT_ROOT'] . '/private/db.csv');

    date_default_timezone_set('Europe/Paris');

    include 'article.php';
    include 'categ.php';
    include 'db.php';
    include 'order.php';
    include 'user.php';

    const CORE_ERR_CREATE_FOLDER   = 1;
    const CORE_ERR_CREATE_DATABASE = 2;
    const CORE_ERR_CREATE_ACCOUNT  = 4;

    /**
     * Authenticate an user from given credentials.
     *
     * @param string The login to authenticate.
     * @param string The password to authenticate.
     * @return bool|int TRUE or an error code.
     */
    function core_authenticate_user($login, $pass) {
        $user = core_user_find_by_login($login);
        if ($user !== FALSE) {
            $hash = hash('sha256', $login . $pass);
            if ($user['pass'] === $hash) {
                return TRUE;
            }
        }

        return FALSE;
    }

    /**
     * Returns whether or not the site is ready for use.
     *
     * @return bool The status of the database.
     */
    function core_is_database_installed() {
        return file_exists(CORE_DB_FILE);
    }

    /**
     * Installs a fresh database in a preconfigured private folder.
     * Normally used only by the install.php page.
     *
     * @param string The storage format of the database.
     * @param string The login of the first account to be created.
     * @param string The password of the first account to be created.
     * @param string The email address of the first account to be created.
     * @return bool TRUE or an error code on error.
     */
    function core_install_database($type, $login, $pass, $email) {
        if  ( !file_exists(dirname(CORE_DB_FILE)) &&
              !mkdir(dirname(CORE_DB_FILE), 0770, TRUE) ) {
            return CORE_ERR_CREATE_FOLDER;
        }

        $db = core_db_open(CORE_DB_FILE, 'csv');
        if ($db === FALSE) {
            return CORE_ERR_CREATE_DATABASE;
        }

        core_db_create_table($db, 'articles');
        core_db_create_table($db, 'categs');
        core_db_create_table($db, 'orders');
        core_db_create_table($db, 'users');

        core_db_commit($db);

        if  (!core_user_add($login, $pass, $email, TRUE)) {
            return CORE_ERR_CREATE_ACCOUNT;
        }

        return TRUE;
    }

?>
