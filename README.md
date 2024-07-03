# Recruitment Task

This project is a part of recruitment process. It's sole purpose is to show backend Laravel capabilities.
Because it's short and simple and had to include simple frontend, I decided to use Inertia.js with Vue.js.
Because of that decision and the simplicity of the project, I didn't want to overengineer it and did simplest, fastest
solution. In order to complete the task i did some assumptions - mainly that purchase date is the same as date of record creation,
which might not be true in real life scenario. The thought process in some places is explained by comments,
especially in places where i simplified the solution.

## Prerequisites

Before you begin, ensure you have met the following requirements:

- Docker and Docker Compose installed on your machine.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing
purposes.

### Installation

1. Clone the repository:

```bash
git clone https://github.com/yourusername/yourprojectname.git
```

2. Navigate to the project directory

```bash
cd yourprojectname
```

3. Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

4. Prevent sail paradox by running:

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

5. Start sail containers:

```bash
./vendor/bin/sail up -d
```

6. Install composer dependencies:

```bash
./vendor/bin/sail composer install
```

7. Generate application key:

```bash
./vendor/bin/sail artisan key:generate
```

8. Run database migrations (and seeders):

```bash
./vendor/bin/sail artisan migrate --seed
```

9. Install npm dependencies:

```bash
./vendor/bin/sail npm install
```

10. Build frontend assets:

```bash
./vendor/bin/sail npm run dev
```

11. Visit the application in your browser:

```bash
http://localhost
```
