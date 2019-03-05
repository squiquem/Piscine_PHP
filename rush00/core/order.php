<?php

    /**
     * Find and return an existing order given an id.
     *
     * @param string The order id.
     * @return array|false The order or FALSE on error.
     */
    function core_order_find_by_id($id) {
         foreach(core_order_get_all() as $order) {
             if ($order['id'] === $id) {
                 return $order;
             }
         }

         return FALSE;
    }

    /**
     * Get all orders from the order database.
     *
     * @return array|FALSE An array of orders or FALSE on error.
     */
    function core_order_get_all() {
        $db = core_db_open(CORE_DB_FILE, 'csv');
        if ($db === FALSE) {
            return FALSE;
        }

        $rows = core_db_select_rows($db, 'orders');
        if ($rows === FALSE) {
            return FALSE;
        }
        else {
            return $rows;
        }
    }

    /**
     * Add an order to the database.
     *
     * @param string The login of the emitter.
     * @param array An array of product id+qty.
     * @return bool TRUE or FALSE on error.
     */
    function core_order_add($from, $products) {
        $db = core_db_open(CORE_DB_FILE, 'csv');
        if ($db === FALSE) {
            return FALSE;
        }

        $row = [
                  'id' => uniqid(),
                'date' => time(),
                'from' => $from,
            'products' => $products,
        ];

        if (core_db_insert_row($db, 'orders', $row)) {
            return core_db_commit($db);
        }
        else {
            return FALSE;
        }
    }

?>
