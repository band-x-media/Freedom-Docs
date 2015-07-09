---
title: Events
tagline: Events allow you to set up listeners or fire events for listeners to handle
---

<div class="toc toc-blue-grey" markdown="1">

### Contents

- [Instantiation](#introduction)
- [Adding Event Listeners](#adding)
- [Removing an Event Listener](#removing)
- [Firing Events](#firing)
- [Prioritisation](#prioritisation)
- [Stopping Events](#stoppingEvents)
- [Application Events](#application)

</div>

### Introduction {#introduction}

The Event Tower is a critical element in the decoupled design of the Framework.

It allows for modules to communicate with each other and offers the chance to manipulate content as it is passed around or execute code in response to something happening.

***

### Adding Event Listeners {#adding}

There are two ways to add event listeners:

1.	In a module's index.php file add (or update) a public $events variable with an array such as:

	<pre><code class="language-php">[
		"eventName" => "event.name.to.observe",
		"handlerClass" => "EventHandlerClass",
		"handlerMethod" => "eventHandlerMethod"
	]</code></pre>

2.	Add the event within a script:

	<pre><code class="language-php">EventTower::register("event.name.to.observe", [
		"EventHandlerClass",
		"eventHandlerMethod"
	]);</code></pre>

***

### Firing Events {#firing}

Firing an event is pretty simple but handling the results can be complicated depending on what you're trying to achieve.

<pre><code class="language-php">$results = EventTower::fire("event.name.to.observe");</code></pre>

***

### Prioritisation {#prioritisation}

Events can be given a numeric priority rating with 1 being the highest priority. Before the Event Tower fires the events it sorts them by priority and executes them in order.

Consider the following:

<pre><code class="language-php">EventTower::register("event.name.to.observe", ["EventHandlerClass1", "eventHandlerMethod"], 2);

EventTower::register("event.name.to.observe", ["EventHandlerClass2", "eventHandlerMethod"], 1);</code></pre>

In this example, <code class="language-php">EventHandlerClass2::eventHandlerMethod()</code> will be called before <code class="language-php">EventHandlerClass1::eventHandlerMethod()</code>.

This can be particularly useful when combined with [stopping events](#stoppingEvents)

***

### Stopping Events {#stoppingEvents}

Registering events to stop future events can be a useful way to guarantee output from one lister. Consider the example again, with one change:

<pre><code class="language-php">EventTower::register("event.name.to.observe", ["EventHandlerClass1", "eventHandlerMethod"], 2);

EventTower::register("event.name.to.observe", ["EventHandlerClass2", "eventHandlerMethod"], 1, true);</code></pre>

Now, when the event is fired and the handler <code class="language-php">EventHandlerClass2::eventHandlerMethod()</code> has executed, <code class="language-php">EventHandlerClass1::eventHandlerMethod()</code> **will not run**

This is very useful when passing parameters by reference that should *only be operated on once*, such as manipulating page content.

***

### Application Events {#application}

| Event Name                         | Description | Returns
| -----------------------------------|------------ | -------
| `app.render.getAlternativeContent` | an applications wants to get a response to a non standard page, such as a 404 or when the user needs to be logged in, but aren't | Nothing; the passed param `$app->_UI_HTMLPage` should be updated to reflect the new content
