<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/template.js');

// Add Stylesheets
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/template.css');

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Adjusting content width
if ($this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span6";
}
elseif ($this->countModules('position-7') && !$this->countModules('position-8'))
{
	$span = "span9";
}
elseif (!$this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span9";
}
else
{
	$span = "span12";
}
//
// Initialize Device Detection
//
global $jmwsIdMyGadget;
$jmwsIdMyGadget = null;
require_once 'jmws_idMyGadget_for_joomla/JmwsIdMyGadgetJoomla.php';
$gadgetDetector = $this->params->get('gadgetDetector');

if ( $gadgetDetector == 'mobile_detect' )
{
	$jmwsIdMyGadget = new JmwsIdMyGadgetJoomla( 'mobile_detect' );
}
else if ( $gadgetDetector == 'tera_wurfl' )
{
	$jmwsIdMyGadget = new JmwsIdMyGadgetJoomla( 'tera_wurfl' );
}
else
{
	$jmwsIdMyGadget = new JmwsIdMyGadgetJoomla( 'detect_mobile_browsers' );
}
//
// The phone burger menu was originally intended for phones only, hence the name.
// Now we have options so that, if desired, we can use it on tablets and desktops as well.
//
$jmwsIdMyGadget->phoneBurgerIconThisDeviceLeft = FALSE;
$jmwsIdMyGadget->phoneBurgerIconThisDeviceRight = FALSE;
$phone_burger_icon_canvas_left = '';
$phone_burger_icon_canvas_right = '';
$phone_burger_icon_js_left = '';
$phone_burger_icon_js_right = '';

if ( $jmwsIdMyGadget->getGadgetString() === JmwsIdMyGadget::GADGET_STRING_PHONE )
{
	if ( $this->countModules('phone-burger-menu-left') )
	{
		$jmwsIdMyGadget->phoneBurgerIconThisDeviceLeft = TRUE;
	}
	if ( $this->countModules('phone-burger-menu-right') )
	{
		$jmwsIdMyGadget->phoneBurgerIconThisDeviceRight = TRUE;
	}
}
else if ( $jmwsIdMyGadget->getGadgetString() === JmwsIdMyGadget::GADGET_STRING_TABLET )
{
	if ( $this->countModules('phone-burger-menu-left') &&
	     $this->params->get('phoneBurgerMenuLeftOnTablet') )
	{
		$jmwsIdMyGadget->phoneBurgerIconThisDeviceLeft = TRUE;
	}
	if ( $this->countModules('phone-burger-menu-right') &&
	     $this->params->get('phoneBurgerMenuRightOnTablet') )
	{
		$jmwsIdMyGadget->phoneBurgerIconThisDeviceRight = TRUE;
	}
}
else
{
	if ( $this->countModules('phone-burger-menu-left') &&
	     $this->params->get('phoneBurgerMenuLeftOnDesktop') )
	{
		$jmwsIdMyGadget->phoneBurgerIconThisDeviceLeft = TRUE;
	}
	if ( $this->countModules('phone-burger-menu-right') &&
	     $this->params->get('phoneBurgerMenuRightOnDesktop') )
	{
		$jmwsIdMyGadget->phoneBurgerIconThisDeviceRight = TRUE;
	}
}
//
// If device is a phone,
// o  Add in jquery mobile js and css and idMyGadget code
// o  Create markup for the optional "phone-burger" menus,
//
if ( $jmwsIdMyGadget->getGadgetString() === JmwsIdMyGadget::GADGET_STRING_PHONE )
{
	$doc->addStyleSheet( JmwsIdMyGadget::JQUERY_MOBILE_CSS_URL );
	$doc->addScript( JmwsIdMyGadget::JQUERY_MOBILE_JS_URL );
}
if ( $jmwsIdMyGadget->phoneBurgerIconThisDeviceLeft ||
     $jmwsIdMyGadget->phoneBurgerIconThisDeviceRight )
{
	$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/idMyGadget.css');
	$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/phoneBurgerMenu.js');
}
if ( $jmwsIdMyGadget->phoneBurgerIconThisDeviceLeft )
{
	$phone_burger_icon_canvas_left = '<canvas id="phone-burger-icon-left" ' .
		'width="' . $this->params->get('phoneBurgerMenuLeftSize') . '" ' .
		'height="' . $this->params->get('phoneBurgerMenuLeftSize') . '">' .
		'&nbsp;Menu&nbsp;' . '</canvas>';
	$phone_burger_icon_js_left .=
		'<script>' .
			'var phoneBurgerIconLeftOptions = {};' .
			'phoneBurgerIconLeftOptions.color = "' .$this->params->get('phoneBurgerMenuLeftColor') . '";' .
			'phoneBurgerIconLeftOptions.lineCap = "' .$this->params->get('phoneBurgerMenuLeftLineCap') . '";' .
			'phoneBurgerIconLeftOptions.lineSize = "' .$this->params->get('phoneBurgerMenuLeftLineSize') . '";' .
		'</script>';
}
if ( $jmwsIdMyGadget->phoneBurgerIconThisDeviceLeft )
{
	$phone_burger_icon_canvas_right = '<canvas id="phone-burger-icon-right" ' .
		'width="' . $this->params->get('phoneBurgerMenuRightSize') . '" ' .
		'height="' . $this->params->get('phoneBurgerMenuRightSize') . '">' .
		'&nbsp;Menu&nbsp;' . '</canvas>';
	$phone_burger_icon_js_right .=
		'<script>' .
			'var phoneBurgerIconRightOptions = {};' .
			'phoneBurgerIconRightOptions.color = "' .$this->params->get('phoneBurgerMenuRightColor') . '";' .
			'phoneBurgerIconRightOptions.lineCap = "' .$this->params->get('phoneBurgerMenuRightLineCap') . '";' .
			'phoneBurgerIconRightOptions.lineSize = "' .$this->params->get('phoneBurgerMenuRightLineSize') . '";' .
		'</script>';
}
//
// This is where we set variables equal to bits of device-specific markup
// For example: the logo file or site title param, etc.
//   Note that the logic differs from that used in protostar a bit
//
$logo = '';
if ( $jmwsIdMyGadget->getGadgetString() === JmwsIdMyGadget::GADGET_STRING_PHONE )
{
	if ($this->params->get('logoFilePhone'))
	{
		$logo = '<img src="' . JUri::root() . $this->params->get('logoFilePhone') .'" ' .
			'alt="' . $sitename . '" />';
	}
	elseif ($this->params->get('sitetitlePhone'))
	{
		$logo =
			'<a href="#phone-burger-menu-left" data-rel="dialog">' .
				$phone_burger_icon_canvas_left . '</a>' .
			$phone_burger_icon_js_left .
			'<h2 class="site-title" title="' . $sitename . '">' .
				htmlspecialchars($this->params->get('sitetitlePhone')) . '</h2>' .
			'<a href="#phone-burger-menu-right" class="pull-right" data-rel="dialog">' .
				$phone_burger_icon_canvas_right . '</a>' .
			$phone_burger_icon_js_right;
	}
	else
	{
		$logo =
			'<a href="#phone-burger-menu-left" data-rel="dialog">' .
				$phone_burger_icon_canvas_left . '</a>' .
			$phone_burger_icon_js_left .
			'<h2 class="site-title" title="' . $sitename . '">' . $sitename . '</h2>' .
			'<a href="#phone-burger-menu-right" class="pull-right" data-rel="dialog">' .
				$phone_burger_icon_canvas_right . '</a>' .
			$phone_burger_icon_js_right;
	}
	$sitedescription = $this->params->get('sitedescriptionPhone');
	$fluidContainer = $params->get('fluidContainerPhone');
}
else if ( $jmwsIdMyGadget->getGadgetString() === JmwsIdMyGadget::GADGET_STRING_TABLET )
{
	if ($this->params->get('logoFileTablet'))
	{
		$logo = '<img src="' . JUri::root() . $this->params->get('logoFileTablet') . '" ' .
			'alt="' . $sitename . '" />';
	}
	elseif ($this->params->get('sitetitleTablet'))
	{
		$logo = '<span class="site-title" title="' . $sitename . '">' .
			htmlspecialchars($this->params->get('sitetitleTablet')) . '</span>';
	}
	else
	{
		$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
	}
	$sitedescription = $this->params->get('sitedescriptionTablet');
	$fluidContainer = $params->get('fluidContainerTablet');
}
else   // default to/assume we are on a desktop browser
{
	if ($this->params->get('logoFileDesktop'))
	{
		$logo = '<img src="' . JUri::root() . $this->params->get('logoFileDesktop') . '" ' .
			'alt="' . $sitename . '" />';
	}
	elseif ($this->params->get('sitetitleDesktop'))
	{
		$logo = '<span class="site-title" title="' . $sitename . '">' .
			htmlspecialchars($this->params->get('sitetitleDesktop')) . '</span>';
	}
	else
	{
		$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
	}
	$sitedescription = $this->params->get('sitedescriptionDesktop');
	$fluidContainer = $params->get('fluidContainerDesktop');
}
//
// Set data-role and other attributes to be used with jQuery Mobile
//
$jqm_data_role_page = '';
$jqm_data_role_header = '';
$jqm_data_role_content = '';
$jqm_data_role_footer = '';
$jqm_data_theme_attribute = '';

if ( $jmwsIdMyGadget->getGadgetString() === JmwsIdMyGadget::GADGET_STRING_PHONE )
{
	$jqm_data_role_page = 'data-role="page"';
	$jqm_data_role_header = 'data-role="header"';
	$jqm_data_role_content = 'data-role="content"';
	$jqm_data_role_footer = 'data-role="footer"';

	if ( $this->countModules('phone-header-nav') ||
	     $this->countModules('phone-footer-nav')   )
	{
		$jqm_data_theme_template = $this->params->get('jqm_data_theme');
		if ( $jqm_data_theme_template == 'none' )
		{
			// Although we might have multiple modules, we can access only one value
			// Therefore we prefer that it be set in the template
			$mod_menu_idmygadget = JModuleHelper::getModule('mod_menu_idmygadget');
			$idMyGadgetParams = new JRegistry($mod_menu_idmygadget->params);
			$jqm_data_theme_letter = $idMyGadgetParams['jqm_data_theme'];
		}
		else
		{
			$jqm_data_theme_letter = $jqm_data_theme_template;
		}
		$jqm_data_theme_attribute = 'data-theme="' . $jqm_data_theme_letter . '"';
	}
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
	<?php // Use of Google Font ?>
	<?php if ($this->params->get('googleFont')) : ?>
		<link href='//fonts.googleapis.com/css?family=<?php echo $this->params->get('googleFontName'); ?>' rel='stylesheet' type='text/css' />
		<style type="text/css">
			h1,h2,h3,h4,h5,h6,.site-title{
				font-family: '<?php echo str_replace('+', ' ', $this->params->get('googleFontName')); ?>', sans-serif;
			}
		</style>
	<?php endif; ?>
	<?php // Template color ?>
	<?php if ($this->params->get('templateColor')) : ?>
	<style type="text/css">
		body.site
		{
			border-top: 3px solid <?php echo $this->params->get('templateColor'); ?>;
			background-color: <?php echo $this->params->get('templateBackgroundColor'); ?>
		}
		a
		{
			color: <?php echo $this->params->get('templateColor'); ?>;
		}
		.navbar-inner, .nav-list > .active > a, .nav-list > .active > a:hover, .dropdown-menu li > a:hover, .dropdown-menu .active > a, .dropdown-menu .active > a:hover, .nav-pills > .active > a, .nav-pills > .active > a:hover,
		.btn-primary
		{
			background: <?php echo $this->params->get('templateColor'); ?>;
		}
		.navbar-inner
		{
			-moz-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
			-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
			box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
		}
	</style>
	<?php endif; ?>
	<!--[if lt IE 9]>
		<script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script>
	<![endif]-->
</head>

<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($fluidContainer ? ' fluid' : '');
?>">

	<!-- Body -->
<?php
  if ( $jmwsIdMyGadget->getGadgetString() === JmwsIdMyGadget::GADGET_STRING_PHONE )
  {
    print '<div ' . $jqm_data_role_page . '>';
  }
?>

	<p>$jmwsIdMyGadget->phoneBurgerIconThisDeviceLeft = "<?php echo $jmwsIdMyGadget->phoneBurgerIconThisDeviceLeft ?>"</p>
	<p>$jmwsIdMyGadget->phoneBurgerIconThisDeviceRight = "<?php echo $jmwsIdMyGadget->phoneBurgerIconThisDeviceRight ?>"</p>

	<div class="body">
		<div class="container<?php echo ($fluidContainer ? '-fluid' : ''); ?>">
			<!-- Header -->
			<header class="header" role="banner"
				<?php echo $jqm_data_role_header . ' ' . $jqm_data_theme_attribute ?> >
				<?php if ( $jmwsIdMyGadget->getGadgetString() === JmwsIdMyGadget::GADGET_STRING_PHONE ) : ?>
					<div>
						<jdoc:include type="modules" name="phone-header-nav" style="none" />
					</div>
				<?php endif; ?>
				<div class="header-inner clearfix">
					<a class="brand pull-left" href="<?php echo $this->baseurl; ?>/">
						<?php echo $logo; ?>
						<?php if ($sitedescription) : ?>
							<?php echo '<div class="site-description">' . htmlspecialchars($sitedescription) . '</div>'; ?>
						<?php endif; ?>
					</a>
					<div class="header-search pull-right">
						<jdoc:include type="modules" name="position-0" style="none" />
					</div>
				</div>
			</header>
			<?php if ($this->countModules('position-1')) : ?>
				<nav class="navigation" role="navigation">
					<jdoc:include type="modules" name="position-1" style="none" />
				</nav>
			<?php endif; ?>
			<jdoc:include type="modules" name="banner" style="xhtml" />
			<div class="row-fluid" <?php echo $jqm_data_role_content ?> >
				<?php if ($this->countModules('position-8')) : ?>
					<!-- Begin Sidebar -->
					<div id="sidebar" class="span3">
						<div class="sidebar-nav">
							<jdoc:include type="modules" name="position-8" style="xhtml" />
						</div>
					</div>
					<!-- End Sidebar -->
				<?php endif; ?>
				<main id="content" role="main" class="<?php echo $span; ?>">
					<!-- Begin Content -->
					<jdoc:include type="modules" name="position-3" style="xhtml" />
					<jdoc:include type="message" />
					<jdoc:include type="component" />
					<jdoc:include type="modules" name="position-2" style="none" />
					<!-- End Content -->
				</main>
				<?php if ($this->countModules('position-7')) : ?>
					<div id="aside" class="span3">
						<!-- Begin Right Sidebar -->
						<jdoc:include type="modules" name="position-7" style="well" />
						<!-- End Right Sidebar -->
					</div>
				<?php endif; ?>
			</div> <!-- .row-fluid -->
		</div> <!-- .container -->
	</div> <!-- .body -->
	<!-- Footer -->
	<?php
		if ( $jmwsIdMyGadget->getGadgetString() === JmwsIdMyGadget::GADGET_STRING_PHONE )
		{
			$footerAttributes = $jqm_data_role_footer . ' ' . $jqm_data_theme_attribute;
			if ( $this->countModules('phone-footer-nav') )
			{
				$footerAttributes .= 'class="ui-bar" data-position="fixed"';
			}
		}
		else
		{
			$footerAttributes = 'class="footer" role="contentinfo"';
		}
	?>
	<footer <?php echo $footerAttributes; ?> >
		<?php if ( $jmwsIdMyGadget->getGadgetString() === JmwsIdMyGadget::GADGET_STRING_PHONE ) : ?>
			<jdoc:include type="modules" name="footer" style="none" />
			<jdoc:include type="modules" name="phone-footer-nav" style="none" />
		<?php else : ?>
			<div class="container<?php echo ($fluidContainer ? '-fluid' : ''); ?>">
				<hr />
				<jdoc:include type="modules" name="footer" style="none" />
				<p class="pull-right">
					<a href="#top" id="back-top">
						<?php echo JText::_('TPL_PROTOSTAR_BACKTOTOP'); ?>
					</a>
				</p>
				<p>
					&copy; <?php echo date('Y'); ?> <?php echo $sitename; ?>
				</p>
			</div> <!-- .container or .container-fluid -->
		<?php endif; ?>
	</footer>
	<jdoc:include type="modules" name="debug" style="none" />
	<?php
		// If the gadget-detector is not installed, generate an error message
		//
		if ( ! $jmwsIdMyGadget->isInstalled() )
		{
			$linkToReadmeOnGithub =
				'<a href="' . $jmwsIdMyGadget->getLinkToReadme() . '" target="_blank">' .
				'the appropriate README.md file on github.</a>';
			$application = JFactory::getApplication();
			$application->enqueueMessage(
				JText::_('TPL_PROTOSTAR_IDMYGADGET_DETECTOR_NOT_INSTALLED') . $linkToReadmeOnGithub ,
				'error'
			);
		}
		if ( $jmwsIdMyGadget->getGadgetString() === JmwsIdMyGadget::GADGET_STRING_PHONE )
		{
			print '</div> <!-- ' . $jqm_data_role_page . ' -->';
		}
	?>
	<?php
		if ( $jmwsIdMyGadget->phoneBurgerIconThisDeviceLeft ||
		     $jmwsIdMyGadget->phoneBurgerIconThisDeviceRight ) : ?>
		<jdoc:include type="modules" name="phone-burger-menu-left" style="none" />
		<jdoc:include type="modules" name="phone-burger-menu-right" style="none" />
	<?php endif;?>
</body>
</html>
