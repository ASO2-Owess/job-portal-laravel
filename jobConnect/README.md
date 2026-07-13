# JobConnect

JobConnect is a Laravel platform that connects companies and candidates. Companies can publish job posts, manage applications, and update their public profile. Candidates can browse jobs, apply with a cover letter, track their applications, and manage a portfolio.

## Features

- Separate authentication for companies and candidates.
- Company workspace with dashboard, job publishing, editing, and deletion.
- Application tracking per job post with status updates: `pending`, `accepted`, `rejected`.
- Public company profile with logo, description, and active job posts.
- Candidate workspace with dashboard, application history, and portfolio.
- Uploads for company logos, candidate profile photos, resumes, and project screenshots.
- Protected applications: only a logged-in candidate account can apply.
- Duplicate prevention: a candidate can apply only once to the same job post.
- Clean dashboard-inspired UI with cards, icons, and image placeholders.

## Stack

- PHP `^8.2`
- Laravel `^12.0`
- Laravel Sanctum
- SQLite by default
- Vite
- Tailwind CSS v4
- Bootstrap 5 via CDN in the Blade layout

## Installation

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
```

If you use SQLite, create the database file.

Windows PowerShell:

```powershell
New-Item -ItemType File database/database.sqlite
```

Linux/macOS:

```bash
touch database/database.sqlite
```

Then run the migrations:

```bash
php artisan migrate
```

Create the storage symlink so uploaded files are publicly accessible:

```bash
php artisan storage:link
```

## Local Development

Terminal 1:

```bash
php artisan serve
```

Terminal 2:

```bash
npm run dev
```

Application URL:

```text
http://127.0.0.1:8000
```

The project also includes a Composer script:

```bash
composer run dev
```

This script starts the Laravel server, queue worker, logs, and Vite in parallel.

## Useful Configuration

In `.env`, check at least:

```env
APP_NAME=JobConnect
APP_URL=http://127.0.0.1:8000
DB_CONNECTION=sqlite
FILESYSTEM_DISK=public
```

If you keep `FILESYSTEM_DISK=local`, uploads that explicitly use the `public` disk will still work, but `public` is clearer for this project.

## Roles

**Company**

- Register: `/company/register`
- Login: `/company/login`
- Dashboard: `/company/dashboard`
- My jobs: `/company/jobs`
- Company profile: `/company/profile`

A company can publish job posts, update their status, review received applications, accept or reject candidates, and update its logo/profile.

**Candidate**

- Register: `/candidate/register`
- Login: `/candidate/login`
- Dashboard: `/candidate/dashboard`
- My applications: `/candidate/applications`
- Portfolio: `/candidate/projects`
- Candidate profile: `/candidate/profile`

A candidate can browse jobs, apply once per job post, upload a resume and profile photo, and add portfolio projects with screenshots.

## Public Routes

- Home: `/`
- Job list: `/jobs`
- Job details: `/jobs/{jobPost}`
- Public company profile: `/companies/{company}`

## Uploads and Images

Missing images are replaced with clean icons in the interface. Authorized users can replace them:

- Company logo: company profile.
- Candidate photo: candidate profile.
- Candidate resume: candidate profile.
- Project screenshot: create or edit a portfolio project.

Files are stored in `storage/app/public` and served through `public/storage` after running:

```bash
php artisan storage:link
```

## Tests and Checks

Compile Blade views:

```bash
php artisan view:cache
php artisan view:clear
```

Run tests:

```bash
php artisan test
```

Check routes:

```bash
php artisan route:list
```

## Main Structure

```text
app/Http/Controllers/Auth
app/Http/Controllers/Candidate
app/Http/Controllers/Company
app/Models
database/migrations
resources/views
routes/web.php
```

## Development Notes

- The `company` and `candidate` guards separate access.
- Sensitive actions verify resource ownership before updates.
- The application route is protected by the `auth:candidate` middleware.
- The application controller also checks that a candidate is logged in before creating an application.
- The global design is mainly centralized in `resources/views/layouts/app.blade.php`.
