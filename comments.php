<?php

  if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Por favor, no cargar esta página directamente. Gracias.');

  if ( post_password_required() ) {
 ?>
  	<div class="alert help">
    	<p class="nocomments">
    		<?php _e("This post is password protected. Enter the password to view comments.", "pleromatheme"); ?>
    	</p>
  	</div>
<?php
    return;
  }
?>


<?php if ( have_comments() ) : ?>
	
	<h3 id="comments" class="h2">
		<?php comments_number('<span>No</span> Responses', '<span>One</span> Response', '<span>%</span> Responses' );?> to &#8220;<?php the_title(); ?>&#8221;
	</h3>

	<nav id="comment-nav">
		<ul class="clearfix">
	  		<li><?php previous_comments_link() ?></li>
	  		<li><?php next_comments_link() ?></li>
	 	</ul>
	</nav>
	
	<ol class="commentlist">
		<?php wp_list_comments('type=comment&callback=bones_comments'); ?>
	</ol>
	
	<nav id="comment-nav">
		<ul class="clearfix">
	  		<li><?php previous_comments_link() ?></li>
	  		<li><?php next_comments_link() ?></li>
		</ul>
	</nav>



<?php endif; ?>


<?php if ( comments_open() ) : ?>

<section id="respond" class="respond-form">

	<h3 id="comment-form-title" class="h2"><?php comment_form_title( __('Leave a Reply', 'pleromatheme'), __('Leave a Reply to %s', 'pleromatheme' )); ?></h3>

	<div id="cancel-comment-reply">
		<p class="small"><?php cancel_comment_reply_link(); ?></p>
	</div>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
  	<div class="alert help">
  		<p><?php printf( 'You must be %1$slogged in%2$s to post a comment.', '<a href="<?php echo wp_login_url( get_permalink() ); ?>">', '</a>' ); ?></p>
  	</div>
	<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

	<?php if ( is_user_logged_in() ) : ?>

	<p class="comments-logged-in-as"><?php _e("Logged in as", "pleromatheme"); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php _e("Log out", "pleromatheme"); ?> &raquo;</a></p>

	<?php else : ?>
	
	<ul id="comment-form-elements" class="clearfix">
		
		<li>
		  <label for="author"><?php _e("Name", "pleromatheme"); ?> <?php if ($req) echo "(required)"; ?></label>
		  <input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" placeholder="<?php _e('Your Name*', 'pleromatheme'); ?>" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
		</li>
		
		<li>
		  <label for="email"><?php _e("Mail", "pleromatheme"); ?> <?php if ($req) echo "(required)"; ?></label>
		  <input type="email" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" placeholder="<?php _e('Your E-Mail*', 'pleromatheme'); ?>" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
		  <small><?php _e("(will not be published)", "pleromatheme"); ?></small>
		</li>
		
		<li>
		  <label for="url"><?php _e("Website", "pleromatheme"); ?></label>
		  <input type="url" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" placeholder="<?php _e('Got a website?', 'pleromatheme'); ?>" tabindex="3" />
		</li>
		
	</ul>

	<?php endif; ?>
	
	<p><textarea name="comment" id="comment" placeholder="<?php _e('Your Comment here...', 'pleromatheme'); ?>" tabindex="4"></textarea></p>
	
	<p>
	  <input name="submit" type="submit" id="submit" class="boton1" tabindex="5" value="<?php _e('Submit', 'pleromatheme'); ?>" />
	  <?php comment_id_fields(); ?>
	</p>
	
	<div class="alert info">
		<p id="allowed_tags" class="small"><strong>XHTML:</strong> <?php _e('You can use these tags', 'pleromatheme'); ?>: <code><?php echo allowed_tags(); ?></code></p>
	</div>
	
	<?php do_action('comment_form', $post->ID); ?>
	
	</form>
	
	<?php endif; // If registration required and not logged in ?>
</section>

<?php endif; // if you delete this the sky will fall on your head ?>
