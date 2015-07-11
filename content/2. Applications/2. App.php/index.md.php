---
title: App.php File
---

Your App.php file is the base for your application. It **must** extend the super <code class="language-php">App</code> class and implement the <code class="language-php">AppMethods</code> *interface*. It must also be in the <code class="language-php">\App</code> namespace.

<pre><code class="language-php">namespace Freedom\App;
use \Freedom\Framework\System\Base as AppBase;

class MyApplication extends AppBase\App implements AppBase\AppMethods {

	// logic

}</code></pre>

When the App is initialised and the Framework is ready to hand over to it, <code class="language-php">->getCurrentRequestOutput()</code> will be called. This is a binding method from the <code class="language-php">AppMethods</code> interface and it **must be present** on your App class.

Early on in an application's development cycle you must make a decision about how it is going to handle requests. For example, you may wish to use the main <code class="language-php">App</code> method of <code class="language-php">route()</code> or you may wish to implement your own request logic. For more information on handling requests check out the [Application Flow](/applications/flow#routing) page.

<pre><code class="language-php">namespace Freedom\App;
use \Freedom\Framework\System\Base as AppBase;

class MyApplication extends AppBase\App implements AppBase\AppMethods {

	public function getCurrentRequestOutput() {

		$this->route();	# use the utility $app->route() method

		return $this;

	}

}</code></pre>
