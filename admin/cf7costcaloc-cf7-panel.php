<?php

if (!defined('ABSPATH'))
  exit;



if (!class_exists('cf7costcaloc_cf7_panel')) {
    class cf7costcaloc_cf7_panel {

        protected static $instance;        

        function cf7costcaloc_editor_panels( $panels ) { 
            $paypal = array(
                'paypal-panel' => array(
                    'title' => __( 'Paypal Setting', 'contact-form-7' ),
                    'callback' => array( $this, 'cf7costcaloc_editor_panel_popup'),
                ),
            );
            $panels = array_merge($panels,$paypal);
            return $panels; 
        }


        function cf7costcaloc_editor_panel_popup() { 
            $formid = $_REQUEST['post'];
            // POPUP ADMINPANEL FORMAT
            ?>
            <h2>Paypal Settings</h2>
            <fieldset>
                <table class="paypal_main">
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label>Use Paypal</label>
                            </th>
                            <td>
                                <input type="checkbox" name="enabled_use_paypal" <?php if(get_post_meta( $formid, CF7COSTCALOCPREFIX.'enabled_use_paypal', true ) == "on"){ echo "checked"; } ?>><label>Use Paypal</label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label>Use Sandbox</label>
                            </th>
                            <td>
                                <input type="checkbox" name="enabled_use_Sandbox" <?php if(get_post_meta( $formid, CF7COSTCALOCPREFIX.'enabled_use_Sandbox', true ) == "on"){ echo "checked"; } ?>><label>Use Sandbox</label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label>PayPal Business Email</label>
                            </th>
                            <td>
                                <input type="text" name="paypal_bus_email" value="<?php echo get_post_meta( $formid, CF7COSTCALOCPREFIX.'paypal_bus_email', true );?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label>Amount</label>
                            </th>
                            <td>
                            	<?php $amount_choice = get_post_meta( $formid, CF7COSTCALOCPREFIX.'amount_choice', true ); ?>
                            	<input type="radio" name="amount_choice" value="custom" <?php if($amount_choice == "custom"){ echo "checked"; } ?>>
                            	<label>Custom Price</label>
                            	<input type="radio" name="amount_choice" value="field" <?php if($amount_choice == "field"){ echo "checked"; } ?>>
                            	<label>Field Price</label>
                                <input type="number" name="amount" value="<?php echo get_post_meta( $formid, CF7COSTCALOCPREFIX.'amount', true );?>" style="display: none;">

                                <input type="text" name="fieldamount" value="<?php echo get_post_meta( $formid, CF7COSTCALOCPREFIX.'fieldamount', true );?>" style="display: none;">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label>Quantity</label>
                            </th>
                            <td>
                            	<?php $qty_choice = get_post_meta( $formid, CF7COSTCALOCPREFIX.'qty_choice', true ); ?>
                            	<input type="radio" name="qty_choice" value="custom" <?php if($qty_choice == "custom"){ echo "checked"; } ?>>
                            	<label>Custom Quantity</label>
                            	<input type="radio" name="qty_choice" value="field" <?php if($qty_choice == "field"){ echo "checked"; } ?>>
                            	<label>Field Quantity</label>
                                <input type="number" name="quantity" value="<?php echo get_post_meta( $formid, CF7COSTCALOCPREFIX.'quantity', true );?>" style="display: none;" min="1">

                                <input type="text" name="fieldquantity" value="<?php echo get_post_meta( $formid, CF7COSTCALOCPREFIX.'fieldquantity', true );?>" style="display: none;">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label>Currency</label>
                            </th>
                            <td>
                                <?php $currency = get_post_meta( $formid, CF7COSTCALOCPREFIX.'currency', true ); ?>
                                <select name="currency">
                                    <option value="AUD" <?php if($currency == "AUD"){ echo "selected"; }?>>
                                        Australian dollar (AUD)
                                    </option>
                                    <option value="BRL" <?php if($currency == "BRL"){ echo "selected"; }?>>
                                        Brazilian real (BRL)
                                    </option>
                                    <option value="GBP" <?php if($currency == "GBP"){ echo "selected"; }?>>
                                        British pound (GBP)
                                    </option>
                                    <option value="CAD" <?php if($currency == "CAD"){ echo "selected"; }?>>
                                        Canadian dollar (CAD)
                                    </option>
                                    <option value="CZK" <?php if($currency == "CZK"){ echo "selected"; }?>>
                                        Czech koruna (CZK)
                                    </option>
                                    <option value="DKK" <?php if($currency == "DKK"){ echo "selected"; }?>>
                                        Danish krone (DKK)
                                    </option>
                                    <option value="EUR" <?php if($currency == "EUR"){ echo "selected"; }?>>
                                        Euro (EUR)
                                    </option>
                                    <option value="HKD" <?php if($currency == "HKD"){ echo "selected"; }?>>
                                        Hong kong Dollar (HKD)
                                    </option>
                                    <option value="HUF" <?php if($currency == "HUF"){ echo "selected"; }?>>
                                        Hungarian forint (HUF)
                                    </option>
                                    <option value="ILS" <?php if($currency == "ILS"){ echo "selected"; }?>>
                                        Israeli new shekel (ILS)
                                    </option>
                                    <option value="JPY" <?php if($currency == "JPY"){ echo "selected"; }?>>
                                        Japanese yen (JPY)
                                    </option>
                                    <option value="MXN" <?php if($currency == "MXN"){ echo "selected"; }?>>
                                        Mexican peso (MXN)
                                    </option>
                                    <option value="TWD" <?php if($currency == "TWD"){ echo "selected"; }?>>
                                        New Taiwan dollar (TWD)
                                    </option>
                                    <option value="NZD" <?php if($currency == "NZD"){ echo "selected"; }?>>
                                        New Zealand dollar (NZD)
                                    </option>
                                    <option value="NOK" <?php if($currency == "NOK"){ echo "selected"; }?>>
                                        Norwegian krone (NOK)
                                    </option>
                                    <option value="PHP" <?php if($currency == "PHP"){ echo "selected"; }?>>
                                        Philippine peso (PHP)
                                    </option>
                                    <option value="PLN" <?php if($currency == "PLN"){ echo "selected"; }?>>
                                        Polish złoty (PLN)
                                    </option>
                                    <option value="RUB" <?php if($currency == "RUB"){ echo "selected"; }?>>
                                        Russian ruble (RUB)
                                    </option>
                                    <option value="SGD" <?php if($currency == "SGD"){ echo "selected"; }?>>
                                        Singapore dollar (SGD)
                                    </option>
                                    <option value="SEK" <?php if($currency == "SEK"){ echo "selected"; }?>>
                                        Swedish krona (SEK)
                                    </option>
                                    <option value="CHF" <?php if($currency == "CHF"){ echo "selected"; }?>>
                                        Swiss franc (CHF)
                                    </option>
                                    <option value="THB" <?php if($currency == "THB"){ echo "selected"; }?>>
                                        Thai baht (THB)
                                    </option>
                                    <option value="USD" <?php if($currency == "USD"){ echo "selected"; }?>>
                                        US dollar (USD)
                                    </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label>Success Return URL</label>
                            </th>
                            <td>
                                <input type="text" name="suc_url" value="<?php echo get_post_meta( $formid, CF7COSTCALOCPREFIX.'suc_url', true );?>">
                            </td>
                        </tr> 
                        <tr>
                            <th scope="row">
                                <label>Cancel Return URL (Optional)</label>
                            </th>
                            <td>
                                <input type="text" name="can_url" value="<?php echo get_post_meta( $formid, CF7COSTCALOCPREFIX.'can_url', true );?>">
                            </td>
                        </tr> 
                    </tbody>
                </table>
            </fieldset>
            
            <?php 
        }

        
        function cf7costcaloc_after_save( $instance ) { 
    
            $formid = $instance->id;

        
            $enabled_use_paypal = sanitize_text_field($_POST['enabled_use_paypal']);
            update_post_meta( $formid, CF7COSTCALOCPREFIX.'enabled_use_paypal', $enabled_use_paypal );

            $enabled_use_Sandbox = sanitize_text_field($_POST['enabled_use_Sandbox']);
            update_post_meta( $formid, CF7COSTCALOCPREFIX.'enabled_use_Sandbox', $enabled_use_Sandbox );

            $paypal_bus_email = sanitize_text_field($_POST['paypal_bus_email']);
            update_post_meta( $formid, CF7COSTCALOCPREFIX.'paypal_bus_email', $paypal_bus_email );

            $amount_choice = sanitize_text_field($_POST['amount_choice']);
            update_post_meta( $formid, CF7COSTCALOCPREFIX.'amount_choice', $amount_choice );

            $amount = sanitize_text_field($_POST['amount']);
            update_post_meta( $formid, CF7COSTCALOCPREFIX.'amount', $amount );

            $fieldamount = sanitize_text_field($_POST['fieldamount']);
            update_post_meta( $formid, CF7COSTCALOCPREFIX.'fieldamount', $fieldamount );

            $qty_choice = sanitize_text_field($_POST['qty_choice']);
            update_post_meta( $formid, CF7COSTCALOCPREFIX.'qty_choice', $qty_choice );

            $quantity = sanitize_text_field($_POST['quantity']);
            update_post_meta( $formid, CF7COSTCALOCPREFIX.'quantity', $quantity );

            $fieldquantity = sanitize_text_field($_POST['fieldquantity']);
            update_post_meta( $formid, CF7COSTCALOCPREFIX.'fieldquantity', $fieldquantity );

            $currency = sanitize_text_field($_POST['currency']);
            update_post_meta( $formid, CF7COSTCALOCPREFIX.'currency', $currency );

            $suc_url = sanitize_text_field($_POST['suc_url']);
            update_post_meta( $formid, CF7COSTCALOCPREFIX.'suc_url',$suc_url );

            $can_url = sanitize_text_field($_POST['can_url']);
            update_post_meta( $formid, CF7COSTCALOCPREFIX.'can_url', $can_url );
        }


        function save_application_form( $wpcf7 ) {
            $submission = WPCF7_Submission::get_instance();
            $files = $submission->uploaded_files();

            $upload_dir    = wp_upload_dir();
            $cf7costcaloc_dirname = $upload_dir['basedir'].'/cf7costcaloc_uploads';
            $time_now      = time();
            foreach ($files as $file_key => $file) {
                copy($file, $cf7costcaloc_dirname.'/'.$time_now.'-'.basename($file));         
            }
            $_SESSION['image_name'] = $time_now.'-'.basename($file);
        }


        function cf7costcaloc_ajax_json_echo( $response, $result ) {
            global $wpdb;
            $table_name    = $wpdb->prefix.'cf7costcaloc_forms';
            $time_now      = time();

            $form = WPCF7_Submission::get_instance();

            if ( $form ) {

                $black_list   = array('_wpcf7', '_wpcf7_version', '_wpcf7_locale', '_wpcf7_unit_tag',
                '_wpcf7_is_ajax_call','cfdb7_name', '_wpcf7_container_post','_wpcf7cf_hidden_group_fields',
                '_wpcf7cf_hidden_groups', '_wpcf7cf_visible_groups', '_wpcf7cf_options','g-recaptcha-response');

                $data           = $form->get_posted_data();
                $files          = $form->uploaded_files();


                $uploaded_files = array();
                foreach ($files as $file_key => $file) {
                    array_push($uploaded_files, $file_key);
                }

                $form_data   = array();
                $form_data['cf7costcaloc_status'] = 'unread';
                foreach ($data as $key => $d) {
                   
                    $matches = array();

                    if ( !in_array($key, $black_list ) && !in_array($key, $uploaded_files ) && empty( $matches[0] ) ) {

                        $tmpD = $d;

                        if ( ! is_array($d) ){

                            $bl   = array('\"',"\'",'/','\\','"',"'");
                            $wl   = array('&quot;','&#039;','&#047;', '&#092;','&quot;','&#039;');

                            $tmpD = str_replace($bl, $wl, $tmpD );
                        }

                        $form_data[$key] = $tmpD;
                    }
                    if ( in_array($key, $uploaded_files ) ) {
                        $form_data[$key.'cf7costcaloc_file'] = $_SESSION['image_name'];
                    }
                }

                

                $form_post_id = $result['contact_form_id'];
                $form_value   = serialize( $form_data );
                $form_date    = current_time('Y-m-d H:i:s');

                $wpdb->insert( $table_name, array(
                    'form_post_id' => $form_post_id,
                    'form_value'   => $form_value,
                    'form_date'    => $form_date
                ) );

                $insert_id = $wpdb->insert_id;
            }

            $formid              = $result['contact_form_id'];
            $enabled_use_paypal  = get_post_meta( $formid, CF7COSTCALOCPREFIX.'enabled_use_paypal', true );
            $enabled_use_Sandbox = get_post_meta( $formid, CF7COSTCALOCPREFIX.'enabled_use_Sandbox', true );
            $paypal_bus_email    = get_post_meta( $formid, CF7COSTCALOCPREFIX.'paypal_bus_email', true );
            $amount_choice       = get_post_meta( $formid, CF7COSTCALOCPREFIX.'amount_choice', true );
            $qty_choice          = get_post_meta( $formid, CF7COSTCALOCPREFIX.'qty_choice', true );
            $currency            = get_post_meta( $formid, CF7COSTCALOCPREFIX.'currency', true );
            $suc_url             = get_post_meta( $formid, CF7COSTCALOCPREFIX.'suc_url', true );
            $can_url             = get_post_meta( $formid, CF7COSTCALOCPREFIX.'can_url', true );

            if($enabled_use_Sandbox == "on"){
                $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
                define("USE_SANDBOX", 1);
            }else{
                $paypal_url = "https://www.paypal.com/cgi-bin/webscr";
                define("USE_SANDBOX", 0);
            }

            if($amount_choice == "custom"){
            	$amount              = get_post_meta( $formid, CF7COSTCALOCPREFIX.'amount', true );
            }else{
            	$field               = get_post_meta( $formid, CF7COSTCALOCPREFIX.'fieldamount', true );
            	$amount				 = $data[$field];
            }

            if($qty_choice == "custom"){
            	$quantity            = get_post_meta( $formid, CF7COSTCALOCPREFIX.'quantity', true );
            }else{
            	$fieldquantity       = get_post_meta( $formid, CF7COSTCALOCPREFIX.'fieldquantity', true );
            	$quantity				 = $data[$fieldquantity];
            }

            if(empty($quantity)){
            	$quantity = 1;
            }

            $final_price = $quantity * $amount;

            $response[ 'enabled_use_paypal' ]  = $enabled_use_paypal;
            $response[ 'paypal_url' ]          = $paypal_url;
            $response[ 'paypal_bus_email' ]    = $paypal_bus_email;
            $response[ 'suc_url' ]             = $suc_url;
            $response[ 'can_url' ]             = $can_url;
            $response[ 'can_url' ]             = $can_url;
            $html =  '<form action="'.$paypal_url.'" id="cf7costcaloc_paypal" method="post" target="_top">';
            $html .= "<input type='hidden' name='business' value='".$paypal_bus_email."'>";
            $html .= "<input type='hidden' name='item_name' value='Camera'> ";
            $html .= "<input type='hidden' name='item_number' value='CAM#'> ";
            $html .= "<input type='hidden' name='amount' value='".$final_price."'> ";
            $html .= "<input type='hidden' name='no_shipping' value='1'> ";
            $html .= "<input type='hidden' name='currency_code' value='".$currency."'> ";
            $html .= "<input type='hidden' name='notify_url' value='".admin_url( 'admin-ajax.php' )."?action=paypal_callback'>";
            $html .= "<input type='hidden' name='cancel_return' value='".$can_url."'>";
            $html .= "<input type='hidden' name='return' value='".$suc_url."'>";
            $html .= "<input type='hidden' name='cmd' value='_xclick'> ";
            $html .= "<input type='hidden' name='custom' value='".$insert_id."'> ";
            $html .= "</form>";
            $response[ 'paypal_form' ]          = $html;
            return $response;
        }


        function cf7costcaloc_footer() {
            ?>
            <script>
                document.addEventListener( 'wpcf7mailsent', function( event ) {
                    var enabled_use_paypal  = event.detail.apiResponse.enabled_use_paypal;
                    if(enabled_use_paypal == "on"){
                        var paypal_form = event.detail.apiResponse.paypal_form;
                        jQuery('body').append(paypal_form);
                        setTimeout(function() {
                            jQuery( "#cf7costcaloc_paypal" ).submit();
                        }, 2000);
                    }
                }, false );

            </script>
            <?php
        }


        function cf7costcaloc_paypal_callback() {

            $ipn_response = !empty($_POST) ? $_POST : false;
            

            if (!$ipn_response) {
                wp_die( "Empty PayPal IPN Request", "PayPal IPN", array( 'response' => 200 ) );
                return;
            }

            if(USE_SANDBOX == true) {
                $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
            } else {
                $paypal_url = "https://www.paypal.com/cgi-bin/webscr";
            }

            $validate_ipn = array('cmd' => '_notify-validate');
            $validate_ipn += stripslashes_deep($ipn_response);
            // Send back post vars to paypal
            $params = array(
                'body' => $validate_ipn,
                'sslverify' => false,
                'timeout' => 60,
                'httpversion' => '1.1',
                'compress' => false,
                'decompress' => false,
                'user-agent' => 'WP PayPal/' . CF7WPAY_PAYPAL_VERSION
            );
            $response = wp_remote_post($paypal_url, $params);

            $ipn_verified = false;

            if (!is_wp_error($response) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 && strstr($response['body'], 'VERIFIED')) {
                header( 'HTTP/1.1 200 OK' );
                $ipn_verified = true;




                $item_name        = sanitize_text_field( $ipn_response['item_name'] );
                $item_number      = sanitize_text_field( $ipn_response['item_number'] );
                $payment_status   = sanitize_text_field( $ipn_response['payment_status'] );
                $payment_amount   = sanitize_text_field( $ipn_response['mc_gross'] );
                $payment_currency = sanitize_text_field( $ipn_response['mc_currency'] );
                $txn_id           = sanitize_text_field( $ipn_response['txn_id'] );
                $receiver_email   = sanitize_text_field( $ipn_response['receiver_email'] );
                $payer_email      = sanitize_text_field( $ipn_response['payer_email'] );
                $form_id          = sanitize_text_field( $ipn_response['custom'] );
              
           

                update_post_meta($form_id,CF7COSTCALOCPREFIX.'item_name',$item_name);
                update_post_meta($form_id,CF7COSTCALOCPREFIX.'item_number',$item_number);
                update_post_meta($form_id,CF7COSTCALOCPREFIX.'payment_status',$payment_status);


                update_post_meta($form_id,CF7COSTCALOCPREFIX.'payment_amount',$payment_amount);
                update_post_meta($form_id,CF7COSTCALOCPREFIX.'payment_currency',$payment_currency);
                update_post_meta($form_id,CF7COSTCALOCPREFIX.'txn_id',$txn_id);


                update_post_meta($form_id,CF7COSTCALOCPREFIX.'receiver_email',$receiver_email);
                update_post_meta($form_id,CF7COSTCALOCPREFIX.'payer_email',$payer_email);
                    
            }      
               
        }


        function init() {   
            add_filter( 'wpcf7_editor_panels', array( $this, 'cf7costcaloc_editor_panels'), 10, 1 ); 
            add_action( 'wpcf7_after_save', array( $this, 'cf7costcaloc_after_save'), 10, 1 ); 
            add_action( 'wpcf7_before_send_mail', array( $this, 'save_application_form'));
            add_filter( 'wpcf7_ajax_json_echo', array( $this, 'cf7costcaloc_ajax_json_echo'), 20, 2 );
            add_action( 'wp_footer', array($this, 'cf7costcaloc_footer' ));
            add_action( 'wp_ajax_paypal_callback', array($this, 'cf7costcaloc_paypal_callback' ));
            add_action( 'wp_ajax_nopriv_paypal_callback', array($this, 'cf7costcaloc_paypal_callback' ));
        }


        public static function instance() {
            if (!isset(self::$instance)) {
                self::$instance = new self();
                self::$instance->init();
            }
            return self::$instance;
        }
    }
    cf7costcaloc_cf7_panel::instance();
}













