<div align="center">

<img src="static/brood_dark.png" width="128" height="128" alt="Brood Logo">

# brood

*A next generation community management system*

![PHP v8.4](https://img.shields.io/badge/PHP-v8.4-777BB4?style=flat-square&logo=php&logoColor=white)
![htmx](https://img.shields.io/badge/htmx-v1.11.1-3D72D7?style=flat-square&logo=htmx&logoColor=white)
![Alpine JS](https://img.shields.io/badge/Alpine.js-v3.12.0-8BC0D0?style=flat-square&logo=alpine.js&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/TailwindCSS-v3.4.24-06B6D4?style=flat-square&logo=tailwindcss&logoColor=white)
![Redis](https://img.shields.io/badge/Redis-v7.0.11-DC382D?style=flat-square&logo=redis&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-v8.0-4479A1?style=flat-square&logo=mysql&logoColor=white)

</div>

## Overview

Brood is a modern community management system built with a focus on performance and developer experience. It leverages the power of server-side PHP with htmx for dynamic interactions, Alpine.js for reactive components, and TailwindCSS for beautiful, responsive design.

## Features

- **Forum System** - Threaded discussions with real-time updates
- **Live Chat** - Server-Sent Events (SSE) powered messaging
- **User Management** - Authentication and user profiles
- **WYSIWYG Editor** - Rich text editing with BBCode support
- **Emoji Support** - Built-in emoji picker
- **Responsive Design** - TailwindCSS with desktop and mobile as first class citizens
- **Real-time Updates** - htmx-powered dynamic content loading
- **Performance** - FrankenPHP worker mode for blazing fast responses

## Tech Stack

**Backend:**
- PHP 8.4 with FrankenPHP
- Custom FZB framework with ORM
- Redis for pub/sub, session management, and caching
- MySQL/MariaDB for data persistence

**Frontend:**
- htmx for hypermedia interactions
- Alpine.js for reactive components
- TailwindCSS for styling

## Getting Started

### Prerequisites

- Docker and Docker Compose
- Git

### Installation

1. Clone the repository:
```bash
git clone https://github.com/foozbat/brood.git
cd brood
```

2. Start the Docker containers:
```bash
docker-compose up -d
```

3. Access the application at `http://localhost:8080`

### Development

The application uses FrankenPHP's worker mode for optimal performance. Changes to PHP files are automatically reflected (in development mode).

For TailwindCSS development:
```bash
# Watch for CSS changes
npx tailwindcss -i input.css -o static/app.css --watch
```

## Project Structure

```
brood/
├── controllers/        # Route controllers
│   ├── components/    # Reusable components
├── src/              # Domain models
├── templates/        # View templates
│   ├── components/   # UI components
│   ├── fragments/    # Partial templates
│   └── layouts/      # Page layouts
├── static/           # Static assets (CSS, JS)
├── data/             # Data files (emojis, etc.)
└── vendor/           # Composer dependencies
```

## Architecture

Brood uses a custom MVC architecture built on the FZB framework:

- **Models** - Active Record pattern with automatic ORM generation
- **Controllers** - Handle HTTP requests and routing
- **Templates** - PHP-based templating with component system
- **htmx Integration** - Seamless AJAX without JavaScript
- **Alpine.js** - Reactive UI components where needed

## Configuration

Environment variables are configured in `docker-compose.yml`:

- `DB_HOST`, `DB_USER`, `DB_PASSWORD` - Database credentials
- `REDIS_HOST`, `REDIS_PORT` - Redis connection
- `FRANKENPHP_CONFIG` - FrankenPHP worker configuration

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open source and available under the MIT License.

## Acknowledgments

Built with the FZB framework - a lightweight PHP framework for rapid development.
