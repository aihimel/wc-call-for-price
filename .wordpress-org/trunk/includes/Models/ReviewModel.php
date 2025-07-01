<?php
namespace WCPress\WCP\Models;

use DateTime;

use WCPress\WCP\Constants;


/**
 * For managing review related data
 */
class ReviewModel extends Model {

	/**
	 * Key to save the options
	 *
	 * @since 1.4.3
	 */
	const OPTION_KEY = 'wcp_plugin_review_request';
	/**
	 * Is review requested at least once
	 *
	 * @since 1.4.3
	 */
	const REVIEW_REQUESTED = 'review_requested';
	/**
	 * Last review request shown
	 *
	 * @since 1.4.3
	 */
	const LAST_PROMPTED_AT = 'last_prompted_at';
	/**
	 * Total number of shown requests
	 *
	 * @since 1.4.3
	 */
	const TOTAL_SHOWN = 'total_shown';
	/**
	 * Response of the user
	 *
	 * @since 1.4.3
	 */
	const USER_RESPONSE = 'user_response';

	/**
	 * List of statuses
	 *
	 * @since 1.4.3
	 */
	const USER_STATUS__REVIEW_NOW = 'review_now'; // User inputs that review is already given
	const USER_STATUS__ALREADY_GIVEN = 'already_given'; // User inputs that review is already given
	const USER_STATUS__REMIND_ME_LATER = 'remind_me_later'; // User inputs that to remind later, also set as initial value
	const USER_STATUS__NOTICE_REMOVED = 'notice_removed'; // User clicks the cross button
	const USER_STATUS__LIST = array(
		self::USER_STATUS__REMIND_ME_LATER, // 7 Days
		self::USER_STATUS__REVIEW_NOW, // 30 Days
		self::USER_STATUS__ALREADY_GIVEN, // 180 Days
		self::USER_STATUS__NOTICE_REMOVED, // 14 Days
	);

	/**
	 * Return option key
	 *
	 * @since 1.4.3
	 *
	 * @return string
	 */
	public function get_option_key(): string {
		return self::OPTION_KEY;
	}

	/**
	 * Returns default data
	 *
	 * @since 1.4.3
	 *
	 * @return array
	 */
	public function get_default_data(): array {
		return array(
			self::REVIEW_REQUESTED => Constants::NO,
			self::LAST_PROMPTED_AT => (new Datetime())->modify('-8 days')->getTimestamp(),
			self::TOTAL_SHOWN => 0,
			self::USER_RESPONSE => self::USER_STATUS__REMIND_ME_LATER,
		);
	}

	/**
	 * Checks if review has been requested
	 *
	 * @since 1.4.3
	 *
	 * @return bool
	 */
	public function isReviewRequested(): bool {
		return Constants::YES === $this->data[ self::REVIEW_REQUESTED ];
	}

	/**
	 * Sets the user status
	 *
	 * @since 1.4.3
	 *
	 * @param string $status
	 *
	 * @return void
	 */
	public function setReviewStatus( string $status ) {
		// If user status is not known then set to remind me later
		if ( ! in_array( $status, self::USER_STATUS__LIST, true ) ) {
			$status = current( self::USER_STATUS__LIST );
		}
		$this->data[ self::USER_RESPONSE ] = $status;
		$this->data[ self::LAST_PROMPTED_AT ] = wcp_current_time();
		++$this->data[ self::TOTAL_SHOWN ];
	}

	/**
	 * Return last prompted time
	 *
	 * @since 1.4.3
	 *
	 * @return int
	 */
	public function getLastPromptedAt(): int {
		return $this->data[ self::LAST_PROMPTED_AT ];
	}

	public function getCurrentStatus(): string {
		return $this->data[ self::USER_RESPONSE ];
	}
}
