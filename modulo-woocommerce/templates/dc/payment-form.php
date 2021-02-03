<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$fields      = array();
$order_total = $this->get_order_total();
$request_uri = $_SERVER['REQUEST_URI'];

$default_fields = array(
	'card-number-field'      => '<p class="form-row form-row-wide">
    <label for="maxipago-card-number" style="font-size: 1.20em;">Número do cartão<span class="required">*</span></label>
    <input id="maxipago-card-number" name="maxipago_card_dc_number" class="input-text wc-credit-card-form-card-number" inputmode="numeric" autocomplete="cc-number" autocorrect="no" autocapitalize="no" spellcheck="no" type="tel" style="font-size: 1.5em; padding: 8px;" placeholder="&bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull;" />
</p>',
	'card-holder-name-field' => '<p class="form-row form-row-wide">
    <label for="maxipago-holder-name" style="font-size: 1.20em;">Nome como exibido no cartão <span class="required">*</span></label>
    <input id="maxipago-holder-name" name="maxipago_holder_dc_name" class="input-text wc-credit-card-form-card-holder-name" autocomplete="cc-holder" autocorrect="no" autocapitalize="no" spellcheck="no" style="font-size: 1.5em; padding: 8px;" />
</p>',
	'card-expiry-field'      => '<p class="form-row form-row-first">
    <label for="maxipago-card-expiry" style="font-size: 1.20em;">Vencimento <span class="required">*</span></label>
    <input id="maxipago-card-expiry" name="maxipago_card_dc_expiry" class="input-text wc-credit-card-form-card-expiry" inputmode="numeric" autocomplete="cc-exp" autocorrect="no" autocapitalize="no" spellcheck="no" type="tel" style="font-size: 1.5em; padding: 8px;" placeholder="MM/YY" />
</p>',
	'card-cvc-field'         => '<p class="form-row form-row-last">
    <label for="maxipago-card-cvc" style="font-size: 1.20em;">CVV <span class="required">*</span></label>
    <input id="maxipago-card-cvc" name="maxipago_card_dc_cvc" class="input-text wc-credit-card-form-card-cvc" inputmode="numeric" autocomplete="off" autocorrect="no" autocapitalize="no" spellcheck="no" type="tel" maxlength="4" placeholder="CVV" style="font-size: 1.5em; padding: 8px;" />
</p>'
);
$fields         = wp_parse_args( $fields,
	apply_filters( 'woocommerce_credit_card_form_fields', $default_fields, $this->id ) );
?>

<fieldset id="wc-<?php echo esc_attr( $this->id ); ?>-cc-form" class='wc-credit-card-form wc-payment-form '>
	<?php
	do_action( 'woocommerce_credit_card_form_start', $this->id );
	foreach ( $fields as $key => $field ) {
		if ( strpos( $request_uri, 'add-payment-method' ) !== false &&
		     ( $key == 'card-installments-field' || $key == 'card-holder-name-field' || $key == 'card-cvc-field' )
		) {
			continue;
		} elseif ( $key == 'card-installments-field' ) {
			echo '<input type="hidden" name="maxipago_installments" value="1"/>';
		} else {
			echo $field;
		}
	}
	do_action( 'woocommerce_credit_card_form_end', $this->id );
	?>

    <p class="form-row form-row-wide">
        <label for="maxipago-cc-document">CPF/CNPJ <span
                    class="required">*</span></label>
        <input id="maxipago-cc-document" name="maxipago_dc_document" class="input-text" type="tel" inputmode="numeric"
               maxlength="20" autocomplete="off" style="font-size: 1.5em; padding: 8px;"/>
    </p>
    <div class="clear"></div>
</fieldset>