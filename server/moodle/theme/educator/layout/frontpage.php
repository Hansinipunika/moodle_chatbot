<?php

defined('MOODLE_INTERNAL') || die();

$hasheading = $PAGE->heading;
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));

$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);

$showsidepre = $hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT);
$showsidepost = $hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT);

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

$bodyclasses = array();
if ($showsidepre && !$showsidepost) {
    $bodyclasses[] = 'side-pre-only';
} else if ($showsidepost && !$showsidepre) {
    $bodyclasses[] = 'side-post-only';
} else if (!$showsidepost && !$showsidepre) {
    $bodyclasses[] = 'content-only';
}

if ($hascustommenu) {
    $bodyclasses[] = 'has_custom_menu';
}

/************************************************************************************************/
if (!empty($PAGE->theme->settings->frontpagelogourl)) {
    $logourl = $PAGE->theme->settings->frontpagelogourl;
} else if (!empty($PAGE->theme->settings->customlogourl)) {
    $logourl = $PAGE->theme->settings->customlogourl;
} else {
    $logourl = $OUTPUT->pix_url('logo', 'theme');
}
if (strtolower(substr($logourl, 0, 4)) != 'http') {
    $logourl = $CFG->wwwroot.'/'.$logourl;
}

$hasframe = !isset($PAGE->theme->settings->noframe) || !$PAGE->theme->settings->noframe;
 
$displaylogo = !isset($PAGE->theme->settings->headercontent) || $PAGE->theme->settings->headercontent;
/************************************************************************************************/

/****************************************banner ********************************************************/
  if (!empty($PAGE->theme->settings->custombannerimg)) {
    $bannerurl = $PAGE->theme->settings->custombannerimg;
} else {
    $bannerurl = $OUTPUT->pix_url('banner', 'theme');
}
if (strtolower(substr($logourl, 0, 4)) != 'http') {
    $bannerurl = $CFG->wwwroot.'/'.$bannerurl;
}

/************************************************************************************************/




echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
    <title><?php echo $PAGE->title ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
</head>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
    <?php echo $OUTPUT->standard_top_of_body_html(); ?>
    <div id="page">

    <?php if ($hasframe) { ?>
        <div id="frametop">
            <div id="framebottom">
                <div id="frametopright">
                    <div>&nbsp;</div>
                </div>
                <div id="frameleft">
                    <div id="frameright">
                        <div id="wrapper">
<?php } ?>

<!-- begin of page-header -->
                            <?php if ($hasheading) { ?>
                            <div id="page-header">
							 <div class="header_inner">
<div class="right_text">
                                <div class="headermenu">
                                    <?php
                                    echo $OUTPUT->login_info();
                                    if (($CFG->langmenu) && (!empty($PAGE->layout_options['langmenu']))) {
                                        echo $OUTPUT->lang_menu();
                                    }
                                    echo $PAGE->headingmenu;
                                ?>
                                </div>
                                
                                <div style="clear:both"></div>
     <!-- <span>CENTRE FOR DISTANCE LEARNING</span>--></div>
      
                                <?php  
								 
								if($PAGE->theme->settings->headercontent == 2)
								 {
								  
								 }
								 else
								 {
								 if ($displaylogo) { ?>
                                    <div id="headerlogo">
                                        <img src="<?php echo $logourl ?>" alt="Custom logo here" />
                                    </div>
                                <?php } else { ?>
                                    <h1 class="headerheading"><?php echo $PAGE->heading ?></h1>
                                <?php } ?>
		                         <?php } ?>  
		 <div style="width:100%; position:relative; float:left;   text-align:center; margin:-78px 0 0 0;">
         <!-- <img src="<?php //echo $OUTPUT->pix_url('banner', 'theme')?>" alt="banner" border="0" style=" position: absolute;  margin: auto; top: 0; left: 0; right: 0; bottom: 0;"  />-->
         
       <!--  <img src="<?php echo $bannerurl ?>" alt="banner" border="0" style="   margin-bottom:-5px; top: 0; left: 0; right: 0; bottom: 0;"  /> -->
		  <img src="<?php echo $bannerurl ?>" alt="banner" border="0" style="   margin-bottom:-5px; top: 0; left: 0; right: 0; bottom: 0;"  />
         </div>


                            </div></div>
                            <?php } ?>
<!-- end of page-header -->

<!-- begin of custom menu -->
                            <?php if ($hascustommenu) { ?>
                            <div id="custommenu"><?php echo $custommenu; ?></div>
                            <?php } ?>
<!-- end of custom menu -->

<!-- begin of navigation bar -->
                            <?php if ($hasnavbar) { ?>
                            <div class="navbar clearfix">
                                <div class="breadcrumb"><?php echo $OUTPUT->navbar(); ?></div>
                                <div class="navbutton"><?php echo $PAGE->button; ?></div>
                            </div>
                            <?php } ?>
<!-- end of navigation bar -->

<!-- start of moodle content -->
                            <div id="page-content">
                                <div id="region-main-box">
                                    <div id="region-post-box">

                                        <!-- main mandatory content of the moodle page  -->
                                        <div id="region-main-wrap">
                                            <div id="region-main">
                                                <div class="region-content">
                                                    <?php echo $OUTPUT->main_content() ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end of main mandatory content of the moodle page -->


                                        <!-- left column block - diplayed only if... -->
                                        <?php if ($hassidepre) { ?>
                                        <div id="region-pre" class="block-region">
                                            <div class="region-content">
                                                <?php echo $OUTPUT->blocks_for_region('side-pre') ?>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <!-- end of left column block - diplayed only if... -->

                                        <!-- right column block - diplayed only if... -->
                                        <?php if ($hassidepost) { ?>
                                        <div id="region-post" class="block-region">
                                            <div class="region-content">
                                                <?php echo $OUTPUT->blocks_for_region('side-post') ?>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <!-- end of right column block - diplayed only if... -->

                                    </div>
                                </div>
                            </div>
<!-- end of moodle content -->

                            <div class="clearfix"></div>

<?php if ($hasframe) { ?>
                        </div> <!-- </wrapper> -->
                    </div> <!-- </frameright> -->
                </div> <!-- </frameleft> -->
                <div id="framebottomright">
                 
                </div>
            </div> <!-- </framebottom> -->
        </div> <!-- </frametop> -->

<?php }

if ($hasfooter) {
    if ($hasframe) { ?>

        <!-- START OF FOOTER -->
        <div id="page-footer">
            <?php if (!empty($PAGE->theme->settings->footnote)) { ?>
            <div id="footerframetop">
                <div id="footerframebottom">
                    <div id="footerframetopright">
                        <div>&nbsp;</div>
                    </div>
                    <div id="footerframeleft">
                        <div id="footerframeright">

                            <!-- the content to show -->
                            <div id="footerwrapper">
                                <?php echo $PAGE->theme->settings->footnote; ?>
                            </div> <!-- </footerwrapper> -->

                        </div> <!-- </footerframeright> -->
                    </div> <!-- </footerframeleft> -->
                    <div id="footerframebottomright">
                        <div>&nbsp;</div>
                    </div>
                </div> <!-- </footerframebottom> -->
            </div> <!-- </footerframetop> -->
            <?php }
            //one more div is waiting to be closed

    } else { ?>

        <!-- START OF FOOTER -->
        <div id="page-footer" class="noframefooter">
            <?php if (!empty($PAGE->theme->settings->footnote)) { ?>
            <div id="page-footer-content">

                <!-- the content to show -->
                <div id="footerwrapper">
                    <?php echo $PAGE->theme->settings->footnote; ?>
                </div> <!-- </footerwrapper> -->

            </div> <!-- </page-footer-content> -->
            <?php }
            //one more div is waiting to be closed

    } ?>

            <div class="moodledocsleft">
                <?php
                echo $OUTPUT->login_info();
                if ($PAGE->theme->settings->creditstomoodleorg) {
                    echo $OUTPUT->home_link();
                }
                echo $OUTPUT->standard_footer_html();
                ?>
            </div>
            <div class="moodledocs">
                <?php echo page_doc_link(get_string('moodledocslink')); ?>
            </div>
        </div> <!-- </page-footer> -->
    </div> <!-- </page"> -->

   

<?php  } //the waiting div has been closed: </page-footer>
    echo $OUTPUT->standard_end_of_body_html(); ?>
</body>
</html>