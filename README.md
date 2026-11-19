# ITRACKB4 LA14:

F1: Authentication and authorisation are not the same. In one sentence each: what did this lesson give you, and what is still missing next meeting?
Authentication is proving who you are, and this lesson gave me register, login, and logout, so visitors can create accounts and sign in. Authorisation is deciding what a signed-in user may do, and that is still missing, since every signed-in user can currently edit or delete any recipe.

F2: Why does a successful login call session()->regenerate()? What goes wrong if you skip it?
Calling regenerate() gives the session a new ID at the moment of login, so an ID that an attacker planted before login becomes useless. Without it, a session-fixation attack could let someone who knows the old ID take over the account once the victim signs in.

F3: Why does a failed login use the same message for a wrong password and an unknown email?
Showing different messages would tell a stranger which emails are registered, which helps them target real accounts. Returning one generic message, “The provided credentials do not match our records.”, means both cases look identical from outside.

F4: Why do index and show stay public while create/edit/update/destroy use auth?
The list and detail pages are the catalogue, and guests should be able to browse it without an account. Creating, changing, and deleting recipes change the data, so those five actions are the ones that need a signed-in user.

F5: You hid Add (and actions) for guests. Why is that not enough to secure those actions? What actually stops a stranger?
Hiding a button only changes what the page shows, so a stranger can still type the URL or send a request directly. The auth middleware in routes/web.php is what actually stops them, because it redirects any guest to login before the controller runs.

F6: In screenshot 20 the route name was wrong. Why does auth middleware care that the route is named exactly login?
When a guest is blocked, the auth middleware redirects them to the route named login, looking it up by name rather than by URL. If the name is wrong, Laravel can’t find the route and throws Route [login] not defined, so the redirect fails.