# php-rest-lightly
a lightweight component for implementing a REST API

this library helps you to leverage namespacing to implicitly define API endpoint routes rather than write them by hand; adding new endpoints wont require you to update a routes list

authentication or other operations can be done within the endpoint classes themselves

# installation instructions
`composer require evalok/php-rest-lightly`

# demo
configure `.htaccess` in `demo/public`

# Examples
* `GET: api/Thing1/555`
```javascript
{
	id: 555,
	owner: {
		*owner: null
	},
	class: "api\v1\Thing1",
	method: "api\v1\Thing1::get",
	message: "testing testing 123",
	params: [ ]
}
```

* `GET: api/v1/Thing1/555/Thing2/777?some=thing`
```javascript
{
	id: 777,
	owner: {
		*id: 555,
		*owner: { }
	},
	class: "api\v1\Thing1\Thing2",
	method: "api\v1\Thing1\Thing2::get",
	message: "testing testing 123",
	params: {
		some: "thing"
	}
}
```

* `api/v1/Restricted/Thing3/888`
```javascript
"403: Forbidden"
```

# TODO
* tests
* versioning deprecation demo
* non-json responses
* support for request headers

