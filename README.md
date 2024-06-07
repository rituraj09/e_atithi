
# e-Atithi

eAtithi is a web-based guest house management system for NIC, Assam, catering to state government employees and the public. It features a three-tiered user structure, prioritizes government employee bookings, and offers reception, accounting, and potential guest review management. The system aims to enhance guest house operations for NIC, Assam.

## Objectives

1. Develop a secure, user-friendly web-based guest house management system for NIC, Assam.
2. Streamline booking process for state employees and public.
3. Implement three-tiered user structure (Super Admin, Admin, Guest).
4. Prioritize state employee bookings in designated guest houses.
5. Customize guest protocols for various categories.
6. Enable Admins to manage guest houses by:
   a. Creating room categories and setting prices.
   b. Managing guest house features with availability and pricing options.
   c. Adding descriptions, photos, and virtual tours.
7. Automate reception tasks (check-in/out, room service requests).
8. Manage financial transactions and accounting processes.
9. (Optional) Integrate guest reviews, payments, and reports.
10. Adhere to data privacy regulations and ensure system security.
## Tech Stack

**Client:** Laravel 10, jQuery, AJAX, Bootstrap

**Server:** Laravel 10, MYSQL


## Run Locally

Clone the project

```bash
  git clone https://github.com/rituraj09/e_atithi.git
```

Go to the project directory

```bash
  cd e_atithi
```

Install dependencies

```bash
  composer install
```

Make .env file from .env.example

```bash
  cp .env.example .env
```

Configure the .env file, add databese name (as you have created in your system)
```bash
  DB_DATABASE=E_Atithi
```

Create databese tables

```bash
  composer migrate
```

Create databese seed

```bash
  composer seed
```

Start the server

```bash
  composer serve
```

