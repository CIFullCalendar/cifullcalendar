# CIFullCalendar v3 - Legacy **3.6.2.9**.

## Overview

CIFullCalendar is a server-side calendar and scheduling web application built on CodeIgniter 3. It provides tools for publishing, managing, and sharing events across public and private views, with role-based access for visitors, members, and administrators.

## Core Capabilities

### Calendar and Event Management

- Create, edit, delete, resize, and drag events directly on the calendar.
- Support recurring events (for example, weekly or monthly schedules).
- Control event overlap rules (allow or deny overlaps).
- Add background events for highlighting time ranges.
- Use category-based filtering and event-source filtering.
- Search public and private events.

### Sharing and Publishing

- Publish public events as JSON feeds (for example, `/home/json`).
- Publish user-scoped event feeds (for example, `/home/ujson/{username}`).
- Publish RSS feeds via `/feeds`.
- Export events to iCalendar (`.ics`) format.
- Generate sitemap output via `/sitemap.xml` for SEO workflows.

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

- Default controller: `home`
- Public profile route: `/{username}` maps to `home/view/{username}`
- Main routes: `/login`, `/register`, `/feeds`, `/calendar`, `/profile`, `/admin`
- SEO route: `/sitemap.xml`
- Dynamic page titles/slugs routed through `page/title/{slug}`

## Autoloaded Modules

The application autoloads the following key components:

### Libraries

- `database`
- `ion_auth`
- `template`
- `languages`
- `recurrence`
- `icalendar`
- `notify`

### Helpers

- `url`, `file`, `text`, `string`, `date`, `xml`, `form`, `html`, `language`, `log`

### Models

- `Setting_model`

## Module Inventory

### Controllers

- Root controllers: `Home`, `Login`, `Logout`, `Register`, `Feeds`, `Page`, `Seo`
- Member calendar controllers: `calendar/Home`, `calendar/Categories`, `calendar/Sources`, `calendar/Gmaps`, `calendar/Login`, `calendar/Logout`
- Profile controllers: `profile/Home`, `profile/User`, `profile/Forgot_login`, `profile/Login`, `profile/Logout`
- Admin controllers: `admin/Home`, `admin/Login`, `admin/Logout`, `admin/Userslist`, `admin/Group`, `admin/Categories`, `admin/Pages`, `admin/Settings`, `admin/Calendarlist`, `admin/Maplist`, `admin/Queuelist`, `admin/Sessionlist`

### Models

- Event and calendar: `Fullcalendar_model`, `Fullcalendar_admin_model`, `Eventsources_model`, `Feed_model`
- Categories and maps: `Category_model`, `Category_admin_model`, `Gmaps_model`, `Gmaps_admin_model`
- User and identity: `Ion_auth_model`, `Member_model`, `Member_admin_model`, `Sessions_model`
- Site and content: `Setting_model`, `Page_model`, `Notification_model`

### Custom Libraries

- `Ion_auth`, `Bcrypt`, `Recurrence`, `Icalendar`, `Notify`, `Template`, `Languages`

## Project Structure

```text
cifullcalendar/
|-- index.php
|-- README.md
|-- application/
|   |-- config/                 # Core configuration (routes, db, auth, email, version)
|   |-- controllers/            # HTTP entry points (public, member, admin)
|   |   |-- admin/
|   |   |-- calendar/
|   |   `-- profile/
|   |-- models/                 # Data-access and domain logic
|   |-- libraries/              # Custom application libraries
|   |-- helpers/                # Custom helper functions
|   |-- language/               # Translation files
|   `-- views/                  # Presentation templates
|-- assets/                     # CSS, JS, images, plugins, uploads, captcha, ics
|-- install/                    # Installation wizard and setup scripts
`-- system/                     # CodeIgniter framework core
```

## Installation

1. Deploy the project to a PHP-enabled web server.
2. Open the application URL. If configuration files are missing, the app redirects to the installer at `/install`.
3. Complete the installation wizard and set:
	- database connection values,
	- application URL values,
	- email transport values.
4. Confirm that the following files are present and configured:
	- `application/config/database.php`
	- `application/config/email.php`
5. Remove the `install` directory after setup (required for production safety).

## Configuration Notes

- `application/config/config.php`: base URL, language, logging, query settings, and environment behavior.
- `application/config/routes.php`: route mapping and language-prefix behavior.
- `application/config/ion_auth.php`: identity policy, password constraints, login lockout, and cookie settings.
- `application/config/email.php`: SMTP and email transport settings.
- `application/config/version.php`: application version metadata.

## Security and Operations Recommendations

- Set `ENVIRONMENT` to `production` in production deployments.
- Disable verbose database and SMTP debug outputs in production.
- Use strong SMTP credentials and secure transport (`tls` or `ssl`) where available.
- Keep the database prefix customized (`dbprefix`) for baseline hardening.
- Rotate admin credentials and review group permissions regularly.
- Keep write permissions minimal for `application/cache`, `application/logs`, and upload folders.

## Known Access Points

- Public calendar page: `/home`
- Public JSON feed: `/home/json`
- User JSON feed: `/home/ujson/{username}`
- RSS feed: `/feeds`
- Profile area: `/profile`
- Member calendar area: `/calendar`
- Admin area: `/admin`
- Sitemap: `/sitemap.xml`

## Resources

- User documentation: <https://cifullcalendar.com/v3/docs>
- Support: <https://sirdre.com>

## License and Terms

- License: <https://cifullcalendar.com/v3/docs/license.html>
- Terms and conditions: <https://cifullcalendar.com/v3/docs/terms.html>
