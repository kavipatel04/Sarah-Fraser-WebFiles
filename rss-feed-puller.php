<h2><?php _e( 'Recent news from Some-Other Blog:', 'my-text-domain' ); ?></h2>
 
<?php // Get RSS Feed(s)
include_once( ABSPATH . WPINC . '/feed.php' );
 
// Get a SimplePie feed object from the specified feed source.
$rss = fetch_feed( 'https://heyfrasepodcast.libsyn.com/rss' );
 
if ( ! is_wp_error( $rss ) ) : // Checks that the object is created correctly
 
    // Figure out how many total items there are, but limit it to 5. 
    $maxitems = $rss->get_item_quantity( 5 ); 
 
    // Build an array of all the items, starting with element 0 (first element).
    $rss_items = $rss->get_items( 0, $maxitems );
 
endif;
?>
 
<ul>
    <?php if ( $maxitems == 0 ) : ?>
        <li><?php _e( 'No items', 'my-text-domain' ); ?></li>
    <?php else : ?>
        <?php // Loop through each feed item and display each item as a hyperlink. ?>
        <?php foreach ( $rss_items as $item ) : ?>
            <li>
                <a href="<?php echo esc_url( $item->get_permalink() ); ?>"
                    title="<?php printf( __( 'Posted %s', 'my-text-domain' ), $item->get_date('j F Y | g:i a') ); ?>">
                    <?php echo esc_html( $item->get_title() ); ?>
                </a>
                <?php echo esc_html($item->get_description() );?>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>