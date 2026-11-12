
## 🛠️ Prerequisites & System Requirements

Before installing and running the backend server, make sure you have the following installed on your computer:

- **[Laragon](https://laragon.org/)** (Full version recommended, includes Apache/Nginx, **MySQL**, and **HeidiSQL**)
- **PHP** (`8.2+` or `8.4+`, included in Laragon or Herd Lite)
- **[Composer](https://getcomposer.org/)** (PHP dependency manager, included in Laragon)

---

## 🗄️ Step 1: Start Laragon & Create the MySQL Database

1. Open **Laragon** and click **"Start All"** to launch **MySQL** (running on port `3306`).
2. Create a new database named **`MyTasks`** using one of the following methods:
   - **Option A — Using Laragon Database Manager ( phpMyAdmin):**
     1. Click the **"Database"** button in Laragon.
     2. Open a session (default host `127.0.0.1`, user `root`, empty password).
     3. Right-click on the connection → **Create new** → **Database** → enter **`MyTasks`** (collation: `utf8mb4_unicode_ci`) and click **OK**.
 

---

## ⚙️ Step 2: Project Installation & Configuration

### 1. Open the Backend Folder
Open your terminal (Laragon Terminal, PowerShell, or VS Code Terminal) and navigate to the `back` directory:

```bash
cd back
```

### 2. Install Composer Dependencies
```bash
composer install
```

### 3. Configure the `.env` File for Laragon MySQL
If the `.env` file does not exist yet, copy `.env.example`:

```bash
cp .env.example .env
php artisan key:generate
```

Verify that your `.env` file has the following **MySQL (Laragon)** configuration:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=MyTasks
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Run Database Migrations & Seed Initial Tasks
Create the `tasks` table in MySQL and populate it with the default sample tasks:

```bash
php artisan migrate --seed
```

*(Tip: If you ever want to reset the database completely and re-seed the default tasks, run `php artisan migrate:fresh --seed`)*

---

## ▶️ Step 3: Start the Laravel API Server

### 1. Run for Web Browser & Local Emulator
```bash
php artisan serve
```
The API will be available at: **`http://127.0.0.1:8000/api/tasks`**

### 2. Run for Physical Mobile Devices (Android / iPhone on Wi-Fi) & Emulators (Recommended)
To allow both your computer and your phone/emulator on the same Wi-Fi network to reach the Laravel server, bind it to `0.0.0.0`:

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

- **Expo Web (Browser)**: connects to `http://127.0.0.1:8000/api`
- **Android Emulator**: connects to `http://10.0.2.2:8000/api`
- **Real Phone (Expo Go on same Wi-Fi)**: automatically detects your PC's local IP (`http://192.168.x.x:8000/api`)

---

## 📡 API Endpoints Reference

All API routes are defined in `routes/api.php` and handled by `App\Http\Controllers\Api\TaskController`.

| Method | Endpoint | Description |
| :--- | :--- | :--- |
| `GET` | `/api/tasks` | Retrieve all tasks (ordered by newest first) |
| `POST` | `/api/tasks` | Create a new task |
| `GET` | `/api/tasks/{id}` | Retrieve a single task by ID |
| `PUT` / `PATCH` | `/api/tasks/{id}` | Update an existing task |
| `DELETE` | `/api/tasks/{id}` | Delete a task |


