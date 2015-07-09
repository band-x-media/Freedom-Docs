---
title: Config File
tagline: Configure your Application within the Framework
---

Please note that the settings in the config file configure how an application behaves. Some Applications offer [customisation on a domain level](/applications/domain-parameters), which is done via the System Panel.

Each application has a config file with a number of parameters. When we initialise an App, we load the config file and add the App parameters over the defaults:

| Parameter        |            | Description
| ---------------- | ---------- | ------------------------------------------------------------------------------------------------------- |
| name             | required   | The name of the application                                                                             |
| id               | required   | A unique ID of the application - this is used when storing an application against a domain, for example |
| userRequirements | *optional* | A JSON object with [User Requirements](#userRequirements)                                               |

***

### User Requirements {#userRequirements}

These parameters configure how we should handle user status. For example if you want your users to login before they can access the site, you can use the "login" : true parameter

| Parameter        |            | Description
| ---------------- | ---------- | ----------------------------------------------------------------------- |
| login            | *optional* | Users must be logged in to access the site                              |
| admin            | *optional* | Users must be logged **AND** be an **Administrator** to access the site |
| superUser        | *optional* | Users must be logged **AND** be a **Super User** to access the site     |


***

### Example Config File {#example}


<pre><code class="language-javascript">{
	"name": "My App Name",
	"id": "my-app-id",
	"userRequirements": {
		"login": true,
		"admin": false,
		"superUser": false
	}
}</code></pre>