---
title: User Account
---

<div class="toc toc-blue-grey" markdown="1">

### Contents

- [Getting the Current user](#current)
- [Getting Privileges](#privileges)
- [Getting Group Membership](#membership)

</div>

### Getting the Current user {#current}

The current user can be accessed with the following:

<pre><code class="language-php">$me = UserAccount::me();</code></pre>

Or by the global function:

<pre><code class="language-php">$me = me();</code></pre>


If the user is not currently logged in, the returned value will be an empty `UserAccount` object. This is a deliberate design decision so that chained queries will work if a user is logged in or not without throwing a Fatal Error:

<pre><code class="language-php">if(!UserAccount::me()->isLoggedIn()) {
	echo "You need to log in";
}</code></pre>

If you have previously called <code class="language-php">UserAccount::me()</code> there is **no additional expense to calling it again** - the response is cached on the *private static variable* <code class="language-php">$_me</code>.

***

### Getting Privileges {#privileges}

Read more about groups to get an understanding of the different types.

There are two special privileges users can have when they are logged in:

1.	**Administrator**

	Administrators are users who are a member of at least one administration group type.

	<pre><code class="language-php">User::me()->isAdministrator()</code></pre>

	***

2. **Super User**

	Super User status is not associated with the membership of any groups. It is a field on the UserAccount object itself.

	<pre><code class="language-php">User::me()->isSuperUser()</code></pre>

	It is not currently possible to manage Super User status via any administration or system applications. Because they are rare, they must currently be set directly in the database.

***

### Getting Group Membership {#membership}

Users can belong to [Groups](/modules/reference/users/group), for a number of reasons (access to resources, mailing lists etc).

To find out whether a user belongs to a group, call <code class="language-php">$user->isMemberOf($groups)</code>

The <code class="language-php">$groups</code> parameter can be single or multiple and can be the UserAccountGroup <code>_id</code> or [<code>UserAccountGroup</code>](/modules/reference/users/group) object:

<pre><code class="language-php">$user = UserAccount::me();

// using Group _id
if(!$user->isMemberOf(new MongoId("---"))) {
}

if(!$user->isMemberOf([
	new MongoId("---1"),
	new MongoId("---2"),
])) {
}

//	using Group objects
if(!$user->isMemberOf(UserAccountGroup::id("---"))) {
}

if(!$user->isMemberOf([
	UserAccountGroup::id("---1"),
	UserAccountGroup::id("---2"),
])) {
}</code></pre>

After you have called this method, the user groups will be stored on the UserAccount object. If you then change the user's group membership, you need to refresh the groups by passing the second optional parameter:

<pre><code class="language-php">if(!UserAccount::me()->isMemberOf("---", true)) {
}</code></pre>
