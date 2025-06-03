# Dog CEO API

A Laravel-based API that wraps the [Dog CEO API](https://dog.ceo) and persists data locally.

---

## Installation

Run the following commands to set up the project:

```bash
composer install
php artisan migrate
```

---

## Run the Project

```bash
php artisan serve
```

---

## API Endpoints

### GET Requests
```bash
| Method | Endpoint                      | Description                              |
|--------|-------------------------------|------------------------------------------|
| GET    | /api/breed                    | Get all breeds                           |
| GET    | /api/breed/{breed}            | Get a specific breed by ID or name       |
| GET    | /api/breed/random             | Get a random breed                       |
| GET    | /api/breed/{breed}/image      | Get a random image for the breed         |
| GET    | /api/breed/{breed}/details    | Get breed with park and user info        |
```

### POST Requests

#### Link a User with a Park or Breed

```bash
POST /api/user/{user_id}/associate
```

**Request Body:**

```json
{
  "id": 1,
  "type": "park" // or "breed"
}
```

---

#### Link a Breed to a Park

```bash
POST /api/park/{park_id}/breed
```

**Request Body:**

```json
{
  "id": 1
}
```

---

## Notes

I believe the task is completed as requested. Given more time, I would have:

- Moved the external API logic into a dedicated `DogCeoApi` service class for cleaner abstraction.
- Added validation to all POST requests.
- Implemented better error handling.
- Moved the external API sync into a command for manual execution or scheduled automation.
