<?php
// $Id: page.tpl.php,v 1.13 2011/01/14 03:34:24 jmburnz Exp $

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/garland.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 * - $in_overlay: TRUE if the page is in the overlay.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlight']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 */
?>
<?php if (!$in_overlay): // hide in overlay   ?>

<?php if ($page['leaderboard']): ?>
  <div id="leaderboard" class="clearfix">
    <div class="container clearfix">
      <?php print render($page['leaderboard']); ?>
    </div>
  </div>
<?php endif; ?>

<div id="header" class="clearfix">
  <div class="container clearfix">
    <?php if ($site_logo || $site_name || $site_slogan): ?>
      <div id="branding">

        <?php if ($site_logo or $site_name): ?>
          <?php if ($title): ?>
            <div class="logo-site-name"><strong>
                <?php if ($site_logo): ?><span
                  id="logo"><?php print $site_logo; ?></span><?php endif; ?>
                <?php if ($site_name): ?><span
                  id="site-name"><?php print $site_name; ?></span><?php endif; ?>
              </strong></div>
          <?php else: /* Use h1 when the content title is empty */ ?>
            <h1 class="logo-site-name">
              <?php if ($site_logo): ?><span id="logo"><?php print $site_logo; ?></span><?php endif; ?>
              <?php if ($site_name): ?><span
                id="site-name"><?php print $site_name; ?></span><?php endif; ?>
            </h1>
          <?php endif; ?>
        <?php endif; ?>

        <?php if ($site_slogan): ?>
          <div id="site-slogan"><?php print $site_slogan; ?></div>
        <?php endif; ?>

      </div> <!-- /branding -->
    <?php endif; ?>

    <?php if ($page['header']): ?>
      <div id="header-blocks"><?php print render($page['header']); ?></div>
    <?php endif; ?>

    <?php if ($main_menu_links): ?>
      <div id="main-menu-wrapper" class="clearfix">
        <div class="main-menu-inner"><?php print $main_menu_links; ?></div>
      </div>
    <?php endif; ?>

  </div> <!-- /header -->

  <?php endif; // end hide in overlay ?>
</div>

<?php if (!$page['secondary_content']): ?>
  <div class="messages-section">
    <div class="container clearfix">
      <?php print $messages; ?>
    </div>
  </div>
  <div class="breadcrumb-block">
    <div class="container clearfix">
      <?php print $breadcrumb; ?>
    </div>
  </div>
<?php endif; ?>

<!--
	<div class="messages-section">
		<div class="container clearfix">
			<?php print $messages; ?>		
		</div>
	</div>
-->

<div class="help">
  <div class="container clearfix">
    <?php print render($page['help']); ?>
  </div>
</div>

<?php if ($page['secondary_content'] && !$in_overlay): // hide in overlay ?>
  <div id="secondary-content">
    <div class="messages-section">
      <div class="container clearfix">
        <?php print $messages; ?>
      </div>
    </div>
    <div class="breadcrumb-block">
      <div class="container clearfix">
        <?php print $breadcrumb; ?>
      </div>
    </div>
    <div class="container clearfix">
      <h1 id="page-title"><?php print $title; ?></h1>
      <?php print render($page['secondary_content']); ?>
    </div>
  </div>
<?php endif; ?>

<div class="main">
  <div class="container clearfix">

    <!--<div id="columns" class="clear clearfix">-->
    <div id="content-column">
      <div class="content-inner">

        <?php if ($page['highlighted']): ?>
          <div id="highlighted"><?php print render($page['highlighted']); ?></div>
        <?php endif; ?>

        <div id="main-content">
          <?php print render($title_prefix); ?>
          <?php if ($title && !$page['secondary_content']): ?>
            <h1 id="page-title"><?php print $title; ?></h1>
          <?php endif; ?>
          <?php print render($title_suffix); ?>

          <?php if ($tabs): ?>
            <div class="local-tasks"><?php print render($tabs); ?></div>
          <?php endif; ?>

          <?php if ($action_links): ?>
            <ul class="action-links"><?php print render($action_links); ?></ul>
          <?php endif; ?>

          <div id="content">
            <?php print render($page['content']); ?>
            <h1 class="pagt-title">แบบทดสอบ</h1>
            <p>
              น้องๆวัยมัธยมอาจจะกําลังมีคําถามกับตัวเองว่าเราจะไปทางไหนต่อดีเมื่อถึงช่วงที่ต้องเลือกทางเดินของชีวิต
              บางคนอาจกําลังลังเลไม่แน่ใจ บางคนอาจกําลังสับสน ไม่รู้ว่าเราเหมาะกับสิ่งไหน
              การเรียนรู้ตัวเองและใช้เวลาในการทําความเข้าใจกับตัวตนของเรา เรียนรู้ความชอบ บุคลิกลักษณะ
              ยอมรับข้อดี ข้อด้อยของตัวเอง หากยังไม่แน่ใจ และอยากได้คําแนะนําลองใช้แบบทดสอบเหล่านี้
              เป็นเครื่องมือที่จะทําให้เรามองเห็นตัวเองได้ชัดขึ้นแต่การทําแบบทดสอบไม่ใช่คําตอบสุดท้ายว่าเราคือคนแบบไหนเหมาะกับอะไร
              คําถามต่างๆ จะช่วยให้เราได้มีเวลาคิดและเกิดความเข้าใจตัวเองมากขึ้นท้ายที่สุดแล้ว
              น้องๆสามารถเลือกและกําหนดทางเลือกในชีวิตของเราเองได้เสมอค่ะ
            </p>
            <div class="choice-whoiam">
              <ul class="list-choice">
                <li class="item-choice">
                  <a class="various choice-wrapper" comment_to_field="13" data-fancybox-type="iframe" href="http://sixfac.eduzones.com/test4/">
                    <div class="img-wrapper">
                      <img src="/sites/all/themes/ybf/css/images/middle-school.png" alt="" width="215" height="185">
                    </div>
                    <div class="sub-title">ปิ๊งไอเดียเรียนต่อ...</div>
                    <h3 class="title">มัธยมต้น</h3>
                    <div class="btn-start">คลิกเลย</div>
                  </a>
                </li>
                <li class="item-choice">
                  <a class="various choice-wrapper" comment_to_field="14" data-fancybox-type="iframe" href="http://ez.eduzones.com/test/testself.php">
                    <div class="img-wrapper">
                      <img src="/sites/all/themes/ybf/css/images/junior-school.png" alt="" width="231" height="191">
                    </div>
                    <div class="sub-title">ปิ๊งไอเดียเรียนต่อ...</div>
                    <h3 class="title">มัธยมปลาย</h3>
                    <div class="btn-start">คลิกเลย</div>
                  </a>
                </li>
                <li class="item-choice">
                  <a class="various choice-wrapper" comment_to_field="15" data-fancybox-type="iframe" href="http://ez.eduzones.com/future/">
                    <img src="/sites/all/themes/ybf/css/images/whoiam.png" alt="" width="221" height="189">
                    <div class="sub-title">รู้จักตัวตน</div>
                    <h3 class="title">ของเราให้มากขึ้น</h3>
                    <div class="btn-start">คลิกเลย</div>
                  </a>
                </li>
                <li class="item-choice">
                  <a class="various choice-wrapper" comment_to_field="16" data-fancybox-type="iframe"
                     href="http://ez.eduzones.com/testyourself/">
                    <div class="img-wrapper">
                      <img src="/sites/all/themes/ybf/css/images/what-job.png" alt="" width="214" height="188">
                    </div>
                    <div class="sub-title hidden">อาชีพที่เหมาะสม</div>
                    <h3 class="title">อาชีพไหนใช่เรา</h3>
                    <div class="btn-start">คลิกเลย</div>
                  </a>
                </li>
                <li class="item-choice">
                  <a class="various choice-wrapper" comment_to_field="17" data-fancybox-type="iframe"
                     href="http://sixfac.eduzones.com/future/">
                    <div class="img-wrapper">
                      <img src="/sites/all/themes/ybf/css/images/job-future.png" alt="" width="209" height="201">
                    </div>
                    <div class="sub-title">ทางเลือก</div>
                    <h3 class="title">อาชีพแห่งอนาคต</h3>
                    <div class="btn-start">คลิกเลย</div>
                  </a>
                </li>
              </ul>



            </div>
          </div>
        </div>

      </div>
    </div>

    <?php if ($page['sidebar_first']): ?>
      <div id="sidebar-first" class="sidebar"><?php print render($page['sidebar_first']); ?></div>
    <?php endif; ?>

    <?php if ($page['sidebar_second']): ?>
      <div id="sidebar-second" class="sidebar"><?php print render($page['sidebar_second']); ?></div>
    <?php endif; ?>

  </div> <!-- /columns -->
  <!--</div>-->
</div> <!-- /end main-->

<?php if (!$in_overlay): // hide in overlay ?>

  <?php if ($page['tertiary_content']): ?>
    <div id="tertiary-content">
      <div class="container clearfix">
        <?php print render($page['tertiary_content']); ?>
      </div>
    </div>
  <?php endif; ?>

  <?php if ($page['footer'] || $feed_icons): ?>
    <div id="footer">
      <div class="container clearfix">
        <?php print render($page['footer']); ?>
        <?php print $feed_icons; ?>
      </div>
    </div>
  <?php endif; ?>

<?php endif; // end hide in overlay ?>

<a id="comment_form_trigger" style="display:none" href="#comment_form">Comment form</a>

<div style="display:none">
  <div id="comment_form" class="comment-form modal-wrapper">
    <div class="modal-detail-wrapper">
      <div class="section-comment-form">
        <h2 class="title">รู้สึกอย่างไรบอกกันบ้างน้า</h2>
        <?php
        $form = drupal_get_form('ybf_comment_knowourselves_form');
        print drupal_render($form);
        ?>
      </div>
      <div class="section-thanks">
        <h2 class="title">ขอบคุณนะคะ</h2>
        <div>
           <h2>แชร์ให้เพื่อน</h2>
           <!-- AddThis Button BEGIN -->
           <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
             <a class="addthis_button_facebook"></a>
             <a class="addthis_button_twitter"></a>
             <a class="addthis_button_google_plusone_share"></a>
           </div>
           <script type="text/javascript">var addthis_config = {"data_track_addressbar":true, "pubid":"ra-530d8a0570066cb1"};</script>
           <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#async=1"></script>
           <script type="text/javascript">
           // Call this function once the rest of the document is loaded
           jQuery(document).ready( function() {
             addthis.init()
           });
           </script>
          <!-- AddThis Button END -->
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $ = jQuery;
  $(document).ready(function () {
    var comment_to_field;
    $(".various").click(function () {
      comment_to_field = $(this).attr('comment_to_field'); 
    }); 
    
    var win;
    function popup (url) {
      var width = screen.width-150;
      var height = screen.height-150;
      var left = 75;
      var top = 50;
      params  = 'width='+width;
      params += ', height='+height;
      params += ', top='+top+', left='+left
      params += ', fullscreen=yes';

      win=window.open(url,'windowname4', params);
      if (window.focus) {win.focus()}
      checkWindowClosed()
        return false;
      }

      function checkWindowClosed(){
        var timer = setInterval(function() {
		console.log('check');
		if(win.closed) {
		  clearInterval(timer);
		  console.log('window popup close')

		// Popup comment when close quize
		$("input[name='comment_to_field'").val(comment_to_field);
		setTimeout(function(){ 

		  var comment_label = 'แบบทดสอบ';
		  if (comment_to_field == '13') {
		    comment_label += 'ปิ๊งไอเดียเรียนต่อมัธยมต้น';
		  }
		  else if (comment_to_field == '14') {
		    comment_label += 'ปิ๊งไอเดียเรียนต่อมัธยมปลาย';
		  }
		  else if (comment_to_field == '15') {
		    comment_label += 'รู้จักตัวตนของเราให้มากขึ้น';
		  }
		  else if (comment_to_field == '16') {
		    comment_label += 'อาชีพไหนใช่เรา';
		  }
		  else if (comment_to_field == '17') {
		    comment_label += 'ทางเลือกอาชีพแห่งอนาคต';
		  }
		  $('#comment_label').remove(); 
		  $('#ybf-comment-knowourselves-form').find("label[for='edit-comment']").after("<div id='comment_label'>" + comment_label + "</div>");
		  $('#comment_form_trigger').trigger('click');

                  }, 100);
		}else{
		}
         }, 1000);
       }

    $(".various").click(function (e) {
      e.stopPropagation();
      e.preventDefault();
      var url = $(this).attr('href');
      popup(url);

    });
  
    $(".variousxxx").fancybox({
      maxWidth: 800,
      maxHeight: 600,
      fitToView: false,
      width: '95%',
      height: '95%',
      autoSize: false,
      closeClick: false,
      openEffect: 'none',
      closeEffect: 'none',
      afterClose: function () {
        // Popup comment when close quize
        $("input[name='comment_to_field'").val(comment_to_field);
        setTimeout(function(){ 

          var comment_label = 'แบบทดสอบ';
          if (comment_to_field == '13') {
            comment_label += 'ปิ๊งไอเดียเรียนต่อมัธยมต้น';
          }
          else if (comment_to_field == '14') {
            comment_label += 'ปิ๊งไอเดียเรียนต่อมัธยมปลาย';
          }
          else if (comment_to_field == '15') {
            comment_label += 'รู้จักตัวตนของเราให้มากขึ้น';
          }
          else if (comment_to_field == '16') {
            comment_label += 'อาชีพไหนใช่เรา';
          }
          else if (comment_to_field == '17') {
            comment_label += 'ทางเลือกอาชีพแห่งอนาคต';
          }
          $('#comment_label').remove(); 
          $('#ybf-comment-knowourselves-form').find("label[for='edit-comment']").after("<div id='comment_label'>" + comment_label + "</div>");
          $('#comment_form_trigger').trigger('click');

        }, 1000);
 
        
      }
    });
    
    $("#comment_form_trigger").fancybox({
      beforeLoad: function () {
        $('#comment_form').find('.section-thanks').hide();
        $('#comment_form').find('.section-comment-form').show();
        $('#comment_form').find('#edit-comment').val('');
        $('#comment_form').find('#comment-ajax').html('');

      },
      afterClose: function () {
        // Popup comment when close quize
        console.log('close popup comment');
        
      }

    });
    
    $('#comment_form').find('#edit-cancel').prop("type", "button");
    $('#comment_form').find('#edit-cancel').click(function () {
      $.fancybox.close();
    });
    
  });
</script>
