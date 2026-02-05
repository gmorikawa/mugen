# Troubleshooting

## API Sanctum authentication is redirecting to `/login` on unauthorized access

### Problem

In my case, Laravel is being used only to serve a REST API to a React application.

To authenticate API access, I am using Laravel's Sanctum to read a Bearer Token from the Headers and validate it. If a request to a protected endpoint lacks the `authorization` header with a valid token it should prevent the access to the content and return _status 401 Unauthorized_. But instead, it is returning a _status 302 Found_ redirecting to `/login` under the API's domain.

### Solution

Sanctum can be used on web applications, not only for APIs. To return a JSON response instead of a _Redirect_, the request should include in the headers a `Accept: application/json` value so Sanctum knows it should treat it as a API request.

### References

* [Sanctum override JSON Response (AuthenticationException)](https://laracasts.com/discuss/channels/laravel/sanctum-override-json-response-authenticationexception), accessed on 2026-02-05;