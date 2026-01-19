<?php
/**
 * The template for displaying comments
 *
 * @package Cpfauto
 */

if (post_password_required()) {
	return;
}
?>

<div id="comments" class="comments-area mt-8">
	<?php if (have_comments()) : ?>
		<h2 class="comments-title text-2xl font-heading font-bold mb-6">
			<?php
			$comment_count = get_comments_number();
			if ('1' === $comment_count) {
				printf(
					/* translators: 1: title. */
					esc_html__('One thought on &ldquo;%1$s&rdquo;', 'cpfauto'),
					'<span>' . wp_kses_post(get_the_title()) . '</span>'
				);
			} else {
				printf(
					/* translators: 1: comment count number, 2: title. */
					esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'cpfauto')),
					number_format_i18n($comment_count),
					'<span>' . wp_kses_post(get_the_title()) . '</span>'
				);
			}
			?>
		</h2>

		<ol class="comment-list">
			<?php
			wp_list_comments(array(
				'style'      => 'ol',
				'short_ping' => true,
			));
			?>
		</ol>

		<?php
		the_comments_pagination(array(
			'prev_text' => __('&laquo; Previous', 'cpfauto'),
			'next_text' => __('Next &raquo;', 'cpfauto'),
		));
		?>

	<?php endif; ?>

	<?php
	if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
		?>
		<p class="no-comments"><?php esc_html_e('Comments are closed.', 'cpfauto'); ?></p>
		<?php
	endif;

	comment_form();
	?>
</div><!-- #comments -->
