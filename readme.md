# SilverStripe Bootstrap Carousel

This module provides an easy way to include a [Bootstrap 4 Carousel](https://getbootstrap.com/docs/4.0/components/carousel/)
in your site.

## Requirements
 * SilverStripe ^4
 * Bootstrap 4

## Installation
Install via Composer

```
composer require twohill/silverstripe-carousel
```

## License
3-clause BSD. See [License](license.md)


## Documentation

Ensure you include jQuery and Bootstrap javascript on your page. Because people use many different versions of 
jQuery this module does *not* make any assumptions as to what version you are using.

Suggested code to be included in `Page.ss`

```html
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
```

The template used is in [templates/Includes/Carousel.ss](templates/Includes/Carousel.ss). To override this, simply
copy into your `theme/Includes` folder.

See [Bootstrap 4 Carousel](https://getbootstrap.com/docs/4.0/components/carousel/) for available options to override.


## Maintainers
 * Al Twohill <al@twohill.nz>
 
## Bugtracker
Bugs are tracked in the issues section of this repository. Before submitting an issue please read over 
existing issues to ensure yours is unique. 
 
If the issue does look like a new bug:
 
 - Create a new issue
 - Describe the steps required to reproduce your issue, and the expected outcome. Unit tests, screenshots 
 and screencasts can help here.
 - Describe your environment as detailed as possible: SilverStripe version, Browser, PHP version, 
 Operating System, any installed SilverStripe modules.
 
Please report security issues to the module maintainers directly. Please don't file security issues in the bugtracker.
 
## Development and contribution
If you would like to make contributions to the module please ensure you raise a pull request and discuss with the module maintainers.
