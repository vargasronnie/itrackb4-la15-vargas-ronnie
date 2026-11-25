# ITRACKB4 LA15:


F1: Your project answered one question last week and a second one this week. Name both questions, say which one your policy answers, and point at the file that answers the other.
Last week's question was who are you?, answered by register and login, which live in LoginController.php and RegisterController.php. This week's question is what may you do?, which my RecipePolicy answers, while the auth middleware in routes/web.php answers whether a signed-in user may reach the create, edit, and delete routes at all.

F2: role is not in your User model's $fillable, and yet you set it and saved it in Tinker. Explain why both of those are true, and say what $fillable is actually guarding you against.
$fillable only controls which fields mass assignment, such as User::create($validated), can set from a request. Setting $user->role directly and calling save() bypasses that check, which is why it worked in Tinker. $fillable guards against a form submitting a field like role and promoting the user to admin, so keeping role out of it means my register form can't set it.

F3: A signed-in non-admin typing your create address gets a 403. A guest typing the same address gets your login page. Say which layer produced each response, and why the two are deliberately different.
The signed-in non-admin is past the auth middleware, so the Gate::authorize call in RecipeController@create refuses them with a 403. A guest fails the auth middleware first, which redirects them to the login route. They're different on purpose: a guest should be sent to sign in, while a signed-in user who can't do the action should be told they're not allowed.

F4: Your list and detail pages are still open to everybody, and your policy says so. Explain why that is a decision and not something you forgot.
The catalogue is meant to be browsed by anyone, so viewAny() and view() return true on purpose, and index and show have no authorize call. Only the five changing actions are protected, because browsing doesn't change any data.

F5: The same rule is read by your controller and by your list page. What would go wrong if you had written that role check in both places by hand instead of in a policy?
If the rule were written twice, the two copies could drift apart, so the page might show an Add button that the controller refuses, or hide one it would allow. A policy keeps one definition that both the @can directives and Gate::authorize call, so they always agree.

F6: What does SESSION_LIFETIME count, what does it not count, and why was there no warning before you found yourself logged out?
SESSION_LIFETIME counts minutes of inactivity since the last request, and it doesn't count how long you've been signed in overall. Laravel doesn't warn you, because the session simply expires on the server, and the next request finds no session and redirects you to login.