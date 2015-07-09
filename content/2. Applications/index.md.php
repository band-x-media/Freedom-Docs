---
title: Applications
tagline: Applications output your content
---

<div class="container" markdown="1">

<div class="toc toc-blue-grey" markdown="1">

### Contents

- [About Applications](#about)
- [Application Scope](#scope)
- [Creating an Application](#create)
- [Application Structure](#structure)

</div>


## About Applications {#about}

The Framework itself offers base models and classes to manage and manipulate data on disk and in databases.

An Application can extend that functionality and implement the logic for displaying it.

In a crude sense, the framework offers the *models* and *services* whilst an Application offers the *controllers* and *views*.

Learn more about the [Application Flow](/applications/flow)

***

## Application Scope {#scope}

Applications are usually tied to the **[public interface](/system/interfaces)**.

When creating a domain in your system panel, you can select an Application to use to render the domain.

There is a default application to render website but you can write a custom one and enable it on a per domain basis. This offers a huge amount of customisability to build web applications as well as websites.

There are two special applications that are not available to be tied to domains - in other words, they are generic and tied to interfaces rather than a domain:

| Application | Interface    | Description         |
| ----------- | ------------ | ------------------- |
| Admin       | `www_admin`  | The admin application handles all requests on any domain to `/admin`. These requests are forwarded to the admin nodes explicitly using that interface.  |
| System      | `www_system` | The system application handles all requests to the special system domain you have configured. This is routed to the service nodes using that interface. |



***

## Creating an Application {#create}

Applications are located in `/srv/applications`. To create a new application, create a new directory using CamelCase.

You application files live within that directory.

***

## Application Structure {#structure}

Your application should follow a strict format.

- [App.php](/applications/app-php)
- [config.json](/applications/config)
- layouts/
	- layout.php
- modules/
	- [Module](modules/structure)
- assets/


</div>
