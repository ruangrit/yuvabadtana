<?php
// $Id: html.tpl.php,v 1.9 2011/01/14 03:12:40 jmburnz Exp $

/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE tag.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 * - $in_overlay: TRUE if the page is in the overlay.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 */
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" version="XHTML+RDFa 1.0" dir="<?php print $language->dir; ?>"
  <?php print $rdf_namespaces; ?>>
<head profile="<?php print $grddl_profile; ?>">
  <?php
    if ($_GET['q'] == 'highschool/knowourselves/quiz' || $_GET['q'] == 'highschool/knowourselves') {
      $url_host = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
      $og_title = "แบบทดสอบ มารู้จักตัวเองกันเถอะ - มูลนิธิยุวพัฒน์";
      $og_url = $url_host.'/highschool/knowourselves';
      $og_description = "น้องๆ วัยมัธยมอาจจะกําลังมีคําถามกับตัวเองว่าเราจะไปทางไหนต่อดีเมื่อถึงช่วงที่ต้องเลือกทางเดินของชีวิต บางคนอาจกําลังลังเลไม่แน่ใจ บางคนอาจกําลังสับสน ไม่รู้ว่าเราเหมาะกับสิ่งไหน ลองใช้แบบทดสอบเหล่านี้ เป็นเครื่องมือที่จะทําให้เรามองเห็นตัวเองได้ชัดขึ้น";
      $og_image = $url_host."/highschool/knowourselves";
      ?>
        <meta property="og:title" content="<?php print $og_title;?>" />
        <meta property="og:description" content="<?php print $og_description;?>" />
        <meta property="og:url" content="<?php print $og_url; ?>" />
        <meta property="og:image" content="<?php print $og_image; ?>" />
        <script>
          var og_title = '<?php print $og_title;?>';
          var og_url = '<?php print $og_url;?>';
          setTimeout(function(){
            addthis.update('share', 'url', og_url);
            addthis.update('share', 'title', og_title);

          }, 3000);
        </script>
      <?php
    }

  ?>
  <?php print $head; ?>
  <title><?php print t($head_title); ?></title>
  <?php print $styles; ?>
  <?php print $scripts; ?>
</head>
<?php // modify the layout by changing the id, see layout.css ?>
<body id="genesis-1c" <?php print $attributes;?>>

  <?php if (!$in_overlay): // Hide the skip-link in overlay ?>
    <div id="skip-link">
      <a href="#main-content"><?php print t('Skip to main content'); ?></a>
    </div>
  <?php endif; ?>

  <?php print $page_top; ?>
  <div class="<?php print $classes; ?>">
    <?php print $page; ?>
  </div>
  <?php print $page_bottom; ?>

</body>
</html>
