<?php if($email_sent === true): ?>
    <div class="notice notice-success is-dismissible">
        <p><?php echo __( 'Your email has been sent successfully', 'mailtrap-for-wp' ) ?></p>
    </div>
<?php endif; ?>

<?php if($email_sent === false): ?>
  <div class="notice notice-error  is-dismissible">
        <p><?php _e( 'Email Delivery Failure. Please check your credentials', 'mailtrap-for-wp' ); ?></p>
  </div>
<?php endif; ?>