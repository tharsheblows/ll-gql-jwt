License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Creates a dummy editor user in WordPress with long lived JWT for use with WPGraphQL.

## Description

If you generate a token via the [WPGraphQL JWT auth plugin](https://github.com/wp-graphql/wp-graphql-jwt-authentication) for the user created in this plugin, it will extend its lifetime to a year and let you know how long you have left on it. (See Settings->Dummy GraphQL user settings in wp-admin.)

When using the token, access to functionality should be handled via the user's role, ie via _authorization_ not authentication as it's not possible to revoke the token. This is a dummy user and should not be used for anything else. Do not use this for a real user who needs to manage their own access.

Please read the WPGraphQL JWT auth plugin documentation on how to generate the token. As it's only an annual event, I'm using Postman to get it.

Using this token allows WPGraphQL to read a WordPress post's raw content (the `edit_posts` capability is required for this) and was built because I wanted something I could use with Netlify but manage in WordPress.
