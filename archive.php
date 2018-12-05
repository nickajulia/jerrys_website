<?php get_header(); ?>

<table width="880" align="center" cellpadding="2" cellspacing="2">
<tr>
<td align="left" width="668" valign="top"><table width="98%" border="0" align="left" cellpadding="0" cellspacing="0">
                          <?php if (have_posts()) : ?>
<tr>
                      <td align="left" valign="top" style="padding-bottom:15px;"><?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h1>Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h1>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h1>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h1>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h1>Archive for <?php the_time('F jS, Y'); ?></h1>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h1>Archive for <?php the_time('F, Y'); ?></h1>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h1>Archive for <?php the_time('Y'); ?></h1>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h1>Author Archive</h1>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h1>Blog Archives</h1>
 	  <?php } ?></td>
                    </tr>
                          <?php while (have_posts()) : the_post(); ?>
                          <tr>
                            <td height="40" align="left" valign="bottom"><h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1><h3><?php the_time('F jS, Y') ?> </h3></td>
                          </tr>
                         
                          <tr>
                            <td align="left" valign="top" class="body_cont"><?php the_excerpt(__('continue reading...')); ?>
                                  <p align="right"> <a href="<?php the_permalink() ?>">Read More...</a></td>
                          </tr>
                          <?php endwhile; ?>
                           <tr>
                      <td align="left" valign="top" class="body_cont"><table width="95%" border="0" align="center" cellpadding="2" cellspacing="2">
                        <tr>
                          <td width="50%" align="left" valign="top"><?php next_posts_link('&laquo; Older Entries') ?></td>
                          <td width="50%" align="right" valign="top"><?php previous_posts_link('Newer Entries &raquo;') ?></td>
                        </tr>
                      </table></td>
                    </tr>
                     <?php else : ?>
                    <tr>
                      <td align="left" valign="top" class="body_cont"><h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?></td>
                    </tr>
                 	<?php endif; ?>
                        </table></td>
                        
<td  align="left" valign="top" style="border-left:1px solid #a0a0a0; padding-left:10px;"><?php get_sidebar();?></td>
</tr>
</table>
 
<?php get_footer(); ?>