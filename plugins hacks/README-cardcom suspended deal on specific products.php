<?php
/**
 * @author Eyal Ron
 * @company Divine Sites
 * @URI divinesites.co.il
 * @setup:
 *  1. open cardcom.php from within the cardcom WooCommerce plugin folder.
 *  2. find "$this->operationToPerform = $this->operation;" in cardcom.php:around line 557 and comment it
 *  3. add the code between the "Suspended deal" comment lines just under the commented line from 1st step.
 *  4. update $SuspendedIDs arrya ot contain the id's of the products you want to Suspend.
 */
//Suspended deal on specific products by id
        $items = $order->get_items();
        $SuspendedIDs = [91950,92330,9495];// add all sespanded deal products ID's here
        $SuspendedProduct = false;
        foreach ( $items as $item ) {
            $product_id = $item->get_product_id();
            foreach ($SuspendedIDs as $id) {
                if(in_array($product_id,$SuspendedIDs)){
                    $SuspendedProduct = true;
                    break 2;
                }
            }
        }
        if($SuspendedProduct){
            $this->operationToPerform = '4';
        }else{
            $this->operationToPerform = $this->operation;
        }
//#Suspended deal on specific products

/**
 * Optionally you can set the label of the plugin setup page in woocommerce to set the user know that for some of the products this setup will be overriden to create a suspendable deal
 * 1. find and comment the line "'title' => __( 'Operation', 'woothemes' ), --Orig title" in cardcom.php:around line 401.
 * 2. add the code below just after the commented line from 1st step
 * 3. change it to your needs
*/
'title' => __( 'Operation <div style="color:red;">except specific products defined in<br />cardcom.php:557-577, 402<br /><span style="font-size:12px;">by Divine Sites</span></div>', 'woothemes' ),
?>
