<?php get_header() ?>
<div id="page">
    <div id="page-bgtop">
        <div id="page-bgbtm">
            <div id="content">
                <div class="post">
                
                    <?php
                    if(is_single()):
                    while (have_posts()) : 
                    the_post(); ?>
                        <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h2>
                        <h3>Color:<?php 
                        $id=get_the_ID();
                        echo  get_post_meta($id,'ced_meta_box_metakey',true); ?></h3>
                        <p class="meta">Posted By <a><?php the_author_link() ?></a> On <?php echo get_the_date() ?> <a href="#" class="comments">Comments (64)</a> &nbsp;&bull;&nbsp; <a href="#" class="permalink">Full article</a></p>
                        <div class="entry">
                            <?php the_content(); ?>
                        </div>
                       
                    <?php
                   comments_template('/comments.php');
                endwhile;
            endif; ?>
                </div>
            </div>
            <!-- end #content -->
            <?php get_sidebar() ?>
            <!-- end #page -->
            <?php get_footer() ?>