---
title: Flow
tagline: Before you start writing applications it's important to understand how an application is processed
---

<div class="toc toc-blue-grey" markdown="1">

### Contents

- [Instantiation](#instantiation)
- [AppController](#appController)
- [Rendering](#rendering)

</div>

### Instantiation {#instantiation}

The very first point that an App will be initialised is in the handling [interface](/system/interfaces), as the parameter for an AppController:

<pre><code class="language-php">//	initialise the application
$appName = "MyApp";
$controller = new AppController(new $appName);</code></pre>

The controller will then be asked to <code class="language-php">render()</code> the application:

<pre><code class="language-php">$controller->render();</code></pre>

If the <code class="language-php">render()</code> returns a value (i.e. it doesn't output anything to the browser) then the rest of the interface script will run.

***

### AppController {#appController}

The App Controller sets a [<code class="language-php">UI_HTMLPage()</code>](/modules/reference/ui/html-page) object onto the App for it to manipulate.

Although it is technically possible, **an App shouldn't output directly to the browser unless strictly necessary**. The [<code class="language-php">AppController()</code>](/system/controllers/app-controller) inherits from the [<code class="language-php">BaseController()</code>](/system/controllers/base-controller) which handles the preparation of the output (such as content filtering) and not returning the App to the controller will bypass this.

***

### Rendering {#rendering}

1. When the AppController is setup and <code class="language-php">render()</code> is called, the AppController hands over to the <code class="language-php">prepareOutput()</code> on the `App` super class, which check whether it can be shown to the user by inspecting the App's [config file](/applications/config).

2. If it can display, <code class="language-php">getCurrentRequestOutput()</code> is called on the App itself and the App is then handed the responsibility to do the work generating the page content against the [<code class="language-php">UI_HTMLPage()</code>](/modules/reference/ui/html-page) object.

3. If the page requested can't be displayed (for example we require login but a user is not logged in), we fire a `app.render.getAlternativeContent` [event](/system/events) and when a responder returns a result, we collect the content and pass it back to the AppController to display. When the event is fired, we pass the following parameters so that a responder can choose whether to deal with the request or not:

	<pre><code class="language-php">EventTower::fire("app.render.getAlternativeContent", [
		"app" => &$this,
		"reason" => [
			"status" => 401,
			"message" => "App requires login but the user is not logged in"
		]
]);</code></pre>

	Possible reasons an app may not be able to render a page are:

	| Status | Message                                          |
	| ------ | ------------------------------------------------ |
	| `401`  | App requires login but the user is not logged in |
	| `403`  | App requires permissions this user does not have |

Of course, if an Application wants a user to login, reset a password etc, it will want it's own branded display. Therefore it needs to handle the event correctly and return as soon as possible, at the top of the priority list for the handler. If an app doesn't implement it's own login system, we use the one provided by the framework.

The correct way to handle this event is to add an event listener in [App.php](/applications/app-php) within the <code class="language-php">__construct</code> method, **after** <code class="language-php">parent::__construct()</code> has been called:

<pre><code class="language-php">class MyApp extends App implements AppMethods {

	public function __construct() {

		parent::__construct();

		EventTower::register("app.render.getAlternativeContent", ["MyApp", "getAlternativeContent"], 1, true);

	}

</code></pre>


You can then update the <code class="language-php">UI_HTMLPage</code> and return to close. The edited <code class="language-php">UI_HTMLPage</code> will now be used as the output:

<pre><code class="language-php">	public static function getAlternativeContent($event, $params) {
	
		$app = $params['app'];
		$reason = $params['reason'];

		switch($reason['status']) {

			case 401:
				$app->_UI_HTMLPage->head["title"] = "Login";
				$app->_UI_HTMLPage->body["content"] = new View("users", "registration/login");
				$app->_UI_HTMLPage->defaultPage();
				return $app;
			break;

		}

	}

}</code></pre>

