# ITRACKB4 LA13:

J1: Your HomeController is not a resource controller. Name two things an index() on a resource controller does that yours does not have to.

A resource controller’s index() loads a collection of records for a list page, and it’s the entry point for browsing them. My HomeController only returns the front page with two counts, so it doesn’t need to load a list of records or handle the other resource actions, such as create(), store(), edit(), update(), and destroy().

J2: Your pagination links lost the search term until you added one method. Say what those links contained before, and what the controller therefore received.

Before I added withQueryString(), the page 2 link contained only ?page=2, so the search term was dropped. The controller therefore received only the page number, and it returned every recipe instead of the matches. withQueryString() copies the current query parameters, such as search, into each pagination link, so the controller receives both values.

J3: A misspelled sort value does not break your page. Explain why that is worse than an error, and what your allowed list does about it.

A misspelled sort value like nmae doesn’t produce an error, so nobody notices the sort isn’t working, and the list just comes back in no particular order. An error would at least be reported, while this silent failure goes unnoticed and could behave differently on another database. My allowed list checks the value against ['name', 'time'] before it reaches orderBy(), and falls back to name if it isn’t on the list.