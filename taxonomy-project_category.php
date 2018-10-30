<?php get_header(); ?>

<div id="main-content">

<?php
 /**
  * Full width heading
  */
?>
<div class="et_pb_section et_pb_fullwidth_section et_section_regular" style="background-color:#3daeb7;">
    <section class="et_pb_fullwidth_header et_pb_bg_layout_dark et_pb_text_align_left">
        <div class="et_pb_row">
            <h1>Properties</h1>
            <p class="et_pb_fullwidth_header_subhead">Filtered by: <strong><?php echo $wp_query->queried_object->name; ?></strong></p>
        </div>
    </section>
</div>


    <div class="container">
        <div id="content-area" class="clearfix">
            <div id="left-area">

        <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    $post_format = get_post_format(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>

                <?php
                    $thumb = '';

                    $width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

                    $height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
                    $classtext = 'et_pb_post_main_image';
                    $titletext = get_the_title();
                    $thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
                    $thumb = $thumbnail["thumb"];

                    et_divi_post_format_content();

                    if ( ! in_array( $post_format, array( 'link', 'audio', 'quote' ) ) ) {
                        if ( 'video' === $post_format && false !== ( $first_video = et_get_first_video() ) ) :
                            printf(
                                '<div class="et_main_video_container">
                                    %1$s
                                </div>',
                                $first_video
                            );
                        elseif ( 'gallery' === $post_format ) :
                            et_gallery_images();
                        elseif ( 'on' == et_get_option( 'divi_thumbnails_index', 'on' ) && '' !== $thumb  ) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height ); ?>
                            </a>
                    <?php
                        endif;
                    } ?>

                <?php if ( ! in_array( $post_format, array( 'link', 'audio', 'quote', 'gallery' ) ) ) : ?>
                    <?php if ( ! in_array( $post_format, array( 'link', 'audio' ) ) ) : ?>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php endif; ?>

                    <?php
                        // 2015-04-12 gjms | Remove author and date from category page.
                        // et_divi_post_meta();

                        the_excerpt();

                        /*
                        2015-04-12 gjms | Remove default options for viewing truncated content in favour of excerpt, above.
                        if ( 'on' !== et_get_option( 'divi_blog_style', 'false' ) || ( is_search() && ( 'on' === get_post_meta( get_the_ID(), '_et_pb_use_builder', true ) ) ) )
                            truncate_post( 270 );
                        else
                            the_content();
                        */
                    ?>
                <?php endif; ?>

                    </article> <!-- .et_pb_post -->
            <?php
                    endwhile;

                    if ( function_exists( 'wp_pagenavi' ) )
                        wp_pagenavi();
                    else
                        get_template_part( 'includes/navigation', 'index' );
                else :
                    get_template_part( 'includes/no-results', 'index' );
                endif;
            ?>
            </div> <!-- #left-area -->

            <?php get_sidebar(); ?>
        </div> <!-- #content-area -->
    </div> <!-- .container -->
</div> <!-- #main-content -->

<?php get_footer(); ?>