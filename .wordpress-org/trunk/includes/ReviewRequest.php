<?php
namespace WCPress\WCP;

use DateTime;

use WCPress\WCP\Models\ReviewModel;

/**
 * Requests for review to the user
 *
 * @since 1.4.3
 */
class ReviewRequest {

	/**
	 * Initializes hooks
	 *
	 * @since 1.4.3
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'admin_notices', [ $this, 'render_notice' ] );
		add_action( 'admin_init', [ $this, 'action' ] );
	}

	/**
	 * Renders notice on the WC Call For Price settings panel
	 *
	 * @since 1.4.3
	 *
	 * @return void
	 */
	public function render_notice() {
		$review = new ReviewModel();
		$last_prompted_timestamp = $review->getLastPromptedAt();
		$current_time = new DateTime();
		$last_prompted_time = (new DateTime())->setTimestamp( $last_prompted_timestamp );
		$interval_days = ( $current_time->diff( $last_prompted_time ) )->days;
		$current_status = $review->getCurrentStatus();
		$show_review = false;
		if ( // Initial Status or Remind Me Later
			$interval_days >= 7
			&& ReviewModel::USER_STATUS__REMIND_ME_LATER === $current_status
		) {
			$show_review = true;
		} elseif ( // Notice Removed or Dismissed
			$interval_days >= 14
			&& ReviewModel::USER_STATUS__NOTICE_REMOVED === $current_status
		) {
			$show_review = true;
		} elseif ( // Already Clicked review once
			$interval_days >= 30
			&& ReviewModel::USER_STATUS__REVIEW_NOW === $current_status
		) {
			$show_review = true;
		} elseif ( // Given Review already and confirmed that
			$interval_days >= 60
			&& ReviewModel::USER_STATUS__ALREADY_GIVEN === $current_status
		) {
			$show_review = true;
		}

		if ( $show_review ) {
			wcp_get_admin_template( 'review-notice.php' );
		}
	}

	/**
	 * Processes the action taken by users
	 *
	 * @since 1.4.3
	 *
	 * @return void
	 */
	public function action() {
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}
		if ( is_admin() ) { // phpcs:ignore
			if( isset( $_GET['action'] ) ) { // phpcs:ignore
				$action = sanitize_text_field( $_GET['action'] ); // phpcs:ignore
				$review = new ReviewModel();
				$review->setReviewStatus( $action );
				$review->save();
				if ( ReviewModel::USER_STATUS__REVIEW_NOW === $action ) {
					wp_redirect( 'https://wordpress.org/support/plugin/wc-call-for-price/reviews/?filter=5#new-post' );
				}
			}
		}
	}
}
