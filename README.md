# ITRACKB4 LA12:

H1: The top of your error page named a file inside vendor. Say why that was not where your mistake was, and where the page showed you it actually was.

The top of the error page named a file inside vendor, which is Laravel’s own code, so the mistake wasn’t in Laravel. The real cause was in my own code: the trace showed the frame in app\Http\Controllers\RecipeController.php at index(), where I had added an extra letter to the with() method name.

H2: You wrote one Log::info line with a context array. Name something it will tell you next month that the error page could not.

The error page shows only what happened at that moment, and it’s gone once I reload. The Recipe saved line stays in laravel.log, so next month it will tell me which recipe was saved, when it was saved, and its id, which I can use to find that record in the database.

H3: Your guard answers with 403 instead of redirecting back with a message. Say when each of the two is the better answer.

A 403 is the better answer when the request shouldn’t be allowed at all, such as deleting the last recipe in a cuisine, because the user should not be able to do it by any route. A redirect back with a message is better when the user made a mistake they can fix, such as submitting a form with a missing field, so they can correct it and try again.