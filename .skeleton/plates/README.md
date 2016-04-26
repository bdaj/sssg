# My Static Site

This sample skeleton features:

- Free hosting on [GitLab][GitLab Pages]
- 100% static HTML
- [Segment] tracking support _- coming soon_
- [Facebook Open Graph] support _- coming soon_
- [Twitter Cards] support _- coming soon_

[Segment]:https://segment.com
[Facebook Open Graph]:https://developers.facebook.com/docs/sharing/best-practices
[Twitter Cards]:https://dev.twitter.com/cards/overview

## Requirements

- [Bower](http://bower.io)
- [Compass](http://compass-style.org/install/)

## Installation

```sh
git clone git@gitlab.com:username/repo.git
cd repo
bower install
```

If developing, and you need to watch the `sass` files, run:

```sh
compass watch
```

## How it works

This repository's `master` branch is automatically deployed to http://user.gitlab.com/repo; hosted
on [GitLab Pages]. Only the `webroot/` folder's content is made public. Learn more by
reading [their official documentation](http://doc.gitlab.com/ee/pages/README.html).

For a successful deploy, make sure that:

- a `.gitlab-ci.yml` file exists (samples)
- all assets (styles/scripts/sprites/etc.) are pre-built and committed

To build:

```sh
vendor/bin/g build
```

[GitLab Pages]:https://gitlab.com/pages/
