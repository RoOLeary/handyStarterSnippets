<?php 

        /* Flexible Content Block Code
        /* Add flexible content layouts at the bottom of this call. Conditional output can be added via WP backemd */

        if( have_rows('global_flexible_content') ):

             // loop through the rows of data
            while ( have_rows('global_flexible_content') ) : the_row();

                // MULTI-OPTION HERO UNIT
                /* Outputs all hero varients inside a single container. To replace video, image, and plain elements. 
                   It requires the user to select the appropriate output options on the publish form and will render the elements accordingly */

                if( get_row_layout() == 'hero_unit'): ?>

                <?php $herolg = get_sub_field('hero_large'); ?>
                <section class="section section-hero <?php if($herolg){ echo 'section-lg'; }?> section-center" id="firstpanel">
                    
                    <?php 
                        /* Output Logo based on Hero Type */

                        $hero_type = get_sub_field('hero_type'); 
                        if($hero_type == 'video'){
                            get_template_part('partials/block','hero-video'); 
                        } elseif($hero_type == 'image'){ ?>
                            <div class="section-background-image" style="background-image: url('<?php the_sub_field('image_bg'); ?>')"></div>
                        <?php } elseif($hero_type == 'surf'){
                            get_template_part('partials/block','hero-surf'); 
                         } else {
                            /* nothing selected. */
                        }
                    ?>  

                    <article class="container">
                        <div class="section-content" <?php if($hero_type == 'video'){ echo 'style="color:white"';} elseif($hero_type == 'image'){ echo 'style="color:white"';} elseif($hero_type == 'surf'){ echo 'style="color:white"';} elseif ($hero_type == 'blank') {echo '';}?>>
                            
                            <?php 
                                /* Output logo version */    
                                $hero_logo_select = get_sub_field('hero_logo_select'); 
                                if($hero_logo_select == 'white'){
                                    get_template_part('partials/block','header-logo'); 
                                } else if($hero_logo_select == 'colour'){
                                    get_template_part('partials/block','header-logo-dark');
                                }
                            ?>
                            <?php if($hero_type == 'blank'){ ?>
                            <h1 class="section-title" style="color: #5d5d5d;"><?php the_sub_field('hero_header_text', false, false); ?></h1>
                            <?php } else { ?>
                            <h1 class="section-title" style="color: #ffffff;"><?php the_sub_field('hero_header_text', false, false); ?></h1>
                            <?php } ?>
                            <?php $main_content = get_sub_field('hero_header_content', false, false); ?>
                            
                            <?php if($main_content){ echo $main_content; };  ?>
                            <br>
                            <?php $hero_header_options = get_sub_field('hero_header_options'); 
                                if($hero_header_options){ 

                                    // if form selected output snippet to link to formstack URL 
                                    
                                    $hero_formlink = get_sub_field('hero_formlink');
                                    $hero_linktype = get_sub_field('hero_link_type');
                                    
                                    if($hero_formlink == 'form'){ ?>
                                       <div class="section-content">
                                        <script type="text/javascript" src="<?php the_sub_field('hero_form_reference');?>"></script>
                                        
                                        <p <?php if($hero_type == 'blank'){ echo 'style="color: #909090"';} else { echo 'style="color: #ffffff"';} ?>><small><?php the_sub_field('hero_form_disclaimer'); ?></small></p>
                                    </div>
                                    <?php } elseif($hero_formlink == 'link'){ 
                                        
                                    // else if link selected, toggle link type and output appropropriate variables
                                    
                                        if($hero_linktype == 'standard'){ ?>
                                           <a href="<?php the_sub_field('hero_link_url');?>" class="btn btn-primary" title="<?php the_sub_field('hero_link_text'); ?>"><?php the_sub_field('hero_link_text');?></a>
                                        <?php } elseif($hero_linktype == 'scroll'){ ?>
                                           <a href="#<?php the_sub_field('hero_scrollto_link_url');?>" data-scroll="#<?php the_sub_field('hero_scrollto_link_url');?>" class="btn btn-primary" title="<?php the_sub_field('hero_scrollto_link_title');?>"><?php the_sub_field('hero_scrollto_link_title');?></a>       
                                    <?php } ?>        
                                <?php } ?>
                            <?php } ?>

                        </div>
                    </article>
                </section>

                <?php 

                // Two Column Download Block - left col is blurb, right col is a form

                elseif(get_row_layout() == 'two_col_download_block'): ?>

                <section class="section section-center two-col" id="two-col-general-block"> 
                    <article class="container">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                              <h1 class="section-title"><?php the_sub_field('col_title'); ?></h1>
                              <blockquote>
                              <figure class="thumbnail">
                              <img id="pdf-logo" src="<?php the_sub_field('download_doc_image'); ?>" alt="Download Doc" style="max-width: 100%;">
                              </figure>
                              <?php $dl_quote = the_sub_field('download_quote'); 
                              if($dl_quote){ ?>
                              <q><?php echo $dl_quote; ?></q>
                              <cite> - <?php the_sub_field('download_quoter'); ?></cite>
                                <?php } ?></blockquote>

                              <p><?php the_sub_field('col_sub_text'); ?></p>
                             
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <h3 class="section-title"><?php the_sub_field('col_two_title'); ?></h3>
                            <script src="<?php the_sub_field('form_url'); ?>?nojquery=1&nojqueryui=1&no_style=1&no_style_strict=1"></script>
                            <p><?php the_sub_field('form_disclaimer'); ?></small>

                        </div>
                    </article>
                </section>

                <?php 

                // Large Quotes Component

                elseif(get_row_layout() == 'large_quotes'): ?>

              
                <section class="section section-center large-quotes"> 
                    <article class="container">
                      <div class="section-content">
                        <ul class="gallery gallery-3" id="event_quotes">
                          <?php while( have_rows('quotes') ): the_row(); 
                          $quote = get_sub_field('quote'); 
                          $quoter = get_sub_field('quoter');
                          $source = get_sub_field('source');
                          ?>
                          <li>
                              <div class="quote eq-height">
                                <h4>
                                  <br>
                                  <em>
                                    <?php echo $quote; ?>
                                  </em>
                                </h4>
                                <img src="<?php echo $quoter; ?>" alt="<?php echo $source; ?>">
                              </div>
                          </li>
                          <?php endwhile; ?>
                        </ul>
                      </div>
                    </article>
                     <?php if (get_sub_field('quote_button')): ?>
                      <a href="<?php the_sub_field('quote_button_link');?>" class="btn btn-primary" title="<?php the_sub_field('quote_button_text'); ?>"><?php the_sub_field('quote_button_text');?></a>
                    <?php endif; ?>
                </section>

                <script src="<?php echo site_url(); ?>/wp-content/themes/blueprint/scripts/matchHeight.min.js"></script>
                <script>
                    jQuery(function() {
                        jQuery('.eq-height').matchHeight();
                    });
                </script>


                <?php 

                elseif( get_row_layout() == 'image_montage'): ?>


                <section class="image-grid" id="montage">
                    <div class="row-1">
                        <div class="block-left montage" style="background: url('<?php the_sub_field('row_1_left'); ?>') 50% 50% no-repeat; background-size: cover;"></div>
                        <div class="block-middle montage" style="background: url('<?php the_sub_field('row_1_middle'); ?>') 50% 50% no-repeat; background-size: cover;"></div>
                        <div class="block-right montage" style="background: url('<?php the_sub_field('row_1_right'); ?>') 50% 50% no-repeat; background-size: cover;"></div>
                    </div>
                    <div class="row-2">
                        <div class="block-left montage" style="background: url('<?php the_sub_field('row_2_left'); ?>') 50% 50% no-repeat; background-size: cover;"></div>
                        <div class="block-middle montage" style="background: url('<?php the_sub_field('row_2_middle'); ?>') 50% 50% no-repeat; background-size: cover;"></div>
                        <div class="block-right montage" style="background: url('<?php the_sub_field('row_2_right'); ?>') 50% 50% no-repeat; background-size: cover;"></div>
                    </div>
                </section>

                <?php 

                elseif(get_row_layout() == 'banner'): ?>

                <section class="section section-banner section-center element-outview in-view" id="banner">
                    <article class="container">
                        <div class="wide">
                            <ul class="gallery gallery-5">
                        
                            <?php while( have_rows('banner_content') ): the_row(); 
                                $heading = get_sub_field('heading'); 
                                $output = get_sub_field('banner_output'); 
                                $symbol = get_sub_field('symbol'); ?>
                                <li class="item">
                                    
                                      <h6 class="bannerHead"><?php echo $heading; ?></h6>
                                      <h4 class="bannerOutput"><strong><span class="counter"><?php echo $output; ?></span><?php echo $symbol; ?></strong></h4>
                                </li>
                            <?php endwhile; ?>
                            </ul>
                        </div>
                    </article>
                </section>


                <?php 

                // Twitter Gate
                /* This component will out a sign-up gate which will encourage the user to sign in with Twitter via Ground Control  
                NOTE: This component has javascript dependencies that are conditionally loaded. Additionally, you'll have to verify with Platfom 
                that the response URL is correct and valid
                */

                elseif(get_row_layout() == 'twitter_gate'): ?>


                <section class="flexo-attendee-gate-wrapper" style="height: <?php the_sub_field('background_height'); ?>%; overflow:hidden; background-color:rgba(28, 28, 28, <?php the_sub_field('background_opacity');?>);">
                    <div class="flexo-attendee-gate-inner">
                        <div class="section-content" style="text-align: center;">
                            <span class="flexo-attendee-gate-title"><?php the_sub_field('overlay_title');?></span>
                            <br>
                            <?php $twittertext = get_sub_field('twitter_cta_text'); 
                            if($twittertext){ ?>
                            <p class="copy"><?php echo $twittertext; ?></p>
                            <?php } ?>
                            <a href="#" id="login-twitter" class="btn btn-twitterbtn"><i class="fa fa-twitter"></i> <?php the_sub_field('twitter_button_text'); ?></a> 
                        </div>
                    </div>
                   
                </section>
                <?php $forward_url = get_sub_field('forward_url'); ?>
                <script>
                    jQuery(document).ready(function(){
                        if(jQuery.cookie('twitter_login')){
                            window.location.href = "<?php echo $forward_url; ?>"; 
                        }
                    }); 
                </script>


                <?php 

                // Attendee Gate
                /* This component will out a sign-up gate which will encourage the user to sign in with their email. Requires a valid FormStack form and forwarding URL. */

                elseif(get_row_layout() == 'attendee_gate'): ?>


                <section class="flexo-attendee-gate-wrapper" style="height: <?php the_sub_field('background_height'); ?>%; overflow:hidden; background-color:rgba(28, 28, 28, <?php the_sub_field('background_opacity');?>);">
                    <div class="flexo-attendee-gate-inner">
                        <span class="flexo-attendee-gate-title"><?php the_sub_field('overlay_title');?></span>
                        <script type="text/javascript" src="<?php the_sub_field('form_url'); ?>"></script><noscript><a href="https://cilabs-sysops.formstack.com/forms/collision_attendee_page_window" title="Online Form">Online Form - Collision 2016 - Attendee Page</a></noscript>
                        <small class="flexo-attendee-gate-small"><?php the_sub_field('form_disclaimer'); ?></a></small>
                    </div> 
                </section>

                <?php $forward_url = get_sub_field('forward_url'); ?>
                <script>
                    jQuery(document).ready(function(){
                        if(jQuery.cookie('fullAtts')){
                            window.location.href = "<?php echo $forward_url; ?>"; 
                        }
                    }); 
                </script>

                <?php 

                // Redeveloped "Download Doc" Component
                /* Outputs an instance of the Download doc functionality. All elements and DL link should be composable on the entry's publish form */

                elseif(get_row_layout() == 'download_doc'): ?>

                <section class="section section-center" id="dl_doc">
                    <article class="container">
                        <div class="section-content">
                            <h1 class="section-title"><?php the_sub_field('download_doc_title'); ?></h1>
                            <blockquote>
                                <figure class="thumbnail">
                                    <img id="pdf-logo" src="<?php the_sub_field('download_doc_image'); ?>" alt="">
                                </figure>
                                <?php $dl_doc = the_sub_field('download_doc_quote');
                                if($dl_doc){ ?>
                                <q><?php the_sub_field('download_doc_quote'); ?></q> 
                                <cite><?php the_sub_field('download_doc_quoter'); ?></cite>
                                <?php } ?>
                            </blockquote>
                            <p><?php the_sub_field('download_doc_small_cta'); ?></p>
                            <?php if(is_front_page() || is_page('media')){ ?>
                            <a href="/partnerwithus" class="btn btn-primary"><?php the_sub_field('download_button_text'); ?></a>
                            <?php } else { ?>
                            <a href="<?php the_sub_field('download_doc_url'); ?>" class="btn btn-primary" download><?php the_sub_field('download_button_text'); ?></a>
                            <?php } ?>
                        </div>
                    <article>
                </section>
                
                <?php 

                // Relationship Group
                /* This component will output a relationship field, which will pull content from the Tickets Custom Post type. Enables output of ticket instances 
                on pages other than Tickets page. */

                elseif(get_row_layout() == 'ticket_component'): ?>

                <section class="section section-center">
                    <article class="container">
                        <div class="section-content">
                            <?php if( have_posts() ) : while(have_posts() ) : the_post(); ?>
                            <h3 class="section-title"><?php the_sub_field('ticket_header_title'); ?></h3>
                            <?php endwhile; endif; wp_reset_query(); ?>
                            <ul class="tickets-group benefits-hide">
                            <?php $posts = get_sub_field('tickets_content');
                            if( $posts ): ?>
                            <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
                                <?php setup_postdata($post); ?>
                                <?php $class = get_field('ticket_class'); ?>
                                <li class="ticket<?php if($class == "primary"){ echo '-primary'; } else { echo '-main'; }; ?>">
                               
                                    <header>
                                        <h3 class="ticket-name"><?php the_field('ticket_name'); ?></h3>
                                    </header>
                                    <section>
                                    <?php $discount = get_field('discount_price'); 
                                    if($discount){ ?>
                                      <del>€<?php the_field('discount_price'); ?></del>
                                    <?php }?>
                                      <h4 class="ticket-cost">€<?php the_field('full_price'); ?></h4>
                                      
                                      <?php if( get_field('ticket_ticker') ) { ?>
                                              <small>Prices increase in <span class="ticket-ticker"></span></small>
                                      <?php } ?>
                                      <p class="ticket-description"><?php the_field('ticket_description'); ?></p>
                                    </section>
                                     <footer>
                                        <tito-button event="websummit/web-summit-2015" releases="<?php the_field('release_id');?>"><?php the_field('button_text'); ?></tito-button>
                                      </footer>
                                </li>
                               
                            <?php endforeach; ?>
                            <?php endif; ?>
                            <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                            
                            </ul>
                            <?php if( have_posts() ) : while(have_posts() ) : the_post(); 
                                $link_to_tickets = get_sub_field('link_to_tickets');
                                if($link_to_tickets){ ?>
                                <a class="btn btn-primary" href="tickets">BUY TICKETS</a>
                                <?php } ?>
                                <?php endwhile; endif; wp_reset_query(); ?>    
                            <br>
                        </div>
                    </article>
                </section>
                
                <?php 

                // Relationship Group
                /* This component will output a relationship field, which will pull content from the FAQ Custom Post type. Enables output of FAQ instances 
                on pages other than FAQ page. */

                elseif(get_row_layout() == 'faq_component'): ?>

                <section class="section section-white section-center">
                    <article class="container">
                        <div class="content">
                            <?php if(is_page('faq')){ echo '<br>'; } ?>
                            <h1 class="section-title"><?php the_sub_field('faq_content_title'); ?></h1>
                            <br>
                            <?php $posts = get_sub_field('faq_content_sections');
                            if( $posts ): ?>
                            <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
                                <?php setup_postdata($post); ?>
                                <article style="text-align:left;" id="<?php the_field('faq_hash');?>">
                                    <a href="#" class="question-toggle"><h5 class="faq-title"><?php the_title(); ?></h5></a>
                                    <p class="faq"><?php the_content(); ?></p>
                                </article>
                                <br>
                            <?php endforeach; ?>
                            <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                            <?php endif; ?>
                        </div>
                    </article>
                </section>

                <script>
                    jQuery(document).ready(function(){
                        jQuery('.question-toggle').bind('click',function(e){
                            e.preventDefault();
                            var faqtoggle =  jQuery(this).next('.faq')
                            var faqtoggletitle = jQuery(this).children('h5.faq-title');
                            
                            faqtoggle.slideToggle(100).toggleClass('expanded'); 
                            
                            if(faqtoggle.hasClass('expanded')){
                                faqtoggletitle.toggleClass('exp'); 
                                console.log(faqtoggletitle);
                            } else {
                                faqtoggletitle.toggleClass('exp');  
                            }
                        });
                    });

                </script>

                <?php 

                // Partners Related Content Component
                /* This component will output a relationship field, which will pull content from the Partners Custom Post type. Enables output of Partners instances 
                on pages other than Event Partners page. */

                elseif(get_row_layout() == 'partners_component'): ?>

                <section class="section section-center"> 
                    <article class="container">
                        <div class="section-content">
                          <h1 class="section-title"><?php the_sub_field('partners_header_title'); ?></h1>
                            <ul class="gallery gallery-5">
                                <?php $posts = get_sub_field('partners_content');
                                 //$i = 0;
                                if( $posts ): ?>

                                <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
                                    <?php setup_postdata($post); ?>
                                    <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'thumbnail') );?>
                                <li class="item ep-links">
                                    <?php the_title(); ?>
                                    <figure><a class="fancybox" href="#partner-info<?php echo $post->ID; ?>" style="width: 150px; height: 150px;"><?php the_post_thumbnail('thumbnail');?></a></figure>
                                    <br>
                                    <div style='display:none;'>
                                        <div class="content" id="partner-info<?php echo $post->ID; ?>">
                                             <p><?php echo $i; ?>
                                             <article class="partner-modal" style="max-width: 500px; text-align:center;">
                                                <h1><a href="<?php the_field('partner_website_url'); ?>"><?php the_title(); ?></a></h1>
                                                <p class="lead"><?php the_content(); ?></p>
                                                <br>
                                                <a class="btn btn-primary" href="<?php the_field('partner_website_url'); ?>" target="_blank"><?php the_title(); ?> WEBSITE</a>
                                            </article>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                                <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </article>
                </section>


                 <?php

                // Hotels Related Content Component

                elseif(get_row_layout() == 'hotel_component'): ?>

                <section class="section section-center" id="hotel-component">
                    <article class="container">
                        <div class="section-content">

                          <h1 class="section-title"><?php the_sub_field('hotels_header_title'); ?></h3>

                          <br>
                          <ul class="gallery gallery-3 gallery-hover">
                            <?php $posts = get_sub_field('hotels_content');
                            if( $posts ): ?>
                            <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
                                <?php setup_postdata($post); ?>
                                <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'thumbnail') );?>
                                <li class="item">
                                <?php
                                $soldout = get_field('sold_out');
                                if($soldout){ ?>
                                <span class="banner">SOLD OUT</span>
                                <?php } ?>
                                  <a href="#<?php the_ID(); ?>" class="fancybox">
                                    <figure>
                                        <?php
                                            $rows = get_field('hotel_images' ); // get all the rows
                                            $first_row = $rows[0]; // get the first row
                                            $image = $first_row['image' ]; // get the sub field value
                                        ?>

                                    <figure>
                                       <img alt="<?php the_title(); ?>" src="<?php echo $image; ?>" />
                                    </figure>
                                    <figcaption>

                                        <span>
                                        <?php
                                          $value = get_field('hotel_star_rating');
                                          for($x = 1; $x <= $value; $x++){
                                            echo '<i class="fa fa-star"></i>';
                                          }
                                        ?>
                                        </span>
                                        <h4 class="title"><?php the_title(); ?></h4>
                                        <span class="sub-text"><?php the_field('hotel_tagline'); ?></span>
                                        <span class="sub-title"><small>Prices from &euro;</small><?php the_field('average_price_per_night'); ?> <small>per night, breakfast included</small></span>

                                    </figcaption>
                                  </a>

                                    <?php if(!$soldout){ ?>
                                      <?php 
                                        $nights_option = get_field('3_4_night_option'); 
                                        $tito_option = get_field('is_tito_booking_link'); 

                                          if($nights_option && $tito_option){  ?>

                                              <tito-button event="websummit/2016-web-summit-hotels/" releases="<?php the_field('tito_ref_3_nights');?>">3 Nights</tito-button>
                                              <tito-button event="websummit/2016-web-summit-hotels/" releases="<?php the_field('tito_ref_4_nights');?>">4 Nights</tito-button>

                                          <?php } elseif ($nights_option) { ?>

                                              <a class="ext-link-btn" target="_blank" href="<?php the_field('booking_link_3_nights'); ?>"><button class="tito-tickets-button">3 Nights</button></a>
                                              <a class="ext-link-btn" target="_blank" href="<?php the_field('booking_link_4_nights'); ?>"><button class="tito-tickets-button">4 Nights</button></a>

                                          <?php } elseif ($tito_option) { ?>

                                              <tito-button event="websummit/2016-web-summit-hotels/" releases="<?php the_field('tito_booking_ref');?>">Book Now</tito-button>

                                          <?php } else { ?>
                                            <a class="ext-link-btn" target="_blank" href="<?php the_field('hotel_booking_link'); ?>"><button class="tito-tickets-button">Book Now</button></a>
                                          <?php }
                                        ?>
                                    <?php } else { ?>
                                    <button class="tito-tickets-button btn-soldout">SOLD OUT</button>
                                    <?php } ?>
                                    <div id="<?php the_ID(); ?>" class="text-center" style="display:none;">

                                    <div class="hotel-details">
                                        <h3><?php the_title(); ?></h3>
                                    </div>
                                      <div class="flexslider">
                                          <ul class="slides">
                                              <?php if( have_rows('hotel_images') ):
                                                  while ( have_rows('hotel_images') ) : the_row();?>
                                                      <li>
                                                          <img alt="<?php the_title(); ?>" src="<?php the_sub_field('image'); ?>">
                                                      </li>
                                                  <?php endwhile;
                                              endif;?>
                                          </ul>
                                      </div>
                                      <div class="hotel-details">
                                        <h6><?php the_field('hotel_location'); ?></h6>
                                        <p class="hotel-description"><?php the_field('hotel_description'); ?></p>
                                        <?php if( get_field('distance_from_venue') ): ?>
                                          <small><?php the_field('distance_from_venue'); ?> from the venue</small> |
                                        <?php endif; ?>

                                        <small>Prices from: &euro;<?php the_field('average_price_per_night'); ?>, breakfast included.</small><br>
                                        <span>
                                        <?php
                                          $value = get_field('hotel_star_rating');
                                          for($x = 1; $x <= $value; $x++){
                                            echo '<i class="fa fa-star"></i>';
                                          }
                                        ?>
                                        </span>
                                        <p></p>
                                        <?php if(!$soldout){ ?>
                                            <?php 
                                              $nights_option = get_field('3_4_night_option'); 
                                              $tito_option = get_field('is_tito_booking_link'); 

                                            if($nights_option && $tito_option){ ?>
                                                  <tito-button event="websummit/2016-web-summit-hotels/" releases="<?php the_field('tito_ref_3_nights');?>">3 Nights</tito-button>
                                                  <tito-button event="websummit/2016-web-summit-hotels/" releases="<?php the_field('tito_ref_4_nights');?>">4 Nights</tito-button>

                                            <?php } elseif ($nights_option) { ?>

                                              <h3>Link 3/4 nights</h3>
                                              <a class="btn btn-primary" target="_blank" href="<?php the_field('booking_link_3_nights'); ?>">3 Nights</a>
                                              <a class="btn btn-primary" target="_blank" href="<?php the_field('booking_link_4_nights'); ?>">4 Nights</a>

                                          <?php } elseif ($tito_option) { ?>

                                              <tito-button event="websummit/2016-web-summit-hotels/" releases="<?php the_field('tito_booking_ref');?>">Book Now</tito-button>

                                          <?php } else { ?>
                                            <a class="btn btn-primary" target="_blank" href="<?php the_field('hotel_booking_link'); ?>">Book Now</a>
                                          <?php } ?>
                                          
                                        <?php } else { ?>
                                        <span class="btn btn-primary btn-soldout-lg" disabled>SOLD OUT</span>
                                        <?php } ?>
                                        <!-- <a class="fancyboxiframe modalFix" href="<?php the_field('hotel_booking_link'); ?>">Book Now</a>
                                        <br> -->
                                      </div>
                                    </div>
                                    <br>
                                </li>
                            <?php endforeach; ?>
                            <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                            <?php endif; ?>

                          </ul>
                        </div>
                    </article>
                </section>
                <script>
                jQuery(window).load(function(){
                    jQuery('.flexslider').flexslider({
                      animation: "fade",
                      useCSS: false,
                      controlNav: false,
                      slideshow: true,
                      directionNav: false,
                      keyboard: true,
                      touch: true,
                      video: false,
                      slideshowSpeed: 4000
                    });
                });
                </script>

                <?php

                // Hotels Related Content Component 2016

                elseif(get_row_layout() == 'hotel_component_2016'): ?>

                <section class="section section-center" id="hotel-component">
                    <article class="container">
                        <div class="section-content">

                          <h1 class="section-title"><?php the_sub_field('hotels_header_title'); ?></h3>

                          <br>
                          <ul class="gallery gallery-3 gallery-hover">
                            <?php $posts = get_sub_field('hotels_content');
                            if( $posts ): ?>
                            <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
                                <?php setup_postdata($post); ?>
                                <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'thumbnail') );?>
                                <li class="item">
                                <?php
                                $soldout = get_field('sold_out');
                                $category = get_field('hotel_category_text');
                                if($soldout){ ?>
                                <span class="banner">SOLD OUT</span>
                                <?php } elseif ($category) { ?>
                                  <span class="banner"><?php the_field('hotel_category_text'); ?></span>
                                <?php } ?>
                                  <a href="#<?php the_ID(); ?>" class="fancybox">
                                    <figure>
                                        <?php
                                            $rows = get_field('hotel_images' ); // get all the rows
                                            $first_row = $rows[0]; // get the first row
                                            $image = $first_row['image' ]; // get the sub field value
                                        ?>

                                    <figure>
                                       <img alt="<?php the_title(); ?>" src="<?php echo $image; ?>" />
                                    </figure>
                                    <figcaption style="min-height: 5rem;">

                                        <span>
                                        <?php
                                          $value = get_field('hotel_star_rating');
                                          for($x = 1; $x <= $value; $x++){
                                            echo '<i class="fa fa-star"></i>';
                                          }
                                        ?>
                                        </span>
                                        <h4 class="title"><?php the_title(); ?></h4>
                                        <span class="sub-text"><?php the_field('hotel_tagline'); ?></span>
                                        <span class="sub-title"><small>Prices from &euro;</small><?php the_field('average_price_per_night'); ?> <small>per night, breakfast included.</small></span>

                                    </figcaption>
                                  </a>
                                    <?php if(!$soldout){ ?>
                                    <tito-button event="websummit/2016-web-summit-hotels/" releases="<?php the_field('tito_booking_ref');?>">Book Now</tito-button>
                                    <?php } else { ?>
                                    <a href="#" class="btn btn-primary" disabled>SOLD OUT</a>
                                    <?php } ?>
                                    <div id="<?php the_ID(); ?>" class="text-center popup" style="display:none;">
                                        <div class="hotel-details">
                                            <h3><?php the_title(); ?></h3>
                                        </div>
                                          <div class="flexslider">
                                              <ul class="slides">
                                                  <?php if( have_rows('hotel_images') ):
                                                      while ( have_rows('hotel_images') ) : the_row();?>
                                                          <li>
                                                              <img alt="<?php the_title(); ?>" src="<?php the_sub_field('image'); ?>">
                                                          </li>
                                                      <?php endwhile;
                                                  endif;?>
                                              </ul>
                                          </div>
                                    
                                          <div class="hotel-details">
                                            <h6><?php the_field('hotel_location'); ?></h6>
                                            <p class="hotel-description"><?php the_field('hotel_description'); ?></p>
                                            <?php if( get_field('distance_from_venue') ): ?>
                                              <small><?php the_field('distance_from_venue'); ?> from the venue</small> |
                                            <?php endif; ?>
                                            <small>Prices from: &euro;<?php the_field('average_price_per_night'); ?>, breakfast included.</small><br>
                                            <span>
                                            <?php
                                              $value = get_field('hotel_star_rating');
                                              for($x = 1; $x <= $value; $x++){
                                                echo '<i class="fa fa-star"></i>';
                                              }
                                            ?>
                                            </span>
                                            <p></p>
                                            <?php if(!$soldout){ ?>
                                              <?php if ( get_field( 'tito_booking' ) ): ?>
                                                <tito-button event="websummit/2016-web-summit-hotels/" releases="<?php the_field('tito_booking_ref');?>">Book Now</tito-button>
                                              <?php else: // field_name returned false ?>
                                                <?php if(get_field('link_action') == "current") { ?>
                                                  <a class="btn btn-primary" href="<?php the_field('hotel_booking_link'); ?>">Book Now</a>
                                                <?php } if(get_field('link_action') == "new") { ?>
                                                  <a class="btn btn-primary" target="_blank" href="<?php the_field('hotel_booking_link'); ?>">Book Now</a>
                                                <?php } if(get_field('link_action') == "iframe") { ?>
                                                  <a class="fancybox fancybox.iframe btn btn-primary" href="<?php the_field('hotel_booking_link'); ?>">Book Now</a>
                                                <?php } ?>
                                              <?php endif; // end of if open_in_iframe logic ?>
                                            <!-- <a class="btn btn-primary" target="_blank" href="<?php the_field('hotel_booking_link'); ?>">Book Now</a> -->
                                            <?php } else { ?>
                                            <a href="#" class="btn btn-primary" disabled>SOLD OUT</a>
                                            <?php } ?>
                                            
                                          </div>
                                        </div>
                                  
                                    <br>
                                </li>
                            <?php endforeach; ?>
                            <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                            <?php endif; ?>
                          </ul>
                          <?php if( get_sub_field('bottom_button') ): ?>          
                            <a class="btn btn-primary" href="<?php the_sub_field('button_link'); ?>" target="_blank"><?php the_sub_field('button_text'); ?></a>
                          <?php endif; ?>
                        </div>
                    </article>
                </section>
                <script>
                jQuery(window).load(function(){
                    jQuery('.flexslider').flexslider({
                      animation: "fade",
                      useCSS: false,
                      controlNav: false,
                      slideshow: true,
                      directionNav: false,
                      keyboard: true,
                      touch: true,
                      video: false,
                      slideshowSpeed: 4000
                    });
                });
                </script>
                
                <?php 
                
                // DYNAMIC FLEX TABS
                /* Conditional elements. If tab 6 is populated, six tabs will output on the front end. Automatic rather than selectable.
                   Configurable via the entry publish form. You must verify that the fields you do not wish to display are left empty, as conditional output
                   is dependant on active/complete title fields. 
                */

                elseif( get_row_layout() == 'flex_tabs' ): ?>
                
                <div id="tab-container" class="tab-container">
                    <section class="tabs-section">
                            <div class="section-content">
                                <?php 
                                    // Settings based on number of tabs
                                    $numTabs = get_sub_field('select_number_of_tabs');
                                    // Set the default tab to display
                                    $default = get_sub_field('select_default_tab');

                                    // Vars for each tab confitional
                                    $three = get_sub_field('tab_three_title');
                                    $four = get_sub_field('tab_four_title');
                                    $five = get_sub_field('tab_five_title');
                                    $six = get_sub_field('tab_six_title');?>
                                
                                <ul class="tabs-section-list section-content" style="width: 100%;">
                                    <li class='item <?php echo $numTabs; ?>'><a href="#tabs1"><span><?php the_sub_field('tab_one_title');?></span></a></li>
                                    <li class='item <?php echo $numTabs; ?>'><a href="#tabs2"><span><?php the_sub_field('tab_two_title');?></span></a></li>
                                    <?php if($three){ ?>
                                    <li class='item <?php echo $numTabs; ?>'><a href="#tabs3"><span><?php echo $three; ?></span></a></li>
                                    <?php } if($four){ ?>
                                    <li class='item <?php echo $numTabs; ?>'><a href="#tabs4"><span><?php echo $four; ?></span></a></li>
                                    <?php } if($five){ ?>
                                    <li class='item <?php echo $numTabs; ?>'><a href="#tabs5"><span><?php echo $five; ?></span></a></li>
                                    <?php } if($six){ ?>
                                    <li class='item <?php echo $numTabs; ?>'><a href="#tabs6"><span><?php echo $six; ?></span></a></li>
                                    <?php } ?>
                                </ul>
                                <div style="left: 0px; right: 0px; margin: 0px auto; display: block;">
                                    <section class="section section-center" style="background: white!important;">
                                        <article class="container" id="tabs1">
                                            <div class="section-content">
                                                <h2><?php the_sub_field('tab_one_heading');?></h2>
                                                <p><?php the_sub_field('tab_one_content');?></p>
                                                <?php 
                                                $tabone = get_sub_field('tab_one_link');
                                                if($tabone){ ?>
                                                <br>
                                                <a href="<?php the_sub_field('tab_one_link');?>" class="btn btn-primary"><?php the_sub_field('tab_one_link_text');?></a>
                                                <?php } ?>
                                            </div>
                                        </article>
                                    
                                        <article class="container" id="tabs2">
                                            <div class="section-content">
                                                <h2><?php the_sub_field('tab_two_heading');?></h2>
                                                <p><?php the_sub_field('tab_two_content');?></p>
                                                <?php 
                                                $tabtwo = get_sub_field('tab_two_link');
                                                if($tabtwo){ ?>
                                                <br>
                                                <a href="<?php the_sub_field('tab_two_link');?>" class="btn btn-primary"><?php the_sub_field('tab_two_link_text');?></a>
                                                <?php } ?>
                                            </div>
                                        </article>
                                        <?php if($numTabs = 'three'){ ?>
                                        <article class="container" id="tabs3">
                                            <div class="section-content">
                                                <h2><?php the_sub_field('tab_three_heading');?></h2>
                                                <p><?php the_sub_field('tab_three_content');?></p>
                                                <?php 
                                                $tabthree = get_sub_field('tab_three_link');
                                                if($tabthree){ ?>
                                                <br>
                                                <a href="<?php the_sub_field('tab_three_link');?>" class="btn btn-primary"><?php the_sub_field('tab_three_link_text');?></a>
                                                <?php } ?>
                                            </div>
                                        </article>
                                        <?php } if($numTabs = 'four'){ ?>
                                        <article class="container" id="tabs4">
                                            <div class="section-content">
                                                <h2><?php the_sub_field('tab_four_heading');?></h2>
                                                <p><?php the_sub_field('tab_four_content');?></p>
                                                <?php 
                                                $tabfour = get_sub_field('tab_four_link');
                                                if($tabfour){ ?>
                                                <br>
                                                <a href="<?php the_sub_field('tab_four_link');?>" class="btn btn-primary"><?php the_sub_field('tab_four_link_text');?></a>
                                                <?php } ?>
                                            </div>
                                        </article>
                                        <?php } if($numTabs = 'five'){ ?>
                                        <article class="container" id="tabs5">
                                            <div class="section-content">
                                                <h2><?php the_sub_field('tab_five_heading');?></h2>
                                                <p><?php the_sub_field('tab_five_content');?></p>
                                                <?php 
                                                $tabfive = get_sub_field('tab_five_link');
                                                if($tabfive){ ?>
                                                <br>
                                                <a href="<?php the_sub_field('tab_five_link');?>" class="btn btn-primary"><?php the_sub_field('tab_five_link_text');?></a>
                                                <?php } ?>
                                            </div>
                                        </article>
                                        <?php } if($numTabs = 'six'){ ?>
                                        <article class="container" id="tabs6">
                                            <div class="section-content">
                                                <h2><?php the_sub_field('tab_six_heading');?></h2>
                                                <p><?php the_sub_field('tab_six_content');?></p>
                                                <?php 
                                                $tabsix = get_sub_field('tab_six_link');
                                                if($tabsix){ ?>
                                                <br>
                                                <a href="<?php the_sub_field('tab_six_link');?>" class="btn btn-primary"><?php the_sub_field('tab_six_link_text');?></a>
                                                <?php } ?>
                                            </div>
                                        </article>
                                        <?php } ?>
                                    </section>
                                </div>                         
                            </div>
                    </section>
                    <script>
                        jQuery(document).ready(function(){
                             jQuery('.tab-container').easytabs({
                              animate: true,
                              panelActiveClass: "active",
                              tabActiveClass: "active",
                              defaultTab: "li:nth-child(<?php echo $default; ?>)",
                              animationSpeed: "normal",
                              tabs: "> section > div > ul > li",
                              updateHash: false,
                              transitionIn: 'fadeIn',
                              transitionOut: 'fadeOut',
                              updateHash: false
                            });
                        });
                    </script>
                </div>


                <?php 
                
                // Dymanic Speaker Attendee Lists. Output different lists by applying different field content. 
                /* Configurable from the publish form for the compoenent. You must ensure that the correct list type is selected, that a target div is
                   supplied and a limit set unless specified by requests. 
                */

                elseif( get_row_layout() == 'speaker_attendee_list' ): ?>
                <?php $pagination = get_sub_field('toggle_pagination'); ?>
                <section class="section section-center" id="speaker_attendee_list_panel" <?php if( get_sub_field('first_section') ){echo "style='padding-top:6.375rem;'";}?>>
                    <article class="container">
                        <div class="section-content">
                            <?php if(is_page(array('attendee-list','featured-attendees'))){ ?>
                            <br>
                            <?php } ?>
                            <h1 class="section-title"><?php the_sub_field('list_title');?></h1>
                            <?php $intro = get_sub_field('list_intro_text');?>
                            <?php if($intro){ ?>
                            <br>
                            <p class="copy"><?php the_sub_field('list_intro_text');?></p>   
                            <?php } ?>             
                            <script class='api-json' data-target='#<?php the_sub_field('target_element');?>' data-url='<?php the_sub_field('list_url');?>?limit=<?php the_sub_field('list_limit'); ?>' type='text/x-handlebars-template' <?php if($pagination){ echo 'data-page="1"';} ?>>

                            <?php $list_type = get_sub_field('list_type'); ?>
    
                                <?php if( $list_type == 'people' ){ ?>
                                    {{#each people}}
                                    <li class="item">
                                    <figure><a href="#attendee-popup-{{@index}}" class="fancybox" rel="gallery"><img alt='{{this.full_name}}' src='{{this.medium_image}}'></a></figure>
                                    <figcaption>
                                      <h4 class="title">{{this.full_name}}</h4>
                                      <span class='sub-title' title='{{this.job_title}}'>
                                        {{#if this.job_title}}
                                        <strong>{{trimS this.job_title 0 25}}}</strong>
                                        {{else}}{{/if}}
                                      </span>
                                      <span class='sub-text' title='{{this.company_name}}'>
                                        {{#if this.company_name}}
                                        <strong>{{{trimS this.company_name 0 25}}}</strong>
                                        {{else}}{{/if}}
                                      </span>
                                      <span class='sub-title' title='{{this.country_name}}' style="display:none;">
                                        <strong>{{this.country_name}}</strong>           
                                      </span>
                                      <span class='sub-title' title='{{this.country_name}}'>
                                        <strong>{{this.country_name}}</strong>           
                                      </span>
                                    </figcaption>
                                    <div style='display:none; margin: 0;'>
                                        <div class='section-content attendee-popup' id='attendee-popup-{{@index}}' style="max-width: 340px; margin: 0 auto;">
                                            <div class='item-image'>
                                              <img alt='{{this.company_name}}' src='{{this.medium_image}}' style='width: 100%;'>
                                            </div>
                                            <h3 style="text-align:center">{{this.full_name}}</h3>
                                            <p style="text-align:center">{{this.job_title}} - {{this.company_name}}</p>
                                            <p style="text-align:center;">{{#if this.bio}}{{this.bio}}{{/if}}</p>
                                        </div>
                                    </div>    
                                </li>
                                <?php } else if( $list_type  == 'attendees' ){ ?>
                                {{#each attendees}}
                                    <li class="item">
                                      <figure><a href="#attendee-popup-{{this.id}}" class="fancybox" rel="gallery"><img alt='{{this.name}}' src='{{this.medium_image}}'></a></figure>
                                        <figcaption>
                                          <h4 class="title">{{this.name}}</h4>
                                          <span class='sub-title' title='{{this.career}}'>
                                            {{#if this.career}}
                                            <strong>{{trimS this.career 0 25}}}</strong>
                                            {{else}}{{/if}}
                                          </span>
                                          <span class='sub-text' title='{{this.company}}'>
                                            {{#if this.company}}
                                            <strong>{{{trimS this.company 0 25}}}</strong>
                                            {{else}}{{/if}}
                                          </span>
                                          <span class='sub-title' title='{{this.country}}' style="display:none;">
                                            <strong>{{this.country}}</strong>           
                                          </span>
                                          <span class='sub-title' title='{{this.country}}'>
                                            <strong>{{this.country}}</strong>           
                                          </span>
                                        </figcaption>
                                         <div style='display:none; margin: 0;'>
                                            <div class='section-content attendee-popup' id='attendee-popup-{{this.id}}' style="max-width: 340px; margin: 0 auto;">
                                              
                                                <div class='item-image'>
                                                  <img alt='{{this.company_name}}' src='{{this.medium_image}}' style='width: 100%;'>
                                                </div>
                                                <h3 style="text-align:center">{{this.name}}</h3>
                                                <p style="text-align:center">{{this.career}} - {{this.company}}</p>
                                                <p style="text-align:center;">{{#if this.bio}}{{this.bio}}{{/if}}</p>
                                            </div>
                                        </div>    
                                    </li>
                                <?php } ?>
                              {{/each}}
                              </script>
                            <ul class="gallery gallery-5" id="<?php the_sub_field('target_element');?>"></ul>
                            <?php if($pagination){ ?>
                            <div class="more-waypoint"></div>
                            <?php } ?>
                            <?php 

                            $display_link = get_sub_field('display_link'); 
                            
                            if($display_link){ 
                                
                                $link_type = get_sub_field('link_type');
                                
                                if($link_type == 'scrollto'){ ?>
                                <a class="btn btn-primary" href="#<?php the_sub_field('scrollto_link'); ?>" data-scroll="#<?php the_sub_field('scrollto_link'); ?>"><?php the_sub_field('scroll_link_text'); ?></a>     
                                <?php } elseif($link_type == "standard"){ ?>
                                <a class="btn btn-primary" href="<?php the_sub_field('below_link_url'); ?>"><?php the_sub_field('link_title'); ?></a>
                                    <?php } ?>
                                <?php } else {} ?>
                        </div>
                    </article>
                </section>
                
                <?php 

                // LEARN MORE - a type of general block with in-built scoll and external link functionality
                /* Closely related to the "General Block" - this component enables the output of a general content block with additional, selectable link/form output */


                elseif( get_row_layout() == 'learn_more' ): ?>

                <section class="section section-center" id="learn-more">
                    <article class="container">
                        <div class="content text-center">
                          <h1 class="section-title"><?php the_sub_field('learn_more_title'); ?></h1>
                          <p class="lead"><?php the_sub_field('learn_more_content', false, false); ?></p>
                          <?php 

                            $formlink_toggle = get_sub_field('formlink_toggle');
                            $learn_more_link_type = get_sub_field('learn_more_link_type');

                            if($formlink_toggle == 'form'){ ?>
                            
                                <script type="text/javascript" src="<?php the_sub_field('learn_more_form'); ?>"></script>
                                <p><small><?php the_sub_field('terms_text'); ?></small></p>    

                                <?php } elseif($formlink_toggle == 'link'){ 
                                if($learn_more_link_type == 'external'){ ?>
                                <a href="<?php the_sub_field('learn_more_link_title');?>" class="btn btn-primary"><?php the_sub_field('learn_more_link_text');?></a>
                                <?php } elseif($learn_more_link_type == 'scroll'){ ?>
                                <a href="#<?php the_sub_field('learn_more_scroll_link');?>" data-scroll="#<?php the_sub_field('learn_more_scroll_link');?>" class="btn btn-primary" title="<?php the_sub_field('learn_more_scroll_link_text');?>"><?php the_sub_field('learn_more_scroll_link_text');?></a>       
                                <?php } else { ?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </article>
                </section>

                <?php 

                // Reviews component

                elseif( get_row_layout() == 'reviews_component' ): ?>
                <section class="section section-center" id="reviews_component">
                    <article class="container">
                        <div class="content text-center">
                       
                            <?php 
                                // get choosen category
                                $reviewCategory = get_sub_field('reviews_category');
                                // add the word reviews_ to $selectedCat
                                $catURL = 'reviews_' . $reviewCategory;
                                // get post ids
                                $ids = get_sub_field($catURL, false, false);
                                //echo $ids;
                                // comma sperated list of ids
                                $idList = implode(',', $ids);
                                // set endpoint url 
                                $urlParam = site_url() .'/wp-json/wp/v2/reviews?filter[post__in][]=' . $idList;
                                //cho $urlParam;
                            ?>

                            <script id="reviews-template" type="text/x-handlebars-template">
                                {{#if acf.review_url}}
                                    <a href="{{this.acf.review_url}}" class="review" target="_blank">
                                {{else}}
                                    <div class="review">
                                {{/if}}
                                        <div class="review-img">
                                            <img src="{{this.acf.review_logo_picture}}" alt="{{this.acf.review_name_of_pub_person}}">
                                        </div>

                                        <div class="review-content">
                                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                                            <h4><em>{{this.acf.review_quote}}</em></h4>
                                            <p>- {{this.acf.review_name_of_pub_person}}</p>
                                        </div>
                                {{#if acf.review_url}}
                                    </a>
                                {{else}}
                                    </div>
                                {{/if}}
                            </script>

                            <script>
                                jQuery.ajax({
                                    url: '<?php echo site_url(); ?>/wp-json/wp/v2/reviews/?post__in',
                                    data: {
                                        filter: {
                                            'post__in' : [<?php echo $idList; ?>],
                                            'posts_per_page' : '-1'

                                        }
                                    },
                                    dataType: 'json',
                                    type: 'GET',
                                    success: function(data) {
                                        console.log(data);
                                        // Extract the text from the template .html() is the jquery helper method for that
                                        var raw_template = jQuery('#reviews-template').html();
                                        // Compile that into an handlebars template
                                        var template = Handlebars.compile(raw_template);
                                        // Retrieve the placeHolder where the Posts will be displayed 
                                        var placeHolder = jQuery("#reviews");
                                        jQuery.each(data,function(index,element){
                                        // Generate the HTML for each post
                                            var html = template(element);
                                            // Render the posts into the page
                                            placeHolder.append(html);
                                        });
                                    },
                                    error: function() {
                                        // error code
                                    }
                                });
                            </script>
                            <div id="reviews"></div>
                        </div>
                    </article>
                </section>


                <?php 

                // Twitter Reviews component

                elseif( get_row_layout() == 'twitter_reviews_component' ): ?>
                <section class="section section-center" id="reviews_component">
                    <article class="container">   
                        <div class="section-content">
                            <h1 class="section-title" style="text-align:center;"><?php the_sub_field('twitter_headline'); ?></h1>
                            <br>
                            <ul id="cilabs-twitter" data-widget-id="<?php the_sub_field('twitter_feed'); ?>"></ul>
                        </div>
                    </article>
                </section>
                

               

                <?php 

                // ACF & Google Maps integration. Settings controlled via Content Blocks cpt, should be regarded as global and therefore not editable

                elseif( get_row_layout() == 'map' ): ?>

                    <?php 

                    $location = get_field('conference_location', option);
                    $venue = get_field('map_popup_content', option);

                    if($location){ 
                    ?>
                    <div id="map" class="acf-map">
            
                        </div>
                            
                        <script>

                          function initMap() {
                            var myLatLng = {lat: <?php echo $location['lat']; ?>, lng: <?php echo $location['lng']; ?>};

                            var map = new google.maps.Map(document.getElementById('map'), {
                              zoom: 16,
                              zoomControl: false,
                              scaleControl: false,
                              scrollwheel: false,
                              disableDoubleClickZoom: true,
                              center: myLatLng
                            });

                            var contentString = '<div class="map-info"><h5 class="event-location" style="text-align: center;"><?php echo $venue; ?></h5></div>';

                            var infowindow = new google.maps.InfoWindow({
                              content: contentString
                            });

                            var marker = new google.maps.Marker({
                              position: myLatLng,
                              map: map
                            });

                            google.maps.event.addListener(marker, 'click', function() {
                               infowindow.open(map,marker);
                            });
                            infowindow.open(map,marker);
                          }
                        </script>
                        <script src="https://maps.googleapis.com/maps/api/js?v=3.14&callback=initMap"></script>
 
                    <?php } ?>
                

                <?php 

                // NETWORKING Panel. Output background image of Conference host city and relevant CTAs

                elseif( get_row_layout() == 'networking' ): ?>

                <?php $enablelg = get_sub_field('section_large'); ?>

                <section class="section section-hero <?php if($enablelg){ echo 'section-lg'; }?> section-center" id="networking_panel">
                    <div class="section-background-image" style="background-image: url('<?php the_sub_field('networking_bg_image'); ?>');"></div>
                        <article class="container">
                            <div class="section-content" style="color: #ffffff;">
                                <h1 class="section-title" style="color: #ffffff;"><?php the_sub_field('networking_title'); ?></h1>
                                <br>
                                <p class="copy"><?php the_sub_field('networking_leadtext'); ?></p>
                                <?php $linktype = get_sub_field('link_type');
                                if($linktype == 'scroll'){ ?>
                                <a href="#<?php the_sub_field('scroll_link');?>" data-scroll="#<?php the_sub_field('scroll_link');?>" class="btn btn-primary" title="<?php the_sub_field('scroll_link_text');?>"><?php the_sub_field('scroll_link_text');?></a>       
                                <?php } elseif($linktype == 'external'){ ?>
                                <a href="<?php the_sub_field('external_link_url');?>" class="btn btn-primary"><?php the_sub_field('external_link_text');?></a>
                                <?php } ?>
                            </div>
                        </article>
                    </div>
                </section>

                <?php 

                // WHAT IS A 2 FOR 1 DISCOUNT CODE - static element to output content from General Blocks

                elseif( get_row_layout() == 'what_is_a_2for1_discount_code' ): ?>

                <section class="section section-center" id="2for1discount">
                    <article class="container">
                        <div class="section-content">
                          
                           <?php the_sub_field('2for1_code_content'); ?>
                          
                        </div>
                    </article>
                </section>

                <?php 

                // Custom Logo Soup

                elseif( get_row_layout() == 'custom_logo_soup' ): ?>

                <section class="section section-image-grid section-center" id="custom_logo_soup">
                    <article class="container">
                        <div class="section-content">
                            <h1 class="section-title"><?php the_sub_field('logo_soup_headline'); ?></h1>
                            <?php $logocta = get_sub_field('logo_soup_cta');
                            if($logocta){ ?>
                            <br>
                            <p><?php the_sub_field('logo_soup_cta'); ?></p>
                            
                            <?php } ?>
                            <ul class="gallery gallery-5">
                        
                            <?php while( have_rows('custom_logo_grid') ): the_row(); 
                                $alt = get_sub_field('img_alt'); 
                                $src = get_sub_field('img_src'); ?>
                                <li class="item">
                                    <figure>
                                      <img  alt="<?php echo $alt; ?>" src="<?php echo $src; ?>">
                                    </figure>
                                </li>
                            <?php endwhile; ?>
                            </ul>
                        </div>
                    </article>
                </section>

                <?php 

                // Code Only - outputs a HMTL only code block element that alls HTML, CSS and Javascript tags 

                elseif( get_row_layout() == 'code_only' ): ?>

                
                <?php the_sub_field('code_block', false, false); ?>
                
                <?php 

                // GENERAL BLOCK - A UTILITY SECTION. CAN OUTPUT MULTIPLE ELEMENTS. Note General Block class instead of ID. 

                elseif( get_row_layout() == 'general_block' ): ?>
               
                <?php
                    $sectionID = get_sub_field('section_id'); 
                    $override = get_sub_field('override_formatting');
                    $formatting = get_sub_field('formatting');
                    $first = get_sub_field('first_section');
                ?>

                <section class="section <?php if($override){ echo $formatting; } else { echo 'section-center'; } ?> general-block" id="<?php if($sectionID){ echo $sectionID; } else { echo 'general'; } ?>" <?php if($first) {echo "style='padding-top:6.375rem;'";}; ?>>
                    <article class="container">
                        <div class="section-content">
                            <h1 class="section-title"><?php the_sub_field('general_block_heading'); ?></h1>
                            <br>
                            <?php the_sub_field('general_content_block'); ?>
                            <?php 

                            $display_link = get_sub_field('display_link'); 
                            
                            if($display_link){ 
                                
                                $link_type = get_sub_field('link_type');
                                
                                if($link_type == 'scrollto'){ ?>
                                <a class="btn btn-primary" href="#<?php the_sub_field('scrollto_link'); ?>" data-scroll="#<?php the_sub_field('scrollto_link'); ?>"><?php the_sub_field('scrollto_link_text'); ?></a>     
                                <?php } elseif($link_type == "standard"){ ?>
                                <a class="btn btn-primary" href="<?php the_sub_field('standard_link_url'); ?>"><?php the_sub_field('link_text'); ?></a>
                                    <?php } ?>
                                <?php } else {} ?>
                        </div>
                    </article>
                </section>

                <?php

                // NEWSLETTER SIGNUP - Enable easily deployable Newsletter Signup element. 

                elseif( get_row_layout() == 'newsletter_signup' ): ?>

                <section class="section section-center" id="newsletter_signup_form">
                    <article class="container">
                        <div class="section-content">
                                <h1 class="section-title"><?php the_sub_field('newsletter_cta'); ?></h1>
                                <?php $blurb = get_sub_field('enable_signup_text'); 
                                if($blurb){ ?>
                                <p class="lead"><?php the_sub_field('newsletter_signup_text'); ?></p>
                                <?php } ?>
                                <script type="text/javascript" src="<?php the_sub_field('formstack_url'); ?>"></script>
                                <p><small><?php the_sub_field('terms_text'); ?></small></p>         
                        </div>
                    </article>
                </section>

                <?php

                // IMAGE GRID

                elseif( get_row_layout() == 'image_grid' ): ?>

                <section class="image-grid" id="flex_image_grid">

                    <?php the_sub_field('image_and_quote_section'); ?>
                          
                </section>
                
                
                <?php

                // IMAGE GRID CUSTOM

                elseif( get_row_layout() == 'image_grid_custom' ): ?>

                <section class="image-grid custom" id="image-grid-custom">
              
                   <div class="row-1">
                      <div class="block-left" style="background: url('<?php the_sub_field('left_image'); ?>') 50% 50% no-repeat; background-size: cover;">
                      </div>
                      <div class="block-middle">
                        <div class="quote">
                          <h3>
                            <em style="padding: 2em 0;">
                              <?php the_sub_field('middle_quote'); ?>
                              <span class="primary"><?php the_sub_field('middle_quoter'); ?></span>
                            </em>
                          </h3>
                        </div>
                      </div>
                      <div class="block-right" style="background: url('<?php the_sub_field('image_right'); ?>') 50% 50% no-repeat; background-size: cover;">
                      </div>
                    </div>
                    <div class="row-2">
                      <div class="block-left">
                        <div class="quote">
                          <h3>
                            <em style="padding: 2em 0;">
                              <?php the_sub_field('left_quote'); ?>
                              <span class="primary"><?php the_sub_field('left_quoter'); ?></span>
                            </em>
                          </h3>
                        </div>
                      </div>
                      <div class="block-middle" style="background: url('<?php the_sub_field('image_middle'); ?>') 50% 50% no-repeat; background-size: cover;">

                      </div>
                      <div class="block-right">
                        <div class="quote">
                          <h3>
                            <em style="padding: 2em 0;">
                              <?php the_sub_field('quote_right'); ?>
                              <span class="primary"><?php the_sub_field('quoter_right'); ?></span>
                            </em>
                          </h3>
                        </div>
                      </div>
                    </div>

                </section>
                
                <?php

                // TRACKS. IMPORTANT. THIS WILL ENABLE FLEXIBLE PAGE CREATION FOR TRACK PAGES

                elseif( get_row_layout() == 'tracks' ): ?>
                 
                <section class="section section-hero section-center tracks" id="firstpanel">
                    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                        <div class="section-background-image" style="background-image: url('<?php the_sub_field('track_header_image'); ?>')"></div>
                        <?php endwhile; endif; wp_reset_query(); ?>
                        <article class="container">
                            <div class="section-content" style="color:#ffffff;">
                                <?php get_template_part('partials/block','header-logo'); ?>

                                <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                                    <h1 class="section-title" style="color: #ffffff;"><?php the_sub_field('track_title'); ?></h1>
                                    <h2><?php the_sub_field('track_leadtext'); ?></h2>
                                    <p class="copy"><?php the_sub_field('track_header_content');?></p>
                                    
                                    <?php 

                                    $toggle_links = get_sub_field('toggle_links');                                   
                                    if($toggle_links){ 
                                        $linktype = get_sub_field('link_type'); 

                                        if($linktype == 'Scroll'){ ?>
                                            <a href="#<?php the_sub_field('scroll_link_href'); ?>" data-scroll="#<?php the_sub_field('scroll_link_href'); ?>" class="btn btn-primary" title="Learn More"><?php the_sub_field('scroll_link_title'); ?></a>
                                        <?php } elseif ($linktype == 'External') { ?>
                                            <a href="<?php the_sub_field('external_link_url'); ?>" data-scroll="<?php the_sub_field('external_link_url'); ?>" class="btn btn-primary" title="Learn More"><?php the_sub_field('external_link_text'); ?></a>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php endwhile; endif; wp_reset_query(); ?>
                            </div>
                        </article>
                        <span id="more"></span>
                    </section>

                <?php 

                // PITCH IMG GRID

                elseif( get_row_layout() == 'pitch_img_grid' ): ?>

                <section class="section section-center">
                    <article class="container">
                        <div class="section-content">
                            <h1 class="section-title"><?php the_sub_field('pitch_title'); ?></h1>
                                
                            <ul class="gallery gallery-4">
                                <?php while( have_rows('pitch_images') ): the_row(); 
                                $pitch_img = get_sub_field('pitch_img'); 
                                $pitch_img_alt = get_sub_field('pitch_img_alt'); 
                                $pitch_text = get_sub_field('pitch_text'); ?>
                                <li class="item">
                                    <figure>
                                      <img alt="<?php echo $pitch_img_alt; ?>" src="<?php echo $pitch_img; ?>">
                                    </figure>
                                    <figcaption>
                                        <?php echo $pitch_text; ?>
                                    </figcaption>
                                </li>
                            <?php endwhile; ?>
                            </ul>
                        </div>
                    </article>
                </section>

                <?php


                endif;


            endwhile;

        else :

        // no layouts

        endif;

    ?>