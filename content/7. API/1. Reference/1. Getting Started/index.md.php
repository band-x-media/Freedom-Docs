---
title: Getting Started
tagline: Connecting External Applications to your Content
---

The most obvious example of an API Application would be a mobile app which presents your content to users.

<div class="toc toc-blue-grey" markdown="1">

### Contents

- [Creating an Application](#createApplication)
- [Endpoint](#endpoint)
- [Constructing Calls](#constructingCalls)
- [Authenticating Users](#authenticatingUsers)
- [Response Fomat](#responseFormat)
- [Statuses](#statuses)
- [Rate Limiting](#rateLimiting)
- [Disabling the API or an Application](#disabling)

</div>


### Creating an Application {#createApplication}

Before you can connect your external code to your content you need to login to your control panel and navigate to `Tools > Applications`

Create an application, give it a name and description (useful if you have several similar applications) and make a note of the `API Key`. This is a unique key given to each application which is used to manage access to your content.

If you want to create an application to access *system calls*, you need to follow the same process in the system panel.

***

### Endpoint {#endpoint}

You can issue `GET` and `POST` requests to the root endpoint (depending on the call requirements):

	https://api.freedo.mx

Only calls requested over HTTPS will be served. All calls should be made this way and every response will be served back over HTTPS.

<pre><code class="language-http">$ curl -i https://api.freedo.mx

HTTP/1.1 200 OK
Server: nginx
Date: <?php echo date('D, d M Y H:i:s'); ?> GMT
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
Vary: Accept-Encoding

{...}

</code></pre>

***

### Constructing Calls {#constructingCalls}

Calls are constructed in a fixed format. Each call uses the base URL, `https://api.freedo.mx/` and then a `module` and `method`

<pre><code class="language-http">https://api.freedo.mx/module/method</code></pre>

Any parameters are passed in the query string. At *minimum*, this will include the application key (also referred to as the API key):

<pre><code class="language-http">https://api.freedo.mx/module/method?appKey=xxxxxxxxxxxxxx</code></pre>

If the method you are calling receives parameters, add them to the query string

<pre><code class="language-http">https://api.freedo.mx/module/method?appKey=xxxxxxxxxxxxxx&amp;param=value</code></pre>

***

### Authenticating Users {#authenticatingUsers}

Some calls will require the user to be authenticated in order to complete their operation. Each user in the database has an email and optionally a password.

In order to authenticate a user, they must first have validated their account and set up a password. If these have not been done, the response will contain an [`error`](#statuses) status.

An adjustment is needed to the base URL if you are authenticating a user:

<pre><code class="language-http">https://api.freedo.mx</code></pre>

*becomes:*

<pre><code class="language-http">https://user@email.com:password@api.freedo.mx</code></pre>

This is a stateless API and therefore requires authentication for each call made that requires it.

***

### Response Format {#responseFormat}

All responses will be formatted in JSON.

<pre><code class="language-javascript">$ curl https://api.freedo.mx

{
	"status": 400,
	"message": "Application authentication failed",
	"data": null,
	"executionTime": 0
}
</code></pre>
Each response has four root nodes:

| Node            | Type       | Description                                                              |
| --------------- | ---------- | ------------------------------------------------------------------------ |
| status          | `int`      | A response status ([list of statuses](#statuses))                        |
| message         | `string`   | An arbitrary message, usually for debugging responses                    |
| data            | `mixed`    | The response data, which can vary [depending on the call](/api/entities) |
| executionTime   | `float`    | The duration (in seconds) the call took to complete                      |

***

### Statuses {#statuses}

Each response will generate a `status` on the root JSON node. It can be:

| Status     | Message                                            | Description                                                                                    |
| ---------- | -------------------------------------------------- | ---------------------------------------------------------------------------------------------- |
| `200`      | Request is OK                                      | *The request was completed without issue*                                                      |
| `400`      | Application authentication failed                  | *The app may not exist or may not be enabled. [Double check your API Key](#createApplication)* |
| `401`      | User authentication failed                         | *The User credentials supplied and incorrect or required and not supplied for this call*       |
| `402`      | Module is invalid                                  | *The requested API **module** is invalid / unavailable*                                        |
| `403`      | Method is invalid                                  | *The requested API **method** is invalid / unavailable*                                        |
| `404`      | User does not have permission to perform operation | *The User failed permission checks*                                                            |
| `405`      | Request method is not valid                        | *The call uses an incorrect [request type](#endpoint) (GET or POST)*                           |
| `500`      | An error occurred processing this request          | *The [message](#responseFormat) will have further information about this error*                |
| `501`      | The API is not available                           | *The API has been [disabled](#disabling) and is not available*                                 |
| `502`      | SSL is required but not used                       | *The request was made using HTTP but we require [HTTPS](#schema)*                              |
| `503`      | API rate limit exceeded for xxx.xxx.xxx.xxx        | *A rate limit is imposed on the calling **IP address***                                        |
| `504`      | API rate limit exceeded for application xxxxxx     | *A rate limit is imposed on the calling **application***                                       |

***

### Rate Limiting {#rateLimiting}

*There are not **currently** any rate limits imposed on API calls*

If and when we implement these in the future, they will take the following format so you can develop future proof applications now:

***

#### IP Address Limit:

<pre><code class="language-javascript">$ curl https://api.freedo.mx[...]

{
	"status": 503,
	"message": "API rate limit exceeded for xxx.xxx.xxx.xxx",
	"data": null,
	"executionTime": 0
}</code></pre>

#### Application Limit:

<pre><code class="language-javascript">$ curl https://api.freedo.mx[...]

{
	"status": 504,
	"message": "API rate limit exceeded for application xxxxxx",
	"data": null,
	"executionTime": 0
}</code></pre>

***

### Disabling the API or an Application {#disabling}

To disable an **application** go to the domain's *admin panel* and navigate to `Tools > Applications`. Select the application, uncheck the checkbox which enables the application and save it. All requests using that API Key will now be responded to with a `501` error.

To disable the **API completely**, you need to be the *system administrator*. Go to your *system panel* and and navigate to `Tools > Applications`. Click the button to disable the API. All calls to the API, regardless of the application being called (or respective status) will now be responded to with a `501` error.
