---
title: Admin & System
---

The admin and system applications are virtually identical, except how they are accessed and the controllers / views.

For the purposes of the documentation, we will **refer to the admin application** but the same **logic applies to the system application** unless otherwise stated.

***

The admin application makes use of the <code class="language-php">$app->route()</code> method which takes the current <code class="language-php">$path</code> and uses the *first element* to find a *controller* and the *second element* to identify a *public object method* on that controller (<code class="language-php">index()</code> by default). Anything else on the route is passed to the method as a *first param* and the <code class="language-php">App</code> itself is passed as the *second param*. You can then manipulate the app on the controller

<pre><code class="language-php">public function index($params, $app) {

	$app->page()->head['title'] = "New Title";

	$app->layout = "anotherLayout";

}</code></pre>

### Page Configuration

| $adminApp->$var | type        | Description |
| --------------- | ----------- | ----------- |
| _breadcrumbs    | `array`     | A multidimensional array containing [breadcrumbs](#breadcrumbs) content and `href`
| _tabs           | `array`     | A multidimensional array containing the [tab](#tabs) items and highlight colour
| _appBarButtons  | `array`     | 
| _appBarFab      | `UI_Button` | 
| _sidebar        | `array`     | 


#### _breadcrumbs {#breadcrumbs}

<pre><code class="language-php">$app->_breadcrumbs = [
	[
		"href" => "/path",
		"content" => "Path"
	],
	[
		"href" => "/path/second",
		"content" => "Second Page"
	],
	[
		"href" => "/path/second/third",
		"content" => "Third"
	]
];</code></pre>

When rendering the breadcrumbs, we iterate from the first element to the last.

We use a divider span, <code class="language-markup">&lt;span class=&quot;divider&quot;&gt;&#10095;&lt;/span&gt;</code>, to separate the crumb trail.

The last element does not create a link (it is the current page), so the example above will output:

<pre><code class="language-markup">&lt;span class=&quot;hidden-sm hidden-xs&quot;&gt;

	&lt;a href=&quot;/path&quot;&gt;Path&lt;/a&gt;
	&lt;span class=&quot;divider&quot;&gt;&#10095;&lt;/span&gt;

	&lt;a href=&quot;/path/second&quot;&gt;Second Page&lt;/a&gt;
	&lt;span class=&quot;divider&quot;&gt;&#10095;&lt;/span&gt;

&lt;/span&gt;

Third</code></pre>

***

#### _tabs {#tabs}

<pre><code class="language-php">$app->_tabs = [
	"colour" => "yellow",
	"items" => [
		[
			"href" => "/path/tab-1",
			"content" => "Tab 1",
			"active" => true
		],
		[
			"href" => "/path/tab-2",
			"content" => "Tab 2",
			"active" => false
		],
		[
			"href" => "/path/tab-3",
			"content" => "Tab 3",
			"active" => false
		]
	]
];</code></pre>

When rendering the breadcrumbs, add an active bool to display the correct tab context.

The colour value will change the bottom border of the active (and :hover) tab. Use a primary colour from [here](http://code.band-x.media/SASS-Material-Design-for-Bootstrap/styles/colours/).

<pre><code class="language-markup">&lt;ul class=&quot;nav nav-tabs nav-ripple nav-tab-yellow&quot;&gt;

	&lt;li role=&quot;presentation&quot; class=&quot;active&quot;&gt;

		&lt;a href=&quot;/path/tab-1&quot;&gt;
			Tab 1 
		&lt;/a&gt;

	&lt;/li&gt;

	&lt;li role=&quot;presentation&quot;&gt;

		&lt;a href=&quot;/path/tab-2&quot;&gt;
			Tab 2 
		&lt;/a&gt;

	&lt;/li&gt;

	&lt;li role=&quot;presentation&quot;&gt;

		&lt;a href=&quot;/path/tab-3&quot;&gt;
			Tab 3 
		&lt;/a&gt;

	&lt;/li&gt;

&lt;/ul&gt;</code></pre>
