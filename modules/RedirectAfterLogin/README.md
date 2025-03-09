# Redirect After Login

This Omeka S module adds support for a `redirect_url` query parameter to /login
route. It allows to change where users are redirected after a successful login.
`redirect_url` must start with `/` (absolute URLs are forbidden for security
reasons).

Already logged in users that hit the `/login` page with a `redirect_url` query
parameter set are automatically redirected to the value of `redirect_url`
parameter without seeing the login form.

## Usage

In your theme, you can use:

```php
<?php echo $this->hyperlink('Login', $this->url('login', [], ['query' => ['redirect_url' => '/s/site1']])); ?>
```

## License

GPL 3.0 or later
