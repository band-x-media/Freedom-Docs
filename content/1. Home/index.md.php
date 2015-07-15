---
title: Overview
---

<!--
The framework is designed to give you core functionality for many of the common tasks involving websites and applications out of the box such as pages and images.

You can write an app in minutes that uses the architecture of the framework to create rich applications.
-->

<?php

	foreach([
		[
			"title" => "Writing Applications",
			"link" => "/applications",
			"description" => "<p>Learn about writing applications which use the Framework natively such as web applications.</p>",
			"icon" => "extension",
			"colour" => "blue"
		],
		[
			"title" => "API",
			"link" => "/api",
			"description" => "<p>Learn about writing external applications which access content from the Framework via a publicly accessible API.</p>",
			"icon" => "code",
			"colour" => "pink"
		],
		[
			"title" => "Theming",
			"link" => "/themes",
			"description" => "<p>Learn about how to write themes and applying them to your website or application.</p>",
			"icon" => "format_paint",
			"colour" => "green"
		],
		[
			"title" => "Writing Modules",
			"link" => "/modules",
			"description" => "<p>Modules offer flexible, decoupled functionality to the Framework. Learn how to integrate them into your application.</p>",
			"icon" => "widgets",
			"colour" => "orange"
		],
		[
			"title" => "Managing your System",
			"link" => "/system",
			"description" => "<p>If you are responsible for maintaining an implementation of the Freedom Framework, start here to understand how the system works.</p>",
			"icon" => "dns",
			"colour" => "red"
		],
		[
			"title" => "Managing Content",
			"link" => "https://help.freedo.mx",
			"description" => "<p>If you are a site administrator, you may want to read these help documents to understand how to manage your sites content.</p>",
			"icon" => "open_in_browser",
			"colour" => "indigo"
		]
	] as $item) {

?>

<div class="col-md-4">

	<div class="card paper">

		<div class="tile tile-sm bg-<?php echo $item["colour"]; ?>">

			<div class="margin">

				<div class="tile-bottom no-bg">

					<?php echo $item["title"]; ?>
					<?php echo UI_Icon::create("material", $item["icon"], "xxl", ["text-" . $item["colour"], "pull-right"]); ?>

				</div>

			</div>

		</div>

		<div class="content" data-mh="feature">

			<?php echo $item["description"]; ?>

		</div>

		<div class="action-area border-top clearfix">

			<span class="pull-right">
				<a href="<?php echo $item['link']; ?>" class="btn btn-sm text-<?php echo $item["colour"]; ?> btn-inverted">Learn More</a>
			</span>

		</div>

	</div>

</div>

<?php } ?>
