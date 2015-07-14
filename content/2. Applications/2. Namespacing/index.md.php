---
title: Namespacing
tagline: Namespacing your Application correctly will help prevent conflicts
---

Your application should use its own [namespace](http://php.net/manual/en/language.namespaces.rationale.php){target=_blank}. This is especially important for applications which use the internal method <code class="language-php">$this->route()</code> so that we can properly locate the class files you want to call.

The application itself should be in the <code class="language-php">Freedom\App</code> namespace so it can be called with <code class="language-php">Freedom\App\MyApplication()</code>:

<pre><code class="language-php">namespace Freedom\App;

use \Freedom\Framework\System\Base as AppBase;

class MyApplication extends AppBase\App implements AppBase\AppMethods {

}</code></pre>


## Modules

Modules should add their controllers and models to the relevant namespace of the application, such as:

1.	Controllers

	<pre><code class="language-php">namespace Freedom\App\MyApplication\Controllers;

	class MyController {

		public function index() {

		}

	}</code></pre>

2.	Models:

	<pre><code class="language-php">namespace Freedom\App\MyApplication\Models;

	class MyModel extends \M {

		// class info here

	}</code></pre>
