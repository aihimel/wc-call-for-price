<?php
/**
 * Review Notice template
 *
 * @since 1.4.3
 */
use \WCPress\WCP\Models\ReviewModel;
?>
<div class="notice notice-info wcp-notice-for-review">
	  <div class="wcp-header">
<!--    <h4>Requesting your feedback for <span class="wcp-plugin-name">WC Call For Price</span></h4>-->
    <h4>We value your opinion! 🌟</h4>
    </div>
    <div class="wcp-body">
        <p>Your feedback means the world to us, and it's what keeps us going! 💪</p>
        <p>We're committed to providing you with the best experience possible, and we're constantly updating and improving our <a class="wcp-plugin-name" href="https://wordpress.org/plugins/wc-call-for-price" target="_blank">WC Call For Price</a> plugin to ensure it meets your needs.</p>
        <p>Your review not only helps others discover the benefits of our plugin but also motivates us to continue delivering top-notch service.</p>
        <p>If you find our plugin useful, we'd greatly appreciate it if you could take a moment to share your thoughts with us by leaving a review. It only takes a minute and means a lot to us!</p>
        <p>And remember, if you ever encounter any issues or have suggestions for new features or improvements, please don't hesitate to reach out. We're here to help and always eager to hear from you! 🚀</p>
        <p>Thank you for being part of our journey! ✨</p>
    </div>
<div class="wcp-footer">
    <a
      class="wcp-review-now"
      target="_blank"
      href="<?php echo esc_attr( wcp_review_action_url( ReviewModel::USER_STATUS__REVIEW_NOW ) ); ?>"
    >
        <?php esc_html_e( 'Review Now', 'wc-call-for-price' ); ?>
    </a>
    <a
      class="wcp-remind-me-later"
      href="<?php echo esc_attr( wcp_review_action_url( ReviewModel::USER_STATUS__REMIND_ME_LATER ) ); ?>"
    >
  		<?php esc_html_e( 'Remind Me Later', 'wc-call-for-price' ); ?>
    </a>
    <a
      class="wcp-already-reviewed"
      href="<?php echo esc_attr( wcp_review_action_url( ReviewModel::USER_STATUS__ALREADY_GIVEN ) ); ?>"
    >
  		<?php esc_html_e( 'Already Reviewed', 'wc-call-for-price' ); ?>
    </a>
    <a
      class="wcp-dismiss"
      href="<?php echo esc_attr( wcp_review_action_url( ReviewModel::USER_STATUS__NOTICE_REMOVED ) ); ?>"
    >
  		<?php esc_html_e( 'Dismiss', 'wc-call-for-price' ); ?>
    </a>
</div>
</div>

<style>
    .wcp-notice-for-review {}
    .wcp-notice-for-review .wcp-header h4 {
        font-size: 1.4em;
    }
    .wcp-notice-for-review .wcp-body .wcp-plugin-name{
        color: #1cb660;
        font-size: 1.3em;
    }
    .wcp-notice-for-review .wcp-body p {
        font-size: 1.2em;
    }
    .wcp-notice-for-review .wcp-footer {
        padding: 16px 0 32px 0;
    }
    .wcp-notice-for-review .wcp-footer a {
        padding: 8px;
        text-decoration: none;
        border: 1px solid gray;
        color: #4a5056;
        border-radius: 3px;
        margin-left: 8px;
    }

    .wcp-notice-for-review .wcp-footer a.wcp-review-now {
        border: 1px solid #4e82f1;
        background-color: #4e82f1;
        color: white;
        font-weight: 700;
    }
  .wcp-notice-for-review {}
</style>