# Wp Remindme + sendy

I'm trying to make a plugin to send a visitor the article by email, and add them to sendy in the process.

## The goal

Basically I want a user to have the following experience on my blog:

- At the end of the article (floating signup maybe?) there is a 'Read later: Send me this article by email'
- User fills first name and email
- Plugin sends post content using sendgrid
- Plugin signs user up to sendy list

## Status

Dry coding right now, no testing done. Just drafting.

# Usage

Make sure to set the variables in the PHP class (API stuff and urls).

I make use of a custom field in sendy called 'Remindme' where the post title is stored. Make sure it actually exists :)

#License

Use this as you will. Tweet me as thanks at <a href="https://twitter.com/ActuallyMentorv">@ActuallyMentor</a>.