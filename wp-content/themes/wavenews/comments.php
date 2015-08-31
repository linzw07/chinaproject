<?php 
/*------------------------------------------------------------- 
		Theme Comments
-------------------------------------------------------------*/
function theme_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
     <?php $comment_time_format = theme_option(THEME_OPTIONS, 'comment_time_format'); ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment_wrap">
			<div class="gravatar"><?php echo get_avatar($comment,$size='80',$default=''); ?>
               <div class="reply">
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
            </div>
			<div class='comment_content'>
				<div class="comment_meta">
					<?php printf( '<cite class="comment_author">%s</cite>', get_comment_author_link()) ?>
                    <?php $comment_time_format = theme_option(THEME_OPTIONS, 'comment_time_format'); ?>
					<time class="comment_time"><?php echo get_comment_date($comment_time_format); ?></time>
                    <?php edit_comment_link(__('Edit Comment','theme_frontend'),'','') ?>
				</div>
				<div class='comment_text'>
					<?php comment_text() ?>
<?php if ($comment->comment_approved == '0') : ?>
<span class="unapproved"><?php _e('Your comment is awaiting moderation.','theme_frontend');?></span>
<?php endif; ?>
				</div>
			</div>
          
		</div>
<?php
}

function list_pings($comment, $args, $depth) {
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment_wrap">
            <div class='comment_content'>
				<div class="comment_meta">
					<?php printf( '<cite class="comment_author"><b>%s</b></cite>', get_comment_author_link()) ?>
				</div>
				<div class='comment_text'><?php comment_text() ?>
                    <time class="comment_time"><?php echo get_comment_date($comment_time_format); ?></time>
<?php if ($comment->comment_approved == '0') : ?> 
					<span class="unapproved">Your comment is awaiting moderation.</span>
<?php endif; ?>
				</div>
                <div class="clearboth"></div>
			</div>

<?php } ?>

<section id="comments">
<?php if ( post_password_required() ) : ?>
	<p class="nopassword"><?php _e('This post is password protected. Enter the password to view any comments.','theme_frontend');?></p>
</section><!-- #comments -->
<?php
	return;
	endif;
if ( have_comments() ) : ?>
	<h5 id="comments_title"><?php
	printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'theme_frontend' ),
	number_format_i18n( get_comments_number() ),  get_the_title() );
	?></h5>
<?php $comment_box_theme = theme_option(THEME_OPTIONS, 'comment_box_theme');	?>
	<ul class="ws-commentlist <?php echo $comment_box_theme; ?>">
		<?php
			wp_list_comments('callback=theme_comments&type=comment');
		?>
	</ul>

<?php 
if (have_comments()) : ?>
<?php if ( ! empty($comments_by_type['pings']) ) : ?>
<h5 class="pings_title" id="comments_title"><?php _e('pingbacks / trackbacks on', 'theme_frontend'); echo " "; the_title(); ?></h5>
<ul class="ws-commentlist">
<?php wp_list_comments('callback=list_pings&type=pings'); ?>
</ul>
<?php endif; endif; ?> 

<?php else :
	if ( ! comments_open() ) : endif; 
 	endif;
 ?>
 
 <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav class="comments_navigation">
		<div class="nav_previous"><?php previous_comments_link(); ?></div>
		<div class="nav_next"><?php next_comments_link(); ?></div>
	</nav>
<?php endif;?>

<?php if ( comments_open() ) : ?>

	<div id="respond">
		<h5><?php comment_form_title(__('Leave a comment','theme_frontend'), __('Leave a comment to %s','theme_frontend')); ?></h5>
        <p><?php _e('Your email address will not be published.', 'theme_frontend'); ?></p>
    	<div class="cancel_comment_reply">
        	<?php cancel_comment_reply_link(); ?>
		</div>
<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment','theme_frontend'),wp_login_url( get_permalink() )); ?></p>
<?php else : ?>
   		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<?php if ( is_user_logged_in() ) : ?>
			<span class="logged"><?php printf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','theme_frontend'), admin_url( 'profile.php' ), $user_identity, wp_logout_url( get_permalink()  ) )?></span>
<?php else : ?>	

			<div class="section_row">
            	<label for="author"><?php _e('Name (Required)','theme_frontend');?></label>
            	<input type="text" name="author" class="text_input" id="author" value="<?php echo $comment_author; ?>" tabindex="1"  />
			</div>
			<div class="section_row">
            	<label for="email"><?php _e('Email (Required)','theme_frontend');?></label>
            	<input type="text" name="email" class="text_input" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" />
			</div>
			<div class="section_row">
            	<label for="url"><?php _e('Website','theme_frontend');?></label>
            	<input type="text" name="url" class="text_input" id="url" value="<?php echo $comment_author_url; ?>"  tabindex="3" />
			</div>
<?php endif; ?>
			<div class="comment_textarea">
            	<label for="comment"><?php _e('Comment','theme_frontend');?></label>
            	<textarea class="textarea" name="comment" id="comment" tabindex="4"></textarea></div>
			<p><a class="ws-button medium comment_button href="#" onclick="jQuery('#commentform').submit();return false;"><span><?php _e('POST COMMENT','theme_frontend')?></span></a><?php comment_id_fields(); ?></p>
			<p><?php do_action('comment_form', $post->ID); ?></p>
		</form>
<?php endif; ?>
	</div><!--/respond-->
<?php endif; ?>
</section>