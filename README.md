## **LMS**

### **Project Overview**
LMS for DepEd's ARAL Program utilizing ML for personalization of supplimental learning materials

> note: for contributing refer to the [Collaboration Workflow](#collaboration-workflow)
---

### **Tech Stack**

* **Frontend:** Livewire, Alpine.js
* **UI/UX:** Tailwind CSS, Filament
* **Backend:** Laravel 12
* **Database:** MySQL (via Docker)
* **Containerization:** Docker + DevContainer for collaboration

---

### **Prerequisites**

* Docker & Docker Compose installed

---

### **Initial Setup**

1. **Clone the repository:**

```bash
git clone https://github.com/JLBuendicho/lms.git
cd lms
```

2. **Copy environment example file & set secrets:**

```bash
cp .env.example .env
# Update DB credentials, Twilio SID, Auth Token, Twilio number
```

3. **Start Docker containers (Laravel + MySQL + Python):**

```bash
docker-compose up -d --build
```

4. **Install Laravel dependencies (inside container):**

```bash
docker compose exec lms php artisan key:generate
docker compose exec lms php artisan migrate
# run db:seed for sample data
docker exec lms php artisan db:seed
```

5. **Start dev server (inside container):**

```bash
docker compose exec lms npm run dev
```

---

### **Running the Project**

* **Run dev server:**

``` bash
docker compose exec lms npm run dev
```

* **Web interface:** `http://localhost:8000`
* **Python Api:** `http://localhost:8001`

---

### **Collaboration Notes**

* All team members should use **DevContainer** for consistent environment:
  * VSCode → `Remote-Containers: Open Folder in Container`

* Push code to **GitHub** branch per feature:
  * follow git commit conventions

* Database migrations:
  * Run `docker exec -it php artisan migrate`

* React frontend hot reload works with `npm run dev`

---

### **Collaboration Workflow**
1. Fork the Repository

2. Clone your fork locally
``` bash
git clone https://github.com/<your-username>/eden.git
cd eden
```

3. Set the original repo as upstream
``` bash
git remote add upstream https://github.com/JLBuendicho/eden.git
git fetch upstream
```

4. Create a branch for your feature/bugfix:
``` bash
git checkout -b feature/<short-feature-name>
```

5. Make changes
    * Work inside the DevContainer for consistent environment
    * Test changes before committing

6. Commit your changes
``` bash
git add .
# example of commit following commit conventions
git commit -m "feat (ml): integrated pyBKT"
```

7. Push branch to your fork
``` bash
git push origin feature/<short-feature-name>
```

8. Open a Pull Request (PR)
    * Target branch: main on JLBuendicho/eden repo
    * Add description & submit for review

9. Sync your fork regularly:
``` bash
git fetch upstream
git checkout main
git merge upstream/main
git push origin main
```

#### Tips:
* Keep branches focused and short-lived
* Test inside DevContainer before opening PR
* Use descriptive commit messages