<?php

    /**
     * Find an article from a given name.
     *
     * @param string The name of the article.
     * @return array|FALSE The article or FALSE on error.
     */
    function core_article_find_by_name($name) {
        foreach (core_article_get_all() as $article) {
            if  ($article['name'] === $name) {
                return $article;
            }
        }

        return FALSE;
    }

    function core_article_find_by_id($id) {
        foreach (core_article_get_all() as $article) {
            if ($article['id'] === $id) {
                return $article;
            }
        }
    }

    /**
     * Get all articles from the article database.
     *
     * @return array|FALSE An array of articles or FALSE on error.
     */
    function core_article_get_all() {
        $db = core_db_open(CORE_DB_FILE, 'csv');
        if ($db === FALSE) {
            return FALSE;
        }

        $rows = core_db_select_rows($db, 'articles');
        if ($rows === FALSE) {
            return FALSE;
        }
        else {
            return $rows;
        }
    }

    /**
     * Add an article to the article database.
     *
     * @param string The name of the article.
     * @param int The price in euros of the article.
     * @param string The URL where to fetch a picture.
     * @param int The amount of articles in stock.
     * @return bool TRUE or FALSE on error.
     */
    function core_article_add($name, $price, $url, $stock) {
        $db = core_db_open(CORE_DB_FILE, 'csv');
        if ($db === FALSE) {
            return FALSE;
        }

        $row = [
                   'id' => uniqid(),
                 'name' => $name,
                'price' => $price,
                  'url' => $url,
                'stock' => $stock
        ];

        if (core_db_insert_row($db, 'articles', $row)) {
            return core_db_commit($db);
        }
        else {
            return FALSE;
        }
    }

?>
