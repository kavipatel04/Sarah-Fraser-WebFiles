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
 <style>
    table{ 
    border-collapse:separate; 
    border-spacing: 0 20px; 
    border-color: white;
    } 
    th,td{ 
    width: 150px; 

    }
    td:first-child {
    border-left-style: solid;
    border-top-left-radius: 10px; 
    border-bottom-left-radius: 10px;
}
td:last-child {
    border-right-style: solid;
    border-bottom-right-radius: 10px; 
    border-top-right-radius: 10px; 
}



</style>
<ul>
    <?php if ( $maxitems == 0 ) : ?>
        <li><?php _e( 'No items', 'my-text-domain' ); ?></li>
    <?php else : ?>
        <?php // Loop through each feed item and display each item as a hyperlink. ?>
        <table>
        <?php foreach ( $rss_items as $item ) : ?>
            <tr>
                <td>
                    <a href="<?php echo esc_url( $item->get_permalink() ); ?>"
                        title="<?php printf( __( 'Posted %s', 'my-text-domain' ), $item->get_date('j F Y | g:i a') ); ?>">
                        <?php echo esc_html( $item->get_title() ); ?>
                    </a>
                    <p>Posted: <?php echo $item->get_date('j F Y | g:i a')?></p>
                    <?php echo $item->get_description();?>
                </td>
        </tr>
        <?php endforeach; ?>
        </table>
    <?php endif; ?>
</ul>