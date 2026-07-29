# CIFullCalendar v4

## Overview

CIFullCalendar is a server-side calendar and scheduling web application built on CodeIgniter v4 and Fullcalendar. It provides tools for publishing, managing, and sharing events across public and private views, with role-based access for visitors, members, and administrators.

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

The [User Guide](https://codeigniter.com/user_guide/) is the primary documentation for CodeIgniter 4.

You might also be interested in the [API documentation](https://codeigniter4.github.io/api/) for the framework components.


## What is FullCalendar?

FullCalendar is a full-sized drag & drop event calendar. [official site](https://fullcalendar.io).

More information about the plans for releases and features can be found in [Road map](https://fullcalendar.io/roadmap).

The [User Guide](https://fullcalendar.io/docs) is the primary documentation.


## The “Super Saiyan Fusion” Capabilities

### Calendar and Event Management

- Create, edit, delete, resize, and drag events directly on the calendar.
- Support recurring events (for example, weekly or monthly schedules).
- Control event overlap rules (allow or deny overlaps).
- Add background events for highlighting time ranges.
- Use category-based filtering and event-source filtering.
- Search public and private events.

### Sharing and Publishing

- Publish public events as JSON feeds .
- Publish user-scoped event feeds.
- Publish RSS feeds.
- Export events to iCalendar (`.ics`) format.
- Generate sitemap for SEO workflows.

### Member and Group Features

- Member profile management and account settings.
- Group-based access and sharing workflows.
- User-specific public calendar URLs.
- Password reset and account recovery flows.

### Administration

- Administrative dashboards for users, groups, sessions, maps, pages, queues, categories, and calendar records.
- Site settings for calendar behavior, templates, media files, and notifications.
- Content management for custom pages.

### Integrations and UX

- FullCalendar support, including Scheduler compatibility (license required for Scheduler features).
- Google Maps support for event location workflows.
- Attachment handling for events.
- Multilingual routing support (e.g., `en`, `fr`, `es`, `pt`, `it`, `id`, `nl`, `ru`, `ja`, `ko`, `vi`, `zh-cn`, `ar`).

## Technical Stack

- Framework: CodeIgniter 3
- Language: PHP
- Authentication: Ion Auth
- Data: MySQL or any database driver supported by CodeIgniter
- Front-end assets: Bootstrap-based themes, Font Awesome icons, FullCalendar plugins

## Default Routing Highlights

- Default controller
- Public profile route
- Main routes
- SEO route
- Dynamic page titles/slugs routes

## Autoloaded Modules

The application autoloads the following key components:

### Libraries

- `database`
- `auth`
- `template`
- `languages`
- `recurrence`
- `icalendar`
- `notify`


## Module Inventory

### Controllers

- Root controllers
- Calendar controllers
- Profile controllers
- Admin controllers

### Models

- Event and calendar
- Categories and maps
- User and identity
- Site and content

### Custom Libraries

- `auth`

## Project Structure

```text
cifullcalendar/
|-- LICENSE
|-- README.md
|-- SECURITY.md
|-- preload.php
|-- psalm-autoload.php
|-- spark
|-- app/
|   |-- config/                 # Core configuration (routes, db, auth, email, version)
|   |   |-- boot/
|   |-- controllers/            # HTTP entry points (public, member, admin)
|   |   |-- auth/
|   |   |-- admin/
|   |   |-- calendar/
|   |   `-- profile/
|   |-- models/                 # Data-access and domain logic
|   |-- libraries/              # Custom application libraries
|   |-- helpers/                # Custom helper functions
|   |-- language/               # Translation files
|   `-- views/                  # Presentation templates
|-- public/
|   |-- themes/                 # CSS, JS, icons, images
|   |-- assets/                 # CSS, JS, images, vendors
|   |   |-- vendors/            # CSS, JS, images, vendors
|   |-- index.php               # index, htaccess, robots, favicon
|-- install/                    # Installation wizard and setup scripts
|-- writable/                   # Temporary and transient files
`-- system/                     # CodeIgniter framework core
```


## Resources

- User documentation: <https://cifullcalendar.com/v4/docs>
- Support: <https://sirdre.com>

## License and Terms

- License: <https://cifullcalendar.com/v4/docs/license.html>
- Terms and conditions: <https://cifullcalendar.com/v4/docs/terms.html>
